<?php
/**
 * @brief Routing Manager Class Load
 */
require_once dirname(__FILE__) . '/class/router.class.php';

// Init Router Class
$oRouter = new Router();

// 라우팅 결과를 문자열로 받음
$src = $oRouter->getRoutingString();
if ($src == NULL) {
  // 라우팅 테이블에 없을 경우 에러
  header("HTTP/1.0 404 Not Found");
  exit;
} else {
  // 라이팅이 존재 할 경우 파일을 불러옴
  require_once dirname(__FILE__) . '/../' . $src;
}
?>