<?php
class NewsModel extends BaseModel{
	protected $tableName='news';
	
	public function addNews($title,$con,$user,$status){
		$date=date("Y-m-d H:i:s",time());
		$data=array("title"=>$title,"content"=>$con,"user"=>$user,"date"=>$date,"status"=>$status);
		$result=$this->data($data)->add();
		return $result?$result:false;
	}
	
}
