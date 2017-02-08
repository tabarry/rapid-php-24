<?php

$main->set('DEBUG', 3);
$main->set('AUTOLOAD', 'app/;app/shared/;app/admin/');
$main->set('UI', 'ui/');
$main->set('PREFIX', 'DICT.');
$main->set('LOCALES', 'dict/');
$main->set('SESSION_PREFIX', 'sn_AeiOu34');
$main->set('COOKIE_PREFIX', 'ck_aAeiOu34');
$main->set('BASE_URL', $main->get('SCHEME') . '://' . $main->get('HOST') . $main->get('BASE') . '/');
$main->set('ADMIN_URL', $main->get('BASE_URL').'_admin/');
$main->set('ADMIN_SUBMIT_URL', $main->get('BASE_URL').'_admin/');
$main->set('PING_URL', $main->get('BASE_URL').'static/ping.html');
$main->set('COOKIE_EXPIRY',time()+10080);
$main->set('PAGE_SIZE',5);
$main->set('UID_LENGTH',14);
//API SETTINGS
$main->set('API_URL', $main->SCHEME . '://' . $main->HOST . $main->BASE . '/phpMyRest/');
$main->set('API_KEY', 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV');
$main->set('API_DEBUG', FALSE); 
