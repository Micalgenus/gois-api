<?php

$oInbodyDB = $GLOBALS['oInbodyDB'];
$oUserDB = $GLOBALS['oUserDB'];

$agency = $_POST['agency'];
$id = $_POST['id'];
$key = $_POST['key'];
$mdate = $_POST['mdate'];
$wicell = $_POST['wicell'];
$wocell = $_POST['wocell'];
$protein = $_POST['protein'];
$mineral = $_POST['mineral'];
$body_fat = $_POST['body_fat'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$s_muscle = $_POST['s_muscle'];
$bmi = $_POST['bmi'];
$p_body_fat = $_POST['p_body_fat'];
$waist_hip = $_POST['waist_hip'];

if (empty($agency)) {
  $agency = '0';
}

if (empty($id) && empty($key)) {
  json_return(202);
}

/*
if (empty($mdate)) {
  json_return(203);
}
*/

if (empty($wicell)) {
  json_return(204);
}

if (empty($wocell)) {
  json_return(205);
}

if (empty($protein)) {
  json_return(206);
}

if (empty($mineral)) {
  json_return(207);
}

if (empty($body_fat)) {
  json_return(208);
}

if (empty($weight)) {
  json_return(209);
}

if (empty($height)) {
  json_return(214);
}

if (empty($s_muscle)) {
  json_return(210);
}

if (empty($bmi)) {
  json_return(211);
}

if (empty($p_body_fat)) {
  json_return(212);
}

if (empty($waist_hip)) {
  json_return(213);
}

if (empty($key)) {
  $user = $oUserDB->GetUserInfoById($id);
  if ($user->count == 0) {
    json_return(301);
  }
} else {
  $user = $oUserDB->GetUserInfoByKey($key);
  if ($user->count == 0) {
    json_return(301);
  }
}

$ukey = $user->data[0]['u_key'];
if (empty($mdate)) $mdate = date("Y-m-d H:i:s");

$oInbodyDB->InsertInbodyInfo($agency, $ukey, $mdate, $wicell, $wocell, $protein, $mineral, $body_fat, $weight, $height, $s_muscle, $bmi, $p_body_fat, $waist_hip);
json_return(100);

?>