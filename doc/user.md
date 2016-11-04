## USER

### 모든 명령에 포함되어야함(권한)
* admin_id : 계정 생성 권한이 있는 관리자의 아이디
* admin_pw : 계정 생성 권한이 있는 관리자의 비밀번호

------

#### 계정 생성 (회원가입)
POST ` https://api.server/user/create `

###### POST 인자
* id : 생성할 계정의 아이디 (20 byte)
* pw : 생성할 계정의 비밀번호
* name : 사용자 이름 (16 byte)
* birth : 생일 (YYYY-MM-DD)
* sex : 성별 (M, F)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 2* : 아이디 관련 실패
* 3* : 비밀번호 관련 실패
* 4* : 이름 관련 실패
* 5* : 생일 관련 실패
* 6* : 성별 관련 실패
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과

======

#### 계정 생성 (키 생성)
POST ` https://api.server/user/create `

###### POST 인자
* name : 사용자 이름 (16 byte)
* birth : 생일 (YYYY-MM-DD)
* sex : 성별 (M, F)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 2* : 이름 관련 실패
* 3* : 생일 관련 실패
* 4* : 성별 관련 실패
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
* key : 사용자의 비밀키

======

#### 계정 생성 (기존 키를 이용한 생성)
POST ` https://api.server/user/create `

###### POST 인자
* key : 미리 생성된 비밀키
* id : 생성할 계정의 아이디 (20 byte)
* pw : 생성할 계정의 비밀번호
* name : 사용자 이름 (16 byte)
* birth : 생일 (YYYY-MM-DD)
* sex : 성별 (M, F)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 2* : 비밀키 관련 실패
* 3* : 아이디 관련 실패
* 4* : 비밀번호 관련 실패
* 5* : 이름 관련 실패
* 6* : 생일 관련 실패
* 7* : 성별 관련 실패
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
