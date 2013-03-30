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
			<div class="span12">
				<div class="FW_index-loginbox">
					<div class="page-header">
						  <h1>添加QQ <small>Add QQ</small></h1>
					</div>
					<table class="table table-striped table-bordered table-hover">
						<tbody>
							<th>ID</th>
							<th>QQ号</th>
							<th>SID</th>
							<th>操作</th>
							<form method="post">
								<tr>
									<td>Add</td>
									<td>
										QQ<input type="text" name="qq" />
									</td>
									<td>
										密码<input type="password" name="password" />
									</td>
									<td>
										<input type="submit" class="btn btn-success" value="添加"/>
									</td>
								</tr>
							</form>
							<?php $times=0;foreach ($in as $one):++$times;?>
							<tr>
								<td><?php echo $times; ?></td>
								<td><?php echo $one['qq'];?></td>
								<td><?php echo $one['sid'];?></td>
								<td><a class="btn btn-info" href="./add.php?act=delete&sid=<?php echo urlencode($one['sid'])?>">删除</a></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</body>
</html>