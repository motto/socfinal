<?php
namespace lib\ell\trt;
use lib;

defined( '_MOTTO' ) or die( 'Restricted access' );
trait Ell_match{
	public  function match($val2,$err='no_match',$changeT=[])
	{	$res=[];$res['bool']=true;$res['changeT']=$changeT;
	if($this->val!=$val2){ $res['bool'] = false; $res['err']=$err;}
	return $res;
	}}

trait Ell{
public $val='';	

public  function ell($ADT,$TSK)
{	
$task=$ADT::$task;
$ellT=$TSK::${$task}['ell'];
if(isset($ADT::$modnev)){$this->hibamezo=$ADT::$modnev;}

foreach ($ellT as $valnev=>$param){
	$bool=true;
	if(isset($_POST[$valnev])){$this->val=$_POST[$valnev];}
	
	foreach ($param as $func=>$par){
		if($func=='regx'){
			
			foreach ($par as $parT){
			$res=$this->regx($parT);
			if(!$res['bool']){$this->hibaToGOB($ADT::$LT,$res,$ADT::$modnev); $bool=false;}
			}
			
		}
		else{
			eval('$res=$this->'.$func.'('.$par.');');
			//print_r($res);
			//'$this->'.$func.'('.$par.');';
			if(!$res['bool']){$this->hibaToGOB($ADT::$LT,$res,$ADT::$modnev);$bool=false;}
		}
				
	}
	
	if($bool){$ADT::$SPT[$valnev]=$this->val;}
	
}
return 	$ADT;
}	
public function hibaToGOB($LT,$res,$hibamezo){
	//$res['changeT']=[];
		if(isset($LT[$res['err']])){$err=$LT[$res['err']];}
		else{$err=$res['err'];}
		
	foreach ($res['changeT'] as $nev=>$val){
		
		if(isset($LT[$val])){$val=$LT[$val];}	
		$err= str_replace('<<'.$nev.'>>', $val, $err);
	}
	\GOB::$hiba[$hibamezo][]=$err;

}

}
