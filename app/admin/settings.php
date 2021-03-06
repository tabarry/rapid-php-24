<?php

class Settings {

    //Define a public variable
    var $baseSql = "SELECT setting__ID, setting__Setting, setting__Key, setting__Value FROM sulata_settings ";

    //View record
    function view() {
        global $main, $su;
        //Check login
        $su->checkLogin();
        //Check referrer
        $su->checkRef();

        //Template variables
        $pageTitle = $main->get('DICT.manage') . ' Settings';
        $siteTitle = $main->get('SESSION.getSettings.site_name') . ' - ' . $pageTitle;


        //Build where condition
        $where = " WHERE setting__dbState='Live' AND setting__Type ='Public' ";
        $main->set('nextSort', 'desc');
        if ($main->get('GET.q')) {
            $where .= " AND setting__Setting LIKE '%" . $main->get('GET.q') . "%' ";
        }
        //Build order by condition
        if ($main->get('GET.sort')) {
            $get = explode('-', $main->get('GET.sort'));
            $field = $get[0];
            $sort = $get[1];
            if ($sort == 'asc') {
                $main->set('nextSort', 'desc');
            } else {
                $main->set('nextSort', 'asc');
            }
            $orderBy = " ORDER BY {$field} {$sort} ";
        } else {
            $orderBy = " ORDER BY setting__Setting ASC ";
        }

        if (!$main->get('GET.start')) {
            $start = 0;
        } else {
            $start = $main->get('GET.start');
        }

        //Build limit
        $limit = " LIMIT {$start}, " . $main->get('PAGE_SIZE');

        //SQL to get all records
        $limitlessSQL = "SELECT COUNT(setting__ID) as totalRecs FROM sulata_settings {$where} ";
        $response = $su->query($limitlessSQL);
        //Get totalRecs variable to pass to $su->paginate()
        $main->set('totalRecs', $response['result'][0]['totalRecs']);

        //SQL to get paginated records
        //If SQL is changed, also change it in CSV section
        //$baseSql = "SELECT setting__ID, setting__Setting, setting__Key, setting__Value FROM sulata_settings ";
        $baseSql = $this->baseSql;
        $sql = " {$baseSql} {$where} {$orderBy} {$limit} ";
        $response = $su->query($sql);

        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {

            if ($response['num_rows'] > 0) {
                $result = $response['result'];
            } else {
                $error = $main->get('DICT.noRecordFound');
            }
        } else {
          //If error, display error
            $su->displayDbError($response);
        }
        $main->set('pageInfo', array('page_title' => $pageTitle, 'site_title' => $siteTitle,'error'=>$error,'result'=>$result));
        $view = new View;
        echo $view->render('admin/settings.php');
    }

