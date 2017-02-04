<?php

class Users {
    /* Authenticate user */

    function authenticate() {
        global $main, $su;
        $sql = "SELECT employee__Name, employee__Email, employee__Picture, user__ID, user__Theme, user__IP FROM sulata_employees, sulata_users WHERE employee__ID = user__Employee AND employee__Status='Employed' AND employee__dbState='Live' AND user__dbState='Live' AND user__Status='Active' AND employee__Email='" . $su->strip($main->get('POST.user__Email')) . "' AND user__Password='" . $su->strip($main->get('POST.user__Password')) . "'";
        $response = $su->query($sql);
        if ($response['num_rows'] == 1) {
            $userInfo = array();
            $userInfo['employee__Name'] = $response['result'][0]['employee__Name'];
            $userInfo['employee__Email'] = $response['result'][0]['employee__Email'];
            $userInfo['employee__Picture'] = $response['result'][0]['employee__Picture'];
            $userInfo['user__ID'] = $response['result'][0]['user__ID'];
            $userInfo['user__Theme'] = $response['result'][0]['user__Theme'];
            $userInfo['user__IP'] = $response['result'][0]['user__IP'];
            $main->set('SESSION.userInfo', $userInfo);
            $su->redirect($main->get('ADMIN_URL'));
        }else{
            echo "invalid login";
        }
    }

    function login() {
        global $main;
        $title = $main->get('SESSION.getSettings.site_name');
        $main->set('pageInfo', array('title' => $title));

        echo \Template::instance()->render('login.html');
    }

}
