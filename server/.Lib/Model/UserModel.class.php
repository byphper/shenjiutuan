<?php
class UserModel extends Model{
	protected $tableName='userinfo';
	
	/**
		�ж��û��Ƿ����
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
}
