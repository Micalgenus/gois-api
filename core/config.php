<?php

// DB Config File Path
$db_config = dirname(__FILE__) . '/../config/db.config';

// Router Config File Path
$router_config = dirname(__FILE__) . '/../config/router.config';


/////////////////////
// Global function //
/////////////////////

/**
 * @brief 실행 결과 반환
 */
function response($status, $msg) {
  echo $msg;
  http_response_code($status);
  exit;
}

/**
 * @brief 결과를 JSON데이터로 반환
 */
function json_return($status = NULL, $obj = NULL) {
  if ($status == NULL) {
    response(500, "JSON Return Error");
  }

  $result = $obj;
  $result->status = $status;

  response(200, json_encode($result));
}

?>