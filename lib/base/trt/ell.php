<?php
namespace lib\base\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Ell_regx{

public function regex_cserel($text,$parT=[]){
	
	foreach ($parT as $nev=>$val){
		$text= str_replace('<<'.$nev.'>>', $val, $text);
	}
	return $text;
}
public function res($parT=[]){
	$res=[];
	$res['bol']=true;
	$res['val']=$this->val;
	$regx=$parT[0];
	
	if(isset($parT[1])){$err=$parT[1];}else{$err='regexhiba';}
	if(isset($this->LT[$err])){$err=$this->LT[$err];}
	if(isset($parT[2])){
	$regx=$this->regex_cserel($regx,$parT[2]);
	$err=$this->regex_cserel($err,$parT[2]);
	}
	if (!preg_match($regx,$this->val))
	{\GOB::$hiba[$this->hibamezo][] =$err;$res['bol']=false;}
	
	return $res;
}}