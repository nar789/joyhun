<?php
class Payment extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/payment_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');

		admin_check();

	}
	
	//관리자 처음화면
	function index()  
	{
		$this->payment_list();
	}
	
	//결제리스트
	function payment_list(){

		//검색조건 받기 get
		$data['s_payment_gb']		= $search['s_payment_gb']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_payment_gb')));
		$data['s_result']			= $search['s_result']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_result')));
		$data['s_writedate_1']		= $search['s_writedate_1']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_writedate_1')));
		$data['s_writedate_2']		= $search['s_writedate_2']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_writedate_2')));
		$data['s_okdate_1']			= $search['s_okdate_1']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_okdate_1')));
		$data['s_okdate_2']			= $search['s_okdate_2']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_okdate_2')));
		$data['s_name']				= $search['s_name']				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_name')));
		$data['s_hptele']			= $search['s_hptele']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_hptele')));
		$data['s_userid']			= $search['s_userid']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_userid')));
		$data['s_tid']				= $search['s_tid']				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_tid')));
		$data['s_member_gubn']		= $search['s_member_gubn']		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_member_gubn')));
		$data['s_m_partner']			= $search['s_m_partner']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_partner')));
		$data['s_m_partner_code']			= $search['s_m_partner_code']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_partner_code')));
		
		//회원 조회에서 넘어왔을 경우
		@$userid = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'user')));
		if (@$userid){ $data['s_userid']	= $search['s_userid'] = $userid; }

		$s_today = date('Y-m-d');								//오늘날짜
		$s_before_day = date('Y-m-d', strtotime('-7 day'));		//7일전
		
		if($data['s_writedate_1'] == ""){ $data['s_writedate_1'] = $search['s_writedate_1'] = $s_before_day; }	//시도날짜 from 기본셋팅(오늘날짜 -7일)
		if($data['s_writedate_2'] == ""){ $data['s_writedate_2'] = $search['s_writedate_2'] = $s_today; }		//시도날짜 to 기본셋팅(오늘날짜)

				
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->payment_m->payment_list($start, $rp, @$search);

		$data['mlist'] = $result[0];
		$data['getTotalData']=$total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/payment_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	//결제 취소처리
	function payment_cancel(){

		$tid = rawurldecode($this->input->post('tid',TRUE));		//거래번호

		$cancel_update = $this->my_m->update('payment_temp', array('m_tradeid' => $tid), array('m_cancel' => '취소', 'm_card_ok' => 'N'));	//거래내역 취소처리

		if($cancel_update == "1"){

			$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $tid));		//거래내역 가져오기
			
			//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
			$rtn = member_point_insert($arrData['m_userid'], '8888', '결제취소에 의한 차감', "-".$arrData['m_point'], null, null, NOW, '결제취소('.$arrData['m_tradeid'].')');

			if($rtn == "1"){				
				$rtn2 = admin_member_level_down($arrData['m_userid'], $tid);

				//관리자가 취소시 관리자 이름 insert
				$this->my_m->update('payment_temp', array('m_tradeid' => $arrData['m_tradeid']), array('m_cancel_name' => $this->session->userdata['username']));

				echo "success";	//취소및 포인트 업데이트까지 성공
			}else{
				echo "error";	//포인트차감처리 업데이트 실패
			}

		}else{
			echo "error";		//취소처리가 실패할경우
		}

		
	}

	//무통장입금 승인처리
	function payment_success(){

		$tid = rawurldecode($this->input->post('tid', TRUE));		//거래번호

		$success_update = $this->my_m->update('payment_temp', array('m_tradeid' => $tid), array('m_okdate' => NOW, 'm_card_ok' => 'Y', 'm_result_code' => '0000'));	//거래내역 승인처리
		
		if($success_update == "1"){
			$pay_data = $this->my_m->row_array('payment_temp', array('m_tradeid' => $tid, 'm_card_ok' => 'Y'));
			
			//상품코드 1001 결제시 정회원 전환처리 
			if($pay_data['m_product_code'] == "1001" or $pay_data['m_product_code'] == "2001" or $pay_data['m_product_code'] == "2002" or $pay_data['m_product_code'] == "2003"){
				$m_type_update = $this->my_m->update('TotalMembers', array('m_userid' => $pay_data['m_userid']), array('m_type' => 'V'));	//정회원전환
			}

			$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $tid));		//거래내역 가져오기
			
			//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
			$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, '승인완료');

			if($rtn == "1"){
				$m_data = $this->member_lib->get_member($arrData['m_userid']);
				//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
				if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
					partner_send_curl('PAY', $arrData['m_userid'], $arrData['m_tradeid']);
				}
				
				//관리자가 승인시 관리자 이름 insert
				$this->my_m->update('payment_temp', array('m_tradeid' => $arrData['m_tradeid']), array('m_ok_name' => $this->session->userdata['username']));
				
				echo "success";	//승인 및 포인트 업데이트까지 성공

			}else{

				echo "error";	//포인트지급 업데이트 실패
			}

		}else{

			echo "error";		//승인처리가 실패할경우

		}


	}


	function regular_mb2(){
		//정회원전환 (포인트 없이)
		$user_id = rawurldecode($this->input->post('user',TRUE));						//회원정보가져오기
		if(empty($user_id)){ echo "1000"; exit; }

		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_type' => 'V'));

		echo $rtn;
	}


	function regular_mb(){

		//거래번호만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$tid = 'MU_joyhunting_'.date('YmdHis')."_".$str_rand;		//거래번호만들기

		$user_id = rawurldecode($this->input->post('user',TRUE));						//회원정보가져오기
		if(empty($user_id)){ echo "1000"; exit; }

		//정회원 전환 상품 가져오기(코드 : 2000 )
		$pd_data = $this->my_m->row_array('product_list', array('m_product_code' => '2000'));
	
		//결제 시도데이터
		$temp_arrData = array(
			
			"m_userid"				=> $user_id,
			"m_product_code"		=> $pd_data['m_product_code'],
			"m_goods"				=> $pd_data['m_goods'],
			"m_price"				=> $pd_data['m_price'],
			"m_point"				=> $pd_data['m_point'],
			"m_cash_gb"				=> '관리자',
			"m_commid"				=> '',
			"m_mobilid"				=> '',
			"m_mrchid"				=> '',
			"m_mstr"				=> '관리자',
			"m_hp"					=> '',
			"m_payeremail"			=> '',
			"m_card_ok"				=> 'Y',
			"m_tradeid"				=> $tid,
			"m_signdate"			=> '',
			"m_payment_gb"			=> '관리자',
			"m_result_code"			=> '0000',
			"m_writedate"			=> NOW,
			"m_okdate"				=> NOW

		);

		$rtn = $this->my_m->insert('payment_temp', $temp_arrData);		
	
		if ($rtn == '1'){
			$rtn = member_point_insert($user_id, $pd_data['m_product_code'], $pd_data['m_goods'], $pd_data['m_point'], $pd_data['m_price'], $tid , NOW, $pd_data['m_etc']);
			
			//관리자가 승인시 관리자 이름 insert
			$this->my_m->update('payment_temp', array('m_tradeid' => $tid), array('m_ok_name' => $this->session->userdata['username']));
		}

		//정회원 전환
		$this->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_type' => 'V'));

		//파트너 처리
		//회원데이터 가져오기
		$user_data = $this->member_lib->get_member($user_id);
		if(!empty($user_data['m_partner']) and !empty($user_data['m_partner_code'])){
			partner_send_curl('PAY', $user_data['m_userid'], $tid, null);
		}

		echo $rtn;
	}



	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/