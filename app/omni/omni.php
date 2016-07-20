<?php
use lib\base\Base;
use lib\base\Frame;
use lib\base\OB;
use mod\login\Login_S;
GOB::$html=file_get_contents('tmpl/omni/base.html',true);
//GOB::$html=file_get_contents('tmpl/omni/base.html',true);
$login=Login_S::res();
//echo $tartalom;
GOB::$html= str_replace('<!--|login|-->',$login ,GOB::$html);
