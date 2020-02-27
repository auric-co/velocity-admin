<?php
include_once dirname(__FILE__).'/System/System.php';
$sys = new System();
$sys->deleteCookie();
header('location:'.$sys->domain());
exit();