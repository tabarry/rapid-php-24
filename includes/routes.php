<?php
$main->route('GET /', 'home->index');
$main->route('GET /walk/@id', 'home->walk');
$main->route('GET /users-add', 'users->add');
$main->route('POST /users-remote', 'users->remote');