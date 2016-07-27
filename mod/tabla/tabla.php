<?php
namespace mod\tabla;

use lib\base\LINK;
defined( '_MOTTO' ) or die( 'Restricted access' );

class ADT{
    
/**
egyben a tasknév is Ellenőrizni kell a GOB::modT-ben és sorszámozni
 */
static public  $modnev='Tab';     
static public  $glyph=True; //ha false képeket használ    
static public  $rendez_sor=true;    
static public  $fejlec=true;
static public  $checkbox=true;
static public  $pubikon=true;
static public  $dataT;
static public  $dataszerkT;
/**
 Ha egy rekordban azon a kulcso szerepel az az érték, akkor a rekord nem jelenik meg
 PL ['name'=>['motto','Admin'],'id'=>['11']] (a felhasználók a mottto és az admin névvel  és a 11-es iddel nem jelennek meg  )
 */
static public  $norekordT=[];
static public  $cssFile='';//elérési utat kell megadni ha sját css-akarunk
static public  $css='';
public static $trT=['lt_fromLT'];
public static $iconDir='res/ico/16';
public static $imagesT=['up'=>'up.png','down'=>'down.png','pub'=>'published.png','unpub'=>'unpublished.png'];
public static $glyphT=['up'=>'chevron-up','down'=>'chevron-down','pub'=>'ok','unpub'=>'remove'];
public static $LT=['up'=>'Fel','down'=>'Le','pub'=>'Pub','unpub'=>'Unpub','del'=>'Töröl'];
}

class Tabla 
{
    public $ADT=[];
    public function __construct($parT=[]){
        $this->ADT = get_class_vars('\mod\tabla\ADT');

        foreach ($parT as $name => $value)
        {$this->ADT[$name]=$value;}
   
    }
    public function glyphIcon($task)
    {   
      $glyph=$this->ADT['glyphT'][$task] ?? '';
      return '<span style="font-size: 1.6em;margin-bottom:10px;"
        		class="glyphicon glyphicon-'.$glyph.'">';
    }
    public function imageIcon($task)
    {
        $img=$this->ADT['imagesT'][$task] ?? '';
        return '<img src="'.$this->ADT['iconDir'].'/'.$img.'"/>';
    }
    public function ikon($task)
    {       

    if($this->ADT['glyph']){$icon=$this->glyphIcon($task);}
    else{$icon=$this->imageIcon($task);}
 
    return $icon;
    }
   public function checkbox_mezo($rekord=[])
    {
        return '<input type="checkbox" class="tabcheck" name="sor[]" value="'.$rekord['id'].'" />';
    }
    
    public function pub_mezo($rekord=[])
    {
        if($rekord['pub']>0){return $this->ikon('pub');}
        else{return $this->ikon('unpub');}
    }
    
    public   function orderikon($mezonev){
        $link =\lib\base\LINK::GETcsereT(['rendez'=>$mezonev,'mod'=>$mezonev]);
    
        $link=LINK::getcsere('rendez='.$mezonev);
        $link=LINK::getcsere('tab='.$this->tablanev,$link);
        $linkUp=LINK::getcsere('tab=',$link);
        $linkUp=LINK::getcsere('order=up',$link);
        $iconUp='<a href="'.$linkUp.'"></a>'.ADT::$up.'</a>';
        $linkDown=LINK::getcsere('order=down',$link);
        $iconDown='<a href="'.$linkDown.'"></a>'.ADT::$down.'</a>';
        $html=$iconUp.$iconDown;
        return $html;
    }

    public function mezo($data="")
    {
        $html="<td>".$data."</td>";
        return $html;
    }

    public function sor($datasor)
    {
        $html='<tr>';
        if($this->ADT['checkbox']){$html.='<td></td>';}
        if($this->ADT['pubikon']){$html.='<td></td>';}
        
        foreach($this->ADT['dataszerkT'] as $key=> $mezotomb)
        {
            $data=' ';   
            if(isset($datasor[$key])) {$data=$datasor[$key];}
			if(isset($mezotomb['func'])) {$func=$mezotomb['func'];$data=$this->$func($key,$datasor);}

            $html.=$this->mezo($data);
        }
        $html.='</tr>';
        return $html;
    }
    public function fejlec()
    {
        $html='<tr class="trfejlec">';
        if($this->ADT['checkbox']){$html.='<td></td>';}
        if($this->ADT['pubikon']){$html.='<td></td>';}
        foreach($this->ADT['dataszerkT']  as $mezonev => $mezotomb)
        {
           $mezonev=$mezotomb['cim'] ?? $mezonev;
           $this->mezo($mezonev);
           if(!isset($mezotomb['noorder'])){ $html.=$this->orderikon($mezonev);}
        }
        $html.="</tr>";
        return $html;
    }

    public function Res()
    {
        $html='<table>';
        $html.=$this->fejlec();
       // $html.=$this->rendez_sor();
        foreach($this->ADT['dataT'] as $datasor)
        {
             $html.=$this->sor($datasor);

        }
        $html.='</table>';
        return $html;
    }

}