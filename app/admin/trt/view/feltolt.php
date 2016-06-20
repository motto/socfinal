<?php
namespace app\admin\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
trait File_traitnev{ public function funcnev()
{
	$this->alap();
}}

foreach (ADT::$langT as $lang)
{
	$sql="SELECT c.id,c.pub,cl.cim,cl.szoveg FROM cikk c INNER JOIN cikk_lang cl ON c.id=cl.cikk_id WHERE c.id='".ADT::$idT[0]."' AND lang='$lang' ";
	$datasor=DB::assoc_sor($sql);
	if(!empty($datasor))
	{
		ADT::$view=str_replace('<!--#cim:'.$lang.'-->',$datasor['cim'] ,ADT::$view);
		ADT::$view=str_replace('<!--#szoveg:'.$lang.'-->',$datasor['szoveg'] ,ADT::$view);
	}
}
ADT::$view=str_replace('value="<!--#id-->"', 'value="'.ADT::$idT[0].'"',ADT::$view);
}