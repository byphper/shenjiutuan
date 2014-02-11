<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title>深九团官网</title>
	 <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
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
 if(!empty($_SESSION['user'])){ $name=$_SESSION['user']['nickname']; echo "<a class='nickname' href=''>$name</a>&emsp;<a class='nickname' href='__APP__/User/loginout'>退出</a>"; }else{?>

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
				<a href="__APP__">首頁</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/News/newsList">新闻公告</a>
			</li>
			<li class="nav_item">
				<a href="__APP__/Ball/ballList">报名看球</a>
			</li>
			<li class="nav_item">
				<a href="#">參加聚会</a>
			</li>
			<li class="nav_item">
				<a href="#">组织踢球</a>
			</li>
			
			<li class="nav_item">
				<a href="#">关于深九团</a>
			</li>

		</div>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.slideBox.min.js"></script>
	<script>
            $(function(){
               $('#demo1').slideBox();
            });
    </script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/applydetails.css" />
	<div class="center">
		<div id="news">
			<div id="news_nav">
				<a href="__APP__/Ball/ballList">报名看球</a>
				&nbsp;>&nbsp;
				<span style="font-size:12px;color:#c03e3e"><?php echo ($data[0]["title"]); ?></span>
			</div>
			<div id="news_con">
				<div id="team">广州恒大&emsp;VS&emsp;<?php echo ($data[0]["match_op"]); ?></div>
				<div class="intro">比赛时间:<?php echo ($data[0]["match_time"]); ?></div>
				<div class="intro">比赛地点:<?php echo ($data[0]["match_address"]); ?></div>
				<div class="intro">门票:RMB<?php echo ($data[0]["ticket_cost"]); ?>&emsp;车费:RMB1<?php echo ($data[0]["car_cost"]); ?>(来回,可选择不跟车)</div>
				<div class="intro">看台:6区</div>
				<div class="intro">
					
					<?php
 if($data[0]['status']==1){ echo "<button id='applyball' type='button' class='btn btn-danger'>我要報名</button>"; }else if($data[0]['status']==2){ echo "<span style='color:gray;font-size:18px;'>已结束</span>"; } ?>
				</div>
			</div>
		</div>
	</div>


	<div id="applyform" style="display:none;">
		<div id="ball_head">报名看球</div>
		<ul id="notice">
			<li>1.报名成功后请把球票和跟车费用转到支付宝xxxo账号下</li>
			<li>2.如果报名后，迟迟不付款将取消名额</li>
			<li>3.支付成功请把订单截图发送给福田-菜牛</li>
		</ul>
		<hr style="border:#ecd9d9 1px solid">
		<form id="formdetiles" action="#" method="post">
			<div>福田-菜牛</div>
			<div>
				<span>看球人数：&emsp;</span>
				<select style="width:100px">
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
			<div>
				<span>球票数量：&emsp;</span>
				<select style="width:100px">
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
			<div>
				<span>是否跟车：&emsp;</span>
				<select id="isCar" style="width:100px">
					<option value='1'>是</option>
		          <option value='0'>否</option>
		          
		      </select>
			</div>
			<div id="carNums" >
				<span>跟车人数：&emsp;</span>
				<select style="width:100px">
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
			<div id="carAdd">
				<span>请选择上车地点：</span>
				<select>
					<option>布吉</option>
					<option>机场东</option>
					<option>直升机机场</option>
					<option>香蜜湖</option>
					<option>龙华</option>
				</select>
			</div>
			<div>
				<input type="submit" class="btn btn-info" value="提交" />
			</div>
		</form>

	</div>
	<script type="text/javascript">
		$(function(){
			
			$("#applyball").bind('click', function(event) {
				showLyarUi("applyform",480,420);
			});
			$("#isCar").bind('change', function(event) {
				if($(this).val()==1){
					
					$("#carNums").show();
					$("#carAdd").show();
				}else{
					$("#carNums").hide();
					$("#carAdd").hide();
				}
			});;
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