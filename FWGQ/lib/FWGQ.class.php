<?php
class FWGQ{
	protected static $lib_list=array(
		'lib/Html.class.php'
	);
	public static $func_list=array(	
		'fwrite','fsockopen','curl_init','curl_setopt','curl_exec','curl_close','file_get_contents',
	);
	public static function init(){
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
		if (TRUE){
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
			if (is_null($value)){
				return $route;
			}
			else{
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
	public static function jump($type=1,$url='',$msg='执行成功',$time=2){
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
			$num=$db->select('count','qq_sid','sid','qq='.$qq);
			if ($num>=1){
				$num=$db->select('count','qq_sid','sid','qq='.$qq.' AND username=\''.$_SESSION['user'].'\'');
				if ($num===0){
					return array('error'=>'QQ号已存在，且不属于您.');
				}
				return array('error'=>'QQ号已存在.');
			}
			$in=$db->select('all_num','qq_sid','sid','username=\''.$_SESSION['username'].'\'');
			$db->insert('qq_sid',array('\''.$_SESSION['username'].'\'',$qq,'\''.$class->sid().'\''));
			return true;
		} else {
			$qq2err=$class->error();
			if ($qq2err=='yzm') {
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
		$list=array();
		$db=self::initDB();
		$result=$db->select ('all_assoc','qq_sid','qq,sid');
		foreach ($result as $one){
			$list[$one['qq']]=$one['sid'];
		}
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
		$in=$db->select('count','qq_sid','sid','username=\''.$_SESSION['username'].'\' AND sid=\''.$sid.'\'');
		if ($in>=1){
			$db->delete('qq_sid','username=\''.$_SESSION['username'].'\' AND sid=\''.$sid.'\'');
			return true;
		}
	}
	public static function getAllQQ(){
		$db=self::initDB();
		$in=$db->select('all','qq_sid','qq');
		$qqlist=array();
		foreach ($in as $one){
			
			echo '<p>'.$one['qq'].'<img src="http://wpa.qq.com/pa?p=2:'.$one['qq'].':41" /></p>';
		}
	}
}