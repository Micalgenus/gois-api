<?php

$oAuth = $GLOBALS['oAuth'];

$admin_id = $_POST['admin_id'];
$akey = $_POST['akey'];

if (empty($akey)) {
  $admin = $oAuth->GetAdminInfoById($admin_id);
} else {
  $admin = $oAuth->GetAdminInfoByKey($akey);
}

if ($admin->count == 0) {
  json_return(201);
}

$obj->key = $admin->data[0]['a_key'];
$obj->address = $admin->data[0]['address'];
$obj->latitude = $admin->data[0]['latitude'];
$obj->longitude = $admin->data[0]['longitude'];

json_return(100, $obj);
?>