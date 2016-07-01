<?php
trait Lang_FromFile { public  function  FromFile ($file=''){
    
   // $html= file_get_contents( $this->htmlF,true);
   $html= file_get_contents( $file,true);
    preg_match_all ("/".$this->nyitokulcs."([^`]*?)".$this->zarotag."/",$html , $matches);
    $text='$langT=[';
    //echo $html;
    foreach ($matches[1] as $match){
        $T=explode('-o-->', $match);
      $text.=PHP_EOL."'".$T[0]."'=>[";  
       // if(strlen("Hello")>50){$text.=PHP_EOL;}
     $text.=PHP_EOL."'".$this->baseLang."'=>'".$T[1]."',";
     $text.=PHP_EOL."'".$this->ujLang."'=>'  '";
     $text.=PHP_EOL."],";
    }
    $text=substr($text, 0, -1) ;
    $text.=']';
    return  $text;
// $this->toFile($text, $this->savepath);

}}
trait Lang_FromDir{ 
  use Lang_FromFile ;  
    public    function FromDir($dir,$recur=false){
    $text='';
if ($handle = opendir($dir)) {
		while (false !== ($entry = readdir($handle))) {
	
				if ($entry != "." && $entry != "..") {
					if(is_file($dir.'/'.$entry)){
					  $text.=PHP_EOL.'File: '.$dir.'/'.$entry.PHP_EOL;  
					  $text.= $this->FromFile($dir.'/'.$entry) ;
					}
					if(!$recur && is_dir($dir.'/'.$entry)){
					  $text.=PHP_EOL.'Dir: '.$dir.'/'.$entry.PHP_EOL;    	
					  $text.=$this->FromDir($dir.'/'.$entry,true);  	
					}
				}
			}
			closedir($handle);
		}
    return  $text;
    // $this->toFile($text, $this->savepath);

}}

trait Lang_Cserel{
    public    function Cserel($dataT){
        $html= file_get_contents( $this->htmlF,true);
         
        // preg_match_all ("/".$this->nyitokulcs."([^`]*?)".$this->zarotag."/",$html , $matches);
        // $text='$langT=[';
        //echo $html;
        foreach ($dataT as $key=>$data){
            $alap=$this->nyitokulcs.$key.$this->nyitotag.$data[$this->baseLang];
            $csere=$this->nyitokulcs.$key.$this->nyitotag.$data[$this->ujLang];
            $html= str_replace($alap, $csere, $html);
    
        } 
        return $html;
    } 
    
}
trait Lang{
public  $nyitotag='-o-->';
public  $zarotag='<!---->';
public  $nyitokulcs='<!--o-';
public  $baseLang='hu';
public  $ujLang='en';  
public  $savepath='tmpl/socfinal/part/ujlang.html';
public  $htmlF='tmpl/socfinal/part/socnyito.html';
public  $ujF='lang.php';


public    function toFile($content,$path,$utf8=true ){
    $fp = fopen($path, 'w');
    //fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    if($utf8) {fwrite($fp, "\xEF\xBB\xBF".$content);}
    else{fwrite($fp, $content);}
    fclose($fp);

}

} 
$langT=[
    '1'=>[
        'hu'=>'Keress pénzt otthonról!',
        'en'=>' Searching money! '
    ],
    '2'=>[
        'hu'=>'Kényelmesen, egyszerűen!',
        'en'=>' relaxing '
    ],
    '3'=>[
        'hu'=>'Biztos jövedelem,befektetés nélkül!>',
        'en'=>'  '
    ],
    '4'=>[
        'hu'=>'Az interneten számos olyan weblap érheto el,melyek látogatásonkénk fizetnek, például &nbsp;Bitcoinban. Ezeket az oldalakat másnéven fauceteknek, csaptelepeknek hívjuk. Igaz ezek az oldalak bárki számára elérhetoek, viszont felkutatásuk és rendszerezésük meglehetosen idoigényes. Ezért a Socialbittap csapata célul tuzte ki, hogy &nbsp;idorol idore összegyujti, szuri és optimalizált &nbsp;felületen elérhetové teszi felhasználói számára a megbízható és jólzeto weboldalakat.',
        'en'=>'---------  '
    ]];
class gen{
    use Lang;
    use Lang_FromDir;
}
$gen= new gen();
//echo $gen->FromFile();
echo $gen->FromDir('mod/login');

//echo $gen->cserel($langT);
/*
function general(){
  $nyitotag='lng="hu">';
  $zarotag='<!-- ##';
  $dir='tmpl/socfinal/part/';
  $htmlF='socnyito.html';
  $regiF='';
  $ujF='lang.php';
  $html= file_get_contents( $dir.$htmlF,true); 
  
  $matches=[];
  preg_match_all ("/".$nyitotag."([^`]*?)".$zarotag."/",$html, $matches);
  
  $text='$langT=[';
  
  if(is_file($dir.$regiF)){include $dir.$regiF;}
  print_r($matches[1]);
  
  foreach ($matches[1] as $match){
      if(!empty($match)){
      $oldvalue=$langT[$match] ?? '';
      
      $text.=PHP_EOL."'".$match;
      if(strlen($match)>50){$text.=PHP_EOL;}
      $text.='"=>"'.$oldvalue.'",';
      } 
  }
  $text=substr($text, 0, -1) ;
  $text.=PHP_EOL.']';
  $fp = fopen($dir.$ujF, 'w');
  //fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
  fwrite($fp, "\xEF\xBB\xBF".$text); 
  fclose($fp);
}
general();*/