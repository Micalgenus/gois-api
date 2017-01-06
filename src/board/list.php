<?php

$oBoardDB = $GLOBALS['oBoardDB'];
$oUserDB = $GLOBALS['oUserDB'];

$result = $oBoardDB->GetBoardList();

$obj->size = $result->count;
$obj->list = array();
for ($i = 0; $i < $obj->size; $i++) {
  $tmp = NULL;
  $user = $oUserDB->GetUserInfoByKey($result->data[$i]['u_key']);
  $tmp->key = $result->data[$i]['b_key'];
  $tmp->title = $result->data[$i]['title'];
  $tmp->date = $result->data[$i]['w_date'];
  $tmp->hits = $result->data[$i]['count'];
  $tmp->writer = $user->data[0]['nickname'];
  array_push($obj->list, $tmp);
}

json_return(100, $obj);

?>