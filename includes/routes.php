<?php
$main->route('GET /', 'home->index');
$main->route('GET /form', 'home->form');
$main->route('GET /login', 'users->login');
$main->route('POST /authenticate', 'users->authenticate');
