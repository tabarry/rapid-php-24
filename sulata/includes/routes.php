<?php
$main->route('GET /_admin', 'admin->index');
$main->route('GET /_admin/login', 'users->login');
$main->route('GET /_admin/logout', 'users->logout');
$main->route('POST /_admin/authenticate', 'users->authenticate');
//Settings
$main->route('GET /_admin/settings', 'settings->view');
$main->route('GET /_admin/settings-add', 'settings->add');
$main->route('GET /_admin/settings-update', 'settings->update');
$main->route('GET /_admin/settings-csv', 'settings->csv');
$main->route('GET /_admin/settings-delete/@id', 'settings->delete');
$main->route('GET /_admin/settings-restore/@id', 'settings->restore');