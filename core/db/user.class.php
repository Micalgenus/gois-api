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

    if ($name == NULL) {
      response(500, "Get User Name Error");
    }

    $table = "user";
    $option = "WHERE name = ?";
    $options = array($name);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetUserInfoByNickname($nickname = NULL) {

    if ($nickname == NULL) {
      response(500, "Get User Nickname Error");
    }

    $table = "user";
    $option = "WHERE nickname = ?";
    $options = array($nickname);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function UserLogin($id = NULL, $pw = NULL) {

    if ($id == NULL || $pw == NULL) {
      response(500, "User Login Error");
    }

    $table = "user";
    $option = "WHERE id = ? and pw = ?";
    $options = array($id, hash('sha512', $pw));
    $result = $this->DB->SELECT($table, $option, $options);
    
    if ($result->count == 0) return FALSE;

    return TRUE;
  }

  function UpdateUserData($ukey = NULL, $id = NULL, $pw = NULL, $name = NULL, $birth = NULL, $sex = NULL) {

    if ($ukey == NULL) {
      response(500, "User Update Key Error");
    }

    // key가 존재하지 않음
    if ($this->GetUserInfoByKey($ukey)->count == 0) {
      json_return(200);
    }
  }

  function CreateUser($id = NULL, $pw = NULL, $name = NULL, $nickname = NULL, $birth= NULL, $sex = NULL, $agency = FALSE) {
    if ($id == NULL || $pw == NULL || $name == NULL || $nickname == NULL || $birth == NULL || $sex == NULL) {
      response(500, "Create User Error");
    }

    // 키 생성
    do {
      $key = str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT) . str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT);
    } while ($this->GetUserInfoById($key)->count != 0);

    $this->DB->INSERT('user', 'VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)', array($key, $id, hash('sha512', $pw), $name, $birth, $sex, $agency, $nickname, 0));
    
    return $key;
  }

  function CreateUserByAgency($name = NULL, $birth = NULL, $sex = NULL) {
    if ($name == NULL || $birth == NULL || $sex == NULL) {
      response(500, "Create User By Agency Error");
    }

    do {
      $id = rand();
    } while ($this->GetUserInfoById($id)->count != 0);

    do {
      $nickname = rand();
    } while ($this->GetUserInfoByNickname($nickname)->count != 0);

    $pw = rand();

    return $this->CreateUser($id, $pw, $name, $nickname, $birth, $sex, TURE);
  }
}
?>