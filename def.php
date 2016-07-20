<?php
defined( '_MOTTO' ) or die( 'Restricted access' );
function betolt($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
     $fileName =strtolower($fileName);//saját (kisbetűsítés) nem igazán kell
    if(is_file($fileName)) {require_once  $fileName;}
    //echo $fileName;
}
function betolt2($className)
{
  $classT= explode('_',$className);
    betolt($classT[0]);
}
spl_autoload_register('betolt');
spl_autoload_register('betolt2');
class CONF
{
    public static $offline = 'nem';
    public static $offline_message = 'Weblapunk fejlesztés alatt.';
    public static $baseTRT =[];
    public static $upload_dir='user/share';
    public static $adminok=array(1,2);
    public static $sql_log='full';//lehet 'no','parancs': a lekérdezéseket nem
    //lang----------------------------------- 
    public static $accepted_langT=array('hu','en');
    public static $LangMode='single';
    public static $LangForras='tomb'; //db   
    //db------------------------------- 
    public static $host = 'localhost';
    public static $felhasznalonev = 'root';
    public static $jelszo = '';
    public static $adatbazis = 'social';
    //mail-------------------------------
    public static $mailfrom= 'motto001@gmail.com';
    public static $fromnev= 'Admin';
    //smtp-----------------------------
    public static $smtpHost= 'smtp.processnet.hu'; //null vagy '', ha nem használ smtp-t
    public static $smtpPort= 26;
    public static $smtpUser= 'kapcsolat@socialbittap.com';
    public static $smtpPasswd= 'aaaaaa';
    public static $SMTPSecure = 'tls'; //vagy ssl
    //gmailsmtp-------------------------------
    // public static $smtpHost= 'smtp.gmail.com'; 
    // public static $smtpPort= 465;
    // public static $smtpUser= 'motto@gmail.com';
    // public static $smtpPasswd= 'aaaaaa';
    //public static $SMTPSecure = 'ssl';//// secure transfer enabled REQUIRED for Gmail
   
    //base--------------------
    public static $app='omni';
    public static $lang='hu';
    public static $tmpl='social';
    public static $basetmpl='flat';//egyenlőre nem használt----
    public static $title='Social';
}

class GOB
{ 
	private static $userjog=Array();
	public static $lang='hu';
/**
ide regisztrálnak be a modulok hogy ne legyen két ugyanolyan nevű
*/
	public static $modT=[];
/**
ide irányítunk minden rendszerkiiratást err,alert,info
 */   
    public static $echoT=[];
    public static $logT=[];
    
 /**
ki kell vezetni!! szerepét a $logT veszi át aminek egyike altömbje lesz: $logT['hiba']
  */   
    public static $hiba=true;    
    public static $userT=Array();
    
/**
 ez alapján kéredzi le az usrtömböt($userT)
 */
    public static $user_mezok='id,username,email,password';
    public static $log_mod=true;
    public static $db=null;
    public static $LT=array(); //nyelvi tömb
    public static $paramT=array();
    public static $html=null;
    
  /**
//js css og stb betöltése alapértelmezett kulcsok: $headT['head'],$headT['body'],$headT['bodyend']
 a Fejlec_s::ChangeFull() függvény a kulcsoknak megfelelő html cserestringet (pl.:<!--|head|-->)
  cseréli a tömbértékekből generált stringre
   */  
    public static $headT=[]; 

    /**
     * @var string
     * '' (alapértelmezés) az adminok csak saját cikkeiket szerkeszthetik
     * 'kozos' az adminok egymás cikkeit szerkeszthetik
     * 'tulajdonos' Az adminok szerkeszthetnek minden cikket
     */
    public static $admin_mod='';
    public static function get_userjog($jogname){
        if(in_array($jogname,self::$userjog)){return true;}
        else{return false;}
    }
    public static function set_userjog(){
        self::$userjog=\lib\jog\Jog::fromGOB();
    }

}
