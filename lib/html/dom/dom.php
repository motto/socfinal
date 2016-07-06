<?php
namespace lib\html\dom;   

  //pl.: mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );
class Dom_s_csere{
  static   public function inner($view,$elem,$data){
      $ujmezo=$elem.$data.'</';
      return preg_replace("/".$elem."([^`]*?)<\//",$ujmezo, $view);
  } 
  static   public function lt($view,$elem,$data){
      $ujmezo=$elem.$data.'</';
      return preg_replace("/".$elem."([^`]*?)<\//",$ujmezo, $view);
  }
}
class Dom_s_jqery{
 //html manipuláló************************************************* 
 /**
A getElemT első elemével tér vissza (string)
  */   
    static   public function getElem($html,$param,$value) {
    
        return self::getElemT($html,$param,$value)[0];
    }  
 /**
A $htm stringből egy tömbbe gyűjti $param parméter $value értékével rendelkező elemeket
ha nem adunk meg $valuet az osszes $param -al rendelkező elemet kigyűjti
ha üreset adunk meg csak az üreseket. tesztelve 
  */   
 static   public function getElemT($html,$param,$value='([^<]*?)') {

        preg_match_all('/\<([^>]*?)' . $param . '="'.$value.'"([^<]*?)\>/', $html, $elemek);
        return $elemek[0];
    }
static   public function getLTSelectedT($html){
  $elemT=  self::getElemT($html,'lt');
  foreach ($elemT as $elem) {
      $nev=getParam($elem,'placeholder')['bool']
     if(!getParam($elem,'placeholder')['bool']){
         
     }
  }
  
}
static   public function getDataSelectedT($html,$param,$value='([^<]*?)'){}

//elem manipuláló*********************************************************   
    /** 
 tesztelve: vissatérési érték tömb!!!  res['res']=az elem $param paraméterének értéke 
 illetve ha van olyan paraméter a res['bool']=true ha nincs false.
  */  
 static   public function getParam($elem,$param) {
    $res['bool']=true;
        preg_match_all('/'.$param.'="([^`]*?)"/', $elem, $match);
        if(empty($match[0][0])){ $res['bool']= false;}
       $res['res']= $match[1][0] ?? '';
       return $res;
      
        
    }
 /**
tesztelve: a $elem string $param paraméterét kicseréli $data értékkre 
 forced=true esetén (alap) ha nincs ilyen paraméter csinál
  */ 
 static   public function setParam($elem,$param,$data='',$forced=true) {
  
            preg_match_all('/' . $param . '="([^`]*?)"/', $elem, $match);
           
           if (empty($match[0])) { 
               if ($forced)
               {
                $ujvalue = ' '.$param .'="'. $data. '" >';
                $elem = str_replace('>', $ujvalue, $elem);
               }
            } 
            else{
                $ujvalue = $param .'="'. $data. '"';
                $elem = preg_replace('/' . $param . '="([^`]*?)"/', $ujvalue, $elem); 
            }
                
        return $elem;
    }
/**
tesztelve: a setparam -ot használva a $dataT-ből tölti fel $param paramétert.
a $névparam paraméter értéke a $dataT kulcsa
 */    
static   public function setParamFromT($elem,$param='val',$nevparam='name',$dataT,$forced=true) {

        preg_match_all('/'.$nevparam.'="([^`]*?)"/',$elem , $match);
        $mezonev = $match[1][0] ?? '';

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
      $ltelemT= \lib\html\dom\Dom_s_find::lt($view,true);
      $resT=[];
      foreach ($ltelemT as $key => $elemek) {    
         foreach ($elemek as $nev => $elem) {   
             $textarea=false;$value=[];
            if (substr($elem, 0, 9) == '<textarea' || substr($elem,0, 10) == '< textarea')
            {$textarea=true;}   
            if($key=='input' || $textarea)
            {preg_match('/placeholder="([^`]*?)\"/', $elem,$value );}
            else{preg_match('/'.$elem.'([^`]*?)<\//', $view,$value );}
              foreach ($langT as $lang){
                  $ertek='';
                  if(isset($oldT[$nev][$lang])){$ertek=$oldT[$nev][$lang];}
                  if($lang==$langT[0] && !empty($value[1])){$ertek=$value[1];} 
                    $resT[$nev][$lang]=$ertek;   
              }
        }
      }
        return $resT; 
    }    
}

class Dom_s_find{
   /**
alap függvény, $view stringből kigyűjti egy több dimenziós tömbbe 
a $tag taggal rendelkező elemeket. Tömb kulcsok: 'input','checked','inner' . 
    */ 
    static   public function find($view,$tag,$res = [],$uniq=false)
    {
            preg_match_all("/\<([^>]*?)" . $tag . "([^`]*?)\>/", $view, $elemek);
           $nev3=0;$nev1=0;$nev2=0;
            foreach ($elemek[0] as $elem) {
              
               if($uniq){preg_match('/'. $tag . '([^`]*?)\"/', $elem, $nev);
               $nev3=$nev1=$nev2=$nev[1] ?? null;
               }
                if (substr($elem, 0, 6) == '<input' || substr($elem, 7) == '< input') 
                {
                    preg_match('/type="(radio|checkbox)"/', $elem, $checked);
         
                    if (empty($checked)) {
                       if(!$uniq) {$nev3++;} 
                        $res['input'][$nev3] = $elem;
                    } else {
                       if(!$uniq) {$nev1++;} 
                        $res['checked'][$nev1] = $elem;
                    }
                }              
                else {
                    if(!$uniq) {$nev2++;} 
                    $res['inner'][$nev2] = $elem;
                }
            }
        return $res;
    }
   
    static public function data($view){
       $res= self::find($view,'dat="');
       return self::find($view,'ltdat="',$res);
    }
    static public function lt($view,$uniq=false){
       $res= self::find($view,'lt="',[],$uniq);
       return self::find($view,'ltdat="',$res,$uniq);
    }
    
}




/**
 függőség elkerüló osztály az ugynilyen nevű trait használja
 */
/*
 class Dom_changeLT
 {
 use Dom_lt_inner ;
 use Dom_lt_input ;
 use Dom_changeFromT ;
 use Dom_find;

 public function res($view, $LT = [])
 {
 $elemT = $this->Find($view, 'lt=\"');
 return $this->changeFromT($view, $elemT, $LT); // $view
 }
 }
 /**
 függőség elkerüló osztály az ugynilyen nevű trait használja
 */
/*
 class Dom_changeData
 {
 use Dom_data_checked ;
 use Dom_data_input ;
 use Dom_data_inner ;
 use Dom_changeFromT ;
 use Dom_find;

 public function res($view, $dataT = [])
 {
 $elemT = $this->Find($view, 'data=\"');
 return $this->changeFromT($view, $elemT, $dataT); // $view
 }
 }
 
 }
 class Dom_s_inner{
 static public function inner($elem,$nevparam,$view,$dataT){
 preg_match_all('/'.$nevparam.'([^`]*?)"/',$elem , $match);
 $mezonev= $match[1][0] ;
 if(isset($dataT[$mezonev]))
 {
 $ujmezo=$elem.$dataT[$mezonev].'</';
 $view= preg_replace("/".$elem."([^`]*?)<\//",$ujmezo, $view);
 }
 return $view;
 }
 static public function innerData($elem,$view,$dataT){
 return self::inner($elem,'value="',$view,$dataT) ;
 }
 static public function innerLt($elem,$view,$LT){
 return self::inner($elem,'lt="',$view,$LT) ;
 }
  
 }

 */

