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
	
	
	public function finalCheck($user,$pwd,$isAdmin){
		 $pwd=md5($pwd);

		 $userinfo=$this->where("email='{$user}' and pwd='{$pwd}' and isAdmin='{$isAdmin}'")->find();
		 return empty($userinfo)?false:$userinfo;
	}
	
	public function changePwd($user,$pwd){
		$pwd=md5($pwd);
		$data=array("pwd"=>$pwd);
		$result=$this->where("email='{$user}'")->data($data)->save(); 
		
		return $result===false?false:true;

	}
	
}
