<?php

class Home {

    function index() {
        global $main;
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => 'This is my home.'));
        echo \Template::instance()->render('index.html');
    }

    function walk() {
        global $main;
        //echo $main->get('PARAMS.id') . ' bottles of beer on the wall.';
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => $main->get('PARAMS.id').'This is my home.'));
        echo \Template::instance()->render('index.html');
    }
    
   

}
