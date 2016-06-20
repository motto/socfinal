<?php
defined( '_MOTTO' ) or die( 'Restricted access' );
//egy modul önálló futtaására használjuk ha a $_GET['mod'] nem üres s ez hívódik meg

use lib\base\Base;
use mod;
use lib\base\OB;

class ADT {
	public  static $view='';
}
$mod= Base::getGlob('mod','login'); //alapértelmezett a login
ADT::$view=OB::res($mod);