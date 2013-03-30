<?php
define ('FWGQ',1);
session_start();
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
FWGQ::init();
FWGQ::onlineAll();