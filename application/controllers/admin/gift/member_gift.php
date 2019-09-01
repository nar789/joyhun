<?php
class Member_gift extends MY_Controller {

	function __construct(){

		parent::__construct();
		
		$this->load->model('admin/gift_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');

		admin_check();

	}
	
		
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//선물내역(선물리스트)
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	
	//회원 선물내역 리스트
	function member_gift_list(){

		$uri_array = $this->seg_exp;

		//검색조건 변수 받기
		$data['vendor']			= $vendor			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'vendor')));			//업체(벤더)
		$data['category']		= $category			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'category')));		//카테고리
		$data['delivery']		= $delivery			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'delivery')));		//배송방식
		$data['gift_stat']		= $gift_stat		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_stat')));		//선물상태
		$data['gift_name']		= $gift_name		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_name')));		//상품이름
		$data['gift_num']		= $gift_num			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_num')));		//상품고유번호
		$data['gift_code']		= $gift_code		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_code')));		//상품코드
		$data['date_1']			= $date_1			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'date_1')));			//일자 from
		$data['date_2']			= $date_2			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'date_2')));			//일자 to
		$data['s_user_id']		= $s_user_id		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 's_user_id')));		//보낸아이디
		$data['s_user_num']		= $s_user_num		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 's_user_num')));		//보낸회원번호
		$data['s_nick']			= $s_nick			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 's_nick')));			//보낸닉네임
		$data['r_user_id']		= $r_user_id		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'r_user_id')));		//받은아이디
		$data['r_user_num']		= $r_user_num		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'r_user_num')));		//받은회원번호
		$data['r_nick']			= $r_nick			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'r_nick')));			//받은닉네임
		
		//카테고리의 경우 |를 /로 replace
		if($category){
			$data['category'] = $category = str_replace("|", "/", $category);
		}

		//기본날짜 셋팅
		//if(empty($date_1)){ $data['date_1'] = $date_1 = date('Y-m-')."01"; }
		if(empty($date_2)){ $data['date_2'] = $date_2 = date('Y-m-d'); }

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 5; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//회원 선물내역 가져오기
		$result = $this->gift_m->member_gift_list($start, $rp, $vendor, $category, $delivery, $gift_stat, $gift_name, $gift_num, $gift_code, $date_1, $date_2, $s_user_id, $s_user_num, $s_nick, $r_user_id, $r_user_num, $r_nick);

		$data['mlist']			= $result[0];
		$data['getTotalData']	= $result[1];
		$data['plist']			= $result[2];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));
		
		$total_p = 0;
		$total_w = 0;

		//총포인트 및 총 가격 계산
		foreach($data['plist'] as $val){
			$total_p = $total_p + $val['PRICE_P'];
			$total_w = $total_w + $val['PRICE_W'];
		}

		$data['total_p'] = $total_p;
		$data['total_w'] = $total_w;
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/gift/member_gift_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//배송관리
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	
	//회원 선물 배송관리 리스트
	function delivery_list(){

		$uri_array = $this->seg_exp;

		//검색조건 변수 받기
		$data['vendor']			= $vendor			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'vendor')));			//업체(벤더)
		$data['category']		= $category			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'category')));		//카테고리
		$data['delivery']		= $delivery			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'delivery')));		//배송방식
		$data['gift_stat']		= $gift_stat		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_stat')));		//선물상태
		$data['gift_name']		= $gift_name		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_name')));		//상품이름
		$data['gift_num']		= $gift_num			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_num')));		//상품고유번호
		$data['gift_code']		= $gift_code		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'gift_code')));		//상품코드
		$data['date_1']			= $date_1			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'date_1')));			//일자 from
		$data['date_2']			= $date_2			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'date_2')));			//일자 to
		$data['user_id']		= $user_id			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_id')));		//회원아이디
		$data['user_num']		= $user_num			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_num')));		//회원번호
		$data['user_nick']		= $user_nick		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user_nick')));		//회원닉네임
		$data['partner']		= $partner			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'partner')));		//파트너
		$data['product_num']	= $product_num		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'product_num')));	//선물고유번호
		
		//카테고리의 경우 |를 /로 replace
		if($category){
			$data['category'] = $category = str_replace("|", "/", $category);
		}

		//기본날짜 셋팅
		//if(empty($date_1)){ $data['date_1'] = $date_1 = date('Y-m-')."01"; }
		if(empty($date_2)){ $data['date_2'] = $date_2 = date('Y-m-d'); }

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//회원 배송내역 가져오기
		$result = $this->gift_m->member_delivery_list($start, $rp, $vendor, $category, $delivery, $gift_stat, $gift_name, $gift_num, $gift_code, $date_1, $date_2, $user_id, $user_num, $user_nick, $partner, $product_num);

		$data['mlist']			= $result[0];
		$data['getTotalData']	= $result[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));


		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/gift/member_delivery_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


	//선택삭제, 선물받음 상태로 변경(초기화), 배송업체 전달상태로 변경, 배송완료 상태로 변경
	//gubn 값으로 구분(del, init, deli, deli_ok)
	function call_check_box_process(){

		$val	 = rawurldecode($this->input->post("val", true));			//체크된 리스트 번호
		$gubn	 = rawurldecode($this->input->post("gubn", true));			//함수구분

		$idx = explode("|", $val);

		if($gubn == "del"){
			//선택삭제
			for($i=0; $i<count($idx); $i++){
			
				$rtn = $this->my_m->update('GIFT_SEND', array('V_IDX' => $idx[$i]), array('V_DEL_GUBN' => 'D'));
				
				$tmp = $this->call_fail_array($rtn);

			}

		}else if($gubn == "init"){
			//발송신청 상태로 변경(초기화)
			for($i=0; $i<count($idx); $i++){
			
				$rtn = $this->my_m->update('GIFT_SEND', array('V_IDX' => $idx[$i]), array('V_RECV_YN' => 'Y', 'V_SEND_YN' => 'I', 'V_RECV_DATE' => NOW, 'V_DELI_DATE' => NULL, 'V_DEL_GUBN' => NULL));

				$tmp = $this->call_fail_array($rtn);

			}

		}else if($gubn == "deli_ok"){
			//발송완료 상태로 변경
			for($i=0; $i<count($idx); $i++){
			
				$rtn = $this->my_m->update('GIFT_SEND', array('V_IDX' => $idx[$i]), array('V_RECV_YN' => 'Y', 'V_SEND_YN' => 'Y', 'V_DELI_DATE' => NOW, 'V_DEL_GUBN' => NULL));

				$tmp = $this->call_fail_array($rtn);

			}
		}else{
			//잘못된 접근
			echo "1000"; exit;
		}

		if(!empty($v_idx_array)){
			//선택항목 부분 처리 성공 실패항목들 리턴
			echo $tmp;
		}else{
			//선택항목 처리 성공
			echo "1";
		}

	}

	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	//함수
	/*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

	//공통처리함수에서 update가 실패했을경우 실패 항목 배열로 넣기
	function call_fail_array($rtn){
		
		$tmp = "";

		if($rtn == "0"){
			
			if(empty($tmp)){
				$tmp = $rtn;
			}else{
				$tmp = $tmp.",".$rtn;
			}
		}

		return $tmp;
	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/