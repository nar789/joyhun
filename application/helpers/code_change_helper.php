<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function talk_style_data($code,$m_sex = null){
		//대화 스타일 코드 데이터 m_character
		//성별, 코드값
			$data['M']['1'] = '오늘자유로운 남자';
			$data['M']['2'] = '체력좋은 남자';
			$data['M']['3'] = '연애하고픈 남자';
			$data['M']['4'] = '애인처럼 진실한남자';
			$data['M']['5'] = '낮에는 시간많은남자';
			$data['M']['6'] = '밤에 외로운남자';
			$data['M']['7'] = '눈치안보는 남자';
			$data['M']['8'] = '평일만 좋은남자';
			$data['M']['9'] = '알거 아는 싱글남자';
			$data['M']['10'] = '항상시간많은남자';
			$data['M']['11'] = '다좋은남자';
			$data['M']['12'] = '쿨 한싱글남자';
			$data['M']['13'] = '평일만 싱글인 남자';
			$data['M']['14'] = '가끔은 친구가능한남자';
			$data['M']['15'] = '독거싱글남자';
			$data['M']['16'] = '마음은 싱글인 남자';
			$data['M']['17'] = '능력많은 남자';
			$data['M']['18'] = '모태싱글 남자';
			$data['M']['19'] = '안심시켜주는 남자';

			$data['F']['101'] = '오늘자유로운 여자';
			$data['F']['102'] = '끼가많은 여자';
			$data['F']['103'] = '연애하고픈 여자';
			$data['F']['104'] = '밤에 외로운여자';
			$data['F']['105'] = '알거 아는 싱글여자';
			$data['F']['106'] = '평일만 좋은여자';
			$data['F']['107'] = '눈치안보는 여자';
			$data['F']['108'] = '쿨 한싱글여자';
			$data['F']['109'] = '독거싱글여자';
			$data['F']['110'] = '항상시간많은여자';
			$data['F']['111'] = '다좋은여자';
			$data['F']['112'] = '안심시켜주는 여자';
			$data['F']['113'] = '애인 말고진실한여자';
			$data['F']['114'] = '가끔은 친구가능한여자';
			$data['F']['115'] = '낮에는 시간많은여자 ';
			$data['F']['116'] = '체력좋은 여자';
			$data['F']['117'] = '평일만 싱글인여자';


		if($code == "all"){
		//셀렉트용으로 모든 배열값 반환
			if($m_sex == "M"){
				return $data['M'];
			}else if($m_sex == "F"){
				return $data['F'];
			}else{
				$data2 = array_merge($data['M'], $data['F']);
				return $data2;
			}
		}else if($code){
		//코드값에 해당하는 항목 하나를 리턴
			if(!empty($data['M'][$code])){
				return $data['M'][$code]; 
			}else if(!empty($data['F'][$code])){
				return $data['F'][$code]; 
			}else{
				return "기타";
			}
		}

		// 해당하는게 없으면
		if(count($data['M']) == 19){ return "알거 다 아는 싱글";
		}else if (count($data['F']) == 19){ return "알거 다 아는 싱글"; }
	}


	function want_reason_data($code){
		//원하는 만남 코드 데이터 m_reason
		$data['1'] = '커플이 되고 싶어요.';
		$data['2'] = '문자팅을 원해요.';
		$data['3'] = '함께 영화볼 사람을 찾아요.';
		$data['4'] = '드라이브 할 사람을 찾아요.';
		$data['5'] = '미팅을 원해요.';
		$data['6'] = '결혼을 원해요.';
		$data['7'] = '술 한잔 할 사람을 찾아요.';
		$data['8'] = '같이 바다 보러갈 사람을 찾아요.';
		$data['9'] = '메일 친구 구해요.';
		$data['10'] = '스트레스 풀 사람 찾아요.';
		$data['11'] = '콘서트 같이 가실 분을 찾아요.';
		$data['12'] = '여행 같이 가실 분을 찾아요.';
		$data['13'] = '놀이공원 같이 가실 분을 찾아요.';
		$data['14'] = '대화상대 찾아요.';
		$data['15'] = '좋은친구를 찾아요.';
		

		if($code == "all"){
		//셀렉트용으로 모든 배열값 반환
				return $data;
		}else if($code){
		//코드값에 해당하는 항목 하나를 리턴
			if(!empty($data[$code])){
				return $data[$code]; 
			}else{
				return "기타";
			}
		}

		// 해당하는게 없으면
		if(count($data) == 15){ return "커플이 되고 싶어요."; }


	}



	function my_intro_data($code){
		//인사말 코드 데이터 my_intro
		$data['1'] = '재미있는 얘기해요~ 시간 괜찮으세요?';
		$data['2'] = '내 인연은 어디있을까요?';
		$data['3'] = '대화하며 좋은 인연만들어 보실래여??';
		$data['4'] = '이렇게 만난것도 인연인데~ 우리 대화해요.';
		$data['5'] = '방가~ 화기애애한 대화! 강추합니다^^';
		$data['6'] = '지역이 어디세요?? 대화가능하신가요?';
		$data['7'] = '쉿!! 조건없는 만남 원합니다.~';
		$data['8'] = 'ㅎㅇ~ 머하세요? 님아 친구할래요?';
		$data['9'] = '우린 인연일까요? 마음 넉넉하신분이면 좋겠습니다.';
		$data['10'] = '친구처럼 지내고싶어요~편한 대화 나누어요~';
		$data['11'] = '방가~ 지금 뭐하고 계시나요?ㅋㅋ';
		$data['12'] = '마음이 넓고 따뜻한분 찾습니다. 있다면 손번쩍! ㅋ';
		$data['13'] = '하이~ 뭐하세요? 찾는분 계시나요?^^:;';
		$data['14'] = '부담없이 대화가능한 친구를 찾아요!';
		$data['15'] = '심심해요~ 님도 심심해서 들어오신거군요^^:;';
		$data['16'] = '요번 주말에 뭐하실꺼예요??';
		$data['17'] = '하이요~^^ 오늘하루 어떻게 보내셨나요?';
		$data['18'] = '친하게 지내보자구요.ㅎㅎ 편안하게 즐겁게';
		$data['19'] = '저와 좋은친구가 되어주실수 있나요?♡';
		$data['20'] = '날씨가 이런날에 친구가 있었음 좋겠어요.';
		$data['21'] = '친구같이 편안한 대화 하실분';
		$data['22'] = '드라이브 좋아하는 분을 찾아요.';
		$data['23'] = '우울한날에 이것보다 좋은게 없죠?';
		$data['24'] = '느낌 맞는 분을 찾아요.';
		$data['25'] = '연상인 분을 찾아요.';
		$data['26'] = '가까운분 찾아요. 맥주한잔 할수 있는 분';
		$data['27'] = '서로 느낌가는대로 둘만의 대화 나누고 싶네요.';
		$data['28'] = '통통한 스타일이에요. 좀 순진하고 조심스럽네요.';
		$data['29'] = '성격은 활발하지만 이성앞에선 좀 ㅎㅎ ';
		$data['30'] = '날씬스타일인데 통통한분 찾아요.';
		$data['31'] = '솔직히 몸매는 날씬해요. 좀 보수적이라 조심성이 많아요.';
		$data['32'] = '애인구해요. 모태솔로 벗어나고파';
		

		if($code == "all"){
		//셀렉트용으로 모든 배열값 반환
				return $data;
		}else if($code){
		//코드값에 해당하는 항목 하나를 리턴
			if(!empty($data[$code])){
				return $data[$code]; 
			}else{
				return "기타";
			}
		}

		// 해당하는게 없으면
		if(count($data) == 15){ return "요번 주말에 뭐하실꺼예요??"; }


	}

	//나의 인사말 db
	function call_my_intro($sex){

		$CI =& get_instance();
		$CI->load->model('my_m');
		
		//회원 성별에 맞는 인사말 데이터 가져오기
		$intro_list = $CI->my_m->result_array('INTRO_TEXT', array("ex_data" => "(V_SEX = '".$sex."' OR V_SEX = 'A') AND V_CODE = 'intro' AND V_USE_YN = 'Y'"), 'V_IDX', 'DESC', NULL);
		
		if(!empty($intro_list)){
			$rand_num = mt_rand(0, count($intro_list)-1);
			return str_replace("[지역]", "", $intro_list[$rand_num]['V_TEXT']);
		}else{
			return "친하게 지내보자구요.ㅎㅎ 편안하게 즐겁게";
		}

	}



	function want_time_text($int){

		//벙개팅 원하는 시간 텍스트로 변경
		switch ($int) {
		  case 1  : $str= "상관없음";
					   break;
		  case 2  : $str= "02시~06시";
					   break;
		  case 3  : $str= "06시~10시";
					   break;
		  case 4  : $str= "10시~14시";
					   break;
		  case 5  : $str= "14시~18시";
					   break;
		  case 6  : $str= "18시~22시";
					   break;
		  case 7  : $str= "22시~02시";
					   break;
		}
	
		return $str;
	}

	function interest_text($int){

		//벙개팅 관심사 텍스트로 변경
		switch ($int) {
		  case 1  : $str= "패션";
					   break;
		  case 2  : $str= "스포츠";
					   break;
		  case 3  : $str= "음악";
					   break;
		  case 4  : $str= "인터넷";
					   break;
		  case 5  : $str= "연극/영화";
					   break;
		  case 6  : $str= "재테크";
					   break;
		  case 7  : $str= "요리";
					   break;
		  case 8  : $str= "종교";
					   break;
		  case 9  : $str= "TV/비디오";
					   break;
		  case 10  : $str= "자동차";
					   break;
		  case 11  : $str= "온라인게임";
					   break;
		  case 12  : $str= "여행";
					   break;
		  case 13  : $str= "정치/사회";
					   break;
		  case 14  : $str= "기타";
					   break;
		}
	
		return $str;
	}



	function job_text($int){
		//문자팅 직업 텍스트로 변경
		switch ($int) {
			case 1  : $str= "학생";
						break;
			case 2  : $str= "컴퓨터/인터넷";
						break;
			case 3  : $str= "언론";
						break;
			case 4  : $str= "공무원";
						break;
			case 5  : $str= "군인";
						break;
			case 6  : $str= "서비스업";
						break;
			case 7  : $str= "교육";
						break;
			case 8  : $str= "금융/증권/보험업";
						break;
			case 9  : $str= "유통업";
						break;
			case 10  : $str= "예술";
						break;
			case 11  : $str= "의료";
						break;
			case 12  : $str= "법률";
						break;
			case 13  : $str= "건설업";
						break;
			case 14  : $str= "제조업";
						break;
			case 15  : $str= "부동산업";
						break;
			case 16  : $str= "운송업";
						break;
			case 17  : $str= "농/수/임/광산업";
						break;
			case 18  : $str= "자영업";
						break;
			case 19  : $str= "가사(주부)";
						break;
			case 20  : $str= "무직";
						break;
			case 21  : $str= "기타";
						break;
		}
	
		return $str;
	}



	function outstyle_text($int){
		//문자팅 외모 텍스트로 변경
		switch ($int) {
			case 1  : $str= "순수";
						break;
			case 2  : $str= "예쁨";
						break;
			case 3  : $str= "지적";
						break;
			case 4  : $str= "귀여움";
						break;
			case 5  : $str= "평범";
						break;
			case 6  : $str= "샤프함";
						break;
			case 7  : $str= "귀공녀";
						break;
			case 8  : $str= "폭탄";
						break;
			case 9  : $str= "섹시";
						break;
			case 10  : $str= "통통";
						break;
			default : $str= "기타";
						break;
		}
	
		return $str;
	}


	function character_text($int){
		//문자팅 성격 텍스트로 변경
		switch ($int) {
			case 1  : $str= "개방적";
						break;
			case 2  : $str= "화끈";
						break;
			case 3  : $str= "활달";
						break;
			case 4  : $str= "터프";
						break;
			case 5  : $str= "보수적";
						break;
			case 6  : $str= "차분";
						break;
			case 7  : $str= "순진";
						break;
			case 8  : $str= "소심";
						break;
			case 9  : $str= "내숭";
						break;
			case 10  : $str= "솔직";
						break;
			case 11  : $str= "명랑";
						break;
			case 12  : $str= "깔끔";
						break;
			case 13  : $str= "새침";
						break;
			default : $str= "기타";
						break;
		}
	
		return $str;
	}
	
	//FAQ관리 큰 카테고리
	function faq_top_category($int){
		switch ($int) {
			case 1  : $str= "개인정보";
						break;
			case 2  : $str= "로그인/접속";
						break;
			case 3  : $str= "서비스";
						break;
			case 4  : $str= "결제";
						break;
		}
		return $str;
	}

	//FAQ관리 배열 내용찾기
	function faq_sub_category($str){
		$data = faq_category("all"); //전체 데이터 받아오기
		$array = getParentStack($str, $data); //데이터 배열찾기 common_helper
		return key($array); //key값만 리턴
	}

	//FAQ 코드 변환
	function faq_category($chatset_sub){
	
		//개인정보
		$data['1']['cate'] = array('회원가입','아이디/비밀번호','내정보','회원탈퇴','아이디 도용','채팅');
		$data['1']['faq_title'] = "개인정보";
		$data['1']['href'] = "/service_center/faq/privacy";

		//로그인
		$data['2']['cate'] = array('접속환경','로그인 오류','로그아웃 오류','페이지 오류');
		$data['2']['faq_title'] = "로그인/접속";
		$data['2']['href'] = "/service_center/faq/login_faq";

		//서비스
		$data['3']['cate'] = array('미팅신청','조이채팅','포토미팅','친구만들기','프로필','공개구혼','비밀톡챗','소개팅','토크','최신영화','이벤트');
		$data['3']['faq_title'] = "서비스";
		$data['3']['href'] = "/service_center/faq/service_faq";

		//결제
		$data['4']['cate'] = array('유료회원','가입결제','포인트결제');
		$data['4']['faq_title'] = "결제";
		$data['4']['href'] = "/service_center/faq/payment";

		if($chatset_sub == "all"){
			return $data;
		}else{
			return $data[$chatset_sub];
		}
	}

	//FAQ에서 카테고리별 카운트
	function faq_count($cate1,$cate2){

		$CI =& get_instance();
		$cnt = $CI->my_m->cnt('faq_list', array('gubn1' => $cate1, 'gubn2' => $cate2));	//faq 갯수
		return $cnt;
	}

	
		
	//결제관련 코드변환
	//결재방법 코드변환
	function pay_mode($pay_gb){
		
		switch ($pay_gb) {
			case "HP"		 : $str = "휴대전화";		 	break;
			case "BK"		 : $str = "가상계좌";		 	break;
			case "CD"		 : $str = "카드결제";		 	break;
			case "AC"		 : $str = "계좌이체";		 	break;
			case "PB"		 : $str = "일반전화(받기)"; 		break;
			case "TP"	     : $str = "일반전화(걸기)"; 		break;
			case "MU"		 : $str = "무통장입금";			break;
							
		}
	
		return $str;
	}

	//가상계좌 은행코드 변환
	function bank_code($bk_code){

		switch ($bk_code){
			
			case "03"		: $str = "기업은행";		break;
			case "04"		: $str = "국민은행";		break;
			case "20"		: $str = "우리은행";		break;
			case "26"		: $str = "신한은행";		break;
			case "81"		: $str = "하나은행";		break;
			case "11"		: $str = "농협";			break;
			case "71"		: $str = "우체국";			break;
			case "27"		: $str = "한국씨티은행";	break;
			case "23"		: $str = "SC제일은행";		break;

		}

		return $str;
	}

	//KCP 카드결제 카드코드 변환
	function kcp_card_code($card_code){

		switch($card_code){

			case "CCKM"		: $str = "KB국민카드";		break;
			case "CCNJ"		: $str = "NH농협카드";		break;
			case "CCSG"		: $str = "신세계한미";		break;
			case "CCCT"		: $str = "씨티카드";		break;
			case "CCHM"		: $str = "한미카드";		break;
			case "CVSF"		: $str = "해외비자";		break;
			case "CCAM"		: $str = "롯데아멕스카드";	break;
			case "CCLO"		: $str = "롯데카드";		break;
			case "CCBC"		: $str = "BC카드";		break;
			case "CCPH"		: $str = "우리카드";		break;
			case "CCHN"		: $str = "하나SK카드";		break;
			case "CCSS"		: $str = "삼성카드";		break;
			case "CCKJ"		: $str = "광주카드";		break;
			case "CCSU"		: $str = "수협카드";		break;
			case "CCCU"		: $str = "심협카드";		break;
			case "CCJB"		: $str = "전북카드";		break;
			case "CCCJ"		: $str = "제주카드";		break;
			case "CCLG"		: $str = "신한카드";		break;
			case "CMCF"		: $str = "해외마스터";		break;
			case "CJCF"		: $str = "해외JCB";		break;
			case "CCKE"		: $str = "외환카드";		break;
			case "CCHS"		: $str = "현대증권카드";		break;
			case "CCDI"		: $str = "현대카드";		break;
			case "CCSB"		: $str = "저축카드";		break;
			case "CCKD"		: $str = "산업카드";		break;
			case "CCUF"		: $str = "은련카드";		break;

		}

		return $str;
	}


	//음악채팅 방이름의 코드부분 -> 이미지 변경
	Function title_style($title_val){

		$re_vals = $title_val;

		for($i=0;$i<33;$i++){

			If($i < 9){
				$i_vals = "0".($i+1);
			}else{
				$i_vals = $i + 1;
			}

			$re_vals = str_replace("$".$i."$", "<img src='/images/music_chat/title_room/room_t_img_w_".$i_vals.".gif' align='absmiddle' border='0' />",$re_vals);

		}

		return $re_vals;

	}

	//음악채팅 방이름의 코드부분 -> 이미지 변경
	Function title_style2($title_val, $m_status, $slen1, $slen2){
		$i_cnt = 0;
		$t_cnt = 0;
		$new_val = "";

		$split_val = explode("$", $title_val);

		For ($i = 0; $i < count($split_val); $i++){
			If (is_numeric($split_val[$i]) == True){
				If ( ((int)$split_val[$i] > -1) And ((int)$split_val[$i] < 32) ) {
					$i_cnt = $i_cnt + 1;
				}else{
					$tmp_cnt = strlen($split_val[$i]);
					$t_cnt = $t_cnt + $tmp_cnt;
				}
			}else{
				$tmp_cnt = strlen($split_val[$i]);
				$t_cnt = $t_cnt + $tmp_cnt;
			}
		}

		$see_len = ($t_cnt * 6) + ($i_cnt * 75);

		If ($m_status == 0){
			If ($see_len <= $slen1){
				$new_val = replace_Ico($title_val);
			}else{
				$new_val = replace_Ico($title_val);
				$new_val = "<marquee scrollamount=4>".$new_val."</marquee>";
			}
		}else{
			If($see_len <= $slen2){
				$new_val = replace_Ico($title_val);
			}else{
				$new_val = replace_Ico($title_val);
				$new_val = "<marquee scrollamount=4>".$new_val."</marquee>";
			}
		}

		return $new_val;
	}

	//음악채팅 방이름의 코드부분 -> 이미지 변경
	Function replace_Ico($w_val){
		$re_val = $w_val;

		for($kk=0;$kk<33;$kk++){
			If ($kk < 9){
				$i_val = "0".($kk+1);
			}else{
				$i_val = $kk + 1;
			}

			If ($kk > 24){
				$re_val = str_replace("$".$kk."$", "<img src='/images/music_chat/title_room/room_t_img_w_".$i_val.".gif' align='absmiddle' border='0' />&nbsp;&nbsp;&nbsp;",$re_val);
			}else{
				$re_val = str_replace("$".$kk."$", "<img src='/images/music_chat/title_room/room_t_img_w_".$i_val.".gif' align='absmiddle' border='0' />",$re_val);
			}
		}
		return $re_val;
	}


	//이미지 src만 추출 정규식
	function img_src_ex($contents){
		
		if(empty($contents)){
			alert_goto('잘못된 접근입니다.', '/');
		}
		
		preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $contents , $match);

		for($i=0; $i<count($match[1]); $i++){
			$img_array = explode('/', $match[1][$i]);
			$img_return[$i][0] = $img_array[count($img_array)-1];
			$img_return[$i][1] = str_replace($img_return[$i][0],"",$match[1][$i]);
		}

		if($img_return[0][0] == "man_ic.png"){
			//성별이 남성이나 이미지가 등록되어있지 안을경우
			return IMG_DIR."/meeting/man_icon.jpg";
		}else if($img_return[0][0] == "girl_ic.png"){
			//성별이 여성이나 이미지가 등록되어있지 안을경우
			return IMG_DIR."/meeting/girl_icon.jpg";
		}else{
			//이미지가 정상적으로 등록되어있을경우
			return $img_return[0][1].$img_return[0][0];
		}
		
	}

	//시간함수(오전, 오후, 시, 분)_채팅리스트 모바일용
	function time_stamp_am_pm($val){
		return date("A h:i", strtotime($val));
	}


	function chat_deny_msg($code){
		//비밀채팅 거절 메시지

			$data['1'] = '죄송해요';
			$data['2'] = '죄송합니다.';
			$data['3'] = '죄송죄송';
			$data['4'] = '죄송 ioi';
			$data['5'] = '미안해요';
			$data['6'] = '미안합니다';
			$data['7'] = '미안 ㅠㅠ';
			$data['8'] = '쏘리요';
			$data['9'] = '거절해서 죄송합니다.';
			$data['10'] = '거절해서 죄송요';
			$data['11'] = '다음에 이야기 나눠요';
			$data['12'] = '지금 채팅 못해요';
			$data['13'] = '지금 바빠요';
			$data['14'] = '바쁘네요';
			$data['15'] = '바빠서 지금은 채팅 못해요';
			$data['16'] = '지금 뭐좀 하고 있어서 죄송';
			$data['17'] = '다른분과 채팅중 입니다.';
			$data['18'] = '채팅중입니다.';
			$data['19'] = '제 스타일이 아닙니다.';
			$data['20'] = '맘에 드는 이상형이 아닙니다.';
			$data['21'] = '원하는 지역이 아닙니다.';
			$data['22'] = '원하는 나이대가 아닙니다.';
			$data['23'] = '정중히 거절하겠습니다.';

			if($code == "all"){
			//셀렉트용으로 모든 배열값 반환
					return $data;
			}else if($code){
			//코드값에 해당하는 항목 하나를 리턴
				if(!empty($data[$code])){
					return $data[$code]; 
				}else{
					return "기타";
				}
			}

	}



	function police_cate($int){

		//조이폴리스 > 신고사유 텍스트로 변경
		switch ($int) {
		  case 1  : $str= "욕설";
					   break;
		  case 2  : $str= "음담패설";
					   break;
		  case 3  : $str= "음란사진등록";
					   break;
		  case 4  : $str= "불량게시물";
					   break;
		  case 5  : $str= "개인정보 도용";
					   break;
		  case 6  : $str= "불건전이용";
					   break;
		  case 7  : $str= "현금거래";
					   break;
		  case 8  : $str= "운영자사칭";
					   break;
		  case 9  : $str= "기타";
					   break;
		  case 10  : $str= "불법광고 타사이트 홍보";
					   break;
		  case 21  : $str= "음악채팅";
					   break;
		  default : $str= "기타";
						break;
		}
	
		return $str;
	}



	function police_ing($int){

		//조이폴리스 > 처벌상태 텍스트로 변경
		switch ($int) {
		  case 1  : $str= "접수";
					   break;
		  case 4  : $str= "판결불가";
					   break;
		  case 7  : $str= "완료";
					   break;
		}
	
		return $str;
	}

	function police_card($int){

		//조이폴리스 > 카드선택 텍스트로 변경
		switch ($int) {
		  case 1  : $str= "경고";
					   break;
		  case 2  : $str= "화이트카드(12시간)";
					   break;
		  case 3  : $str= "옐로카드(24시간)";
					   break;
		  case 4  : $str= "레드카드(3일)";
					   break;
		  case 5  : $str= "블랙카드(영구정지)";
					   break;
		}
	
		return $str;
	}

	function music_chat_code($int){

		//음악채팅 카테고리 코드변환
		switch ($int) {
		  case 1  : $str= "음악듣기";
					   break;
		  case 3  : $str= "편한대화";
					   break;
		  case 4  : $str= "친구사귀기";
					   break;
		  case 5  : $str= "이성친구";
					   break;
		  case 6  : $str= "카페채팅";
					   break;
		  default : $str= "음악듣기";
						break;
		}
	
		return $str;

	}

	function get_music_chat_rooms(){
		//음악채팅방 샘플

		$r_data[0]['c_cate'] = '1';
		$r_data[0]['c_title'] = urlencode(iconv('utf-8','euc-kr','<img src="'.IMG_DIR.'/live_title_1.gif" class="ver_top">☆...♪음 악 세 상♬...★'));
		$r_data[0]['c_nowin'] = '2';
		$r_data[0]['c_inwon'] = '5';
		$r_data[1]['c_cate'] = '2';
		$r_data[1]['c_title'] = urlencode(iconv('utf-8','euc-kr','여자라면 망설임없이 입。장。하。시。오!!!! 남자도 망설임없이 입。장。하。시。오'));
		$r_data[1]['c_nowin'] = '2';
		$r_data[1]['c_inwon'] = '10';
		$r_data[2]['c_cate'] = '3';
		$r_data[2]['c_title'] = urlencode(iconv('utf-8','euc-kr','회원모집중!! 부담없이 찾아주세용~~^^'));
		$r_data[2]['c_nowin'] = '3';
		$r_data[2]['c_inwon'] = '9';
		$r_data[3]['c_cate'] = '4';
		$r_data[3]['c_title'] = urlencode(iconv('utf-8','euc-kr','<img src="'.IMG_DIR.'/live_title_2.gif" class="ver_top"> 40~50 친구할사람 모여라~ 여기여기<img src="'.IMG_DIR.'/live_title_3.gif" class="ver_top">'));
		$r_data[3]['c_nowin'] = '5';
		$r_data[3]['c_inwon'] = '10';
		$r_data[4]['c_cate'] = '5';
		$r_data[4]['c_title'] = urlencode(iconv('utf-8','euc-kr','페이스북 친구 만들기 ===33'));
		$r_data[4]['c_nowin'] = '2';
		$r_data[4]['c_inwon'] = '10';

		return $r_data;
	}

	function consult_sel($int){

		//문의분야 코드변환
		switch ($int) {
		  case 1  : $str= "가입/탈퇴 문의";
					   break;
		  case 2  : $str= "포인트 사용 문의";
					   break;
		  case 3  : $str= "사용자 인증 문의";
					   break;
		  case 4  : $str= "사진인증 요청";
					   break;
		  case 5  : $str= "결제 관련(정회원/포인트)";
					   break;
		  case 6  : $str= "사이트 이용방법 문의";
					   break;
		  case 7  : $str= "결제 취소/환불";
					   break;
		  case 8  : $str= "오류 문의";
					   break;
		  case 9  : $str= "개인정보 및 사진 도용";
					   break;
		  case 10  : $str= "060 신고";
					   break;
		  default : $str= "기타";
						break;
		}
	
		return $str;

	}

	function consult_add($int){

		//처리 결과 코드변환
		switch ($int) {
		  case 1  : $str= "필요";
					   break;
		  case 2  : $str= "불필요";
					   break;
		}
	
		return $str;

	}
	function consult_results($int){

		//처리 결과 코드변환
		switch ($int) {
		  case 1  : $str= "보고";
					   break;
		  case 2  : $str= "해결";
					   break;
		  case 3  : $str= "미해결";
					   break;
		}
	
		return $str;

	}

	function consult_add_test($int){

		//성별
		switch ($int) {
		  case 1  : $str= "남";
					   break;
		  case 2  : $str= "여";
					   break;
		}
	
		return $str;

	}
	function consult_results_test($int){

		//장애여부
		switch ($int) {
		  case 1  : $str= "장애";
					   break;
		  case 2  : $str= "비장애";
					   break;
		}
	
		return $str;

	}
	


	//관리자페이지 슈퍼채팅 지역 코드체인지
	function call_super_chat_area($val){

		switch ($val) {
		  case 1  : $str= "서울/경기/인천";
					   break;
		  case 2  : $str= "부산/울산/경남";
					   break;
		  case 3  : $str= "대구/경북";
					   break;
		  case 4  : $str= "광주/전남/전북";
					   break;
		  case 5  : $str= "대전/충남/충북";
					   break;
		  case 6  : $str= "강원";
					   break;
		  case 7  : $str= "제주";
					   break;
		  case 8  : $str= "해외";
					   break;
		}

		return $str;
	}

	//관리자페이지 슈퍼채팅 회원등급 코드체인지
	function call_super_chat_type($val){

		//처리 결과 코드변환
		switch ($val) {
		  case "F"  : $str= "준회원";
					   break;
		  case "V"  : $str= "정회원";
					   break;
		  case "A"  : $str= "준회원 + 정회원";
					   break;
		}
	
		return $str;
	}

	
	function call_time_change($val){
		
		//date tiem 년월일시분초로 return

		$val1 = substr($val, 0, 4);		//년
		$val2 = substr($val, 5, 2);		//월
		$val3 = substr($val, 8, 2);		//일
		$val4 = substr($val, 11, 2);	//시
		$val5 = substr($val, 14, 2);	//분
		$val6 = substr($val, 17, 2);	//초
		
		If(IS_MOBILE == true){
			return $val1."-".$val2."-".$val3."<br>".$val4."시 ".$val5."분";
		}else{
			return $val1."-".$val2."-".$val3." ".$val4."시 ".$val5."분";
		}
		
	}


	//관라자전용
	//인사말 관련 코드변환
	function call_intro_code_change($gubn, $val){

		if($gubn == "code"){
			if($val == "intro"){ $str = "인사말"; }
		}else if($gubn == "sex"){
			if($val == "A"){ $str = "전체"; }
			if($val == "M"){ $str = "남성"; }
			if($val == "F"){ $str = "여성"; }
		}else if($gubn == "use"){
			if($val == "Y"){ $str = "사용"; }
			if($val == "N"){ $str = "사용안함"; }
		}

		return $str;

	}

	//년, 월, 요일 치환
	function call_date_kor_change($val){

		$v_date_kor = array('일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일');
		
		$v_year		= date('Y', strtotime($val))."년";			//년
		$v_month	= date('m', strtotime($val))."월";			//월
		$v_day		= date('d', strtotime($val))."일";			//일
		$v_date		= $v_date_kor[date('w', strtotime($val))];  //요일

		return $v_year." ".$v_month." ".$v_day." ".$v_date;
	}



	//두개의 좌표 사이의 거리 구하기 헬퍼(단위 km)
	function getDistance($xp1, $yp1, $xp2, $yp2){		
		$earth_radius = 6371;
		$dLat = deg2rad($xp2 - $xp1);
		$dLon = deg2rad($yp2 - $yp1);
		$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($xp1)) * cos(deg2rad($xp2)) * sin($dLon/2) * sin($dLon/2);
		$c = 2 * asin(sqrt($a));
		$d = $earth_radius * $c;
		return round($d, 2)."km";
	}

	
	//회원테이블 선택 지역에 따라 위치 좌표 생성하기
	function getGeo($user_id){

		$CI =& get_instance();
		$CI->load->helper('common_helper');
		$CI->load->library('member_lib');
		
		//네이버 API 관련 key value(common_helper)
		$cId		= SITE_NAVER_ID;
		$cSecret	= SITE_NAVER_PW;

		if(empty($user_id)){ return; }									//회원아이디가 없으면 return
		
		$m_data = $CI->member_lib->get_member($user_id);				//회원 데이터 가져오기
		if(empty($m_data)){ return; }									//회원 데이터가 없을경우 return
		
		$m_conregion2 = explode(" ", $m_data['m_conregion2']);
		$addr = $m_data['m_conregion']." ".$m_conregion2[0];			//회원 선택지역

		$result = get_naver_gps_code($addr, $cId, $cSecret);			//지역에 따른 좌표 구하기(common_helper)

		$map_data = json_decode($result, 1);

		$gubn = array('-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-');
		$x_num = mt_rand(0, count($gubn)-1);
		$y_num = mt_rand(0, count($gubn)-1);

		$str_x_rand = $gubn[$x_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);
		$str_y_rand = $gubn[$y_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);

		$x_point = @$map_data['result']['items'][0]['point']['x']+$str_x_rand;		//x좌표
		$y_point = @$map_data['result']['items'][0]['point']['y']+$str_y_rand;		//y좌표

		return array($x_point, $y_point);
		
	}
	
	//지역으로 위치 좌표 생성하기
	function get_map_addr($addr){

		//네이버 API 관련 key value(common_helper)
		$cId		= SITE_NAVER_ID;
		$cSecret	= SITE_NAVER_PW;

		$result = get_naver_gps_code($addr, $cId, $cSecret);			//지역에 따른 좌표 구하기(common_helper)

		$map_data = json_decode($result, 1);
		
		$gubn = array('-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-');
		$x_num = mt_rand(0, count($gubn)-1);
		$y_num = mt_rand(0, count($gubn)-1);

		$str_x_rand = $gubn[$x_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);
		$str_y_rand = $gubn[$y_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);

		$x_point = @$map_data['result']['items'][0]['point']['x']+$str_x_rand;		//x좌표
		$y_point = @$map_data['result']['items'][0]['point']['y']+$str_y_rand;		//y좌표

		return array($x_point, $y_point);

	}
	

	//내위치수정시 네이버지도 지역 데이터 변경 함수
	function get_my_position($area){
		
		if(empty($area)){ return; }

		switch($area){

			case "서울특별시"		: $str = "서울"; break; 
			case "인천광역시"		: $str = "인천"; break; 
			case "부산광역시"		: $str = "부산"; break; 
			case "대구광역시"		: $str = "대구"; break; 
			case "대전광역시"		: $str = "대전"; break; 
			case "광주광역시"		: $str = "광주"; break; 
			case "울산광역시"		: $str = "울산"; break; 
			case "경기도"			: $str = "경기"; break; 
			case "강원도"			: $str = "강원"; break; 
			case "충청남도"		: $str = "충남"; break; 
			case "충청북도"		: $str = "충북"; break; 
			case "경상남도"		: $str = "경남"; break; 
			case "경상북도"		: $str = "경북"; break; 
			case "전라남도"		: $str = "전남"; break; 
			case "전라북도"		: $str = "전북"; break; 
			case "제주특별자치도"	: $str = "제주"; break; 
			case "세종특별자치시"	: $str = "세종"; break; 
			
		}
		
		return $str;

	}
	

	//본인인증시 코드변환 함수들(페이레터 본인인증 서비스)
	//통신사 코드 변환
	function get_mobile_code($code){

		if(empty($code)){ return "기타"; }

		switch($code){
			case "01" : $str = "SKT"; break;
			case "02" : $str = "KT"; break;
			case "03" : $str = "LGT"; break;
			case "04" : $str = "알뜰폰"; break;
		}

		return $str;

	}
	
	//성별 코드 변환
	function get_sex_code($code){

		if(empty($code)){ return "M"; }

		switch($code){
			case "0" : $str = "F"; break;
			case "1" : $str = "M"; break;
		}

		return $str;

	}

	//아이디 *로 부분만 숨기기
	function get_hide_userid($user_id){

		if(empty($user_id)){ return; }

		$id_len = strlen($user_id);
		
		$hide_id = "";
		for($i=2; $i<$id_len; $i++){
			$hide_id .= "*";
		}

		return substr($user_id, 0, 2).$hide_id;
	}

	//회원 성별별 채팅문구 가져오기
	function user_chat_words(){

		$CI =& get_instance();

		$sex = @$CI->session->userdata['m_sex'];
		
		//성별에 맞게 채팅 문구 가져오기(랜덤)
		$sql = "";
		$sql .= " SELECT chat_words ";
		$sql .= " FROM chat_words_list ";
		$sql .= " WHERE 1=1 ";

		if(empty($sex)){
			$sql .= " AND sex = 'A' ";
		}else{
			$sql .= " AND (sex = 'A' OR sex = '".$sex."') ";
		}

		$sql .= " ORDER BY RAND() ";
		$sql .= " LIMIT 1 ";

		$query = $CI->db->query($sql);
		
		$chat_msg = "";
		if($query->num_rows() > 0){
			$chat_msg = $query->row()->chat_words;
		}
		
		if(empty($chat_msg)){
			if(IS_MOBILE == true){
				$chat_msg = "메세지를 입력해주세요.";
			}else{
				$chat_msg = "입력해주세요.";
			}
		}

		return $chat_msg;
	}


	//봄바람 이벤트 코드변경
	function trip_event_code($code = 1){
		
		//1. 마음까지 수놓는 서울축제
		//2. 천년의맛 영덕축제
		//3. 동백꽃과 바다가함께 서천축제
		//4. 천해의 자연환경의 부산축제
		//5. 맑은물과 공기의 논산축제
		//6. 영원한 사랑을찾아 구례축제
		//7. 섬을 둘러싼 풍경 제주축제
		//8. 상상이 피어나는 용인축제

		switch($code){
			case 1 : $str = "마음까지 수놓는 서울축제";		break;
			case 2 : $str = "천년의맛 영덕축제";			break;
			case 3 : $str = "동백꽃과 바다가함께 서천축제";	break;
			case 4 : $str = "천해의 자연환경의 부산축제";	break;
			case 5 : $str = "맑은물과 공기의 논산축제";		break;
			case 6 : $str = "영원한 사랑을찾아 구례축제";	break;
			case 7 : $str = "섬을 둘러싼 풍경 제주축제";	break;
			case 8 : $str = "상상이 피어나는 용인축제";		break;
		}

		return $str;

	}


	//여름여행 이벤트 코드변경
	function vacance_event_code($code = 1){
		
		//1. 힐링의끝! 전라남도 담양 죽녹원
		//2. 신비함이 있는 밀양 얼음골 계곡
		//3. 1박2일, 당일치기도 좋은 충청남도 삽시도
		//4. 서해안에 위치한 군산 선유도 해수욕장
		//5. 자연을 만나는 양양 미천골 자연휴양림

		switch($code){
			case 1 : $str = "힐링의끝! 전라남도 담양 죽녹원";			break;
			case 2 : $str = "신비함이 있는 밀양 얼음골 계곡";			break;
			case 3 : $str = "1박2일, 당일치기도 좋은 충청남도 삽시도";	break;
			case 4 : $str = "서해안에 위치한 군산 선유도 해수욕장";		break;
			case 5 : $str = "자연을 만나는 양양 미천골 자연휴양림";		break;
		}

		return $str;

	}

?>
