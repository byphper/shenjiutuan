<?php

class PartyAction extends AdminAction{

	function add(){
		$post=$this->getInputData();
		$title=$this->filter($post['title']);
		$status=$this->filter($post['status']);
		$content=$this->filter($post['content']);
		$msg=array();
		if(empty($title)||empty($content)){
			$msg['status']=0;
			$msg['msg']='请填写完整聚会信息';
			echo $this->echoJsonMsg($msg);
			exit;
		}
		if(!is_numeric($status)){
			$msg['status']=0;
			$msg['msg']='信息不合法';
			echo $this->echoJsonMsg($msg);
			exit;
		}

		$data=array("title"=>$title,"content"=>$content,"status"=>$status,"date"=>date("Y-m-d H:i:s",time()));
		$partyModel=D("Party");
		$result=$partyModel->addData($data);
		if($result!==false){
			$msg['status']=1;
		}else{
			$msg['status']=0;
			$msg['msg']='操作失败';
		}
		echo $this->echoJsonMsg($msg);

	}

	public function getOneParty(){
		 $id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $partyModel=D("Party");
         $data=$partyModel->getOne(array("id"=>$id));
       
         if(!empty($data)){
            echo $this->echoJsonMsg($data);
         }
	}

	public function ajaxGetParty(){
        header('Content-Type: text/html; charset=utf-8');
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $ballModel=D("Party");
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
               echo $this->echoJsonMsg($msg);
               exit;
          }

        $partyModel=D("Party");
        $result=$partyModel->updateFiled($post,array("id"=>$id));
        if($result==false){
            $msg['status']=0;
            $msg['msg']="修改失敗";
        }else{
            $msg['status']=1;
            $msg['msg']="修改成功";
        }
      
        echo $this->echoJsonMsg($msg);

    }

    public function del(){
    	 $id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
          }
          $partyModel=D("Party");   
          $resulst=$partyModel->delOne(array("id"=>$id));
          if(!empty($resulst)){
             echo "1";
          }
    }

    public function partylog(){
    	$id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $partyLog=D("PartyLog");
         $data=$partyLog->getAll(array("pid"=>$id));
         $partyModel=D("Party"); 
         $title=$partyModel->getOne($data['tid'],array("title","id"));
         $result=array("title"=>$title,"data"=>$data);
         if(empty($data)){
         	echo "-1";
         }else{
         	echo $this->echoJsonMsg($result);
         }

    }

    public function getonepartylog(){
    	$id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
             exit;
          }
         $PartyLog=D("PartyLog");
         $data=$PartyLog->getOne(array("id"=>$id));
         if(empty($data)){
         	echo "-1";
         }else{
         	echo $this->echoJsonMsg($data);
         }
    }

     public function dellog(){
         $id=intval($_GET['lid']);
          if(!is_numeric($id)){
             echo "-1";
          }
          $PartyLog=D("PartyLog");   
          $resulst=$PartyLog->delOne(array("id"=>$id));
          if(!empty($resulst)){
             echo "1";
          }
    }

    public function updatelog(){
        $post=$this->getInputData();
         $msg=array();
         $id=intval($post['id']);
          if(!is_numeric($id)){
              $msg['status']=0;
              $msg['msg']="修改失敗";
          }
        if(!is_numeric($post['nums'])){
              $msg['status']=0;
              $msg['msg']="人数必须为数字";
               echo $this->echoJsonMsg($msg);
               exit;
        }
        $partylog=D("PartyLog");
         $result=$partylog->updateFiled($post,array("id"=>$id));
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