# joy service

## PLM

### [P201122] FIX not working chatting issue

- CID : 45db7473448548667cd324109af5c5ec8441ea2f
- ISSUE : 모바일/웹 전부 채팅이 안되는 이슈가 발생
- REASON : 서버 문제인지 알았으나, DB나 캐시로 인한 속도 저하랑은 전혀 관계가 없었고,
  application/controllers/chat.php에서 chat_request() 채팅 요청 관련 메소드에서
  getGeo()함수로 네이버 위치 api를 사용했는데 이게 api 버전 업 되면서 기존 코드들이 작동하지 않았다.
- MEASURE : 임시 방편으로 getGeo()관련 코드들을 주석처리하고, getDistance()로 거리를 계산했던 $data['to_distance]에
  '0km'을 입력했다.
