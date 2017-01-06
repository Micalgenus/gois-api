<?php
/**
 * @Class Database Manager for Inbody Table
 *
 * @member DB = 연결된 DB 정보
 */
class InbodyDatabase {
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

  function InsertInbodyInfo($agency = NULL, $ukey = NULL, $mdate = NULL, $wicell = NULL, $wocell = NULL, $protein = NULL, $mineral = NULL, $body_fat = NULL, $weight = NULL, $height = NULL, $s_muscle = NULL, $bmi = NULL, $p_body_fat = NULL, $waist_hip = NULL) {
    
    if ($agency == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($ukey == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($mdate == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($wicell == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($wocell == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($protein == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($mineral == NULL) {
      response(500, "InsertInbodyInfo Error");
    }

    if ($body_fat == NULL) {
      response(500, "InsertInbodyInfo Error");
    }

    if ($weight == NULL) {
      response(500, "InsertInbodyInfo Error");
    }

    if ($height == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($s_muscle == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($bmi == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($p_body_fat == NULL) {
      response(500, "InsertInbodyInfo Error");
    }
    
    if ($waist_hip == NULL) {
      response(500, "InsertInbodyInfo Error");
    }

    $this->DB->INSERT('inbody', 'VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
      array(NULL, $agency, $ukey, $mdate, $wicell, $wocell, $protein, $mineral, $body_fat, $weight, $s_muscle, $bmi, $p_body_fat, $waist_hip, '0', $height));
  }
  
  function GetInbodyInfoByKey($key = NULL) {
    if ($key == NULL) {
      response(500, "Get Inbody key Error");
    }

    $table = "inbody";
    $option = "WHERE i_key = ?";
    $options = array($key);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetInbodyInfoById($id = NULL) {
    if ($id == NULL) {
      response(500, "Get Inbody ID Error");
    }

    $oUserDB = $GLOBALS['oUserDB'];
    $user = $oUserDB->GetUserInfoById($id);
    if ($user->count == 0) {
      response(500, "Get Inbody: ID Not Found");
    }

    $ukey = $user->data[0]['u_key'];

    $table = "inbody";
    $option = "WHERE u_key = ?";
    $options = array($ukey);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }
  
  function GetInbodyInfoByAgency($agency = NULL) {
    if ($agencyid == NULL) {
      response(500, "Get Inbody Agency Error");
    }

    $table = "inbody";
    $option = "WHERE a_key = ?";
    $options = array($agency);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }
}
?>