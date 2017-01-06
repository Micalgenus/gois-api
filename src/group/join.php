<?php

$oUserDB = $GLOBALS['oUserDB'];
$oGroupDB = $GLOBALS['oGroupDB'];

$id = $_POST['id'];
$name = $_POST['name'];

if (empty($id)) {
  json_return(201);
}

if (empty($name)) {
  json_return(202);
}

$user = $oUserDB->GetUserInfoById($id);
if ($user->count == 0) {
  json_return(301);
}

$ukey = $user->data[0]['u_key'];
// already
if ($oGroupDB->IsGroupMember($ukey, $name)) {
  json_return(401);
}

$oGroupDB->JoinGroup($ukey, $name);
json_return(100);
?>