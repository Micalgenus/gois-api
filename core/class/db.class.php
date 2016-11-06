<?php
/**
 * @Class MySQL Database Manager
 *
 * @member hostname = 서버 주소
 * @member database = 데이터베이스 이름
 * @member username = 계정 이름
 * @member password = 계정 비밀번호
 * @member conn = 디비 주체 변수
 */
class DB {
  private $hostname;
  private $database;
  private $username;
  private $password;

  private $conn;

  /**
   * @brief DB config파일을 읽고, DB연동 설정 변수를 적용
   *
   * @param config_file = 설정 파일의 경로 (string)
   */
  function __construct($config_file = NULL) {
    // Config 파일 존재 체크
    if ($config_file == NULL || file_exists($config_file) == FALSE) {
      response(500, "Config Error");
    }

    // Config 파일을 JSON으로 읽어들임
    $config = json_decode(file_get_contents($config_file), true);

    // 올바른 Config 파일인지 확인
    if ($config == NULL) {
      response(500, "Config Error");
    }

    // DB 정보 설정
    $this->hostname = $config['hostname'];
    $this->database = $config['database'];
    $this->username = $config['username'];
    $this->password = $config['password'];
  }

  /**
   * @brief DB 연결 시행
   */
  function Connection() {
    try {
      // DB 연동
      $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      // DB Error 예외처리
      //echo 'Connection failed: ' . $e->getMessage();
      response(500, "Database Error");
    }
  }

  /**
   * @brief Select 쿼리의 가장 베이스
   *
   * @param table = Select를 하기 위한 테이블 (string)
   * @param option = SELEC를 위한 추가 option (string)
   * @param option_value = 옵션에 필요한 값 (array)
   *
   * @return Query result ((count, data) object)
   */
  function SELECT($table = NULL, $option = NULL, $option_value = NULL) {
    // table이 없을 경우 SELECT를 할 수 없어야함
    if ($table == NULL) {
      response(500, "SELECT Query Error");
    }

    $query = "SELECT * FROM " . $table;

    // 옵션 추가
    if ($option != NULL) {
      // Query문 작성
      $query = $query . " " . $option;
      $stmt = $this->conn->prepare($query);
    }

    try {
      // Execute query
      $stmt->execute($option_value);
    } catch (PDOException $e) {
      // Query Error 예외처리
      response(500, "Query Error");
    }

    // Reulst object (count, data)
    $result->count = $stmt->rowCount();
    $result->data = $stmt->fetchAll();

    // Return tuple data
    return $result;
  }

  function INSERT($table = NULL, $option = NULL, $option_value = NULL) {
    if ($table == NULL || $option == NULL || $option_value == NULL) {
      response(500, "INSERT Query Error");
    }

    $query = "INSERT INTO " . $table . " " . $option;
    $stmt = $this->conn->prepare($query);

    try {
      // Execute query
      $stmt->execute($option_value);
    } catch (PDOException $e) {
      // Query Error 예외처리
      response(500, "Query Error");
    }
  }
}
?>