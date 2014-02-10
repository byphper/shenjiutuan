<?php
class BallAction extends BaseAction {

    
    public function ballList(){
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $ballModel=D("Ball");
        $count=$ballModel->count();
        $data=$ballModel->getPage($page,10,'','id desc',array("id","title","date"));
        $pager=new Page($count,10,"setPage","changePage"); 
        $this->assign('data',$data);

        $this->display();      

    }

    public function getOneNews(){
         $id=intval($_GET['id']);
          if(!is_numeric($id)){
             exit;
          }
         $newsModel=D("News");
         $data=$newsModel->getOne(array("id"=>$id));
         $newsModel->updateFiled(array("views"=>$data[0]['views']+1),array("id"=>$id));
        $this->assign('data',$data);

        $this->display();  

       
    }


   

}