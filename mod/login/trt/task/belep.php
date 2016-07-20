<?php
namespace mod\login\trt\task;

defined('_MOTTO') or die('Restricted access');

trait Belep{
    
    use \mod\login\trt\Ell;

    public function Belep()
    {
        $task=$this->ADT['task'];
        if ($_SESSION['userid'] != 0) {
        // echo '1111111111'.$_SESSION['userid'] ;   
            $this->ADT['TSK'][$task]['next'] = 'kilepform';
        } else {
            
            if ($this->Ell()) {
               //echo 'ell ok';
               $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
              //  $url =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                
               header("Location: $url"); /* ujratölt */
                exit();
            } else {
                
               $this->ADT['TSK'][$task]['next'] = 'belepform';
            }
        }
    }
}
