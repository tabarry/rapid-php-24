<?php
$main->route('GET /_admin', 'admin->index');
$main->route('GET /_admin/login', 'users->login');
$main->route('POST /_admin/authenticate', 'users->authenticate');
