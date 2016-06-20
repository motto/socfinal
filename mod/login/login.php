<?php
namespace mod\login;
use lib\base\Ob_Trt;
use lib\base\Task;
use lib\html\FeltoltS;


defined( '_MOTTO' ) or die( 'Restricted access' );
include_once 'mod/login/par.php';
//azért kell associativ tömb hogy felül  írható legyen!
 \CONF:: $baseTRT=['temp'=>'',
					'task'=>'trt\task\Task_PostGet'
					];
$loginTRT=\CONF:: $baseTRT;//hogy cáltoztatható legyen



abstract class loginbase{}; //csak azét kell hogy ne legyen figyelmeztetés

$loginTRT['lang']='lib\lang\trt\\'.\CONF::$LangMode.'\\'.\CONF::$LangForras.'\Get_LT';
$loginTRT['getTask']='trt\task\Task_PostGet';

eval(Ob_Trt::str('loginbase', $loginTRT))	; //loginbase osztály generálása	

class Login extends loginbase
{
	protected $ADT=[];
	
	public function __construct($parT = []){
		
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
    public function result($parT=[])
    {	
//!!! ha több modul is futhat egyidőben más modulnevet kell megadni (ez lesz a tasknév is)!!!
    	//if(isset($parT['modnev'])){ADT::$modnev=$parT['modnev'];}
    	
    	//nyelvi tömb feltöltése parameter: mod könytár neve (modulnev nem a modul object neve) 	
    	ADT::$LT =$this->getModLT('login');//trt: lang
    	
    	//futtatamdó task előállítása
        ADT::$task =self::getTask(ADT::$modnev);//trt: getTask
        
        //Post elemek ellenőrzése
        $elo=new \lib\ell\Ell(); 
        $ADT=$elo->res(ADT::class,TSK::class);
        
        //modulnev+task osztály generálás futtatás
        $ADT=Task::res($ADT,TSK::class); 
        // A :view feltöltése nyelvi elemekkel
        $ADT=$this->feltolt($ADT,TSK::class); 
        
	  
        return $ADT::$view;
    }
 
}

class Login_S
{
	static public function res($parT=[]){
		
		$ob=new Login();
		return $ob->result($parT);
	}
	
}