<?php
namespace mod\login;

\GOB::$headT['head']['js']['goref']= <<<js
function goref() {
    var x = document.referrer;
	window.location = x;	
}
js
;