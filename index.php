<?php
/**
 * @author 1'S(Get Oneself Into Shape)
 * @source https://github.com/Micalgenus/gois-api
 * @brief Index page
 *
 * "Get Oneself Into Shape의 API를 관리하기 위한 프로젝트
 * Client와 Web의 DB접근을 위한 중간 서버이다.
 * 자세한 사용 방법은 doc문서를 참조하세요."
 */

/**
 * @brief 기본 설정
 */
require_once dirname(__FILE__) . '/core/config.php';

/**
 * @brief DB 설정
 */
require_once dirname(__FILE__) . '/core/db.php';

/**
 * @brief 권한 설정
 */
require_once dirname(__FILE__) . '/core/auth.php';

/**
 * @brief Router 연결 설정
 */
require_once dirname(__FILE__) . '/core/router.php';

/**
 * @brief 서비스 시작
 */
require_once dirname(__FILE__) . '/core/service.php';

?>