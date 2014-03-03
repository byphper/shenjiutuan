<?php

class UserAction extends BaseAction {

	public function __construct(){
		
	}

	public function changePwdPost(){
		$refer=$_SERVER['HTTP_REFERER'];
		$user=$this->checkLogin();
		if(empty($user)){
			 $this->alert($refer,"非法请求");
        	  exit;
		}

		$old=$this->filter($_POST['old']);
		$new1=$this->filter($_POST['new1']);
		$new2=$this->filter($_POST['new2']);
		$userModel=D("User");
		$dbuser=$userModel->getOne(array("id"=>$user['id'],"pwd"=>md5($old)));
		if(empty($dbuser)){
			$this->alert($refer,"旧密码不正确");
        	exit;
		}
		if((empty($new1)&&strlen($new1)<6)||(empty($new2)&&strlen($new2)<6)){
				
				$this->alert($refer,"密码长度至少6位");
				exit;
		}else if($new1!==$new2){
				$this->alert($refer,"两次密码不一致");
				exit;
		}

		if($old==$new1){
			$this->alert($refer,"新密码不能原密码相同");
			exit;
		}
		$result=$userModel->changePwd($user['email'],$new1);
		if(!$result){
			$this->alert($refer,"更新失败");
		}else{
			$_SESSION=array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),'',time()-3600,'');
			}
			session_destroy();
			$this->alert($refer,"更新成功");
		}
	
	}

	public function changepwd(){
		$uid=$_SESSION['user']['id'];
		if(empty($uid)){
			 $this->assign("lui","true");
			 $this->display();
			 exit;
		}
		$this->display();
	}

	public function partydeatils(){
		import("ORG.Util.Page");
		$uid=$_SESSION['user']['id'];
		if(empty($uid)){
			 $this->assign("lui","true");
			 $this->display();
			 exit;
		}
		$this->assign("lui","false");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $log=D("PartyLog");
        $count=$log->customCount("uid=".$uid);

        $data=$log->getPage($page,8,"",'id desc',array("id","status","title","date"));
        $pager=new Page($count,8,"setPage","changePage"); 
        $this->assign('data',$data);
       	$showPager=$pager->fpage();
       	if(empty($data)){
       		$showPager="没有记录";
       	}
        $this->assign('pager',$showPager);
		$this->display();
	}

	public function balldeatils(){
		import("ORG.Util.Page");
		$uid=$_SESSION['user']['id'];
		if(empty($uid)){
			 $this->assign("lui","true");
			 $this->display();
			 exit;
		}
		 $this->assign("lui","false");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $log=D("BallLog");
        $count=$log->customCount("uid=".$uid);

        $data=$log->getPage($page,8,array("uid"=>$uid),'id desc',true);
        $pager=new Page($count,8,"setPage","changePage"); 
        $this->assign('data',$data);
       	$showPager=$pager->fpage();
       	if(empty($data)){
       		$showPager="没有记录";
       	}
        $this->assign('pager',$showPager);
		$this->display();
	}

	public function loginout(){
		
		if(isset($_SESSION['user'])&&!empty($_SESSION['user'])){
			$_SESSION=array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),'',time()-3600,'');
			}
			session_destroy();
		}
		$refer="../index.php";
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