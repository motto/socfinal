<?php
namespace lib\html\dom\trt;
 // pl.: mod\login;
defined('_MOTTO') or die('Restricted access');

/**
 * ADT kompatibilis.
 */
trait Dom_ChangeLT
{
    public function ChangeLT($view='', $LT = [])
    {
        if ($view == '') { $view = $this->ADT['view'] ?? '';}
        if (empty($LT)) { $LT= $this->ADT['LT'] ?? '';}
        
      $this->ADT['view'] = \lib\html\dom\Dom_s::ChangeLT($view, $LT);    
    }
}


/**
 * ADT kompatibilis.
 */
trait Dom_ChangeData
                        {

    public function ChangeData($view='', $dataT = [])
    {
        if ($view == '') { $view = $this->ADT['view'] ?? '';}
        if (empty($dataT)) { $dataT = $this->ADT['dataT'] ?? '';}
        
       $this->ADT['view'] = \lib\html\dom\Dom_s::ChangeData($view, $dataT);  
    }
}


