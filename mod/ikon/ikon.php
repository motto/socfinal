<?php
namespace mod\ikon;

//defined( '_MOTTO' ) or die( 'Restricted access' );
class ADT
{
public static $noikon='noikon.png';  //Ha nincs az adott tasknak megfeleló kép
public static $noglyph='none';       //Ha nincs az adott tasknak megfeleló glyph
public static $modnev='Ico';
public static $size='16';
public static $class='';
public static $css='';
public static $js='';
public static $tasknev='task';
public static $label=true;
public static $button=True; //ha false linket generál nem nyomógombot 
public static $glyph=True; //ha false képeket használ 
public static $trT=['lt_fromLT'];
public static $iconDir='res/ico/16/'; //kell a végére: /
public static $imagesT=array('edit'=>'edit.png','new'=>'plusz.png','del'=>'torol.png','pub'=>'published.png','unpub'=>'unpublished.png','email'=>'email.png');    
public static $glyphT=array('down'=>'menu-down','up'=>'menu-up','edit'=>'edit','new'=>'plus','del'=>'trash','pub'=>'ok-circle','unpub'=>'ban-circle','email'=>'envelope');
public static $LT=array('new'=>'Új','edit'=>'Szerk','pub'=>'Pub','unpub'=>'Unpub','del'=>'Töröl','email'=>'Email');
    
}
trait Ikon_TR
{
    public function initMO($parT)
    {
        $this->ADT = get_class_vars('\mod\ikon\ADT');
        
        foreach ($parT as $name => $value)
        {$this->ADT[$name]=$value;}
         
        \GOB::$paramT['head']['css'][]=$this->ADT['css'] ?? '';
        \GOB::$paramT['head']['js'][]=$this->ADT['js'] ?? '';
         
    }

 
    public function glyphIcon($task)
    {   
        $sizeB=$this->ADT['size'] ?? '16';
        $size=$sizeB/10;
        $noglyph=$this->ADT['noglyph'] ?? 'no';
        $glyph=$this->ADT['glyphT'][$task] ?? $noglyph;
        return '<span  style="font-size: '.$size.';margin-bottom:10px;"
        		class="moikon '.$this->ADT['class'].' glyphicon glyphicon-'.$glyph.'"></span>';
    }
    public function imageIcon($task)
    {
        $noimage=$this->ADT['noikon'] ?? 'noimage.png';
        $img=$this->ADT['imagesT'][$task] ?? $noimage;
        
        return '<img class="moikon '.$this->ADT['class'].'" 
            src="'.$this->ADT['iconDir'].$img.'"/>';
    }

    public function Ikon($task)
    {
        if($this->ADT['glyph']){$icon=$this->glyphIcon($task);}
        else{$icon=$this->imageIcon($task);}
        return $icon;

    }

}
class Ikon
{
public $ADT=[];
use \mod\ikon\Ikon_TR;
public function __construct($parT=[])
{
 $this->initMO($parT);
}
}    
trait  Ikon_button_TR 
{

    public function buttonIkon($task)
    {
        $icon=$this->ikon($task);
        $label=[$task] ?? $task;
        
        if($this->ADT['label']){$label='</br>'.$label;}
        else{$label='';} 
        
        if($task=='torol'){ $oncl='onclick="return confirmSubmit(\'Az ok gombra kattintva a felhasználó végérvényesen törlődik!\')"';}
        else{$oncl='';}
        $res='<button class="btkep" type="submit" name="'.$this->ADT['tasknev'].'"  
        value="'.$task.'" '.$oncl.'>'.$icon.$label.'</button>';

        return $res;
    }
    public function linkIkon($task,$link='')
    {
        if($link==''){ $link=\lib\base\LINK::GETcsereT([$this->ADT['tasknev']=>$task]); }
        
        $icon=$this->Ikon($task); 
        $label=$this->ADT['LT'][$task] ?? $task;
        
        if($this->ADT['label']){$label='</br>'.$label;}
        else{$label='';}
        
        if($task=='torol'){ $oncl='onclick="return confirmSubmit(\'Az ok gombra kattintva a felhasználó végérvényesen törlődik!\')"';}
        else{$oncl='';}
        
        $res='<a class="btkep" href="'.$link.'"  '.$oncl.'>'.$icon.$label.'</a>';
    
        return $res;
    }
    public function ButtonOrLink($task)
    {
       
        if($this->ADT['button']){$icon=$this->glyphIcon($task);}
        else{$icon=$this->imageIcon($link);}
        return $icon;
    
    }

}  
class Ikon_button extends Ikon
{
use \mod\ikon\Ikon_button_TR;    
    
}
trait Ikon_sor_TR 
{

    public function Button($ikonsorT)
    {
        $res='<div style="float:right;margin:20px;">';
        foreach ($ikonsorT as $task) {
         $res.=  $this->ikon($task);
        }
        $res.='</div><div style="clear:both;"></div>';
        return $res;
    }
}
class Ikon_sor extends Ikon_button
{
    use \mod\ikon\Ikon_button_TR;

}

class Ikon_S
{
    public  static function Ikon($task,$parT=[]){
        $ob=new Ikon($parT);
        return $ob->ikon($task);
    
    }
    public  static function linkIkon($link,$parT=[]){
        $ob=new Ikon_button($parT);
        return $ob->linkIkon($link);
    
    }
    
    
    public  static function ButtonSor($ikonsorT=['new','edit','del','pub','unpub'],$parT=[]){
        $ob=new Ikon_sor($parT);
        return $ob->Button($ikonsorT);
        
    }
}
//echo Ikon_S::linkIkon('linkdel');
//
//echo Ikonsor_S::Res();
