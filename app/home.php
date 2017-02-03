<?php

class Home {


    function index() {
        global $main;
        if (empty($main->get('SESSION.id'))) {
            $main->reroute('/login');
        }
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => 'This is my home.'));
        echo \Template::instance()->render('index.html');
    }

    function login() {
        global $main;
        $title = $main->get('SESSION.getSettings.site_name');
        $main->set('pageInfo', array('title' => $title, 'heading' => 'This is my home.'));
        

        //$main->set('pageInfo', array('title' => $main->get('SESSION.getSettings')['site_name'], 'heading' => 'This is my home.')));
        echo \Template::instance()->render('login.html');
    }

    function walk() {
        //echo $main->get('PARAMS.id') . ' bottles of beer on the wall.';
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => $main->get('PARAMS.id') . 'This is my home.'));
        echo \Template::instance()->render('index.html');
    }

}
