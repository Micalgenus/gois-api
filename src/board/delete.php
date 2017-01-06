<?php

$oBoardDB = $GLOBALS['oBoardDB'];
$oUserDB = $GLOBALS['oUserDB'];

$key = $_POST['key'];
$id = $_POST['id'];

if (empty($key)) {
  json_return(200);
}

if (empty($id)) {
  json_return(300);
}

$user = $oUserDB->GetUserInfoById($id);
if ($user->count == 0) {
  json_return(301);
}

$info = $oBoardDB->GetBoardInfoByKey($key);
if ($info->count == 0) {
  json_return(201);
}

if ($user->data[0]['u_key'] != $info->data[0]['u_key']) {
  json_return(302);
}

$oBoardDB->DeleteBoardInfo($key, $user->data[0]['u_key']);
json_return(100);
?>