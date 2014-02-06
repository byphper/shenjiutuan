<?php
abstract class BaseModel extends Model{

	public function updateFiled($setFiled,$where){

		 if(!is_array($setFiled)||empty($setFiled)){
			return false;
		 }
		$whereString=$this->getWhere($where);

		$result=$this->where($whereString)->data($setFiled)->save();
		return $result;
	}

	public function getAll(){
		$data=$this->select();
		return empty($data)?false:$data;
	}
	
	
	public function getPage($page,$nums,$where,$order,$filed=true){
		if(empty($page)||empty($nums)){
			return false;
		}
		$whereString=$this->getWhere($where);
		
		return $this->where($whereString)->page($page,$nums)->field($filed)->order($order)->select();
	}

	public function getOne($where,$filed=true){
		$whereString=$this->getWhere($where);
		$data=$this->where($whereString)->field($filed)->limit(0,1)->select();
		return empty($data)?false:$data;
	}

	public function delOne($where){
		$whereString=$this->getWhere($where);
		if(empty($whereString)){
			return false;
		}
		$result=$this->where($whereString)->delete();
		return $result;

	}

	private function getWhere($where){
		 if(is_array($where)&&!empty($where)){
		 	$whereString="";
		 	foreach ($where as $key => $value) {
		 		$whereString.=$key."='{$value}' and ";
		 	}
		 	$whereString=substr($whereString, 0,strripos($whereString,"and"));
		 	return $whereString;
		 }
		 return false;
	}

	public function addData($data=array()){
		if(!empty($data)){
			return $this->add($data);
		}
	}

}
