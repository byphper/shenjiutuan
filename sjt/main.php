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
	<script src="../js/angular1.2.9.js"></script>
	<script src="../js/angular-route.js"></script>
	<script src="../js/angular-sanitize.js"></script>
	<script src="../js/jquery-1.9.1.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.js"> </script>
	    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
	    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
	<script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
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
				&emsp;&emsp;&emsp;	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				<span style="color:red">上次登陆时间：<?=$_SESSION['user']['last_date']?></span>
			</div>
			<div>
				
			</div>
		</div>
		
		<div id="con">
			<div id="left">
				<div class="list-group">
					<a href="#/news/list" class="list-group-item active">新闻公告</a>
					<a href="#/user/user_info" class="list-group-item">会员管理</a>
					<a href="#" class="list-group-item">组织看球</a>
					<a href="#" class="list-group-item">组织聚会</a>
					<a href="#" class="list-group-item">跟車地點</a>
					<a href="#" class="list-group-item">图片管理</a>
					<a href="#" class="list-group-item" onclick="UE.getEditor('editor')">视频管理</a>
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
	
</script>
</html>