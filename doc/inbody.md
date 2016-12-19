## INBODY

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번호

------

### 인바디 정보 입력
POST ` https://api.server/info/insert `

###### POST 인자
* agency : 기관 키
* id : 사용자 ID
* mdate : 검사한 날짜 (YYYY-MM-DD)
* wicell : 세포 내 수분
* wocell : 세포 외 수분
* protein : 단백질
* mineral : 무기질
* body_fat : 체지방
* weight : 체중
* s_muscle : 골격근량
* bmi : BMI
* p_body_fat : 체지방률
* waist_hip : 복부지방률

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : agency 없음
* 202 : id 없음
* 203 : mdate 없음
* 204 : wicell 없음
* 205 : wocell 없음
* 206 : protein 없음
* 207 : mineral 없음
* 208 : body_fat 없음
* 209 : weight 없음
* 210 : s_muscle 없음
* 211 : bmi 없음
* 212 : p_body_fat 없음
* 213 : waist_hip 없음
* 301 : ID 존재하지 않음
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과

------

### 인바디 정보 
POST ` https://api.server/info/select `

###### POST 인자
* id : 검색할 아이디

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 201 : ID 입력 안함
* 301 : ID 없음
* 999 : 조회 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
* list : array 형태의 {key, date}
