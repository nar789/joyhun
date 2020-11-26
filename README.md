# joy service

## PLM

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
