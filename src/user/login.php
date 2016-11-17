<?php

$oUserDB = $GLOBALS['oUserDB'];

$id = $_POST['id'];
$pw = $_POST['pw'];

// 입력 확인
if (empty($id)) {
  json_return(200);
}

if (empty($pw)) {
  json_return(300);
}

if ($oUserDB->GetUserInfoById($id)->count == 0) {
  json_return(201);
}

if ($oUserDB->UserLogin($id, $pw) == TRUE) {
  json_return(100);
} else {
  json_return(301);
}

?>