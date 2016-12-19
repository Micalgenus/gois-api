## RANK

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번`호

------

### 소셜 랭크
POST ` https://api.server/rank/social `

###### POST 인자
* 인자 없음

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공

###### 출력 결과 (JSON)
* status : 실행 결과
* size : 결과 갯수
* list : array 형태의 {nickname, score}
