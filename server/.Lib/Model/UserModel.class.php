<?php
class UserModel extends BaseModel{

	protected $tableName='userinfo';
	
	/**
	*	判断用户是否存在
	*/
	public function checkUserExists($user,$admin=0){
		if($admin){
			$result=$this->where("email='{$user}' and isAdmin='{$admin}'")->getField('id');
		}else{
			$result=$this->where("email='{$user}'")->getField('id');
		}
		return empty($result)?false:true;
	}
	
	
	public function finalCheck($user,$pwd,$isAdmin=1){
		 $pwd=md5($pwd);
		 if($isAdmin){
		 	$userinfo=$this->where("email='{$user}' and pwd='{$pwd}' and status=1 and isAdmin='{$isAdmin}'")->find();
		 }else{
		 	$userinfo=$this->where("email='{$user}' and pwd='{$pwd}' and status=1")->find();
		 }
		 
		 return empty($userinfo)?false:$userinfo;
	}
	
	public function changePwd($user,$pwd){
		$pwd=md5($pwd);
		$data=array("pwd"=>$pwd);
		$result=$this->where("email='{$user}'")->data($data)->save(); 
		
		return $result===false?false:true;

	}
	
}
