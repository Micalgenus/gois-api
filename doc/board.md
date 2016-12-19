## BOARD

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번호

------

### 게시판 글 입력
POST ` https://api.server/board/insert `

###### POST 인자
* id : 사용자 ID
* title : 제목 (256byte)
* contents : 내용 (Text)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 200 : 아이디 입력 하지 않음
* 201 : 아이디가 존재 하지 않음
* 300 : 날짜 입력 하지 않음
* 400 : 제목 입력 하지 않음
* 500 : 내용 입력 하지 않음
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과

------

### 게시판 리스트 출력
POST ` https://api.server/board/list `

###### POST 인자
* 인자 없음

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
* size : 결과 갯수
* list : array 형태의 {key, title, writer, date, hits}

------

### 게시판 정보 출력
POST ` https://api.server/board/detail `

###### POST 인자
* key : 문서 번호

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 200 : 키가 존재하지 않음
* 201 : 문서가 존재하지 않음
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
* title : 제목
* writer : 작성자
* date : 작성 날짜
* hits : 조회수
* contents : 

------

### 게시판 정보 출력
POST ` https://api.server/board/delete `

###### POST 인자
* key : 문서 번호
* id : 로그인된 ID

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 200 : 키 입력 X
* 300 : ID 입력 X
* 301 : ID가 존재하지 않음
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
