<?php

$oUserDB = $GLOBALS['oUserDB'];

$id = $_POST['id'];

if (empty($id)) {
  json_return(200);
}

if ($oUserDB->GetUserInfoById($id)->count == 0) {
  json_return(201);
}

// Get user infomation
$result = $oUserDB->GetUserInfoById($id)->data;

$req->key = $result[0]['u_key'];
$req->name = $result[0]['name'];
$req->birth = $result[0]['birth'];

switch ($result[0]['sex']) {
  case 'M':
    $req->sex = "남"; break;
  case 'F':
    $req->sex = "여"; break;
}

json_return(100, $req);

?>