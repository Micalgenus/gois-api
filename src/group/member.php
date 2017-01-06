<?php

$oUserDB = $GLOBALS['oUserDB'];
$oGroupDB = $GLOBALS['oGroupDB'];

$key = $_POST['key'];

if (empty($key)) {
  json_return(201);
}

$group = $oGroupDB->GetGroupByKey($key);
if ($group->count == 0) {
  json_return(301);
}
$gkey = $group->data[0]['g_key'];

$result = $oGroupDB->GetGroupMemberByKey($gkey);

$obj->size = $result->count;
$obj->list = array();

for ($i = 0; $i < $obj->size; $i++) {
  $tmp = NULL;
  $tmp->key = $result->data[$i]['u_key'];
  $tmp->id = $result->data[$i]['id'];
  $tmp->nickname = $result->data[$i]['nickname'];
  array_push($obj->list, $tmp);
}

json_return(100, $obj);
?>