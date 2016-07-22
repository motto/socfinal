<?php
namespace app\admin;

defined( '_MOTTO' ) or die( 'Restricted access' );
\GOB::$tmpl='flat';

$file=$_GET['fg'] ?? 'base';
if($file!='base'){include_once 'app/admin/'.$file.'.php';}
else{
    
$sap=$_GET['sap'] ?? 'base';    //subApp (könyvtár)
$ini=$_GET['in'] ?? 'base';    //ini file ami az ADT és a TSK ostályokat tartalmazza
include_once 'app/admin/'.$sap.'/'.$ini.'.php';   
    
}


eval(\lib\base\Ob_TrtS::str('AdminBase',$TRT));


class Admin extends \AdminBase
{
    public $ADT=[]; //az Ob_Trt::str -el előállított osztályokban benne van!

    public function __construct($parT = []){
        $this->ADT = get_class_vars('ADT');
        $this->ADT['TSK']=get_class_vars('TSK');
        //$this->setADT($parT);
    
    }
 
    public function Login($parT=[])
    {
        $this->ADT['LT']=\mod\login\LT::$hu;
         
        //futtatamdó task előállítása
        $this->GetTask('task');//trt: getTask
  
        //modulnev+task osztály generálás futtatás
        $this->Task();
       
        $this->ChangeData();
       // $this->ChangeLT();
        return $this->ADT['view'];
    }

}

$admin=new Admin();

?>