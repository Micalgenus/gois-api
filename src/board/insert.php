<?php

$oBoardDB = $GLOBALS['oBoardDB'];
$oUserDB = $GLOBALS['oUserDB'];

$id = $_POST['id'];
$title = $_POST['title'];
$contents = $_POST['contents'];

if (empty($id)) {
  json_return(200);
}

if (empty($title)) {
  json_return(400);
}

if (empty($contents)) {
  json_return(500);
}

$user = $oUserDB->GetUserInfoById($id);
if ($oUserDB->GetUserInfoById($id)->count == 0) {
  json_return(201);
}

$oBoardDB->InsertBoardInfo($user->data[0]['u_key'], $title, $contents);
json_return(100);
?>