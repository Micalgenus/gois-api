<?php
/**
 * @brief DB Manager Class Load
 */
require_once dirname(__FILE__) . '/class/db.class.php';

$oDB = new DB();
$oDB->Connection();
?>