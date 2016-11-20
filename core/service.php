<?php

$oAuth = $GLOBALS['oAuth'];
$oRouter = $GLOBALS['oRouter'];

// 라우팅
$oRouter->Route();
$src = $oRouter->getSrc();

if ($src->subject != "ADMIN" && $src->command != "LOGIN") {
  if ($src->subject != "TEST" && $src->command != "MYTEST") {
    // 권한 체크
    if ($oAuth->authCheck() == FALSE) {
      json_return(999);
    }
  }
}

// 경로 설정
$oRouter->routingSource();
?>