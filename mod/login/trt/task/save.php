<?php
use lib\db\DBA;
use mod\login\ModLT;

trait save{ public function tres($ADT,$TSK,$task='save')
{
		$beirT=$this->ell($TSK::${$task}['ell']);
		
		if(empty(\GOB::$hiba[$ADT::${'modnev'}]))
		{
			$beszurtid=DBA::beszur_tombbol($ADT::$tablanev,$beirT);
			if($beszurtid==0)
			{
				\GOB::$hiba[$ADT::${'modnev'}][]=ModLT::$lang['dberror'];
				$TSK::${$task}['hiba']=true;
			}
			
		}else
		{$TSK::${$task}['hiba']=true;}
		
		return $ADT;
}}