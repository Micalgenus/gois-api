<?php

$oUserDB = $GLOBALS['oUserDB'];

$key = $_POST['key'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$sex = $_POST['sex'];

// 기존 키를 이용한 계정 생성
if (!empty($key)) {
  //$info = $oUserDB->UpdateUserData();
  print_r($key);
// 회원 가입
} else if (!empty($id) && !empty($pw)) {
  
  // Check
  if ($oUserDB->GetUserInfoById($id)->count != 0) {
    json_return(300);
  }

  if (strlen($id) > 20) {
    json_return(301);
  }

  if (strlen($pw) < 8) {
    json_return(400);
  }

  $oUserDB->CreateUser($id, $pw, $name, $birth, $sex);
  json_return(100);
// 키 생성
} else {
  $obj->key = $oUserDB->CreateUserByAgency($name, $birth, $sex);
  json_return(100, $obj); 
}

?>