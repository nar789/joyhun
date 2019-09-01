<?php 
	
	//파트너 관련 헬퍼
	
	//파트너 아이디 복호화
	function partner_cookie_data($partner = null){

		if(empty($partner)){
			return "joyHunting";
		}else{
			$PARTNER_CODE_KEY = "AETelr$5gj84g5edgQ$#G%@#K$#5t;k3!DG";
			return decrypt($partner, $PARTNER_CODE_KEY);
		}	
		
	}
	
	//base64 암호화
	function encrypt($string, $key) {
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	}
	
	//base64 복호화
	function decrypt($string, $key) {
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	
	//파트너 페이지로 보내기전 암호화
	function aes_encrypt($plaintext, $password) { 
		$password = hash('sha256', $password, true); 
		$plaintext = gzcompress($plaintext); 
		$iv_source = defined('MCRYPT_DEV_URANDOM') ? MCRYPT_DEV_URANDOM : MCRYPT_RAND; 
		$iv = mcrypt_create_iv(32, $iv_source); 
		$ciphertext = mcrypt_encrypt('rijndael-256', $password, $plaintext, 'cbc', $iv); 
		$hmac = hash_hmac('sha256', $ciphertext, $password, true); 
		return urlencode(base64_encode($ciphertext . $iv . $hmac)); 
	} 


	//회원가입일때 : JOIN|파트너아이디|광고코드|회원아이디|아이피|성별|가입일시
	//인증일때 : AUTH|파트너아이디|광고코드|회원아이디|아이피|성별|가입일시
	//결제일때 : PAY|회원아이디|결제일시|결제금액

	//파트너 페이지로 보내기(세션에 파트너 아이디와 광고코드가 있을경우만 넘겨줄것)
	function partner_send_curl($mode, $user_id, $tid = null){
		
		$now =  date('Y-m-d H:i:s');

		$CI =& get_instance();
		$CI->load->model('my_m');
		$CI->load->library('member_lib');		
		
		//$CI->my_m->insert('partner_log', array('user_id' => @$user_id, 'plaintext' => '', 'write_date' => @$now, 'result' => '파트너 가입시작'));

		$m_data = $CI->member_lib->get_member($user_id);
		
		$plaintext = "";		//파트너페이지로 보낼 데이터변수 초기화

		if($mode == "PAY"){
			//결제의 경우(mode 값이 PAY)
			if(is_null($tid)){
				//파트너회원 결제인데 결제번호가 없을경우 예외처리
				$plaintext = "error";
			}else{
				$pay_data = $CI->my_m->row_array('payment_temp', array('m_tradeid' => $tid, 'm_card_ok' => 'Y', 'ex_m_cancel' => 'm_cancel is null'));
				if(!empty($pay_data)){ $plaintext = $mode."|".$m_data['m_userid']."|".$pay_data['m_okdate']."|".$pay_data['m_price']; }else{ $plaintext = "error"; }
			}			
			
		}else{
			//회원가입 또는 본인인증의 경우(mode 값이 회원가입 : JOIN, 본인인증 AUTH)
			$plaintext = $mode."|".$m_data['m_partner']."|".$m_data['m_partner_code']."|".$m_data['m_userid']."|".$m_data['m_ip']."|".$m_data['m_sex']."|".$m_data['m_in_date'];
		}

		if($plaintext <> "error" and !empty($plaintext)){
			//데이터 암호화
			$enc = aes_encrypt($plaintext, "joyhunting1234");
			
			//파트너서버로 데이터 보내기
			$cu = curl_init();
			curl_setopt($cu, CURLOPT_URL, "http://partner.joyhunting.com/member_input.php?q=$enc");
			curl_setopt($cu, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cu, CURLOPT_HEADER, false);
			curl_setopt($cu, CURLOPT_TIMEOUT,100);
			$output = curl_exec($cu);
			curl_close($cu); 
			
			//로그남기기
			$log_data = array(
				"user_id"		=> $user_id,				//회원 아이디
				"plaintext"		=> $plaintext,				//데이터
				"write_date"	=> $now,					//시도날짜
				"result"		=> $output					//결과값
			);
			
			//로그 insert
			$CI->my_m->insert('partner_log', $log_data);			
		}

	}

?>