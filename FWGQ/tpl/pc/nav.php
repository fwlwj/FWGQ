	<header class="nav-wrapper" id="nav">
		<span class="Nav-Logo"><img src="/Public/Img/logo.png" /></span>
		<ul class="FW-Nav clearfix">
			<li class="active"><a href="./">首页</a></li>
			<li><a href="./add.php">添加QQ</a></li>
			<li class="right nav-login">
				<a href="#" class="Nav-btn" id="nav-login-show">
					<img class="avatar" src="http://1.gravatar.com/avatar/792d40b946316a54e22a715253ea2eaa?s=36&amp;d=http%3A%2F%2Fwww.lwjwz.tk%2Fwp-content%2Fthemes%2FD-simple%2Fimg%2Fdefault.png%3Fs%3D36&amp;r=G" width="23" height="23">
					<?php if (FWGQ::is_login()){echo $_SESSION['username'];}else{echo '用户登录';}?>
					<i class="arrow"></i>
				</a>
				<div class="nav-pop" id="nav-login-box">
				<?php if (FWGQ::is_login()):?>
					<div>
						<img class="avatar" src="http://1.gravatar.com/avatar/792d40b946316a54e22a715253ea2eaa?s=36&amp;d=http%3A%2F%2Fwww.lwjwz.tk%2Fwp-content%2Fthemes%2FD-simple%2Fimg%2Fdefault.png%3Fs%3D36&amp;r=G" width="23" height="23">
						<span><?php echo $_SESSION['username'];?></span>
					</div>
					<span class="pop-border"></span>
					<a href="./login.php?logout=1" class="FW-btn-mini">登出</a>
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