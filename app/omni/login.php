<?php
use mod\MOD;
use lib\base\Base;
use lib\base\Frame;
use lib\base\OB;
GOB::$html=OB::res('lib\base\Frame');
$tartalom=MOD::login();
//echo $tartalom;
GOB::$html= str_replace('<!--|tartalom|-->',$tartalom ,GOB::$html);
