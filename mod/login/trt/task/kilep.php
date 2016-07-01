<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait kilep_trt{ public function kilep($ADT,$TSK)
{	$_SESSION['userid']=0;
	header("Location: $_SERVER[HTTP_REFERER]");
}}