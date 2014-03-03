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

							<button id="login" class="btn btn-primary btn-sm custom">登录</button>
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
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/userdetails.css" />
	<div class="center">
		<div id="warp">
			<div>
				<img src="__PUBLIC__/img/person.png" width="25" height="30" />
						&nbsp;<span id="person_title">个人中心</span>
			</div>
			<div style="margin-top:10px;border-bottom: 1px solid #ecd9d9;min-height:400px;">
				<div id="left">
					<li><a href="__APP__/User/balldeatils" style="color: #c03e3e;;font-weight:bold;font-size:14px;">看球记录</a></li>
					<li><a href="__APP__/User/partydeatils">聚会记录</a></li>
					<li><a href="__APP__/User/changePwd">修改密码</a></li>
				</div>
				<div id="right">
					<div style="min-height:370px;">
						
						<table style="width:700px;">
							
							<tbody>
								<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
										<td><?php echo ($vo["title"]); ?></td>
										<td class="logtd"><?php echo ($vo["watch_nums"]); ?>人看球</td>
										<td class="logtd"><?php echo ($vo["ticket_nums"]); ?>张球票</td>
										<td class="logtd"><?php echo ($vo["car_nums"]); ?>人跟车</td>
										<td class="logtd"><?php echo ($vo["goadd"]); ?></td>
										<td class="logtd">
											<?php if($vo["isPay"] == 1): ?>已付款
											<?php else: ?>
											未付款<?php endif; ?>
										</td>
										<td><?php if($vo["status"] == 2): ?>已结束
										   <?php elseif($vo["status"] == 0): ?>已取消
										<?php else: ?> 
											<a href="__APP__/Ball/cancel?id=<?php echo ($vo["id"]); ?>" class="cancel">取消报名</a><?php endif; ?></td>
									</tr><?php endforeach; endif; ?>
							</tbody>
						</table>

					</div>
					<div>
							<?php echo ($pager); ?>
					</div>
				</div>	
			</div>
		</div>
	</div>
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
				© 2013-2014&emsp;深九团版权所有<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000281957'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1000281957%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
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
					<input class="btn btn-default" type="submit" value="登录" />
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
<script>
    var showLogin=<?=$lui?>;
    if(showLogin==true){
    	showLyarUi("login_ui",280,260);
    }

    function setPage(url){
    	window.location.href=url;
    }
   
</script>