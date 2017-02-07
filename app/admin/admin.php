<?php

class Admin {

    function index() {
        global $main;
        if (!($main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.user__ID'))) {
            $main->reroute($main->get(ADMIN_URL).'login');
        }
        $pageTitle = 'Administration Home';
        $siteTitle = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_name').' - '.$pageTitle;
        $siteName = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_name');
        $siteUrl = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_url');
        $siteTagline = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_tagline');
        $siteFooter = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_footer');
        $siteFooterLink = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'getSettings.site_footer_link');
        $userName = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.employee__Name');
        $userPicture = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.employee__Picture');
        $userTheme = $main->get('SESSION.'.$main->get('SESSION_PREFIX').'userInfo.user__Theme');

        $main->set('pageInfo', array('site_title' => $siteTitle,'site_name'=>$siteName,'site_url'=>$siteUrl,'site_tagline'=>$siteTagline,'page_title'=>$pageTitle,'site_footer'=>$siteFooter,'site_footer_link'=>$siteFooterLink,'user_name'=>$userName,'user_picture'=>$userPicture,'user_theme'=>userTheme));
        echo \Template::instance()->render('admin/index.html');
    }

}
