<?php
namespace lib\ell\trt;

defined( '_MOTTO' ) or die( 'Restricted access' );
trait Ell_Match{
	public  function Match($val2,$err='no_match',$changeT=[])
	{	$res=[];$res['bool']=true;
	if($this->val!=$val2){ $res['bool'] = false; $res['err']=[$err,$changeT];}
	return $res;
	}}

/**
az LT tömböt már előtte fel kell tölteni! onnan veszi a hiba üzenetet
 */
trait Ell{
public $val='';	

public  function Ell()
{	
$task=$this->ADT['task'];
$ellT=$this->ADT['TSK'][$task]['ell'];

foreach ($ellT as $valnev=>$param)
{
	$bool=true;
	if(isset($_POST[$valnev])){$this->val=$_POST[$valnev];}
	
	foreach ($param as $func=>$par)
	{
		if($func=='regx'){
			
			foreach ($par as $parT)
			{
//echo 'regex---';
    			$res=$this->regx($parT);
    			if(!$res['bool']){ $bool=false;}
                $this->errToLT($res); 
			}
			
		}
		else{
 //echo $funif()c;
			if($par!=''){eval('$res=$this->'.$func.'('.$par.');');}
			else{eval('$res=$this->'.$func.'();');}
			
			if(!$res['bool']){ $bool=false;}
//print_r($res);
			$this->errToLT($res); 
		}
				
	}
	//$toSPT= $this->ADT['TSK'][$task]['ell']['toSPT'] ?? true;
	if($bool) {$this->ADT['SPT'][$valnev]=$this->val;}
	if(!$bool){$this->ADT['ellerr']=false;}
		
}
return $bool;
}
public function textToLT($key,$text,$changeT){
    $this->ADT['LT']=\lib\base\TOMB::langTextToT($key,$text,$this->ADT['LT'],$changeT);   
}
/**
szöveget cserél ki az LT tömb mgfelelőjére paraméterezhető a cserélendő paramétert 
<< >> jelek közé kell tenni az értéküket a change assoc tömbben kell megadni 
ha az érték 'LT.' -al ketdődik azt is becseréli a az LT tömb megfelelő elemével
 */
public function errToLT($errT){

	foreach ($errT as $nev =>$value)
	{
	    if($nev!='bool')
	    {  
//echo 'textToLT: '.$nev;
//print_r($value);
            if(is_array($value) && !empty($value))
            {
                $val=$value[0]; $changeT=$value[1] ?? [];
            }
    	    else
    	    {
    	        $val=$value;$changeT=[];
    	    }
    	     
        	    if(!empty($val)){ $this->textToLT($nev,$val,$changeT) ; }	   
	   }
    
    }
}}