    //Add record
    function add() {
        global $main, $su;
        //Check login
        $su->checkLogin();
        //Check referrer
        $su->checkRef();


        //If form is subitted
        if ($main->get('POST')) {
            //Validate fields
            $error = '';
            $error .= $su->validate($main->get('POST.setting__Setting'), $main->get('db.sulata_settings.setting__Setting.validateas'), $main->get('db.sulata_settings.setting__Setting.label'), $main->get('db.sulata_settings.setting__Setting.required'));
            $error .= $su->validate($main->get('POST.setting__Key'), $main->get('db.sulata_settings.setting__Key.validateas'), $main->get('db.sulata_settings.setting__Key.label'), $main->get('db.sulata_settings.setting__Key.required'));
            $error .= $su->validate($main->get('POST.setting__Value'), $main->get('db.sulata_settings.setting__Value.validateas'), $main->get('db.sulata_settings.setting__Value.label'), $main->get('db.sulata_settings.setting__Value.required'));

            $error .= $su->validate($main->get('POST.setting__Type'), $main->get('db.sulata_settings.setting__Type.validateas'), $main->get('db.sulata_settings.setting__Type.label'), $main->get('db.sulata_settings.setting__Type.required'));
            if ($error) {
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                echo $error;
            } else {
                $extraSql = '';
                $sql = "INSERT INTO sulata_settings SET setting__Setting='" . $su->Strip($main->get('POST.setting__Setting')) . "',setting__Key='" . $su->Strip($main->get('POST.setting__Key')) . "',setting__Value='" . $su->Strip($main->get('POST.setting__Value')) . "',setting__Type='" . $su->Strip($main->get('POST.setting__Type')) . "'
                ,setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $main->get('SESSION.userInfo.employee__Name') . "'
                " . $extraSql;

                $response = $su->query($sql, 'insert');
                //If no errors
                if (($response['connect_errno'] == 0) && ($response['errno'] == 0) && ($response['insert_id'] != 0)) {
                    $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-error');\$('#ajax-response').addClass('ajax-success');suReset('suForm');}");
                    echo $main->get('DICT.recordAdded');
                    $su->printJs("suToggleButton(false)");

                } else {
                    //If duplication error
                    if ($response['errno'] == 1062) {
                        $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                        echo $main->format($main->get('DICT.recordDuplicationError'), $main->get('db.sulata_settings.setting__Setting.label'));
                        $su->printJs("suToggleButton(false)");
                    } else {
                        //If any other error
                        $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                        echo $main->get('DICT.generalError');
                        $su->printJs("suToggleButton(false)");
                    }
                }
            }
            exit;
        }
        //Template variables
        //==initialise variables
        $data['setting__ID'] = '';
        $data['setting__Setting'] = '';
        $data['setting__Key'] = '';
        $data['setting__Value'] = '';
        $data['setting__Type'] = '';
        //==
        $id = $main->get('PARAMS.id');

        if ($id) {
            $duplicate = TRUE;
            //Check if id is numeric
            $su->checkNumeric($id);
        }
        if ($duplicate == TRUE) {
            $pageTitle = $main->get('DICT.duplicate') . ' Settings';
        } else {
            $pageTitle = $main->get('DICT.add') . ' Settings';
        }
        //Get record
        if ($duplicate == TRUE) {
            //Get records


            $sql = "SELECT setting__ID,setting__Setting,setting__Key,setting__Value,setting__Type FROM sulata_settings WHERE setting__ID='" . $id . "' AND setting__dbState='Live'";
            $response = $su->query($sql);
            //$su->printArray($response);
            if ($response['num_rows'] == 0) {
                $su->farewell($main->get('DICT.invalidAccess'));
            }
//Add data to $data
            $data['setting__ID'] = $response['result'][0]['setting__ID'];
            $data['setting__Setting'] = $su->unstrip($response['result'][0]['setting__Setting']);
            $data['setting__Key'] = $su->unstrip($response['result'][0]['setting__Key']);
            $data['setting__Value'] = $su->unstrip($response['result'][0]['setting__Value']);
            $data['setting__Type'] = $response['result'][0]['setting__Type'];
        }
        //=
        $siteTitle = $main->get('SESSION.getSettings.site_name') . ' - ' . $pageTitle;


        //Make dropdown
        $options = $main->get('db.sulata_settings.setting__Type.value');
        $js = "class=\"form-control\"";
        $setting__Type = $su->dropdown('setting__Type', $options, $data['setting__Type'], $js);
        $main->set('ESCAPE', FALSE);
        $main->set('setting__Type', $setting__Type);
        $main->set('data', $data);

        $main->set('pageInfo', array('site_title' => $siteTitle,'page_title' => $pageTitle));
        $view = new View;
        echo $view->render('admin/settings-add.php');
        $main->set('ESCAPE', TRUE);
    }

