<?php
class QQ3G {
		private $sid;
		private $yzm;
		private $error;
		function error() {
			if (empty($this->error)) {
				return false;
			}
			$return=$this->error;
			$this->error='';
			return $return;
		}
		function sid() {
		 	if (empty($this->sid)) {
				return false;
			}
			return $this->sid;
		}
		function yzm() {
			if (empty($this->yzm)) {
				return false;
			}
			$return=$this->yzm;
			$this->yzm='';
			return $return;
		}
		function getsid($qq_num, $qq_pwd) {
			$curl = curl_init("http://pt.3g.qq.com/s?aid=nLogin3gqq");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$Text = curl_exec($curl);
			$posturld = $this->substring($Text,"马上登录 <go href=\"","\" method=\"post\">");
			$postdata = "qq=".$qq_num."&pwd=".$qq_pwd."&bid_code=3GQQ&toQQchat=true&login_url=http%3A%2F%2Fpt.3g.qq.com%2Fs%3Faid%3DnLoginnew%26q_from%3D3GQQ&q_from=&modifySKey=0&loginType=1&aid=nLoginHandle&i_p_w=qq%7Cpwd%7C";
			$curl = curl_init($posturld);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1); 
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
			$Text = curl_exec($curl);
			if (strstr($Text, "成功")) {
				preg_match_all("/ontimer=\"(.*?)\">/", $Text, $matches);
				if(!empty($matches[1][0])) {
					$this->sid=$this->substring($matches[1][0],"sid=","&amp;");
					return true;
				} else {
					$this->error='未知错误';
					return false;
				}
			}
			if (strstr($Text,"帐号或密码不正确")) {
				$this->error='账号或密码不正确';
				return false;
			}
			if (strstr($Text,"冻结")) {
				$this->error="您的账号已经被冻结，无法再继续登陆，请解冻后再登陆！";
				return false;
			}
			if (strstr($Text,"验证")) {
				$this->error="yzm";
				$this->yzm=array();
				preg_match_all("/<postfield name=\"([^\"]+)\" value=\"([^\"]+)\"\/>/",$Text,$qqshuzu);
				preg_match_all("/[a-zA-z]+:\/\/[^\s\"]*/",$Text,$a_yzm);
				$this->yzm['img']='<img src="'.$a_yzm[0][1].'" />';
				$posturldex=explode('vdata=',$posturld);
				$this->yzm['hidden']='<input type="hidden" name="auto" value='.$qqshuzu[2][4].'><input type="hidden" name="bid" value='.$qqshuzu[2][30].'><input type="hidden" name="bid_code" value="3GQQ"><input type="hidden" name="extend" value='.$qqshuzu[2][11].'><input type="hidden" name="go_url" value="http://info.3g.qq.com/g/s?aid=index&from=IorA&sid=00&rand=857442"><input type="hidden" name="hexp" value='.$qqshuzu[2][3].'><input type="hidden" name="hexpwd" value='.$qqshuzu[2][2].'><input type="hidden" name="i_p_w" value="imgType|verify|"><input type="hidden" name="imgType" value='.$qqshuzu[2][10].'><input type="hidden" name="loginTitle" value='.$qqshuzu[2][22].'><input type="hidden" name="loginType" value='.$qqshuzu[2][9].'><input type="hidden" name="login_url" value='.$qqshuzu[2][14].'><input type="hidden" name="modifySKey" value='.$qqshuzu[2][6].'><input type="hidden" name="q_from" value=""><input type="hidden" name="q_status" value='.$qqshuzu[2][24].'><input type="hidden" name="qq" value='.$qqshuzu[2][16].'><input type="hidden" name="r" value='.$qqshuzu[2][8].'><input type="hidden" name="r_sid" value='.$qqshuzu[2][12].'><input type="hidden" name="rip" value='.$qqshuzu[2][15].'><input type="hidden" name="sid" value='.$qqshuzu[2][19].'><input type="hidden" name="toQQchat" value="true"><input type="hidden" name="u_token" value='.$qqshuzu[2][17].'><input type="hidden" name="vdata" value="'.$posturldex[1].'">';
				return false;
			}
		}
		function checkyzm() {
			$auto=$_POST['auto'];
			$bid=$_POST['bid'];
			$bid_code=$_POST['bid_code'];
			$extend=$_POST['extend'];
			$go_url=$_POST['go_url'];
			$hexp=$_POST['hexp'];
			$hexpwd=$_POST['hexpwd'];
			$i_p_w=$_POST['i_p_w'];
			$imgType=$_POST['imgType'];
			$loginTitle=$_POST['loginTitle'];
			$loginType=$_POST['loginType'];
			$loginType='1';
			$login_url=$_POST['login_url'];
			$modifySKey=$_POST['modifySKey'];
			$q_from=$_POST['q_from'];
			$q_status=$_POST['q_status'];
			$qq=$_POST['qq'];
			$r=$_POST['r'];
			$r_sid=$_POST['r_sid'];
			$rip=$_POST['rip'];
			$sid=$_POST['sid'];
			$toQQchat=$_POST['toQQchat'];
			$u_token=$_POST['u_token'];
			$verify=$_POST['yzm'];
			$cookie = dirname(__FILE__).'/cookie.txt';
			$post = array(
				'auto'=>$auto,
				'bid'=>$bid,
				'bid_code'=>'3GQQ',
				'extend'=>$extend,
				'go_url'=>$go_url,
				'hexp'=>$hexp,
				'hexpwd'=>$hexpwd,
				'i_p_w'=>'imgType|verify|',
				'imgType'=>'gif',
				'loginTitle'=>'手机腾讯网',
				'loginType'=>$loginType,
				'login_url'=>$login_url,
				'modifySKey'=>$modifySKey,
				'q_from'=>$q_from,
				'q_status'=>$q_status,
				'qq'=>$qq,
				'r'=>$r,
				'r_sid'=>$r_sid,
				'rip'=>$rip,
				'sid'=>$sid,
				'toQQchat'=>$toQQchat,
				'u_token'=>$u_token,
				'verify'=>$verify,
			);
			$curl = curl_init("http://pt.3g.qq.com/handleLogin?sid=".$_POST["sid"]."&vdata=".$_POST['vdata']);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); // ?Cookie
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
			$Text = curl_exec($curl);
			curl_close($curl);
			if (strpos($Text,"帐号或密码")) {
				$this->error='帐号或密码不正确';
				return false;
			} elseif (strpos($Text,'您输入的验证码不正确')) {
				$this->error='您输入的验证码不正确';
				return false;
			} else {
				preg_match_all("/sid=([^&=?]*)/",$Text,$regs);//正则，抓取sid
				$this->sid=$regs[1][0];
				return true;
			}
		}
		function substring($a,$b,$c) {
			preg_match_all("/".$b."(.*?)".$c."/",$a,$m);
			return $m[1][0];
		}
		function login($sid) {
			$url = "http://pt.3g.qq.com/s?aid=nLogin3gqqbysid&3gqqsid=".$sid;
			$contents = file_get_contents($url);
			return true;
		}
	}