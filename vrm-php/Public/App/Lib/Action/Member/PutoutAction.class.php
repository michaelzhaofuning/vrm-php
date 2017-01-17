<?php
set_time_limit(0);
class PutoutAction extends MemberAction {

    function index() {
        $pano_id = I('get.pano_id');
        $this->assign('pano_id', $pano_id);

        $xitong = PHP_OS;
        $this->assign("xitong", $xitong);

        $panorow = D("Pano")->GetOne($pano_id, $this->member_id);
        $this->assign('panorow', $panorow);

		$os = (DIRECTORY_SEPARATOR == '\\') ? "windows" : 'linux';
		$panopath = M("pano_putout")->where(array("pano_id"=>$pano_id,"member_id"=>$this->member_id))->find();
		//if($os=="windows") $panopath['pcfilepath'] = APP_ROOT.$panopath['fileurl'];
		//else $panopath['pcfilepath'] = $panopath['fileurl'];
		$panopath['pcfilepath'] = $panopath['fileurl'];
		$this->assign("panopath", $panopath);

        $vn = D("Panoview");
        $viewrow = $vn->GetList($panorow['id'], $this->member_id);
        $len = count($viewrow);
        $this->assign("len", $len);
		
        $this->display();
    }

    function pushout() {
        $putout_id = I("post.putout_id");
        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $zippath = APP_ROOT . $path;
        $finishpath = CC("web_root") . $path . "/pano.zip";
        copy(APP_ROOT . "/Public/zip/do.php", $zippath . "/do.php");
        echo "showaction('开始压缩...');";
        echo "$('#zipbag').attr('href','$finishpath');";
        echo "zipdo();";
    }

    function zipdo() {
        $putout_id = I("post.putout_id");
        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $url = CC("web_root") . $path . "/do.php";
        redirect($url);
        exit();
    }

    function downzipdo() {
        $putout_id = I("get.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $zippath = APP_ROOT . $path;
        $zipname = "pano.zip";
        if (is_file($zippath . "/" . $zipname)) {
            download($zippath, $zipname);
        }
    }

    function creatdir() {
        $pano_id = I('post.pano_id');
        $panorow = D("Pano")->GetOne($pano_id, $this->member_id);

        if (is_array($panorow)) {
            load("extend");
            $member_id = $this->member_id;
            $filepath = "/putout/$member_id/$pano_id";
            createFolder(APP_ROOT . $filepath);
			M("pano_putout")->where(array("pano_id"=>$pano_id,"member_id"=>$this->member_id))->delete();
            $data = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id,
                "fileurl" => $filepath,
                "buildtime" => time()
            );
            $id = M("pano_putout")->add($data);
            echo "$(\"#putout_id\").val($id);";
            echo "loadto(25,500);";
            echo "showaction('正在初始化基本文件！');";
            echo "copybase();";
        } else {
            echo "showaction('你没有<span>权限</span>生成此项目！');";
        }
    }

    function copybase() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";

        $pano_id = $row['pano_id'];
        $panorow = D("Pano")->GetOne($pano_id, $this->member_id);
		$this->assign('panorow', $panorow);

		$HTTP_HOST = $_SERVER['HTTP_HOST']?$_SERVER['HTTP_HOST']:$HTTP_SERVER_VARS['HTTP_HOST'];
		$domainlink = 'http://' . $HTTP_HOST;
		$this->assign('domainlink', $domainlink);
		$this->assign('pano_id', $pano_id);
		$zhuchiren = M("pano_zhuchiren")->where(array("pano_id" => $pano_id))->find();
		$wxinfo = M("Wxconfig")->where(array("id" => 1))->find();
		$this->assign('wxinfo', $wxinfo);
		$this->assign('zhuchiren', $zhuchiren);

        createFolder($panopath);
        $this->buildHtml("index", $panopath . "/", "tour");
		$bag = array("cursor", "cube", "photo", "ui", "plugins", "music", "spot", "weather", "common", "toolbox","images","zhuchiren","navbg");
        foreach ($bag as $value) {
            $dr = $panopath . "/" . $value;
            createFolder($dr);
        }
        copy(APP_ROOT . "/Public/member/images/common/none.png", $panopath . "/common/none.png");
        copy(APP_ROOT . "/Public/pano/common/kuanger.png", $panopath . "/common/kuanger.png");
        copy(APP_ROOT . "/Public/pano/common/close.png", $panopath . "/common/close.png");
        copy(APP_ROOT . "/Public/pano/pano.swf", $panopath . "/pano.swf");
        copy(APP_ROOT . "/Public/pano/pano.js", $panopath . "/pano.js");
        copy(APP_ROOT . "/Public/pano/krpanocms.xml", $panopath . "/krpanocms.xml");
        copy(APP_ROOT . "/Public/pano/gundongzimu.xml", $panopath . "/gundongzimu.xml");
        copy(APP_ROOT . "/Public/pano/cms_config.xml", $panopath . "/cms_config.xml");
        copy(APP_ROOT . "/Public/pano/shuoyishuo.xml", $panopath . "/shuoyishuo.xml");
        copy(APP_ROOT . "/Public/pano/hotspotComment.xml", $panopath . "/hotspotComment.xml");
        copy(APP_ROOT . "/Public/pano/video-player.xml", $panopath . "/video-player.xml");
        copy(APP_ROOT . "/Public/pano/html.xml", $panopath . "/html.xml");
        copy(APP_ROOT . "/Public/pano/share.html", $panopath . "/share.html");

        $luopanwhere = array(
            "member_id" => $this->member_id,
            "pano_id" => $pano_id,
            "open" => 1
        );

		copyFolder(APP_ROOT . "/Public/pano/luopan", $panopath . "/toolbox/luopan");
        $luopanrow = M("Pano_luopan")->where($luopanwhere)->select();
        if (count($luopanrow) > 0) {            
            $src = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/$pano_id/toolbox/luopan";
            $dst = $panopath . "/toolbox/luopan";
            copyFolder($src, $dst);
        }

        $logowhere = array(
            "member_id" => $this->member_id,
            "pano_id" => $pano_id,
            "open" => 1
        );
        $logorow = M("Pano_bottomlogo")->where($logowhere)->select();
        if (count($logorow) > 0) {
            $src = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/$pano_id/toolbox/bottomlogo";
            $dst = $panopath . "/toolbox/bottomlogo";
            copyFolder($src, $dst);
        }

        $src = APP_ROOT . "/Public/pano/photo";
        $dst = $panopath . "/photo";
        copyFolder($src, $dst);

		$src = APP_ROOT . "/Public/pano/images";
        $dst = $panopath . "/images";
        copyFolder($src, $dst);

		$src = APP_ROOT . "/Public/pano/zhuchiren";
        $dst = $panopath . "/zhuchiren";
        copyFolder($src, $dst);

