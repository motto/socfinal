<?php
namespace test\lib\html;


class T_dom{
//use Dom_data_Find;
	static public function fejlec(){
	    $view=file_get_contents('test/view/testform.html',true);
	    $dataT['input1']='új input 1 value';
	    $dataT['div1']='div1 value';
	    $dataT['text2']='text1 value';
	    $dataT['age']='radio2';
	    $dataT['hiden-1']='hidden1';
	    $dataT['cbox']='checkbox1';
	    
	    $LT['div1']='div1 LT value';
	    $LT['text1']='text1 LT value';
	    $LT['age']='radio2';
		echo "\n T_html::fejlec: ";

	/*	if(OB::res('lib\html\Fejlec',['cpT'=>\GOB::$headT])==$res1){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTML']['fejlec']='1';
		}*/	
		
	}
	
}
class T_szotar{
    
    static public function toStr(){
       $view=file_get_contents('test/view/testform.html',true); 
       $oldT=['text2'=>[
           'hu'=>'fffff',
           'en'=>'',
           'de'=>'gggggggggg',
       ],'text1'=>[
           'hu'=>'text1 placeholder ujjjj',
           'en'=>'hhhhhhhh',
           'de'=>'',
       ]];
       $arr=\lib\html\dom\Dom_s_szotar::toArray($view,['hu','en','de'],$oldT);
       echo \lib\html\dom\Dom_s_szotar::toStr($arr);
    }
    static public function getparam(){
        $elem='< asdfhswfh id="fghfd"  val="25" gg="">';
      $g=\lib\html\dom\Dom_s_jqery::getParam($elem, 'fdggdf')['res'];
   if(!\lib\html\dom\Dom_s_jqery::getParam($elem, 'sdfsdf')['bool']) {echo 'fales';}else{
       echo $g; }
    
    }
    static public function setParam(){
        $elem='< asdfhswfh id="fghfd"  val="25">';
        print_r( \lib\html\dom\Dom_s_jqery::setParam($elem, 'id','12',true));
    
    }
    static public function setParamFromT(){
        $elem='< asdfhswfh id="fghfd"  val="25">';
        $dataT=['fghfd'=>'ujvalue'];
        print_r( \lib\html\dom\Dom_s_jqery::setParamFromT($elem, 'gg','id',$dataT,true));
    
    }
    static public function setParamFromDataT(){
        $elem='< asdfhswfh dat="fghfd"  >< ltdat="fghfd" >';
        $dataT=['fghfd'=>'ujvalue'];
        print_r( \lib\html\dom\Dom_s_jqery::setParamFromDataT($elem,$dataT));
    
    }
    static public function setParamFromLT(){
        $elem='< ltdat="fghfd">';
        $LT=['fghfd'=>'ujvalue','11'=>'11value'];
        print_r( \lib\html\dom\Dom_s_jqery::setParamFromLT($elem,$LT));
    
    }
    
    static public function getElemT(){
        $html=file_get_contents('test/view/testform.html',true); 
        print_r( \lib\html\dom\Dom_s_jqery::getElemT($html, 'lt'));
    
    }
    
}	
echo "Test_Dom:------------- ";

//T_szotar::tostr();
T_szotar::getparam();
//T_szotar::getElemT();
//T_szotar::setParam();
//T_szotar::setParamFromT();
//T_szotar::setParamFromDataT();
//T_szotar::setParamFromLT();


//print_r(\lib\html\dom\Dom_s_find::find($view,'data="'));
//print_r(\lib\html\dom\Dom_s_find::find($view,'lt="'));
//print_r(\lib\html\dom\Dom_s_find::lt($view));
//print_r(\lib\html\dom\Dom_s_find::data($view));

/*
$str= json_encode($arr); $str=  str_replace('{','[', $str);
$str=  str_replace(':','=', $str);$str=  str_replace(',',','.PHP_EOL, $str);
echo str_replace('}',']', $str);
*/

//\lib\html\dom\Dom_s_szotar::toStr($arr);

//