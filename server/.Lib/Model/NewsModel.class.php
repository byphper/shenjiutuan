<?php
class NewsModel extends Model{
	protected $tableName='news';
	
	public function addNews($title,$con,$user){
		$date=date("Y-m-d H:i:s",time());
		$data=array("title"=>$title,"content"=>$con,"user"=>$user,"date"=>$date);
		$result=$this->data($data)->add();
		return $result?$result:false;
	}
	
	
}
