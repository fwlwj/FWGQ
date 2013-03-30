<?php
define ('FWGQ',1);
require ('./ChromePhp.php');
session_start();
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
FWGQ::checkLogin();
FWGQ::init();
if (!is_file('./config/config.php')){
	header ('Location: install.php');
	exit ;
}
if (isset($_GET['act'])&& $_GET['act']==='delete'){
	if (FWGQ::delete($_GET['sid'])){
		FWGQ::jump(1,'./add.php','删除成功',2);
	}
	else{
		FWGQ::jump(1,'./add.php','删除失败',2);
	}
}
if ($_SERVER['REQUEST_METHOD']==='POST'){
	$qq=$_POST['qq'];
	$passwd=$_POST['password'];
	$sqlite=new SXSqlite();
	$add=FWGQ::add($qq,$passwd);
	if ($add===TRUE){
		FWGQ::jump(1,'./add.php','添加成功',2);
	}
	else{
		FWGQ::jump(0,'',$add['error'],10);
	}
	exit;
}
$db=FWGQ::initDB();
$in=$db->select('all_assoc','qq_sid','qq,sid','username=\''.$_SESSION['username'].'\'');
require FWGQ_ROOT.'tpl/pc/add.php';