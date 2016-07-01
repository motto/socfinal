<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait view_trt{ public function tres($ADT,$TSK)
{
	$task=$ADT::$task;
	//Ha nincs érvényes file a $TSK::${$task}['view']-ben lévő string lesz  a view;
	$ADT::$view=$TSK::${$task}['view'];
	if(isset($ADT::$vdir))
	{
		//ha érvényes az aktuális templétben $vdir path akkor az lesz a $vdir
		if(is_file('tmpl/'.\GOB::$tmpl.'/'.$ADT::$vdir.'/'.$TSK::${$task}['view']))
		{$ADT::$vdir='tmpl/'.\GOB::$tmpl.'/'.$ADT::$vdir;}
		//ha vannak init fileok becsatolja őket
		if(is_file($ADT::$vdir.'/init.php')){include $ADT::$vdir.'/init.php';}
		if(is_file($ADT::$vdir.'/'.$task.'_init.php')){include $ADT::$vdir.'/'.$task.'_init.php';}
		//view file tartalmának beolvasása ha van érvényes view file.
		//kell az ellenőrzés!!!
		if(is_file($ADT::$vdir.'/'.$TSK::${$task}['view']))
		{
		$ADT::$view= file_get_contents($TSK::${$task}['view'] ,true);
		}
	}	
	
	return $ADT	;
}}