<?php

class Hp_cert extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	
		$this->load->helper('cookie');
		$this->load->helper('partner_helper');
		$this->load->library('tank_auth');
		$this->load->library('hp_cert_lib');
		
	}

	
	//휴대전화 인증
	function phone_chk(){

		$mode			= rawurldecode($this->input->post('mode', true));			//모드(1.비회원, 2.회원)
		$userid			= rawurldecode($this->input->post('userid', true));			//아이디

		$rtn = $this->hp_cert_lib->hp_cert_enc($mode,$userid);

		echo $rtn;
		
	}

	//임시팝업
	function phone_pop(){

		$mode		= $this->security->xss_clean($_REQUEST['mode']);
		$userid		= $this->security->xss_clean($_REQUEST['userid']);

		$top_data['add_js'] = array("etc/hp_cert_js");
		
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { //현재 HTTPS일때
			$add_https = "set_https();";
		}else{
			$add_https = "set_http();";
		}

		$bot_data['add_script'] = "
		<script>
			$(document).ready(function(){
				$add_https;
				hp_cert('".$mode."', '".$userid."');
			});
		</script>";

		$this->load->view('top0_v', $top_data);
		$this->load->view('bottom0_v', $bot_data);
	}

	//결과페이지
	function phone_result(){
		
		//결과값 반환 array
		//0 : 본인인증 성공 여부 (true or false) 반환
		//1 : 구분값 반환 (1 : 비회원 본인인증, 2 : 회원 본인인증, 3 : 미성년자 체크)
		$rtn = $this->hp_cert_lib->hp_cert_result($_REQUEST["retInfo"]);

		if($rtn[0] == "true"){

			//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
			if(!empty($this->session->userdata['m_partner']) and !empty($this->session->userdata['m_partner_code'])){
				partner_send_curl('AUTH', $this->session->userdata['m_userid'], null);
			}

			//성공
			$bot_data['add_script'] = "
			<a href='/etc/app/close'>Close</a>
			<script>
			$(document).ready(function(){
				hp_cert_result('Y', '".$rtn[1]."');
			});
			</script>";
		}else if($rtn[0] == "block"){
		
			$bot_data['add_script'] = "
			<a href='/etc/app/close'>Close</a>
			<script type='text/javascript'>
			$(document).ready(function(){
				$(location).attr('href', '/service_center/member_block/block_popup_layer/idx/".$rtn[1]."/reg_hp/ok');
			});
			</script>";

		}else{
			//실패
			$bot_data['add_script'] = "<script>
			$(document).ready(function(){
				hp_cert_result('N', '".$rtn[1]."');
			});
			</script>";
		}

		$top_data['add_js'] = array("etc/hp_cert_js");

		$this->load->view('top0_v', $top_data);
		$this->load->view('bottom0_v', $bot_data);
		
		
	}

	

	

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */