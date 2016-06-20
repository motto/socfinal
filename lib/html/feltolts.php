
<?php
namespace lib\html;
use mod\MOD;

defined( '_MOTTO' ) or die( 'Restricted access' );

class FeltoltS{

    public static function hibakiir($hibatomb){
        $res='';
        foreach ($hibatomb as $hiba){
            $res =$res.'<h4>'.$hiba.'</h4>';
        }
        return $res;
    }
    static public function mod($view,$param)
    { $matches=[];
        preg_match_all ("/<!--:([^`]*?)-->/",$view , $matches);
        $mezotomb=$matches[1];
        if(is_array($mezotomb))
        {
            foreach($mezotomb as $mezo)
            {
                $view= str_replace('<!--:'.$mezo.'-->', MOD::$mezo($param), $view);
            }
        }
        return $view;
    }
/**
adat tönbből töltz fel elsősorban űrlapot.
A checkboxot értékeitstringben kell átadni.'|'-velelvállasztva. 
checkbox radiobox checked-re cserélendő értékeit <!--#'.$mezonev.'.'.$mezoertek.'-->' formátumra kell hozni
 */
    static public function data($view,$datatomb=array())
    {

        if(is_array($datatomb))
        {
            foreach($datatomb as $mezonev=>$mezoertek)
            {	
            	$mezoT=explode('|', $mezoertek);
                if(isset($mezoT[1])){
                	foreach($mezoT as $mezonev2=>$mezoertek2)
                	{
                	$view= str_replace('<!--#'.$mezonev2.'.'.$mezoertek2.'-->','checked="checked"' , $view);  		
                	}	
                	
                }
                
                $view= str_replace('placeholder="<!--#'.$mezonev.'-->"','value="'.$mezoertek.'"', $view);	
                $view= str_replace('<!--#'.$mezonev.'.'.$mezoertek.'-->','checked="checked"' , $view);
                $view= str_replace('<!--#'.$mezonev.'-->',$mezoertek, $view);
                
            }
        }
        return $view;
    }

    public static function LT($view,$datatomb)
    {
        foreach($datatomb as $datasor)
        {
            if( isset($datasor['nev']))
            {
                $csere_str='<!--##'.$datasor['nev'].'-->';
                $view= str_replace($csere_str,$datasor[\GOB::$lang] , $view);
            }

        }
        //}
        return $view;
    }
//tistit----------------------------------------------------------
    public static function tisztit($view)
    {
        $view=self::data_tisztit($view);
        $view=self::LT_tisztit($view);
        return $view;
    }
    public static function LT_tisztit($view)
    {
    	$matches=[];
        preg_match_all ("/<!--##([^`]*?)-->/",$view , $matches);
        $cseretomb=$matches[1];

        foreach($cseretomb as $mezonev)
        {

            $csere_str='<!--##'.$mezonev.'-->';
            $view= str_replace($csere_str,'', $view);


        }
        return $view;
    }
    public static function data_tisztit($view)
    {
    	$matches=[];
        preg_match_all ("/<!--#([^`]*?)-->/",$view , $matches);
        $cseretomb=$matches[1];

        foreach($cseretomb as $mezonev)
        {

            $csere_str='<!--#'.$mezonev.'-->';
            $view= str_replace($csere_str,'', $view);


        }
        return $view;
    }

}