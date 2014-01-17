<?php
abstract class BaseModel extends Model{

	public function updateFiled($setFiled,$where){

		 if(!is_array($setFiled)||empty($setFiled)){
			return false;
		 }
		 if(is_array($where)&&!empty($where)){
		 	$whereString="";
		 	foreach ($where as $key => $value) {
		 		$whereString.=$key."='{$value}' and ";
		 	}
		 	$whereString=substr($whereString, 0,strripos($whereString,"and"));
		 }

		$result=$this->where($whereString)->data($setFiled)->save();
		return $result===false?false:true;
	}

	public function getAll(){
		$data=$this->select();
		return empty($data)?false:$data;
	}
}
