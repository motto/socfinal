<?php
namespace lib\ell\trt;
use lib;

defined( '_MOTTO' ) or die( 'Restricted access' );

trait DB_Marvan{

public  function Marvan($mezonev,$tabla,$err='already_have',$changeT=[])
{
	$res=[];$res['bool']=true;
	$sql = "SELECT " . $mezonev . " FROM  " . $tabla . " WHERE " . $mezonev . "='" . $this->val . "'";
	$marvan = lib\db\DB::assoc_sor($sql);
	if (isset($marvan[$mezonev])) {  $res['bool'] = false; $res['err']=[$err,$changeT]; }

	return $res;
}
}

/**
csak bejelentkezéshez használjuk! beállítja a $_SESSION['userid'];
 */
trait DB_ValidPasswd{
public  function ValidPasswd($err='Passwd_error',$changeT=[]){
   
	$res=[];$res['bool']=false;
	$hiba=$this->ADT['ellerr'] ?? true;
//print_r($this->ADT['SPT']);
	if(isset($this->ADT['SPT']['username']) )
	{
    	$md5passwd=md5($this->val);
    	$sql="SELECT id, password FROM userek WHERE username='".$this->ADT['SPT']['username']."' AND pub='0'";
    	$dd=lib\db\DB::assoc_sor($sql);
//print_r($dd);

    	if(!empty($dd))
    	{
//echo $this->ADT['SPT']['username'].'---------'. $dd['password'].'----'.$md5passwd;
        	if($md5passwd == $dd['password'])
        	{
        	    $_SESSION['userid']=$dd['id']; $res['bool'] = true;
        	}    
        	else{  $res['err']=[$err,$changeT];}    	    
    	}else{  $res['err']=[$err,$changeT];} 

	}	
	return $res;
}}

