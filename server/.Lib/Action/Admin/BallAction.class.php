<?php

class BallAction extends BaseAction{
	function add(){
		$post=$this->getInputData();
		$title=$this->filter($post['title']);
		$time=$this->filter($post['match_time']);
		$op=$this->filter($post['match_op']);
		$address=$this->filter($post['match_address']);
		$tc=$this->filter($post['ticket_cost']);
		$cc=$this->filter($post['car_cost']);
		$status=$this->filter($post['status']);
		$msg=array();
		if(empty($title)||empty($time)||empty($address)||empty($tc)||empty($cc)||empty($op)){
			$msg['status']=0;
			$msg['msg']='请填写完整比赛信息';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		if(!is_numeric($tc)||!is_numeric($cc)||!is_numeric($status)){
			$msg['status']=0;
			$msg['msg']='信息不合法';
			echo $this->echoJsonMsg($msg);
			exit;
		}

		$data=array("title"=>$title,"match_time"=>$time,"match_op"=>$op,"match_address"=>$address,"ticket_cost"=>$tc,"car_cost"=>$cc,"status"=>$status,"date"=>date("Y-m-d H:i:s",time()));
		$ballModel=D("Ball");
		$result=$ballModel->addData($data);
		if($result!==false){
			$msg['status']=1;
		}else{
			$msg['status']=0;
			$msg['msg']='操作失败';
		}
		echo $this->echoJsonMsg($msg);

	}

	public function getOneBall(){
		 $id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $ballModel=D("Ball");
         $data=$ballModel->getOne(array("id"=>$id));
       
         if(!empty($data)){
            echo $this->echoJsonMsg($data);
         }
	}

	public function ajaxGetBalls(){
        header('Content-Type: text/html; charset=utf-8');
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $ballModel=D("Ball");
        $count=$ballModel->count();
        $data=$ballModel->getPage($page,15,'','id desc');
        $pager=new Page($count,15,"setPage","changePage");

        $data=array("data"=>$data,"page"=>$pager->fpage());
        echo $this->echoJsonMsg($data);

    }


    public function update(){
         $post=$this->getInputData();
         $msg=array();
         $id=intval($post['id']);
          if(!is_numeric($id)){
              $msg['status']=0;
              $msg['msg']="修改失敗";
          }

        $ballModel=D("Ball");
        $result=$ballModel->updateFiled($post,array("id"=>$id));
        if($result==false){
            $msg['status']=0;
            $msg['msg']="修改失敗";
        }else{
            $msg['status']=1;
            $msg['msg']="修改成功";
        }
      
        echo $this->echoJsonMsg($msg);

    }
}