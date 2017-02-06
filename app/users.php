<?php

class Users {
    /* Authenticate user */

    function authenticate() {
        global $main, $su;
        $su->printJs("suToggleButton(true)");

        $sql = "SELECT employee__Name, employee__Email, employee__Picture, user__ID, user__Theme, user__IP FROM sulata_employees, sulata_users WHERE employee__ID = user__Employee AND employee__Status='Employed' AND employee__dbState='Live' AND user__dbState='Live' AND user__Status='Active' AND employee__Email='" . $su->unstrip($main->get('POST.employee__Email')) . "' AND user__Password='" . $su->makePassword($su->strip($main->get('POST.user__Password'))) . "'";
        $response = $su->query($sql);
        if ($response['num_rows'] == 1) {
            $userInfo = array();
            $userInfo['employee__Name'] = $response['result'][0]['employee__Name'];
            $userInfo['employee__Email'] = $response['result'][0]['employee__Email'];
            $userInfo['employee__Picture'] = $response['result'][0]['employee__Picture'];
            $userInfo['user__ID'] = $response['result'][0]['user__ID'];
            $userInfo['user__Theme'] = $response['result'][0]['user__Theme'];
            $userInfo['user__IP'] = $response['result'][0]['user__IP'];
            $main->set('SESSION.'.$main->get('SESSION_PREFIX').'userInfo', $userInfo);
            if ($main->get('POST.rememberLogin') == 1) {
                $main->set('COOKIE.'.$main->get('COOKIE_PREFIX').'rememberLogin', $main->get('POST.employee__Email'), $main->get('COOKIE_EXPIRY'));
            } else {
                $main->set('COOKIE.'.$main->get('COOKIE_PREFIX').'rememberLogin', '', $main->get('COOKIE_EXPIRY'));
            }
            $su->redirect($main->get('ADMIN_URL'));
        } else {
            $su->printJs("if(\$('#ajax-response')){\$('#ajax-response').addClass('ajax-error');}");
            $su->printJs("suToggleButton(false)");
            echo $main->get('DICT.invalidLogin');
        }
    }

    function login() {
        global $main;
        $main->set('ckRememberLogin',$main->get('COOKIE.'.$main->get('COOKIE_PREFIX').'rememberLogin'));
        $title = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_name');
        $main->set('pageInfo', array('title' => $title));

        echo \Template::instance()->render('admin/login.html');
    }

}
