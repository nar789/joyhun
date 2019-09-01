<?php
class Punishment extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/a_member_m');
		$this->load->model('admin/ideal_m');

		admin_check();
	}


	function punish_list() 
	{
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//페이징 변수
		$page = $data['page']= $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'Police_punish', 'p_idx', 'user_id');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));


		$data['str_rand'] = mt_rand(0, 9999999);

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/punishment_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	function punish_view()  //자세히보기
	{

		$idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		$data['page'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'page')));
		if(empty($idx)){alert_only("회원아이디가 넘어오지 않았습니다.");}
		
		//회원정보 불러오기
		//$data['views'] = $this->complaint_m->show_add($idx);
		
		//랜덤숫자
		$data['punish_rand'] = mt_rand(0, 99999);

		//처벌정보
		$search3['p_idx'] = $idx;
		$data['puni'] = $this->my_m->row_array('Police_punish', $search3);
		
		//대상자 정보
		$find_ruser = $data['puni']['user_id'];
		$data['recv'] = $this->member_lib->get_member($find_ruser);

		//대상자 정보2
		$search2['m_userid'] = $find_ruser;
		$data['last_login'] = $this->my_m->row_array('TotalMembers_login', $search2);

		//처벌리스트
		$search_user['user_id'] = $data['puni']['user_id'];
		$data['puni_list'] = $this->my_m->result_array('Police_punish', $search_user,'p_date');

		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $find_ruser));		//회원 보유 포인트

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/punish_view_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}


	//처벌하기 레이어팝업
	function punish_pop(){

		$data['user_id'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));		//선택회원 아이디
		
		$this->load->view('admin/layer_popup/punish_layer_v', @$data);
	}


	//처벌하기 레이어팝업 > ajax
	function punish_request(){


		$user_id		 = rawurldecode($this->input->post('m_userid', true));
		$comp_cate		 = rawurldecode($this->input->post('comp_cate', true));
		$punish_card	 = rawurldecode($this->input->post('punish_card', true));
		$comp_content	 = rawurldecode($this->input->post('comp_content', true));

		$set_ip_block	 = rawurldecode($this->input->post('set_ip_block', true));
		$set_hp_block	 = rawurldecode($this->input->post('set_hp_block', true));
		
		$user_info = $this->member_lib->get_member($user_id);

		//경고
		if ($punish_card == '1'){
			$cancel_date = '';
		
		// 화이트카드(12시간)
		}else if ($punish_card == '2'){
			$cancel_date = '12 hours';

		// 옐로우카드(24시간)
		}else if ($punish_card == '3'){
			$cancel_date = '24 hours';

		// 레드카드(3일)
		}else if ($punish_card == '4'){
			$cancel_date = '3 day';

		// 블랙카드(영구정지)
		}else if ($punish_card == '5'){
			$cancel_date = '';
		}
	
		//영구정지일경우 날짜 변경
		if($punish_card == '5'){
			$c_cancel = "9999-12-31 23:59:59";
		}else{
			$c_cancel = date('Y-m-d G:H:s',strtotime(NOW.'+'.$cancel_date));
		}

		$rtn = $this->my_m->cnt('Police_punish', array('p_card' => '5', 'user_id' => $user_id));

		if($rtn > 0){
			echo "777";
			exit;
		}
		
		//아이피 또는 휴대전화번호 체크박스가 체크되어있을경우
		if(!empty($set_ip_block)){ $this->set_user_block($user_id, $set_ip_block, $comp_content); }
		if(!empty($set_hp_block)){ $this->set_user_block($user_id, $set_hp_block, $comp_content); }

		//처벌 테이블에 추가
		$arr_data = array(
			'c_idx'			=>	'',
			'user_id'		=>	$user_id,
			'user_nick'		=>	$user_info['m_nick'],
			'p_card'		=>	$punish_card,
			'p_cate'		=>	$comp_cate,
			'p_content'		=>	$comp_content,
			'p_date'		=>	NOW,
			'p_cancel'		=>	$c_cancel,
			'p_success'		=>	'7'
		);

		$rtn_2 = $this->my_m->insert("Police_punish", $arr_data);

		echo $rtn_2;

	}


	//아이피 차단 또는 휴대전화 번호 차단 체크시 처리 함수
	function set_user_block($user_id, $gubn, $reason){

		//이미 차단된 회원인지 체크
		$block_cnt = $this->my_m->cnt('MEMBER_BLOCK_LIST', array('USER_ID' => $user_id, 'GUBN' => $gubn));

		if($block_cnt == "0"){

			$m_data = $this->member_lib->get_member($user_id);
			if(empty($m_data)){ return; }		//회원데이터가 없을경우 return
			
			//차둔 구분에 따른 차단 변수설정
			if($gubn == "IP"){
				$gubn_val = $m_data['last_login_ip'];
			}else if($gubn == "HP"){
				$gubn_val = $m_data['m_hp1']."-".$m_data['m_hp2']."-".$m_data['m_hp3'];
			}else{
				//잘못된 접근
				return; 
			}

			//차단 내역 insert
			$arrData = array(
				"USER_ID"			=> $m_data['m_userid'],
				"GUBN"				=> $gubn,
				"GUBN_VAL"			=> $gubn_val,
				"REASON"			=> $reason,
				"STATUS"			=> '차단',
				"WRITE_DATE"		=> NOW,
				"BLOCK_DATE"		=> '9999-12-31 23:59:59'
			);

			$this->my_m->insert('MEMBER_BLOCK_LIST', $arrData);

		}

		return;

	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */