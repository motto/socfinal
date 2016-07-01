<?php
namespace mod\login;

use lib\base\Ob_Trt;
use lib\base\Task;


defined( '_MOTTO' ) or die( 'Restricted access' );
include_once 'mod/login/par.php';

/*
//azért kell associativ tömb hogy felül  írható legyen!
 \CONF:: $baseTRT=['temp'=>'',
					'task'=>'trt\task\Task_PostGet'
					];
$loginTRT=\CONF:: $baseTRT;//hogy változtatható legyen
*/



/**
ha sima use-val használjuk a traiteket nem tudunk beépíteni változókat pl:CONF::$LangMode
 */
abstract class loginbase{}; //csak azét kell hogy ne legyen figyelmeztetés

$loginTRT['lang']='lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Get_LT';
$loginTRT['getTask']='trt\task\Task_PostGet';
$loginTRT['feltolt']='trt\task\Task_PostGet';

eval(Ob_Trt::str('loginbase', $loginTRT))	; //loginbase osztály generálása, 	

class Login extends loginbase
{ 
	//protected $ADT=[]; //az Ob_Trt::str -el előállított osztályokban benne van!
	
	public function __construct($parT = []){
		$this->ADT = get_class_vars('mod\login\ADT');
		$this->ADT['TSK']=get_class_vars('mod\login\TSK');
		$this->setADT($parT); 
	}
	public function setADT($parT = []){
		foreach ($parT as $name => $value)
		{$this->ADT[$name]=$value;}
	}
	
	public function view($filename)
	{
		if(is_file('tmpl/'.\GOB::$tmpl.'/mod/login/'.$filename)){
			$res='tmpl/'.\GOB::$tmpl.'/mod/login/'.$filename;
		}
		else if(is_file('/mod/login/view/'.$filename)){
			$res='/mod/login/view/'.$filename;
		}
		else{$res=$filename;}
		return $res;
		
	}
    public function Login($parT=[])
    {	//$this->ADT feltöltése
    	$this->setADT($parT);
    	
    	//nyelvi tömb feltöltése parameter: mod könytár neve (modulnev nem a modul object neve) 	
    	$this->getModLT('login');//trt: lang
    	
    	//futtatamdó task előállítása
        $this->getTask(ADT::$modnev);//trt: getTask
        
        //Post elemek ellenőrzése
       // $this->ell(); //trt: ell
        
        //modulnev+task osztály generálás futtatás
        $this->task(); 
        
        // A :view feltöltése nyelvi elemekkel
        $this->feltolt(); 
        
	  
        return $this->ADT['view'];
    }
 
}

class Login_S
{
	static public function res($parT=[]){
		
		$ob=new Login();
		return $ob->Login($parT);
	}
	
}