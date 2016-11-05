<?php
/**
 * @Class Authentication Manager Class
 */
class Auth {
  private $id;
  private $pw;

  private $db;

  /**
   * @brief 관리자 계정 초기화 및 DB 초기화
   *
   * @DB = DB Object (DB Class)
   */
  function __construct($DB = NULL) {
    // 변수 초기화
    $this->id = $_POST['admin_id'];
    $this->pw = $_POST['admin_pw'];
    $this->DB = $DB;

    // 변수 확인
    if ($this->DB == NULL) {
      response(500, "DB Error");
    }

    // 입력 확인
    if (empty($this->id) || empty($this->pw)) {
      json_return(999);
    }
  }

  /**
   * @brief 권한이 있는 계정인지 판단
   */
  function authCheck() {
    $table = "agency";
    $option = "id = ? and pw = ?";
    $options = array($this->id, hash('sha512', $this->pw));
    $result = $this->DB->SELECT($table, $option, $options);

    if ($result->count != 1) {
      response(500, "auth Error");
    }
  }
}
?>