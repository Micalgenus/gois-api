<?php
/**
 * @Class MySQL Database Manager
 */
class DB {
  private $hostname;
  private $database;
  private $username;
  private $password;

  private $conn;

  /**
   * @brief DB config파일을 읽고, DB연동 설정 변수를 적용
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

  function Connection() {
    // DB 연동
    try {
      $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      // Error 발생
      //echo 'Connection failed: ' . $e->getMessage();
      echo 'Database Error';

      exit -1;
    }
  }
}
?>