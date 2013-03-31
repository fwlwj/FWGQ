<?php
define ('FWGQ',1);
session_start();
require './ChromePhp.php';
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
FWGQ::init();
FWGQ::checkLogin();
if (!is_file('./config/config.php')){
	header ('Location: install.php');
	exit ;
}
if (isset($_GET['act'])&& $_GET['act']==='delete'){
	if (FWGQ::delete($_GET['sid'])){
		FWGQ::jump(1,'./add.php','删除成功');
	}
	else{
		FWGQ::jump(1,'./add.php','删除失败');
	}
}
if ($_SERVER['REQUEST_METHOD']==='POST'){
	$qq=isset($_POST['qq'])?$_POST['qq']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	empty($qq) && FWGQ::jump(0,'','请输入QQ号');
	empty($password) && FWGQ::jump(0,'','请输入密码');
	$sqlite=new SXSqlite();
	$add=FWGQ::add($qq,$password);
	if ($add===TRUE){
		FWGQ::jump(1,'./add.php','添加成功');
	}
	else{
		FWGQ::jump(0,'',$add['error'],10);
	}
	exit;
}
$db=FWGQ::initDB();
$in=$db->select('all_assoc','qq_sid','qq,sid','username=\''.$_SESSION['username'].'\'');
require FWGQ_ROOT.'tpl/pc/add.php';