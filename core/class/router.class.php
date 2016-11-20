<?php
/**
 * @Class Routing Manager
 *
 * @member subject = 라우팅 기준의 최상위 값 
 * @member command = 라우팅 기준의 2번째 값
 * @member option = 라우팅 기준의 3번째 값
 * @member routing = 라우팅 설정 파일의 내용 값
 */
class Router {
  private $subject;
  private $command;
  private $option;

  private $routing;

  private $src;

  /**
   * @brief config파일을 불러오고, URL을 명령으로 정리함
   *
   * @param config_file = 설정 파일의 경로 (string)
   */
  function __construct($config_file = NULL) {
    // Config 파일 존재 체크
    if ($config_file == NULL || file_exists($config_file) == FALSE) {
      response(500, "ConfigDB Error");
    }

    // Config 파일을 JSON으로 읽어들임
    $this->routing = json_decode(file_get_contents($config_file), true);

    // 올바른 Config 파일인지 확인
    if ($this->routing == NULL) {
      response(500, "ConfigDB Error");
    }

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

  function getSrc() {
    $src->subject = $this->subject;
    $src->command = $this->command;
    $src->option = $this->option;

    return $src;
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

  /**
   * @brief 경로에 해당하는 파일 로드
   *
   * @param src = 불러올 파일 경로 (string)
   */
  function routingSource() {
    if ($this->src == NULL) {
      // 라우팅 테이블에 없을 경우 에러
      response(404, "Not Found");
    } else {
      // 라이팅이 존재 할 경우 파일을 불러옴
      require_once dirname(__FILE__) . '/../../' . $this->src;
    }
  }

  /**
   * @brief 불러올 경로를 구해 파일을 불러옴
   */
  function Route() {
    $this->src = $this->getRoutingString();
  }

  /**
   * @brief 인자로 온 값이 config파일에서 리프노드 인지 확인
   *
   * @param value 확인할 값
   */
  function configCheck($value = NULL) {
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