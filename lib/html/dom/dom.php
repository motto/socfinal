<?php
namespace lib\html\dom;   

  //pl.: mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );

class Dom_s{
 //html manipuláló************************************************* 
 /**
A getElemT első elemével tér vissza (string)
  */   
    static   public function getElem($html,$param,$value) {
    
        return self::getElemT($html,$param,$value)[0];
    }  
 /**
A $htm stringből egy tömbbe gyűjti $param parméter $value értékével rendelkező elemeket
$param stringben több paraméter is megadhatunk|-vel elvállasztva pl.: 'lt|ltdat'
ha nem adunk meg $valuet az osszes $param -al rendelkező elemet kigyűjti
ha üreset adunk meg csak az üreseket. tesztelve 
  */   
 static   public function getElemT($html,$param,$value='([^<]*?)') {

        preg_match_all('/\<([^>]*?)([<" ])(' . $param . ') *= *"'.$value.'"([^<]*?)\>/', $html, $elemek);
        return $elemek[0];
    }

static   public function getLTSelectedT($html){
  $elemT=  self::getElemT($html,'lt|ltdat');
  foreach ($elemT as $elem) {
  	$value=self::getParamVal($elem,'placeholder');
    $nev=self::getParamVal($elem,'lt|ltdat');
    if(self::getParamVal($elem,'type')=='text'){$type='placeholder';}
    else if(in_array(self::getParamVal($elem,'type'),['button','submit']))
    {$type='button'; $value=self::getParamVal($elem,'value');   }
   	else if(self::haveSTR($elem,'<textarea')){$type='placeholder';}
    else{$type='inner';
    $value=self::getInner($html,$elem);
    } 
   $res[]=['type'=>$type,'val'=>$value,'elem'=>$elem,'nev'=>$nev];
  }
  return $res;
}

static   public function getDataSelectedT($html){
	$elemT=  self::getElemT($html,'dat|ltdat');
	foreach ($elemT as $elem) {
		$value=self::getParamVal($elem,'value');
		$nev=self::getParamVal($elem,'dat|ltdat');
		if(self::haveSTR($elem,'<input')){$type='input';
		
			if(in_array(self::getParamVal($elem,'type'),['radio','checkbox']) )
			{$type='checked';}
		
		}
		else{$type='inner';
		$value=self::getInner($html,$elem);
		}
		$res[]=['type'=>$type,'val'=>$value,'elem'=>$elem,'nev'=>$nev];
	
	}
	return $res;		
}
static   public function changeInner($view,$elem,$data){
	$ujmezo=$elem.$data.'</';
	return preg_replace("/".$elem."([^`]*?)<\//",$ujmezo, $view);
}
/**
nem használt csak egy sort vált ki
 */
static   public function ChangeElem($view,$elem,$ujelem){
	return $view= str_replace($elem,$ujelem, $view); ;
}
static   public function ChangeLT($view,$LT){
$elemT=self::getLTSelectedT($view);
foreach ($elemT as $elem) 
{

	if(isset($LT[$elem['nev']]))
	{
		switch ($elem['type']) {
		    case 'button':
		    	
		     	$ujelem=self::setParam($elem['elem'], 'value',$LT[$elem['nev']]);
		    	$view= str_replace($elem['elem'],$ujelem, $view);
		        break;
		    case 'placeholder':
		    	
		    	$ujelem=self::setParam($elem['elem'], 'placeholder',$LT[$elem['nev']]);
		 		$view=str_replace($elem['elem'],$ujelem, $view);      
		        break;
		    case 'inner':
		    	$view=self::changeInner($view,$elem['elem'],$LT[$elem['nev']]);
		        break;
		}
	}
}
return  $view;
	
}
static   public function ChangeLT($view,$dataT){
	$elemT=self::getDataSelectedT($view);
	foreach ($elemT as $elem)
	{

		if(isset($LT[$elem['nev']]))
		{
			switch ($elem['type']) {
				case 'input':
					 
					$ujelem=self::setParam($elem['elem'], 'value',$dataT[$elem['nev']]);
					$view= str_replace($elem['elem'],$ujelem, $view);
					break;
				case 'checked':
					 
					$ujelem=self::setParam($elem['elem'], 'placeholder',$dataT[$elem['nev']]);
		 		$view=str_replace($elem['elem'],$ujelem, $view);
		 		break;
				case 'inner':
					$view=self::changeInner($view,$elem['elem'],$dataT[$elem['nev']]);
					break;
			}
		}
	}
	return  $view;

}
//elem manipuláló*********************************************************  
/**
true val tér vissza ha a $textben van $str. $str lehet regex is.
 */
static   public function haveSTR($text,$str) {
	$bool=true;$match=[];
	preg_match('/'.$str.'/', $text, $match);
	if(empty($match[0])){ $bool= false;}
	return $bool;
}
static   public function getInner($html,$elem) {
	$match=[];
	preg_match('/'.$elem.'([^`]*?)<\//', $html, $match);
	if(empty($match[0])){ $bool= false;}
	return $match[1];
}

static   public function getParamBool($elem,$param) {
	$res=true;$match=[];
	preg_match('/([<" ])('.$param.') *= *"([^`]*?)"/', $elem, $match);
	if(empty($match[0])){ $res= false;}
	return $res;
}
    /** 
 tesztelve: vissatérési érték tömb!!!  res['res']=az elem $param paraméterének értéke 
 illetve ha van olyan paraméter a res['bool']=true ha nincs false.
  */  
 static   public function getParamVal($elem,$param) {
		$match=[];
       preg_match('/([<" ])('.$param.') *= *"([^`]*?)"/', $elem, $match);
 		$res=$match[3] ?? '';
 		//print_r($match);
       return $res;
      
    }
 /**
tesztelve: a $elem string $param paraméterét kicseréli $data értékkre 
 forced=true esetén (alap) ha nincs ilyen paraméter csinál
  */ 
 static   public function setParam($elem,$param,$data='',$forced=true) {
  
            preg_match('/([<" ])('.$param .' *= *)"([^`]*?)"/', $elem, $match);
           
           if (empty($match[0])) { 
               if ($forced)
               {
               	preg_match("/>|\/>/", $elem, $outT);
               	$veg=$outT[0];
                $ujvalue = ' '.$param .'="'. $data. '" '.$veg;
                $elem = preg_replace('/>|\/>/', $ujvalue, $elem);
               }
            } 
            else{
                $ujvalue = $param .'="'. $data. '"';
                $elem = str_replace( $match[2].'"'.$match[3].'"', $ujvalue, $elem); 
            }
                
        return $elem;
    }
/**
tesztelve: a setparam -ot használva a $dataT-ből tölti fel $param paramétert.
a $névparam paraméter értéke a $dataT kulcsa
 */    
static   public function setParamFromT($elem,$param='val',$nevparam='name',$dataT,$forced=true) {

        $mezonev =self::getParamVal($elem, $nevparam) ;

        if ($mezonev !='' && isset($dataT[$mezonev])) {
            
            $elem=self::setParam($elem, $param,$dataT[$mezonev],$forced);

        }
        return $elem;
    }

/**
 tesztelve: a setParamFromT -öt használva a $dataT-ből tölti fel val paramétert.
 a  $dataT kulcsát a dat (ha van) vagy ltdat parméterből veszi
 */
static public function setParamFromDataT($elem,$dataT,$forced=true){
        $elem= self::setParamFromT($elem, 'val','ltdat',$dataT,$forced);
        return  self::setParamFromT($elem,'val','dat',$dataT,$forced);
    }
    
/**
 tesztelve: a setParamFromT -öt használva a $LT-ből tölti fel placeholder paramétert.
 a  $dataT kulcsát az lt (ha van) vagy ltdat parméterből veszi
 */    
static public function setParamFromLT($elem,$LT,$forced=true){
        $elem= self::setParamFromT($elem, 'placeholder','ltdat',$LT,$forced);
        return self::setParamFromT($elem,'placeholder','lt', $LT,$forced);
    }
    
}
 class Dom_s_szotar{

    static public function toStr($langT)
    {
       $text=PHP_EOL.'$langT=[';
   
    foreach ($langT as $key=>$valT ){
      
      $text.=PHP_EOL."'".$key."'=>[";  
       // if(strlen("Hello")>50){$text.=PHP_EOL;}
       foreach ($valT as $lang=>$value) {
        $text.=PHP_EOL."'".$lang."'=>'".$value."',"; 
       }
     $text.=PHP_EOL."],";
    }
    $text=substr($text, 0, -1) ;
    $text.=']';
    return  $text;
    }
    static public function toArray($view,$langT=['hu','en','de'],$oldT=[])
    {
      $ltelemT= \lib\html\dom\Dom_s::getLTSelectedT($view);
      $resT=[];
      foreach ($ltelemT as $elemT) {    
      	$nev=$elemT['nev'];
      	$value=$elemT['val'];
              foreach ($langT as $lang){
                  $ertek='';
                  if(isset($oldT[$nev][$lang])){$ertek=$oldT[$nev][$lang];}
                  if($lang==$langT[0] && !empty($value)){$ertek=$value;} 
                    $resT[$nev][$lang]=$ertek;   
              }

      }
        return $resT; 
    }    
}

