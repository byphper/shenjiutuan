<?php

class IndexAction extends Action{

	public function index(){
		$this->display();
	}

	public function about(){
		$aboutModel=D("About");
        $adata=$aboutModel->getOne(array("id"=>'1'));
      
        $this->assign("data",$adata);
        
		$this->display();
	}
}