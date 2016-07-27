<?php
session_start();
define("DS", "/"); define("_MOTTO", "igen");

use lib\db ;
use lib\jog\Azonosit;
use lib\base\Base;
//use lib\html\Fejlec_s;
//use  lib\base ;

include 'def.php';
if(CONF::$offline=='igen'&& !GOB::get_userjog('admin.php'))
{die(CONF::$offline_message);}

db\Connect::connect();//GOB::$db-be létrehozza az adatbázis objektumot

//azonosítás-------------
if(isset($_POST['ltask']) && $_POST['ltask']=='kilep'){ $_SESSION['userid'] = 0;}
$azon= new \lib\jog\Azonosit();
GOB::$userT=$azon::set_userdata($_SESSION['userid']);
GOB::set_userjog();

GOB::$lang=Base::setLang(CONF::$baseLang);

GOB::$tmpl=$_GET['tmpl'] ?? CONF::$baseTmpl;


//applikáció becsatolás-----------------------------
GOB::$app=$_GET['app'] ?? CONF::$baseApp;
//GOB::$app= $_POST['app'] ??  GOB::$app;
include_once 'app/'.GOB::$app.'/'.GOB::$app.'.php';

lib\html\Fejlec_s::ChangeFull(\GOB::$paramT);

echo GOB::$html;
