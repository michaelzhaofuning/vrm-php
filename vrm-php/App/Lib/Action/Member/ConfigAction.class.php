<?php

class ConfigAction extends MemberAction {

    function index() {
        if (I("post.dopost") == "save") {
            $pano_id = I("post.pano_id");

            $panowhere = array(
                "id" => $pano_id,
                "member_id" => $this->member_id
            );
            $title = trim(I('post.title'));
            $is_ipad_view = intval(I('post.is_ipad_view'));
            $is_littleplanet_view = intval(I('post.is_littleplanet_view'));
            $cursor_open = intval(I("post.cursor_open"));
            $cursor_id = intval(I('post.cursor_id'));
            $openautorate = intval(I("post.openautorate"));
            $autoratewaittime = intval(I("post.autoratewaittime"));
            $autoratespeed = intval(I("post.autoratespeed"));
            $autorateaccel = intval(I("post.autorateaccel"));
            $openautonext = intval(I('post.openautonext'));
            $autonextpass = intval(I('post.autonextpass'));
            $thumbwidth = intval(I('post.thumbwidth'));
            $thumbheight = intval(I('post.thumbheight'));

			$openwechat = intval(I('post.openwechat'));
			$opentongji = intval(I('post.opentongji'));
			$openzan = intval(I('post.openzan'));
			$openshare = intval(I('post.openshare'));
			$website = trim(I('post.website'));
			$linkphone = trim(I('post.linkphone'));
			$gundongzimu = trim(I('post.gundongzimu'));
			$address = trim(I('post.address'));
			$map = trim(I('post.map'));
			$openwelcome = intval(I('post.openwelcome'));
			$openauthor = intval(I('post.openauthor'));
			$openpanologo = intval(I('post.openpanologo'));

			$openhttp = intval(I('post.openhttp'));
			$opentel = intval(I('post.opentel'));
			$opennews = intval(I('post.opennews'));
			$opendaohang = intval(I('post.opendaohang'));
			$opencard = intval(I('post.opencard'));

			if(!empty($map))
			{
				$map = explode(",",$map);
				$map_x = $map[0];
				$map_y = $map[1];
				M("Pano")->where(array("id" => $pano_id))->save(array("map_x"=>$map_x,"map_y"=>$map_y));
			}

            if ($title == "") {
                $this->error("标题不能为空！");
                exit();
            }
			$fileurl = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/uiimage";
			if(!empty($_POST['welcome'])){
				$welcome = ExecUpload($_POST['welcome'], $_POST['old_welcome'], $fileurl);
				M("Pano")->where(array("id" => $pano_id))->save(array("welcome"=>$welcome));
			}

			$fileurl = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/uiimage";
			if(!empty($_POST['pano_logo'])){
				$pano_logo = ExecUpload($_POST['pano_logo'], $_POST['old_pano_logo'], $fileurl);
				M("Pano")->where(array("id" => $pano_id))->save(array("pano_logo"=>$pano_logo));
			}

            $data = array(
                "title" => $title,
                "member_id" => $this->member_id,
                "is_ipad_view" => $is_ipad_view,
                "is_littleplanet_view" => $is_littleplanet_view,
                "cursor_open" => $cursor_open,
                "cursor_id" => $cursor_id,
                "openautorate" => $openautorate,
                "autoratewaittime" => $autoratewaittime,
                "autoratespeed" => $autoratespeed,
                "autorateaccel" => $autorateaccel,
                "openautonext" => $openautonext,
                "autonextpass" => $autonextpass,
                'openwechat' => $openwechat,
                'opentongji' => $opentongji,
                'openzan' => $openzan,
                'openshare' => $openshare,
                'website' => $website,
                'linkphone' => $linkphone,
                'gundongzimu' => $gundongzimu,
                'address' => $address,
                'openwelcome' => $openwelcome,
                'openauthor' => $openauthor,
                'openpanologo' => $openpanologo,
                'openhttp' => $openhttp,
                'opentel' => $opentel,
                'opennews' => $opennews,
                'opendaohang' => $opendaohang,
                'opencard' => $opencard
            );
            M("Pano")->where($panowhere)->save($data);
            $this->success("修改成功！", U("index", array("pano_id" => $pano_id)));
            exit();
        }

        $pano_id = I("get.pano_id");
        $this->assign('pano_id', $pano_id);

        $panowhere = array(
            "id" => $pano_id,
            "member_id" => $this->member_id
        );
        $panorow = M("Pano")->where($panowhere)->find();
        if(!empty($panorow['map_x'])||!empty($panorow['map_y'])){
			$panorow['map'] = $panorow['map_x'].",".$panorow['map_y'];
		}
		$this->assign('panorow', $panorow);

        $syscursorwhere = array(
            "type" => "system"
        );
        $syscursorrow = M("Cursor")->where($syscursorwhere)->select();
        $this->assign("syscursorrow", $syscursorrow);

        $selfcursorwhere = array(
            "type" => "self",
            "member_id" => $this->member_id
        );
        $selfcursorrow = M("Cursor")->where($selfcursorwhere)->select();
        $this->assign("selfcursorrow", $selfcursorrow);

        $mid = $this->member_id;
        $this->assign('mid', $mid);

        $this->display();
    }
	public function card()
	{
		$pano_id = intval($_REQUEST['pano_id']);
		if (I("post.dopost") == "save")
		{
			$data = array();			
			$data['c_name'] = I("post.c_name");
			$data['c_phone'] = I("post.c_phone");
			$data['c_email'] = I("post.c_email");
			$data['c_address'] = I("post.c_address");
			$data['c_wechat'] = I("post.c_wechat");
			$data['c_qq'] = I("post.c_qq");
			$data['c_remarks'] = I("post.c_remarks");
			$fileurl = "/uploads/user/" . substr(md5($this->member_id), 5, 15) . "/weixinimg";
			if(!empty($_POST['file'])){
				createFolder(APP_ROOT . $fileurl);
				$c_weixinimg = ExecUpload($_POST['file'], $_POST['old_file'], $fileurl);
				$data['c_weixinimg'] = $c_weixinimg;
			}

			$count = M("pano_card")->where(array("pano_id"=>$pano_id))->count();			
			if($count<=0){
				$data['pano_id'] = $pano_id;
				M("pano_card")->data($data)->add();
			}else{
				M("pano_card")->where(array("pano_id"=>$pano_id))->data($data)->save();
			}
			echo "<script>alert('修改成功！');window.location.href='".U("card", array("pano_id" => $pano_id))."';</script>";
            exit;
		}
		$cardinfo = M("pano_card")->where(array("pano_id"=>$pano_id))->find();
		$this->assign('cardinfo', $cardinfo);
		$this->display();
	}
	public function getpoint()
	{
		$this->display();
	}

}

?>
