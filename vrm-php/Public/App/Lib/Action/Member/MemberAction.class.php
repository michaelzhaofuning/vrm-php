<?php

class MemberAction extends Action{

    var $member_id = "";
    var $menuList = "";

    public function _initialize() {
        $member_pix = C("SESSION_MEMBERID");
        $this->member_id = $_SESSION[$member_pix];

        if (!$this->member_id > 0) {
            $this->redirect("login/index");
        }
		$pano_id = intval($_REQUEST['pano_id']);
		if(!empty($pano_id)){
			$panorow = D("Pano")->GetOne($pano_id, $this->member_id);
			$this->assign('pano_id', $pano_id);
			$this->assign('panorow', $panorow);
		}
        $this->menuList = '            
            <menu:top name="全景项目" open="1" ico="ico2.png" rank="">
                <menu:item name="全景项目管理" link="panolist/index" rank="" />
                <menu:item name="全景热点管理" link="makespot/index" rank="" />
                <menu:item name="背景音乐管理" link="musicstore/index" rank="" />
                <menu:item name="鼠标样式管理" link="makecursor/index" rank="" />
				<menu:item name="导航样式管理" link="daohang/manage" rank="" />
                <menu:item name="UI模块管理" link="uistore/index" rank="" />
            </menu:top>
			<menu:top name="我的账户" open="1" ico="ico1.png" rank="">
                <menu:item name="帐号信息" link="user/index" rank="" />
            </menu:top>
			<menu:top name="微信说一说" open="1" ico="ico7.png" rank="">
                <menu:item name="微信配置" link="weixin/index" rank="" />
            </menu:top>
            ';
        $this->pano = array(
            "front","back","left","right","up","down"
        );
        $this->mbpano = array(
            "f","b","l","r","u","d"
        );
    }
}

?>
