<?php
class Message extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/a_member_m');

		admin_check();
	}
	
	//메세지 리스트
	function message_list(){
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'MESSAGE_LIST', 'V_IDX', 'V_SEND_ID', 'DESC', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));


		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/profile/message_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	
	//한개씩 삭제함수
	function call_msg_del(){

		$v_idx = rawurldecode($this->input->post('v_idx', true));

		$rtn = $this->my_m->update('MESSAGE_LIST', array('V_IDX' => $v_idx), array('V_DEL_GUBN' => 'D'));

		echo $rtn;
	}

	//선택한 체크박스 삭제함수
	function call_chk_msg_del(){

		$chk_value = rawurldecode($this->input->post('chk_value', true));

		$v_chk_value = explode('|', $chk_value);
		
		$return_value = "";
		for($i=0; $i<count($v_chk_value); $i++){
			$rtn = $this->my_m->update('MESSAGE_LIST', array('V_IDX' => $v_chk_value[$i]), array('V_DEL_GUBN' => 'D'));

			if(!empty($return_value)){
				$return_value = $return_value.",".$rtn;
			}else{
				$return_value = $rtn;
			}
		}
		
		$search = "0";

		if(strpos($return_value, $search) !== false){
			echo "0";
		}else{
			echo "1";
		}

	}



}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */