<?php

$oInbodyDB = $GLOBALS['oInbodyDB'];
$oUserDB = $GLOBALS['oUserDB'];

$id = $_POST['id'];

if (empty($id)) {
  json_return(201);
}

$user = $oUserDB->GetUserInfoById($id);
if ($user->count == 0) {
  json_return(301);
}

$result = $oInbodyDB->GetInbodyInfoById($id);

$obj->size = $result->count;
$obj->list = array();
for ($i = 0; $i < $obj->size; $i++) {
  $tmp = NULL;
  $tmp->key = $result->data[$i]['i_key'];
  $tmp->date = $result->data[$i]['m_date'];
  array_push($obj->list, $tmp);
}

json_return(100, $obj);
?>