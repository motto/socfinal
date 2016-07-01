<?php
namespace mod\login\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait View{ public function View(){	
    $task=$this->ADT['task'];
    $dir=$this->ADT['vdir'] ?? 'mod/login/view';
    $Tview=$this->ADT['TSK'][$task]['view'];
    
    $view=$Tview;

	//ha érvényes az aktuális templétben a $dir path akkor az lesz a $dir
	if(is_file('tmpl/'.\GOB::$tmpl.'/'.$dir.'/'.$Tview))
	{$dir='tmpl/'.\GOB::$tmpl.'/'.$dir;}
	
	//ha vannak init fileok becsatolja őket
	if(is_file($dir.'/init.php')){include $dir.'/init.php';}
	if(is_file($dir.'/'.$task.'_init.php')){include $dir.'/'.$task.'_init.php';}
	
	//view file tartalmának beolvasása ha van érvényes view file.
	//kell az ellenőrzés!!!
	if(is_file($dir.'/'.$Tview))
	{
	$view= file_get_contents( $dir.'/'.$Tview,true);
	}

}	
}	