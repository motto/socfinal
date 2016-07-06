<?php
namespace test\lib\html;


class T_html{
//use Dom_data_Find;
use Dom_ChangeFull;
	static public function fejlec(){
	
		echo "\n T_html::fejlec: ";
	\GOB::$headT['og']=[['image','gg'],['image','gg1'],['title','tit']];
	\GOB::$bodyendT['js']['b1']='js1';
	\GOB::$bodyendT['jsfile']['gg']='js3.js';
	\GOB::$bodyendT['jsfile']['gg']='js2.js';
	\GOB::$bodyT['css'][]='css1 ghej';
	\GOB::$bodyT['cssfile']=['css1'=>'csshfg.css','css1'=>'css1.css','css2.css'];
	\GOB::$bodyT['cssfile']['css1']='css1.css';
		$res1='<meta property="og:image" content="gg" /><meta property="og:image" content="gg1" /><meta property="og:title" content="tit" />';
		if(OB::res('lib\html\Fejlec',['cpT'=>\GOB::$headT])==$res1){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTML']['fejlec']='1';
		}	
			$res2='<script>js1</script><script src="js2.js"></script>';
		if(OB::res('lib\html\Fejlec',['cpT'=>\GOB::$bodyendT])==$res2){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTMLK']['fejlec']='2';
		}
			$res3='<style>css1 ghej</style><link href="css1.css" rel="stylesheet"><link href="css2.css" rel="stylesheet">';
		if(OB::res('lib\html\Fejlec',['cpT'=>\GOB::$bodyT])==$res3){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTMLK']['fejlec']='3';
		}
		\GOB::$headT=[];
		\GOB::$headT['docread']=['egyes csript,','ketes script'];
		$res4='<script> $( document ).ready(function(){egyes csript,ketes script});<script>';
		if(OB::res('lib\html\Fejlec',['cpT'=>\GOB::$headT])==$res4){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTMLK']['fejlec']='4';
		}
		
	//echo OB::res('lib\html\Fejlec',['cpT'=>\GOB::$headT]);
		$hedT=[];
		$hedT['jsGOBstr']=['a1'=>'a1value','a2'=>'a2value'];
		$res4=' <script>  var a1="a1value" ;  var a2="a2value" ;  </script> ';
		//echo OB::res('lib\html\Fejlec',['cpT'=>$hedT]);
		if(OB::res('lib\html\Fejlec',['cpT'=>$hedT])==$res4){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTMLK']['fejlec']='5';
		}
		$hedT=[];
		$hedT['jsGOBnum']=['a1'=>'1','a2'=>'2'];
		$res4=' <script>  var a1=1 ;  var a2=2 ;  </script> ';
		//echo OB::res('lib\html\Fejlec',['cpT'=>$hedT]);
		if(OB::res('lib\html\Fejlec',['cpT'=>$hedT])==$res4){echo 'OK,';}
		else{echo '!!!,';
		\GOBT::$resT['T_HTMLK']['fejlec']='6';
		}
	}
	
}


echo "TestHTML:------------- ";

echo html::get_Tmpl('test/proba.html');
//echo html::get_modTmpl('test/probamod.html','proba');


