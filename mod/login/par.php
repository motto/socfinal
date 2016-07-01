<?php
namespace mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );
include_once 'mod/login/modlt.php';
class ADT{

//fontos--------------------------
public static $task='alap';
/**
 a task trait-nek ha nins a tasknak megfelelő funkciója ilyennel kell rendelkezni (felülírható)
 */
public static $resfunc='tres';
public static $next='';
public static $view='';
public static $dataT=[];
/**
ellenőrzott POST adatok safePost; 
 */
public static $SPT=[];
/**
ide kell a nyelvi elemeket beírni
 */
public static $LT=[];
public static $strT=['mod:'=>''];
/**
innen tölti be a html fileokat ha az aktuális tmpl könyvtárban is van ilyen akkor onnam 
 */
public static $vdir='mod/login/view';
//public static $trdir='mod/login/trt/task';
//--------------------------------


public static $modnev='log';//applikációknál nme kell
}
class Regx{
static public $username=[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'username','MIN'=>'4','MAX'=>'20']],
						['HU_TOBB_SZO','spec_char_err']	];	
static public $email=	[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'email','MIN'=>'6','MAX'=>'50']],
					 	['MAIL','email_err']];
static public $passwd=	[['/^.{<<MIN>>,<<MAX>>}$/u','long_err',['MEZO'=>'password','MIN'=>'6','MAX'=>'20']]];
}
class TSK{
static public $alap=['trt'=>['mod:Alap']];	
static public $belepve=['trt'=>['mod:View_>Res'],'view'=>'kilep_form.html'];
static public $kilepve=['trt'=>['mod:View'],'func'=>['Res'],'view'=>'belep_form.html'];
static public $reg=['trt'=>['mod:View'],'func'=>['Res'],'view'=>'regisztral_form.html'];
static public $passwdchange=['trt'=>'mod:View','func'=>['Res'],'view'=>'szerk_passwd.html'];
static public $kilep=['trt'=>['mod:Kilep'],'next'=>'Alap'];
static public $belep=['trt'=>['mod:Belep'],'next'=>'Alap'];
static public $regmentkesz=['trt'=>''];
static public $passwdmentkesz=['trt'=>''];
static public $passwdment=['trt'=>'','view'=>''];
static public $regment=
[
'trt'=>['task:Alap','mod:Ell'],	
'next'=>'regkesz',		
'ell'=>
[
	'username'=>['regx'=>Regx::$username, 'Marvan'=>'"username","user","username_have"'],
	'email'=>['regx'=>Regx::$email,'Marvan'=>'"email","user","email_have"'],	
	'passwd'=>['regx'=>Regx::$passwd,'Match'=>'$_POST["passwd2"],"two_passwd_nomatch"'],	
]				
];
static public $belep=
[
'trt'=>'',
'next'=>'alap',
'ell'=>
[
	'username'=>['regx'=>Regx::$username],	
	'passwd'=>['regx'=>Regx::$username,'matchPasswd'=>'$his->ellT["username"],passwd_nomatch']
]
];	

	




}
