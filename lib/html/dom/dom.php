<?php
namespace html\dom;   //pl.: mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait Dom_data_Find {
   public  $reg=''; 
 
  /* 
   * 
   'DIV'=>'#<div[^>]*>(.*?)</div>#', //le kell ellenőrizni
   'DIV_CLASS'=>'/<div class=\"main\">([^`]*?)<\/div>/'
   
   */
   
    function Find() {
      $matches=[];
        preg_match_all ("/<input([^`]*?)/>/",$view , $matches);
        $mezotomb=$matches[1];
        print_r($matches[1]);
    }
}