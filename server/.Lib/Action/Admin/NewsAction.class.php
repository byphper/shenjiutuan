<?php
// 本类由系统自动生成，仅供测试用途
class NewsAction extends BaseAction {

    public function add() {
			$title=$this->filter($_POST['title']);
            $con=$this->filter($_POST['con']);
			$msg=array();
            if (empty($title)) {
				$msg['status']=-1;
            }
            elseif(empty($con)) {
                $msg['status']=-2;
            }
            else {
               $newsModel=D("News");
			   $user=$_SESSION['user']['nickname'];
			   $result=$newsModel->addNews($title,$con,$user);
			   $msg['status']=$result?1:0;
            }
			echo $this->echoJsonMsg($msg);
    }

}