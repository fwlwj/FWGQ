<?php
define ('FWGQ',1);
define ('FWGQ_ROOT',dirname(__FILE__).'/');
require FWGQ_ROOT.'lib/FWGQ.class.php';
if (is_file('./config/installed.log')){
	FWGQ::send_http_status(403);
	FWGQ::halt('非法运行install.php，如果需要重新安装，请删除 根目录/config/installed.log');
}
FWGQ::init();
$step=isset($_POST['step'])?intval($_POST['step']):0;
switch ($step){
	case 0:
		require FWGQ_ROOT.'tpl/install/step0.php';
	break;
	case 1:
		$count=0;
		foreach (FWGQ::$func_list as $func){
			$func_exist[$func]=FWGQ::hsjcBool($func);
			$count++;
			$func_a[$func]=FWGQ::hsjc($func);
		}
		$next=(count($func_exist)===$count);
		//$connect=@fsockopen('tqq.tencent.com',14000,$errno,$errstr,5)?true:false;
		$curl = curl_init("http://pt.3g.qq.com/s?aid=nLogin3gqq");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$Text = curl_exec($curl);
		curl_close($curl);
		$connect=$Text===false?false:true;
		$next=$next && $connect;
		require FWGQ_ROOT.'tpl/install/step1.php';
	break;
	case 2:
		require FWGQ_ROOT.'tpl/install/step2.php';
	break;
	case 3:
		$error='';
		if ($_POST['pwd'] !== $_POST['pwd2']){
			$error='密码与重复密码不符合';
			require FWGQ_ROOT.'tpl/install/step3.php';
			break;
		}
		if ($_POST['save_method']==='mysql'){
			if (empty ($_POST['mysql_host']) || empty ($_POST['mysql_port']) || empty ($_POST['mysql_pwd']) || empty ($_POST['mysql_db'])  || empty ($_POST['mysql_pre'])  || empty ($_POST['mysql_user'])){
				$error='Mysql信息不完全.';
				require FWGQ_ROOT.'tpl/install/step3.php';
				break;
			}
		}
		if (!isset ($_POST['save_method']) || empty ($_POST['save_method'])){
			$error='请选择数据存储方式.';
			require FWGQ_ROOT.'tpl/install/step3.php';
			break;
		}
		if ($_POST['save_method']==='mysql'){
			$info=array(
			'pwd'=>$_POST['pwd'],
			'save_method'=>$_POST['save_method'],
			'mysql_host'=>$_POST['mysql_host'],
			'mysql_port'=>$_POST['mysql_port'],
			'mysql_user'=>$_POST['mysql_user'],
			'mysql_pwd'=>$_POST['mysql_pwd'],
			'mysql_db'=>$_POST['mysql_db'],
			'mysql_pre'=>$_POST['mysql_pre'],
			'title'=>$_POST['title'],
			  'save_class'=>array(
				'file'=>'file',
				'sqlite'=>'SXSqlite',
				),
		);
		}
		else{
			$info=array(
			'pwd'=>$_POST['pwd'],
			'save_method'=>$_POST['save_method'],
			'title'=>$_POST['title'],
			  'save_class'=>array(
				'file'=>'file',
				'sqlite'=>'SXSqlite',
			),
			'SQLITE_DB'=>array('FILE'=>FWGQ_ROOT.'/DB/sqlite.db'),
		);
		}
		file_put_contents(FWGQ_ROOT.'config/config.php','<?php return '.var_export($info,true).';');
		file_put_contents(FWGQ_ROOT.'config/installed.log', 'Installed LOCK If you want to re-install it please delete this file.');
		require FWGQ_ROOT.'tpl/install/step3.php';
		FWGQ::C(require FWGQ_ROOT.'config/config.php');
		FWGQ::initDB()->build();
		if (!is_writable(__FILE__)){
			echo '请更名或删除本安装文件.';
		}
	break;
}