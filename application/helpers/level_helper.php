<?php 

	
	// 총 포인트 계산해서 level 넣기
	function level_up($user){

		$CI =& get_instance();
		$CI->load->model('my_m');

		// 결제횟수 카운트(취소제외)
		$cnt = $CI->my_m->cnt('payment_temp', array("m_userid" => $user, "ex_okdate" => "m_okdate IS NOT NULL", "ex_cancel" => "m_cancel IS NULL", "m_card_ok" => "Y"));
		
		if($cnt == 0){ return; }

		// 결제내역 가져오기(취소제외)
		$find_point = $CI->my_m->result_array('payment_temp', array("m_userid" => $user, "ex_okdate" => "m_okdate IS NOT NULL", "ex_cancel" => "m_cancel IS NULL", "m_card_ok" => "Y"));


		// 결제금액 초기화
		$total_price = 0;

		for($i=0; $i<$cnt; $i++){
			// 합계구하기
			$total_price = $total_price+$find_point[$i]['m_price'];
		}

		// 정회원 -> 0~3만원미만
		if($total_price < 30000){
			$my_level = "1";
		
		// 실버회원 -> 3만원 이상 ~ 5만원미만
		}else if ($total_price >= 30000 && $total_price < 50000){
			$my_level = "2";

		// 골드회원 -> 5만원 이상 ~ 10만원미만
		}else if($total_price >= 50000 && $total_price < 100000){
			$my_level = "3";
		
		// VIP회원 -> 10만원 이상 ~ 20만원미만
		}else if($total_price >= 100000 && $total_price < 200000){
			$my_level = "4";
		
		// VVIP회원 -> 20만원 이상
		}else if($total_price >= 200000){
			$my_level = "5";
		}

		//회원정보가져오기
		$level_ary = $CI->my_m->row_array('TotalMembers', array("m_userid" => $user));

		// 레벨변화시 레벨업
		if($level_ary['m_level'] != $my_level){

			// 회원+로그인테이블 같이 업데이트
			$total_mb = $CI->my_m->update('TotalMembers', array("m_userid" => $user), array("m_level" => $my_level));
			$login_mb = $CI->my_m->update('TotalMembers_login', array("m_userid" => $user), array("m_level" => $my_level));
		}

	}


	// 회원아이디,
	// 정회원도 등급 보이게 : '9'(ex.프로필) => def는 안보이게,
	// onclick여부 : '함수'  => def는 없음
	function mb_level_profile($user, $mode='',$on_ck=''){

		$CI =& get_instance();
		$CI->load->model('my_m');

		if(empty($user)){return;}

		$level_data = $CI->my_m->row_array('TotalMembers', array('m_userid' => $user));

		if(empty($level_data)){return;}

		$level_img = "";

		// 남자이고 결제회원이 아니면 나가기 (등급아이콘X)
		if($level_data['m_sex'] == 'M' && ($level_data['m_level'] == '' || $level_data['m_level'] == '0' || $level_data['m_level'] == null)){		return;	}

		// 여자이고 정회원이 아니면 나가기 (등급아이콘X)
		if($level_data['m_sex'] == 'F' && ($level_data['m_type'] != 'V')){	return;	}

		// 정회원 -> 0~6만원미만 AND 정회원안보이게 $mode =''
		if($level_data['m_level'] == '1' && $mode == ''){	return; }

		
		
		// 모바일은 gif
		if (IS_MOBILE == true){

			// 여자이고 결제는 안했지만 휴대폰 인증한 정회원이면 m_level은 1로 설정
			if($level_data['m_sex'] == 'F' && $level_data['m_type'] == 'V' && ($level_data['m_level'] == '' || $level_data['m_level'] == '0' || $level_data['m_level'] == null)){
				$level_data['m_level'] = '1';
			}

			// 여성 정회원 -> 0~6만원미만 AND 정회원도 보이게
			if( ($level_data['m_level'] == '1' && $mode == '9' && $level_data['m_sex'] == "F") or ($level_data['m_level'] == '1' && $level_data['m_sex'] == "M") ){
				$level_img = "<img src='".IMG_DIR."/m/add_menu_new.gif'>";

			// 실버회원 -> 6만원 이상 ~ 15만원미만
			}else if ($level_data['m_level'] == '2'){
				$level_img = "<img src='".IMG_DIR."/m/add_menu_silver.gif'>";

			// 골드회원 -> 30만원 이상 ~ 30만원미만
			}else if($level_data['m_level'] == '3'){
				$level_img = "<img src='".IMG_DIR."/m/add_menu_gold.gif'>";

			// VIP회원 -> 30만원 이상 ~ 100만원미만
			}else if($level_data['m_level'] == '4'){
				$level_img = "<img src='".IMG_DIR."/m/add_menu_vip.gif'>";
			
			// VVIP회원 -> 100만원 이상
			}else if($level_data['m_level'] == '5'){
				$level_img = "<img src='".IMG_DIR."/m/add_menu_vvip.gif'>";
			}

			return $level_img;

		// PC는 png + onclick이벤트
		}else {

			// 여자이고 결제는 안했지만 휴대폰 인증한 정회원이면 m_level은 1로 설정
			if($level_data['m_sex'] == 'F' && $level_data['m_type'] == 'V' && ($level_data['m_level'] == '' || $level_data['m_level'] == '0' || $level_data['m_level'] == null)){
				$level_data['m_level'] = '1';			
			}

			// 정회원 -> 0~6만원미만 AND 정회원도 보이게
			if( ($level_data['m_level'] == '1' && $mode == '9' && $level_data['m_sex'] == "F") or ($level_data['m_level'] == '1' && $level_data['m_sex'] == "M") ){
				$level_img = "<img src='".IMG_DIR."/profile/main_top_new.png'";

			// 실버회원 -> 6만원 이상 ~ 15만원미만
			}else if ($level_data['m_level'] == '2'){
				$level_img = "<img src='".IMG_DIR."/profile/main_top_silver.png'";

			// 골드회원 -> 30만원 이상 ~ 30만원미만
			}else if($level_data['m_level'] == '3'){
				$level_img = "<img src='".IMG_DIR."/profile/main_top_gold.png'";

			// VIP회원 -> 30만원 이상 ~ 100만원미만
			}else if($level_data['m_level'] == '4'){
				$level_img = "<img src='".IMG_DIR."/profile/main_top_vip.png'";
			
			// VVIP회원 -> 100만원 이상
			}else if($level_data['m_level'] == '5'){
				$level_img = "<img src='".IMG_DIR."/profile/main_top_vvip.png'";
			// 아니면 나가기
			}else{ return; }

			// onclick 이벤트 있을시
			if($on_ck != ''){
				$level_img .= " onclick='".$on_ck."'>";
			}else{
				$level_img .= ">";
			}
			return $level_img;
		}

	}


	function user_level($user){

		switch ($user) {
			// 정회원
			case 1: $str= "NEW"; break;

			//실버회원
			case 2: $str= "SILVER"; break;

			//골드회원
			case 3: $str= "GOLD"; break;

			//VIP회원
			case 4: $str= "VIP"; break;

			//VVIP회원
			case 5: $str= "VVIP"; break;

			default:
				$str= "준회원";
		}
		return $str;

	}



?>