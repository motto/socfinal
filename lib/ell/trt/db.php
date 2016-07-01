<?php
namespace lib\ell\trt;
use lib;

defined( '_MOTTO' ) or die( 'Restricted access' );

trait DB_Marvan{

public  function Marvan($mezonev,$tabla,$err='already_have',$changeT=[])
{
	$res=[];$res['bool']=true;$res['changeT']=$changeT;
	$sql = "SELECT " . $mezonev . " FROM  " . $tabla . " WHERE " . $mezonev . "='" . $this->val . "'";
	$marvan = lib\db\DB::assoc_sor($sql);
	if (isset($marvan[$mezonev])) {  $res['bool'] = false; $res['err']=$err; }

	return $res;
}
}

trait DB_ValidPassvd{
public  function validPassvd($usernev,$err='Passwd_error',$changeT=[]){
	$res=[];$res['bool']=true;$res['changeT']=$changeT;
	$md5passwd=md5($this->val);
	$sql="SELECT password FROM userek WHERE username='".$usernev."' AND pub='0'";
	$dd=lib\db\DB::egymezo($sql);
	if($md5passwd != $dd){  $res['bool'] = false; $res['err']=$err;}
	return $res;
}}

