# joy service

## PLM

### add token for kpi request

- CID : 372d576ca6e83f69e3780f717678761b4c032091
- ISSUE : 한국전자인증 도메인 심사를 위한 토큰 추가
- REASON : 대표 요청
- MEASURE : http://joyhunting.com/.well-known/pki-validation/fileauth.txt 에 토큰이
  토큰이 표시되도록 라우팅 설정

### add meta tag for searching by naver bot

- CID : 0a3c5340f25ee2315d80fa1eed6fdbfb66e40c61
- ISSUE : 네이버 사이트 등록을 위한 메타 태그 추가
- REASON : 대표 요청
- MEASURE : views/top_v.php에 메타 태그 추가

### chg admin count of user list to 30 and add print feature for printing user list

- CID : fc696d5908072668c96eac8756bf0de8142377d7
- ISSUE : 관리자 유저 목록 카운트 개수를 30개로 늘리고 유저 목록 프린트 기능을 추가
- REASON : 대표 요청
- MEASURE : 관리자 유저 목록 카운트 개수를 30개로 늘리고 유저 목록 프린트 기능을 추가

### block write on make friend

- CID : 033ffda6915f17caff8936c9fdd86dc6625c05b9
- ISSUE : 친구만들기 게시판에 대해 block처리하지 못한 등록하기 버튼 하나가 존재했습니다.
- REASON : 친구만들기 게시판에 대해 block처리하지 못한 등록하기 버튼 하나가 존재했습니다.
- MEASURE : 놓쳤던 write button의 click listener를 false로 처리했습니다.

### block write feature on some boards

- CID : 142da0ac7a85911e65d61f294e76321a8c96363b
- ISSUE : 번개팅/소설팅/짝애정촌/친구만들기/애인만들기/공개구혼/결혼신청/재혼신청/토크
  에 대하여 글 쓰기를 못하도록 수정 요청
- REASON : 불량 게시물이 과다하게 올라옴
- MEASURE : 각 게시판 views 페이지에서 write button을 주석처리

### hide mobile banner ad

- CID : 861e0ebed8bf27e44b7aeef36f67160fb9ef4fa2
- ISSUE : 모바일 리스트 m/online_mb 배너 광고 숨김 처리
- REASON : 모바일 배너 광고 숨김처리
- MEASURE : latest_helper에서 m_list_banner() 공백으로 return 처리

### hide my introduce

- CID : e291d03151a684ac164eaf9410c166a948c0c419
- ISSUE : 의뢰인 요구사항으로 프로필 profile/main/user자기소개 숨김처리
- REASON : 의뢰인 요구사항으로 프로필 자기소개 숨김처리
- MEASURE : views/profile/main_v.php 에서 my_intro 관련 코드 주석 처리

### [P201127] fix register_cert bug

- CID : 7a69f6c50f1dc7c936de9a1f0af85e6c0b90e44d
- ISSUE : 회원가입 시, 본인인증 공백
- REASON : 네이버 지도 가져오는 부분이 회원가입하고 본인인증 때,
  현재위치를 가져오는데 그 부분이 잘못동작되어 페이레터 api를 사용한 본인인증 처리 후, 흰 공백화면이 출력되는 버그가 발생.
- MEASURE : 임시 방편으로 application/helpers/code_change_helper의 get_map_addr() 함수를 공백처리하고 array(0,0)을 리턴했다.
  네이버 지도 api를 사용하는 메소드가 여기에 모아져 있는 듯 하여 추후 api 키코드와 api 함수를 재 연결 시킬 필요가 있으며,
  본인인증 동작 테스트를 위해 페이레터 아이디 비밀번호 정보 및 로그인 확인은 필요하다.

### [P201122] FIX not working chatting issue

- CID : 45db7473448548667cd324109af5c5ec8441ea2f
- ISSUE : 모바일/웹 전부 채팅이 안되는 이슈가 발생
- REASON : 서버 문제인지 알았으나, DB나 캐시로 인한 속도 저하랑은 전혀 관계가 없었고,
  application/controllers/chat.php에서 chat_request() 채팅 요청 관련 메소드에서
  getGeo()함수로 네이버 위치 api를 사용했는데 이게 api 버전 업 되면서 기존 코드들이 작동하지 않았다.
- MEASURE : 임시 방편으로 getGeo()관련 코드들을 주석처리하고, getDistance()로 거리를 계산했던 $data['to_distance]에
  '0km'을 입력했다.
