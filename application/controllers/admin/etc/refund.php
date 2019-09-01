<?php
class Refund extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/payment_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->library('member_lib');

		admin_check();

	}
	
	//관리자 처음화면
	function index()  
	{
		$this->refund_list();
	}
	

	//환불관리리스트
	function refund_list(){

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->my_m->get_list($start, $rp, @$search, 'refund_list', 'idx', 'user_id', 'desc', '*');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total= $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));
		

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/refund_list_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}

	//회원검색 내역 리스트 조회 ajax
	function member_search_ajax(){
		
		$sfl	= rawurldecode($this->input->post('sfl', true));		//검색조건
		$q		= rawurldecode($this->input->post('q', true));			//입력데이터
		
		//정확하게 한사람의 데이터만 가져와야 하기때문에 아이디만 넘김
		$member_data = $this->my_m->row_array('TotalMembers', array($sfl => $q));

		$arrData = $this->payment_m->refund_member_search($member_data['m_userid']);

		if(empty($arrData)){
			//결제 내역이 있는 회원 검색결과가 없는경우
			echo "0";
		}else{
			//결제 내역이 있는 회원 검색결과가 있는경우

			$add_html = "";
			$add_html .= " <input type='hidden' id='m_userid' name='m_userid' value='".$arrData['m_userid']."'> ";
			$add_html .= " <input type='hidden' id='m_tradeid' name='m_tradeid' value='".$arrData['m_tradeid']."'> ";
			$add_html .= " <div class='panel-heading'><span class='title elipsis'><strong>".$arrData['m_userid']." (".$arrData['m_name'].")</strong></span></div> ";
			$add_html .= " <div class='panel-body'><div class='table-responsive'><table class='table table-bordered table-vertical-middle nomargin'> ";
			if($arrData['m_type'] == "V"){
				$add_html .= " <tr><th class='width-300'>정회원 가입일</th><td>".$arrData['m_writedate']."</td></tr> ";
			}else{
				$add_html .= " <tr><th class='width-300'>정회원 가입일</th><td><font style='color:red;'>준회원입니다.</font></td></tr> ";
			}
			
			$add_html .= " <tr><th class='width-300'>보유 포인트</th><td>".$arrData['total_point']."</td></tr> ";
			$add_html .= " <tr><th class='width-300'>사유</th><td><input type='text' id='m_reason' name='m_reason' value='' style='width:500px;'></td></tr> ";
			$add_html .= " </table></div> ";
			$add_html .= " <div style='width:100%; text-align:center; margin-top:10px;'><button class='btn btn-success' onclick='javascript:reg_refund();'>환불신청</button></div> ";
			
			echo $add_html;
		}

	}

	//환불신청 처리 ajax
	function member_refund_ajax(){
		
		$m_userid	= rawurldecode($this->input->post('m_userid', true));		//회원아이디
		$m_reason	= rawurldecode($this->input->post('m_reason', true));		//환불사유
		$m_tid		= rawurldecode($this->input->post('m_tradeid', true));		//환불상품 거래번호
		
		//정회원 가입일
		$mpl = $this->my_m->row_array('member_point_list', array('m_userid' => $m_userid, 'm_tradeid' => $m_tid));

		//환불신청 전 정회원에서 준회원으로 회원레벨 낮추기
		//준회원 될경우 모든 포인트 초기화 0포인트 처리(point_helper)
		$call_refund = call_member_refund($m_userid, $m_tid);

		if($call_refund == "1"){
			//정회원 -> 준회원
			//환분신청 내역 insert
			$rtn = $this->my_m->insert('refund_list', array('user_id' => $m_userid, 'reason' => $m_reason, 'vip_date' => $mpl['m_writedate'], 'write_day' => NOW));
		
		}else{
			//원래 준회원 인경우
			$rtn = "9";
		}

		echo $rtn;
		
	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/