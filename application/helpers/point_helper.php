<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	//회원 TOTAL 포인트 계산
	function total_point_sum($m_userid){
		
		$CI =& get_instance();
		//null 처리 때문에 쿼리변경
		//결제한 포인트 계산
		$sql1 = "";
		$sql1 .= " select ifnull(sum(m_point), 0) pt from member_point_list where 1=1 and m_userid = '".$m_userid."' and m_tradeid is not null ";
		$query1 = $CI->db->query($sql1);
		
		//차감포인트 계산
		$sql2 = "";
		$sql2 .= " select ifnull(sum(m_point), 0) pt from member_point_list where 1=1 and m_userid = '".$m_userid."' and m_tradeid is null ";
		$query2 = $CI->db->query($sql2);

		return $query1->row()->pt + $query2->row()->pt;
	}

	//결제완료 또는 포인트 사용시에 처리
	//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
	function member_point_insert($m_userid, $m_product_code, $m_goods, $m_point, $m_price = null, $m_tradeid = null, $m_writedate = NOW, $m_etc = null){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->helper('level_helper');

		//포인트 충전 및 사용내역 변수 array
		$mpt_arrData = array(
			"m_userid"				=> $m_userid,
			"m_product_code"		=> $m_product_code,
			"m_goods"				=> $m_goods,
			"m_point"				=> $m_point,
			"m_price"				=> $m_price,
			"m_tradeid"				=> $m_tradeid,
			"m_writedate"			=> $m_writedate,
			"m_etc"					=> $m_etc 
		);

		//결제완료 또는 포인트 사용시 회원 포인트 테이블에 insert
		$member_point_rtn = $CI->my_m->insert('member_point_list', $mpt_arrData);

		//결제완료 또는 포인트 사용시 total 포인트 업데이트 하기위한 member_total_point 조회
		$t_member = $CI->my_m->cnt('member_total_point', array('m_userid' => $m_userid));
								
		if($t_member == "0"){
			//첫결제 일경우 insert
			$p_rtn = $CI->my_m->insert('member_total_point', array('m_userid' => $m_userid, 'total_point' => total_point_sum($m_userid) ));
		
		}else{
			//결제를 한번이라도 한 흔적이 있을 경우 update
			$p_rtn = $CI->my_m->update('member_total_point', array('m_userid' => $m_userid), array('total_point' => total_point_sum($m_userid)));
		}

		if($p_rtn == "1"){
			
			// 등급 업
			$level_up = level_up($m_userid);

			return "1";		//성공
		}else{
			return "0";		//에러
		}
	}


	//일반회원이 첫결제 할경우 정회원전환 헬퍼
	function member_level_up($m_userid, $tid){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');	
		
		if(empty($m_userid) || $m_userid == ""){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}
		
		//회원 데이터 가져오기
		$member_data = $CI->member_lib->get_member($m_userid);
		
		if($member_data['m_type'] == "F"){
			//일반회원의 경우(상품코드 1001, 2001, 2002, 2003 구매시 정회원으로 등업)

			$arrData = array(
				"m_userid"			=> $m_userid,
				"ex_m_product_code"	=> 'm_product_code in(1001, 2000, 2001, 2002, 2003)',
				"m_card_ok"			=> 'Y',
				"m_tradeid"			=> $tid
			);

			$payment_data = $CI->my_m->row_array('payment_temp', $arrData);

			if(!@empty($payment_data)){
				//상품코드 1001 또는 2000 구매 내역이 있을경우 
				//정회원으로 등업
				$rtn = $CI->my_m->update('TotalMembers', array('m_userid' => $m_userid), array('m_type' => 'V'));

				if($rtn == "1"){
					@$CI->session->set_userdata(array(
						'm_type' => 'V'
					));
					return "1";		//등업성공
				}else{
					return "0";		//등업실패
				}

			}else{
				//상품코드 1001 구매 내역이 없을경우(에러) [일반회원은 정회원상품만 구매가능]
				$rtn = $CI->my_m->update('TotalMembers', array('m_userid' => $m_userid), array('m_type' => 'F'));

				return "9";		//에러(정회원 상품 구매내역 없음)
			}

		}else{
			//정회원의 경우
			return "5";		//이미 정회원
		}


		//return 값
		// "0"	: 등업실패
		// "1"	: 등업성공(정회원)
		// "5"	: 이미 정회원
		// "9"	: 에러
	}


	//회원의 보유포인트를 조회하여 차감포인트 이상 남아있는지 확인하기(변수 : 회원아이디, 차감포인트)
	function member_point_chk($m_userid, $point){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');
		
		$tp = $CI->my_m->row_array('member_total_point', array('m_userid' => $m_userid));		//회원의 총포인트 조회
		$point = str_replace('-', '', $point);			//차감포인트 -부호 없애기
		
		if(!@empty($tp)){
			//포인트를 한번이라도 결제한경우
			if($tp['total_point'] >= $point){
				//회원의 총 포인트가 차감포인트보다 크거나 같을경우
				return "success";
			}else{
				//회원의 총 포인트가 차감포인트보다 작을경우
				return "error";
			}
		}else{
			return "error";
		}	

	}

	//회원이 한번이라도 결제를 했는지 체크
	function member_payment_chk($m_userid){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		$m_data = $CI->member_lib->get_member($m_userid);

		if($m_data['m_sex'] == "M"){
			$rtn = $CI->my_m->row_array('member_total_point', array('m_userid' => $m_userid));
			if(empty($rtn)){
				return "no_pay";
			}else{
				return "";
			}
		}else{
			return "";
		}		

	}



	//admin페이지 전용 헬퍼(상품코드 1001 거래 취소시 정회원에서 일반회원으로 level down)
	function admin_member_level_down($m_userid, $tid){

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');
			
		if(empty($m_userid) || $m_userid == ""){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}

		//회원 데이터 가져오기
		$member_data = $CI->member_lib->get_member($m_userid);

		if($member_data['m_type'] == "V"){

			$arrData = array(
				"m_userid"			=> $m_userid,
				"m_tradeid"			=> $tid,
				"ex_m_product_code"	=> "(m_product_code = '1001' or m_product_code = '2001' or m_product_code = '2002' or m_product_code = '2003')",
				"m_cancel"			=> '취소',
				"m_card_ok"			=> 'N'
			);

			$pay_data = $CI->my_m->row_array('payment_temp', $arrData);

			if(!@empty($pay_data)){

				//취소완료된경우
				$rtn = $CI->my_m->update('TotalMembers', array('m_userid' => $m_userid), array('m_type' => 'F'));

				if($rtn == "1"){
					return "1";		//일반회원 전환 성공
				}else{
					return "0";		//일반회원 전환 실패
				}
			}else{
				//에러
				return "9";		//에러
			}

		}

	}


	//admin페이지 정회원 상품 결제취소시 일반회원전화 및 포인트 초기화
	function call_member_refund($user_id, $tid){
		
		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');

		if(empty($user_id) || $user_id == ""){
			alert_goto('잘못된 접근입니다.', '/');
			exit;
		}
		
		//회원정보가져오기
		$member_data = $CI->member_lib->get_member($user_id);

		//회원 총 보유 포인트 가져오기
		$mtp = $CI->my_m->row_array('member_total_point', array('m_userid' => $user_id));

		if($member_data['m_type'] == "V"){
			//회원이 정회원일경우

			//결제내역 취소처리
			$CI->my_m->update('payment_temp', array('m_userid' => $user_id, 'm_tradeid' => $tid), array('m_card_ok' => 'N', 'm_cancel' => '취소'));

			//정회원 -> 준회원 전환
			$CI->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_type' => 'F'));

			//기존 포인트 0원 초기화처리
			member_point_insert($user_id, '8888', '결제취소에 의한 차감', '-'.$mtp['total_point'], null, null, NOW, '결제취소('.$tid.')');

			return "1";

		}else{
			//회원이 준회원일경우

			return "0";
		}

	}
	

	

?>