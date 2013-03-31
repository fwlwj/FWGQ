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
		<table class="table table-bordered background_white">
			<tbody>
		<?php 
			foreach ($func_a as $func_name => $echo){
				if ($func_exist[$func_name]){
					echo "<tr class=\"text-success\"><td><span class=\"label label-success\">正常</span>&nbsp$echo</td></tr>";
				}
				else{
					echo "<tr class=\"text-error\"><td><span class=\"label label-important\">错误</span>&nbsp$echo</td></tr>";
				}	
			}
			/*
			if ($connect){
				echo '<tr class="text-success"><td><span class="label label-success">正常</span>&nbsp成功连接腾讯QQ接口</td></tr>';
			}
			else{
				echo '<tr class="text-error"><td><span class="label label-important">错误</span>&nbsp无法连接腾讯QQ接口</td></tr>';
			}
			*/
			if (!$next){
				echo '<tr class="text-error"><td>你需要解决以上标示为&nbsp<span class="label label-important">错误</span>&nbsp的项目才能继续安装</td></tr>';
			}
		?>
			</tbody>
		</table>
		<?php 
			
			if ($next){
				echo '<form method="post"><input type="hidden" value="2" name="step" /><input type="submit" class="btn btn-success" value="下一步" style="float:right;"/></form>';
			}
		?>
	</div>
</body>
</html>