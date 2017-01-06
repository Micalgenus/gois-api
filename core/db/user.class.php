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

  function CreateSocialPoint($ukey = NULL, $point = NULL) {
    
    if ($ukey == NULL || $point == NULL) {
      response(500, "Create Social Point Error");
    }
    
    $this->DB->INSERT('social_rank', 'VALUES(?, ?)',
      array($ukey, $point));
  }

  function GetSoicalPoint($ukey = NULL) {
    if ($ukey == NULL) {
      response(500, "Get Social Point Error");
    }
    
    $table = "social_rank";
    $option = "WHERE u_key = ?";
    $options = array($ukey);
    $result = $this->DB->SELECT($table, $option, $options);
  
    if ($result->count == 0) {
      $this->CreateSocialPoint($ukey, '0');
      return $this->GetSoicalPoint($ukey);
    }

    return $result;
  }

  function UpdateSocialPoint($ukey = NULL, $point = NULL) {

    if ($ukey == NULL || $point == NULL) {
      response(500, "Update Social Point Error");
    }

    $table = "social_rank";
    $option = "score = ? WHERE u_key = ?";
    $options = array($point, $ukey);
    $result = $this->DB->UPDATE($table, $option, $options);
  }

  function UpSPoint($ukey = NULL) {
    if ($ukey == NULL) {
      response(500, "User Update Key Error");
    }

    $user = $this->GetSoicalPoint($ukey);
    if ($user->count == 0) {
      $this->CreateSocialPoint($ukey, '100');
    } else {
      $spoint = $user->data[0]['score'];
      $spoint += 100;

      $this->UpdateSocialPoint($ukey, (string)$spoint);
    }
  }
  
  function DownSPoint($ukey = NULL) {
    if ($ukey == NULL) {
      response(500, "User Down Key Error");
    }

    $user = $this->GetSoicalPoint($ukey);
    if ($user->count == 0) {
      $this->CreateSocialPoint($ukey, '0');
    } else {
      $spoint = $user->data[0]['score'];
      $spoint -= 100;

      $this->UpdateSocialPoint($ukey, (string)$spoint);
    }
  }
  
  function CreateInbodyPoint($ukey = NULL, $point = NULL) {
    
    if ($ukey == NULL || $point == NULL) {
      response(500, "Create Inbody Point Error");
    }
    
    $this->DB->INSERT('inbody_rank', 'VALUES(?, ?)',
      array($ukey, $point));
  }

  function GetInbodyPoint($ukey = NULL) {
    if ($ukey == NULL) {
      response(500, "Get Inbody Point Error");
    }
    
    $table = "inbody_rank";
    $option = "WHERE u_key = ?";
    $options = array($ukey);
    $result = $this->DB->SELECT($table, $option, $options);
  
    if ($result->count == 0) {
      $this->CreateInbodyPoint($ukey, '0');
      return $this->GetInbodyPoint($ukey);
    }

    return $result;
  }

  function UpdateInbodyPoint($ukey = NULL, $point = NULL) {

    if ($ukey == NULL || $point == NULL) {
      response(500, "Update Inbody Point Error");
    }

    if ((int)$point > (int)$this->GetInbodyPoint($ukey)->data[0]['score']) {
      $table = "inbody_rank";
      $option = "score = ? WHERE u_key = ?";
      $options = array($point, $ukey);
      $result = $this->DB->UPDATE($table, $option, $options);
    }
  }

  function UpdateUserData($ukey = NULL, $id = NULL, $pw = NULL, $name = NULL, $nickname = NULL, $birth = NULL, $sex = NULL) {

    if ($ukey == NULL) {
      response(500, "User Update Key Error");
    }

    // key가 존재하지 않음
    if ($this->GetUserInfoByKey($ukey)->count == 0) {
      response(500, "User Update Key Error");
    }

    if ($id != NULL) {
      if ($this->GetUserInfoByKey($ukey)->data[0]['agency'] == '1') {
        $table = "user";
        $option = "id = ?, agency = 0 WHERE u_key = ?";
        $options = array($id, $ukey);
        $result = $this->DB->UPDATE($table, $option, $options);
      }
    }

    if ($pw != NULL) {
      $table = "user";
      $option = "pw = ? WHERE u_key = ?";
      $options = array(hash('sha512', $pw), $ukey);
      $result = $this->DB->UPDATE($table, $option, $options);
    }

    if ($nickname != NULL) {
      $table = "user";
      $option = "nickname = ? WHERE u_key = ?";
      $options = array($nickname, $ukey);
      $result = $this->DB->UPDATE($table, $option, $options);
    }
  }

  function CreateUser($id = NULL, $pw = NULL, $name = NULL, $nickname = NULL, $birth= NULL, $sex = NULL, $agency = '0') {
    if ($id == NULL || $pw == NULL || $name == NULL || $nickname == NULL || $birth == NULL || $sex == NULL) {
      response(500, "Create User Error");
    }

    // 키 생성
    do {
      $key = str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT) . str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT);
    } while ($this->GetUserInfoById($key)->count != 0);

    $this->DB->INSERT('user', 'VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
      array($key, $id, hash('sha512', $pw), $name, $birth, $sex, $agency, $nickname));
    
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

    return $this->CreateUser($id, $pw, $name, $nickname, $birth, $sex, '1');
  }
}
?>