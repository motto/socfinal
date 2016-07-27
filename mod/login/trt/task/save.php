<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');
// LT: reg_kesz,database_err,passwd_saved
class Save_S{
  static   public function SaveFromSPT($ADT,$err='database_err')
    {
        $task=$ADT['task'];
        $ADT['saveRes']=true;
        
            if(isset($ADT['SPT']['password']))
            {$ADT['SPT']['password']=md5($ADT['SPT']['password']);}
            if(isset($ADT['TSK'][$task]['noSave']))
            {
              foreach($ADT['SPT'] as $key=>$value)
              {
                   if(!in_array($key,$ADT['TSK'][$task]['noSave']))
                   {      
                    $saveT[$key]=$value; 
                   }  
              }
            }else{$saveT=$ADT['SPT'];}
            
    
            $beszurtid=\lib\db\DBA::beszur_tombbol($ADT['tablanev'],$saveT);
            if($beszurtid==0)
            {
                $ADT['saveRes']=false;
                $ADT['LT']=\lib\base\TOMB::langTextToT('err',$err,$ADT['LT']);               
            }
           else{$ADT['beszurtid']=$beszurtid;} 
 return $ADT ;
    }    
    
}
trait Save{
    use \mod\login\trt\Ell;
public function Save($hibaTask,$info)
    {   
        $task=$this->ADT['task'];
        $this->ADT['TSK'][$task]['next']=$hibaTask;
        

        if ($this->Ell()) {

            $this->ADT=\mod\login\trt\task\Save_S::SaveFromSPT($this->ADT) ;
             
            if ($this->ADT['saveRes']) {
                 
                $this->ADT['LT'] =\lib\base\TOMB::langTextToT('info',$info,$this->ADT['LT']);
                $this->ADT['TSK'][$task]['next']='alap';
            }
             
        }
    }

}

trait Save_Reg{ 
use \mod\login\trt\task\Save;
use \mod\login\trt\Email;

public function Save_Reg()
{
    $this->Save('regform','reg_kesz');
    if ($this->ADT['saveRes'] && $this->ADT['email']) {
       $this->Email() ;     
    }
}

}
trait Save_passwd{
use \mod\login\trt\task\Save; 

public function Save_passwd($info='passwd_saved')
{ 
     $this->Save('passwdform','passwd_saved');  
}}