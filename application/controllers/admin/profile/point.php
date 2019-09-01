<?php
class Point extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->helper('point_helper');
		$this->load->library('member_lib');

		admin_check();
	}

	function index()  //관리자 처음화면
	{
		$this->point_list();
	}
	
	function point_list()  //포인트내역 리스트
	{
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));

			$search[$data['method']] = $data['s_word'];
		}		

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'member_point_list', 'm_idx', 'm_userid', 'desc', 'member_point_list.*, TotalMembers.m_nick, TotalMembers.m_name'); 
		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/profile/point_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}
	
	//포인트 지급 레이어팝업
	function provide_pop(){

		$data['m_userid'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));		//선택회원 아이디
		
		$this->load->view('admin/layer_popup/add_point_layer_v', @$data);
	}

	//포인트 지급 이벤트 ajax
	function point_provide(){

		$m_userid	= rawurldecode($this->input->post('m_userid', true));
		$m_point	= rawurldecode($this->input->post('m_point', true));
		$m_etc		= rawurldecode($this->input->post('m_etc', true));
		
		//관리자가 직접 회원에게 포인트를 지급할경우(상품코드 : 0000, 거래번호 : 0000)
		//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
		$rtn = member_point_insert($m_userid, '0000', '포인트지급', $m_point, null, '0000', NOW, $m_etc);

		echo $rtn;
	}

	
	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */