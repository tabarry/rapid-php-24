<?php

class Users {

    function add() {
        global $main;
        $main->set('pageInfo', array('title' => 'Add Users', 'heading' => 'Add Users'));
        echo \Template::instance()->render('users-add.html');
    }

    function remote() {
        global $main;
//        echo $main->clean($main->get('POST.name'));
//        echo "<pre>";
//        $geo = \Web\Geo::instance();
//        $geo =$geo->location();
//        echo $geo['country_name'];
//        exit;
        $url = "http://localhost/rapid-php-24/phpMyRest/";
        $web = new Web;
        $request = $web->request($url, array('method' => 'POST',
            'content' =>
            array(
                'api_key' => 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV',
                'do' => 'insert',
                'sql' => "INSERT INTO users (name,email,phone) VALUES ('" . $main->get('POST.name') . "','" . $main->get('POST.email') . time() . "','" . $main->get('POST.phone') . "')",
                'debug' => 'TRUE'
            )
                )
        );
        echo "<pre>";
        $r = json_decode($request['body'], true);
        //print_r($r);
        
        if($r['errno']==''){
            echo('Record added with record number '.$r['insert_id'].'.');
            //echo "<script>$('#ajax-contact').hide('slow');</script>";
            echo "<script>window.history.pushState('page2', 'Title', window.location+'#ok');</script>";
        }


        


        //echo $main->get('POST.name');
    }

}
