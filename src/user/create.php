<?php

$oUserDB = $GLOBALS['oUserDB'];

$key = $_POST['key'];
$id = $_POST['id'];
$pw = $_POST['pw'];
$nickname = $_POST['nickname'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$sex = strtoupper($_POST['sex']);

// Check
if ((isset($key)) || (isset($id) || isset($pw) || isset($nickname))) {

  if (empty($id)) {
    json_return(310);
  }

  if (empty($pw)) {
    json_return(410);
  }

  if (empty($nickname)) {
    json_return(510);
  }
  
  if ($oUserDB->GetUserInfoById($id)->count != 0) {
    json_return(300);
  }

  if ($oUserDB->GetUserInfoByNickname($nickname)->count != 0) {
    json_return(500);
  }

  if (strlen($id) > 20) {
    json_return(301);
  }

  if (strlen($nickname) > 20) {
    json_return(501);
  }

  if (strlen($pw) < 8) {
    json_return(400);
  }

  // 비밀번호 문자 및 숫자 확인
  if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $pw)) {
    json_return(401);
  }
}

if (empty($name)) {
  json_return(610);
}

if (empty($birth)) {
  json_return(710);
}

if (empty($sex)) {
  json_return(810);
}

if (strlen($name) > 16) {
  json_return(600);
}

if (!preg_match('/^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$', $birth)) {
  json_return(700);
}

if ($sex != "F" || $sex != "M") {
  json_return(800);
}  

// 기존 키를 이용한 계정 생성
if (isset($key)) {
  $info = $oUserDB->UpdateUserData();
//  json_return(100);
// 회원 가입
} else if (isset($id) || isset($pw) || isset($nickname)) {
  $oUserDB->CreateUser($id, $pw, $name, $nickname, $birth, $sex);
  json_return(100);
// 키 생성
} else {
  $obj->key = $oUserDB->CreateUserByAgency($name, $birth, $sex);
  json_return(100, $obj);
}

?>