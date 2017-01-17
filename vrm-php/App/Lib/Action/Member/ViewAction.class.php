<?php

class ViewAction extends MemberAction {

    function index() {
        cookie("viewback", __SELF__);
        $pano_id = I("get.pano_id");
        $fzid = intval($_REQUEST['fzid']);
        $this->assign('pano_id', $pano_id);

		if(!empty($_POST['btnSubmit']))
		{
			if(empty($fzid)){
				$this->error("未选择任何分组");
				exit();
			}
			$ids = I('post.ids');
			if(!empty($ids))
			{
				$ids = implode(",",$ids);
				if($fzid=="-1"){
					M("Pano_view")->where("id in ($ids)")->save(array("fenzuid"=>0));
				}else{
					M("Pano_view")->where("id in ($ids)")->save(array("fenzuid"=>$fzid));
				}
			}
			$this->success('设置成功', U("view/index", array("pano_id" => $pano_id)));
            exit();
		}	

        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        $this->assign('panorow', $panorow);

		$viewwhere['pano_id'] = $pano_id;
		$title = trim(I('post.title'));
		if(!empty($title))
		{
			$viewwhere['title'] = array('like',"%".$title."%");
			$this->assign('title', $title);
		}
		if(!empty($fzid))
		{
			$viewwhere['fenzuid'] = $fzid;
			$this->assign('fzid', $fzid);
		}
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
		if(!empty($viewlist))
		{
			foreach($viewlist as $key=>$val)
			{
				$viewlist[$key]['fenzuname'] = M("Pano_fenzu")->where(array("id"=>$val['fenzuid']))->getField("name");
			}
		}
        $this->assign('viewlist', $viewlist);
		
		$fenzuwhere = array(
			"pano_id" => $this->pano_id
		);
		$fenzulist = M("Pano_fenzu")->where(array("pano_id"=>$pano_id))->order("id asc")->select();
		$this->assign('fenzulist', $fenzulist);
		
        $this->display();
    }

	function fenzulist()
	{
		$pano_id = I("get.pano_id");
		if (I("post.dopost") == "save")
		{
			$ids = I('post.ids');
			$names = I('post.names');
			if(!empty($ids))
			{
				foreach($ids as $key=>$val)
				{
					M("Pano_fenzu")->where(array("id" => $val))->save(array("name" => $names[$key]));
				}
			}
			$this->success('修改成功', U("view/fenzulist", array("pano_id" => $pano_id)));
            exit();
		}


		$fenzulist = M("Pano_fenzu")->where(array("pano_id"=>$pano_id))->order("id asc")->select();
		$this->assign('fenzulist', $fenzulist);
		$this->assign('pano_id', $pano_id);
		$this->display();
	}
	
	function createfenzu()
	{
		$pano_id = intval($_REQUEST['pano_id']);
		$name = I('post.name');
		if(empty($pano_id))
		{
			$this->error("未指定任何场景");
			exit();
		}		
		if (I("post.dopost") == "save")
		{	
			if(empty($name))
			{
				$this->error("请填写分组名称");
				exit();
			}
			M("Pano_fenzu")->add(array("pano_id" => $pano_id,"name" => $name));
			$this->redirect("view/fenzulist",array("pano_id" => $pano_id));
            exit();
		}
		$this->assign('pano_id', $pano_id);
		$this->display();
	}
	function delfenzu()
	{
		$id = I("get.id");
		$pano_id = I("get.pano_id");
		if(empty($id))
		{
			$this->error("未指定任何分组");
			exit();
		}
		else
		{
			M("Pano_fenzu")->where(array("id"=>$id))->delete();
			$this->redirect("view/fenzulist",array("pano_id" => $pano_id));
            exit();
		}
	}

