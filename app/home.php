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
        //Get settings
        $url = $main->get('API_URL');
        $web = new Web;
        $request = $web->request($url, array('method' => 'POST',
            'content' =>
            array(
                'api_key' => 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV',
                'do' => 'select',
                'sql' => "SELECT * FROM users",
                'debug' => 'TRUE'
            )
                )
        );

        $r = json_decode($request['body'], true);
        echo "<pre>";
        if (empty($main->get('SESSION.getSettings'))) {
            if ($r['errno'] == 0) {
                $getSettings = array();
                for ($i = 0; $i < sizeof($r['result']); $i++) {
                    $getSettings[$r['result'][$i]['name']] = $r['result'][$i]['email'];
                }
                $main->set('SESSION.getSettings', $getSettings);
            } else {
                echo 'There is an error.';
            }
        } else {
            echo "no data";
        }
        //print_r($getSettings);
        //$main->set('SESSION.getSettings', $getSettings);
        //print_r($main->get('SESSION.getSettings'));


//==
        //$main->set('pageInfo', array('title' => $main->get(SESSION.getSettings)['site_name'], 'heading' => 'This is my home.'));
        echo \Template::instance()->render('login.html');
    }

    function walk() {
        global $main;
        //echo $main->get('PARAMS.id') . ' bottles of beer on the wall.';
        $main->set('pageInfo', array('title' => 'Welcome Home!', 'heading' => $main->get('PARAMS.id') . 'This is my home.'));
        echo \Template::instance()->render('index.html');
    }

}
