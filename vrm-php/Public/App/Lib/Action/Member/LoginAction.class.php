<?php

class LoginAction extends Action {

    public function index() {
        if (I("post.dopost") == "login") {
            if (empty($_POST['userid'])) {
                $this->error('请输入帐号！');
            } else if (empty($_POST['pwd'])) {
                $this->error('密码必须！');
            }
            $adminName = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $_POST['userid']);
            $adminPwd = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $_POST['pwd']);
            $pwd = substr(md5($adminPwd), 5, 20);
            $map = array(
                "account" => $adminName
            );
            $row = M("Member")->where($map)->find();
            if (!is_array($row)) {
                $result = 0;
            } else if ($row['password'] != $pwd) {
                $result = -1;
            } else {
                $result = 1;
            }
			
			if($row['status']==3)
			{
				$this->error('此帐号已禁用！');
				exit;
			}

            if ($result == 0) {
                $this->error('没有此帐号！');
            } else if ($result == -1) {
                $this->error('密码错误！');
            } else {
                session(C("SESSION_MEMBERID"), $row['id']);
                $map = array(
                    "id" => $row['group_id']
                );
                session(C("SESSION_NAME"), $row['nickname']);
                $grow = M("Member_group")->where($map)->find();
                if (is_array($grow)) {
                    session(C("SESSION_POWER"), $grow['grouppower']);
                    session(C("SESSION_POWER_NAME"), $grow['groupname']);
                } else {
                    session(C("SESSION_POWER"), "");
                    session(C("SESSION_POWER_NAME"), "");
                }

                $editarr = array(
                    "last_login_time" => time(),
                    "last_login_ip" => get_client_ip()
                );
                M("Member")->where("id={$row['id']}")->save($editarr);
                $this->redirect('index/index');
            }
            exit();
        }
        $this->display();
    }

    public function auto() {
        if ($_GET['from'] != "") {
            $getwhere = array(
                "key" => $_GET['from']
            );
            $getrow = M("Admin_login")->where($getwhere)->find();
            if (is_array($getrow)) {
                $where = array(
                    "account" => $getrow['user_account'],
                    "password" => $getrow['user_pwd'],
                );
                $row = M("Member")->where($where)->find();
                M("Admin_login")->where($getwhere)->delete();
                if (is_array($row)) {
                    session(C("SESSION_MEMBERID"), $row['id']);
                    $map = array(
                        "id" => $row['group_id']
                    );
                    session(C("SESSION_NAME"), $row['nickname']);
                    $grow = M("Member_group")->where($map)->find();
                    if (is_array($grow)) {
                        session(C("SESSION_POWER"), $grow['grouppower']);
                        session(C("SESSION_POWER_NAME"), $grow['groupname']);
                    } else {
                        session(C("SESSION_POWER"), "");
                        session(C("SESSION_POWER_NAME"), "");
                    }

                    $editarr = array(
                        "last_login_time" => time(),
                        "last_login_ip" => get_client_ip()
                    );
                    M("Member")->where("id={$row['id']}")->save($editarr);
                    $this->redirect('index/index');
                }
            }
        }
    }

    public function logout() {
        $tag_userid = C("SESSION_MEMBERID");
        if (isset($_SESSION[$tag_userid])) {
            unset($_SESSION[$tag_userid]);
            unset($_SESSION);
            session_destroy();
        }
        $this->success('登出成功', U("index/index"));
    }

}

?>
