<?php
class AboutAction extends BaseAction {

    public function add() {
            $post=$this->getInputData();
            $con=$post['content'];

            $aboutModel=D("About");
            $result=$aboutModel->updateFiled($post,array("id"=>'1'));
            if($result!==false){
               echo "1";
            }else{
               echo "0";
            }

    }

    public function get(){
        $aboutModel=D("About");
        $data=$aboutModel->getOne(array("id"=>'1'));
        $result=array("data"=>$data);
        echo $this->echoJsonMsg($result);
    }

   
}