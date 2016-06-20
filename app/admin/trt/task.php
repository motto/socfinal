<?php
namespace app\admin\trt;
defined( '_MOTTO' ) or die( 'Restricted access' );
use lib\db\DB;
use lib\db\DBA;
use mod\MOD;

trait Task_ment{ public function ment()
{
	$this->data_ment();
	$this->alap();
}}
trait Task_ment_esuj{ public function ment_esuj()
{
	$this->data_ment();
	$this->uj();
}}

trait Task_cancel{ public function cancel()
{
	$this->alap();
}}
trait Task_uj{ public function uj()
{
	$this->view_ujurlap();
}}
trait Task_szerk{ public function szerk()
{
	$this->view_ujurlap();
	$this->dba_urlapData();
	$this->view_urlapFeltolt();
	

}}

trait Task_torol{ public function torol()
{
	$this->dba_torol();
	//DBA::tobb_del(PAR::$tablanev,ADT::$idT);
	$this->alap();
}}

trait Task_pub{ public function pub()
{	$this->dba_pub();
	//DBA::tobb_pub(PAR::$tablanev,ADT::$idT);
	$this->alap();
}}
trait Task_unpub{ public function unpub()

{
	//DBA::tobb_unpub(PAR::$tablanev,ADT::$idT);
	$this->alap();
}}

trait Task_joghiba{ public function joghiba()
{
	if($_SESSION['userid']==0)
	{ADT::$view=MOD::login();}
	else
	{ADT::$view='<h2><!--#joghiba--></h2>';}

}}

