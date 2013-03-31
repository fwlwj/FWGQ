<?php
define ('FWGQ',1);
session_start();
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
FWGQ::init();
if (!is_file('./config/config.php')){
	header ('Location: install.php');
	exit ;
}
if (FWGQ::is_login()){
	if (isset($_GET['logout'])){
		FWGQ::logout();
		FWGQ::jump(1,'./','登出成功.');
		exit;
	}
	else{
		FWGQ::jump(1,'./','您已登录.');
		exit;
	}
}
if ($_SERVER['REQUEST_METHOD']==='POST'){
	$username=$_POST['username'];
	$passwd=$_POST['password'];
	$login=FWGQ::login($username,$passwd);
	if ($login===TRUE){
		FWGQ::jump(1,'./','登陆成功');
	}
	else{
		FWGQ::jump(0,'',$login['msg']);
	}
	exit;
}
require FWGQ_ROOT.'tpl/pc/login.php';