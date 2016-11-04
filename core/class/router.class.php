<?php
/**
 * @Class Routing Manager
 */
class Router {
  private $subject;
  private $command;
  private $option;

  private $routing;

  /**
   * @brief config파일을 불러오고, URL을 명령으로 정리함
   */
  function __construct() {
    // Config 파일을 JSON으로 읽어들임
    $this->routing = json_decode(file_get_contents( dirname(__FILE__) . '/../../config/router.config'), true);

    // URL을 주제, 명령, 옵션으로 나눔 (그 외는 버림)
    $url = $_GET['url'];

    $this->subject = split("/", $url)[0];
    $this->command = split("/", $url)[1];
    $this->option = split("/", $url)[2];

    // 대소문자 구분 없이 만듬
    $this->subject = strtoupper($this->subject);
    $this->command = strtoupper($this->command);
    $this->option = strtoupper($this->option);
  }

  function getRoutingString() {
    // routing 할 값이 없음
    if ($this->subject == NULL) {
      return NULL;
    }
    // Subject만 존재함 
    else if ($this->command == NULL) {
     // 값이 존재하는지 확인
      return $this->configCheck($this->routing[$this->subject]);
    }
    // Subject와 Command가 존재
    else if ($this->option == NULL) {
      // 값이 존재하는지 확인
      return $this->configCheck($this->routing[$this->subject][$this->command]);
    }
    // Subject, Command, Option이 모두 존재
    else {
      return NULL;
    }
  }

  function configCheck($value) {
    // 들어온 값이 문자열로 존재하는지 확인
    // array일 경우 하위 메뉴가 있음, 정보가 부족함
    if (gettype($value) == 'string') {
      return $value;
    }
    // Subject가 config에 존재하지 않음
    return NULL;
  }
}
?>