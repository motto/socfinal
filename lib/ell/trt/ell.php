<?php
namespace lib\ell\trt;
use lib;


defined( '_MOTTO' ) or die( 'Restricted access' );
trait Ell_Match{
	public  function Match($val2,$err='no_match',$changeT=[])
	{	$res=[];$res['bool']=true;$res['changeT']=$changeT;
	if($this->val!=$val2){ $res['bool'] = false; $res['err']=$err;}
	return $res;
	}}



trait Ell_ELL{
public $val='';	

public  function Ell()
{	
$task=$this->ADT['task'];
$ellT=$this->ADT['TSK'][$task]['ell'];

foreach ($ellT as $valnev=>$param){
	$bool=true;
	if(isset($_POST[$valnev])){$this->val=$_POST[$valnev];}
	
	foreach ($param as $func=>$par){
		if($func=='regx'){
			
			foreach ($par as $parT){
			$res=$this->regx($parT);
			if(!$res['bool']){$this->hibaToADT($res); $bool=false;}
			}
			
		}
		else{
			eval('$res=$this->'.$func.'('.$par.');');
			//print_r($res);
			//'$this->'.$func.'('.$par.');';
			if(!$res['bool']){$this->hibaToADT($res);$bool=false;}
		}
				
	}
	
	if($bool){$this->ADT['SPT'][$valnev]=$this->val;}
	
	
}

}	
public function hibaToADT($errT){
	$err=$errT['err'];
	$LT=$this->ADT['LT'];
		if(isset($LT[$err])){$err=$LT[$err];}
		
		
	foreach ($errT['changeT'] as $nev=>$val){
		
		if(isset($LT[$val])){$val=$LT[$val];}	
		$err= str_replace('<<'.$nev.'>>', $val, $err);
	}
	$this->ADT['errT'][]=$err;

}

}
