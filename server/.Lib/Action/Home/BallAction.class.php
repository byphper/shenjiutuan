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
         $id=$_GET['id'];
          if(!is_numeric($id)){
             exit;
          }
         $Ball=D("Ball");
         $data=$Ball->getOne(array("id"=>$id));
        $this->assign('data',$data);
       
        $this->display();   
    }


    public function applycheck(){
        $msg=array();
        if(!isset($_SESSION['user'])||empty($_SESSION['user'])){
            $msg['status']=0;
            $msg['msg']="您还没有登陆";
            echo $this->echoJsonMsg($msg);
            exit;
        }
        
        $id=$_GET['id'];
        if(!is_numeric($id)){
             $msg['status']=0;
             $msg['msg']="信息错误";
              echo $this->echoJsonMsg($msg);
             exit;
        }
        $ballModel=D("Ball");
        $ball=$ballModel->getOne(array("id"=>$id));
        if($ball[0]['status']!=1){
             $msg['status']=0;
             $msg['msg']="信息错误";
             echo $this->echoJsonMsg($msg);
             exit;
        }
        $uid=$_SESSION['user']['id'];
        $logModel=D("BallLog");
        $log=$logModel->getOne(array("tid"=>$id,"uid"=>$uid));
        
        if(!empty($log)){
             $msg['status']=0;
             $msg['msg']="您已经报名，请勿重复报名！";
        }else{
             $msg['status']=1;
        }
         echo $this->echoJsonMsg($msg);
    }

    public function addBallLog(){

    }
   

}