<?php
namespace mod\login\trt\task\;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait alap_trt{ public function alap($ADT,$TSK)
{
	if( $_SESSION['userid']==0){$ADT::$next='belepform';}
	else{$ADT::$next='kilepform';}
	return 	$ADT;
}}