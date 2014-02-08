<?php
class AdminAction extends BaseAction {
	
	public function __construct(){
		header('Content-Type: text/html; charset=utf-8');
		session_start();
		if(!isset($_SESSION['user'])&&$_SESSION['user']['admin']!=1){
			echo  "非法操作!";
			exit;
		}
	}
	
}