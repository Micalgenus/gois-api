<?php
/**
 * @brief Authentication Class Load
 */
require_once dirname(__FILE__) . '/db/auth.class.php';

$oAuth = new Auth($oDB);
$oAuth->authCheck();
?>