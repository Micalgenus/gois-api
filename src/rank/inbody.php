<?php

$oRankDB = $GLOBALS['oRankDB'];
$oUserDB = $GLOBALS['oUserDB'];

$rank = $oRankDB->GetInbodyRank();

$obj->size = $rank->count;
$obj->list = array();

for ($i = 0; $i < $rank->count; $i++) {
  $tmp = NULL;
  $tmp->nickname = $oUserDB->GetUserInfoByKey($rank->data[$i]['u_key'])->data[0]['nickname'];
  $tmp->score = $rank->data[$i]['score'];
  if (!in_array($tmp, $obj->list) && preg_match('/[^0-9]+$/', $tmp->nickname)) {
    array_push($obj->list, $tmp);
  } else {
    $obj->size--;
  }
}

json_return(100, $obj);
?>