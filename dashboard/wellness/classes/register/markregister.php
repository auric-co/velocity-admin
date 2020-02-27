<?php
include_once dirname(__FILE__).'/../../../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

$ses = $_POST['session'];
$cls = $_POST['class_id'];
$id = $_POST['member'];
$status = $_POST['status'];

if($ses && $ses !=="" && $cls && $cls !== "" && $id && $id !== "" && $status && $status !== ""){
    

    $sys->setSession_id($ses);
    $sys->setClass_id($cls);
    $sys->setId($id);
    $sys->setStatus($status);
    $attend = $sys->markReg();
    
    if($attend['success']){
        echo json_encode(array('success' => true, 'attend' => $attend['attend']));
        exit();
    }else{
       echo json_encode((array('success' => false, 'error' => true)));
       exit();
    }
    
    
}else{
    echo json_encode(array('success' => false, 'data' => false));
    exit();
}



