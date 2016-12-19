## ADMIN

------

### 계정 확인 (로그인)
POST ` https://api.server/admin/login `

###### POST 인자
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번호

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 200 : 아이디를 입력 하지 않음
* 201 : 아이디가 존재 하지 않음
* 300 : 비밀번호를 입력 하지 않음
* 301 : 비밀번호가 일치 하지 않음

###### 출력 결과 (JSON)
* status : 실행 결과

------

### 사용자 계정 목록
POST ` https://api.server/admin/list `

###### POST 인자
* admin_id : 권한이 있는 관리자의 아이디

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 200 : id 입력 하지 않음
* 201 : 아이디가 존재 하지 않음

###### 출력 결과 (JSON)
* status : 실행 결과
* size : 계정 갯수
* list : array 형태의 {id, name, sex}

------

### 관리자 계정 정보 출력
POST ` https://api.server/admin/info `

###### POST 인자
* admin_id : 권한이 있는 관리자의 아이디

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공

###### 출력 결과 (JSON)
* status : 실행 결과
* key : 관리자 키
* address : 주소
