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
					<div class="page-header">
						  <h3>批量登录QQ <small>Login All QQ</small></h3>
					</div>
					<p>
						<?php echo $GLOBALS['success']?'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>恭喜!</strong> <strong>&nbsp;&nbsp;执行完毕	</strong></div>':'<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>&nbsp;&nbsp;未执行完毕	</strong></div>';?>
					</p>
					<p>
						<?php echo $output;?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<?php require dirname(__FILE__).'/footer.php';?>
</body>
</html>