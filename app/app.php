<?php
namespace app;
defined( '_MOTTO' ) or die( 'Restricted access' );


class App_Base{
	public function alap()
	{
		
		
		
	}
	public function joghiba()
	{
		if ($_SESSION['userid'] == 0) {
			ADT::$view = MOD::login();
		} else {
			ADT::$view = '<h2><!--#joghiba--></h2>';
		}
	}
	
}