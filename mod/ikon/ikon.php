<?php
namespace mod\ikon;

//defined( '_MOTTO' ) or die( 'Restricted access' );
class ADT
{
public static $noikon='noikon.png'; 
public static $noglyph='none';
public static $modnev='Ikonsor';
public static $tasknev='task';
public static $glyph=True; //ha false képeket használ 
public static $trT=['lt_fromLT'];
public static $iconDir='res/ico/16';
public static $imagesT=array('edit'=>'edit.png','new'=>'plusz.png','del'=>'torol.png','pub'=>'published.png','unpub'=>'unpublished.png','email'=>'email.png');    
public static $glyphT=array('edit'=>'edit','new'=>'plus','del'=>'trash','pub'=>'ok-circle','unpub'=>'ban-circle','email'=>'envelope');
public static $LT=array('new'=>'Új','edit'=>'Szerk','pub'=>'Pub','unpub'=>'Unpub','del'=>'Töröl','email'=>'Email');
    
}
class Ikon
{
    public $ADT=[];
    public function __construct($parT=[])
    {
        $this->ADT = get_class_vars('\mod\ikonsor\ADT');

        foreach ($parT as $name => $value)
        {$this->ADT[$name]=$value;}
     
    }
    public function glyphIcon($task)
    {   
        $noglyph=$this->ADT['noglyph'] ?? 'no';
        $glyph=$this->ADT['glyphT'][$task] ?? $noglyph;
        return '<span style="font-size: 1.6em;margin-bottom:10px;"
        		class="glyphicon glyphicon-'.$glyph.'">';
    }
    public function imageIcon($task)
    {
        $noimage=$this->ADT['noikon'] ?? 'noimage.png';
        $img=$this->ADT['imagesT'][$task] ?? $noimage;
        return '<img src="'.$this->ADT['iconDir'].'/'.$img.'"/>';
    }

    public function ikon($task)
    { 
    if($this->ADT['glyph']){$icon=$this->glyphIcon($task);}
    else{$icon=$this->imageIcon($task);}
    return $icon;
  ;
    }
    public function buttonIkon($task)
    { 
     $res='';
    $res.=$this->ikon()
    if(isset($this->ADT['LT'][$task]))
    {$label=$this->ADT['LT'][$task];}
    else{$label=$task;}
    if($task=='torol'){ $oncl='onclick="return confirmSubmit(\'Az ok gombra kattintva a felhasználó végérvényesen törlődik!\')"';}
    else{$oncl='';}
    $res.='<button class="btkep" type="submit" name="'.$this->ADT['tasknev'].'"  value="'.$task.'" '.$oncl.'>'.$icon.'</span></br>'.$label.'</button>';
    
    return $res;
    }
    
    
    
}    
    class Ikonsor
    {
        public $ADT=[];
        public function __construct($parT=[]){
            $this->ADT = get_class_vars('\mod\ikonsor\ADT');
            //print_r($this->ADT);
            foreach ($parT as $name => $value)
            {$this->ADT[$name]=$value;}
            /* $gobT=\GOB::$paramT['Ikonsor'] ?? [];
             foreach ($gobT as $name => $value)
             {$this->ADT[$name]=$value;}*/
        }
        public function glyphIcon($task)
        {   $glyph=$this->ADT['glyphT'][$task] ?? $this->ADT['noglyph'];
        return '<span style="font-size: 1.6em;margin-bottom:10px;"
        		class="glyphicon glyphicon-'.$glyph.'">';
        }
        public function imageIcon($task)
        {
            $img=$this->ADT['imagesT'][$task] ?? $this->ADT['noikon'];
            return '<img src="'.$this->ADT['iconDir'].'/'.$img.'"/>';
        }
    
        public function buttonIkon($task)
        {       $res='';
        if($this->ADT['glyph']){$icon=$this->glyphIcon($task);}
        else{$icon=$this->imageIcon($task);}
        if(isset($this->ADT['LT'][$task]))
        {$label=$this->ADT['LT'][$task];}
        else{$label=$task;}
        if($task=='torol'){ $oncl='onclick="return confirmSubmit(\'Az ok gombra kattintva a felhasználó végérvényesen törlődik!\')"';}
        else{$oncl='';}
        $res.='<button class="btkep" type="submit" name="'.$this->ADT['tasknev'].'"  value="'.$task.'" '.$oncl.'>'.$icon.'</span></br>'.$label.'</button>';
    
        return $res;
        }
    
    
    
        public function Res($ikonsorT)
        {
            $res='<div style="float:right;margin:20px;">';
            foreach ($ikonsorT as $task) {
                $res.=  $this->ikon($task);
            }
            $res.='</div><div style="clear:both;"></div>';
            return $res;
        }
    }



    public function Res($ikonsorT)
    {
        $res='<div style="float:right;margin:20px;">';
        foreach ($ikonsorT as $task) {
            $res.=  $this->ikon($task);
        }
        $res.='</div><div style="clear:both;"></div>';
        return $res;
    }
}


class Ikon_sor
{
public $ADT=[];    
   public function __construct($parT=[]){
       $this->ADT = get_class_vars('\mod\ikonsor\ADT');
       //print_r($this->ADT);
       foreach ($parT as $name => $value)
		{$this->ADT[$name]=$value;}
      /* $gobT=\GOB::$paramT['Ikonsor'] ?? [];
		foreach ($gobT as $name => $value)
		{$this->ADT[$name]=$value;}*/
   }
    public function glyphIcon($task)
    {   $glyph=$this->ADT['glyphT'][$task] ?? $this->ADT['noglyph'];
        return '<span style="font-size: 1.6em;margin-bottom:10px;"
        		class="glyphicon glyphicon-'.$glyph.'">';
    }  
    public function imageIcon($task)
    {  
        $img=$this->ADT['imagesT'][$task] ?? $this->ADT['noikon'];
         return '<img src="'.$this->ADT['iconDir'].'/'.$img.'"/>';
    }
    
    public function ikon($task)
    {       $res='';
            if($this->ADT['glyph']){$icon=$this->glyphIcon($task);}
            else{$icon=$this->imageIcon($task);}
            if(isset($this->ADT['LT'][$task]))
            {$label=$this->ADT['LT'][$task];}
            else{$label=$task;}
            if($task=='torol'){ $oncl='onclick="return confirmSubmit(\'Az ok gombra kattintva a felhasználó végérvényesen törlődik!\')"';}
            else{$oncl='';}
            $res.='<button class="btkep" type="submit" name="'.$this->ADT['tasknev'].'"  value="'.$task.'" '.$oncl.'>'.$icon.'</span></br>'.$label.'</button>';
 
        return $res;
    }
    
    
    
    public function Res($ikonsorT)
    {
        $res='<div style="float:right;margin:20px;">';
        foreach ($ikonsorT as $task) {
         $res.=  $this->ikon($task);
        }
        $res.='</div><div style="clear:both;"></div>';
        return $res;
    }
}
class Ikonsor_S
{
    public  static function Ikon($task='edit',$parT=[]){
        $ob=new Ikonsor($parT);
        return $ob->ikon($task);
    
    }
    public  static function Res($ikonsorT=['new','edit','del','pub','unpub'],$parT=[]){
        $ob=new Ikonsor($parT);
        return $ob->Res($ikonsorT);
        
    }
}

echo Ikonsor_S::Ikon();
//echo Ikonsor_S::Res();
