<?php echo Html::html5();?>
<html>
<head>
	<?php echo Html::head('首页');?>
	<?php echo Html::meta_charset();?>
	<?php echo Html::linkStyle('bootstrap,style') ;?>
	<?php echo Html::js('jquery,bootstrap') ;?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#nav-login-show").click(function(){
			$("#nav-login-box").toggle();
		});
	});
	</script>
</head>	
<body>
	<header class="nav-wrapper" id="nav">
		<span class="Nav-Logo"><img src="http://www.daqianduan.com/wp-content/themes/d-simple/img/logo.png" /></span>
		<ul class="FW-Nav clearfix">
			<li class="active"><a href="#">首页</a></li>
			<li><a href="#">添加QQ</a></li>
			<li class="right nav-login">
				<a href="#" class="Nav-btn" id="nav-login-show">用户登录 </a><i class="arrow"></i>
				<div class="float-list" id="nav-login-box">
					<form method="post" class="nav-login-box-form">
						<span>用户名：</span><input type="text" name="username" /><br />
						<span>密　码：</span><input type="password" name="password" /><br />
						<input type="submit" value="登录" />
					</form>
					<span class="pop-border"></span>
					<a href="/reg.php" class="FW-btn-mini">注册</a>
				</div>
			</li>
		</ul>
	</header>
	<div class="wrapper">
		<div class="hero-unit background_white span8">
			<h2><?php echo FWGQ::C('title');?></h2>
			<p>
				欢迎使用由时晞挂Q建立的<?php echo FWGQ::C('title');?>网站<br />
				<a class="btn btn-primary btn-large" href="/reg.php">注册</a>
			</p>
		</div>
		<div class="hero-unit background_white span4">
			<div class="FW_index-loginbox">
				<form method="post" action="./login.php">
					<legend>登录</legend>
					<input type="text" name="user" />
					<input type="password" name="pwd" /><br />
					<input type="submit" class="btn btn-info" value="登录"/>
				</form>
			</div>
		</div>
	</div>
</body>
</html>