    function add() {
        $backurl = cookie("viewback");
        $this->assign('backurl', $backurl);

        $os = (DIRECTORY_SEPARATOR == '\\') ? "windows" : 'linux';
        $this->assign('os', $os);

        if (I("post.dopost") == "save") {
            $pano_id = I('post.pano_id');
            $title = trim(I('post.title'));
            $thumb = I('post.thumb');
            $front = I('post.front');
            $back = I('post.back');
            $left = I('post.left');
            $right = I('post.right');
            $up = I('post.up');
            $down = I('post.down');
            $fov = I("post.fov");
            $hlookat = I("post.hlookat");
            $vlookat = I("post.vlookat");
            $openmusic = I("post.openmusic");
            $musicfile = I("post.musicfile");
            $musictimes = I("post.musictimes");
            $musicvolume = I("post.musicvolume");
            $fovmin = I('post.fovmin');
            $fovmax = I('post.fovmax');
            $hlookatmin = I('post.hlookatmin');
            $hlookatmax = I('post.hlookatmax');
            $vlookatmin = I('post.vlookatmin');
            $vlookatmax = I('post.vlookatmax');
            $open_limit = I('post.open_limit');
            $limitview = I('post.limitview');
            
            if($hlookatmin > $hlookatmax){
                $hlookatmax = $hlookatmax + 360;
            }
            if($hlookatmin>180){
                $hlookatmin = $hlookatmin - 360;
                $hlookatmax = $hlookatmax - 360;
            }

            if ($title == "") {
                $this->error("请填写【全景场景名称】！");
                exit();
            }

            $viewwhere = array(
                "pano_id" => $pano_id,
                "member_id" => $this->member_id
            );
            $viewrow = M("Pano_view ")->where($viewwhere)->select();
            if (is_array($viewrow)) {
                $m = count($viewrow);
                $sort = $m + 1;
                $first_read = 0;
            } else {
                $sort = 1;
                $first_read = 1;
            }

            $filedir = substr(md5(time()), 5, 8);

            foreach ($this->pano as $pk) {
                if (${$pk} == "") {
                    $this->error("请确保上传所有全景图！");
                    exit();
                } else {
                    if (substr_count(${$pk}, "station") > 0) {
                        ${$pk} = MoveViewPhoto(${$pk}, $this->member_id, $pano_id, $filedir, $pk);
                    }
                }
            }

            if (substr_count($thumb, "station") > 0) {
                $thumb = MoveThumbPhoto($thumb, $this->member_id, $pano_id, $filedir);
            } else {
                $thumb = CopyThumbPhoto($thumb, $this->member_id, $pano_id, $filedir);
            }
            $pano_path = str_replace("pano_l", "pano_%s", $left);

            if (substr_count($musicfile, "station") > 0) {
                $musicfile = MoveThumbPhoto($musicfile, $this->member_id, $pano_id, $viewrow['filedir'],"music");
            }
            if(!is_file(APP_ROOT.$musicfile)){
                $openmusic = 0;
            }

            $data = array(
                "title" => $title,
                "member_id" => $this->member_id,
                "pano_id" => $pano_id,
                "filedir" => $filedir,
                "thumb" => $thumb,
                "front" => $front,
                "back" => $back,
                "left" => $left,
                "right" => $right,
                "up" => $up,
                "down" => $down,
                "sort" => $sort,
                "pano_path" => $pano_path,
                "first_read" => $first_read,
                "fov" => $fov,
                "hlookat" => $hlookat,
                "vlookat" => $vlookat,
                "openmusic" => $openmusic,
                "musicfile" => $musicfile,
                "musictimes" => $musictimes,
                "musicvolume" => $musicvolume,
                'fovmin' => $fovmin,
                'fovmax' => $fovmax,
                'hlookatmin'=>$hlookatmin,
                'hlookatmax' => $hlookatmax,
                'vlookatmin' => $vlookatmin,
                "vlookatmax" => $vlookatmax,
                'open_limit' => $open_limit,
                'limitview' => $limitview,
            );
            $view_id = M("Pano_view")->add($data);

            $imgdir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/station";
            RemoveDirFiles($imgdir);

            $this->redirect("mkpreview", array("view_id" => $view_id));
            exit();
        }

        $pano_id = I("get.pano_id");
        $this->assign('pano_id', $pano_id);
        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        $this->assign('panorow', $panorow);

        $this->display();
    }

