<?php

class UserAction extends BaseAction {

	public function __construct(){
		
	
	}

	/**
	*	帳號檢測
	*/
    public function checkAdminUser() {
        if ($this->isPost()) {
            $user=$this->filter($_POST['email']);
            $pwd=$this->filter($_POST['pwd']);
			
            if (empty($user)) {
                $this->alert(BACKPATH."login.php","用户名不能为空!");
            }
            elseif(empty($pwd)) {
                $this->alert(BACKPATH."login.php","密码不能为空!");
            }
            else {
                $isAdmin=intval($_POST['isAdmin'])?1:0;
                $userModel=D("User");
				
                if ($userModel->checkUserExists($user,$isAdmin)) {
                    if ($userinfo=$userModel->finalCheck($user,$pwd,$isAdmin)) {
						if($userinfo['isAdmin']!=1){
							 $this->alert(BACKPATH."login.php","你不是管理員用戶!");
							 exit;
						}
                        $this->setSession('user',$userinfo);
                        $userModel->updateFiled(array("last_ip"=>$this->get_ip(),"last_date"=>date("Y-m-d H:i:s"),time()),array("email"=>$userinfo['email'],"id"=>$userinfo["id"]));

                        header("location:".BACKPATH."main.php");

                    } else {
                        $this->alert(BACKPATH."login.php","用户名或者密码错误!");
                    }
                } else {
                    $this->alert(BACKPATH."login.php","用户不存在!");
                }
            }
        } else {
            $this->alert(BACKPATH."login.php","非法提交!");
            exit;

        }
    }
	
	/**
	*	帳號退出
	*/
	public function loginout(){
		
		if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
			$_SESSION=array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),'',time()-3600,'');
			}
			session_destroy();
		}
		header("location:".BACKPATH."login.php");
	}

	/**
	*	修改密碼
	*/
	public function  changePwd(){
		
		if($this->isPost()){
			$_POST=$this->getInputData();
			$old=$this->filter($_POST['old']);
            $new1=$this->filter($_POST['new1']);
            $new2=$this->filter($_POST['new2']);
			$msg=array("result"=>"0");
			if(empty($old)&&strlen($old)<6){
				$msg['msg']="密码错误";
				echo $this->echoJsonMsg($msg);
				exit;
			}
			
			if((empty($new1)&&strlen($new1)<6)||(empty($new2)&&strlen($new2)<6)){
				
				$msg['msg']="请输入6位以上密码";
				echo $this->echoJsonMsg($msg);
				exit;
			}else if($new1!==$new2){
				$msg['msg']="两次密码不一致!";
				echo $this->echoJsonMsg($msg);
				exit;
			}
			
			if(md5($old)!==$_SESSION['user']['pwd']){
				$msg['msg']="密码错误!";
				echo $this->echoJsonMsg($msg);
				exit;
			}
			$userModel=D("User");
			$result=$userModel->changePwd($_SESSION['user']['email'],$new1);
			if(!$result){
				$msg['result']=0;
				$msg['msg']="更新失敗!";
			}else{
				$msg['result']=1;
			}
			
			echo $this->echoJsonMsg($msg);
		}
	}
	
	public function ajaxGetUsers(){
		 header('Content-Type: text/html; charset=utf-8');
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $userModel=D("User");
        $count=$userModel->count();
        $data=$userModel->getPage($page,15,array("status"=>1),true);
        $pager=new Page($count,15,"setPage","changePage");

        $data=array("data"=>$data,"page"=>$pager->fpage());
        echo $this->echoJsonMsg($data);

	}


}