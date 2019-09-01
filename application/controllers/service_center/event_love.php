<?php

class Event_love extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
	}

	function index(){
		$this->love_event();
	}

	function love_event(){	
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}
		
		if(IS_MOBILE == true){
			//모바일버전의 경우

			$this->load->library('m_top_menu_lib');
			
			//view 설정
			$top_data['add_css'] = array("/m/m_event_css");
			$top_data['add_js'] = array("/m/m_event_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"야외데이트 이벤트"); //탑메뉴 로딩
		
			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/event/m_event_love_v', @$data);
			$this->load->view('m/m_bottom0_v');

		}else{
			//PC버전의 경우

			//view 설정
			$navs = array('홈','고객센터','이벤트'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

			$top_data['add_css'] = array("service_center/service_css");
			$top_data['add_js'] = array("service_center/stamp_js");

			$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩
			
			$this->load->view('top_v',$top_data);			
			$this->load->view('service_center/event_love_v',$data);
			$this->load->view('bottom_v');

		}
		
	}
	
	//데이트 이벤트 신청하기 레이어팝업
	function event_love_layer(){

		//user_check
		user_check(null, 5, null);
		
		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ alert_goto('로그인 후 이용 가능합니다.', '/'); }

		//회원 데이터 가져오기
		$mdata = $this->member_lib->get_member($user_id);

		//회원 등록 사진 갯수 가져오기
		$pic_cnt = $this->my_m->cnt('member_pic', array('user_id' => $user_id, 'pic_status' => '인증완료'));

		if($pic_cnt > 3){
			$data['pic_cnt'] = 3;
		}else{
			$data['pic_cnt'] = $pic_cnt;
		}

		//이미 접수한 이력이 있을경우 접수한 데이터 가져오기
		$event_data = $this->my_m->row_array('event_love_list', array('user_id' => $user_id), 'idx', 'desc', '1');
		
		//이미접수한 데이터가 있을경우 데이터 불러오기 없을경우 회원데이터가져오기
		if(!empty($event_data)){
			$data['age']			= $event_data['age'];
			$data['conregion']		= $event_data['conregion'];
			$data['conregion2']		= $event_data['conregion2'];
			$data['hp1']			= $event_data['hp1'];
			$data['hp2']			= $event_data['hp2'];
			$data['hp3']			= $event_data['hp3'];
			$data['intro']			= $event_data['intro'];
		}else{
			$data['age']			= $mdata['m_age'];
			$data['conregion']		= $mdata['m_conregion'];
			$data['conregion2']		= $mdata['m_conregion2'];
			$data['hp1']			= $mdata['m_hp1'];
			$data['hp2']			= $mdata['m_hp2'];
			$data['hp3']			= $mdata['m_hp3'];
			$data['intro']			= null;
		}

		//view 설정
		$top_data['add_css'] = array("");
		$top_data['add_js'] = array("layer_popup/event_love_js");
		$top_data['add_title'] = "데이트 이벤트 신청하기";
		$top_data['add_text'] = "";

		//추가스크립트(기본 지역 셋팅)
		$data['add_script'] = "
		<script type='text/javascript'>
			$(document).ready(function(){
				$('#conregion').val('".$data['conregion']."');
				area_select($('#conregion').val(), 'conregion2');
				$('#conregion2').val('".$data['conregion2']."');
			});
		</script>
		";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('m/event/m_event_love_layer_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');
	}

	//데이트 참여하기 저장 함수
	function user_join_date(){
		
		$age		= rawurldecode($this->input->post('age', true));			//나이
		$conregion	= rawurldecode($this->input->post('conregion', true));		//지역1
		$conregion2 = rawurldecode($this->input->post('conregion2', true));		//지역2
		$hp1		= rawurldecode($this->input->post('hp1', true));			//휴대폰번호1
		$hp2		= rawurldecode($this->input->post('hp2', true));			//휴대폰번호2
		$hp3		= rawurldecode($this->input->post('hp3', true));			//휴대폰번호3

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		//회원 등록 사진 갯수 가져오기(한번 더 검사하기)
		$pic_cnt = $this->my_m->cnt('member_pic', array('user_id' => $user_id, 'pic_status' => '인증완료'));
		if($pic_cnt == 0){ echo "1001"; exit; }

		$arrData = array(
			"user_id"			=> $user_id,
			"age"				=> $age,
			"conregion"			=> $conregion,
			"conregion2"		=> $conregion2,
			"hp1"				=> $hp1,
			"hp2"				=> $hp2,
			"hp3"				=> $hp3,
			"write_date"		=> NOW
		);

		//이미 신청을 한적이 있는지 체크
		$cnt = $this->my_m->cnt('event_love_list', array('user_id' => $user_id));

		if($cnt > 0){
			$rtn = $this->my_m->update('event_love_list', array('user_id' => $user_id), $arrData);
		}else{
			$rtn = $this->my_m->insert('event_love_list', $arrData);
		}

		echo $rtn;
	}

	//자기소개 업데이트 처리
	function user_join_intro(){

		$intro = rawurldecode($this->input->post('intro', true));

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$rtn = $this->my_m->update('event_love_list', array('user_id' => $user_id), array('intro' => $intro, 'write_date' => NOW));

		echo $rtn;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/

