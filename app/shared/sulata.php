<?php

class Sulata {

    //Strip string
    public static function strip($str) {
        return $str;
    }

    //Unstrip string
    function unstrip($str) {
        return $str;
    }

    //Print array
    function printArray($arr) {
        echo "<pre>";
        return print_r($arr);
        echo "</pre>";
    }

    //Print array, alias of printArray()
    function print_array($arr) {
        return printArray($arr);
    }

    //Make password
    function makePassword($str) {
        if (function_exists('md5')) {
            $str = md5($str);
        }
        return $str;
    }

    //Display DB error
    function displayDbError($responseArray) {
        global $main;
        echo $main->format($main->get('DICT.dbError'), $responseArray['connect_errno'], $responseArray['connect_error'], $responseArray['errno'], $responseArray['error']);
        exit;
    }

    //Send SQL to API
    function query($sql, $do = 'select') {
        global $main;

        //Instantiate class
        $web = new Web;
        //Send request to phpMyRest API
        $request = $web->request($main->get('API_URL'), array('method' => 'POST',
            'content' =>
            array(
                'api_key' => $main->get('API_KEY'),
                'do' => $do,
                'sql' => $sql,
                'debug' => $main->get('API_DEBUG'),
            )
                )
        );
        //Decode json response to php array
        $response = json_decode($request['body'], true);
        //Return response
        return $response;
    }

    //Get settings
    function getSettings($reset = FALSE) {
        global $main;

        //If settings need to be reset, $reset is passed as TRU
        if ($reset == TRUE) {
            $main->set('SESSION.'.$main->get('SESSION_PREFIX').'getSettings', '');
        }
        //In SESSION.getSettings is empty, fill it
        if (!$main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings')) {
            $sql = "SELECT setting__Key, setting__Value FROM sulata_settings WHERE setting__dbState='Live' ORDER by setting__Key";
            //Call query function
            $response = $this->query($sql);
            //In not error, build session variable
            if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
                $getSettings = array();
                for ($i = 0; $i < sizeof($response['result']); $i++) {
                    $getSettings[$response['result'][$i]['setting__Key']] = $this->unstrip($response['result'][$i]['setting__Value']);
                }
                $main->set('SESSION.'.$main->get('SESSION_PREFIX').'getSettings', $getSettings);
            } else {
                //If error, display error
                $this->displayDbError($response);
            }
        }
    }

    //Print JS
    function printJs($str) {
        echo "<script>$str</script>";
    }

    //Redirect top
    function redirect($url) {
        $this->printJs("top.window.location.href='{$url}'");
        exit;
    }

}