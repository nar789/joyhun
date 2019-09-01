<?php
class Woman_event extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/event_m');

		admin_check();
	}
	

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//여성회원 전용 이벤트 관련 관리자 페이지
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	//여성회원 이벤트 리스트
	function woman_event_list(){
		
		$uri_array = $this->seg_exp;

		//변수받기
		$data['v_date_1']	= $v_date_1	 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'v_date_1')));			//날짜1
		$data['v_date_2']	= $v_date_2	 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'v_date_2')));			//날짜2
		$data['v_user_id']	= $v_user_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'v_user_id')));			//보낸회원 아이디

		if(empty($v_date_1)){ $data['v_date_1'] = $v_date_1 = date('Y-m-d', strtotime(date('Y-m-d').'-14 days')); }
		if(empty($v_date_2)){ $data['v_date_2'] = $v_date_2 = date('Y-m-d'); }
		
		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->event_m->woman_event_list($start, $rp, $v_date_1, $v_date_2, $v_user_id);

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));
		
		//검색조건이 모두 있을경우만 호출
		if(!empty($v_date_1) and !empty($v_date_2) and !empty($v_user_id)){

			$bot_data['add_script'] = "
			<script type='text/javascript'>
				$(document).ready(function(){
					call_member_event_stat();
				});
			</script>
			";
		}

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/woman_event_v', $data);
		$this->load->view('admin/admin_bottom_v', @$bot_data);
	}

	//여성전용 이벤트 삭제 함수
	function woman_event_list_del(){

		$chk_val = rawurldecode($this->input->post('chk_val', true));

		if(strpos($chk_val, '|')){
			
			$val = explode('|', $chk_val);
			
			for($i=0; $i<count($val); $i++){
				$rtn = $this->my_m->del('WOMAN_EVENT', array('V_IDX' => $val[$i]));
			}

		}else{
			$rtn = $this->my_m->del('WOMAN_EVENT', array('V_IDX' => $chk_val));
		}

		echo $rtn;

	}

	//여성전용 이벤트 개인통계
	function call_woman_event_member_stat(){

		$date_1 = rawurldecode($this->input->post('date_1', true));
		$date_2 = rawurldecode($this->input->post('date_2', true));
		$user_id = rawurldecode($this->input->post('user_id', true));
		
		//데이터가 하나라도 없을경우 1000반환 exit
		if(empty($date_1) or empty($date_2) or empty($user_id)){
			echo "1000"; exit;
		}

		//합계 변수 초기화 셋팅
		$TOTAL_REQUEST	= "0";	//채팅신청 합계
		$TOTAL_CHAT		= "0";	//채팅횟수 합계
		$TOTAL_GIFT		= "0";	//받은선물 합계
			
		$html = "";

		//개인통계 데이터 가져오기
		$mdata = $this->event_m->woman_event_member_stat($date_1, $date_2, $user_id);

		if(!empty($mdata)){
			
			$html .= "<div style='position:relative; width:500px; font-size:0.9em; text-align:center; margin-bottom:10px;'>";
			$html .= "<table class='table table-bordered table-vertical-middle nomargin'>";
			$html .= "<tr>";
			$html .= "<th class='width-100'>날짜</th>";
			$html .= "<th class='width-100'>아이디</th>";
			$html .= "<th class='width-100'>채팅신청횟수</th>";
			$html .= "<th class='width-100'>채팅3회횟수</th>";
			$html .= "<th class='width-100'>상품수령여부</th>";
			$html .= "</tr>";
			foreach($mdata as $data){
				
				$TOTAL_REQUEST = $TOTAL_REQUEST + $data['REQ_CNT'];
				$TOTAL_CHAT	   = $TOTAL_CHAT + $data['CHAT_CNT'];
				$TOTAL_GIFT    = $TOTAL_GIFT + $data['GIFT_CNT'];

				$html .= "<tr>";
				$html .= "<td>".$data['DATE']."</td>";
				$html .= "<td>".$data['SEND_ID']."</td>";
				$html .= "<td>".$data['REQ_CNT']."</td>";
				$html .= "<td>".$data['CHAT_CNT']."</td>";
				$html .= "<td>".$this->call_gift_code_change($data['GIFT_CNT'])."</td>";
				$html .= "</tr>";
			}
			
			$html .= "<tr>";
			$html .= "<td><b>합계</b></td>";
			$html .= "<td></td>";
			$html .= "<td>".$TOTAL_REQUEST."번</td>";
			$html .= "<td>".$TOTAL_CHAT."번</td>";
			$html .= "<td>".$TOTAL_GIFT."개</td>";
			$html .= "</tr>";
			$html .= "</table>";
			$html .= "</div>";

		}

		echo $html;


	}

	//여성회원 개인 통계 상품 수령 코드 변환
	function call_gift_code_change($val){

		if($val >= "1"){
			$str = "수령";
		}else{
			$str = "미수령";
		}
		return $str;
	}

	//여성전용 이벤트 통계
	function woman_event_stat(){

		$data['m_year'] = $m_year	 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_year')));			//년도
		$data['m_month'] = $m_month = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_month')));			//월

		if(empty($m_year)){ $data['m_year'] = $m_year = date('Y'); }
		if(empty($m_month)){ $data['m_month'] = $m_month = date('m'); }

		$data['event_stat'] = $this->event_m->woman_event_stat($m_year, $m_month);

		$data['TOTAL_JOIN_CNT']			= "0";		//총 참여회원수	초기화
		$data['TOTAL_SUCCESS_CNT']		= "0";		//총 완료회원수 초기화
		$data['TOTAL_GIFT_CNT']			= "0";		//총 지급한상품갯수 초기화
		$data['TOTAL_PRICE']			= "0";		//총 금액 합산 초기화

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/woman_event_stat_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */