<?php
namespace mod\tabla;
use lib\base\OB_Mo;
use lib\base\LINK;
defined( '_MOTTO' ) or die( 'Restricted access' );

class ADT{
//ikonok------------	
public static $up='<span class="tabglyf glyphicon glyphicon-">';
public static $down='<span class="tabglyf glyphicon glyphicon-chevron-down">';	
public static $pub='<span class="tabglyf tpub glyphicon glyphicon-ok">';
public static $unpub='<span class="tabglyf tunpub glyphicon glyphicon-remove">';
}
trait orderikon_glyph{
	 public   function orderikon($mezonev,$rekord=[]){
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
}
class Tabla_handi{
	 public  function link($mezonev,$rekord=[],$link){
		
	}
	
	
	static public function pub_mezo($mezonev,$rekord=[])
	{ 
	if($rekord['pub']>0){return ADT::$pub;}
	else{return ADT::$unpub;}
	}
  
	static public function checkbox_mezo($mezonev,$rekord=[])
    { 
    return '<input type="checkbox" class="tabcheck" name="sor[]" value="'.$rekord['id'].'" />';  
    }
  
	
}

class Tabla extends OB_Mo
{
	public  $tablanev='t1'; 
    public  $datatomb;   
    public  $dataszerk;
    /**
Ha egy rekordban azon a kulcso szerepel az az érték, akkor a rekord nem jelenik meg
PL ['name'=>['motto','Admin'],'id'=>['11']] (a felhasználók a mottto és az admin névvel  és a 11-es iddel nem jelennek meg  )
     */
    public  $norekordT=[];
    public  $fejlec=true;
    public  $css='';//elérési utat kell megadni ha sját css-akarunk
    public  $rendez_sor=true;


    public function mezo($data="")
    {
        $html="<td>".$data."</td>";
        return $html;
    }

    public function sor($datasor)
    {
        $html='<tr>';
        foreach($this->dataszerk as $key=> $mezotomb)
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
        foreach($this->dataszerk as $mezonev=> $mezotomb)
        {
            if(isset($mezotomb['cim'])){$mezonev=$mezotomb['cim'];}
           $this->mezo($mezonev);
            if(!isset($mezotomb['noorder'])){ $html.=$this->rendez_sor;}
        }
        $html.="</tr>";
        return $html;
    }
    public function rendez_sor()
    {
        $html='<tr>';
        foreach($this->dataszerk as $mezotomb)
        {
            $data=$this->rendez_mezo($mezotomb['cim']);
            $html=$html.$this->mezo($data);
        }
        $html=$html.'</tr>';
        return $html;
    }
    public function __toString()
    {
         $html='<table>';
        $html.=$this->fejlec();
        $html.=$this->rendez_sor();
        foreach($this->datatomb as $datasor)
        {
             $html.=$this->sor($datasor);

        }
        $html.='</table>';
        return $html;
    }

}