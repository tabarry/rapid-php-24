<?php

class Sulata {

    //Strip string
    function strip($str) {
        $str = trim($str);
        $str = addslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    //Unstrip string
    function unstrip($str, $htmlEntityDecode = FALSE) {
        $str = stripslashes($str);
        if ($htmlEntityDecode == TRUE) {
            $str = html_entity_decode($str);
        }
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

    //Validate string
    function validate($str, $type, $label, $required = 'y') {
        global $main;

        $required = strtolower($str);
        $type = strtolower($type);

        if ($type == 'email') {
            if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
                $error = $main->format($main->get('DICT.validationEmailError'), $label);
            }
        } elseif ($type == 'int') {
            if (!filter_var($str, FILTER_VALIDATE_INT)) {
                $error = $main->format($main->get('DICT.validationIntError'), $label);
            }
        } elseif ($type == 'float' || $type == 'number') {
            if (!filter_var($str, FILTER_VALIDATE_FLOAT)) {
                $error = $main->format($main->get('DICT.validationFloatError'), $label);
            }
        } elseif ($type == 'ip') {
            if (!filter_var($str, FILTER_VALIDATE_IP)) {
                $error = $main->format($main->get('DICT.validationIpError'), $label);
            }
        } elseif ($type == 'url') {
            if (!filter_var($str, FILTER_VALIDATE_URL)) {
                $error = $main->format($main->get('DICT.validationUrlError'), $label);
            }
        } elseif ($type == 'date') {
            $dateFormat = $main->get('SESSION.getSettings.date_format');

            //$date is the posted date value from date picker
            $date = explode('-', $str);

            if (substr_count($str, '-') != 2) {
                $error = $main->format($main->get('DICT.validationDateError'), $label, $dateFormat);
            } else {
                if ($dateFormat == 'mm-dd-yyyy') {
                    $month = $date[0];
                    $day = $date[1];
                    $year = $date[2];
                } elseif ($dateFormat == 'dd-mm-yyyy') {
                    $month = $date[1];
                    $day = $date[0];
                    $year = $date[2];
                }
                //Check if numeric
                if (!filter_var($month, FILTER_VALIDATE_INT) || !filter_var($day, FILTER_VALIDATE_INT) || !filter_var($year, FILTER_VALIDATE_INT) || strlen($year) < 4) {
                    $error = $main->format($main->get('DICT.validationDateError'), $label, $dateFormat);
                } else {
                    if (!checkdate($month, $day, $year)) {
                        $error = $main->format($main->get('DICT.validationDateError'), $label, $dateFormat);
                    }
                }
            }
        }
        //Check if field is required but empty
        if ($str == '' && $required != 'n') {
            $error = $main->format($main->get('DICT.validationRequiredError'), $label);
        }
        return $error;
    }
    
    //Check if the request is Ajax
    function checkAjax() {
        global $main;
        if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ){
          $this->farewell($main->get('DICT.invalidAccess'));
        }
    }

    //Check login
    //mode header or js
    function checkLogin($mode = 'header') {
        global $main;
        if (!($main->get('SESSION.userInfo.user__ID'))) {
            if ($mode == 'header') {
                $main->reroute($main->get(ADMIN_URL) . 'login');
            } else {
                $this->redirect($main->get(ADMIN_URL) . 'login');
            }
        }
    }

    //Check referrer
    function checkRef() {
        global $main;
        if (!stristr($_SERVER['HTTP_REFERER'], $main->get(BASE_URL))) {
            $this->farewell($main->get('DICT.invalidAccess'));
        }
    }

    //Check numeric
    function checkNumeric($var) {
        global $main;
        if (!is_numeric($var)) {
            $this->farewell($main->get('DICT.invalidAccess'));
        }
    }

