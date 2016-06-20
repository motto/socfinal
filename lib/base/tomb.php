<?php
namespace lib\base;
defined( '_MOTTO' ) or die( 'Restricted access' );
class TOMB {
	/**
az usort fuggvény parmétereként gasználható, associativ tömbot rendez a 'cim' mező szerint.
usort($assocT, "sortByName");
	 */
	function sortByName($a, $b)
	{
		$a = $a['cim'];
		$b = $b['cim'];
	
		if ($a == $b)
		{
			return 0;
		}
	
		return ($a < $b) ? -1 : 1;
	}
	
	
	
    /**
     * ['id'=>'user1','nev'=>'otto']
     * ból:[user1=>['id'=>'user1','nev'=>'otto']
     * a kulcsmező értékét kiemeli sor kulcsnak;
     * ha több egyforma érték is van, felülírja az ORDER BY-nak megfelellően
     */
static public function  mezoToKey($dataT,$mezo='id'){
		$resT=[];
		foreach ($dataT as $dataS){
			$resT[$dataS[$mezo]]=$dataS;
		}
		return $resT;
	}
    static public function to_str($tomb)
    {
        $str = '';
        foreach ($tomb as $key => $value)
        {
            if (is_array($value))
            {
                $value =$str.self::to_str($value);
            }
         
           $str = $str . $key . ': ' . $value . '\n </br>';
            
        }
        return $str;
    }
   
}