<?php
class Stamp_event extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/service_center_m');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');

		admin_check();
	}


	//출석체크 당첨자 생성
	function stamp_member(){

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'attend_reg_list', 'm_idx', 'desc', '*');

		$data['list']			= $result[0];
		$data['getTotalData']	= $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/stamp_member_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//출석체크 당첨자 명단 view 페이지
	function stamp_member_win(){

		$idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));

		$data = $this->my_m->row_array('attend_reg_list', array('m_idx' => $idx), 'm_idx', 'desc', '1');

		$member_array = explode(",", $data['m_win_member']);
		
		$result_array = "";
		for($i=0; $i<count($member_array); $i++){
			$user_id = trim($member_array[$i]);
			$mdata = $this->member_lib->get_member($user_id);
			if(!empty($mdata)){
				if($i == count($member_array)-1){
					$result_array .= $mdata['m_nick']."(".get_hide_userid($mdata['m_userid']).")";
				}else{
					$result_array .= $mdata['m_nick']."(".get_hide_userid($mdata['m_userid'])."), ";
				}
			}			
		}

		$data['resut_array'] = $result_array;
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/stamp_member_win_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//당첨자 발표 레이어팝업
	function call_win_member(){

		$data['idx'] = $idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));		//순번

		if(empty($idx)){ exit; }
		
		$this->load->view('admin/layer_popup/stamp_member_layer_v', $data);
	}


	//당첨자 발표 여부 확인
	function win_member_chk(){
		
		$idx = rawurldecode($this->input->post('idx', true));

		$data = $this->my_m->row_array('attend_reg_list', array('m_idx' => $idx), 'm_idx', 'desc', '1');

		if(empty($data['m_win_member'])){
			$rtn = "0";		//당첨자 발표 안함
		}else{
			$rtn = "1";		//당첨자 발표 완료
		}

		echo $rtn;

	}

	//당첨자 추첨
	function call_win_member_ajax(){
		
		$idx = rawurldecode($this->input->post('idx', true));		//출석체크 이벤트 고유 순번
		$cnt = rawurldecode($this->input->post('cnt', true));		//추첨인원수

		if(empty($idx) or empty($cnt)){ echo "1000"; exit; }		//고유번호나 추첨인원수가 없을경우 에러처리

		$win_day = $this->my_m->row_array('attend_reg_list',  array('m_idx' => $idx), 'm_idx', 'desc', '1');
		
		if(!empty($win_day)){
						
			if(empty($win_day['m_win_member'])){
			//아직 추첨을 안한경우
				$r_number = explode('|', $win_day['m_rand_num']);		//분홍날짜 랜덤번호 나누기

				$search = array(
					"m_year"					=> $win_day['m_year'],
					"m_month"					=> $win_day['m_month'],
					"m_day".$r_number[0]		=> '1',
					"m_day".$r_number[1]		=> '1',
					"m_day".$r_number[2]		=> '1',
					"m_day".$r_number[3]		=> '1',
					"m_day".$r_number[4]		=> '1',
					"m_day".$r_number[5]		=> '1',
					"m_day".$r_number[6]		=> '1',
					"m_day".$r_number[7]		=> '1',
					"m_day".$r_number[8]		=> '1',
					"m_day".$r_number[9]		=> '1',
					"m_day".$r_number[10]		=> '1',
					"m_day".$r_number[11]		=> '1'			
				);

				$result = $this->service_center_m->call_win_member_m($search, $cnt);

				if(empty($result)){
				//당첨자가 없는경우
					$rtn = $this->my_m->update('attend_reg_list', array('m_idx' => $idx), array('m_win_member' => '당첨자없음'));
				}else{
				//당첨자가 있는경우

					$member_array = "";

					foreach($result as $data){
						if(empty($member_array)){
							$member_array = $data['m_userid'];
						}else{
							$member_array .= ", ".$data['m_userid'];
						}
					}

					$rtn = $this->my_m->update('attend_reg_list', array('m_idx' => $idx), array('m_win_member' => $member_array, 'm_cnt' => $cnt));

					//추첨완료후 포인트 지급(조이헌팅 200포인트)
					if($rtn == 1){
						$event_data = $this->my_m->row_array('attend_reg_list', array('m_idx' => $idx), 'm_idx', 'desc', '1');
						$member_array = explode(",", $event_data['m_win_member']);

						for($i=0; $i<count($member_array); $i++){
							member_point_insert(trim($member_array[$i]), "0000", "출석체크이벤트당텀", "200", null, "0000", NOW, "출석체크 이벤트 당첨 포인트 지급");
						}
					}

				}

			}else{
			//이미 추첨을 한경우
				$rtn = "2";
			}

		}

		echo $rtn; 

	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */