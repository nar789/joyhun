<?php
class Chat_words extends MY_Controller {

	function __construct(){

		parent::__construct();

		admin_check();

	}
	
	//관리자 처음화면
	function index(){
		$this->words_list();
	}
	
	//채팅문구 리스트
	function words_list(){

		//검색이 있을경우
		if(in_array('q', $this->seg_exp)){

			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search['ex_data_1'] = $data['method']." like '%".$data['s_word']."%'";
		}
		//페이징 변수
		$page = $data['page'] = $this->pre_paging();
		$rp = $data['rp'] = 15; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'chat_words_list', 'idx', 'desc');

		$data['mlist'] = $result[0];

		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/chat_words_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//채팅문구 등록하기
	function words_write(){

		$idx	= $this->security->xss_clean(url_explode($this->seg_exp, 'idx'));
		$page	= $this->security->xss_clean(url_explode($this->seg_exp, 'page'));

		$status_text = "등록";
		if(!empty($idx)){
			$status_text = "수정";
			$data['chat_words'] = $this->my_m->row_array('chat_words_list', array('idx' => $idx), 'idx', 'desc', '1');
		}

		$data['status_text']	= $status_text;
		$data['page']			= $page;

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/chat_words_write_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	//채팅문구 등록/수정 하기 ajax
	function register_chat_words(){
		
		$idx			= rawurldecode($this->input->post('idx', true));
		$sex			= rawurldecode($this->input->post('sex', true));
		$chat_words		= rawurldecode($this->input->post('chat_words', true));
		$status			= rawurldecode($this->input->post('status', true));
		
		$arrData = array(
			"sex"			=> $sex,
			"chat_words"	=> $chat_words,
			"write_date"	=> NOW
		);
		
		if($status == "등록"){
			//신규등록
			$rtn = $this->my_m->insert('chat_words_list', $arrData);
		}else if($status == "수정"){
			//수정
			if(empty($idx)){ echo "1000"; exit; }
			$rtn = $this->my_m->update('chat_words_list', array('idx' => $idx), $arrData);
		}else{
			//잘못된접근
			$rtn = "1000";
		}

		echo $rtn;

	}

	//채팅문구 삭제하기 ajax
	function del_chat_words(){
		
		$idx = rawurldecode($this->input->post('idx', true));

		if(!empty($idx)){
			$rtn = $this->my_m->del('chat_words_list', array('idx' => $idx));
		}else{
			$rtn = "1000";
		}

		echo $rtn;

	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/