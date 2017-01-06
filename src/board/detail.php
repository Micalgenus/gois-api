<?php

$oBoardDB = $GLOBALS['oBoardDB'];
$oUserDB = $GLOBALS['oUserDB'];

$key = $_POST['key'];

if (empty($key)) {
  json_return(200);
}

$result = $oBoardDB->GetBoardInfoByKey($key);
if ($result->count == 0) {
  json_return(201);
}
$user = $oUserDB->GetUserInfoByKey($result->data[0]['u_key']);
$oBoardDB->AddCounter($key);

$obj->title = $result->data[0]['title'];
$obj->writer = $user->data[0]['nickname'];
$obj->id = $user->data[0]['id'];
$obj->date = $result->data[0]['w_date'];
$obj->hits = $result->data[0]['count'];
$obj->contents = str_replace("\n", "<br />", $result->data[0]['contents']);

json_return(100, $obj);

?>