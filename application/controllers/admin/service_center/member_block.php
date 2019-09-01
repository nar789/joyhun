<?php
class Member_block extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change_helper');
		$this->load->library('member_lib');

		admin_check();
	}
	
	function index(){
		$this->block_list();
	}

	//차단회원 리스트
	function block_list(){
			
		$uri_array = $this->seg_exp;
	
		//검색조건
		$data['s_terms'] = $s_terms		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 's_terms')));		//검색조건
		$data['s_val']	 = $s_val		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 's_val')));			//검색값
		
		//레이어팝업 캐시 때문에 랜덤숫자 생성
		$data['block_rand'] = mt_rand(0, 99999);
		
		//페이징 변수
		$data['page'] = $page = $this->pre_paging();
		$data['rp'] = $rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		if(!empty($s_terms) and !empty($s_val)){
			if($s_terms == "대상"){ $search['GUBN_VAL'] = $s_val; }
			if($s_terms == "차단사유"){ $search['ex_data_1'] = "REASON LIKE '".$s_val."%'"; }
			if($s_terms == "관련아이디"){ $search['USER_ID'] = $s_val; }
		}
		
		//차단 리스트 가져오기
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'MEMBER_BLOCK_LIST', 'IDX', 'DESC', '*');

		$data['mlist']			= $result[0];
		$data['getTotalData']	= $result[1];

		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/member_block_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}
	

	//회원 차단 팝업 호출
	function member_block_pop(){
		
		$gubn	 = $this->security->xss_clean(@url_explode($this->seg_exp, 'gubn'));		//구분값
		$user_id = $this->security->xss_clean(@url_explode($this->seg_exp, 'user_id'));		//회원 아이디 
		
		//회원 아이디가 있을경우 회원정보 가져오기
		if(!empty($user_id)){ 
			$mdata = $this->member_lib->get_member($user_id); 
			$member_ip = explode('.', $mdata['last_login_ip']);
		}		
	
		$add_html = "";

		if($gubn == "HP"){
			$add_html .= "<th style='vertical-align:middle;'>대상</th>";
			$add_html .= "<td>";
			$add_html .= "<input type='text' id='V_GUBN_VAL_1' namve='V_GUBN_VAL_1' value='".@$mdata['m_hp1']."' class='width-100' maxlength='3'> - ";
			$add_html .= "<input type='text' id='V_GUBN_VAL_2' namve='V_GUBN_VAL_2' value='".@$mdata['m_hp2']."' class='width-100' maxlength='4'> - ";
			$add_html .= "<input type='text' id='V_GUBN_VAL_3' namve='V_GUBN_VAL_3' value='".@$mdata['m_hp3']."' class='width-100' maxlength='4'>";
			$add_html .= "</td>";
		}else if($gubn == "IP"){
			$add_html .= "<th style='vertical-align:middle;'>대상</th>";
			$add_html .= "<td>";
			$add_html .= "<input type='text' id='V_GUBN_VAL_1' namve='V_GUBN_VAL_1' value='".@$member_ip[0]."' class='width-50' maxlength='3'> . ";
			$add_html .= "<input type='text' id='V_GUBN_VAL_2' namve='V_GUBN_VAL_2' value='".@$member_ip[1]."' class='width-50' maxlength='3'> . ";
			$add_html .= "<input type='text' id='V_GUBN_VAL_3' namve='V_GUBN_VAL_3' value='".@$member_ip[2]."' class='width-50' maxlength='3'> . ";
			$add_html .= "<input type='text' id='V_GUBN_VAL_4' namve='V_GUBN_VAL_4' value='".@$member_ip[3]."' class='width-50' maxlength='3'> ";
			$add_html .= "<input type='checkbox' id='V_IP_CHK' name='V_IP_CHK' value=''onclick='javascript:ip_chk();'> ";
			$add_html .= "0~255대역";
			$add_html .= "</td>";
		}

		$data['add_html'] = $add_html;
		$data['V_GUBN'] = $gubn;

		//view 설정
		$this->load->view('admin/admin_top0_v');
		$this->load->view('admin/service_center/member_block_pop_v', @$data);
		$this->load->view('admin/admin_bottom0_v');

	}


	//회원 차단하기
	function reg_member_block(){

		//변수받기
		$v_gubn			= rawurldecode($this->input->post('v_gubn', true));
		$v_gubn_val_1	= rawurldecode($this->input->post('v_gubn_val_1', true));
		$v_gubn_val_2	= rawurldecode($this->input->post('v_gubn_val_2', true));
		$v_gubn_val_3	= rawurldecode($this->input->post('v_gubn_val_3', true));
		$v_gubn_val_4	= rawurldecode($this->input->post('v_gubn_val_4', true));
		$v_reason		= rawurldecode($this->input->post('v_reason', true));
		$v_user_id		= rawurldecode($this->input->post('v_user_id', true));

		//회사 내부아이피 차단 금지
		if($v_gubn == "IP"){ if($v_gubn_val_1.".".$v_gubn_val_2.".".$v_gubn_val_3 == "192.168.0" or $v_gubn_val_1.".".$v_gubn_val_2.".".$v_gubn_val_3.".".$v_gubn_val_4 == "59.11.70.223"){ echo "1003"; exit; } }
		
		//해당 휴대전화번호 및 아이피를 차단하기전에 전에 차단했는지 체크
		$result = $this->chk_block_cnt($v_gubn, $v_gubn_val_1, $v_gubn_val_2, $v_gubn_val_3, $v_gubn_val_4);

		$rtn1 = $result[0];		//아이피차단여부
		$rtn2 = $result[1];		//아이피대역대차단여부
		$rtn3 = $result[2];		//휴대전화번호 또는 아이파
		$rtn4 = $result[3];		//잘못된접근
		
		if($rtn1 == "1"){ echo "1001"; exit; }		//차단된 아이피
		if($rtn2 == "1"){ echo "1002"; exit; }		//차단된 아이피 대역대
		if(!empty($rtn4)){ echo $rtn4; exit; }		//잘못된 접근

		$v_gubn_val = $rtn3;

		$arrData = array(
			"USER_ID"		=> $v_user_id,
			"GUBN"			=> $v_gubn,
			"GUBN_VAL"		=> $v_gubn_val,
			"REASON"		=> $v_reason,
			"STATUS"		=> '차단',
			"WRITE_DATE"	=> NOW,
			"BLOCK_DATE"	=> '9999-12-31 23:59:59'
		);

		$rtn = $this->my_m->insert('MEMBER_BLOCK_LIST', $arrData);

		//해당 아이피 혹은 휴대전화 번호를 가진 아이디 전부 강제 로그아웃 시키기(latest_helper)
		call_block_member_logout($this->db->insert_id());

		echo $rtn;
		
	}

	//차단 해제 상태 변경하기
	function status_change(){
		
		$idx			= rawurldecode($this->input->post('idx', true));
		$status			= rawurldecode($this->input->post('status', true));

		if(empty($idx) or empty($status)){ echo "1000"; exit; }

		if($status == "해제"){
			$rtn = $this->my_m->update('MEMBER_BLOCK_LIST', array('IDX' => $idx), array('STATUS' => $status, 'WRITE_DATE' => NOW, 'BLOCK_DATE' => NULL));
		}else if($status == "차단"){
			$rtn = $this->my_m->update('MEMBER_BLOCK_LIST', array('IDX' => $idx), array('STATUS' => $status, 'WRITE_DATE' => NOW, 'BLOCK_DATE' => '9999-12-31 23:59:59'));

			//해당 아이피 혹은 휴대전화 번호를 가진 아이디 전부 강제 로그아웃 시키기(latest_helper)
			call_block_member_logout($idx);

		}else{
			echo "1000"; exit; //잘못된접근처리
		}

		echo $rtn;
	}

	//차단내역 삭제
	function block_del(){
		
		$idx = $this->input->post('idx', true);

		if(empty($idx)){ echo "1000"; exit; }		//잘못된접근

		$rtn = $this->my_m->del('MEMBER_BLOCK_LIST', array('IDX' => $idx));

		echo $rtn;
	}

	//해당 대상을 차단전에 체크하기
	function chk_block_cnt($gubn, $val1, $val2, $val3, $val4){
		
		$rtn_4 = "";

		if($gubn == "HP"){
			$gubn_val = $val1."-".$val2."-".$val3;
		}else if($gubn == "IP"){
			$gubn_val = $val1.".".$val2.".".$val3.".".$val4;
		}else{
			$rtn_4 = "1000";
		}

		$cnt_1 = $this->my_m->cnt('MEMBER_BLOCK_LIST', array('GUBN' => $gubn, 'GUBN_VAL' => $gubn_val, 'STATUS' => '차단'));

		if(!empty($val4) and $val4 != "*"){
			$cnt_2 = $this->my_m->cnt('MEMBER_BLOCK_LIST', array('GUBN' => $gubn, 'GUBN_VAL' => $val1.".".$val2.".".$val3.".*", 'STATUS' => '차단'));
		}

		if(@$cnt_1 > 0){ $rtn_1 = "1"; }else{ $rtn_1 = "0"; }
		if(@$cnt_2 > 0){ $rtn_2 = "1"; }else{ $rtn_2 = "0"; }
		
		$rtn_3 = $gubn_val;
		
		//1. 아이피 차단여부 , 2. 아이피 대역대 차단 여부, 3. 휴대전화번호 혹은 아이피, 4.잘못된접근
		return array($rtn_1, $rtn_2, $rtn_3, $rtn_4);
	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */