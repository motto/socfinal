<?php
namespace lib\task\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait Task_PostGet{

	static public function getTask($tasknev,$alaptask='alap'){
		$task=$alaptask;
		if(isset($_GET[$tasknev])){$task=$_GET[$tasknev];}
		if(isset($_POST[$tasknev])){$task=$_POST[$tasknev];}
		return  $task;
	}

}