	<header class="nav-wrapper" id="nav">
		<span class="Nav-Logo"><img src="/Public/Img/logo.png" /></span>
		<ul class="FW-Nav clearfix">
			<li class="active"><a href="./">首页</a></li>
			<li><a href="./add.php">添加QQ</a></li>
			<li class="right nav-login">
				<a href="#" class="Nav-btn" id="nav-login-show">
					<?php if (FWGQ::is_login()){echo '用户：',$_SESSION['username'];}else{echo '用户登录';}?>
					<i class="arrow"></i>
				</a>
				<div class="nav-pop" id="nav-login-box">
				<?php if (FWGQ::is_login()):?>
					<div class="clearfix">
						<div class="img-polaroid FW-span">
							<img class="avatar" src="http://1.gravatar.com/avatar/792d40b946316a54e22a715253ea2eaa?s=75" width="75" height="75" />
						</div>
						<span><?php echo FWGQ::username();?></span>
					</div>
					<div>
						<ul>
							<li>等级：<?php echo FWGQ::is_admin()?'管理员':'注册会员';?></li>
							<li>积分：<strong>未开放</strong></li>
						</ul>
					</div>
					<span class="pop-border"></span>
					<a href="./login.php?logout=1" class="btn btn-success">登出</a>
				<?php else:?>
					<form method="post" class="nav-login-box-form" action="./login.php">
						<div>用户名：</div><input type="text" name="username" /><br />
						<div>密　码：</div><input type="password" name="password" /><br />
						<input type="submit" value="登录" class="login-click"/>
					</form>
					<span class="pop-border"></span>
					<a href="/reg.php" class="FW-btn-mini">注册</a>
				<?php endif;?>
				</div>
			</li>
		</ul>
	</header>