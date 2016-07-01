<?php

//függvény hívások változónevekkel-----------------
$className->{"variableName"};
$className->{"methodName"}();

StaticClass::${"variableName"};
StaticClass::{"methodName"}();

//ellenőrzés----------------------------------------------
function_exists ($function_nev);
method_exists('class_nev','function_nev');
method_exists($ob,'function_nev');

//http://webstack.hu/cikk/php-5-4-ujdonsagok

//Közvetett függvényhívás tömbbel--------------------------------
$f = [new Article("c-123"), 'getPrice'];
echo $f(); // Article->getPrice()

//futási idő-------------------  
echo 'Futás idő:'.(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']).'microsec';

$article = (new Article)->setTitle('Cikk címe')->setImg('http://valami.hu/cikk.jpg');    
    

//http://webmestertanfolyam.hu/webmester-blog/keszulj-fel-a-php-7-re
//A nullával összehasonlító operátor Egy feltétel segítségével vizsgálnunk kell,
//hogy egy adott változó létezik-e,mielőtt felhasználnánk az értékét egy másik kifejezésben:

$a = isset($b) ? $b : "default";

//PHP 7 esetén használhatjuk a nullával összehasonlító operátort:
$a = $b ?? "default";

//tipus kényszerítés (nem dob hibát csak átalakítja)
function func(int $value){}
//visszatérési érték tipuskényszerítése
function func() : bool{} 
//ha hibát akarunk dobni a script első sorába declarálni a szigorú módot:
declare(strict_types = 1);

//http://szabilinux.hu/php/language.references.pass.html
//referenciakénti paraméter átadás (nem csak afüggvényben változik)
function ize (&$valtozo){}
