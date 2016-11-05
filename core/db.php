<?php
/**
 * @brief DB Manager Class Load
 */
require_once dirname(__FILE__) . '/class/db.class.php';

// DB Connection
$oDB = new DB($db_config);
$oDB->Connection();
?>