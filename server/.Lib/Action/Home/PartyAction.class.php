<?php
class PartyAction extends BaseAction {

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
    
    public function partyList(){
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
       
        $ballModel=D("Party");
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

     public function partydeatils(){
         $id=$_GET['id'];
          if(!is_numeric($id)){
             exit;
          }
         $Party=D("Party");
         $data=$Party->getOne(array("id"=>$id));
         if(empty($data)){
            $this->alert("../Party/partydeatils","错误参数!");
         }
        $data[0]['content']=nl2br($data[0]['content']);
        $this->assign('data',$data);
        $this->display();   
    }


    public function applycheck(){
        $user=$this->checkLogin();
        $msg=array();
        if(!isset($user)||empty($user)){
            $msg['status']=0;
            $msg['msg']="您还没有登陆";
            echo $this->echoJsonMsg($msg);
            exit;
        }
        $isVip=$user['isVip'];
        if(!$isVip){
             $msg['status']=0;
             $msg['msg']="您不是內部會員";
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
        $Party=D("Party");
        $pdata=$Party->getOne(array("id"=>$id));
        if($pdata[0]['status']!=1){
             $msg['status']=0;
             $msg['msg']="信息错误";
             echo $this->echoJsonMsg($msg);
             exit;
        }
        $uid=$user['id'];
        $logModel=D("PartyLog");
        $log=$logModel->getOne(array("pid"=>$id,"uid"=>$uid));
        
        if(!empty($log)){
             $msg['status']=0;
             $msg['msg']="您已经报名，请勿重复报名！";
        }else{
             $msg['status']=1;
        }
         echo $this->echoJsonMsg($msg);
    }

    public function addpartylog(){
        $refer=$_SERVER['HTTP_REFERER'];
        $user=$this->checkLogin();
        if(!$user){
            $this->alert($refer,"请登录后再报名！");
            exit;
        }
        $isVip=$user['isVip'];
        if(!$isVip){
             $this->alert($refer,"您还不是内部会员！");
             exit;
        }

        $pid=$this->filter($_POST['pid']);

        if(!is_numeric($pid)){
            $this->alert($refer,"参数错误！");
            exit;
        }
        $party=D("Party");
        $partyinfo=$party->getOne(array("id"=>$pid),array("status"));

        if($partyinfo[0]['status']!=1){
            $this->alert($refer,"参数错误！");
            exit;
        }    
        $party_nums=$this->filter($_POST['party_nums']);

        if(!is_numeric($party_nums)&&($party_nums>10||$party_nums<1)){
            $this->alert($refer,"参数错误！");
            exit;
        }
        $uid=$user['id'];
        $nickname=$user['nickname'];
        $date=date("Y-m-d H:i:s",time());
        $title=$this->filter($_POST['title']);
        $data=array("title"=>$title,"status"=>1,"date"=>$date,"nickname"=>$nickname,"pid"=>$pid,"uid"=>$uid,"nums"=>$party_nums);
        $log=D("PartyLog");
        $result=$log->addData($data);
        if($result){
              $this->alert("../User/partydeatils","报名成功!");
        }else{
             $this->alert($refer,"报名失败!");
        }
    }
   

}