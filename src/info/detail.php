<?php

$oInbodyDB = $GLOBALS['oInbodyDB'];
$oUserDB = $GLOBALS['oUserDB'];
$oAuth = $GLOBALS['oAuth'];

$key = $_POST['key'];

if (empty($key)) {
  json_return(201);
}

$result = $oInbodyDB->GetInbodyInfoByKey($key);

if ($result->count == 0) {
  json_return(301);
}

$agency = $oAuth->GetAdminInfoByKey((string)$result->data[0]['a_key']);

$obj->akey = $result->data[0]['a_key'];
$obj->agency = $agency->data[0]['address'];
$obj->mdate = $result->data[0]['m_date'];
$obj->wicell = $result->data[0]['w_i_cell'];
$obj->wocell = $result->data[0]['w_o_cell'];
$obj->protein = $result->data[0]['protein'];
$obj->mineral = $result->data[0]['mineral'];
$obj->body_fat = $result->data[0]['body_fat'];
$obj->weight = $result->data[0]['weight'];
$obj->s_muscle = $result->data[0]['s_muscle'];
$obj->bmi = $result->data[0]['bmi'];
$obj->p_body_fat = $result->data[0]['p_body_fat'];
$obj->waist_hip = $result->data[0]['waist_hip'];
$obj->height = $result->data[0]['height'];

json_return(100, $obj);
?>