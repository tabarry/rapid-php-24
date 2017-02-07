<?php

class Settings {
    /* View settings */

    function view() {
        global $main,$su;

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

        $where = '';
        if($main->get('GET.q')){
          $where .= " AND setting__Setting LIKE '%".$main->get('GET.q')."%' ";
        }
        if($main->get('GET.f')){
          $where .= " ORDER BY ".$main->get('GET.f')." ".$main->get('GET.s');
        }else{
          $where .= " ORDER BY setting__Setting ASC";
        }
        $sql = "SELECT setting__ID, setting__Setting, setting__Key, setting__Value FROM sulata_settings WHERE setting__dbState='Live' AND setting__Type ='Public' {$where} LIMIT 0, ".$main->get('PAGE_SIZE');
        $response = $su->query($sql);
        //$su->printArray($response);
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
