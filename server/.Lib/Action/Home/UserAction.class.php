<?php

class UserAction extends BaseAction {

	public function __construct(){
		
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
		$refer=$_SERVER['HTTP_REFERER'];
		header("location:$refer");
	}


	public function login(){
		$msg=array('status'=>1,'msg'=>'');
		$user=$_POST['lemail'];
		if(empty($user)||!filter_var($user,FILTER_VALIDATE_EMAIL)){
			$msg['status']=0;
			$msg['msg']='邮箱不合法';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		$pwd=$this->filter($_POST['lpwd']);
		if(empty($pwd)||strlen($pwd)<6){
			$msg['status']=0;
			$msg['msg']='密码错误';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		$userModel=D("User");
		if(!$userModel->checkUserExists($user)){
			$msg['status']=0;
			$msg['msg']='用户不存在';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		$result=$userModel->finalCheck($user,$pwd,false);
		if($result===false){
			$msg['status']=0;
			$msg['msg']='用户名或者密码错误';
			echo $this->echoJsonMsg($msg);
			exit;
		}else{
			$msg['status']=1;
		}
		$lrem=$_POST['lrem'];
		if($lrem!='false'){
			setcookie('email',$user,time()+3600*24*360);
			setcookie('pwd',$pwd,time()+3600*24*360);
		}else{
			setcookie('email','',time()-3600);
			setcookie('pwd','',time()-3600);
		}
		$userModel->updateFiled(array("last_ip"=>$this->get_ip(),"last_date"=>date("Y-m-d H:i:s"),time()),array("email"=>$result['email'],"id"=>$result["id"]));
		if(!isset($_SESSION['user'])&&empty($_SESSION['user'])){
			$this->setSession('user',$result);
		}
		echo $this->echoJsonMsg($msg);

	}

	public function regist(){
		$msg=array('status'=>1,'msg'=>'');
		$user=$this->filter($_POST['remail']);
		$pwd=$this->filter($_POST['rpwd']);
		$nick=$this->filter($_POST['rnick']);
		$userModel=D("User");
		if(empty($user)||!filter_var($user,FILTER_VALIDATE_EMAIL)){
			$msg['status']=0;
			$msg['msg']='邮箱格式不正确';
			echo $this->echoJsonMsg($msg);
			exit;
		}else{
			$iuser=$userModel->getOne(array('email'=>$user),'id');
			if(!empty($iuser)){
				$msg['status']=0;
				$msg['msg']='该邮箱已经存在!';
				echo $this->echoJsonMsg($msg);
				exit;
			}

		}
		if($userModel->getOne(array("nickname"=>$nick),'id')){
			$msg['status']=0;
			$msg['msg']='该昵称已经存在';
			echo $this->echoJsonMsg($msg);
			exit;
		}

		if(empty($pwd)||strlen($pwd)<6){
			$msg['status']=0;
			$msg['msg']='密码错误';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		$data=array("email"=>$user,"pwd"=>md5($pwd),"nickname"=>$nick,"isVip"=>0,"isYear"=>0,"isAdmin"=>0,"joindate"=>date('Y-m-d H:i:s',time()),"status"=>1,"last_date"=>date('Y-m-d H:i:s',time()),"last_ip"=>$this->get_ip());
		$result=$userModel->addData($data);
		if($result!==false){
			$this->setSession('user',$data);
		}

		$msg['status']=1;
		echo $this->echoJsonMsg($msg);

	}

}