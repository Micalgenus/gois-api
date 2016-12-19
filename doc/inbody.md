## INBODY

### 모든 명령에 POST 데이터로 포함되어야함(권한)
* admin_id : 권한이 있는 관리자의 아이디
* admin_pw : 권한이 있는 관리자의 비밀번호

------

### 인바디 정보 입력
POST ` https://api.server/info/insert `

###### POST 인자
* agency : 기관 키
* ukey : 사용자 키
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
* visceral_fat : 비만 정도률 (Visceral Fat Area)

###### Status Code
* 0 : 알 수 없는 오류
* 100 : 성공
* 999 : 생성 권한 없음

###### 출력 결과 (JSON)
* status : 실행 결과
