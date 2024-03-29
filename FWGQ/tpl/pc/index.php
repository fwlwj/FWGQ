<?php echo Html::html5();?>
<html>
<head>
	<?php echo Html::head('首页');?>
	<?php echo Html::meta_charset();?>
	<?php echo Html::linkStyle() ;?>
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
		<?php if (FWGQ::is_login()):?>
			<div class="span12">
				<div class="FW-index-operate">
					<div class="FW-index-operate-title">你好！<?php echo FWGQ::username();?>.</div>
					<div class="clearfix">
						<h3 class="section-header">用户信息</h3>
						<div class="clearfix float-left">
							<a class="tile app" href="#">
								<div class="image-wrapper">
									<img src="http://1.gravatar.com/avatar/792d40b946316a54e22a715253ea2eaa?s=100" />
								</div>
								<div class="app-label"><?php echo FWGQ::username();?></div>
								<div class="app-count"><?php echo FWGQ::is_admin()?'管理员':'注册会员';?></div>
							</a>
						</div>
						<div>
						<ul>
							<li><span><?php echo FWGQ::username();?></span></li>
							<li>等级：<?php echo FWGQ::is_admin()?'管理员':'注册会员';?></li>
							<li>积分：<strong>未开放</strong></li>
						</ul>
						</div>
					</div>
					<div class="clearfix">
						<h3 class="section-header">QQ操作</h3>
						<a class="tile square text FW-metro " href="./add.php">
                           <div class="text-header">添加QQ</div>
                        </a>
						<a class="tile square text FW-metro" href="./add.php">
                           <div class="text-header">QQ列表</div>
                        </a>
					
					<?php if (FWGQ::is_admin()):?>
						<a class="tile square text FW-metro bg-color-blueDark FW-login-all-qq-btn" data-href="./qqol.php">
                           <div class="text-header FW-login-all-qq-title">登录<br />All QQ</div>
						   <div class="text FW-login-all-qq-english">Admin</div>
						   <div class="text">
								<div class="progress metro-style FW-index-allqq-progress-inner" style="display:none;">
									<div style="width:0%;" class="bar FW-index-allqq-progress"></div>
								</div>
							</div>
                        </a>
						<a class="tile square text FW-metro bg-color-greenDark" href="./all.php">
                           <div class="text-header">在线QQ列表</div>
						   <div class="text">Admin</div>
                        </a>
					
					<?php endif;?>
						<a class="tile square text FW-metro bg-color-red FW-index-logout" data-href="./login.php?logout=1">
                           <div class="text-header FW-index-logout-title">登出</div>
						   <div class="text FW-index-logout-english">Logout</div>
						   <div class="text">
								<div class="progress metro-style FW-index-logout-progress-inner" style="display:none;">
									<div style="width:0%;" class="bar FW-index-logout-progress"></div>
								</div>
							</div>
                        </a>					
					</div>
				</div>
		<?php else:?>
			<div class="span6">
				<h2><?php echo FWGQ::C('title');?></h2>
				<p>
					欢迎使用由&nbsp;<a href="http://www.lwjwz.tk/">时晞挂Q</a>&nbsp;建立的&nbsp;<a href="./"><?php echo FWGQ::C('title');?></a>&nbsp;网站<br />
					<a class="btn btn-info" href="./reg.php">注册</a>&nbsp;&nbsp;<strong>或</strong>&nbsp;&nbsp;<a href="./login.php" class="btn btn-info">登录</a>
				</p>
			</div>
			<div class="span6">
				<div class="FW_index-loginbox">
					<div class="page-header">
						  <h3>欢迎登录挂Q网 <small>Login</small></h3>
					</div>
					<form method="post" action="./login.php">
						<strong>用户名：</strong><input type="text" name="username" /><br />
						<strong>密　码：</strong><input type="password" name="password" /><br />
						<input type="submit" class="FW-btn-blue" value="登录"/>
					</form>
				<?php endif;?>
				</div>
			</div>
		</div>
	</section>
	<?php require dirname(__FILE__).'/footer.php';?>
	<script type="text/javascript">
		$('.FW-index-logout').click(
			function (){
				$('.FW-index-logout-progress-inner').css('display','block');
				$('.FW-index-logout-title').html('登出中');
				$('.FW-index-logout-english').html('Logouting');
				$('.FW-index-logout-progress').animate({width:'100%'},500);
				$.get("./login.php?logout=1",function(data,status){
					setTimeout(function (){window.location='./';},1000);
				});
			}
		);
<?php if (FWGQ::is_admin()):?>
		$('.FW-login-all-qq-btn').click(
			function (){
				$('.FW-index-allqq-progress-inner').css('display','block');
				$('.FW-login-all-qq-title').html('登陆全部');
				$('.FW-login-all-qq-english').html('Logining');
				$('.FW-index-allqq-progress').animate({width:'90%'},500);
				$.get("./qqol.php",function(data){
					returnData=data;
					$('.FW-index-allqq-progress').animate({width:'100%'},100);
					$('.FW-login-all-qq-title').html('登录完毕');
					$('.FW-login-all-qq-english').html('LoginSuccess');
				});
			}
		);
<?php endif;?>
	</script>
</body>
</html>