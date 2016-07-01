<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait Belep{ public function Belep()
{
	if($this->ell()){ 
	$_SESSION['userid']=\GOB::$userT['id'];
	if(isset($_SESSION['logref'])){$url=$_SESSION['logref'];}
	else{$url=$_SERVER['HTTP_REFERER'];}
	header("Location: $url"); /* ujratölt*/
	exit;
	}else{
		$this->ADT['next']='kilepve';
	}
	
	
}}
