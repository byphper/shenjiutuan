<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title>深九团官网</title>
	 
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css" />
	<link href="__PUBLIC__/css/jquery.slideBox.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/layer/layer.min.js"></script>
</head>
<body>
	<div id="top">
		<div id="top_con">
			<span id="slogan">&emsp;路再远，我深一路追随!!!</span>
			<div id="login_info">
				<span>
					<?php
 if(!empty($_SESSION['user'])){ $name=$_SESSION['user']['nickname']; echo "<a class='nickname' href='__APP__/User/balldeatils'>$name</a>&emsp;<a class='nickname' href='__APP__/User/loginout'>退出</a>"; }else{?>

							<button id="login" class="btn btn-primary btn-sm custom">登陆</button>
					<button id="regist" class="btn btn-primary btn-sm custom">注册</button>
					<?php } ?>
					
						
					
				</span>
			</div>
		</div>
	</div>
	<div id="nav" class="center">
		<div id="con_log">
			<div id="official">
				官方网页
				<p>ShenJiuTuan</p>
			</div>
		</div>
		<div id="con_nav">
			<li class="nav_item" style="margin-left:30px">
				<a href="__APP__">首页</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/Index/about">关于深九团</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/News/newsList">新闻公告</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/Ball/ballList">报名看球</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/Party/partyList">參加聚会</a>
			</li>
			<li class="nav_item">
				<a href="#">组织踢球</a>
			</li>
			
			

		</div>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.slideBox.min.js"></script>
	<script>
            $(function(){
               $('#demo1').slideBox();
            });
    </script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/partydeatils.css" />
	<div class="center">
		<div id="news">
			<div id="news_nav">
				<a href="__APP__/Party/partyList">参加聚会</a>
				&nbsp;>&nbsp;
				<span style="font-size:12px;color:#c03e3e"><?php echo ($data[0]["title"]); ?></span>
			</div>
			<div id="news_con">
				<div id="ptitle"><?php echo ($data[0]["title"]); ?></div>
				<div style="text-align:center;margin-top:10px;"><?php echo ($data[0]["date"]); ?></div>
				<div id="con">
					<?php echo ($data[0]["content"]); ?>
				</div>
				<div style="text-align:center;margin-top:10px;">
					
					<?php
 if($data[0]['status']==1){ echo "<button id='applyparty' type='button' class='btn btn-info'>我要報名</button>"; }else if($data[0]['status']==2){ echo "<span style='color:gray;font-size:18px;'>已结束</span>"; }else{ echo "<span style='color:gray;font-size:18px;'>未开放</span>"; } ?>
				</div>
			</div>
		</div>
	</div>
	<div id="applyform" style="display:none">
		<form id="formdetiles" action="__APP__/party/addpartylog" method="post">
		<div id="pformtitle">參加聚会</div>
		<input type="hidden" value="<?php echo ($data[0]["id"]); ?>" name="pid" />
		<input type="hidden" value="<?php echo ($data[0]["title"]); ?>" name="title" />
		<div id="partyn">
			请输入参加人数：<select name="party_nums" style="width:100px">
		          <option value='1'>1</option>
		          <option value='2'>2</option>
		          <option value='3'>3</option>
		          <option value='4'>4</option>
		          <option value='5'>5</option>
		          <option value='6'>6</option>
		          <option value='7'>7</option>
		          <option value='8'>8</option>
		          <option value='9'>9</option>
		          <option value='10'>10</option>
		      </select>
		</div>
		<div style="width:280px;text-align:center;margin-top:13px"><input type="submit" class="btn btn-info btn-sm" value="提交" /></div>
	 </form>
	</div>
	<script>
		$(function(){

			$("#applyparty").bind('click', function(event) {
				$.getJSON('__APP__/Party/applycheck?id=<?php echo ($data[0]["id"]); ?>', function(data) {
					if(data.status==1){
						showLyarUi("applyform",280,120);
					}else{
						alert(data.msg);
					}
				});
			});
		})
	</script>
