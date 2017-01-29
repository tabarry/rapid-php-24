<?php

$main->set('AUTOLOAD','app/');
$main->set('UI','ui/');
$main->set('API_URL',$main->SCHEME.'://'.$main->HOST.$main->BASE.'/phpMyRest/');
$main->set('DEBUG', 3);
