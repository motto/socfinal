<?php
namespace mod\email;
use vendor\phpmailer\ver5216\PHPMailer;

//use vendor\phpmailer\ver204;
require_once('vendor/phpmailer/ver5216/phpmailer.php')  ;
require_once('vendor/phpmailer/ver5216/smtp.php')  ;
class LT
{
    public  static $elkuldve=[['hu'=>'Elküldve!'],
                               ['en'=>'Send succesfull!']];
    public  static $sikertelen=[['hu'=>'Levél küldés nem sikerült!'],
                                ['en'=>'Send error!']];


}

class Email
{
public $mail=null;    
public $ADT=[
   'CharSet'=>'utf-8',
   'IsHTML'=>true, 
   'Subject'=>'Admin levél',
    'funcT'=>['IsHTML'=>true],
   'SMTPDebug'=>1 // debugging: 1 = errors and messages, 2 = messages only  
];


public function __construct($parT = []){
    
    $this->ADT['funcT']['SetFrom']=\CONF::$mailfrom;
    $this->ADT['funcT']['fromnev']=\CONF::$fromnev;
    $this->ADT['Host']= \CONF::$smtpHost;

   // $mail->Subject = "Test";
   // $mail->Body = "hello";
   // $mail->AddAddress("email@gmail.com");
    
    
    foreach ($parT as $name => $value)
    {$this->ADT[$name]=$value;}
   
    $mail = new PHPMailer();
    if($this->ADT['funcT']['IsHTML']){$mail->IsHTML(true);}
   
    if(!empty($this->ADT['Host']))
    { 
     $mail->isSMTP();  
     $mail->SMTPAuth = true;
     $mail->Host= \CONF::$smtpHost;
     $mail->SMTPDebug =$this->ADT['SMTPDebug'];
     $mail->SMTPSecure=\CONF::$SMTPSecure;
     $mail->Port=\CONF::$smtpPort;
     $mail->Username = \CONF::$smtpUser;
     $mail->Password = \CONF::$smtpPasswd;  
    }
    else{$mail->isSendmail();}
    
    $mail->SetFrom( $this->ADT['funcT']['SetFrom'], $this->ADT['funcT']['fromnev']);
    
    
    foreach ($this->ADT as $name => $value)
    {
        if($name!='funcT'){ $mail->$name=$value;}   
    }
    $this->mail=$mail; 
    
    
    
}

public function simple($cim,$subject,$content)
{
$res='ok';

$this->mail->addAddress($cim, 'user');            // Címzett
$this->mail->Subject =$subject ;                       // A levél tárgya
$this->mail->Body    = $content;                                 // A levél törzse

if(!$this->mail->send()) { $res=$this->mail->ErrorInfo;} 
        return $res;
}
   
}

class Email_S
{

 static public function regConfirm($email,$id){
     
     $mail=new Email();
     print_r( $mail->ADT);
    $mail->simple($email, 'proba2', 'dfsdfhgsdf hsdgh fdh fdh fh fh');
 }   
    
}
