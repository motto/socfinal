<?php
use lib\base\Task;
//use lib\base\Ob_Trt;
class TSK{
//static public $alap=['trt'=>'mod\login\trt\task\alap_trt'];	
static public $alap=['trt'=>'alap_trt'];	
static public $proba1=['trt'=>'view_trt','view'=>'test/res/proba1.html','next'=>'proba3'];
static public $proba2=['trt'=>'view_trt2','view'=>'test/res/proba2.html'];
static public $proba3=['trt'=>'','view'=>'mod/login/view/szerk_passwd.html'];

}
class ADT {
//fontos--------------------------	
public static $task='alap';
/**
a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
 */
public static $resfunc='res';
public static $next='';
public static $view='';
public static $dataT='';
//--------------------------------
public static $modnev='log';//applikációknál nme kell		

}

trait alap_trt{ public function alap($ADT,$TSK)
{	
	$ADT::$next='proba1';
return 	$ADT;
}}
trait alap_trt2{ public function alap($ADT,$TSK)
{	
$task=$ADT::$task;
$ADT::$view=$TSK::${$task}['view'];
	$ADT::$next='proba2';
	return 	$ADT;
}}

trait view_trt{ public function res($ADT,$TSK)
{	
//echo $ADT::$task;	
$task=$ADT::$task;
	if(is_file($TSK::${$task}['view']))
	{
		$ADT::$view= file_get_contents($TSK::${$task}['view'] ,true);
	}
	else{$ADT::$view=$TSK::${$task}['view'];}
	$ADT::$next='proba2';
return $ADT	;	

}}
trait view_trt2{ public function res($ADT,$TSK)
{
		$task=$ADT::$task;
		$ADT::$view.= 'trt2';
		if(isset($TSK::${$task}['next2'])){$ADT::$next=$TSK::${$task}['next2'];}
return 	$ADT;		
	
}}
trait view_trt3{ public function res($ADT,$TSK)
{

	$ADT::$view= 'proba3';
	return 	$ADT;

}}
trait view_trt4{ public function res($ADT,$TSK)
{

	$ADT::$view.= 'trt4';
	return 	$ADT;

}}

echo "\n t_Task:------------- \n";

$ADT=Task::res(ADT::class,TSK::class);
if($ADT::$view=='proba1trt2'){
	echo " ok,";	
}else{echo '!!!,';
		\GOBT::$resT['T_task']['task']='1';
		}
//echo 	$ADT::$view	;
	
class TSK2{
	static public $alap=['trt'=>'alap_trt2','next'=>'proba3','view'=>'alap'];

	static public $proba1=['trt'=>'view_trt','view'=>'pr1'];
	static public $proba2=['trt'=>'view_trt2','next2'=>'proba3'];
	static public $proba3=['trt'=>'view_trt4','next'=>'proba1'];
}	
ADT::$task='alap';
ADT::$modnev='log2';
$ADT2=Task::res(ADT::class,TSK2::class);
if($ADT2::$view=='alaptrt2trt4'){
	echo "  ok,";
}else{echo ' !!!,';
\GOBT::$resT['T_task']['task']='2';
}


