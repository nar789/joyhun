<?php 

class Hp_cert_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('sms_lib');
	}

	//휴대폰 본인인증 결과처리
	function hp_cert_result($retInfo){

		/************************************************************************************/
		/* - sample 페이지에서 요청 시 쿠키에 저장한 Reqnum값을 가져와서 IV값에 셋팅   	    */
		/* - 쿠키 만료시간 경과 후 결과처리 못함										    */
		/************************************************************************************/
		//01. 쿠키값 확인
		$iv = "";
		if (get_cookie('REQNUM')) {
			$iv = get_cookie('REQNUM'); 
			//쿠키 삭제
			//setcookie("REQNUM", "", time()-600);
			delete_cookie('REQNUM');
		}else{
			alert_close('세션이 만료되었습니다.!!');
		}

		// 파라메터로 받은 요청결과
		$enc_retInfo = $retInfo;	

		//02. 요청결과 복호화
		//2014.02.07 KISA 권고사항
		//위 변조 및, 불법 시도 차단을 위하여 아래 패턴에 해당하는 문자열만 허용
		if(preg_match('~[^0-9a-zA-Z+/=^]~', $iv, $matches)||preg_match('~[^0-9a-zA-Z+/=^]~', $enc_retInfo, $matches)){
			alert_close('입력 값 확인이 필요합니다.(res-1)');
		}
		$dec_retInfo = exec("/opt/SciSecurity/SciSecuX SEED 2 0 $iv $enc_retInfo ");//암호화모듈 설치시 생성된 SciSecuX 파일이 있는 리눅스 경로를 설정해주세요.
		
		//데이터 조합 : "본인확인1차암호화값/위변조검증값/암복화확장변수"
		$totInfo = split("\\^", $dec_retInfo);

		$encPara  = $totInfo[0];		//본인확인1차암호화값
		$encMsg   = $totInfo[1];		//암호화된 통합 파라미터의 위변조검증값
		
		
		//03. 위변조검증값 생성
		//2014.02.07 KISA 권고사항
		//위 변조 및, 불법 시도 차단을 위하여 아래 패턴에 해당하는 문자열만 허용
		if(preg_match('~[^0-9a-zA-Z+/=^]~', $encPara, $matches)){
			alert_close('입력 값 확인이 필요합니다.(res-2)');
		}
		$hmac_str = exec("/opt/SciSecurity/SciSecuX HMAC 1 0 $encPara ");

		if($hmac_str != $encMsg){
			alert_close('비정상적인 접근입니다.!!');
		}

		//04. 본인확인1차암호화값 복호화
		//2014.02.07 KISA 권고사항
		//위 변조 및, 불법 시도 차단을 위하여 아래 패턴에 해당하는 문자열만 허용
		if(preg_match('~[^0-9a-zA-Z+/=^]~', $iv, $matches)||preg_match('~[^0-9a-zA-Z+/=^]~', $encPara, $matches)){
			alert_close('입력 값 확인이 필요합니다.(res-3)');
		}
		$decPara = exec("/opt/SciSecurity/SciSecuX SEED 2 0 $iv $encPara ");

		//05. 파라미터 분리
		$split_dec_retInfo = split("\\^", $decPara);

		$name		= $split_dec_retInfo[0];		//성명
		$birYMD		= $split_dec_retInfo[1];		//생년월일
		$sex		= $split_dec_retInfo[2];		//성별
		$fgnGbn		= $split_dec_retInfo[3];		//내외국인 구분값
		$di			= $split_dec_retInfo[4];		//DI
		$ci1		= $split_dec_retInfo[5];		//CI1
		$ci2		= $split_dec_retInfo[6];		//CI2	
		$civersion	= $split_dec_retInfo[7];		//CI Version
		$reqNum		= $split_dec_retInfo[8];		//요청번호
		$result		= $split_dec_retInfo[9];		//본인확인 결과 (Y/N)
		$certGb		= $split_dec_retInfo[10];		//인증수단
		$cellNo		= $split_dec_retInfo[11];		//핸드폰 번호
		$cellCorp	= $split_dec_retInfo[12];		//이동통신사
		$certDate	= $split_dec_retInfo[13];		//검증시간
		$addVar		= $split_dec_retInfo[14];		//추가 파라메터

		//예약 필드
		$ext1		= $split_dec_retInfo[15];
		$ext2		= $split_dec_retInfo[16];
		$ext3		= $split_dec_retInfo[17];
		$ext4		= $split_dec_retInfo[18];
		$ext5		= $split_dec_retInfo[19];

		$v_addVar = split("\\++", $addVar);
		
		$mode = $v_addVar[0];			//모드(1.비회원, 2.회원)
		$userid = $v_addVar[1];			//아이디
		
		if(empty($mode) or empty($userid)){
			alert_close('비정상적인 접근입니다.!!');
		}

		//휴대전화 번호 자르기
		if (strlen($cellNo) == "11"){
			$m_hp1 = substr($cellNo, 0, 3);
			$m_hp2 = substr($cellNo, 3, 4);
			$m_hp3 = substr($cellNo, 7, 4);
		}else{
			$m_hp1 = substr($cellNo, 0, 3);
			$m_hp2 = substr($cellNo, 3, 3);
			$m_hp3 = substr($cellNo, 6, 4);
		}

		//생년월일 자르기
		$regi_birth_year = substr($birYMD, 0, 4);
		$regi_birth_month = substr($birYMD, 4, 2);
		$regi_birth_day	= substr($birYMD, 6, 2);
		
		//로그 array데이터
		$log_arr_data = array(
			"m_userid"			=> $userid,
			"m_name"			=> iconv("EUC-KR", "UTF-8", $name),
			"m_sex"				=> $sex,
			"m_birth"			=> $birYMD,
			"m_local"			=> $fgnGbn,
			"m_hp1"				=> $m_hp1,
			"m_hp2"				=> $m_hp2,
			"m_hp3"				=> $m_hp3,
			"m_news"			=> $cellCorp,
			"m_gubn"			=> $mode,
			"m_gubn2"			=> $certGb,
			"m_result"			=> $result,
			"m_writedate"		=> NOW
		);

		$block_list = $this->ci->my_m->row_array('MEMBER_BLOCK_LIST', array('GUBN' => 'HP', 'GUBN_VAL' => $m_hp1."-".$m_hp2."-".$m_hp3, 'STATUS' => '차단'), 'IDX', 'DESC', '1');

		if(!empty($block_list)){
			$mode = "block";
		}
				
		if($mode == "1"){
		//비회원 인증일경우
			if($result == "Y"){
			//인증성공
				
				// 미성년자검사
				$now_y = date('Y');
				$chk_age = $now_y - $regi_birth_year+1;

				if ($chk_age < 20){
					// 세션 있으면 삭제
					if(@$this->ci->session->userdata['regi_id']){
						$this->ci->session->sess_destroy();
					}
					return array("false", '4');
					exit;
				}
				
				//임시세션추가(이름, 출생년도, 월, 일, 성별)
				$m_session = $this->ci->session->set_userdata(array(		
					"regi_user_name"		=> iconv("EUC-KR", "UTF-8", $name),
					"regi_birth_year"		=> $regi_birth_year,
					"regi_birth_month"		=> $regi_birth_month,
					"regi_birth_day"		=> $regi_birth_day
					//"regi_sex"				=> $sex
				));
				
				$regi_sex = $this->ci->session->userdata['regi_sex'];
				
				//비회원 회원가입	
				if (!is_null($data = $this->ci->tank_auth->create_user())) {						//회원가입성공

					$arr_data = array(
						"m_hp1"	=> $m_hp1,
						"m_hp2"	=> $m_hp2,
						"m_hp3"	=> $m_hp3,
						"m_mobile_chk" => "1"
					);

					//여성회원이 본인인증을 할경우 바로 정회원 처리
					if($regi_sex == "F"){
						$arr_data['m_type'] = "V";
					}

					$search['m_userid'] = $userid;

					$member_hp_update = $this->ci->my_m->update('TotalMembers', $search, $arr_data);	//회원 테이블 업데이트

					//인증완료후 세션추가
					$member_data = $this->ci->my_m->row_array('TotalMembers', array('m_userid' => $userid));
					$this->ci->session->set_userdata(array(
						'm_mobile_chk'		=> $member_data['m_mobile_chk'],
						'm_type'			=> $member_data['m_type']
					));

					//비회원 회원가입후 임시회원테이블내역 삭제처리
					$reg_mem = $this->ci->my_m->row_array('reg_member', array('userid' => $this->ci->session->userdata['m_userid']));
					
					if(!empty($reg_mem)){
						$this->ci->my_m->del('reg_member', array('userid' => $this->ci->session->userdata['m_userid']));
					}

					//get_coordination_member($this->ci->session->userdata['m_userid']);		//회원가입시 선택한 지역에 따른 맵 좌표 생성(latest_helper)
										
					$my_phone = $m_hp1."-".$m_hp2."-".$m_hp3;
					$sms_msg = "조이헌팅입니다.\n회원가입을 축하드립니다.\nwww.joyhunting.com";
					$this->ci->sms_lib->sms_send("#1470", array($my_phone), $sms_msg);		//회원가입메세지보내기
					reg_member_msg_log($this->ci->session->userdata['m_userid']);			//로그남기기					

				}else{
					$this->ci->session->sess_destroy();
					alert_close("회원가입에 실패하였습니다. 고객센터로 문의주시기 바랍니다.");
				}

				$phone_chk_log = $this->ci->my_m->insert('member_confirm_log', $log_arr_data);		//로그		
				return array("true", $mode);
			}else{
			//인증실패	
				$phone_chk_log = $this->ci->my_m->insert('member_confirm_log', $log_arr_data);		//로그		
				return array("false", $mode);
			}
		}else if($mode == "2"){
		//회원 인증일경우		
			if(!IS_LOGIN){
				alert_close("회원만 이용가능합니다.");
			}

			if($result == "Y"){
			//인증성공
				$arr_data = array(
					"m_hp1"	=> $m_hp1,
					"m_hp2"	=> $m_hp2,
					"m_hp3"	=> $m_hp3,
					"m_mobile_chk" => "1",
					"m_mobile_chke_date" => NOW
				);

				// 미성년자검사
				$now_y = date('Y');
				$chk_age = $now_y - $regi_birth_year+1;

				if ($chk_age < 20){
					return array("false", '4');
					exit;
				}

				//여성회원이 본인인증을 할경우 바로 정회원 처리
				if($this->ci->session->userdata['m_sex'] == "F"){
					$arr_data['m_type'] = "V";
				}
				
				$search['m_userid'] = $userid;

				//가입한 본인 이름체크
				if(iconv("EUC-KR", "UTF-8", $name) <> $this->ci->session->userdata['m_name']){
					alert_close('회원가입하신 아이디 명의와 일치하지 않습니다.');
				}

				$member_hp_update = $this->ci->my_m->update('TotalMembers', $search, $arr_data);	//회원 테이블 업데이트
				
				//인증완료후 세션추가
				$member_data = $this->ci->my_m->row_array('TotalMembers', array('m_userid' => $userid));
				$this->ci->session->set_userdata(array(
					'm_mobile_chk'		=> $member_data['m_mobile_chk'],
					'm_type'			=> $member_data['m_type']
				));

				$phone_chk_log = $this->ci->my_m->insert('member_confirm_log', $log_arr_data);		//로그		
				return array("true", $mode);
				
			}else{
			//인증실패
				$phone_chk_log = $this->ci->my_m->insert('member_confirm_log', $log_arr_data);		//로그		
				return array("false", $mode);
			}
		}else if($mode == "3"){


			// 미성년자검사
			$now_y = date('Y');
			$chk_age = $now_y - $regi_birth_year+1;

			if ($chk_age < 20){
				return array("false", '4');
				exit;
			}


			if($result == "Y"){

				$arr_data = array(
					"m_userid"	    => $userid,
					"m_hp1"			=> $m_hp1,
					"m_hp2"			=> $m_hp2,
					"m_hp3"			=> $m_hp3
				);

				$search['m_userid'] = $userid;

				//가입한 본인 이름체크
				if(iconv("EUC-KR", "UTF-8", $name) <> $this->ci->session->userdata['name']){
					alert_close('회원가입하신 아이디 명의와 일치하지 않습니다.');
				}

				$member_hp_update = $this->ci->my_m->update('TotalMembers', $search, $arr_data);	//회원 테이블 업데이트
				return array("true", $mode);

			}else{

				return array("false", $mode);

			}
		}else if($mode == "block"){
			//차단된 휴대전화번호가 있는경우
			return array("block", $block_list['IDX']);
		}


	}	

	//휴대폰 본인인증 데이터 암호화
	function hp_cert_enc($mode, $userid, $dorm =''){

		$CurTime = date('YmdHis');  //현재 시각 구하기
		$RandNo = rand(100000, 999999);	//6자리 랜덤값 생성
		
		//현재도메인에 따라 본인인증 아이디/시리얼번호 바꾸기
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { 
			//현재 HTTPS일때
			if(IS_MOBILE == true){  
				//모바일일때 회원가입 인증
				$id			= "SANJ001";
				$srvNo		= "011001";
			}else{
				//WEB일때 회원가입 인증
				$id			= "SANJ001"; 
				$srvNo		= "005004";	
			}	
		}else{
			//현재 HTTP일때
			if(IS_MOBILE == true){  
				//모바일일때 회원가입 인증
				$id			= "SANJ001";
				$srvNo		= "004009";
			}else{
				//WEB일때 회원가입 인증
				$id			= "SANJ001"; 
				$srvNo		= "001014";	
			}	
		}
			
		$reqNum		= $CurTime.$RandNo;
		$certDate	= $CurTime;
		$certGb		= "H";
		$addVar		= $mode."++".$userid;
		//$retUrl		= "32http://www.joyhunting.net/test/phone_test/pcc_V3_popup_seed.php";

		/************************************************************************************/
		/* reqNum 값은 최종 결과값 복호화를 위한 SecuKey로 활용 되므로 중요합니다.			*/
		/* reqNum 은 본인 확인 요청시 항상 새로운 값으로 중복 되지 않게 생성 해야 합니다.	*/
		/* 쿠키 또는 Session및 기타 방법을 사용해서 reqNum 값을								*/
		/* vname_result_seed.php에서 가져 올 수 있도록 해야 함.								*/
		/* 샘플을 위해서 쿠키를 사용한 것이므로 참고 하시길 바랍니다.						*/
		/************************************************************************************/
		//01. reqNum 쿠키 생성
		//setcookie("REQNUM", $reqNum, time()+600);
		$cookie = array(
			"name" => "REQNUM",
			"value" => $reqNum,
			"expire" => time()+600
		);

		set_cookie($cookie);

		$exVar       = "0000000000000000";        // 확장임시 필드입니다. 수정하지 마세요..

		//02. 암호화 파라미터 생성
		$reqInfo = $id . "^" . $srvNo . "^" . $reqNum . "^" . $certDate . "^" . $certGb . "^" . $addVar . "^" . $exVar;
		
		//03. 본인확인 요청정보 1차암호화
		$iv = "";
		//2014.02.07 KISA 권고사항
		//위 변조 및, 불법 시도 차단을 위하여 아래 패턴에 해당하는 문자열만 허용	
		if(preg_match('~[^0-9a-zA-Z+/=^]~', $reqInfo, $matches)){
			echo "입력 값 확인이 필요합니다.(req)"; exit;
		}
		$enc_reqInfo = exec("/opt/SciSecurity/SciSecuX SEED 1 1 $reqInfo ");//암호화모듈 설치시 생성된 SciSecuX 파일이 있는 리눅스 경로를 설정해주세요.

		//04. 요청정보 위변조검증값 생성
		$hmac_str = exec("/opt/SciSecurity/SciSecuX HMAC 1 1 $enc_reqInfo ");

		//05. 요청정보 2차암호화
		//데이터 생성 규칙 : "요청정보 1차 암호화^위변조검증값^암복화 확장 변수"
		$enc_reqInfo = $enc_reqInfo. "^" .$hmac_str. "^" ."0000000000000000";
		$enc_reqInfo = exec("/opt/SciSecurity/SciSecuX SEED 1 1 $enc_reqInfo ");
		
		return $enc_reqInfo;

	}

}
?>
