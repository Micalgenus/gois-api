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
   * @param DB = DB Object
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
  }
  
  function GetAdminInfoById($id = NULL) {

    if ($id == NULL) {
      response(500, "Get ADMIN ID Error");
    }

    $table = "agency";
    $option = "WHERE id = ?";
    $options = array($id);
    $result = $this->DB->SELECT($table, $option, $options);
    
    return $result;
  }

  /**
   * @brief 권한이 있는 계정인지 판단
   */
  function authCheck() {
    
    // 입력 확인
    if (empty($this->id) || empty($this->pw)) {
      json_return(999);
    }

    $table = "agency";
    $option = "WHERE id = ? and pw = ?";
    $options = array($this->id, hash('sha512', $this->pw));
    $result = $this->DB->SELECT($table, $option, $options);

    if ($result->count != 1) {
      return FALSE;
    }

    return TRUE;
  }
}
?>