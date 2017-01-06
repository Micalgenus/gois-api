<?php

$oUserDB = $GLOBALS['oUserDB'];
$oGroupDB = $GLOBALS['oGroupDB'];

$id = $_POST['id'];

if (empty($id)) {
  json_return(201);
}

$user = $oUserDB->GetUserInfoById($id);
if ($user->count == 0) {
  json_return(301);
}

$ukey = $user->data[0]['u_key'];
$result = $oGroupDB->GetGroupListByUserKey($ukey);

$obj->size = $result->count;
$obj->list = array();

for ($i = 0; $i < $obj->size; $i++) {
  $tmp = NULL;
  $tmp->key = $result->data[$i]['g_key'];
  $tmp->name = $result->data[$i]['g_name'];
  array_push($obj->list, $tmp);
}

json_return(100, $obj);
?>