<?php
$oAuth = $GLOBALS['oAuth'];

$admin_id = $_POST['admin_id'];
$admin_pw = $_POST['admin_pw'];

// 입력 확인
if (empty($admin_id)) {
  json_return(200);
}

if (empty($admin_pw)) {
  json_return(300);
}

if ($oAuth->GetAdminInfoById($admin_id)->count == 0) {
  json_return(201);
}

if ($oAuth->authCheck() == TRUE) {
  json_return(100);
} else {
  json_return(301);
}

?>