		$src = APP_ROOT . "/Public/pano/hotspotComment";
        $dst = $panopath . "/hotspotComment";
        copyFolder($src, $dst);
		
		$src = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/uiimage";
        $dst = $panopath . "/images/uiimage";
        copyFolder($src, $dst);

		$zhuchiren = M("pano_zhuchiren")->where(array("pano_id" => $pano_id))->find();
		if (is_array($zhuchiren)) {
			copy(APP_ROOT . $zhuchiren["file"], $panopath . "/zhuchiren/" . basename($zhuchiren["file"]));
		}
		$navbgid = M("pano_nav")->where(array("pano_id" => $pano_id))->getField("navbgid");
		if (!empty($navbgid)) {
			$file = M("navbg")->where(array("id" => $navbgid))->getField("file");
			copy(APP_ROOT . $file, $panopath . "/navbg/" . basename($file));
		}

        if ($panorow['cursor_open']) {
            $csid = $panorow["cursor_id"];
            $cswhere = array(
                "id" => $csid
            );
            $csrow = M("Cursor")->where($cswhere)->find();
            if (is_array($csrow)) {
                if ($csrow["type"] == "system") {
                    $csbaseurl = "/Public/material/system/cursor/{$csrow['file']}";
                } else {
                    $csbaseurl = "/Public/material/self/cursor/" . $this->member_id . "/{$csrow['file']}";
                }
                $dst = $panopath . "/cursor";
                if (is_dir(APP_ROOT . $csbaseurl)) {
                    copyFolder(APP_ROOT . $csbaseurl, $dst);
                }
            }
        }

