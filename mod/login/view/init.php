<?php
namespace mod\login;
\GOB::$bodyT['js']['goref']= <<<js
function goref() {
    var x = document.referrer;
	window.location = x;	
}
js
;