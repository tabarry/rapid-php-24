<?php

//Check PCRE support
if ((float) PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}

// Kickstart the framework
$main = require('lib/base.php');

//Load globals
require('includes/config.php');

//Load routes
require('includes/routes.php');

//Load sulata library
$su = new Sulata;

//Get settings
$su->getSettings();


$main->run();
