<?php
namespace lib\base;
defined( '_MOTTO' ) or die( 'Restricted access' );
class Task {
/**
legenerál ehy ADT::$modnev. nevű osztáyt (ha nincs ADT::$modnev vagy ADT::$modnev='' 
 az osztály neve app lesz) ami használja a TSK::$task['trt'] traitet.
ugyanilyen névvel példányosítja,
	ha van $TSK::${$task}['resfunc'] nevű függvénye futtatja azt
	ha van ADT::$task() nevű függvénye futtatja azt
	ha nincs akor az ADT::resfunc()-t 
	ha egyik sincs leáll és hibát ír a GOB::hiba['Task'][]-ba
a függvények visszatérési értékének az új ADT-nek kell lenni. 
ezzel hívja meg újra saját magát de a task az  ADT::$next lesz
 ha nincs akkor TSK::$next ha ez sincs akkor nem hívja meg magát.
 */	
static 	public function res($ADT,$TSK)
	{
		$task=$ADT::$task;
	
		while ($task!='') {
			$trt=$TSK::${$task}['trt'];
			//ha applikációban futtatjuk nem tud több példány létezni--------
			if(isset($ADT::$modnev) && $ADT::$modnev!=''){$modnev=$ADT::$modnev.$task;}
			else{$modnev='app';}
			eval(Ob_Trt::str($modnev,$trt));
			eval('$'.$modnev.'=new '.$modnev.'();');
			$func='';
			if(isset($ADT::$resfunc) && method_exists($modnev,$ADT::$resfunc)){$func=$ADT::$resfunc;}
			if(method_exists($modnev,$task)){$func=$task;}
			if(isset($TSK::${$task}['resfunc']) && method_exists($modnev,$TSK::${$task}['resfunc'])){$func=$TSK::${$task}['resfunc'];}
			if($func==''){$task='';\GOB::$hiba['Task'][]='nincs a task trait-nek mghívható funkciója';}
			else{
				eval('$ADT=$'.$modnev.'->'.$func.'($ADT,$TSK);');
				
				if(isset($TSK::${$task}['next']) ){	$task=$TSK::${$task}['next'];
				}else{$task='';}
				
				if(isset($ADT::$next)){
					$task=$ADT::$next;
				}
			}
			
			
			
		$ADT::$task=$task;
		$ADT::$next='';
		}
		return $ADT;
	}
	

}
