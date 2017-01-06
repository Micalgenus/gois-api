<?php

$oAuth = $GLOBALS['oAuth'];
$admin_id = $_POST['admin_id'];

// 입력 확인
if (empty($admin_id)) {
  json_return(200);
}

if ($oAuth->GetAdminInfoById($admin_id)->count == 0) {
  json_return(201);
}

$result = $oAuth->GetUserListByAdminId($admin_id);

$obj->size = $result->count;
$obj->list = array();

for ($i = 0; $i < $result->count; $i++) {
  $tmp = NULL;
  $tmp->id = $result->data[$i][2];
  $tmp->name = $result->data[$i]['name'];
  $tmp->sex = $result->data[$i]['sex'];
  $tmp->birth = $result->data[$i]['birth'];
  if (!in_array($tmp, $obj->list)) {
    array_push($obj->list, $tmp);
  } else {
    $obj->size--;
  }
}

json_return(100, $obj);
?>