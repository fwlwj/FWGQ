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
require FWGQ_ROOT.'tpl/pc/index.php';