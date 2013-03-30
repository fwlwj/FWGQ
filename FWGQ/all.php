<?php
define ('FWGQ',1);
require ('./ChromePhp.php');
session_start();
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
FWGQ::checkLogin();
FWGQ::init();
FWGQ::getAllQQ();