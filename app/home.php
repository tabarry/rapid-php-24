<?php

class Home {

    function index() {
        global $main;
        if (!($main->get('SESSION.userInfo.user__ID'))) {
            $main->reroute('/login');
        }
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => 'This is my home.'));
        echo \Template::instance()->render('index.html');
    }

}
