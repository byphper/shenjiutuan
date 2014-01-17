<?php
class BaseAction extends Action {
	
	public function __construct(){
		session_start();
	}

    protected function filter($var){
		$var=filter_var($var, FILTER_SANITIZE_STRING);
		return filter_var($var, FILTER_SANITIZE_MAGIC_QUOTES);
	}
	
	protected function alert($url,$msg=null){
		header('Content-Type: text/html; charset=utf-8');
		if(empty($msg)){
			header("location:".$url);
		}else{
			echo "<script>alert('{$msg}');window.location.href='{$url}'</script>";
		}
	}
	
	protected function setSession($name,$val){
		$_SESSION[$name]=$val;
	}
	
	protected function echoJsonMsg($msg=array()){
			if(is_array($msg)&&!empty($msg)){
				return json_encode($msg);
			}
			return false;
	}

	protected function checkUserLogin(){
		if(isset($_SESSION['user'])&&$_SESSION['user']!==null){
			return true;
		}else{
			return false;
		}
	}

	protected function getInputData(){
		$postdata = file_get_contents("php://input");
		return json_decode($postdata,true);
	}

	protected function get_ip() {
	     $ipaddress = '';
	     if (getenv('HTTP_CLIENT_IP'))
	         $ipaddress = getenv('HTTP_CLIENT_IP');
	     else if(getenv('HTTP_X_FORWARDED_FOR'))
	         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	     else if(getenv('HTTP_X_FORWARDED'))
	         $ipaddress = getenv('HTTP_X_FORWARDED');
	     else if(getenv('HTTP_FORWARDED_FOR'))
	         $ipaddress = getenv('HTTP_FORWARDED_FOR');
	     else if(getenv('HTTP_FORWARDED'))
	        $ipaddress = getenv('HTTP_FORWARDED');
	     else if(getenv('REMOTE_ADDR'))
	         $ipaddress = getenv('REMOTE_ADDR');
	     else
	         $ipaddress = 'UNKNOWN';

	     return $ipaddress; 
	}
}