<?php
/**
 * @Class Database Manager for User Table
 *
 * @member DB = 연결된 DB 정보
 */
class UserDatabase {
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

  function GetUserInfoByKey($key = NULL) {
    if ($key == NULL) {
      response(500, "Get User Key Error");
    }

    $table = "user";
    $option = "WHERE u_key = ?";
    $options = array($key);
    $result = $this->DB->SELECT($table, $option, $options);

    return $result;
  }

  function GetUserInfoById($id = NULL) {
    if ($id == NULL) {
      response(500, "Get User ID Error");
    }

    $table = "user";
    $option = "WHERE id = ?";
    $options = array($id);
    $result = $this->DB->SELECT($table, $option, $options);

    return $result;
  }

  function GetUserInfoByName($name = NULL) {
    if ($id == NULL) {
      response(500, "Get User Name Error");
    }

    $table = "user";
    $option = "WHERE name = ?";
    $options = array($name);
    $result = $this->DB->SELECT($table, $option, $options);

    return $result;
  }

  function UpdateUserData($key = NULL, $id = NULL, $pw = NULL, $name = NULL, $birth = NULL, $sex = NULL) {
    if ($key == NULL) {
      response(500, "User Update Key Error");
    }
  }

  function CreateUser($id = NULL, $pw = NULL, $name = NULL, $birth= NULL, $sex = NULL, $agency = NULL) {
    if ($this->GetUserInfoById($id)->count != 0) {
      json_return(300);
    }

    if (strlen($id) > 20) {
      json_return(301);
    }

    do {
      $key = str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT) . str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT);
    } while ($this->GetUserInfoById($key)->count != 0);

    $this->DB->INSERT('user', 'VALUES(?, ?, ?, ?, ?, ?)', array($key, $id, hash('sha512', $pw), $name, $birth, $sex));
    
    return $key;
  }

  function CreateUserByAgency($name = NULL, $birth = NULL, $sex = NULL) {
    $id = rand();
    $pw = rand();

    return $this->CreateUser($id, $pw, $name, $birth, $sex);
  }
}
?>