<div id="foot">
		<div id="foot_center">
			友情链接
			<div>
				<table>
					<tr>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">广州恒大足球俱乐部</a>
						</td>
						<td>
							<a href="#">深圳红砖足球俱乐部</a>
						</td>
						<td>
							<a href="#">广东日之泉俱乐部</a>
						</td>
						<td>
							<a href="#">皇马中文网</a>
						</td>
						<td>
							<a href="#">广州高校球迷联盟</a>
						</td>
						<td>
							<a href="#">深圳球迷协会</a>
						</td>
						<td>
							<a href="#">东莞球迷协会</a>
						</td>
						<td>
							<a href="#">东莞球迷协会</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#">广州网络球迷联盟</a>
						</td>
						<td>
							<a href="#">佛山球迷联盟</a>
						</td>
						<td>
							<a href="#">吴川球迷协会</a>
						</td>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">广州十二卫</a>
						</td>
						<td>
							<a href="#">东莞球迷协会</a>
						</td>
					</tr>
				</table>
			</div>	

			<div>
				© 2013-2014&emsp;深九团版权所有
			</div>
		</div>
	</div>


	<div style="display:none" id="login_ui">
		<div style="margin:20px;line-height:25	px;">
			<form id="lform" action="index.php/Home/User/login" method="POST">
				<div>
					邮箱：
					<input id="lemail" class="form-control" type="text" style="width:220px;" name="email">
					<br/>
				</div>

				<div>
					密码：
					<input id="lpwd" class="form-control" type="password" name="email">
					<br/>
				</div>
				<div>
					
					<a href="#">记住密码</a>
					<br/>
					<br/>
				</div>
				<div>
					<input class="btn btn-default" type="submit" value="登陆" />
					&emsp;
					<input class="btn btn-default" type="reset" value="重置" />
				</div>
			</form>
		</div>
	</div>
	<div style="display:none" id="regist_ui">
		<div style="margin:20px;line-height:25	px;">
			<form id="rform">
				<div>
					邮箱：
					<input id="remail" class="form-control" type="text" style="width:220px;" name="remail" placeholder="作为用户登陆使用">
					<br/>
				</div>
				<div>
					昵称：
					<input id="rnick" class="form-control" type="text" name="rnick" placeholder="格式：地区-昵称，如:福田-艺海">
					<br/>
				</div>
				<div>
					密码：
					<input id="rpwd" class="form-control" type="password" name="rpwd" placeholder="请输入6位以上密码">
					<br/>
				</div>
				<div>
					<input class="btn btn-default" type="submit" value="注册" />
					&emsp;
					<input class="btn btn-default" type="reset" value="重置" />
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">

		$(function(){
			$("#lform").submit(function(event) {
					var $le=$("#lemail").val();
					var $lp=$("#lpwd").val();
					

					if(!$lp||!$le){
						alert('邮箱或密码不能为空！')
						return false;
					}
					if($lp.length<6){
						alert('密码长度至少是六位！');
						return false;
					}
					var reg  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(!reg.test($le)){
						alert('邮箱格式不正确！');
						return false;
					}
					$lrem=$("#lrem").is(":checked");
					$.post('__APP__/User/login', {lemail:$le,lpwd:$lp,lrem:$lrem}, function(data) {
						if(data.status==1){
							window.location.reload();
						}else{
							alert(data.msg);
						}
					},'json');
					return false;
			});

			$("#rform").submit(function(event) {
					var $le=$("#remail").val();
					var $lp=$("#rpwd").val();
					if(!$lp||!$le){
						alert('邮箱或密码不能为空！')
						return false;
					}
					
					var reg  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(!reg.test($le)){
						alert('邮箱格式不正确！');
						return false;
					}
					var $nick=$("#rnick").val();
					if(!$nick){
						alert('昵称不能为空!');
						return false;
					}

					if($lp.length<6){
						alert('密码长度至少是六位！');
						return false;
					}
					
					$.post('__APP__/User/regist', {remail:$le,rpwd:$lp,rnick:$nick}, function(data) {
						if(data.status==1){
							window.location.reload();
						}else{
							alert(data.msg);
						}

					},'json');
					return false;
			});


			$(".custom").bind('click', function(event) {
				 if(event.target.id=="login"){
				 	showLyarUi("login_ui",280,260);
				 }else if(event.target.id=="regist"){
					showLyarUi("regist_ui",280,300);
				 }
			});
		})

		function showLyarUi(dom,width,height){
			var i = $.layer({
			    type : 1,
			    title : false,
			    offset:['150px' , ''],
			    border : false,
			    area : [width,height],
			    page : {dom : '#'+dom}
			});
		}
		
	</script>
</body>
</html>