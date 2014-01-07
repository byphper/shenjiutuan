<?php

class UserAction extends BaseAction {

    public function checkUser() {
        if ($this->isPost()) {
            $user=$this->filter($_POST['email']);
            $pwd=$this->filter($_POST['pwd']);
            if (empty($user)) {
                $this->alert("用户名不能为空!","../../../sjt/login.php");
            }
            elseif(empty($pwd)) {
                $this->alert("密码不能为空!","../../../sjt/login.php");
            }
            else {
                $isAdmin=intval($_POST['isAdmin'])?1:0;
                $userModel=D("User");
                if ($userModel->checkUserExists($user,$isAdmin)) {
                    if ($userinfo=$userModel->finalCheck($user,$pwd,$isAdmin)) {
                        $this->setSession('user',$userinfo);
						
                        header("location:../../../sjt/main.php");
                    } else {
                        $this->alert("用户名或者密码错误!","../../../sjt/login.php");
                    }
                } else {
                    $this->alert("用户不存在!","../../../sjt/login.php");
                }
            }
        } else {
            $this->alert("非法提交!","../../../sjt/login.php");
            exit;

        }
    }
	
	public function loginout(){
		session_start();
		if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
			$_SESSION=array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),'',time()-3600,'/');
			}
			session_destroy();
		}
		header("location:../../../sjt/login.php");
	}


}