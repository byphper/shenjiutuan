<?php

class BallAction extends AdminAction{

	function add(){
		$post=$this->getInputData();
		$title=$this->filter($post['title']);
		$time=$this->filter($post['match_time']);
		$op=$this->filter($post['match_op']);
		$address=$this->filter($post['match_address']);
		$tc=$this->filter($post['ticket_cost']);
		$cc=$this->filter($post['car_cost']);
		$status=$this->filter($post['status']);
    $openObject=$this->filter($post['openObject']);
    $remark=$this->filter($post['remark']);
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

		$data=array("remark"=>$remark,"openObject"=>intval($openObject),"title"=>$title,"match_time"=>$time,"match_op"=>$op,"match_address"=>$address,"ticket_cost"=>$tc,"car_cost"=>$cc,"status"=>$status,"date"=>date("Y-m-d H:i:s",time()));
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
		 $id=$_GET['id'];
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
         $id=$post['id'];
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
            if($post['status']==2){
              $log=D("BallLog");
              $log->updateFiled(array("status"=>0),array("tid"=>$id,"status"=>1));
            }
            $msg['status']=1;
            $msg['msg']="修改成功";
        }
      
        echo $this->echoJsonMsg($msg);

    }

    public function del(){
    	 $id=$_GET['id'];
          if(!is_numeric($id)){
             echo "-1";
          }
          $BallModel=D("Ball");   
          $resulst=$BallModel->delOne(array("id"=>$id));
          if(!empty($resulst)){
             echo "1";
          }
    }

    public function ballLog(){
    	    $id=$_GET['id'];
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $ballLog=D("BallLog");
         $data=$ballLog->getAll(array("tid"=>$id,"status"=>1));
         $BallModel=D("Ball"); 
         $title=$BallModel->getOne("id=".$id,array("title","id"));
         $total=$ballLog->query("select sum(ticket_nums) as totalT,sum(car_nums) as totalC,sum(watch_nums) as totalW from ticket_logs where tid=$id and status=1");
         $result=array("title"=>$title,"data"=>$data,"total"=>$total);
         if(empty($data)){
         	echo "-1";
         }else{
         	echo $this->echoJsonMsg($result);
         }

    }

    public function downloadlog(){
      $id=$_GET['id'];
      $string="";
      $ballLog=D("BallLog");
      $data=$ballLog->getAll(array("tid"=>$id,"status"=>1));
    
      $BallModel=D("Ball"); 
      $title=$BallModel->getOne($data['tid'],array("title","id"));
      $total=$ballLog->query("select sum(ticket_nums) as totalT,sum(car_nums) as totalC,sum(watch_nums) as totalW from ticket_logs where tid=$id and status=1");
      $result=array("title"=>$title,"data"=>$data,"total"=>$total);
      $string.="昵称,看球人数,球票数,跟车人数,上车地点,是否付款,备注,日期\r\n";
      foreach ($data as $key => $value) {
          $pay=$value['isPay']==1?'已付款':'未付款';
          $remark=$value['remark']?$value['remark']:" ";
          $string.="{$value['nickname']},{$value['watch_nums']},{$value['ticket_nums']},{$value['car_nums']},{$value['goadd']},{$pay},{$remark},{$value['date']}\r\n";
      }
     
      $filename=$title[0]['title'].".csv";
      $string.="总看球人数:{$total[0]['totalW']}\r\n总票数:{$total[0]['totalT']}\r\n总跟车人数:{$total[0]['totalC']}\r\n";
      Header("Content-type: application/octet-stream");
      Header("Accept-Ranges: bytes");
      Header("Accept-Length: ".strlen($string));
      Header("Content-Disposition: attachment; filename=" . $filename);
      echo $string;

    }

    public function getOneBallLog(){
    	$id=$_GET['id'];
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $ballLog=D("BallLog");
         $data=$ballLog->getOne(array("id"=>$id));
         if(empty($data)){
         	echo "-1";
         }else{
         	echo $this->echoJsonMsg($data);
         }
    }

    public function updatelog(){
         $post=$this->getInputData();
         $msg=array();
         $id=$post['id'];
          if(!is_numeric($id)){
              $msg['status']=0;
              $msg['msg']="修改失敗";
          }

        $balllogModel=D("BallLog");
        $result=$balllogModel->updateFiled($post,array("id"=>$id));
        if($result==false){
            $msg['status']=0;
            $msg['msg']="修改失敗";
        }else{
            $msg['status']=1;
            $msg['msg']="修改成功";
        }
      
        echo $this->echoJsonMsg($msg);
    }


     public function dellog(){
         $id=$_GET['lid'];
          if(!is_numeric($id)){
             echo "-1";
          }
          $BallLog=D("BallLog");   
          $resulst=$BallLog->delOne(array("id"=>$id));
          if(!empty($resulst)){
             echo "1";
          }
    }


  
}