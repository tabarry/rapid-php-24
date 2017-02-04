<?php

$main->set('DEBUG', 3);
$main->set('AUTOLOAD', 'app/');
$main->set('UI', 'ui/');
$main->set('PREFIX', 'DICT.');
$main->set('LOCALES', 'dict/');
$main->set('SESSION_PREFIX', 'aAeiOu34');
$main->set('BASE_URL', $main->get('SCHEME') . '://' . $main->get('HOST') . $main->get('BASE') . '/');
$main->set('ADMIN_URL', $main->get('BASE_URL'));

//API SETTINGS
$main->set('API_URL', $main->SCHEME . '://' . $main->HOST . $main->BASE . '/phpMyRest/');

$main->set('API_KEY', 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV');
$main->set('API_DEBUG', TRUE);