    //Update record
    function update() {
        global $main, $su;
        //Check login
        $su->checkLogin();
        //Check referrer
        $su->checkRef();

        //If form is subitted
        if ($main->get('POST')) {
            //Validate fields
            $error = '';
            $error .= $su->validate($main->get('POST.setting__Setting'), $main->get('db.sulata_settings.setting__Setting.validateas'), $main->get('db.sulata_settings.setting__Setting.label'), $main->get('db.sulata_settings.setting__Setting.required'));
            $error .= $su->validate($main->get('POST.setting__Key'), $main->get('db.sulata_settings.setting__Key.validateas'), $main->get('db.sulata_settings.setting__Key.label'), $main->get('db.sulata_settings.setting__Key.required'));
            $error .= $su->validate($main->get('POST.setting__Value'), $main->get('db.sulata_settings.setting__Value.validateas'), $main->get('db.sulata_settings.setting__Value.label'), $main->get('db.sulata_settings.setting__Value.required'));

            $error .= $su->validate($main->get('POST.setting__Type'), $main->get('db.sulata_settings.setting__Type.validateas'), $main->get('db.sulata_settings.setting__Type.label'), $main->get('db.sulata_settings.setting__Type.required'));
            if ($error) {
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                echo $error;
            } else {
                $extraSql = '';

                $sql = "UPDATE sulata_settings SET setting__Setting='" . $su->Strip($main->get('POST.setting__Setting')) . "',setting__Key='" . $su->Strip($main->get('POST.setting__Key')) . "',setting__Value='" . $su->Strip($main->get('POST.setting__Value')) . "',setting__Type='" . $su->Strip($main->get('POST.setting__Type')) . "'
,setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $main->get('SESSION.userInfo.employee__Name') . "'
" . $extraSql . " WHERE setting__ID='" . $main->get('POST.setting__ID') . "'";

                $response = $su->query($sql, 'insert');
                //If no errors
                if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
                    $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').removeClass('ajax-error');}");
                    $url = $main->get('ADMIN_URL') . 'settings';
                    $su->redirect($url);
                } else {
                    //If duplication error
                    if ($response['errno'] == 1062) {
                        $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                        echo $main->format($main->get('DICT.recordDuplicationError'), $main->get('db.sulata_settings.setting__Setting.label'));
                        $su->printJs("suToggleButton(false)");
                    } else {
                        //If any other error
                        $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                        echo $main->get('DICT.generalError');
                        $su->printJs("suToggleButton(false)");
                    }
                }
            }
            exit;
        }
        //Template variables
        $pageTitle = $main->get('DICT.update') . ' Settings';
        $siteTitle = $main->get('SESSION.getSettings.site_name') . ' - ' . $pageTitle;



        //Get records
        $id = $main->get('PARAMS.id');
        //Check if id is numeric
        $su->checkNumeric($id);

        $sql = "SELECT setting__ID,setting__Setting,setting__Key,setting__Value,setting__Type FROM sulata_settings WHERE setting__ID='" . $id . "' AND setting__dbState='Live'";
        $response = $su->query($sql);
        //$su->printArray($response);
        if ($response['num_rows'] == 0) {
            $su->farewell($main->get('DICT.invalidAccess'));
        }

        $data['setting__ID'] = $response['result'][0]['setting__ID'];
        $data['setting__Setting'] = $su->unstrip($response['result'][0]['setting__Setting']);
        $data['setting__Key'] = $su->unstrip($response['result'][0]['setting__Key']);
        $data['setting__Value'] = $su->unstrip($response['result'][0]['setting__Value']);
        $data['setting__Type'] = $response['result'][0]['setting__Type'];

