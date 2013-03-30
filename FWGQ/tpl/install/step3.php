<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo Html::meta_charset() ;?>
	<?php echo Html::head('安装向导') ;?>
	<?php echo Html::linkStyle('bootstrap,style') ;?>
</head>
<body style="height:1000px;">
	<div class="FW_title">
		<!--<img src="/Public/Img/logo.gif" style="display:inline;"/>-->
		<h2 style="display:inline;" class="FW_header-title">时晞挂Q安装向导</h2>
	</div>
	<?php require dirname(__FILE__).'/nav.php';?>
	<div class="wrapper">
		<?php if (!empty ($error)) {echo '<div class="alert alert-error">'.$error.' <a href="javascript:history.go(-1);" class="btn btn-danger" style="float:right;"> 返回 </a></div> ';}
		else{
		?>
		<div class="hero-unit background_white">
			<h1>时晞挂Q</h1>
			<p>
				感谢您使用本程序搭建网站<br />
				安装已完成.
			</p>
			<p>
				<a class="btn btn-primary btn-large" href="./">完成安装</a>
			</p>
		</div>
		<?php
		}
		?>	
	</div>
</body>
</html>