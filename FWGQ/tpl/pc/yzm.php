<?php echo Html::html5();?>
<html>
<head>
	<?php echo Html::head('请输入验证码');?>
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
			<div class="span12">
				<div class="FW_index-loginbox">
					<div class="page-header">
						  <h1>验证码 <small>Verify Code</small></h1>
					</div>
					<div class="bm mtn">
						<div class="bm_h">请输入验证码</div>
						<form method="post">
							<input type="hidden" name="send" value="send">
							<p>
								验证码:<?php echo $hidden['img'] ; ?>
								<input class="txt" type="text" name="yzm" />
								<input type="hidden" value="<?php echo htmlentities($password, ENT_COMPAT); ?>" name="password"/>
								<?php echo $hidden['hidden'];?>
							</p>
							<p>
								<input type="submit" value="提交" />
								<input type="reset" value="重填">
							</p>
						</form>
</div>';
				</div>
			</div>
		</div>
	</section>
</body>
</html>