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
		<div class="hero-unit background_white">
			<h1>时晞挂Q</h1>
			<p>
				感谢您使用本程序搭建网站<br />
				您可以在协议规定的约束和限制范围内修改 时晞挂 Q 源代码或界面风格以适应您的网站要求。<br />
				您享有反映和提出意见的权力，但没有一定被采纳的承诺或保证。<br />
				无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用 时晞挂 Q 的整体或任何部分，未经许可，网站页面页脚处的 时晞 名称必须保留，而不能清除或修改，除非您获得本人的授权许可。<br />
				禁止在 时晞挂 Q 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。<br />
				如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回。
				<form method="post">
					<input type="hidden" value="1" name="step" />
					<input class="btn btn-primary btn-large" type="submit" value="我接受，点击继续"/>
				</form>
			</p>
		</div>
	</div>
</body>
</html>