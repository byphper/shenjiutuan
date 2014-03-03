<?php
class BallAction extends BaseAction {

   public function cancel(){
     
      $refer=$_SERVER['HTTP_REFERER'];
      $user=$this->checkLogin();
      if(!$user){
          $this->alert($refer,"非法请求！");
          exit;
      }

      $id=$_GET["id"];
      if(!is_numeric($id)){
          $this->alert($refer,"非法请求！");
          exit;
      }
      $log=D("BallLog");
      $ldata=$log->getOne(array("id"=>$id),array("uid"));
      if(empty($ldata)&&$ldata[0]['uid']!=$user['id']){
         $this->alert($refer,"非法请求！");
          exit;
      }
     
      $result=$log->delOne(array("id"=>$id));
      if($result){
         $this->alert($refer,"取消成功!");
      }else{
         $this->alert($refer,"取消失败!");
      }


   }
    
    public function ballList(){
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $ballModel=D("Ball");
        $count=$ballModel->count();
        $data=$ballModel->getPage($page,13,"status!=0",'id desc',array("id","status","title","date"));
        $pager=new Page($count,13,"setPage","changePage"); 
        $showPager=$pager->fpage();
        if(empty($data)){
          $showPager="没有记录";
        }
        $this->assign('data',$data);
        $this->assign('pager',$showPager);
       
        $this->display();      

    }

    public function applydetails(){
         $id=$_GET['id'];
          if(!is_numeric($id)){
             exit;
          }
         $Ball=D("Ball");
         $data=$Ball->getOne(array("id"=>$id));
         if(empty($data)){
            $this->alert("../Ball/balllist","错误参数!");
         }

        
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
        $isVip=$_SESSION['user']['isVip'];
        /*if(!$isVip){
             $msg['status']=0;
             $msg['msg']="您不是內部會員";
              echo $this->echoJsonMsg($msg);
             exit;
        }*/

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
        $refer=$_SERVER['HTTP_REFERER'];

        $tid=$this->filter($_POST['tid']);

        if(!is_numeric($tid)){
            $this->alert($refer,"参数错误！");
            exit;
        }
        $ball=D("Ball");
        $ballInfo=$ball->getOne(array("id"=>$tid),array("status"));
       
        if($ballInfo[0]['status']!=1){
            $this->alert($refer,"参数错误！");
            exit;
        }    
        /*if($ballInfo[0]['openObject']){
             $isVip=$_SESSION['user']['isVip'];
             if(!$isVip){
              $this->alert($refer,"您还不是内部会员！");
               exit;
              }
        }*/

        $watch_nums=$this->filter($_POST['watch_nums']);
        if(!is_numeric($watch_nums)&&($watch_nums>10||$watch_nums<1)){
            $this->alert($refer,"参数错误！");
            exit;
        }
        $ticket_nums=$this->filter($_POST['ticket_nums']);
        if(!is_numeric($ticket_nums)&&($ticket_nums>10||$ticket_nums<1)){
            $this->alert($refer,"参数错误！");
            exit;
        }
        $car_nums=$this->filter($_POST['car_nums']);
        $goadd=$this->filter($_POST['goadd']);
        $style=$this->filter($_POST['style']);

        if($style==1){
            if(!is_numeric($car_nums)&&($car_nums>10||$car_nums<1)){
                $this->alert($refer,"参数错误！");
                exit;
            }
            if(empty($goadd)){
                  $this->alert($refer,"请选择上车地点");
                exit;
            }
        }else{
            $goadd="不跟车";
            $car_nums=0;
        }
        $uid=$_SESSION['user']['id'];
        $nickname=$_SESSION['user']['nickname'];
        $date=date("Y-m-d H:i:s",time());
        $title=$this->filter($_POST['title']);
        $remark=$this->filter($_POST['remark']);
        $data=array("remark"=>$remark,"status"=>1,"title"=>$title,"date"=>$date,"nickname"=>$nickname,"tid"=>$tid,"uid"=>$uid,"watch_nums"=>$watch_nums,"ticket_nums"=>$ticket_nums,"style"=>$style,"car_nums"=>$car_nums,"goadd"=>$goadd);
        
        $log=D("BallLog");
        $result=$log->addData($data);
        if($result){
              $this->alert("../User/balldeatils","报名成功!");
        }else{
             $this->alert($refer,"报名失败!");
        }
    }
   

}