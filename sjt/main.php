<?php
session_start();
if(empty($_SESSION['user'])){
	header("location:login.php");
	exit;	
}
?>
<!doctype html>
<html ng-app="SjtBack">
<head>
	<title>深究团网站后台管理</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script src="../js/angular.js"></script>
	<script src="../js/jquery-1.9.1.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<script src="js/app.js"></script>
</head>
<body>

	<div id="all">
		<div id="header">
			<div id="h-left">深九团后台管理系统</div>
			<div id="user">
				欢迎您：
				<span style="color:#428BCA">
					<?php echo $_SESSION['user']['nickname']?></span>
				&emsp;
				<a href="../index.php/Admin/user/loginout">退出</a>
				&emsp;
				<a href="#modifyPwd">修改密码</a>
			</div>
			<div>
				
			</div>
		</div>

		<div id="con">
			<div id="left">
				<div class="list-group">
					<a href="#" class="list-group-item active">新闻公告</a>
					<a href="#" class="list-group-item">会员管理</a>
					<a href="#" class="list-group-item">组织看球</a>
					<a href="#" class="list-group-item">组织聚会</a>
					<a href="#" class="list-group-item">图片管理</a>
					<a href="#" class="list-group-item">视频管理</a>
				</div>

			</div>

			<div id="right" ng-view>
				
			</div>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	$(function(){
		var active=$("#left .active");
		$(".list-group-item").click(function(){
			active.attr("class","list-group-item");
			active=$(this).addClass("list-group-item active");
		})
	})
	function modifyUI(){

	}
</script>
</html>