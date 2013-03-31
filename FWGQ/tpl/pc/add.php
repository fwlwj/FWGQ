<?php echo Html::html5();?>
<html>
<head>
	<?php echo Html::head('首页');?>
	<?php echo Html::meta_charset();?>
	<?php echo Html::linkStyle();?>
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
	<section class="container-fluid metro">
		<div class="row-fluid">
			<div class="span12">
				<div class="FW_index-loginbox">
					<div class="page-header">
						  <h1>添加QQ <small>Add QQ</small></h1>
					</div>
					<?php $times=0;foreach ($in as $one):++$times;?>
						<a class="FW-QQ-list-one tile wide text <?php if ($times/2==ceil($times/2)){echo 'bg-color-green';}?>" href="#QQ_SID"  role="button" class="btn" data-toggle="modal" data-qq="<?php echo $one['qq'];?>" data-sid="<?php echo $one['sid'];?>">
							<div class="text-header"><?php echo $one['qq'];?></div>
							<div class="text">QQ</div>
							<div class="text">SID:<?php echo $one['sid'];?></div>
						</a>
					<?php endforeach;?>
					<a class="FW-QQ-Add tile wide text bg-color-yellow" href="#QQ_Add" role="button" class="btn" data-toggle="modal">
						<div class="text-header">添加</div>
						<div class="text">QQ</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<div id="QQ_SID" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="FW-QQ-Num">QQ</h3>
		</div>
		<div class="modal-body">
			<p><span>QQ号:</span><span id="FW-QQ-Num-inner"></span></p>
			<p><span>SID:</span><span id="FW-QQ-SID-inner"></span></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
			<a class="btn btn-danger" href="./add.php?act=delete&sid=" id="FW-QQ-SID-delete">删除</a>
		</div>
	</div>
	<div id="QQ_Add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="FW-QQ-Num">添加QQ</h3>
		</div>
		<div class="modal-body">
			<form method="post">
				ＱＱ：<input type="text" name="qq"/><br />
				密码：<input type="password" name="password"/><br />
				<input type="submit" class="FW-btn-blue" value="添加"/>
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	</div>
	<script type="text/javascript">
	$('a.FW-QQ-list-one').each (function(){
		$(this).click(function (){
			$('#FW-QQ-Num').html('QQ:'+$(this).attr('data-qq'));
			$('#FW-QQ-Num-inner').html($(this).attr('data-qq'));
			$('#FW-QQ-SID-inner').html($(this).attr('data-sid'));
			$('#FW-QQ-SID-delete').attr('href','./add.php?act=delete&sid='+ $(this).attr('data-sid'));
		});
	});
	</script>
</body>
</html>