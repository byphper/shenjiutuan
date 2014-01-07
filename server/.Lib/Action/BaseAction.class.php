<?php
// 本类由系统自动生成，仅供测试用途
class BaseAction extends Action {
    protected function filter($var){
		$var=filter_var($var, FILTER_SANITIZE_STRING);
		return filter_var($var, FILTER_SANITIZE_MAGIC_QUOTES);
	}
	
	protected function alert($msg,$url){
		header('Content-Type: text/html; charset=utf-8');
		echo "<script>alert('{$msg}');window.location.href='{$url}'</script>";
	}
	
	protected function setSession($name,$val){
		session_start();
		$_SESSION[$name]=$val;
	}
	
	protected function echoJsonMsg($msg=array()){
			if(is_array($msg)&&!empty($msg)){
				return json_encode($msg);
			}
			return false;
	}
}