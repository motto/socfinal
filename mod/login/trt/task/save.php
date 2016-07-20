<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');
class Save_S{
  static   public function SaveSPT($ADT,$err='database_err')
    {
        //$task=$this->ADT['task'];
  
            if(isset($ADT['SPT']['password']))
            {$ADT['SPT']['password']=md5($ADT['SPT']['password']);}
    
            $beszurtid=\lib\db\DBA::beszur_tombbol($ADT['tablanev'],$ADT['SPT']);
            if($beszurtid==0)
            {
                $ADT['LT']=\lib\base\TOMB::langTextToT('err',$err,$ADT['LT']);
                 
            }
 return $ADT;
    }    
    
}


trait Save{ 
use \mod\login\trt\Ell;
static   public function Save()
{

    $task=$this->ADT['task'];

    if ($this->Ell()) {
        if(isset($this->ADT['SPT']['password']))
        {$this->ADT['SPT']['password']=md5($this->ADT['SPT']['password']);}

        $beszurtid=\lib\db\DBA::beszur_tombbol($this->ADT['tablanev'],$this->ADT['SPT']);
        if($beszurtid==0)
        {
            $this->ADT['LT']=\lib\base\TOMB::langTextToT('err','database_err',$this->ADT['LT']);
             
            $this->ADT['TSK'][$task]['next']='regform';
        }
         
    }else{$this->ADT['TSK'][$task]['next']='regform';}
}

}
trait Save_passwd{
public function Save_passwd()
{
    //echo 'save-----------------------';
    $task=$this->ADT['task'];
    // $this->ADT['TSK'][$task]['next']='alap';

    if ($this->Ell()) {
        if(isset($this->ADT['SPT']['password']))
        {$passwd=md5($this->ADT['SPT']['password']);
        $sql="UPDATE userek SET password='".$passwd."' WHERE id='".$_SESSION['userid']."'";
        if(!\lib\db\DBA::parancs($sql)){
            
        }
        }
        $this->ADT['TSK'][$task]['next']='alap';
        }
    else{$this->ADT['TSK'][$task]['next']='passwdform';}
}


}