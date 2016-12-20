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
* 100 : 성공 (참가)
* 101 : 성공 (생성)
* 201 : id 입력 X
* 202 : name 입력 X
* 301 : 존재하지 않는 id
* 401 : 그룹에 이미 가입함

###### 출력 결과 (JSON)
* status : 실행 결과

------

### 자신의 그룹 리스트
POST ` https://api.server/group/mylist `

###### POST 인자
* id : 사용자 ID

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : id 입력 X
* 301 : 존재하지 않는 id

###### 출력 결과 (JSON)
* status : 실행 결과
* size : 결과 갯수
* list : array 형태의 {key, name}

------

### 그룹 멤버
POST ` https://api.server/group/member `

###### POST 인자
* name : 그룹 이름

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : name 입력 X
* 301 : 존재하지 않는 name

###### 출력 결과 (JSON)
* status : 실행 결과
* size : 결과 갯수
* list : array 형태의 {key, id, nickname}

------

### 그룹 탈퇴
POST ` https://api.server/group/joinout `

###### POST 인자
* name : 그룹 이름
* id : 사용자 ID

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : id 입력 X
* 202 : name 입력 X
* 301 : 존재하지 않는 id
* 501 : 그룹이 존재하지 않음
* 501 : 그룹의 멤버가 아님

###### 출력 결과 (JSON)
* status : 실행 결과
