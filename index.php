<?php

//Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Check PCRE support
if ((float) PCRE_VERSION < 7.9) {
    trigger_error('PCRE version is out of date');
}

// Kickstart the framework
$main = require('sulata/lib/base.php');

//Load globals
require('sulata/includes/config.php');

//Load routes
require('sulata/includes/routes.php');

//Load db structure
require('sulata/includes/db-structure.php');

//Load sulata library
$su = new Sulata;

//Get settings
$su->getSettings();


//Build sidebar
$main->set('sidebar', $su->buildSideBar('./app/admin',array('admin.php')));
print_r($sidebar);
$main->run();
