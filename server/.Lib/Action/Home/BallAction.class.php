<?php
class BallAction extends BaseAction {

    
    public function ballList(){
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $ballModel=D("Ball");
        $count=$ballModel->count();
        $data=$ballModel->getPage($page,10,"status!=0",'id desc',array("id","status","title","date"));
        $pager=new Page($count,10,"setPage","changePage"); 
        $this->assign('data',$data);
       
        $this->display();      

    }

    public function applydetails(){
         $id=intval($_GET['id']);
          if(!is_numeric($id)){
             exit;
          }
         $Ball=D("Ball");
         $data=$Ball->getOne(array("id"=>$id));
        $this->assign('data',$data);
       
        $this->display();  

       
    }


   

}