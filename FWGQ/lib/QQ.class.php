<?php
	class QQ {
		private $seq;
		private $ps;
		private $uin;
		private $error;
		//错误时返回错误信息
		function error() {
			if (empty($this->error)) {
				return false;
			}
			$return=$this->error;
			$this->error='';
			return $return;
		}
		//生成 seq，同时加密 pass
		function autoseq($pass=null) {
			if ($pass!==null) {
				$this->ps=strtoupper(md5($pass));
			}
			$this->seq=mt_rand(200,999);
		}
		//基础函数，用于发送数据
		function fp($post_str,$debug) {
			$fp=fsockopen(FWGQ::C('QQ_HOST'),FWGQ::C('QQ_HOST_PORT'),$errno,$errstr,FWGQ::C('CONNECT_TIMEOUT'));
			$content_length=strlen($post_str);
			$post_header="POST / HTTP/1.1\r\n"; 
			$post_header.="Content-Type: text/plain\r\n"; 
			$post_header.="User-Agent: UNTRUSTED/1.1\r\n"; 
			$post_header.='Host:'.FWGQ::C('QQ_HOST').':'.FWGQ::C('QQ_HOST_PORT')."\r\n";
			$post_header.="Content-Length: ".$content_length."\r\n";
			$post_header.="Connection: close\r\n\r\n";
			$post_header.=$post_str;		
			fwrite($fp,$post_header);
			$debugs='';
			while(!feof($fp)) {
				$debugs.=fgets($fp,1000);
			}
			if (empty($debugs)) {
				$this->error='服务器无响应';
				$this->uin='';
				return false;
			}
			if ($debug===true) {
				echo "<pre>Ootput:\n\n\n",$post_header,"</pre>";
				echo "<pre>Result:\n\n\n",$debugs,"</pre>\n";
				flush();
				ob_flush();
			}
			fclose($fp);
			$return=explode("\r\n",$debugs);
			$count=count($return);
			$count=$count-2;
			$return0=explode('&',$return[$count]);
			$return=array();
			foreach ($return0 as $value) {
				if ($value!=='') {
					$return1=explode('=',$value);
					$ct=count($return1);
					$return3=array();
					for ($return2=1;$return2<$ct;$return2++) {
						array_push($return3,$return1[$return2]);
					}
					$return[$return1[0]]=implode('=',$return3);
				}
			}
			return $return;
		}
		//登陆
		function login($uin,$pass,$debug=false) {
			$this->autoseq($pass);
			$this->uin=$uin;
			$return=$this->fp("VER=1.4&CON=1&CMD=Login&SEQ=".$this->seq."&UIN=".$uin."&PS=".$this->ps."&M5=1&LG=0&LC=2EC70D1101DB674F&GD=JTAIAHW97YPSYRPV&CKE=",$debug);
			switch ($return['RES']) {
				case '0';
					switch ($return['RS']) {
						case 0;
							return true;
							break;
						default;
							$this->error=$return['RA'];
							$this->uin='';
							return false;
					}
					break;
				case 5;
					$this->error='QQ 号非法';
					$this->uin='';
					return false;
			}
			$this->uin='';
			$this->error='未知错误';
			return false;
		}
	}
?>