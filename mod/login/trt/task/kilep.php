<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Kilep{ public function kilep()
{	$_SESSION['userid']=0;
	//header("Location: $_SERVER[HTTP_REFERER]");
   // $this->ADT['TSK'][$task]['next']='belepform';
}}