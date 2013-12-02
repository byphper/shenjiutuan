<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		$data=array(
		'name'=>'矿拽龙少吊炸天',
		'age'=>12,
		'address'=>'海淀区',
		'tel'=>'3838518'
		);
		
		echo json_encode($data);
	}


	public function add(){
		$_PUT=array();
		echo file_get_contents('php://input');

	}
}