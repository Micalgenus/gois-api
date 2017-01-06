<?php
/**
 * @Class Database Manager for Rank Table
 *
 * @member DB = 연결된 DB 정보
 */
class RankDatabase {
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

  function GetSocialRank() {
    $table = "social_rank";
    $option = "ORDER BY score DESC";
    $options = array();
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetInbodyRank() {
    $table = "inbody_rank";
    $option = "ORDER BY score DESC";
    $options = array();
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }
}
?>