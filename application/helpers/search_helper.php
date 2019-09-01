<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//성별 검색 셋팅
	function search_sex(&$data,&$search,$table,$var_name){

		$CI =& get_instance();

		$data['sex_class1'] = "off";$data['sex_class2'] = "off";$data['sex_class3'] = "off"; //css class명 조정용
		//성별 검색이 있는가?
		if(in_array('sex', $CI->seg_exp) )
		{
			$data['sex'] = $search[$table.".".$var_name] = rawurldecode($CI->security->xss_clean(@url_explode($CI->seg_exp, 'sex')));

			if(trim($data['sex']) == ""){$data['sex_class1'] = "on";}
			else if($data['sex'] == "F"){$data['sex_class2'] = "on";}
			else if($data['sex'] == "M"){$data['sex_class3'] = "on";}
		}else{
			if ($CI->session->userdata('m_sex') == "F"){
				$data['sex_class3'] = "on";
				$search[$table.".".$var_name] = "M";
			}else if ($CI->session->userdata('m_sex') == "M"){
				$data['sex_class2'] = "on";
				$search[$table.".".$var_name] = "F";
			}else{
				$data['sex_class1'] = "on";
				$search[$table.".".$var_name] = "";
			}
		}

	}

	//공개구혼 러브궁합도
	//상대방지역1,상대방지역2,상대방 나이, 상대방 성별
	function love_per($m_conregion,$m_conregion2,$m_age,$m_sex){

		$CI =& get_instance();

		//러브궁합도
		$match_per = "60";
		
		if($m_conregion2 <> ""){
			if($CI->session->userdata['m_conregion'] == $m_conregion){ $match_per = $match_per + "10"; }
			if($CI->session->userdata['m_conregion2'] == $m_conregion2){ $match_per = $match_per + "10"; }
		}else{
			if($CI->session->userdata['m_conregion'] == $m_conregion){ $match_per = $match_per + "20"; }
		}
		

		$p = abs($CI->session->userdata['m_age'] - $m_age);
		if($p > 20){$p = 20;} //최대 20;
		$p_r = 20 - $p;
		$match_per =  $match_per +  $p_r;

		//성별이 같을경우
		if($CI->session->userdata['m_sex'] == $m_sex){
			$match_per = "0";
		}

		return $match_per;
	}

	//친구만들기
	//친구등록시 그룹리스트 만들어 리턴하기
	function call_friend_group($user_id){
		$CI =& get_instance();
		$CI->load->model('my_m');

		$g_list = $CI->my_m->result_array('T_MakeFriend_Group', array('m_userid' => $user_id), "m_gnum", "asc");
		
		$rtn_arr = array();

		if(count($g_list) == 0){
			$rtn_arr = array("기본그룹");
		}else{
			foreach ($g_list as $k => $v)	{
				array_push($rtn_arr, $v['m_gname']);
			}
		}

		return $rtn_arr;

	}


	//(찜, 앤, 친구)등록시 인기점수 업데이트 추가 헬퍼
	function member_popularity($mode, $userid, $score){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');
		
		$member_data = $CI->member_lib->get_member($userid);

		if($mode == "1"){ $popularity = $member_data['m_popularity'] + $score; }		//mode가 1 일때 인기점수 +
		if($mode == "2"){ $popularity = $member_data['m_popularity'] - $score; }		//mode가 2 일때 인기점수 -

		$rtn = $CI->my_m->update('TotalMembers', array('m_userid' => $member_data['m_userid']), array('m_popularity' => $popularity));		//인기점수 update

	}


	//포인트 사용내역 조회기간 기본셋팅 헬버(1개월)
	//월, 일 앞자리 0이 없을경우 => a_현재날짜기준, b_현재날짜보다 1개월 전날짜
	function point_date_search(){
		
		$a_year		= date('Y');		//현재년도
		$a_month	= date('m');		//현재월
		$a_day		= date('d');		//현재일
		
		if(substr($a_month, 0, 1) == "0"){
			$a_month = substr($a_month, 1, 1);
		}

		if(substr($a_day, 0, 1) == "0"){
			$a_day = substr($a_day, 1, 1);
		}
			
		//1월일 경우 예외처리
		if($a_month == "1"){
			$b_year = $a_year -1;
			$b_month = "12";
			$b_day = $a_day;
		}else{
			$b_year = $a_year;
			$b_month = $a_month -1;
			$b_day = $a_day;
		}

		return array('a_year' => $a_year, 'a_month' => $a_month, 'a_day' => $a_day, 'b_year' => $b_year, 'b_month' => $b_month, 'b_day' => $b_day);
	}

	//조회용 년월일 합치기 (예: 20160407)
	function date_value($v_year, $v_month, $v_day){

		if(strlen($v_month) == "1"){
			$v_month = "0".$v_month;
		}

		if(strlen($v_day) == "1"){
			$v_day = "0".$v_day;
		}

		$to_date = $v_year.$v_month.$v_day;

		return $to_date;
	}

	//날짜 쪼개기
	function date_split($date){

		$v_year  = substr($date, 0, 4);
		$v_month = substr($date, 4, 2);
		$v_day   = substr($date, 6, 2);

		if(substr($v_month, 0, 1) == "0"){
			$v_month = substr($v_month, 1, 1);
		}
		if(substr($v_day, 0, 1) == "0"){
			$v_day = substr($v_day, 1, 1);
		}

		return array('year' => $v_year, 'month' => $v_month, 'day' => $v_day);
	}

	//반대성별 반환
	function reverse_sex($sex){
		if($sex == "M"){
			return "F";
		}else{
			return "M";
		}
	}

?>