        echo "loadto(60,500);";
        echo "showaction('正在初始化基本文件！');";
        echo "copyplugins();";
    }

    function copyplugins() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";

        $src = APP_ROOT . "/Public/pano/plugins";
        $dst = $panopath . "/plugins";
        copyFolder($src, $dst);

        $src = APP_ROOT . "/Public/pano/lensflare";
        $dst = $panopath . "/lensflare";
        copyFolder($src, $dst);

        $src = APP_ROOT . "/Public/pano/weather";
        $dst = $panopath . "/weather";
        copyFolder($src, $dst);

        echo "loadto(100,50);";
        echo "showaction('初始化完成！开始生成场景文件！');";
        echo "nextdo();";
    }

    function scenedo() {
        set_time_limit(0);
        $putout_id = I("post.putout_id");
        $max = I("post.max");
        $num = I("post.num");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $where = array(
            "pano_id" => $pano_id,
            "sort" => $num,
            "member_id" => $this->member_id
        );
        $viewrow = M("Pano_view")->where($where)->find();
        if (is_array($viewrow)) {
            $scenedir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/" . $pano_id . "/" . $viewrow['filedir'];
            $targetdir = $panopath . "/scene/scene" . $num;
            createFolder($targetdir);
//            copyFolder($scenedir, $targetdir);
//            if(is_dir($scenedir."/scene")){
//                RemoveDirFiles($targetdir."/view");
//            }
            if (is_dir($scenedir . "/scene")) {
                copyFolder($scenedir . "/scene", $targetdir . "/scene");
            } else {
                copyFolder($scenedir . "/view", $targetdir . "/view");
            }
            if (is_dir($scenedir . "/ui")) {
                copyFolder($scenedir . "/ui", $targetdir . "/ui");
            }
            if (is_file($scenedir . "/music.mp3")) {
                copy($scenedir . "/music.mp3", $targetdir . "/music.mp3");
            }
            if (is_file($scenedir . "/" . basename($viewrow["thumb"]))) {
                copy($scenedir . "/" . basename($viewrow["thumb"]), $targetdir . "/" . basename($viewrow["thumb"]));
            }
        }
        $p = 100 * $num / $max;
        echo "loadto($p,500);";

        $num++;
        if ($num > $max) {
            echo "showaction('场景文件生成完成！');";
            echo "nextdo();";
        } else {
            echo "showaction('正在生成场景{$num}！');";
            echo "scenedo($num);";
        }
    }

    function photocheck() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $viewwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        $total = 0;
        $photoid = "";
        foreach ($viewlist as $view) {
            $photolist = D("Photo")->GetList($view['id'], $this->member_id);
            $photolen = count($photolist);
            if ($photolen > 0) {
                foreach ($photolist as $photo) {
                    if ($photoid != "") {
                        $photoid .= "|";
                    }
                    $photoid .= $photo['id'];
                }
                $total = $total + $photolen;
            }
        }
        if ($total == 0) {
            echo "loadto(100,50);";
            echo "showaction('没有设置全景图集！准备查看360物体！');";
            echo "nextdo();";
        } else {
            echo "showaction('全景图集共{$total}个！准备生成图集1！');";
            echo "$(\"#photo_len\").val($total);";
            echo "$(\"#photo_id\").val('$photoid');";
            echo "photodo(1);";
        }
    }

    function cubecheck() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $viewwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        $total = 0;
        $cubeid = "";
        foreach ($viewlist as $view) {
            $cubelist = D("Cube")->GetList($view['id'], $this->member_id);
            $cubelen = count($cubelist);
            if ($cubelen > 0) {
                foreach ($cubelist as $cube) {
                    if ($cubeid != "") {
                        $cubeid .= "|";
                    }
                    $cubeid .= $cube['id'];
                }
                $total = $total + $cubelen;
            }
        }
        if ($total == 0) {
            echo "loadto(100,50);";
            echo "showaction('没有设置360物体！');";
            echo "nextdo();";
        } else {
            echo "showaction('360物体共{$total}个！准备生成360物体1！');";
            echo "$(\"#cube_len\").val($total);";
            echo "$(\"#cube_id\").val('$cubeid');";
            echo "cubedo(1);";
        }
    }

    function photodo() {
        $putout_id = I("post.putout_id");
        $max = I("post.max");
        $photo = I("post.photo");
        $num = I("post.num");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $photo_ids = explode("|", $photo);
        $n = $num - 1;

        $photo_id = $photo_ids[$n];
        $this->assign('photo_id', $photo_id);

        $photorow = D("Photo")->GetOne($photo_id, $this->member_id);
        $this->assign('photorow', $photorow);

        $olddir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}/photo/" . $photorow['pdir'];
        $newdir = $panopath . "/photo/photo" . $photo_id;
        if (!is_dir($newdir)) {
            createFolder($newdir);
            copyFolder($olddir, $newdir);

            $where = array(
                "photo_id" => $photo_id
            );
            $photolist = M("Pano_photo_store")->where($where)->order("sord")->select();
            $this->assign("row", $photolist);
            $photourlarrlen = count($photolist);
            $this->assign('photourlarrlen', $photourlarrlen);

            $this->photoallwidth = $photourlarrlen * 90 + 5 * ($photourlarrlen - 1);

            $this->buildHtml("photo.xml", $newdir . "/", './App/Tpl/Member/Putout/readphoto.xml');
        }

        $p = 100 * $num / $max;
        echo "loadto($p,500);";
        $num++;
        if ($num > $max) {
            echo "showaction('图集生成完成！');";
            echo "nextdo();";
        } else {
            echo "showaction('正在生成图集{$num}！');";
            echo "photodo($num);";
        }
    }

    function cubedo() {
        $putout_id = I("post.putout_id");
        $max = I("post.max");
        $cube = I("post.cube");
        $num = I("post.num");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $cube_id = explode("|", $cube);
        $n = $num - 1;
        $cuberow = D("Cube")->GetOne($cube_id[$n], $this->member_id);
		$this->assign("cube_id", $cuberow['id']);
        $this->assign("cuberow", $cuberow);
        $cubestore_id = $cuberow['target_id'];
        $where = array(
            "id" => $cubestore_id,
            "member_id" => $this->member_id
        );
        $cubestore_row = M("Pano_cube_store")->where($where)->find();
        $olddir = APP_ROOT . $cubestore_row["file"];
        $newdir = $panopath . "/cube/cube" . $cuberow['id'];
        if (!is_dir($newdir)) {
            createFolder($newdir);
            copyFolder($olddir, $newdir);

            $cwhere = array(
                "id" => $cuberow['target_id']
            );
            $cubelist = M("Pano_cube_store")->where($cwhere)->find();
			$cubelist['show_width'] = $cubelist['width']+50;
			$cubelist['show_height'] = $cubelist['height']+100;
            $this->assign("row", $cubelist);          

            $end = array(
                0 => "png",
                1 => "gif",
                2 => "jpg"
            );
            $this->assign("end", $end);

            $speed = $cuberow['speed'];

            if ($speed == "") {
                $speed = 5;
            }
            $speedarr = array();
            $speedarr[1] = 0.4;
            $speedarr[2] = 0.35;
            $speedarr[3] = 0.3;
            $speedarr[4] = 0.25;
            $speedarr[5] = 0.2;
            $speedarr[6] = 0.15;
            $speedarr[7] = 0.1;
            $speedarr[8] = 0.05;
            $speedarr[9] = 0.03;
            $speedarr[10] = 0.001;

            $this->assign('speed', $speedarr[$speed]);

            $fd = $cuberow['otherdirc'];
            if ($fd == 1) {
                $fd = -1;
            } else {
                $fd = 1;
            }

            $this->assign('fd', $fd);
            $this->buildHtml("cube.xml", $newdir . "/", './App/Tpl/Member/Putout/readcube.xml');
        }


        $p = 100 * $num / $max;
        echo "loadto($p,500);";
        $num++;
        if ($num > $max) {
            echo "showaction('360物体生成完成！');";
            echo "nextdo();";
        } else {
            echo "showaction('正在生成360物体{$num}！');";
            echo "cubedo($num);";
        }
    }

    function panoxmldo() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];
		$this->assign("pano_id", $pano_id);

        $cursorM = D("Cursor");
        $this->assign("cursorM", $cursorM);

        $cursordog = $cursorM->getValue(1, "mode");
        $this->assign("cursordog", $cursordog);

        //==================
        $panowhere = array(
            "id" => $pano_id,
            "user_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
		if($panorow['opennews']==1){
			$panorow['opennews'] = "true";
		}else{
			$panorow['opennews'] = "false";
		}
		if($panorow['opentel']==1){
			$panorow['opentel'] = "true";
		}else{
			$panorow['opentel'] = "false";
		}
		if($panorow['openhttp']==1){
			$panorow['openhttp'] = "true";
		}else{
			$panorow['openhttp'] = "false";
		}
		if($panorow['opendaohang']==1){
			$panorow['opendaohang'] = "true";
		}else{
			$panorow['opendaohang'] = "false";
		}
		if($panorow['openzan']==1){
			$panorow['openzan'] = "true";
		}else{
			$panorow['openzan'] = "false";
		}
		if($panorow['openshare']==1){
			$panorow['openshare'] = "true";
		}else{
			$panorow['openshare'] = "false";
		}
		if($panorow['opencard']==1){
			$panorow['opencard'] = "true";
		}else{
			$panorow['opencard'] = "false";
		}
		if(!empty($panorow['map_x'])&&!empty($panorow['map_y'])){
			$panorow['map'] = $panorow['map_x'].",".$panorow['map_y'];
		}
		$HTTP_HOST = $_SERVER['HTTP_HOST']?$_SERVER['HTTP_HOST']:$HTTP_SERVER_VARS['HTTP_HOST'];
		$domainlink = 'http://' . $HTTP_HOST;
		$userinfo = M("Member")->where(array("id" => $this->member_id))->find();
		$this->assign('domainlink', $domainlink);
		$this->assign('userinfo', $userinfo);
        $this->assign('panorow', $panorow);
		
		$navList = M("Pano_nav")->where("pano_id='$pano_id'")->order("listorder asc")->select();
		if(!empty($navList))
		{
			$x = 2;
			foreach($navList as $key=>$val)
			{
				$navbg = M("Navbg")->where("id='".$val['navbgid']."'")->find();
				$navList[$key]['navbg_file'] = "%SWFPATH%/navbg/".basename($navbg['file']);
				$navList[$key]['navbg_width'] = $navbg['width'];
				$navList[$key]['navbg_height'] = $navbg['height'];
				$navList[$key]['navbg_crop'] = ceil($navbg['height']/2);
				if($val['opentype']==1){
					$navList[$key]['linkurl'] = $domainlink."/index.php?s=/Member/Panoapi/tuwen/type/nav/id/".$val['id'];
				}elseif($val['opentype']==2){
					$navList[$key]['linkurl'] = str_replace("&","$",$val['linkurl']);
				}elseif($val['opentype']==3){
					$navList[$key]['linkurl'] = $domainlink."/index.php?s=/Member/Panoapi/navmsg/id/".$val['id'];
				}
				$navList[$key]['navbg_x'] = $x;
				$x = $x+$navbg['width'];
			}
		}
		$panonav= M("Pano_nav")->where("pano_id='$pano_id'")->find();
		$this->assign('panonav', $panonav);
		$this->assign('navList', $navList);

        if ($panorow['open_music'] == 1) {
            $musicrow = M("Music")->where(array("id" => $panorow['music_id']))->find();
            $musicurl = $musicrow["file"];
            $this->assign('musicurl', $musicurl);
        }

        $mybag = CC("web_root") . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}";
        $this->assign("mybag", $mybag);
        $firstscene = getFirstScene($pano_id);
        $this->assign('firstscene', $firstscene);

        //==================
        $viewwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        $thumb = $viewlist[0]['thumb'];
        $thumbarr = getimagesize(APP_ROOT . $thumb);
        $this->thumbwidth = $thumbarr[0];
        $this->thumbheight = $thumbarr[1];

        $strorow = M("pano_intro")->where($viewwhere)->find();
        if (!is_array($strorow)) {
            $strorow["open"] = 0;
        }
        $this->assign("strorow", $strorow);

        $scenedata = array();
        foreach ($viewlist as $vk => $view) {
            $scenedir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/" . $pano_id . "/" . $view['filedir'];
            if (is_dir($scenedir . "/scene")) {
                $viewlist[$vk]["vopen"] = 1;
                $frontdata = getimagesize(APP_ROOT . $view["front"]);
                $panowidth = $frontdata[0];
                $panowidth2 = ceil($panowidth / 2);
                $viewlist[$vk]["v1"] = $panowidth;
                $viewlist[$vk]["v2"] = $panowidth2;
                $viewlist[$vk]["web_dir"] = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/" . $pano_id . "/" . $view['filedir'] . "/scene";
            } else {
                $viewlist[$vk]["vopen"] = 0;
            }

            $scenedata[$view['id']] = $view['sort'];

            $logowhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id'],
                "open" => 1
            );
            $openrow = M("Pano_bottomlogo")->where($logowhere)->find();
            if (is_array($openrow)) {
                $viewlist[$vk]["logo"] = $openrow;
            } else {
                $viewlist[$vk]["logo"]["open"] = 0;
            }

            $luopanwhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id']
            );
            $luopanrow = M("Pano_luopan")->where($luopanwhere)->find();
            if (!is_array($luopanrow)) {
                $luopanrow = array("open" => 0);
            }
            $viewlist[$vk]["luopan"] = $luopanrow;

            $roamwhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id']
            );
            $roamrow = M("Pano_roam")->where($roamwhere)->select();
            $viewlist[$vk]["roam"] = $roamrow;

            $vpointwhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id']
            );
            $vpointrow = M("Pano_vpoint")->where($vpointwhere)->select();
            foreach ($vpointrow as $vks => $vspot) {
                if($vspot["open_apple"] == 1){
                    $vpointrow[$vks]["url"] = "%SWFPATH%/toolbox/video/" . basename($vspot["applefile"]);
                    $vpointrow[$vks]["devices"] = "all";
                }else{
                    $vpointrow[$vks]["url"] = "%SWFPATH%/toolbox/video/" . basename($vspot["applefile"]);
                    $vpointrow[$vks]["devices"] = "flash";
                }
				if(!empty($vspot['appleimg'])){
					$vpointrow[$vks]["appleimg"] = "%SWFPATH%/toolbox/video/" . basename($vspot["appleimg"]);
				}else{
					$vpointrow[$vks]["appleimg"] = "";	
				}
            }
            $viewlist[$vk]["vpoint"] = $vpointrow;

            $linkwhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id']
            );
            $linkrow = M("Pano_link")->where($linkwhere)->select();
			foreach($linkrow as $lk=>$lval)
			{
				$linkrow[$lk]["tuwenlink"] = $domainlink."/index.php?s=/Member/Panoapi/tuwen/type/link/id/".$lval['id'];
				$linkrow[$lk]["link"] = str_replace("&","$",$lval['linkurl']);
			}
            $viewlist[$vk]["link"] = $linkrow;

            $zhuwhere = array(
                "member_id" => $this->member_id,
                "view_id" => $view['id']
            );
            $zhurow = M("Pano_zhu")->where($zhuwhere)->select();
			if(!empty($zhurow))
			{
				foreach($zhurow as $zk=>$zval)
				{
					$zhurow[$zk]["tuwenlink"] = $domainlink."/index.php?s=/Member/Panoapi/tuwen/type/zhuspot/id/".$zval['id'];
				}
			}
            $viewlist[$vk]["zhu"] = $zhurow;

            $cuberow = M("Pano_cube")->where($roamwhere)->select();
            $viewlist[$vk]["cube"] = $cuberow;
            $viewlist[$vk]["cubebag"] = array();
            foreach ($cuberow as $cube) {
                array_push($viewlist[$vk]["cubebag"], $cube['id']);
            }

            $photorow = M("Pano_photo")->where($roamwhere)->select();
            $viewlist[$vk]["photo"] = $photorow;
            $viewlist[$vk]["photobag"] = array();
            foreach ($photorow as $photo) {
                array_push($viewlist[$vk]["photobag"], $photo['id']);
            }

            $lensflarerow = M("Pano_lensflare")->where($roamwhere)->select();
            $viewlist[$vk]["lensflare"] = $lensflarerow;

            $vurow = M("Pano_ui_paths")->where($roamwhere)->select();
            if (count($vurow) > 0) {
                $viewlist[$vk]["haveui"] = 1;
                $this->makevui($view['id'], $panopath);
            } else {
                $viewlist[$vk]["haveui"] = 0;
            }

            $ployrow = M("Pano_hotploy")->where($roamwhere)->select();
            $viewlist[$vk]["hotploybag"] = array();
            foreach ($ployrow as $pk => $ploy) {
                $ployarr = explode("$", $ploy["ploydata"]);
                $ployspot = array();
                foreach ($ployarr as $k => $parr) {
                    $pcut = explode("|", $parr);
                    $ployspot[$k]["atv"] = $pcut[0];
                    $ployspot[$k]["ath"] = $pcut[1];
                }
                $ployrow[$pk]["pointarr"] = $ployspot;
                if ($ploy["action_type"] != "1") {
                    array_push($viewlist[$vk]["hotploybag"], $ploy['id']);
                }
				$ployrow[$pk]['tuwenlink'] = $domainlink."/index.php?s=/Member/Panoapi/tuwen/type/hotploy/id/".$ploy['id'];
            }
            $viewlist[$vk]["hotploy"] = $ployrow;

            $ployvideorow = M("Pano_ployvideo")->where($roamwhere)->select();
            foreach ($ployvideorow as $pk => $ploy) {
                $ployarr = explode("$", $ploy["ploydata"]);
                $ployspot = array();
                foreach ($ployarr as $k => $parr) {
                    $pcut = explode("|", $parr);
                    $ployspot[$k]["atv"] = $pcut[0];
                    $ployspot[$k]["ath"] = $pcut[1];
                }
                $ployvideorow[$pk]["pointarr"] = $ployspot;
                if($ploy["open_apple"] == 1){
                    $ployvideorow[$vk]["url"] = "%SWFPATH%/toolbox/video/" . basename($ploy["applefile"]);
                }else{
                    $ployvideorow[$vk]["url"] = "%SWFPATH%/toolbox/video/" . basename($ploy["applefile"]);
                }
				if(!empty($ploy['appleimg'])){
					$ployvideorow[$vk]["appleimg"] = "%SWFPATH%/toolbox/video/" . basename($ploy["appleimg"]);
				}else{
					$ployvideorow[$vk]["appleimg"] = "";	
				}
            }
            $viewlist[$vk]["ployvideo"] = $ployvideorow;

            $vspotrow = M("Pano_vspot")->where($roamwhere)->select();
            foreach ($vspotrow as $vks => $vspot) {
                if ($vspot["open_apple"] == 1) {
                    $vspotrow[$vks]["url"] = "%SWFPATH%/toolbox/video/" . basename($vspot["applefile"]);
                    $vspotrow[$vks]["devices"] = "all";
                } else {
                    $vspotrow[$vks]["url"] = "%SWFPATH%/toolbox/video/" . basename($vspot["applefile"]);
                    $vspotrow[$vks]["devices"] = "flash";
                }
                if ($vspot["action"] == 1) {
                    $vspotrow[$vks]["eve"] = "togglepause();";
                    $vspotrow[$vks]["style"] = "";
                    $vspotrow[$vks]["hover"] = "if(ispaused,showtext('点击播放');,showtext('点击暂停'););";
                } else if ($vspot["action"] == 2) {
                    $vspotrow[$vks]["eve"] = "";
                    $vspotrow[$vks]["style"] = "flyoutimage";
                    $vspotrow[$vks]["hover"] = "showtext('点击飞出/飞回');";
                }
				if(!empty($vspot['appleimg'])){
					$vspotrow[$vks]["appleimg"] = "%SWFPATH%/toolbox/video/" . basename($vspot["appleimg"]);
				}else{
					$vspotrow[$vks]["appleimg"] = "";	
				}
            }
            $viewlist[$vk]["vspot"] = $vspotrow;
        }
        $this->assign('viewlist', $viewlist);
        $this->assign("scenedata", $scenedata);

        $device = array(
            0 => array(
                0 => "flash",
                1 => "html5"
            ),
            1 => array(
                0 => "flash",
                1 => "all"
            )
        );
        $this->assign("device", $device);

        //==================

        $spotdata = array();
        $sysspotwhere = array(
            "mode" => "system"
        );
        $sysspotrow = M("Spot")->where($sysspotwhere)->select();
        foreach ($sysspotrow as $sysspot) {
            $spotdata[$sysspot['id']] = $sysspot;
        }
        $spotwhere = array(
            "mode" => "self",
            "member_id" => $this->member_id
        );
        $spotrow = M("Spot")->where($spotwhere)->select();
        foreach ($spotrow as $spot) {
            $spotdata[$spot['id']] = $spot;
        }
        $this->assign("spotdata", $spotdata);

        //==================

        $weather_used = 0;
        $viewwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        foreach ($viewlist as $vk => $view) {
            if ($view['effect_mod'] != "noeffect") {
                $weather_used++;
            }
        }
        $this->assign("weather_used", $weather_used);

        //==================

        $sysuiwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id,
            "utp" => 2
        );
        $sysuirow = M("Pano_ui")->where($sysuiwhere)->select();
        foreach ($sysuirow as $k => $sui) {
            $suirow = M("Sysui")->where(array("id" => $sui['uid']))->find();
            $sysuirow[$k]['path'] = $suirow['path'];
        }
        $this->assign("sysuirow", $sysuirow);

        $uiwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id,
            "utp" => 1
        );
        $uirow = M("Pano_ui")->where($uiwhere)->select();
        $this->assign("uirow", $uirow);

        $mbuiwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id,
            "utp" => 1
        );
        $mbuirow = M("Pano_uimobie")->where($mbuiwhere)->select();
        $this->assign("mbuirow", $mbuirow);

        //==================

        $banwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $banrow = M("Pano_ban")->where($banwhere)->select();
        $this->assign("banrow", $banrow);

        //==================

        $toolboxmapwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id,
            "open" => 1
        );
        $toolboxmaprow = M("Pano_toolbox_map")->where($toolboxmapwhere)->find();
        if (is_array($toolboxmaprow)) {
            $toolboxmap_on = 1;
        } else {
            $toolboxmap_on = 0;
        }
        $this->assign('toolboxmap_on', $toolboxmap_on);

        $toolboxmapswhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id,
            "open" => 1
        );
        $toolboxmapsrow = M("Pano_toolbox_maps")->where($toolboxmapswhere)->find();
        if (is_array($toolboxmapsrow)) {
            $toolboxmaps_on = 1;
        } else {
            $toolboxmaps_on = 0;
        }
        $this->assign('toolboxmaps_on', $toolboxmaps_on);

        //==================

        $this->buildHtml("pano.xml", $panopath . "/", './App/Tpl/Member/Putout/xml.xml');

        echo "loadto(50,500);";
        echo "showaction('主XML生成完毕！');";
        echo "basexmldo();";
    }

    function basexmldo() {
        $putout_id = I("post.putout_id");

        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];

        $weather_used = 0;
        $viewwhere = array(
            "pano_id" => $pano_id,
            "member_id" => $this->member_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        foreach ($viewlist as $vk => $view) {
            if ($view['effect_mod'] != "noeffect") {
                $weather_used++;
            }
        }
        $this->assign("weather_used", $weather_used);

        $this->buildHtml("base.xml", $panopath . "/", './App/Tpl/Member/Putout/base.xml');
        echo "loadto(100,500);";
        echo "showaction('函数库XML生成完毕！');";
        echo "nextdo();";
    }

    function modeldo() {
        $n = I("post.num");
        $max = 7;
        if ($n > $max) {
            echo "loadto(100,100);";

            echo "nextdo();";
            exit();
        }
        $putout_id = I("post.putout_id");
        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];
        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();

        if ($n == 1) {
            $mapwhere = array(
                "member_id" => $this->member_id,
                "pano_id" => $pano_id,
                "open" => 1
            );
            $maprow = M("Pano_toolbox_map")->where($mapwhere)->find();
            if (is_array($maprow)) {
                $this->assign('maprow', $maprow);
                $mybag = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}";
                $mapbag = APP_ROOT . $mybag . "/toolbox/map";
                $tarbag = $panopath . "/toolbox/map";
                if (is_dir($mapbag)) {
                    copyFolder($mapbag, $tarbag);
                }
                $maparr = getimagesize(APP_ROOT . $maprow["mapimg"]);
                $this->assign("maparr", $maparr);
                $photo["w"] = $maparr[0];
                $photo["h"] = $maparr[1];
                $photo["bw"] = $maparr[0] + 10;
                $photo["bh"] = $maparr[1] + 10;
                $this->assign("photo", $photo);

                $viewwhere = array(
                    "member_id" => $this->member_id,
                    "pano_id" => $pano_id
                );
                $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
                foreach ($viewlist as $vk => $vrow) {
                    $vid = $vrow['id'];
                    $vwhere = array(
                        "member_id" => $this->member_id,
                        "pano_id" => $pano_id,
                        "view_id" => $vid
                    );
                    $vfind = M("Pano_toolbox_map_point")->where($vwhere)->find();
                    if (!is_array($vfind)) {
                        $data = array(
                            "member_id" => $this->member_id,
                            "pano_id" => $pano_id,
                            "view_id" => $vid
                        );
                        M("Pano_toolbox_map_point")->add($data);
                        $vfind = M("Pano_toolbox_map_point")->where($vwhere)->find();
                    }
                    $viewlist[$vk]['maparr'] = $vfind;
                }
                $this->assign('viewlist', $viewlist);

                $this->buildHtml("map.xml", $panopath . "/toolbox/map/", './App/Tpl/Member/Putout/readvtoolmap.xml');
            }
            echo "showaction('单地图模块生成完毕！开始生成多地图...');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 2) {
            $mapwhere = array(
                "member_id" => $this->member_id,
                "pano_id" => $pano_id,
                "open" => 1
            );
            $maprow = M("Pano_toolbox_maps")->where($mapwhere)->find();
            if (is_array($maprow)) {
                $this->assign('maprow', $maprow);
                $mybag = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}";
                $mapbag = APP_ROOT . $mybag . "/toolbox/maps";
                $tarbag = $panopath . "/toolbox/maps";
                if (is_dir($mapbag)) {
                    copyFolder($mapbag, $tarbag);
                    copy(APP_ROOT . "/Public/member/images/pano/showmap.png", $tarbag . "/showmap.png");
                    copy(APP_ROOT . "/Public/member/images/pano/hidemap.png", $tarbag . "/hidemap.png");
                }

                $maplist = M("Pano_toolbox_maps_map")->where($mapwhere)->select();
                foreach ($maplist as $mk => $mlarr) {
                    $maparr = getimagesize(APP_ROOT . $mlarr["mapurl"]);
                    $maplist[$mk]["photo"] = $maparr;
                    $mppwhere = array(
                        "member_id" => $this->member_id,
                        "pano_id" => $pano_id,
                        "maps_id" => $mlarr["id"]
                    );
                    $mpprow = M("Pano_toolbox_maps_point")->where($mppwhere)->select();
                    $maplist[$mk]["mpp"] = $mpprow;
                }
                $this->assign('maplist', $maplist);

                $viewwhere = array(
                    "member_id" => $this->member_id,
                    "pano_id" => $pano_id
                );
                $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();

                $viewsort = array();
                $viewname = array();
                foreach ($viewlist as $vk => $vrow) {
                    $viewsort[$vrow["id"]] = $vrow["sort"];
                    $viewname[$vrow["id"]] = $vrow["title"];
                }
                $this->assign('viewsort', $viewsort);
                $this->assign('viewname', $viewname);
                $this->assign('viewlist', $viewlist);

                if (substr_count($maprow["map_align"], "left") > 0) {
                    $mapcenter = "lefttop";
                } else if (substr_count($maprow["map_align"], "right") > 0) {
                    $mapcenter = "righttop";
                } else {
                    $mapcenter = "lefttop";
                }
                $this->assign("mapcenter", $mapcenter);

                $this->buildHtml("map.xml", $panopath . "/toolbox/maps/", './App/Tpl/Member/Putout/readvtoolmaps.xml');
            }

            echo "showaction('多地图模块生成完毕！开始生成多边形热区...');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 3) {
            $vlist = D("Panoview")->GetList($pano_id, $this->member_id);
            foreach ($vlist as $viewrow) {
                $where = array(
                    "member_id" => $this->member_id,
                    "view_id" => $viewrow["id"]
                );
                $ployrow = M("Pano_hotploy")->where($where)->select();
                foreach ($ployrow as $pk => $ploy) {
                    $tarbag = $panopath . "/toolbox/ployimg";
                    if ($ploy["action_type"] == 1) {

                    } else if ($ploy["action_type"] == 2) {
                        if (!is_dir($tarbag)) {
                            createFolder($tarbag);
                        }
                        copy(APP_ROOT . $ploy["photo1"], $tarbag . "/" . basename($ploy["photo1"]));

                        $photofile = APP_ROOT . $ploy["photo1"];
                        $photo = array();
                        $arr = getimagesize($photofile);
                        $photo["w"] = $arr[0];
                        $photo["h"] = $arr[1];
                        $photo["bw"] = $arr[0] + 10;
                        $photo["bh"] = $arr[1] + 10;
                        $this->assign("photo", $photo);
                        $this->assign("holyrow", $ploy);
                        $this->assign("holy_id", $ploy["id"]);
                        $this->buildHtml("ployxml{$ploy['id']}.xml", $panopath . "/toolbox/ployimg/", './App/Tpl/Member/Putout/readholy.xml');
                    } else if ($ploy["action_type"] == 3) {
                        if (!is_dir($tarbag)) {
                            createFolder($tarbag);
                        }
                        copy(APP_ROOT . $ploy["photo2"], $tarbag . "/" . basename($ploy["photo2"]));

                        $photofile = APP_ROOT . $ploy["photo2"];
                        $photo = array();
                        $arr = getimagesize($photofile);
                        $w = $arr[0];
                        $h = $arr[1];
                        $p = $w / $ploy["photobox_width"];
                        $h0 = $h / $p;
                        $photo["w"] = $ploy["photobox_width"];
                        $photo["h"] = $h0;
                        $this->assign("photo", $photo);
                        $this->assign("holyrow", $ploy);
                        $this->assign("holy_id", $ploy["id"]);
                        $text = $ploy["text2"];
                        $text = str_replace("\r\n", "[br]", $text);
                        $this->assign("text", $text);
                        $this->buildHtml("ployxml{$ploy['id']}.xml", $panopath . "/toolbox/ployimg/", './App/Tpl/Member/Putout/readholy.xml');
                    } else if ($ploy["action_type"] == 4) {
                        $holy_id = $ploy["id"];
                        $photoarr = M("Imagestore")->where(array("pano_id" => $pano_id, "type" => "hotploy", "from_id" => $holy_id))->order("sort")->select();
                        $photo_total = count($photoarr);
                        if (!is_dir($tarbag)) {
                            createFolder($tarbag);
                        }
                        foreach ($photoarr as $pd) {
                            copy(APP_ROOT . $pd["imageurl"], $tarbag . "/" . basename($pd["imageurl"]));
                        }
                        $this->assign("photo_total", $photo_total);
                        $this->photoallwidth = $photo_total * 90 + 5 * ($photo_total - 1);
                        $this->assign("photoarr", $photoarr);
                        $this->assign("holy_id", $ploy["id"]);
                        $this->assign("holyrow", $ploy);
                        $this->buildHtml("ployxml{$ploy['id']}.xml", $panopath . "/toolbox/ployimg/", './App/Tpl/Member/Putout/readholy.xml');
                    }
                }
            }
            echo "showaction('多边形热区生成完毕！开始生成初始提示图片...');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 4) {
            $trowhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id,
                "open" => 1
            );
            $strorow = M("pano_intro")->where($trowhere)->find();
            if (is_array($strorow)) {
                $mybag = "/uploads/user/" . substr(md5($this->member_id), 5, 15);
                $bag = APP_ROOT . $mybag . "/store/intro";
                $tarbag = $panopath . "/toolbox/intro";
                if (is_dir($bag)) {
                    copyFolder($bag, $tarbag);
                }
            }

            echo "showaction('初始提示图片完毕！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 5) {
            $vsrow = M("Pano_vspot")->where(array("pano_id" => $pano_id))->select();
            $tarbag = $panopath . "/toolbox/video";
            createFolder($tarbag);
            foreach ($vsrow as $vk => $vs) {
                if (is_file(APP_ROOT . $vs["file"])) {
                    copy(APP_ROOT . $vs["file"], $tarbag . "/" . basename($vs["file"]));
                }
                if (is_file(APP_ROOT . $vs["applefile"])) {
                    copy(APP_ROOT . $vs["applefile"], $tarbag . "/" . basename($vs["applefile"]));
                }
                if (is_file(APP_ROOT . $vs["appleimg"])) {
                    copy(APP_ROOT . $vs["appleimg"], $tarbag . "/" . basename($vs["appleimg"]));
                }
            }
        } else if ($n == 6) {
            $vsrow = M("Pano_vpoint")->where(array("pano_id" => $pano_id))->select();
            $tarbag = $panopath . "/toolbox/video";
            createFolder($tarbag);
            foreach ($vsrow as $vk => $vs) {
                if (is_file(APP_ROOT . $vs["file"])) {
                    copy(APP_ROOT . $vs["file"], $tarbag . "/" . basename($vs["file"]));
                }
                if (is_file(APP_ROOT . $vs["applefile"])) {
                    copy(APP_ROOT . $vs["applefile"], $tarbag . "/" . basename($vs["applefile"]));
                }
                if (is_file(APP_ROOT . $vs["appleimg"])) {
                    copy(APP_ROOT . $vs["appleimg"], $tarbag . "/" . basename($vs["appleimg"]));
                }
            }
        }else if ($n == 7) {
            $vsrow = M("Pano_ployvideo")->where(array("pano_id" => $pano_id))->select();
            $tarbag = $panopath . "/toolbox/video";
            createFolder($tarbag);
            foreach ($vsrow as $vk => $vs) {
                if (is_file(APP_ROOT . $vs["file"])) {
                    copy(APP_ROOT . $vs["file"], $tarbag . "/" . basename($vs["file"]));
                }
                if (is_file(APP_ROOT . $vs["applefile"])) {
                    copy(APP_ROOT . $vs["applefile"], $tarbag . "/" . basename($vs["applefile"]));
                }
                if (is_file(APP_ROOT . $vs["appleimg"])) {
                    copy(APP_ROOT . $vs["appleimg"], $tarbag . "/" . basename($vs["appleimg"]));
                }
            }
        }

        $n++;
        echo "modeldo($n);";
        exit();
    }

    function otherdo() {
        $n = I("post.num");
        $max = 7;
        if ($n > $max) {
            echo "loadto(100,100);";

            echo "nextdo();";
            exit();
        }
        $putout_id = I("post.putout_id");
        $row = D("Putout")->GetOne($putout_id);
        $path = $row['fileurl'];
        $panopath = APP_ROOT . $path . "/pano";
        $pano_id = $row['pano_id'];
        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        if ($n == 1) {
            if ($panorow['open_music'] == 1) {
                if ($panorow["open_musicbtn"] == 1) {
                    $mybag = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}";
                    $musicbag = APP_ROOT . $mybag . "/music";
                    $tarbag = $panopath . "/music";
                    if (is_dir($musicbag)) {
                        copyFolder($musicbag, $tarbag);
                    }
                }
                $musicrow = M("Music")->where(array("id" => $panorow['music_id']))->find();
                $musicurl = $musicrow["file"];
                $musicname = basename($musicurl);
                copy(APP_ROOT . $musicurl, $panopath . "/music/" . $musicname);
                echo "showaction('生成背景音乐完成！开始生成热点！');";
            } else {
                echo "showaction('无需生成背景音乐！开始生成热点！');";
            }
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 2) {
            $spotarr = array();
            $viewwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id
            );
            $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
            $scenedata = array();
            foreach ($viewlist as $vk => $view) {
                $roamwhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $roamrow = M("Pano_roam")->where($roamwhere)->select();
                foreach ($roamrow as $roam) {
                    if (!in_array($roam['spot_id'], $spotarr)) {
                        array_push($spotarr, $roam['spot_id']);
                    }
                }

                $linkwhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $linkrow = M("Pano_link")->where($linkwhere)->select();
                foreach ($linkrow as $link) {
                    if (!in_array($link['spot_id'], $spotarr)) {
                        array_push($spotarr, $link['spot_id']);
                    }
                }

                $vpointwhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $vpointrow = M("Pano_vpoint")->where($vpointwhere)->select();
                foreach ($vpointrow as $link) {
                    if (!in_array($link['spot_id'], $spotarr)) {
                        array_push($spotarr, $link['spot_id']);
                    }
                }

                $zhuwhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $zhurow = M("Pano_zhu")->where($zhuwhere)->select();
                foreach ($zhurow as $zhu) {
                    if (!in_array($zhu['spot_id'], $spotarr)) {
                        array_push($spotarr, $zhu['spot_id']);
                    }
                }

                $cubewhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $cuberow = M("Pano_cube")->where($cubewhere)->select();
                foreach ($cuberow as $cube) {
                    if (!in_array($cube['spot_id'], $spotarr)) {
                        array_push($spotarr, $cube['spot_id']);
                    }
                }

                $photowhere = array(
                    "member_id" => $this->member_id,
                    "view_id" => $view['id']
                );
                $photorow = M("Pano_photo")->where($photowhere)->select();
                foreach ($photorow as $photo) {
                    if (!in_array($photo['spot_id'], $spotarr)) {
                        array_push($spotarr, $photo['spot_id']);
                    }
                }
            }

            $spotdata = array();
            $sysspotwhere = array(
                "mode" => "system"
            );
            $sysspotrow = M("Spot")->where($sysspotwhere)->select();
            foreach ($sysspotrow as $sysspot) {
                $spotdata[$sysspot['id']] = $sysspot;
            }
            $spotwhere = array(
                "mode" => "self",
                "member_id" => $this->member_id
            );
            $spotrow = M("Spot")->where($spotwhere)->select();
            foreach ($spotrow as $spot) {
                $spotdata[$spot['id']] = $spot;
            }

            foreach ($spotarr as $spot_id) {
                $srow = $spotdata[$spot_id];
                $a = APP_ROOT . $srow["file"];
                $b = $panopath . "/spot/" . basename($srow["file"]);
                copy($a, $b);
            }
            echo "showaction('热点生成完毕！检查是否使用天气效果！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 3) {
            $weather_used = 0;
            $viewwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id
            );
            $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
            foreach ($viewlist as $vk => $view) {
                if ($view['effect_mod'] != "noeffect") {
                    $weather_used++;
                }
            }
            if ($weather_used > 0) {
                $src = APP_ROOT . "/Public/pano/weather";
                $dst = $panopath . "/weather";
                copyFolder($src, $dst);
                echo "showaction('天气效果生成完毕！');";
            } else {
                echo "showaction('没有开启天气效果！');";
            }
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 4) {
            $sysuiwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id,
                "utp" => 2
            );
            $sysuirow = M("Pano_ui")->where($sysuiwhere)->select();
            foreach ($sysuirow as $k => $sui) {
                $suirow = M("Sysui")->where(array("id" => $sui['uid']))->find();
                $sysuirow[$k]['path'] = $suirow['path'];
                $src = APP_ROOT . "/Public/pano/uistore/{$suirow['path']}";
                $dst = $panopath . "/ui/{$suirow['path']}";
                copyFolder($src, $dst);
            }
            echo "showaction('生成全局UI文件完毕！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 5) {
            $uiwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id,
                "utp" => 1
            );
            $uirow = M("Pano_ui")->where($uiwhere)->select();
            $ui_id = array();
            foreach ($uirow as $k => $ui) {
                if (!in_array($ui['uid'], $ui_id)) {
                    array_push($ui_id, $ui['uid']);
                }
            }
            foreach ($ui_id as $uid) {
                $src = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/uistore/{$uid}";
                $dst = $panopath . "/ui/ui{$uid}";
                createFolder($dst);
                copyFolder($src, $dst);

                $where = array(
                    "uid" => $uid
                );
                $row = M("Ui_child")->where($where)->select();
                foreach ($row as $k => $ui) {
                    if ($ui['parent'] == 0) {
                        $row[$k]['parent_name'] = "";
                    } else {
                        $row[$k]['parent_name'] = "ui" . $ui['parent'];
                    }
                    $actionwhere = array(
                        "cid" => $ui['id'],
                        "member_id" => $this->member_id
                    );
                    $actionrow = M("Ui_action")->where($actionwhere)->select();
                    $actionxml = "";
                    foreach ($actionrow as $actiondata) {
                        if ($actiondata['actiondo'] != "") {
                            $actionxml .= " on{$actiondata['eventchu']}=\"{$actiondata['actiondo']}\"";
                        }
                    }
                    $row[$k]['action'] = $actionxml;
                }
                $this->assign("row", $row);
                $this->buildHtml("ui.xml", $panopath . "/ui/ui{$uid}/", './App/Tpl/Member/Putout/readui.xml');
            }
            echo "showaction('生成自定义UI文件完毕！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 6) {
            $uiwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id,
                "utp" => 1
            );
            $uirow = M("Pano_uimobie")->where($uiwhere)->select();
            $ui_id = array();
            foreach ($uirow as $k => $ui) {
                if (!in_array($ui['uid'], $ui_id)) {
                    array_push($ui_id, $ui['uid']);
                }
            }
            foreach ($ui_id as $uid) {
                $src = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/uistore/{$uid}";
                $dst = $panopath . "/ui/ui{$uid}";
                createFolder($dst);
                copyFolder($src, $dst);

                $where = array(
                    "uid" => $uid
                );
                $row = M("Ui_child")->where($where)->select();
                foreach ($row as $k => $ui) {
                    if ($ui['parent'] == 0) {
                        $row[$k]['parent_name'] = "";
                    } else {
                        $row[$k]['parent_name'] = "ui" . $ui['parent'];
                    }
                    $actionwhere = array(
                        "cid" => $ui['id'],
                        "member_id" => $this->member_id
                    );
                    $actionrow = M("Ui_action")->where($actionwhere)->select();
                    $actionxml = "";
                    foreach ($actionrow as $actiondata) {
                        if ($actiondata['actiondo'] != "") {
                            $actionxml .= " on{$actiondata['eventchu']}=\"{$actiondata['actiondo']}\"";
                        }
                    }
                    $row[$k]['action'] = $actionxml;
                }
                $this->assign("row", $row);
                $this->buildHtml("mbui.xml", $panopath . "/ui/ui{$uid}/", './App/Tpl/Member/Putout/readmbui.xml');
            }
            echo "showaction('生成自定义UI文件完毕！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        } else if ($n == 7) {
            $mybag = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/{$pano_id}";
            $smartbag = APP_ROOT . $mybag . "/smartspot";
            $spotbag = $panopath . "/spot";
            if (is_dir($smartbag)) {
                copyFolder($smartbag, $spotbag);
            }
            echo "showaction('智能热点热点生成完毕！');";
            $p = 100 * $n / $max;
            echo "loadto($p,300);";
        }
        $n++;
        echo "otherdo($n);";
        exit();
    }

    function makevui($view_id, $panopath) {
        $this->assign("view_id", $view_id);

        $viewrow = D("Panoview")->getOne($view_id, $this->member_id);
        $this->assign("viewrow", $viewrow);

        $where = array(
            "view_id" => $view_id,
            "devices" => "flash"
        );
        $row = M("Pano_ui_paths")->where($where)->select();
        foreach ($row as $k => $ui) {
            if ($ui['parent'] == 0) {
                $row[$k]['parent_name'] = "";
            } else {
                $row[$k]['parent_name'] = "ui" . $ui['parent'];
            }
            $actionwhere = array(
                "cid" => $ui['id'],
                "member_id" => $this->member_id
            );
            $actionrow = M("Pano_ui_action")->where($actionwhere)->select();
            $actionxml = "";
            foreach ($actionrow as $actiondata) {
                if ($actiondata['actiondo'] != "") {
                    $actionxml .= " on{$actiondata['eventchu']}=\"{$actiondata['actiondo']}\"";
                }
            }
            $row[$k]['action'] = $actionxml;
        }
        $this->assign("row", $row);

        $mbwhere = array(
            "view_id" => $view_id,
            "devices" => "mobile"
        );
        $mbrow = M("Pano_ui_paths")->where($mbwhere)->select();
        foreach ($mbrow as $k => $ui) {
            if ($ui['parent'] == 0) {
                $mbrow[$k]['parent_name'] = "";
            } else {
                $mbrow[$k]['parent_name'] = "ui" . $ui['parent'];
            }
            $actionwhere = array(
                "cid" => $ui['id'],
                "member_id" => $this->member_id
            );
            $actionmbrow = M("Pano_ui_action")->where($actionwhere)->select();
            $actionxml = "";
            foreach ($actionmbrow as $actiondata) {
                if ($actiondata['actiondo'] != "") {
                    $actionxml .= " on{$actiondata['eventchu']}=\"{$actiondata['actiondo']}\"";
                }
            }
            $mbrow[$k]['action'] = $actionxml;
        }
        $this->assign("mbrow", $mbrow);
        $this->buildHtml("ui.xml", $panopath . "/scene/scene{$viewrow['sort']}/ui/", './App/Tpl/Member/Putout/readvui.xml');
    }

}

?>
