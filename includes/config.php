<?php

$main->set('AUTOLOAD', 'app/');
$main->set('UI', 'ui/');
$main->set('PREFIX','DICT.');
$main->set('LOCALES','dict/');
$main->set('DEBUG', 3);

//API SETTINGS
$main->set('API_URL', $main->SCHEME . '://' . $main->HOST . $main->BASE . '/phpMyRest/');

$main->set('API_KEY', 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV');
$main->set('API_DEBUG', TRUE);
