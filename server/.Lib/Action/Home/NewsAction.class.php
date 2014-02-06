<?php
class NewsAction extends BaseAction {

    
    public function newsList(){
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $newsModel=D("News");
        $count=$newsModel->count();
        $data=$newsModel->getPage($page,10,array("status"=>1),'id desc',array("id","title","status","date"));
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