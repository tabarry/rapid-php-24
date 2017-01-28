<?php

//Check PCRE support
if ((float) PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}

// Kickstart the framework
$main = require('lib/base.php');

//Load globals
require('includes/globals.php'); 

//Load routes
require('includes/routes.php');

//$main->route('GET /brew/@count',
//    function($f3) {
//        echo $f3->get('PARAMS.count').' bottles of beer on the wall.';
//    }
//);

$main->run();
