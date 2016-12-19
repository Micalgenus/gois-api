## BOARD

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번호

------

### 게시판 글 입력
POST ` https://api.server/board/insert `

###### POST 인자
* agency : 기관 키
* id : 사용자 ID
* wdate : 작성 날짜 (YYYY-MM-DD HH:mm:SS)
* title : 제목 (256byte)
* contents : 내용 (Text)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
