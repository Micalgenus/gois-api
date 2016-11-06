<?php
/**
 * @brief DB Manager Class Load
 */
require_once dirname(__FILE__) . '/class/db.class.php';

/**
 * @brief User Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/user.class.php';

// DB Connection
$oDB = new DB($db_config);
$oDB->Connection();

// DB Init
$oUserDB = new UserDatabase($oDB);
?>