        //Make dropdown
        $options = $main->get('db.sulata_settings.setting__Type.value');
        $js = "class=\"form-control\"";
        $setting__Type = $su->dropdown('setting__Type', $options, $data['setting__Type'], $js);
        $main->set('ESCAPE', FALSE);
        $main->set('setting__Type', $setting__Type);
        $main->set('data', $data);
        $main->set('pageInfo', array('site_title' => $siteTitle,'page_title' => $pageTitle));
        $view = new View;
        echo $view->render('admin/settings-update.php');
        $main->set('ESCAPE', TRUE);
    }

    //Delete record
    function delete() {
        global $main, $su;
        //Check login
        $su->checkLogin('js');
        //Check referrer
        $su->checkRef();
        //Check Ajax call
        $su->checkAjax();


        $id = $main->get('PARAMS.id');
        //Check if id is numeric
        $su->checkNumeric($id);

          //Delete from database by updating just the state
          //make a unique id attach to previous unique field
        $uid = uniqid() . '-';
        $sql = "UPDATE sulata_settings SET setting__Setting=CONCAT('" . $uid . "',setting__Setting),setting__Key=CONCAT('" . $uid . "',setting__Key), setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $main->get('SESSION.userInfo.employee__Name') . "', setting__dbState='Deleted' WHERE setting__ID = '" . $id . "' AND setting__dbState='Live'";
        $response = $su->query($sql, 'update');
        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
            if ($response['affected_rows'] > 0) {
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-error');\$('#ajax-response').addClass('ajax-success');}\$('#tr_" . $id . "').addClass('deleted-row');\$('#restore_" . $id . "').removeClass('hide');\$('#actions_" . $id . "').hide();");

                if ($main->get('RESTORE_ACCESS') == TRUE) {
                    echo $main->get('DICT.recordDeleted');
                } else {
                    echo $main->get('DICT.recordDeletedNoRestoreAccess');
                }
            } else {
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                echo $main->get('DICT.noDeletionRecordError');
            }
        } else {
            $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
            echo $main->get('DICT.generalError');
        }
    }

//Restore record
    function restore() {
        global $main, $su;
        //Check login
        $su->checkLogin('js');
        //Check referrer
        $su->checkRef();
        //Check Ajax call
        $su->checkAjax();

        $id = $main->get('PARAMS.id');
        //Check if id is numeric
        $su->checkNumeric($id);

//Delete from database by updating just the state
//make a unique id attach to previous unique field
        $uid = uniqid() . '-';
        $sql = "UPDATE sulata_settings SET setting__Setting=SUBSTRING(setting__Setting," . ($main->get('UID_LENGTH') + 1) . "),setting__Key=SUBSTRING(setting__Key," . ($main->get('UID_LENGTH') + 1) . "), setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $main->get('SESSION.userInfo.employee__Name') . "-Restored', setting__dbState='Live' WHERE setting__ID = '" . $id . "' AND setting__dbState='Deleted'";

        $response = $su->query($sql, 'update');
        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {
            if ($response['affected_rows'] > 0) {
                //Restored
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').removeClass('ajax-error');\$('#ajax-response').addClass('ajax-note');}\$('#tr_" . $id . "').removeClass('deleted-row');\$('#restore_" . $id . "').addClass('hide');\$('#actions_" . $id . "').show();");
                echo $main->get('DICT.recordRestored');
            } else {
                //Restoration error
                $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
                echo $main->get('DICT.noRestorationRecordError');
            }
        } else {
            //Other error
            $su->printJs("if (\$('#ajax-response')) {\$('#ajax-response').removeClass('ajax-note');\$('#ajax-response').removeClass('ajax-success');\$('#ajax-response').addClass('ajax-error');}");
            echo $main->get('DICT.generalError');
        }
    }

    //Download CSV
    function csv() {
        global $main, $su;
        //Check login
        $su->checkLogin('js');
        //Check referrer
        $su->checkRef();

        $baseSql = $this->baseSql;
        $headerArray = array('ID', 'Setting', 'Key', 'Value');
        $outputFileName = 'settings.csv';
        $su->sqlToCSV($baseSql, $headerArray, $outputFileName);
    }

    //Download PDF
    function pdf() {
        global $main, $su;
        //Check login
        $su->checkLogin('js');
        //Check referrer
        $su->checkRef();

        $baseSql = $this->baseSql;
        $headerArray = array('ID', 'Setting', 'Key', 'Value');
        $outputFileName = 'settings.pdf';
        $su->sqlToPDF($baseSql, $headerArray, $outputFileName);
    }

}
