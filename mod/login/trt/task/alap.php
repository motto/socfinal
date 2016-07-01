<?php
namespace mod\login\trt\task;
defined( '_MOTTO' ) or die( 'Restricted access' );

trait Alap{ public function Alap()
{
	if( $_SESSION['userid']==0){$this->ADT['next']='belepform';}
	else{$this->ADT['next']='kilepform';}

}}