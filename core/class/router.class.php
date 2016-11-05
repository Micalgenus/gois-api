<?php
/**
 * @Class Routing Manager
 *
 * @subject = 라우팅 기준의 최상위 값 
 * @command = 라우팅 기준의 2번째 값
 * @option = 라우팅 기준의 3번째 값
 * @routing = 라우팅 설정 파일의 내용 값
 */
class Router {
  private $subject;
  private $command;
  private $option;

  private $routing;

  /**
   * @brief config파일을 불러오고, URL을 명령으로 정리함
   *
   * @config_file = 설정 파일의 경로 (string)
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

  /**
   * @brief 객체 내 변수를 이용하여 라우팅할 문자열 구함
   *
   * @return 라우팅이 불가능 할 경우 NULL
   *         가능할 경우 파일의 경로를 반환
   */
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
  /**
   * @brief 인자로 온 값이 config파일에서 리프노드 인지 확인
   *
   * @value 확인할 값
   */
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