<?php
//session_start();
define("DS", "/"); define("_MOTTO", "igen");
//use  lib\db ;

include 'def.php';
//db\Connect::connect();//GOB::$db-be létrehozza az adatbázis objektumot

//include 'test/mod/login/t_login.php';

class GOBT{
	static public  $resT;
}


//include 'test/lib/base/t_task.php';
//include 'test/lib/base/t_link.php';
//include 'test/lib/base/t_ob.php';
//include 'test/lib/ell/t_ell.php';
//include 'test/lib/base/t_base.php';
//probák  nem tesztek!!!!!!!---------------------------------
include 'test/lib/html/t_html.php';
//include 'test/lib/base/p_file.php';
//include 'test/lib/itemview/p_itemview.php'; 
if(empty(GOBT::$resT)){echo "\n a tesztek sikeresen lefutottak!";}else{
echo"\n A kovetkező tesztek nem futottak le sikeresen: ";
foreach(GOBT::$resT as $clas=>$func){ echo "\n class:".$clas." func: ";}	
foreach($func as $funcnev=>$val){ echo $funcnev.",".$val."; ";}

}
echo 'Futás idő:'.(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']).'microsec';
//ObMo_St::res();