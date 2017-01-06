<?php
/**
 * @Class Database Manager for Board Table
 *
 * @member DB = 연결된 DB 정보
 */
class BoardDatabase {
  private $DB;

  /**
   * @brief DB 초기화
   *
   * @param DB = DB Object
   */
  function __construct($DB = NULL) {
    // 변수 초기화
    $this->DB = $DB;

    // 변수 확인
    if ($this->DB == NULL) {
      response(500, "DB Error");
    }
  }

  function InsertBoardInfo($ukey = NULL, $title = NULL, $content = NULL) {
    if ($ukey == NULL || $title == NULL || $content == NULL) {
      response(500, "Insert Board Error");
    }

    $wdate = date("Y-m-d H:i:s");
    $table = "health_board";
    $option = "VALUES(?, ?, ?, ?, ?, ?)";
    $options = array(NULL, $ukey, $wdate, $title, $content, 0);
    $result = $this->DB->INSERT($table, $option, $options);

    $oUserDB = $GLOBALS['oUserDB'];
    $oUserDB->UpSPoint($ukey);
  }

  function DeleteBoardInfo($key = NULL, $ukey = NULL) {
    
    if ($key == NULL || $ukey == NULL) {
      response(500, "Delete Board Error");
    }

    $table = "health_board";
    $option = "WHERE b_key = ?";
    $options = array($key);
    $this->DB->DELETE($table, $option, $options);
    
    $oUserDB = $GLOBALS['oUserDB'];
    $oUserDB->DownSPoint($ukey);
  }

  function GetBoardList() {
    $table = "health_board";
    $option = "ORDER BY b_key DESC";
    $options = array();
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetBoardInfoByKey($key = NULL) {
    if ($key == NULL) {
      response(500, "Get Board Info Error");
    }

    $table = "health_board";
    $option = "WHERE b_key = ?";
    $options = array($key);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function AddCounter($key = NULL) {
    if ($key == NULL) {
      response(500, "Add Board Counter Error");
    }

    $info = $this->GetBoardInfoByKey($key);
    $counter = $info->data[0]['count'];
    $counter++;

    $table = "health_board";
    $option = "count = ? WHERE b_key = ?";
    $options = array($counter, $key);
    $result = $this->DB->UPDATE($table, $option, $options);
    return $result;
  }
}
?>