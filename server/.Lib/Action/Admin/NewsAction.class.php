<?php
// 本类由系统自动生成，仅供测试用途
class NewsAction extends BaseAction {

    public function add() {

			$_POST=$this->getInputData();
            $con=$_POST['content'];
            $title=$this->filter($_POST['title']);
            $isPublic=isset($_POST['isPublic'])?$_POST['isPublic']:false;
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
               }else{
                    $msg['status']=0;
                    $msg['msg']="添加失败";
               }
            }
			echo $this->echoJsonMsg($msg);
    }

    public function showNews(){
        header('Content-Type: text/html; charset=utf-8');
        $newsModel=D("News");
        $news=$newsModel->getAll();
        foreach ($news as $key => $value) {
            echo $value['content'];
        }
    }

}