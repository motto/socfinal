<?php
namespace lib\html;
use lib\base\OB_Mo;
use lib\base\OB;
/**
extends:OB_Mo paraméternek a GOB::headT,GOB::bodyT vagy a GOB::bodyendT  tombot kell átadni az 
ide beírandó js css og stb stringel térvissza ha nem adunk meg 
 */
class Fejlec extends OB_Mo{
	public  $cim ='Motto';
	public  $tag =[
			'css'=>['<style>','</style>'],
			'js'=>['<script>','</script>'],
			'cssfile'=>['<link href="','" rel="stylesheet">'],
			'jsfile' =>['<script src="','"></script>']
	];
	 public function __toString()
	{
		$res='';
		foreach ($this->cpT as $tag_tip=>$paramT){
			if($tag_tip=='og'){ $res.=$this->og($paramT);}
			else if($tag_tip=='docread'){ $res.=$this->docread($paramT);}
			else if($tag_tip=='meta'){ $res.=$this->meta($paramT);}
			else if($tag_tip=='jsGOBstr'){ $res.=$this->jsGOBstr($paramT);}
			else if($tag_tip=='jsGOBnum'){ $res.=$this->jsGOBnum($paramT);}
			else{
				//echo $tag_tip; //print_r($paramT);
				$paramT2= array_unique($paramT);
				// print_r($paramT2);
				foreach ($paramT2 as $param){

					$res.=$this->tag[$tag_tip][0].$param.$this->tag[$tag_tip][1];
				}
			}
		}
		return $res;
	}

	/**
globális js string változókat deklarál. A $paramT assocaiativ
	 */
	static public function jsGOBstr($paramT){
		$res=' <script> ';
		foreach ($paramT as $nev=>$value){
				
			$res.=' var '.$nev.'="'.$value.'" ; ';
		}
		return $res.' </script> ';
	}
	/**
 globális js numerikus változókat deklarál. A $paramT assocaiativ
	 */	
	static public function jsGOBnum($paramT){
		$res=' <script> ';
		foreach ($paramT as $nev=>$value){
	
			$res.=' var '.$nev.'='.$value.' ; ';
		}
		return $res.' </script> ';
	}
	
	/**
	a paramT első értéke a meta name (description,generator) második a content
	pl.:[title,Motto] tobb ugyanolyan tipus is lehet (image) ;
	 */
	static public function meta($paramT){
		$res='';
		foreach ($paramT as $paramR){
			
			$res.='<meta name="'.$paramR[0].'" content="'.$paramR[1].'" />';
		}
		return $res;
	}
	
	/**
 a paramT első értéke az ogtipus (type,title,description,image) második az érték
 pl.:[title,Motto] tobb ugyanolyan tipus is lehet (image) ;
	 */
	static public function og($paramT){
		$res='';
		foreach ($paramT as $paramR){
				
			$res.='<meta property="og:'.$paramR[0].'" content="'.$paramR[1].'" />';
		}
		return $res;

	}
	static public function docread($paramT){
		$res="<script> $( document ).ready(function(){";

		foreach ($paramT as $param){

			$res.=$param;
		}
		$res.="});<script>";
		return $res;
	}
}
/**
nincs visszatérési étéke feltölti a GOB::$html head a body és a bodyend tagjait
 paramétere ezek helyettesítői (pl.:<!--|head2|-->)
 */
class Fejlec_full extends Fejlec{
	public  $headStr ='<!--|head|-->';
	public  $bodyStr ='<!--|bodyhead|-->';
	public  $bodyendStr ='<!--|bodyend|-->';
	
	public function res($partT=[]){
	\GOB::$html= str_replace($this->headStr,OB::res('lib\html\Fejlec',\GOB::$headT) ,\GOB::$html);
	\GOB::$html= str_replace($this->bodyStr,OB::res('lib\html\Fejlec',\GOB::$bodyT) ,\GOB::$html);
	\GOB::$html= str_replace($this->bodyendStr,OB::res('lib\html\Fejlec',\GOB::$bodyendT) ,\GOB::$html);
}

}
//teszt------------------------

/*
 class GOB{
 public static $head=[];
 }
 GOB::$head['jsfile'][]='hh/jhj.js';
 GOB::$head['jsfile'][]='hh/jhj.js';
 GOB::$head['jsfile'][]='hh/jhjvbfcgbfg.js';
 GOB::$head['cssfile'][]='hh/jhjvbfcgbfg.cs';
 GOB::$head['js'][]='function(){fsdfgsdf;}';
 GOB::$head['js'][]='function ggg(ffff){}';
 GOB::$head['css'][]='.ff{width:32;height:32;}';
 GOB::$head['docread'][]='var h=$(\'#id\').val();';
 echo Aktival::res(GOB::$head);
 */