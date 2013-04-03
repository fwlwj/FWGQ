<?php
$__FW=array();
$__FW['class']='FWGQ';
$__FW['version']='V1.7.4';
$__FW['FWGQ_version']='V2.3.1';
defined ('FWGQ_ROOT') or define ('FWGQ_ROOT',dirname(dirname(__FILE__)).'/');
class FWGQ{
	protected static $lib_list=array(
		'lib/Html.class.php'
	);
	public static $func_list=array(	
		/*
			'fwrite','fsockopen',//tqq.tencent.com协议通信用 暂未支持
		*/
		'curl_init','curl_setopt','curl_exec','curl_close',/*访问3GQQ用 CURL支持库*/
		'file_get_contents',/*访问3GQQ用 需要允许URL打开文件*/
	);
	public static function init(){
		if (function_exists('header')){
			header('FWPHP:FWPHP-'.$GLOBALS['__FW']['version']);
			header('FWGQ:By Shixi On FWPHP '.$GLOBALS['__FW']['FWGQ_version']);
		}
		function __autoload($class){
			if (is_file(FWGQ_ROOT.'/lib/'.$class.'.class.php')){
				require FWGQ_ROOT.'/lib/'.$class.'.class.php';
			}
		}
		is_writable(FWGQ_ROOT) or  exit('程序根目录不可写.');
		is_dir (FWGQ_ROOT.'config/') or mkdir (FWGQ_ROOT.'config/',0777);
		is_dir (FWGQ_ROOT.'log/') or mkdir (FWGQ_ROOT.'log/',0777);
		is_writable(FWGQ_ROOT.'log/') or exit('日志目录不可写.');
		is_writable(FWGQ_ROOT.'config/') or self::log('配置目录不可写.');
		is_dir(FWGQ_ROOT.'lib/') or self::log('系统类库丢失，请重新下载。');
		is_dir (FWGQ_ROOT.'tpl/') or self::log('模板目录不存在,请重新下载.');
		is_readable(FWGQ_ROOT.'lib/') or self::log('系统类库不可读.');
		foreach (self::$lib_list as $path){
			if (is_file($path)){
				require (FWGQ_ROOT.$path);
			}
			else{
				self::log ('类库 ['.$path.']不存在.');
			}
		}
		self::C(require FWGQ_ROOT.'config/convention.php');
		if (is_readable(FWGQ_ROOT.'config/config.php')){
			self::C(require FWGQ_ROOT.'config/config.php');
		}
	}
	public static function send_http_status($code) {
	    static $_status = array(
	        // Success 2xx
	        200 => 'OK',
	        // Redirection 3xx
	        301 => 'Moved Permanently',
	        302 => 'Moved Temporarily ',  // 1.1
	        // Client Error 4xx
	        400 => 'Bad Request',
	        403 => 'Forbidden',
	        404 => 'Not Found',
	        // Server Error 5xx
	        500 => 'Internal Server Error',
	        503 => 'Service Unavailable',
	    );
	    if(isset($_status[$code])) {
	        header('HTTP/1.1 '.$code.' '.$_status[$code]);
	        // 确保FastCGI模式下正常
	        header('Status:'.$code.' '.$_status[$code]);
	    }
	}
	public static function log($msg,$type='ERROR'){
		if (!is_file(FWGQ_ROOT.'log/'.date('y_m_d').'.txt')){
			file_put_contents(FWGQ_ROOT.'log/'.date('y_m_d').'.txt', '');
		}
		if (is_writable(FWGQ_ROOT.'log/'.date('y_m_d').'.txt')){
			file_put_contents(FWGQ_ROOT.'log/'.date('y_m_d').'.txt',sprintf('%s [ %s ] %s '.PHP_EOL,date('Y年m月d日 h时i分s秒'),$type,$msg),FILE_APPEND);
		}
		else{
			exit('日志目录不可写!');
		}	
		if ($type==='ERROR'){
			self::halt ("[ {$type} ] {$msg}");
		}
	}
	public static function C($name,$value=NULL){
		static $_config=array();
		if (is_array($name)&& is_null($value)){
			$_config=array_merge($_config,$name);
			return true;
		}
		if (is_string ($name)){
			$name=explode ('.',$name);
			if (is_null($value)){
				switch (count($name)){
					case 1:
						$route=$_config[$name[0]];
					break;
					case 2:
						$route=$_config[$name[0]][$name[1]];
					break;
					case 3:
						$route=$_config[$name[0]][$name[1]][$name[2]];
					break;
					default:
						self::log('暂不支持三维以上数组');
					break;
				}
				return $route;
			}
			else{
				switch (count($name)){
					case 1:
						$route=&$_config[$name[0]];
					break;
					case 2:
						$route=&$_config[$name[0]][$name[1]];
					break;
					case 3:
						$route=&$_config[$name[0]][$name[1]][$name[2]];
					break;
					default:
						self::log('暂不支持三维以上数组');
					break;
				}
				$route=$value;
				return true;
			}
		}
		self::log('变量名类型错误.');
		return false;
	}
	public static function pointLang($string){
		return str_replace(array('.','#'), array('/','.'), $string);
	}
	public static function hsjc($name){
		$string='函数 [ ';
		$string.=$name;
		$string.=' ] ';
		$string.=function_exists($name)?'存在':'不存在';
		$string.='.';
		return $string;
	}
	public static function hsjcBool($name){
		return function_exists($name);
	}
	public static function jump($type=1,$url='',$msg='执行成功',$time=NULL){
		if (is_null($time)){
			$time=self::C('JUMP_TIME');
		}
		ob_clean();
		require FWGQ_ROOT.'tpl/jump.php';
		exit;
	}
	public static function halt($error){
		ob_clean();
		ob_start();
			debug_print_backtrace();
		$trace=nl2br(ob_get_clean());
		require FWGQ_ROOT.'/tpl/error.php';
		exit;
	}
	public static function login ($username,$password){
		$db=self::initDB();
		return $db->login($username,$password);
	}
	public static function initClass($classname){
		static $_class=array();
		if (!isset($_class[$classname])){
			$_class[$classname]=new $classname();
		}
		return $_class[$classname];
	}
	public static function is_login(){
		if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
			return true;
		}
		return false;
	}
	public static function checkLogin(){
		self::is_login() or self::jump(0,'./login.php','请先登录.');
	}
	public static function initDB(){
		$method=FWGQ::C('save_method');
		$list=FWGQ::C('save_class');
		return self::initClass($list[$method]);
	}
	public static function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		session_destroy();
	}
	public static function add($qq,$password){
		$class=&self::initClass('QQ3G');
		if (isset($_POST['send'])){
			$yzmReturn=$class->checkyzm();
			if (!$yzmReturn){
				$qq2err=$class->error();
				return array('error'=>$qq2err);
			}
		}
		if ($class->getsid($qq,$password)) {
			$db=self::initDB();
			$return=$db->count_by_qq_username($qq);
			if ($return !==true){
				return $return;
			}
			//$in=$db->select('all_num','qq_sid','sid','username=\''.$_SESSION['username'].'\'');
			$db->insert_qq_sid($qq,$class->sid());
			return true;
		} else {
			$qq2err=$class->error();
			if ($qq2err==='yzm') {
				$hidden=$class->yzm();
				self::showYzmForm($hidden,$password);
				exit;
			} else {
				return array('error'=>$qq2err);
			}
		}		
		return array('error'=>'未知错误.');
	}
	public static function showYzmForm($hidden,$password){
		require FWGQ_ROOT.'tpl/pc/yzm.php';
	}
	public static function qqolExit(){
		$output=ob_get_clean();
		if (isset($_GET['jiankong'])){
			$time=round(time()-$GLOBALS['_time'],5);
			$fail=$GLOBALS['count']-$GLOBALS['qq_success'];
			$success=$GLOBALS['success']?'成功':'失败';
			echo 
"<pre>
all_qq:1{$GLOBALS['count']}
qq_success:{$GLOBALS['qq_success']}
qq_fail:{$fail}
time:{$time}
all_success:{$success}
</pre>";
			return;
		}
		require FWGQ_ROOT.'tpl/pc/qqol.php';
	}
	public static function onlineAll(){
		@set_time_limit(0);
		$GLOBALS['_time']=microtime(true);
		$db=self::initDB();
		$list=$db->get_all_qq_sid();
		$GLOBALS['count']=count($list);
		$class=self::initClass('QQ3G');
		register_shutdown_function(
			array('FWGQ','qqolExit')
		);
		$GLOBALS['success']=false;
		$GLOBALS['qq_success']=0;
		ob_start();
		foreach ($list as $qq=>$sid){
			if ($class->login($sid)){
				echo $qq,' <span class="label label-success">成功</span><br />';
				++$GLOBALS['qq_success'];
			}
			else{
				echo '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>注意!</strong> '.$qq.'<strong>&nbsp;&nbsp;登录失败	</strong></div>';
			}
		}
		$GLOBALS['success']=true;
	}
	public static function delete($sid){
		$db=self::initDB();
		return $db->delete_qq_sid($sid);
	}
	public static function getAllQQ(){
		$db=self::initDB();
		$list=$db->get_all_qq();
		foreach ($list as $qq){
			echo '<p>'.$qq.'<img src="http://wpa.qq.com/pa?p=2:'.$qq.':41" /></p>';
		}
	}
	public static function is_admin(){
		if (!self::is_login()){
			return false;
		}
		if (self::username()==='admin'){
			return true;
		}
		return false;
	}
	public static function username($username=null,$password=null){
		if ($username===null){
			if (!self::is_login()){
				return false;
			}
			return $_SESSION['username'];
		}
		else{
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
		}
	}
	public static function get_user_sid_num($type=3){
		$db=self::initDB();
		switch ($type){
			case 3:
				$user_num=$db->get_user_num();
				$qq_num=$db->get_qq_num();
				return array('user'=>$user_num,'qq'=>$qq_num,);
			break;
			case 2:
				return $db->get_user_num();
			break;
			case 1:
				return $db->get_qq_num();
			break;
		}
	}
	public static function encode_password($password){
		return md5(md5($password));
	}
	public static function Dump(){
		$count=0;
		foreach (func_get_args() as $value){
			++$count;
			echo '<pre>','FW - >DEBUG',"\r\n",'NUM:',$count;
				var_dump($value);
			echo '</pre>' ;
		}
	}
}