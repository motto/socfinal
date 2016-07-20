<?php
namespace lib\base;
defined( '_MOTTO' ) or die( 'Restricted access' );

/**
OB_Mo osztály példányosítására és a res függvény(alapesetben _tostring) meghívására való
 */
class OB_Res{
/**
figyelem $classnev névterrel értendő!!! (pl.:lib\base\T_ob)
 OB_Mo osztály példányosítására és a res függvény(alapesetben _tostring) meghívására való
 */
 public function Res($classnev,$parT=[]){
 	$ob=new $classnev($parT);
 	return  $ob->Res($parT);
 }	
}
/**
 a str() egy eval függvénnyel használható  class definícióval tér vissza 
 az ob() egy str()-el gnerált objektummal
 a res() pedig ennek az objektumnak az alap függvénének ($func='Res') visszatérési értékével;
 */
class Ob_TrtS {
/**
evallal futtatható osztály definicióval tér vissza (string)
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
Ha $os sztályt adunk meg az osztály definició annak a gyermeke lesz.
 */
static public function str($classnev,$trt,$os=''){
		$ext='';
		if($os!=''){$ext=' extends '.$os;}
		$res= 'class '.$classnev.$ext.'{ ';
		if(is_array($trt)){
			foreach ($trt as $tr){$res.= ' use '.$tr.'; ';}
		}
		else{$res.= ' use '.$trt.'; public $ADT=[]; ';}
		$res.='}';
		return $res ;
	}	
/**
legenerálja az adott traiteket használó osztályt,(ha az $os  meg van adva annak gyermekeként) 
példányosítja és egy példánnyal tér vissza
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
 */
static public function ob($classnev,$trt,$os='',$ADT=[]){

    if(!class_exists($classnev, false))
    {
        eval(self::str($classnev,$trt,$os));      
    }

	$ob=new $classnev;
	$ob->ADT=$ADT;
	return $ob;
}
/**
legenerálja az adott traiteket használó osztályt,(ha az $os  meg van adva annak gyermekeként) 
példányosítja és a $func() függvény visszatérési értékével tér vissza
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
 */

static public function Res($classnev,$trt,$os='',$ADT=[],$func='Res'){
	$ob= self::ob($classnev,$trt,$os,$ADT);
	return $ob->$func() ;
}
static public function minRes($trt,$ADT=[],$func='Res',$os=''){
    $classnev='';$i=1;
    while ($classnev=='') {
      if(!class_exists('cl'.$i, false)){$classnev='cl'.$i;}   
        $i++;
    }
    $ob= self::ob($classnev,$trt,$os,$ADT);
    return $ob->$func() ;
}

}


/**
Ős osztály. A construktora az initMo($parT) segítségvel feltölti az osztály változókat
a frissit($parT)-el lehet aktualizálni. és egyben uj kimenetet kérni;
 a kimenetet a  __toString() állítja elő az OB::res() gyártófüggvény a res()-t hívja meg 
ami alapesetben a  __toString() -et adja vissza (ha string res-t akarunk elég csak azt felülírni)
 */
class OB_base 
{

	
/**
a $parT-vel feltölti a this változókat
 */
 public function __construct($parT=[])
    {
        $this->initMo($parT);

    }
     
 public function initMo($parT = [])
       {

	        foreach ($parT as $name => $value)
	        {	
	            if(isset( $this->$name)){ $this->$name=$value;}
	
	        }
    	}
    
}
class OB_base_ADT
{
    public $ADT=[];

    /**
     a $parT-vel feltölti a $ADT tömböt
     */
    public function __construct($parT=[])
    {
        $this->initMo($parT);

    }
     
    public function initMo($parT = [])
    {

        foreach ($parT as $name => $value)
        {
            $this->ADT['$name']=$value;

        }
    }

}



