<?php

$oUserDB = $GLOBALS['oUserDB'];

$key = $_POST['key'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$sex = $_POST['sex'];

// 기존 키를 이용한 계정 생성
if (isset($key)) {
  //$info = $oUserDB->UpdateUserData();
// 회원 가입
} else if (isset($id) && isset($pw)) {
  $oUserDB->CreateUser($id, $pw, $name, $birth, $sex);
  json_return(100);
// 키 생성
} else {
  $obj->key = $oUserDB->CreateUserByAgency($name, $birth, $sex);
  json_return(100, $obj); 
}

?>