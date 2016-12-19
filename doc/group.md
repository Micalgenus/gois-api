## GROUP

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번`호

------

### 그룹 참가
POST ` https://api.server/group/join `

###### POST 인자
* id : 사용자 ID
* name : 그룹 이름

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : id 입력 X
* 202 : name 입력 X

###### 출력 결과 (JSON)
* status : 실행 결과
