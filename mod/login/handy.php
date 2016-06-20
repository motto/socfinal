<?php
class Handy{
	public static function hibakiir($ADT)
	{
		$result='';
		if(isset(\GOB::$hiba[$ADT::${'modnev'}]))
		{ $hibaT = array_unique(\GOB::$hiba[$ADT::${'modnev'}]);
		foreach($hibaT as $hiba)
		{
			$result.=$hiba.'</br>';
		}
		}
		return $result;
	}	
	
	public static function safePOST($val,$res='')
	{
		if(isset($_POST[$val])){$res=$_POST[$val];}
		return $res;
	}
}