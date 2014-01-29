<?php
class NewsAction extends BaseAction {

    public function add() {
            $post=$this->getInputData();
            $con=$post['content'];
            $title=$this->filter($post['title']);
            $isPublic=isset($post['isPublic'])?$post['isPublic']:false;
            $msg=array();
            if (empty($title)||empty($con)) {
                $msg['status']=0;
                $msg['msg']="标题或内容不能为空！";
            }else {
               $newsModel=D("News");
               $user=$_SESSION['user']['nickname'];
               $result=$newsModel->addNews($title,$con,$user,$isPublic);
               if($result){
                    $msg['status']=1;
                    $msg['msg']="添加成功";
               }else{
                    $msg['status']=0;
                    $msg['msg']="添加失败";
               }
            }
            echo $this->echoJsonMsg($msg);
    }

    public function ajaxGetNews(){
        header('Content-Type: text/html; charset=utf-8');
        import("ORG.Util.Page");
        $get=$_GET;
        $page=$get['page']?$get['page']:1;
        $state=$get['state'];
       
        $newsModel=D("News");
        $count=$newsModel->count();
        $data=$newsModel->getPage($page,15,'',array("id","title","status","date"));
        $pager=new Page($count,15,"setPage","changePage");

        $data=array("data"=>$data,"page"=>$pager->fpage());
        echo $this->echoJsonMsg($data);

    }

    public function getOneNews(){
         $id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
          }
         $newsModel=D("News");
         $data=$newsModel->getOne(array("id"=>$id));
         if(!empty($data)){
            echo $this->echoJsonMsg($data);
         }
    }


    public function delOneNews(){
          $id=intval($_GET['id']);
          if(!is_numeric($id)){
             echo "-1";
          }
          $newsModel=D("News");   
          $resulst=$newsModel->delOne(array("id"=>$id));
          if(!empty($resulst)){
             echo "1";
          }
    }

    public function update(){
         $post=$this->getInputData();
         $msg=array();
         $id=intval($post['id']);
          if(!is_numeric($id)){
              $msg['status']=0;
              $msg['msg']="修改失敗";
          }
        $post['status']=$post['isPublic']?1:0;

        $newsModel=D("News");
        $result=$newsModel->updateFiled($post,array("id"=>$id));
        if($result===false){
            $msg['status']=0;
            $msg['msg']="修改失敗";
        }else{
            $msg['status']=1;
            $msg['msg']="修改成功";
        }
        echo $this->echoJsonMsg($msg);

    }

}