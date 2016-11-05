<?php
/**
 * @Class MySQL Database Manager
 *
 * @hostname = 서버 주소
 * @database = 데이터베이스 이름
 * @username = 계정 이름
 * @password = 계정 비밀번호
 * @conn = 디비 주체 변수
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
   * @config_file = 설정 파일의 경로 (string)
   */
  function __construct() {
    // Config 파일을 JSON으로 읽어들임
    $config = json_decode(file_get_contents( dirname(__FILE__) . '/../../config/db.config'), true);

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
      echo 'Database Error';

      exit -1;
  /**
   * @brief Select 쿼리의 가장 베이스
   *
   * @table = Select를 하기 위한 테이블 (string)
   * @option = where를 위한 option (string)
   * @options = 검색을 위한 옵션 (array)
   *
   * @return Query result ((count, data) object)
   */
  function SELECT($table = NULL, $option = NULL, $options = NULL) {
    // table이 없을 경우 SELECT를 할 수 없어야함
    if ($table == NULL) {
      response(500, "Database Error");
    }

    $query = "SELECT * FROM " . $table;
    if ($option != NULL) {
      // Query option value check
      if ($options == NULL) {
        response(500, "Query Error");
      }

      // Query문 작성
      $query = $query . " WHERE " . $option;
      $stmt = $this->conn->prepare($query);
    }

    try {
      // Execute query
      $stmt->execute($options);
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
}
?>