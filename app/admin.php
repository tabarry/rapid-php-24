<?php

class Admin {

    function index() {
        global $main;
        if (!($main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.user__ID'))) {
            $main->reroute('/_admin/login');
        }
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => 'This is my home.'));
        echo \Template::instance()->render('admin/index.html');
    }

}
