<?php
namespace lib\base\str;
defined( '_MOTTO' ) or die( 'Restricted access' );
/**
eval()-al átadhatóparaméterk az str_replace()-nek
 */
class STR_ch
{ 
static public $regx='"<<".$nev.">>", $val, $text';	
}

class STR
{
	/**
$regex-re illeszkedő tartalmak kigyüjtése pl.:$regex='/<div class=\"main\">([^`]*?)<\/div>/'
kigyujti egy tömbbe a main osztályú div-ek tartalmát
	 */
static public function kigyujt($regx,$text){
		$matches=[];
		preg_match_all ($regx, $text, $matches);
		return $matches;	
	}
	
static public function to_tomb($string, $tagolo1 = ',', $tagolo2 = ':'){
//pl.:$string='class:hhh,id:azon,name:név'
    $tomb=array();
        $tx1 = explode($tagolo1, $string);
        foreach ($tx1 as $mezo) {
            $tx2 = explode($tagolo2, $mezo);
            $tomb[$tx2[0]] = $tx2[1];
        }
        return $tomb;
    }

static public function webnev($string,$hosz=20)
    {$webnev='';
        $hungarianABC = array( 'á','é','í','ó','ö','ő','ú','ü','ű','Á','É','Í','Ó','Ö','Ő','Ú','Ü','Ű','&','#','@','$','%','/','\\');
        $englishABC = array( 'a','e','i','o','o','o','u','u','u','A','E','I','O','O','O','U','U','U','e','e','e','e','e','e','e');
        $string=str_replace($hungarianABC, $englishABC, $string);
        $webabc = array( 'a','e','i','o','u','b','c','d','f','g','h','j','k','l','m','n','p','_','q','r','s','z','v','w','x','y','t','0','1','2','3','4','5','6','7','8','9');
        $string = strtolower( $string);
        for ($n = 0; $n < strlen($string); ++$n)
        {if($n<$hosz){if (in_array($string{$n},$webabc)){$webnev=$webnev.$string{$n};}}}
        return $webnev;
    }
}