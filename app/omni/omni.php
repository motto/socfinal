<?php
use lib\base\Base;
use mod\login\Login_S;
use lib\db\DB;
use lib\db\DBA;

\GOB::$html=file_get_contents('tmpl/omni/base.html',true);  

if(isset($_GET['fajta']) && isset($_GET['valtozat'])){
    $sql="SELECT fajta,var FROM fajtak WHERE userid='".$_SESSION['userid']."'";
    $userT= DB::assoc_sor($sql);
    if(empty( $userT)){
    $sql2="INSERT INTO fajtak (userid,fajta,var) VALUES ('".$_SESSION['userid']."','".$_GET['fajta']."','".$_GET['valtozat']."')";
    DBA::parancs($sql2);
    }       
}
    


if($_SESSION['userid']==0){
 
    $content=file_get_contents('tmpl/omni/mod/nyito.html',true);  
}
else
{   $mod=$_GET['mod'] ?? 'alap';  
   $sql="SELECT fajta,var FROM fajtak WHERE userid='".$_SESSION['userid']."'";
   $userT= DB::assoc_sor($sql);
    if(empty( $userT) && $mod!='Fajtavalaszt'){
        
      $content=app\omni\mod\Fajtak::Fajtak();       
    }
    else{
   \GOB::$userT['fajta']=$userT['fajta'] ?? '';
   \GOB::$userT['var']=$userT['var'] ?? ''; 
   
    eval('$content=\app\omni\mod\\'.$mod.'::'.$mod.'();') ; 
    }

   
} 
$login=Login_S::res();
//$content=\app\omni\mod\Fajtak::csoportListaz();
GOB::$html= str_replace('<!--|login|-->',$login ,GOB::$html);
GOB::$html= str_replace('<!--|tartalom|-->',$content ,GOB::$html);







