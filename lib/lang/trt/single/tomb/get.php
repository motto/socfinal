<?php
namespace lib\lang\trt\single\tomb;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Get_LT{

	public function getModLT($modname=''){
		$LT=[];
		eval('$LT=\mod\\'.$modname.'\LT::$'.\CONF::$accepted_langT[0].';');
		return $LT;
	}
	public function getAppLT($appname=''){
		$LT=[];
		eval('$LT=\app\\'.$appname.'\LT::$single;');
		return $LT;
	}
}

