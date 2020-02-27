<?php
include_once dirname(__FILE__).'/../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

header('location:'.$sys->domain().'/dashboard/wellness/activities');
exit();