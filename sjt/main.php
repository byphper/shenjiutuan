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
	<script src="js/app.js"></script>
</head>
<body>
	<div id="all">
		<h1>h1. Bootstrap heading</h1>
	</div>
</body>
</html>