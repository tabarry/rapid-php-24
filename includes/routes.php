<?php
$main->route('GET /_admin', 'admin->index');
$main->route('GET /_admin/login', 'users->login');
$main->route('GET /_admin/logout', 'users->logout');
$main->route('POST /_admin/authenticate', 'users->authenticate');
$main->route('GET /_admin/settings', 'settings->view');
$main->route('GET /_admin/settings/delete/@id', 'settings->delete');
$main->route('GET /_admin/settings/restore/@id', 'settings->restore');