<?php

class Event_stamp extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('alrim_helper');
		$this->load->helper('point_helper');
	}

	function index(){
		$this->stamp_event();
	}

	function stamp_event(){	// 이벤트 뷰페이지
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}

	
		//(일, 월, 화, 수, 목, 금, 토) 기준
		$to_month = date('Y-m')."-01";					//매월 1일 셋팅
		$day_cnt = date('w', strtotime($to_month));		//매월 1일이 무슨요일에 시작하는지 찾기 

		$rtn_chk = $this->reg_attend_chk(date('Y'), date('m'));		//이번달 출석체크가 등록되어있는지 체크(return 값이 1이면 이미 등록 2이면 새로등록)

		$attend_data = $this->my_m->row_array('attend_reg_list', array('m_year' => date('Y'), 'm_month' => date('m')));
		
		$l_day = explode('-', $attend_data['m_lottery_day']);
		
		$data = array(
			"m_start_day"		=> str_replace('-', '.', $attend_data['m_start_day']),		//이벤트 시작일
			"m_end_day"			=> str_replace('-', '.', $attend_data['m_end_day']),		//이벤트 종료일
			"m_lottery_day"		=> $l_day[0].'년 '.$l_day[1].'월 '.$l_day[2].'일'			//이벤트 당청자 발표일
		);
		
		if(IS_LOGIN){
			//로그인한경우만 데이터 가져오기
			//이번달 출석일 데이터 가져오기
			$attend_member_data = $this->my_m->row_array('attend_member_list', array('m_year' => date('Y'), 'm_month' => date('m'), 'm_userid' => $this->session->userdata['m_userid']));
		}			

		$day_num = "";		//이번달 회원의 출석일수 넣을 변수
		
		//이번달 출석일 데이터가 있을경우
		if(!empty($attend_member_data)){
				
			for($i=1; $i<=31; $i++){
				if($attend_member_data['m_day'.$i] == "1"){
					if($day_num == ""){
						$day_num = $i;
					}else{
						$day_num = $day_num."|".$i;
					}
				}
			}
		}
		
		
		//이벤트 분홍날짜 처리 변수재지정
		$m_rand_num = $attend_data['m_rand_num'];
		
		if(IS_MOBILE == true){
			//모바일버전의 경우

			$this->load->library('m_top_menu_lib');
			
			//view 설정

			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"매일매일 출석도장 찍기"); //탑메뉴 로딩
			
			$bot_data['add_script'] = "
			<script type='text/javascript'>
				
				$(document).ready(function(){
					class_adjust('$m_rand_num');
					attend_img_set('$day_num', '$day_cnt');
				});

			</script>
			";

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_stamp_v', $data);
			$this->load->view('m/m_bottom_v', $bot_data);

		}else{
			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/stamp_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			
			$bot_data['add_script'] = "
			<script type='text/javascript'>

				$(document).ready(function(){				
					class_adjust('$m_rand_num');
					attend_img_set('$day_num', '$day_cnt');
				});

			</script>
			";

			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/stamp_read_v',$data);
			$this->load->view('bottom_v', $bot_data);

		}

		
	}
	

	//출석체크 등록체크 
	function reg_attend_chk($year, $month){
		
		//출석체크 등록이 되어있는지 확인
		$arrData = $this->my_m->row_array('attend_reg_list', array('m_year' => $year, 'm_month' => $month));

		if(!empty($arrData)){
			return "1";
		}else{
			
			$m_random = "";							//랜덤숫자 초기화
			$rand_num = $this->rand_number();		//랜덤숫자 12개 가져오기
			
			//랜덤숫자 데이터화 시키기
			for($i=0; $i<=11; $i++){			
				if($m_random == ""){
					$m_random = $rand_num[$i];					
				}else{
					$m_random = $m_random.'|'.$rand_num[$i];
				}
			}

			$data = array(
				"m_year"			=> $year,
				"m_month"			=> $month,
				"m_start_day"		=> $year.'-'.$month.'-01',
				"m_end_day"			=> $year.'-'.$month.'-'.$this->getTotalDays($year, $month),
				"m_lottery_day"		=> date('Y-m', strtotime('+1 month'))."-10",
				"m_rand_num"		=> $m_random,
				"m_win_member"		=> ''
			);

			$attend_insert = $this->my_m->insert('attend_reg_list', $data);

			return "2";

		}
		
	}

	//회원 출석체크
	function stamp_chk(){
		
		user_check();

		$year	= rawurldecode($this->input->post('year', true)); 
		$month	= rawurldecode($this->input->post('month', true)); 
		$day	= rawurldecode($this->input->post('day', true)); 

		if(substr($day, 0, 1) == "0"){
			$day = substr($day, 1, 1);
		}

		$v_table = "attend_member_list";																							//테이블
		$terms = array('m_year' => date('Y'), 'm_month' => date('m'), 'm_userid' => $this->session->userdata['m_userid']);			//조건
				
		$member_chk = $this->my_m->row_array($v_table, $terms);
		
		//출석체크 상품 가져오기
		$pd = $this->my_m->row_array('product_list', array('m_goods' => '출석체크', 'm_use_yn' => 'Y'));

		if(!empty($member_chk)){
			//이번달 출석체크를 한번이라도 한 회원 (update)
			//회원 출석체크 업데이트 데이터
			$arrData = array(
				"m_day".$day		=> '1'
			);
			
			//오늘 출석체크를 했는지 확인하기 위해 데이터 불러오기
			$member_chk_day = $this->my_m->row_array($v_table, array('m_year' => date('Y'), 'm_month' => date('m'), 'm_userid' => $this->session->userdata['m_userid'], 'm_day'.$day => '1'));
		
			if(!empty($member_chk_day)){
				//이번달 오늘 출석체크를 한 회원
				echo "0";		//오늘은 이미 출석체크를 하셨습니다.
			}else{
				//이번달 오늘 출석체크를 하지 않은 회원 업데이트
				$rtn = $this->my_m->update($v_table, $terms, $arrData);
		
				if($rtn == "1"){

					//alrim_helper(공통)
					joyhunting_alrim("출석체크", $this->session->userdata['m_userid'], null);		//출석체크 인기점수 5점 알림

					//(출석체크)등록시 인기점수 +5 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
					member_popularity('1', $this->session->userdata['m_userid'], '5');
					
					if(!empty($pd)){
						//출석체크시 조이헌팅 5포인트 지급
						//member_point_insert($this->session->userdata['m_userid'], $pd['m_product_code'], $pd['m_goods'], $pd['m_point'], null, $pd['m_product_code'], NOW, '출석체크 포인트 지급');
					}

					echo "1";		//출석하셨습니다.
				}else{
					echo "9";		//출석체크실패
				}
				
			}

		}else{
			//이번달 출석체크를 한번도 하지 않은 회원 (insert)
			//회원 출석체크 업데이트 데이터
			$arrData = array(
				"m_year"			=> $year,
				"m_month"			=> $month,
				"m_userid"			=> $this->session->userdata['m_userid'],
				"m_day".$day		=> '1'
			);
			$rtn = $this->my_m->insert($v_table, $arrData);

			if($rtn == "1"){

				//alrim_helper(공통)
				joyhunting_alrim("출석체크", $this->session->userdata['m_userid'], null);		//출석체크 인기점수 5점 알림

				//(출석체크)등록시 인기점수 +5 업데이트추가(search_helper) member_popularity(mode, userid) mode-> 1: 인기점수 +, 2: 인기점수 -
				member_popularity('1', $this->session->userdata['m_userid'], '5');

				if(!empty($pd)){
					//출석체크시 조이헌팅 5포인트 지급
					//member_point_insert($this->session->userdata['m_userid'], $pd['m_product_code'], $pd['m_goods'], $pd['m_point'], null, null, NOW, '출석체크 포인트 지급');
				}

				echo "1";		//출석하셨습니다.
			}else{
				echo "9";		//출석체크실패
			}
		}
		
	}


	//해당월의 일수구하는함수
    function getTotalDays($year,$month)
    {
        $day=1;
        while(checkdate($month,$day,$year))
        {
            $day++;
        }
            $day=$day-1;
            return $day;
    }

	//랜덤 숫자 12개 뽑기
	function rand_number(){

		$rand_number = array();

		$i = 0;

		$end = $this->getTotalDays(date('Y'), date('m'));		//매월 마지막날

		while($i <= 11){

			$str_rand = mt_rand(1, $end);		//랜덤 숫자

			if($i == "0"){
				$rand_number[$i] = $str_rand;
				$i++;
			}else{
				if(in_array($str_rand, $rand_number)){
					//배열안에 랜덤값이 있을경우
				}else{
					//배열안에 랜덤값이 없을경우
					$rand_number[$i] = $str_rand;
					$i++;
				}					
			}

		}

		return $rand_number;

	}


	//자동 당첨자 공지 등록(보류 : 상품 미정)
	

}

/* End of file main.php */
/* Location: ./application/controllers/*/

