<?php

class UserAction extends AdminAction{
    function index(){
        cookie("back", __SELF__);
        import('ORG.Util.Page'); // 导入分页类

        $mm = M("Member");
        $count = $mm->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 15); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $mm->order("id")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        foreach ($list as $k=>$li) {
            $panocount = M("Pano")->where(array("member_id"=>$li['id']))->count();
            $list[$k]['len'] = $panocount;
        }
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板
    }
	
	function add()
	{
		if ($_POST['dopost'] == "save")
		{
			$account = trim(I("post.userid"));
            $pwd = I("post.pwd");
            $nickname = I("post.user_name");
            $phone = I("post.phone");
            $email = I("post.email");
			$pano_limit = I("post.pano_limit");

            if ($account == "") {
                $this->error("用户名不能为空！");
                exit();
            } else {
                $map = array(
                    "account" => $account
                );
                $row = M("Member")->where($map)->find();
                if (is_array($row)) {
                    $this->error("帐号已经存在！");
                    exit();
                }
            }
            if ($pwd == "") {
                $this->error("密码不能为空！");
                exit();
            }
            if ($nickname == "") {
                $this->error("昵称不能为空！");
                exit();
            }
			$userpwd = substr(md5($pwd), 5, 20);
            $addmap = array(
                "account" => $account,
                "password" => $userpwd,
                "nickname" => $nickname,
                "phone" => $phone,
                "email" => $email,
				"pano_limit" => intval($pano_limit),
                "create_time" => time()
            );
            M("Member")->add($addmap);
			redirect("index");
            exit();
		}

		$this->display();	
	}
	
	function edit()
	{
		$id = intval($_REQUEST['id']);
		if ($_POST['dopost'] == "save")
		{
			$account = trim(I("post.userid"));
            $pwd = I("post.pwd");
            $nickname = I("post.user_name");
            $phone = I("post.phone");
            $email = I("post.email");
            $pano_limit = I("post.pano_limit");
			
            $addmap = array(
                "account" => $account,
                "nickname" => $nickname,
                "phone" => $phone,
                "email" => $email,
                "pano_limit" => intval($pano_limit)
            );
			if(!empty($pwd))
			{
				$userpwd = substr(md5($pwd), 5, 20);
				$addmap['password'] = $userpwd;
			}
			M("Member")->where(array("id"=>$id))->data($addmap)->save();
			$this->success("修改成功！", U("index"));
			exit;
		}
		$info = M("Member")->where(array("id"=>$id))->find();
		$this->assign("info", $info);
		$this->assign("id", $id);
		$this->display();
	}
	function useropened()
	{
		$id = intval(I("get.id"));
		if(!empty($id))
		{
			M("Member")->where(array("id"=>$id))->data(array("status"=>1))->save();
			$this->success("启用成功！", U("index"));
		}
	}
	function userdisabled()
	{
		$id = intval(I("get.id"));
		if(!empty($id))
		{
			M("Member")->where(array("id"=>$id))->data(array("status"=>3))->save();
			$this->success("禁用成功！", U("index"));
		}
	}


    function control(){
        if ($_GET['id'] != "") {
            $row = M("Member")->where("id=" . $_GET['id'])->find();

            import("ORG.Util.String");
            $key = String::randString(12);
            $data = array(
                "user_account" => $row['account'],
                "user_pwd" => $row['password'],
                "key" => $key
            );
            M("Admin_login")->add($data);
            $this->redirect("Member/login/auto",array("from"=>$key));
        }
    }
}

?>
