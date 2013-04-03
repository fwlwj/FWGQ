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
	<?php require dirname(__FILE__).'/nav.php';?>
	<section class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="FW_index-loginbox">
					<div class="page-header">
						  <h1>欢迎登录挂Q网 <small>Login</small></h1>
					</div>
					<form method="post" action="./login.php">
						<strong>用户名：</strong><input type="text" name="username" /><br />
						<strong>密　码：</strong><input type="password" name="password" /><br />
						<input type="submit" class="FW-btn-blue" value="登录"/>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php require dirname(__FILE__).'/footer.php';?>
</body>
</html>