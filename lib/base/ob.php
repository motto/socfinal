<?php
namespace lib\base;
defined( '_MOTTO' ) or die( 'Restricted access' );

/**
OB_Mo osztály példányosítására és a res függvény(alapesetben _tostring) meghívására való
 */
class OB{
/**
figyelem $classnev névterrel értendő!!! (pl.:lib\base\T_ob)
 OB_Mo osztály példányosítására és a res függvény(alapesetben _tostring) meghívására való
 */
 static public function res($classnev,$parT=[]){
 	$ob=new $classnev($parT);
 	return  $ob->res($parT);
 }	
}
/**
 a res() egy eval függvénnyel használható  class definícióval tér vissza 
 */
class Ob_Trt {
/**
evallal futtatható osztály definicióval tér vissza (string)
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
Ha $os sztályt adunk meg az osztály definició annak a gyermeke lesz.
 */
	static public function str($classnev,$trt,$os=''){
		$ext='';
		if($os!=''){$ext=' extends '.$os;}
		$res= 'class '.$classnev.$ext.'{';
		if(is_array($trt)){
			foreach ($trt as $tr){$res.= ' use '.$tr.'; ';}
		}
		else{$res.= ' use '.$trt.'; ';}
		$res.='}';
		return $res ;
	}	
/**
legenerálja az adott traiteket használó osztályt,(ha az $os  meg van adva annak gyermekeként) 
példányosítja és egy példánnyal tér vissza
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
 */
static public function ob($classnev,$trt,$os=''){
//echo self::str($classnev,$trt,$os);
eval(self::str($classnev,$trt,$os));
	$ob=new $classnev;
	return $ob;
}
/**
legenerálja az adott traiteket használó osztályt,(ha az $os  meg van adva annak gyermekeként) 
példányosítja és a res() függvény visszatérési értékével tér vissza
a traiteket ponosvesszővel kell elválasztani, a végére nem kell! lehet tömb is.
 */

static public function res($classnev,$trt,$os=''){
	$ob= self::ob($classnev,$trt,$os);
	return $ob->res() ;
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
public $cpT=[]; //belső paraméter tömb pl.: ij class generálásra
	
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
	            if(isset($this->$name)){$this->$name=$value;}
	        	
	        }
    	}
    
}

class OB_Mo extends OB_base 
{
	
 /**
  újra feltölti a this változókat és visszatér a res() függvénnyel
  */   
    public function ujres($parT=[]){
    	 $this->initMo($parT);
    	return  $this->res($parT);
    }
 /**
  ezt hívják meg a példányosítók ha nincs felülírva a __tostringel tér vissza
  */   
    public function res(){
    	return  $this->__toString();
    }
 /**
a $parT-vel feltölti a this változókat
  */  
 
    
 // TODO  meg kell oldani hogy az initMo() tudjon a paraméterhez hozzáadni ha az tömb.
    public function __toString(){
    	//return get_class($this);
    	return '';
    }


}


