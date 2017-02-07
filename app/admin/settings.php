<?php

class Settings {
    /* View settings */

    function view() {
        global $main,$su;

        //Template variables
        $pageTitle = 'Manage Settings';
        $siteTitle = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_name').' - '.$pageTitle;
        $siteName = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_name');
        $siteUrl = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_url');
        $siteTagline = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_tagline');
        $siteFooter = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_footer');
        $siteFooterLink = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_footer_link');
        $userName = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.employee__Name');
        $userPicture = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.employee__Picture');
        $userTheme = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.user__Theme');

        //Build where condition
        $where = " WHERE setting__dbState='Live' AND setting__Type ='Public' ";
        $main->set('nextSort','desc');
        if($main->get('GET.q')){
          $where .= " AND setting__Setting LIKE '%".$main->get('GET.q')."%' ";
        }
        //Build order by condition
        if($main->get('GET.sort')){
          $get = explode('-',$main->get('GET.sort'));
          $field = $get[0];
          $sort = $get[1];
          if($sort=='asc'){
            $main->set('nextSort','desc');
          }else{
            $main->set('nextSort','asc');
          }
          $order .= " ORDER BY {$field} {$sort} ";
        }else{
          $order.= " ORDER BY setting__ID ASC ";
        }

        if(!$main->get('GET.start')){
          $start = 0;
        }else{
          $start = $main->get('GET.start');
        }

        //Build limit
        $limit = " LIMIT {$start}, ".$main->get('PAGE_SIZE');

        //SQL to get all records
        $limitlessSQL = "SELECT COUNT(setting__ID) as totalRecs FROM sulata_settings {$where} ";
        $response = $su->query($limitlessSQL);
        //Main totalRecs variable to pass to $su->paginate()
        $main->set('totalRecs',$response['result'][0]['totalRecs']);

        //SQL to get paginated records
        $sql = "SELECT setting__ID, setting__Setting, setting__Key, setting__Value FROM sulata_settings {$where} {$sort} {$limit} ";
        $response = $su->query($sql);

        if (($response['connect_errno'] == 0) && ($response['errno'] == 0)) {

          if ($response['num_rows'] > 0) {
            $result = $response['result'];
          }else{
            $error = $main->get('DICT.noRecordFound');
          }
        } else {
            //If error, display error
            $su->displayDbError($response);
        }
        $main->set('pageInfo', array('site_title' => $siteTitle,'site_name'=>$siteName,'site_url'=>$siteUrl,'site_tagline'=>$siteTagline,'page_title'=>$pageTitle,'site_footer'=>$siteFooter,'site_footer_link'=>$siteFooterLink,'user_name'=>$userName,'user_picture'=>$userPicture,'user_theme'=>userTheme,'error'=>$error,'result'=>$result));
        echo \Template::instance()->render('admin/settings.html');
    }



}
