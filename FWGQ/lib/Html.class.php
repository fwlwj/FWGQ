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
	public static function linkStyle($dir=null,$zip=FALSE){
		if ($dir===null){
			//$dir=$GLOBALS['__FW']['class']::C('STYLE_LIST');
			$dir=call_user_func(array($GLOBALS['__FW']['class'],'C'),'STYLE_LIST');
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
		$ext='.js';
		$dir=explode(',',$dir);
		$return='';
		foreach ($dir as $dirOne){
			$return.='<script type="text/javascript" src="'.FWGQ::C('PUBLIC_JS_DIR').FWGQ::pointLang($dirOne).$ext.'"></script>';
		}
		return $return;
	}
}
