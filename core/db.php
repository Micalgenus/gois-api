<?php
/**
 * @brief DB Manager Class Load
 */
require_once dirname(__FILE__) . '/class/db.class.php';

/**
 * @brief User Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/user.class.php';

/**
 * @brief Inbody Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/inbody.class.php';

/**
 * @brief Board Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/board.class.php';

/**
 * @brief Rank Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/rank.class.php';

/**
 * @brief Group Database Manager Class Load
 */
require_once dirname(__FILE__) . '/db/group.class.php';

// DB Connection
$oDB = new DB($db_config);
$oDB->Connection();

// DB Init
$oUserDB = new UserDatabase($oDB);
$oInbodyDB = new InbodyDatabase($oDB);
$oBoardDB = new BoardDatabase($oDB);
$oRankDB = new RankDatabase($oDB);
$oGroupDB = new GroupDatabase($oDB);
?>