<?php
class Complaint extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/complaint_m');
		$this->load->helper('alrim_helper');

		admin_check();
	}


	function complain_list() 
	{
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}
		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = $data['rp'] = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'Police_complaint', 'c_idx', 's_id');

		$data['mlist'] = $result[0];

		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/complaint_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	function complain_view()  //자세히보기
	{

		$idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		$data['page'] = @$this->security->xss_clean(url_explode($this->seg_exp, 'page'));
		if(empty($idx)){alert_only("회원아이디가 넘어오지 않았습니다.");}
		
		//회원정보 불러오기
		//$data['views'] = $this->complaint_m->show_add($idx);

		$search['c_idx'] = $idx;
		$data['comp'] = $this->my_m->row_array('Police_complaint', $search);
		
		//신고자 정보
		$find_suser = $data['comp']['s_id'];
		$data['send'] = $this->member_lib->get_member($find_suser);

		//대상자 정보
		$find_ruser = $data['comp']['r_id'];
		$data['recv'] = $this->member_lib->get_member($find_ruser);

		//대상자 정보2
		$search2['m_userid'] = $find_ruser;
		$data['last_login'] = $this->my_m->row_array('TotalMembers_login', $search2);

		//처벌정보
		$search3['c_idx'] = $idx;
		@$data['puni'] = $this->my_m->row_array('Police_punish', $search3);

		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $find_ruser));		//회원 보유 포인트

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/complaint_view_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}


	function punish_add(){


		$pu_text		 = rawurldecode($this->input->post('text', true));
		$pu_card		 = rawurldecode($this->input->post('card', true));
		$co_idx			 = rawurldecode($this->input->post('idx', true));

		$search['c_idx'] = $co_idx;

		$punish_cnt = $this->my_m->cnt('Police_punish', $search);

		// 이미 처벌을 했으면
		if ($punish_cnt != 0){ 
			
			echo "4"; exit; 
			
		}else{

			// 화이트카드(12시간)
			if ($pu_card == '2'){
				$cancel_date = '12 hours';

			// 옐로우카드(24시간)
			}else if ($pu_card == '3'){
				$cancel_date = '24 hours';

			// 레드카드(3일)
			}else if ($pu_card == '4'){
				$cancel_date = '3 day';
			}

			$c_cancel = date('Y-m-d G:H:s',strtotime(NOW.'+'.@$cancel_date));

			// 경고이거나 블랙카드일때
			if ($pu_card == '1' || $pu_card == '5'){
				$c_cancel = '9999-99-99 24:00:00';
			}

			$complain = $this->my_m->row_array('Police_complaint', $search);
			
			//처벌 테이블에 추가
			$arr_data = array(
				'c_idx'			=>	$co_idx,
				'user_id'		=>	$complain['r_id'],
				'user_nick'		=>	$complain['r_nick'],
				'p_card'		=>	$pu_card,
				'p_cate'		=>	$complain['c_cate'],
				'p_content'		=>	$pu_text,
				'p_date'		=>	NOW,
				'p_cancel'		=>	$c_cancel,
				'p_success'		=>	'7'
			);

			$rtn = $this->my_m->insert("Police_punish", $arr_data);

			if ($rtn == '1'){

				//신고 테이블 업데이트
				$set_array = array(
					'cp_date'		=>	NOW,
					'c_cancel'		=>	$c_cancel,
					'c_success'		=>	'7'
				);

				$search_idx['c_idx'] = $co_idx;

				$rtn = $this->my_m->update('Police_complaint', $search_idx, $set_array);
				echo $rtn;

				if ($pu_card == '1'){
					joyhunting_alrim("경고", $complain['r_id']);
				}else{
					// 로그인상태인지 체크
					$sess_cnt = $this->my_m->cnt('ci_sessions', array('m_userid' => $complain['r_id']) );
					
					// 로그인상태이면 세션삭제
					if($sess_cnt > 0){
						$sees_del = $this->my_m->del('ci_sessions', array('m_userid' => $complain['r_id']));
					}
				}
			}
		}

	}

	// 판결불가
	function not_punish(){
		
		$co_idx			 = rawurldecode($this->input->post('idx', true));
		$pu_text		 = rawurldecode($this->input->post('text', true));

		$search['c_idx'] = $co_idx;
		$punish_cnt = $this->my_m->cnt('Police_punish', $search);

		if ($punish_cnt == 0){

			$complain = $this->my_m->row_array('Police_complaint', $search);

			//처벌 테이블에 인서트
			$arr_data = array(
				'c_idx'			=>	$co_idx,
				'user_id'		=>	$complain['r_id'],
				'user_nick'		=>	$complain['r_nick'],
				'p_card'		=>	'',
				'p_cate'		=>	$complain['c_cate'],
				'p_content'		=>	$pu_text,
				'p_date'		=>	NOW,
				'p_success'		=>	'4'
			);

			$rtn = $this->my_m->insert("Police_punish", $arr_data);

			if ($rtn == '1'){

				//신고 테이블 업데이트
				$set_array = array(
					'cp_date'		=>	NOW,
					'c_success'		=>	'4'
				);

				$search_idx['c_idx'] = $co_idx;

				$rtn = $this->my_m->update('Police_complaint', $search_idx, $set_array);
				echo $rtn;
			}

		}else{

			echo "4";
		
		}

	}




}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */