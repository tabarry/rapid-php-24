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
        $siteName = $main->get('SESSION.getSettings.site_name');
        $siteUrl = $main->get('SESSION.getSettings.site_url');
        $siteTagline = $main->get('SESSION.getSettings.site_tagline');
        $siteFooter = $main->get('SESSION.getSettings.site_footer');
        $siteFooterLink = $main->get('SESSION.getSettings.site_footer_link');
        $userName = $main->get('SESSION.userInfo.employee__Name');
        $userPicture = $main->get('SESSION.userInfo.employee__Picture');
        $userTheme = $main->get('SESSION.userInfo.user__Theme');

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
        $main->set('pageInfo', array('site_title' => $siteTitle, 'site_name' => $siteName, 'site_url' => $siteUrl, 'site_tagline' => $siteTagline, 'page_title' => $pageTitle, 'site_footer' => $siteFooter, 'site_footer_link' => $siteFooterLink, 'user_name' => $userName, 'user_picture' => $userPicture, 'user_theme' => userTheme, 'error' => $error, 'result' => $result));
        echo \Template::instance()->render('admin/settings.html');
    }

//Delete record
    function delete() {
        global $main, $su;
        //Check login
        $su->checkLogin('js');
        //Check referrer
        $su->checkRef();

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
