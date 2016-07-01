<?php
namespace lib\task\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );

trait Task {

    public function task_futtat()
    {	
        $task=$this->ADT['task'];
       // echo $task;
        if(isset($this->ADT['TSK'][$task]['trt']))
			{$trt=$this->ADT['TSK'][$task]['trt'];}
			
			$modnev=$this->classNev($task);
			//echo \lib\base\Ob_Trt::str($modnev,$trt);
			if(!class_exists($modnev, false))
			{eval(\lib\base\Ob_Trt::str($modnev,$trt));}
			
			eval('$'.$modnev.'=new '.$modnev.'();');
			
			$$modnev->ADT=$this->ADT;
			
			$func=$this->func($modnev);
			//echo '$func'.$func;
			if($func=='')
			{$task='';}
			else{
				//eval('$ADT=$'.$modnev.'->'.$func.'();');
				$$modnev->$func();
				
			}
    $this->ADT= $$modnev->ADT;  
    }
	public function func($clasnev)
	{
		$func='';
		$task=$this->ADT['task'];
		//futtatandó funkció:ADT-ben deklarált, vagy a task név vagy TSK ban deklarált
		if(isset($this->ADT['resfunc']) && method_exists($clasnev,$this->ADT['resfunc'])){$func=$this->ADT['resfunc'];}
		if(method_exists($clasnev,$task)){$func=$task;}
		if(isset($this->ADT['TSK'][$task]['resfunc']) && method_exists($clasnev,$this->ADT['TSK'][$task]['resfunc'])){$func=$this->ADT['TSK'][$task]['resfunc'];}
		
		if($func==''){\GOB::$hiba['Task'][]='nincs a task trait-nek mghívható funkciója';}
		return $func;
	}
	public function next()
	{
	$task=$this->ADT['task'];
	
	if(isset($this->ADT['TSK'][$task]['next']) )
	{$task=$this->ADT['TSK'][$task]['next'];
	}else{$task='';}

	if(isset($this->ADT['next'])){
		$task=$this->ADT['next'];
	}
	//print_r($this->ADT);
	$this->ADT['task']=$task;
	}
	public function classNev($task)
	{
		
		if(isset($this->ADT['modnev']) && $this->ADT['modnev']!=''){$modnev=$this->ADT['modnev'].$task;}
		else{$modnev='app'.$task;}//ha applikációban futtatjuk nem tud több példány létezni
		return $modnev;
	}
	/**
	 ha még nincs,legenerál ehy ADT::$modnev. nevű osztáyt (ha nincs ADT::$modnev vagy ADT::$modnev=''
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
	public function task()
	{
		
		while ($this->ADT['task']!='')
		{
///echo $task;    
			$this->task_futtat();
			$this->next();
			$this->ADT['next']='';
		}

	}


}


trait Task_PostGet{

	static public function getTask($tasknev,$alaptask='alap'){
		$task=$alaptask;
		if(isset($_GET[$tasknev])){$task=$_GET[$tasknev];}
		if(isset($_POST[$tasknev])){$task=$_POST[$tasknev];}
		return  $task;
	}

}