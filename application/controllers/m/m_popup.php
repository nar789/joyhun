<?php

class M_popup extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('main_m');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');

		$this->fulltv_join	= 'http://api.full.co.kr/asp/join';		//풀티비 회원가입
		$this->fulltv_login = 'http://api.full.co.kr/asp/login';	//풀티비 로그인
		$this->fulltv_code	= 'joyhunting';							//풀티비 서비스코드

		$this->nomotv_join	= 'http://api.nomotv.co.kr/asp/join';		//노모티비 회원가입
		$this->nomotv_login = 'http://api.nomotv.co.kr/asp/login';	//노모티비 로그인
		$this->nomotv_code	= 'joyhunting2';							//노모티비 서비스코드
	}

	function gift_box(){
		//보낸선물함/받은선물함 레이어팝업 열기

		$top_data['add_css'] = array("layer_popup/m_gift_shop_css");
		$top_data['add_js'] = array("layer_popup/m_gift_shop_js");
		$top_data['add_title'] = "선물함";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v',$top_data);
		$this->load->view('layer_popup/gift_box_v',@$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}



	//풀티비 레이어팝업
	function fulltv_layer(){

		$mode = $this->input->post('mode', true);
		
		$data['user_id'] = $user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }
		
		//풀티비 회원가입했는지 여부 확인
		$result = $this->fulltv_register($mode, $user_id);

		$v_gubn		= $result[0];
		$v_mode		= $result[1];
		$v_rtn		= $result[2];
		
		if($v_mode == 2){
			$log_data = $this->my_m->row_array('fulltv_log', array('user_id' => $user_id));
			$log_arr = explode(",", $log_data['log_data']);
			if(count($log_arr) < 5){
				$data['fulltv_id'] = $log_arr[0];
			}else{
				$data['fulltv_id'] = $log_arr[1];
			}			
		}

		//풀티비 회원가입 안했을 경우
		$data['mode'] = $mode;
		
		//이미 풀티비 회원가입을 했을경우
		if($v_gubn == 1){
			echo '9999';
			exit;
		}

		$top_data['add_css'] = array();
		$top_data['add_js'] = array();
		$top_data['add_title'] = "<img src='".IMG_DIR."/layer_popup/fulltv_logo.png' id='fulltv_logo'><b id='fulltv_title'>인터넷방송 간편가입</b>";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top3_v',$top_data);
		$this->load->view('layer_popup/fulltv_layer_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//풀티비 회원가입하기 처리(curl)
	function fulltv_register($mode, $user_id){

		if(empty($mode) or empty($user_id)){ return; }
		
		//회원정보 가져오기 
		$row = $this->member_lib->get_member($user_id);

		//회원가입 여부 확인
		$cnt = $this->my_m->cnt('fulltv_log', array('user_id' => $row['m_userid']));
		
		$token		= $row['m_num'];					//회원번호
		$userip		= $this->input->ip_address();		//회원접속아이피

		$param = 'token='.$token.'&aspCode='.$this->fulltv_code.'&userip='.$userip;

		if($cnt > 0){
			//이미 회원가입이 된경우
			$log_data = $this->my_m->row_array('fulltv_log', array('user_id' => $user_id));
			$url = $this->fulltv_login;
			$gubn = 1;
			$rtn = $url;
		}else{
			//회원가입이 안된 경우(모드2일 경우에만 처리)
			if($mode == 2){

				$ch = curl_init();
				$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;
				curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
				curl_setopt ($ch, CURLOPT_URL, $this->fulltv_join); //접속할 URL 주소
				$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
				curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=".$token."&aspCode=".$this->fulltv_code."&userip=".$userip); // Post 값 Get 방식처럼적는다.
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				// Execute
				$res = curl_exec($ch);
				curl_close ($ch);
				//echo $res;

				//최종 받은 결과 임시로 찍어보기
				$arr = json_decode($res);
				
				//풀티비 회원가입 로그 남기기
				$gubn = 0;
				$rtn = 1;

			}else{
				return;
			}
		}

		return array($gubn, $mode, $rtn);
		
	}

	function fulltv_login_ajax(){

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$row = $this->member_lib->get_member($user_id);

		$arr = array('token' => $row['m_num'], 'aspCode' => $this->fulltv_code, 'popurl' => $this->fulltv_login);

		echo json_encode($arr);
	}




	//노모티비 레이어팝업
	function nomotv_layer(){

		$mode = $this->input->post('mode', true);
		
		$data['user_id'] = $user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }
		
		//노모티비 회원가입했는지 여부 확인
		$result = $this->nomotv_register($mode, $user_id);

		$v_gubn		= $result[0];
		$v_mode		= $result[1];
		$v_rtn		= $result[2];
		
		if($v_mode == 2){
			$log_data = $this->my_m->row_array('nomotv_log', array('user_id' => $user_id));
			$log_arr = explode(",", $log_data['log_data']);
			if(count($log_arr) < 5){
				$data['fulltv_id'] = $log_arr[0];
			}else{
				$data['fulltv_id'] = $log_arr[1];
			}			
		}

		//노모티비 회원가입 안했을 경우
		$data['mode'] = $mode;
		
		//이미 노모티비 회원가입을 했을경우
		if($v_gubn == 1){
			echo '9999';
			exit;
		}

		$top_data['add_css'] = array();
		$top_data['add_js'] = array();
		$top_data['add_title'] = "<img src='".IMG_DIR."/layer_popup/nomotv_logo.png' id='fulltv_logo'><b id='fulltv_title'>인터넷방송 간편가입</b>";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top3_v',$top_data);
		$this->load->view('layer_popup/nomotv_layer_v', @$data);
		$this->load->view('layer_popup/popup_bottom_v');

	}


	//노모티비 회원가입하기 처리(curl)
	function nomotv_register($mode, $user_id){

		if(empty($mode) or empty($user_id)){ return; }

		//회원정보 가져오기 
		$row = $this->member_lib->get_member($user_id);

		//회원가입 여부 확인
		$cnt = $this->my_m->cnt('nomotv_log', array('user_id' => $row['m_userid']));
		
		$token		= $row['m_num'];					//회원번호
		$userip		= $this->input->ip_address();		//회원접속아이피

		$param = 'token='.$token.'&aspCode='.$this->nomotv_code.'&userip='.$userip;

		if($cnt > 0){
			//이미 회원가입이 된경우
			$log_data = $this->my_m->row_array('nomotv_log', array('user_id' => $user_id));
			$url = $this->nomotv_login;
			$gubn = 1;
			$rtn = $url;

		}else{
			//회원가입이 안된 경우(모드2일 경우에만 처리)
			if($mode == 2){

				$ch = curl_init();
				$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;
				curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
				curl_setopt ($ch, CURLOPT_URL, $this->nomotv_join); //접속할 URL 주소
				$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
				curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=".$token."&aspCode=".$this->nomotv_code."&userip=".$userip); // Post 값 Get 방식처럼적는다.
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				// Execute
				$res = curl_exec($ch);
				curl_close ($ch);

				//최종 받은 결과 임시로 찍어보기
				//echo '<meta charset="UTF-8"/>';
				//$arr = json_decode($res);
				//print_r($arr);
				//exit;

				//최종 받은 결과 임시로 찍어보기
				$arr = json_decode($res);
				
				//풀티비 회원가입 로그 남기기
				$gubn = 0;
				$rtn = 1;

			}else{
				return;
			}
		}

		return array($gubn, $mode, $rtn);
		
	}

	function nomotv_login_ajax(){

		$user_id = @$this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		$row = $this->member_lib->get_member($user_id);

		$arr = array('token' => $row['m_num'], 'aspCode' => $this->nomotv_code, 'popurl' => $this->nomotv_login);

		echo json_encode($arr);
	}

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */ 