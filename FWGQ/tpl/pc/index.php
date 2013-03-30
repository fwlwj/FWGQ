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
<body style="height:1000px;">
	<?php require dirname(__FILE__).'/nav.php';?>
	<section class="container-fluid">
		<div class="row-fluid">
			<div class="span6">
				<h2><?php echo FWGQ::C('title');?></h2>
				<p>
					欢迎使用由&nbsp;<a href="http://www.lwjwz.tk/">时晞挂Q</a>&nbsp;建立的&nbsp;<a href="./"><?php echo FWGQ::C('title');?></a>&nbsp;网站<br />
					<a class="btn btn-info" href="./reg.php">注册</a>&nbsp;&nbsp;<strong>或</strong>&nbsp;&nbsp;<a href="./login.php" class="btn btn-info">登录</a>
				</p>
			</div>
			<div class="span6">
				<div class="FW_index-loginbox">
				<?php if (FWGQ::is_login()):?>
					<div class="page-header">
						  <h3>操作 <small>Operate</small></h3>
					</div>
					<div class="FW-index-operate">
						<a href="./add.php" class="btn btn-large btn-block btn-primary" >添加QQ</a>
						<a href="./add.php" class="btn btn-large btn-block btn-info">QQ列表</a>
						<?php if ($_SESSION['username']==='admin'):?>
						<a href="./qqol.php" class="btn btn-large btn-block btn-inverse">登录QQ</a>
						<a href="./all.php" class="btn btn-large btn-block btn-success">在线QQ列表</a>
						<?php endif;?>
						<a href="./login.php?logout=1" class="btn btn-large btn-block btn-danger">登出</a>						
					</div>
				<?php else:?>
					<div class="page-header">
						  <h3>用户登录 <small>Login</small></h3>
					</div>
					<form method="post" action="./login.php">
						<strong>用户名：</strong><input type="text" name="username" /><br />
						<strong>密　码：</strong><input type="password" name="password" /><br />
						<input type="submit" class="login-click" value="登录"/>
					</form>
				<?php endif;?>
				</div>
			</div>
		</div>
	</section>
</body>
</html>