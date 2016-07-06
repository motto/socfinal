<?php
namespace lib\html\dom\trt;
 // pl.: mod\login;
defined('_MOTTO') or die('Restricted access');

trait Dom_data_inner {

    public function inner($view, $elemT, $dataT)
    {echo $a;
        foreach ($elemT as $elem) {
            $view =lib\html\dom\Dom_s_inner::innerData($elem, $view, $dataT);
        }
        return $view;
    }
}

trait Dom_data_checked {

    public function checked($view, $elemT, $dataT)
    {
        foreach ($elemT as $elem) {
            preg_match_all("/data=\"([^`]*?)\"/", $elem, $match);
            
            $mezonev = $match[1][0];
            if (isset($dataT[$mezonev])) {
                
                preg_match("/value=\"([^`]*?)\"/", $elem, $value);
                // print_r($value);
                // echo $value[1].'+------'.$dataT[$mezonev];
                if ($value[1] == $dataT[$mezonev]) {
                    $ujmezo = '';
                    $ujvalue = 'data="' . $mezonev . '" checked="checked"';
                    $ujmezo = preg_replace("/data=\"([^`]*?)\"/", $ujvalue, $elem);
                    $view = str_replace($elem, $ujmezo, $view);
                }
            }
        }
        return $view;
    }
}

trait Dom_data_input {

    public function input($view, $elemT, $dataT)
    {
        foreach ($elemT as $elem) {
            
            $ujmezo = Dom_paramcsere::paramcsereData($elem, $dataT);
            
            $view = str_replace($elem, $ujmezo, $view);
        }
        
        return $view;
    }
}

trait Dom_LT_inner {

    public function inner($view, $elemT, $LT)
    {
        foreach ($elemT as $elem) {
            preg_match_all("/lt=\"([^`]*?)\"/", $elem, $match);
            $mezonev = $match[1][0];
            if (substr('< textarea sfdgs dfg', 0, 10) == '< textarea' || substr('<textarea sfdgs dfg', 0, 9) == '<textarea') {
                $ujmezo = Dom_paramcsere::paramcsereLT($elem, $LT);
                $view = str_replace($elem, $ujmezo, $view);
            } else {
                if (isset($LT[$mezonev])) {
                    
                    $ujmezo = $elem . $LT[$mezonev] . '</';
                    $view = preg_replace("/" . $elem . "([^`]*?)<\//", $ujmezo, $view);
                }
            }
        }
        return $view;
    }
}

trait Dom_LT_input {

    public function input($view, $elemT, $LT)
    {
        foreach ($elemT as $elem) {
            $ujmezo = Dom_paramcsere::paramcsereLT($elem, $LT);
            $view = str_replace($elem, $ujmezo, $view);
        }
        return $view;
    }
}
*
/**
 * ADT kompatibilis.
 */
trait Dom_Find {

    /**
     * A $view ADT kompatibilis.
     * a $view string $tag atribútummal ellátott tagjait
     * gyűjti ki a visszatérő tömbbe(a $tag lehet: data=\" vagy lt=\")
     */
    public function Find($view = '', $tag = '') // $tag: data=\" vagy lt=\"
    {
        if ($view == '') {
            $view = $this->ADT['view'] ?? '';
        }
        if ($tag == '') {
            $tag = $this->tag ?? '';
        }
      
    }
}

trait Dom_changeFromT
                {

    public function ChangeFromT($view, $elemT, $dataT = [])
    {
        foreach ($elemT as $func => $elem) {
            // if(function_exists($this->$func)){
            $view = $this->$func($view, $elem, $dataT);
            // }
        }
        return $view;
    }
}


/**
 * ADT kompatibilis.
 */
trait Dom_ChangeLT
                    {

    public function ChangeLT($view, $LT = [])
    {
        if ($view == '') {
            $view = $this->ADT['view'] ?? '';
        }
        if (empty($Lt)) {
            $Lt = $this->ADT['LT'] ?? '';
        }
        $ob = new Dom_changeLT();
        $view = $ob->res($view, $LT);
        return $view;
    }
}


/**
 * ADT kompatibilis.
 */
trait Dom_ChangeData
                        {

    public function ChangeData($view, $dataT = [])
    {
        if ($view == '') {
            $view = $this->ADT['view'] ?? '';
        }
        if (empty($dataT)) {
            $dataT = $this->ADT['dataT'] ?? '';
        }
        $ob = new Dom_changeDataT();
        $view = $ob->res($view, $dataT);
        return $view;
    }
}

/**
 * ADT kompatibilis.
 */
trait Dom_ChangeFull {
    use Dom_ChangeLT;
    use Dom_ChangeData;

    /**
     * ADT kompatibilis.
     * a $view string data és lt atribútummal ellátott tagjaiba
     * behelyettesíti a dataT illetve az LT megfeleló elemeit.
     * kezel innerhtml, checked és input tipusú tagokat
     */
    public function Change($view = '', $dataT = [], $LT = [])
    {
        $view = $this->ChangeLT($view, $LT);
        $view = $this->ChangeData($view, $elemT, $dataT);
        
        $this->ADT['view'] = $view;
        return $view;
    }
}