    //Check referrer
    function farewell($str) {
        global $main;
        $str = "<div style='color:#0000FF;font-family:Tahoma,Verdana,Arial;font-size:13px;'>{$str}</div>";
        exit($str);
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
            $main->set('SESSION.getSettings', '');
        }
        //In SESSION.getSettings is empty, fill it
        if (!$main->get('SESSION.getSettings')) {
            $sql = "SELECT setting__Key, setting__Value FROM sulata_settings WHERE setting__dbState='Live' ORDER by setting__Key";
            //Call query function
            $response = $this->query($sql);
            //In not error, build session variable
            if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
                $getSettings = array();
                for ($i = 0; $i < sizeof($response['result']); $i++) {
                    $getSettings[$response['result'][$i]['setting__Key']] = $this->unstrip($response['result'][$i]['setting__Value']);
                }

                $main->set('SESSION.getSettings', $getSettings);
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

    //Build sidebar
    function buildSideBar($path, $exclude = '') {
        global $main;
        $dir = $path;
        $dir = scandir($dir);
        $sidebar = array();
        foreach ($dir as $file) {
            if ($file[0] != '.') {
                if (!in_array($file, $exclude)) {
                    $sidebar[] = str_replace('.php', '', $file);
                }
            }
        }
        return $sidebar;
    }

    //Function SQL to CSV
    //$headerArray=array('Col 1','Col 2','Col 3');
    function sqlToCSV($sql, $headerArray, $outputFileName) {
        $response = $this->query($sql);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $outputFileName);
        $output = fopen('php://output', 'w');
        fputcsv($output, $headerArray);

        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
            if ($response['num_rows'] > 0) {
                $result = $response['result'];
                foreach ($result as $key => $value) {
                    $csv = array();
                    foreach ($value as $val) {
                        array_push($csv, $this->unstrip($val));
                    }
                    fputcsv($output, $csv);
                }
            } else {
                $error = $main->get('DICT.noRecordFound');
            }
        } else {
//If error, display error
            $this->displayDbError($response);
        }
    }

    //Function SQL to PDF
    //$headerArray=array('Col 1','Col 2','Col 3');
    function sqlToPDF($sql, $headerArray, $outputFileName) {
        global $main;
        $response = $this->query($sql);
        $title = str_replace('.pdf', '', $outputFileName);
        $title = str_replace('-', ' ', $title);
        $title = strtoupper($title);
        //Distribute columns
        $cols = sizeof($headerArray) - 1;
        $cols = (95 / $cols);
        $cols = round($cols);
        $tbl = '';
        //Make table header
        $tblHeader = '';
        for ($i = 0; $i <= sizeof($headerArray) - 1; $i++) {
            if ($i == 0) {
                $colWidth = 5;
            } else {
                $colWidth = $cols;
            }
            $tblHeader .= "<td style=\"text-align:left;padding:5px;background-color:#000;color:#FFF;width:{$colWidth}%\">" . $headerArray[$i] . "</td>";
        }
        $tblHeader = "<tr>{$tblHeader}</tr>" . PHP_EOL;
        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
            if ($response['num_rows'] > 0) {
                $result = $response['result'];
                foreach ($result as $key => $value) {
                    $tbl .= "<tr>";
                    foreach ($value as $val) {
                        $tbl .= "<td style=\"text-align:left;padding:5px;border-bottom:1px solid #333;\">" . $this->unstrip($val) . "</td>";
                    }
                    $tbl .= "</tr>" . PHP_EOL;
                }
                $tbl = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">" . PHP_EOL . "{$tblHeader}{$tbl}</table>";


                // Include the main TCPDF library (search for installation path).
                require_once('./sulata/tcpdf/tcpdf.php');

                // create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor($main->get('SESSION.getSettings.site_name'));
                $pdf->SetTitle($main->get('SESSION.getSettings.site_name'));
                $pdf->SetSubject('');
                $pdf->SetKeywords('');

                // set default header data
                $pdf->SetHeaderData('', '', $main->get('SESSION.getSettings.site_name'), $title, array(0, 0, 0), array(0, 0, 0));
                $pdf->setFooterData(array(0, 0, 0), array(0, 0, 0));

                // set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                    require_once(dirname(__FILE__) . '/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }

                // ---------------------------------------------------------
                // set default font subsetting mode
                $pdf->setFontSubsetting(true);

                // Set font
                // dejavusans is a UTF-8 Unicode font, if you only need to
                // print standard ASCII chars, you can use core fonts like
                // helvetica or times to reduce file size.
                $pdf->SetFont('helvetica', '', 11, '', true);

                // Add a page
                // This method has several options, check the source code documentation for more information.
                $pdf->AddPage();

                // set text shadow effect
                $pdf->setTextShadow(array('enabled' => false, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


                // Print text using writeHTMLCell()
                $pdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);

                // ---------------------------------------------------------
                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output($outputFileName, 'D');
                //============================================================+
                // END OF FILE
                //====================
            } else {
                $error = $main->get('DICT.noRecordFound');
            }
        } else {
//If error, display error
            $this->displayDbError($response);
        }
    }

    //Make dropdown from an array
    function dropdown($name = '', $options = array(), $selected = array(), $extra = '') {
        global $main;
        if (!is_array($selected)) {
            $selected = array($selected);
        }

        // If no selected state was submitted we will attempt to set it automatically
        if (count($selected) === 0) {
            // If the form name appears in the $_POST array we have a winner!
            if (isset($name)) {
                $selected = array($name);
            }
        }

        if ($extra != '')
            $extra = ' ' . $extra;

        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '
<select id="' . $name . '" name="' . $name . '"' . $extra . $multiple . ">
\n";

        foreach ($options as $key => $val) {
            $key = (string) $key;

            if (is_array($val) && !empty($val)) {
                $form .= '
<optgroup label="' . $key . '">
' . "\n";
                foreach ($val as $optgroup_key => $optgroup_val) {
                    $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="' . $optgroup_key . '"' . $sel . '>' . (string) $optgroup_val . "</option>\n";
                }

                $form .= '
</optgroup>
' . "\n";
            } else {
                $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

                $form .= '
<option value="' . $key . '"' . $sel . '>
' . (string) $val . "
</option>
\n";
            }
        }

        $form .= '
</select>
';

        return $form;
    }

    /* DB FUNCTIONS */

    //Display DB error
    function displayDbError($responseArray) {
        global $main;
        echo $main->format($main->get('DICT.dbError'), $responseArray['connect_errno'], $responseArray['connect_error'], $responseArray['errno'], $responseArray['error']);
        exit;
    }

    //Build pagination
    function paginate($totalRecs, $cssClass = 'paginate') {
        //global $getSettings['page_size'];
        global $main, $sr;
        //$totalRecs = '19';
        $opt = '';
        if ($totalRecs > 0) {
            if ($totalRecs > $main->get('SESSION.getSettings.page_size')) {
                for ($i = 1; $i <= ceil($totalRecs / $main->get('SESSION.getSettings.page_size')); $i++) {
                    $j = $i - 1;
                    $sr = $main->get('SESSION.getSettings.page_size') * $j;
                    if ($_GET['start'] / $main->get('SESSION.getSettings.page_size') == $j) {
                        $sel = " selected='selected'";
                    } else {
                        $sel = "";
                    }
                    //$opt.= "<option {$sel} value='" . $phpSelf . "?sr=" . $sr . "&q=" . $_GET['q'] . "&start=" . ($main->get('SESSION.getSettings.page_size')* $j) . "'>$i</option>";
                    $opt.= "<option {$sel} value='" . $main->get('ADMIN_URL') . "settings?sr=" . $sr . "&q=" . $main->get('GET.q') . "&sort=" . $main->get('GET.sort') . "&start=" . ($main->get('SESSION.getSettings.page_size') * $j) . "'>$i</option>";
                }
                echo "<div style=\"height:30px\">Go to page: <select class='{$cssClass}' onchange=\"window.location.href = this.value\">{$opt}></select></div>";
            }
        } else {
            if ($_GET['q'] == '') {
                echo '<div class="blue">' . RECORD_NOT_FOUND . '</div>';
            } else {
                echo '<div class="blue">' . SEARCH_NOT_FOUND . '</div>';
            }
        }
    }

}
