<?php
class SXSqlite{
	protected $setting=array();
	protected $link;
	public function __construct(){
		if (!function_exists('sqlite_open')){
			FWGQ::halt('未安装PHP Sqlite扩展.');
			return;
		}
		$this->setting=FWGQ::C('SQLITE_DB');
	}
	public function connect(){
		if (!empty($this->link)){
			return true;
		}
		$this->link=sqlite_open($this->setting['FILE'],0666,$msg);
		if ($this->link===FALSE){
			FWGQ::halt('Sqlite数据库链接错误 '.$msg);
		}
		return $this;
	}
	public function query($string,$fetch=NULL){
		if (empty($this->link)){
			$this->connect();
		}
		$error='';
		$return=sqlite_query($this->link,$string,SQLITE_BOTH ,$error);
		if ($return === false){
			FWGQ::halt('SQL执行错误<br /> Error1:'.$error.'<br />Error2:'.sqlite_error_string(sqlite_last_error($this->link)));
			return FALSE;
		}
		switch ($fetch){
			case 'array':
				return sqlite_fetch_array($return);
			break;
			case 'all':
				return sqlite_fetch_all($return);
			break;
			case 'count':
				return sqlite_num_rows($return);
			break;
			case 'all_num':
				return sqlite_fetch_all($return,SQLITE_NUM);
			break;
			case 'all_assoc':
				return sqlite_fetch_all($return,SQLITE_ASSOC);
			break;
			case 'change':
				return sqlite_changes($return);
			break;
		}
		return $return; 
	}
	public function build(){
		if (!is_file($this->setting['FILE'])){
			$this->link=sqlite_open($this->setting['FILE'],0666,$msg);
			$this->query('CREATE TABLE qq (id INTEGER PRIMARY KEY, username TEXT, password TEXT, sid TEXT,jifen INTERGER)');
			$this->query('CREATE TABLE qq_sid (username TEXT, qq INTERGER, sid TEXT)');
			$this->query('INSERT INTO qq VALUES (1, \'admin\', \''.sqlite_escape_string(FWGQ::C('pwd')).'\',\'\',\'20\')');
			return TRUE;
		}
		return false;
	}
	public function select($type,$from,$field='*',$where=null,$limit=null,$other=null){
		$sql='SELECT '.$field.' FROM '.$from;
		if (!is_null($where)){
			$sql.=' WHERE '.$where;
		}
		if (!is_null($limit)){
			$sql.=' LIMIT '.$limit;
		}
		if (!is_null($other)){
			$sql.=' '.$other;
		}
		$result=$this->query($sql,$type);
		return $result;
	}
	public function insert($into , $values){
		$sql='INSERT INTO ';
		$sql.=$into.' VALUES(';
		$string=implode(',',$values);
		$sql.=$string;
		$sql.=')';
		return $this->query($sql);
	}
	public function update($into , $where,$values){
		$string=array();
		foreach ($values as $name => $value){
			$string[]=$name.' = \''.sqlite_escape_string($value).'\'';
		}
		$string=implode(',',$string);
		$sql='UPDATE '.$into.' SET '.$string.(is_null($where)?'':' WHERE '.$where);
		$this->query($sql);
	}
	public function delete($from,$where){
		$string='DELETE FROM '.$from.' WHERE '.$where;
		return $this->query($string,'change');
	}
	public function login($username,$password){
		if (FWGQ::is_login()){
			return true;
		}
		if (trim($username)==='' || trim($password)===''){
			return array('id'=>1,'msg'=>'用户名或密码不能为空.');
		}
		$result=$this->select('','qq','*','username=\''.sqlite_escape_string($username).'\'');
		$count=sqlite_num_rows($result);
		if ($count===0){
			return array('id'=>2,'msg'=>'用户不存在。');
		}elseif ($count===1){
			$info=sqlite_fetch_array($result);
			if ($info['username']===$username && $info['password']===$password){
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				return true;
			}
			else{
				return array('id'=>3,'msg'=>'用户名或密码错误');
			}
		}
		else{
			FWGQ::log("临界值错误,存在重名用户 [ {$username} ] [ {$count} ] 个,请检查.",'ERROR');
		}
	}
}