    function edit() {
        $backurl = cookie("viewback");
        $this->assign('backurl', $backurl);

        $os = (DIRECTORY_SEPARATOR == '\\') ? "windows" : 'linux';
        $this->assign('os', $os);

        if (I("post.dopost") == "save") {
            $view_id = I("post.view_id");
            $this->assign("view_id", $view_id);
            $viewwhere = array(
                "id" => $view_id,
                "member_id" => $this->member_id
            );
            $viewrow = M("Pano_view")->where($viewwhere)->find();

            $pano_id = I('post.pano_id');
            $title = trim(I('post.title'));
            $thumb = I('post.thumb');
            $front = I('post.front');
            $back = I('post.back');
            $left = I('post.left');
            $right = I('post.right');
            $up = I('post.up');
            $down = I('post.down');
            $fov = I("post.fov");
            $hlookat = I("post.hlookat");
            $vlookat = I("post.vlookat");
            $openmusic = I("post.openmusic");
            $musicfile = I("post.musicfile");
            $musictimes = I("post.musictimes");
            $musicvolume = I("post.musicvolume");
            $fovmin = I('post.fovmin');
            $fovmax = I('post.fovmax');
            $open_limit = I('post.open_limit');
            $hlookatmin = I('post.hlookatmin');
            $hlookatmax = I('post.hlookatmax');
            $vlookatmin = I('post.vlookatmin');
            $vlookatmax = I('post.vlookatmax');
            $limitview = I('post.limitview');
            
            if($hlookatmin > $hlookatmax){
                $hlookatmax = $hlookatmax + 360;
            }
            if($hlookatmin>180){
                $hlookatmin = $hlookatmin - 360;
                $hlookatmax = $hlookatmax - 360;
            }


            if ($title == "") {
                $this->error("请填写【全景场景名称】！");
                exit();
            }

            $is_edit = 0;
            foreach ($this->pano as $pk) {
                if (${$pk} == "#") {
                    ${$pk} = $viewrow[$pk];
                    $res = checkPano($viewrow[$pk]);
                    if($res == 1){
                        $is_edit = 1;
                    }
                } else {
                    $is_edit = 1;
                    if (substr_count(${$pk}, "station") > 0) {
                        ${$pk} = MoveViewPhoto(${$pk}, $this->member_id, $pano_id, $viewrow['filedir'], $pk);
                    }
                }
            }
            $pano_path = str_replace("pano_l", "pano_%s", $left);

            if ($thumb == "#") {
                $thumb = $viewrow['thumb'];
            } else if (substr_count($thumb, "station") > 0) {
                $thumb = MoveThumbPhoto($thumb, $this->member_id, $pano_id, $viewrow['filedir']);
            } else {
                $thumb = CopyThumbPhoto($thumb, $this->member_id, $pano_id, $viewrow['filedir']);
            }

            if (substr_count($musicfile, "station") > 0) {
                $musicfile = MoveThumbPhoto($musicfile, $this->member_id, $pano_id, $viewrow['filedir'],"music");
            }
            if(!is_file(APP_ROOT.$musicfile)){
                $openmusic = 0;
            }

            $data = array(
                "title" => $title,
                "thumb" => $thumb,
                "front" => $front,
                "back" => $back,
                "left" => $left,
                "right" => $right,
                "up" => $up,
                "down" => $down,
                "pano_path" => $pano_path,
                "fov" => $fov,
                "hlookat" => $hlookat,
                "vlookat" => $vlookat,
                "openmusic" => $openmusic,
                "musicfile" => $musicfile,
                "musictimes" => $musictimes,
                "musicvolume" => $musicvolume,
                'fovmin' => $fovmin,
                'fovmax' => $fovmax,
                'hlookatmin'=>$hlookatmin,
                'hlookatmax' => $hlookatmax,
                'vlookatmin' => $vlookatmin,
                "vlookatmax" => $vlookatmax,
                'open_limit' => $open_limit,
                'limitview' => $limitview
            );
            
            
            $where = array(
                "id" => $view_id,
                "pano_id" => $pano_id,
                "member_id" => $this->member_id
            );
            M("Pano_view")->where($where)->save($data);

            $imgdir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/station";
            RemoveDirFiles($imgdir);

            if ($is_edit == 1) {
                $this->success("【{$title}】修改成功！", U("mkpreview", array("view_id" => $view_id)));
            } else {
                $filedir = APP_ROOT . "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/" . $viewrow["pano_id"] . "/" . $viewrow["filedir"] . "/scene";
                if(is_dir($filedir)){
                    clearPian($filedir);
                }
                $this->success("【{$title}】修改成功！", $backurl);
            }
            exit();
        }

        $view_id = I("get.view_id");
        $this->assign("view_id", $view_id);
        $viewwhere = array(
            "id" => $view_id,
            "member_id" => $this->member_id
        );
        $viewrow = M("Pano_view")->where($viewwhere)->find();
        $this->assign("viewrow", $viewrow);

        $panowhere = array(
            "id" => $viewrow['pano_id'],
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        $this->assign("panorow", $panorow);
        $this->assign("pano_id", $viewrow['pano_id']);

        $this->display();
    }

    function mkpreview() {
        $backurl = cookie("viewback");
        $this->assign('backurl', $backurl);

        $view_id = I("get.view_id");
        $this->assign("view_id", $view_id);
        $viewwhere = array(
            "id" => $view_id,
            "member_id" => $this->member_id
        );
        $viewrow = M("Pano_view")->where($viewwhere)->find();
        $this->assign("viewrow", $viewrow);

        $this->display();
    }

    function del() {
        $backurl = cookie("viewback");
        $this->assign('backurl', $backurl);

        $view_id = I("get.view_id");
        $this->assign("view_id", $view_id);
        $viewwhere = array(
            "id" => $view_id,
            "member_id" => $this->member_id
        );
        $viewrow = M("Pano_view")->where($viewwhere)->find();
        if (is_array($viewrow)) {
            $delwhere = array(
                "view_id" => $view_id,
                "member_id" => $this->member_id
            );
            $targetwhere = array(
                "target_id" => $view_id,
                "member_id" => $this->member_id
            );
            M("Pano_roam")->where($delwhere)->delete();
            M("Pano_roam")->where($targetwhere)->delete();
            M("Pano_cube")->where($delwhere)->delete();
            M("Pano_photo")->where($delwhere)->delete();
            M("Pano_map_node")->where($delwhere)->delete();

            $filedir = APP_ROOT . ViewDir($this->member_id, $view_id);
            RemoveDirFiles($filedir);
            M("Pano_view")->where($viewwhere)->delete();
            $paiwhere = array(
                "pano_id" => $viewrow['pano_id'],
                "member_id" => $this->member_id
            );
            $pairow = M("Pano_view")->where($paiwhere)->order("sort")->select();
            $i = 1;
            foreach ($pairow as $pai) {
                $bianwhere = array(
                    "id" => $pai['id'],
                    "member_id" => $this->member_id
                );
                $biandata = array(
                    "sort" => $i
                );
                M("Pano_view")->where($bianwhere)->save($biandata);
                $i++;
            }
            $this->success("【{$viewrow['title']}】删除成功！", $backurl);
        }
    }

    function changeview() {
        cookie("viewback", __SELF__);
        $pano_id = I("get.pano_id");
        $this->assign('pano_id', $pano_id);

        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        $this->assign('panorow', $panorow);

        $viewwhere = array(
            "pano_id" => $pano_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        $this->assign('viewlist', $viewlist);

        $this->display();
    }

    function firstview() {
        cookie("viewback", __SELF__);
        $pano_id = I("get.pano_id");
        $this->assign('pano_id', $pano_id);

        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        $this->assign('panorow', $panorow);

        $viewwhere = array(
            "pano_id" => $pano_id
        );
        $viewlist = M("Pano_view")->where($viewwhere)->order("sort")->select();
        $this->assign('viewlist', $viewlist);

        $this->display();
    }

    function lookat(){
        $view_id = I("get.view_id");
        $front = explode("?",I("get.pic0"));
        $back = explode("?",I("get.pic1"));
        $left = explode("?",I("get.pic2"));
        $right = explode("?",I("get.pic3"));
        $up = explode("?",I("get.pic4"));
        $down = explode("?",I("get.pic5"));

        $hlookat = I("get.hlookat");
        $vlookat = I("get.vlookat");

        cookie("front", $front[0]);
        cookie("back", $back[0]);
        cookie("left", $left[0]);
        cookie("right", $right[0]);
        cookie("up", $up[0]);
        cookie("down", $down[0]);
        cookie("hlookat", $hlookat);
        cookie("vlookat", $vlookat);

        $xmlurl = U('lookatxml', array('view_id' => $view_id));
        $xmlscript = "embedpano({swf:\"__PUBLIC__/pano/pano.swf\", xml:\"$xmlurl\", target:\"pano\", html5:\"auto\", passQueryParameters:true});";
        $this->assign('xmlscript', $xmlscript);

        $this->assign("view_id",$view_id);
        $this->display();
    }
    function lookatxml(){
        $view_id = I("get.view_id");

        $this->display('./App/Tpl/Member/View/lookat.xml', 'utf-8', 'text/xml');
    }
    
    function vat(){
        $view_id = I("get.view_id");
        $front = explode("?",I("get.pic0"));
        $back = explode("?",I("get.pic1"));
        $left = explode("?",I("get.pic2"));
        $right = explode("?",I("get.pic3"));
        $up = explode("?",I("get.pic4"));
        $down = explode("?",I("get.pic5"));

        $hlookat = I("get.hlookat");
        $vlookat = I("get.vlookat");

        cookie("front", $front[0]);
        cookie("back", $back[0]);
        cookie("left", $left[0]);
        cookie("right", $right[0]);
        cookie("up", $up[0]);
        cookie("down", $down[0]);
        cookie("hlookat", $hlookat);
        cookie("vlookat", $vlookat);

        $xmlurl = U('vatxml', array('view_id' => $view_id));
        $xmlscript = "embedpano({swf:\"__PUBLIC__/pano/pano.swf\", xml:\"$xmlurl\", target:\"pano\", html5:\"auto\", passQueryParameters:true});";
        $this->assign('xmlscript', $xmlscript);

        $this->assign("view_id",$view_id);
        $this->display();
    }
    
    function vatxml(){
        $view_id = I("get.view_id");
        $this->display('./App/Tpl/Member/View/vat.xml', 'utf-8', 'text/xml');
    }
    
    function hat(){
        $view_id = I("get.view_id");
        $front = explode("?",I("get.pic0"));
        $back = explode("?",I("get.pic1"));
        $left = explode("?",I("get.pic2"));
        $right = explode("?",I("get.pic3"));
        $up = explode("?",I("get.pic4"));
        $down = explode("?",I("get.pic5"));

        $hlookat = I("get.hlookat");
        $vlookat = I("get.vlookat");

        cookie("front", $front[0]);
        cookie("back", $back[0]);
        cookie("left", $left[0]);
        cookie("right", $right[0]);
        cookie("up", $up[0]);
        cookie("down", $down[0]);
        cookie("hlookat", $hlookat);
        cookie("vlookat", $vlookat);

        $xmlurl = U('hatxml', array('view_id' => $view_id));
        $xmlscript = "embedpano({swf:\"__PUBLIC__/pano/pano.swf\", xml:\"$xmlurl\", target:\"pano\", html5:\"auto\", passQueryParameters:true});";
        $this->assign('xmlscript', $xmlscript);

        $this->assign("view_id",$view_id);
        $this->display();
    }
    
    function hatxml(){
        $view_id = I("get.view_id");
        $this->display('./App/Tpl/Member/View/hat.xml', 'utf-8', 'text/xml');
    }

}

?>
