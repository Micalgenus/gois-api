<?php
/**
 * @Class Database Manager for Group Table
 *
 * @member DB = 연결된 DB 정보
 */
class GroupDatabase {
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

  function CreateGroup($ukey = NULL, $name = NULL) {
    if ($ukey == NULL || $name == NULL) {
      response(500, "Create Group Error");
    }

    $this->DB->INSERT('u_group', 'VALUES(?, ?, ?)',
      array(NULL, $name, $ukey));
  }

  function JoinGroup($ukey = NULL, $name = NULL) {
    if ($ukey == NULL || $name == NULL) {
      response(500, "Create Group Error");
    }

    $group = $this->GetGroupInfoByGroupName($name);

    // group not exist
    if ($group->count == 0) {
      $this->CreateGroup($ukey, $name);
      $this->JoinGroup($ukey, $name);
      json_return(101);
    } else {
      $gkey = $group->data[0]['g_key'];
      $this->DB->INSERT('group_member', 'VALUES(?, ?)',
        array($ukey, $gkey));
    }
  }

  function IsGroupMember($ukey = NULL, $name = NULL) {
    if ($ukey == NULL || $name == NULL) {
      response(500, "Is Group Member Error");
    }

    $group = $this->GetGroupInfoByGroupName($name);
    $gkey = $group->data[0]['g_key'];

    $table = "group_member";
    $option = "WHERE u_key = ? and g_key = ?";
    $options = array($ukey, $gkey);
    $result = $this->DB->SELECT($table, $option, $options);
    
    if ($result->count == 0) return FALSE;
    return TRUE;

  }

  function GetGroupInfoByGroupName($name = NULL) {
    if ($name == NULL) {
      response(500, "Get Group Error");
    }

    $table = "u_group";
    $option = "WHERE g_name = ?";
    $options = array($name);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetGroupListByUserKey($ukey = NULL) {
    if ($ukey == NULL) {
      response(500, "Get Group List User Key Error");
    }

    $table = "group_member join u_group using(g_key)";
    $option = "WHERE u_key = ?";
    $options = array($ukey);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetGroupByName($name = NULL) {
    if ($name == NULL) {
      response(500, "Get Group By Name Error");
    }

    $table = "u_group";
    $option = "WHERE g_name = ?";
    $options = array($name);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetGroupByKey($key = NULL) {
    if ($key == NULL) {
      response(500, "Get Group By Key Error");
    }

    $table = "u_group";
    $option = "WHERE g_key = ?";
    $options = array($key);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function GetGroupMemberByKey($key = NULL) {
    if ($key == NULL) {
      response(500, "Get Group Member By Key Error");
    }

    $table = "u_group join group_member using(g_key) join user using(u_key)";
    $option = "WHERE g_key = ?";
    $options = array($key);
    $result = $this->DB->SELECT($table, $option, $options);
    return $result;
  }

  function JoinOutGroup($ukey = NULL, $gkey = NULL) {
    if ($ukey == NULL || $gkey == NULL) {
      response(500, "Join Out Group Error");
    }

    $table = "group_member";
    $option = "WHERE u_key = ? and g_key = ?";
    $options = array($ukey, $gkey);
    $result = $this->DB->DELETE($table, $option, $options);
    return $result;
  }
}
?>