<?php
class Talk extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();

	}

	function index()  //관리자 처음화면
	{
		$this->talk_list();
	}

	function talk_list()  //토크 리스트
	{
		$uri_array = $this->seg_exp;
		
		//검색이 있을경우
		if( in_array('q', $uri_array) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($uri_array, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($uri_array, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search,'T_JoyTalk', 't_idx', 't_id'); //토크 리스트
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/talk/talk_list_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}

	//토크 삭제
	function talk_list_del(){

		$data['t_idx']			= rawurldecode($this->input->post('t_idx',TRUE));
		$data['t_id']			= rawurldecode($this->input->post('t_id',TRUE));

		$arr_data = array(
			"t_idx"		=> $data['t_idx'],
			"t_id"		=> $data['t_id']
		);
		$rtn = $this->my_m->del('T_JoyTalk', $arr_data);

		$arr_data = array("t_idx"		=> $data['t_idx']	);
		$this->my_m->del('T_JoyTalk_Reply', $arr_data);

		echo $rtn;

	}

	//토크 댓글 삭제
	function talk_reply_del(){

		$r_idx			= rawurldecode($this->input->post('r_idx',TRUE));
		$r_id			= rawurldecode($this->input->post('r_id',TRUE));
		$t_idx			= rawurldecode($this->input->post('t_idx',TRUE));
	
		//댓글삭제
		$this->my_m->del('T_JoyTalk_Reply', array('r_idx'=>$r_idx, 'r_id'=>$r_id));

		//댓글 갯수 읽어오기
		$cnt =$this->my_m->cnt('T_JoyTalk_Reply', array('t_idx' => $t_idx));

		//댓글 갯수 업데이트
		$this->my_m->update('T_JoyTalk', array('t_idx'=> $t_idx), array('t_repl'=> $cnt) );

		$this->db->where('t_idx', $t_idx);
		$this->db->set('t_repl', $cnt);
		$rtn = $this->db->update('T_JoyTalk');

		echo $rtn;

	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/