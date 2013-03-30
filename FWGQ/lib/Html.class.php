<?php
class Html{
	public static function head($title){
		return '<title>'.$title.' - '.FWGQ::C('title').'</title>';
	}
	public static function meta_charset(){
		return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	}
	public static function html5(){
		return '<!DOCTYPE HTML>';
	}
	public static function xhtml(){
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
	}
	public static function linkStyle($dir,$zip=FALSE){
		if ($zip===TRUE){
			return;
		}
		$ext='.css';
		$dir=explode(',',$dir);
		$return='';
		foreach ($dir as $dirOne){
			$return.='<link rel="stylesheet" type="text/css" href="'.FWGQ::C('PUBLIC_CSS_DIR').FWGQ::pointLang($dirOne).$ext.'">';
		}
		return $return;
	}
	public static function js($dir,$zip=FALSE){
		if ($zip===TRUE){
			return;
		}
		$ext='.js';
		$dir=explode(',',$dir);
		$return='';
		foreach ($dir as $dirOne){
			$return.='<script type="text/javascript" src="'.FWGQ::C('PUBLIC_JS_DIR').FWGQ::pointLang($dirOne).$ext.'"></script>';
		}
		return $return;
	}
	public static function nav($NowName=''){
		$add='';
		foreach (FWGQ::C('NAV') as $name=>$url){
			$a='';
			if ($NowName===$name){
				$a=' class="active"';
			}
			$add.="<li{$a}><a href=\"{$url}\">{$name}</a></li>\r\n";
		}
		$return=
'<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">'.FWGQ::C('title').'</a>
		<ul class="nav">
'.$add.'
		</ul>
		<ul class="nav" style="float:right;" >
			<li>
				
			</li>
		</ul>
	</div>
</div>
';
		return $return;
	}
	public static function showNav($name=''){
		$return=<<<r
	<div class="nav-wrapper" id="nav">
r;
$return.=self::nav($name);
$return.=<<<r
	</div>
	<div class="nav-wrapper-fixed" id="navFixed" style="display: none;">
r;
$return.=self::nav($name);
$return.=<<<r
	</div>
	<script type="text/javascript">
	function navFixed(nav,navFixed){
	    window.onscroll=function(){
	        var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	        if(scrollTop>=nav.offsetTop){
	            navFixed.style.display='block';
	        }else{
	            navFixed.style.display='none';
	        }
	    }
	};
	navFixed(document.getElementById('nav'),document.getElementById('navFixed'));
	</script>
r;
	return $return;
	}
}