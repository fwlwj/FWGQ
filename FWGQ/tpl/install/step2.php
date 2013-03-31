<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo Html::meta_charset() ;?>
	<?php echo Html::head('安装向导') ;?>
	<?php echo Html::linkStyle('bootstrap,style') ;?>
<style type="text/css">

</style>

</head>
<body style="height:1000px;">
	<?php require dirname(__FILE__).'/nav.php';?>
	<div class="wrapper">
		<form method="post">
			<input type="hidden" value="3" name="step" />
			<table class="table table-bordered background_white">
				<tbody>
					<tr><td colspan="2">管理员信息</td></tr>
					<tr><td>管理员密码</td><td><input type="password" name="pwd" /></td></tr>
					<tr><td>确认密码</td><td><input type="password" name="pwd2" /></td></tr>
				</tbody>
			</table>
			<table class="table table-bordered background_white">
				<tbody>
					<tr><td colspan="2">数据存储</td></tr>
					<tr>
						<td>方式</td>
						<td colspan="2">
							<!--
							<input type="radio" name="save_method" value="mysql" onchange="mysql_form_show(this)"/>Mysql
							<input type="radio" name="save_method" value="file" onchange="mysql_form_show(false)"/>文件
							-->
							<input type="radio" name="save_method" value="sqlite" onchange="mysql_form_show(false)"/>Sqlite
						</td>
					</tr>
					<!--
						<tr class="mysql_info"><td>数据库服务器</td><td><input type="text" name="mysql_host" /></td></tr>
						<tr class="mysql_info"><td>数据库端口</td><td><input type="text" name="mysql_port" /></td></tr>
						<tr class="mysql_info"><td>数据库用户名</td><td><input type="text" name="mysql_user" /></td></tr>
						<tr class="mysql_info"><td>数据库密码</td><td><input type="text" name="mysql_pwd" /></td></tr>
						<tr class="mysql_info"><td>数据库</td><td><input type="text" name="mysql_db" /></td></tr>
						<tr class="mysql_info"><td>数据库前缀</td><td><input type="text" name="mysql_pre" /></td></tr>
					-->
				</tbody>
			</table>
			<table class="table table-bordered background_white">
				<tbody>
					<tr><td colspan="2">站点信息</td></tr>
					<tr><td>网站名称</td><td><input type="text" name="title" /></td></tr>
				</tbody>
			</table>
			<table class="table table-bordered background_white">
				<tbody>
					<tr><td><input type="submit" class="btn btn-info" style="float:right;"/></td></tr>
				</tbody>
			</table>
		</form>
	</div>
<script type="text/javascript">
function mysql_form_show(obj){

	if (obj===false){
		for (var i=0,len=document.getElementsByClassName('mysql_info').length; i<len; i++)
		{
			document.getElementsByClassName('mysql_info')[i].style.display='none';
		}
		return;
	}
	if (obj.checked){
		for (var i=0,len=document.getElementsByClassName('mysql_info').length; i<len; i++)
		{
			document.getElementsByClassName('mysql_info')[i].style.display='table-row';
		}
	}
	else{
		for (var i=0,len=document.getElementsByClassName('mysql_info').length; i<len; i++)
		{
			document.getElementsByClassName('mysql_info')[i].style.display='none';
		}
	}
};
</script>
</body>
</html>