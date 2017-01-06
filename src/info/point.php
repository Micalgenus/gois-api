<?php

$oInbodyDB = $GLOBALS['oInbodyDB'];
$oUserDB = $GLOBALS['oUserDB'];

$id = $_POST['id'];
$key = $_POST['key'];
$point = $_POST['point'];

if (empty($id) && empty($key)) {
  json_return(201);
}

if (empty($point)) {
  json_return(202);
}

if (empty($key)) {
  $user = $oUserDB->GetUserInfoById($id);
  if ($user->count == 0) {
    json_return(301);
  }
} else {
  $user = $oUserDB->GetUserInfoByKey($key);
  if ($user->count == 0) {
    json_return(301);
  }
}

$ukey = $user->data[0]['u_key'];

$oUserDB->UpdateInbodyPoint($ukey, (string)$point);
json_return(100);
?>