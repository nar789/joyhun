<?php
//본인인증(페이레터)
class Name_check extends MY_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('tank_auth');
		$this->load->library('payment_lib');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('partner_helper');
		
		//내부만 열기
		//if($_SERVER['REMOTE_ADDR'] <> "14.47.36.51" and $_SERVER['REMOTE_ADDR'] <> "59.11.70.223"){ exit; }
	}	

	function index(){
		
		if($_SERVER['REMOTE_ADDR'] <> "14.47.36.51" and $_SERVER['REMOTE_ADDR'] <> "59.11.70.223"){ exit; }

		$this->load->view('top0_v');
		$this->load->view('etc/test_v');
		$this->load->view('bottom0_v');
	}
	
	//본인인증 요청페이지
	function name_check_request(){
		
		//비회원의 경우 회원가입시 -> 본인인증
		//회원의 경우 정보수정시 -> 본인인증

		$mode = 1;								//기본 비회원 셋팅 $mode = 1
		if(IS_LOGIN == true){ $mode = 2; }		//회원일경우 $mode값 변경

		//휴면회원 인증일 경우($mode값 변경 3)
		if(empty($this->session->userdata['regi_id']) and empty($this->session->userdata['m_userid'])){ $mode = 3; }
		
		if($mode == 1){
			$user_id	= $this->session->userdata['regi_id'];	//비회원일경우
			$reg_gubn	= "00";									//회원가입코드
		}else if($mode == 2){
			$user_id	= $this->session->userdata['m_userid'];	//회원일경우
			$reg_gubn	= "02";									//정보수정코드
		}else if($mode == 3){
			$user_id	= $this->session->userdata['user'];		//휴면회원일경우
			$reg_gubn	= "02";	
		}else{
			$user_id = "";		//잘못된 접근
		}

		if(empty($user_id)){ exit; }

		$return_url = "http://".$_SERVER['HTTP_HOST']."/etc/name_check/name_check_result";			//결과페이지
		$etcparam = "mode|".$mode;		//추가파라미터
		
		$key_value = $this->key_value();		//모듈관련 (0:keyid, 1:pvkey, 2:keyver, 3:cliendt_id)
			
		// 암호화 키 관련 Property 추가
		$this->payment_lib->SetKey($key_value[1]);
		$this->payment_lib->SetKeyID($key_value[0]);
		$this->payment_lib->SetKeyVer($key_value[2]);

		// 필수 설정 데이터
		$this->payment_lib->SetParam("userid",     $user_id);			// 사용자아이디
		$this->payment_lib->SetParam("clientid",   $key_value[3]);		// 고객사아이디 (페이레터에서 부여한 아이디)
		$this->payment_lib->SetParam("amt",        "0");				// 결제금액
		$this->payment_lib->SetParam("returnurl",  $return_url);		// 결제후 결과를 나타내주는 페이지 URL

		$this->payment_lib->SetParam("svcnm",      "본인인증");			// 결제서비스명
		$this->payment_lib->SetParam("backurl",    "");					// "돌아가기"클릭시 돌아가는 페이지 URL(오픈창일경우 공백으로)

		// 선택 설정 데이터
		$this->payment_lib->SetParam("ordno",      "");					// "주문번호"
		$this->payment_lib->SetParam("ordnm",      "");					// "사용자명"
		$this->payment_lib->SetParam("pname",      "");					// "결제상품명"
		$this->payment_lib->SetParam("etcparam",   $etcparam);			// "기타정보" (필요한 정보를 설정하면 되돌려줍니다.)
		$this->payment_lib->SetParam("emailstate", "0");				// 결제 내역 메일 수신여부(0:미사용, 1:사용)

		// 노티 설정 데이터
		$this->payment_lib->SetParam("noti",       "0");				// 노티 방식 사용 여부(0: 미사용, 1: 사용)
		$this->payment_lib->SetParam("notiurl",    "");					// 결제 결과를 수신할 노티 URL(가상계좌(DacomVacct)와 스마트폰용 가상계좌(SmartDacomVaccount) 사용시 노티사용 필수)

		//------------------------------------------------------------
		// Description   : 결제 수단별 파라미터 및 페이지 세팅
		//------------------------------------------------------------	

		$this->payment_lib->SetParam("sitedomain", "");					// 회원사 도메인. (휴대폰인증번호 발송시 제휴사명에 노출)
		$this->payment_lib->SetParam("rqstcauscd", $reg_gubn);			// 인증요청사유코드 2byte  (00:회원가입, 01:성인인증, 02:회원정보수정, 03:비밀번호찾기, 04:상품구매, 99:기타)
		$strPGHostURL = "KCBAuth/AuthForm.asp";		

		//------------------------------------------------------------
		// Description   : 해당 결제창으로 이동
		//------------------------------------------------------------
		// 모든 데이터가 설정되었고, 설정된 문자열이 암호화가 되었으므로 실제 결제 페이지로 보낸다.
		// 페이레터에서 알려주는 실제로 결제할 URL, 변경불가!!
		// 실제 결제가 됩니다. 테스트를 하고 관리자 페이지(http://pg1.payletter.com:9999)에서 취소할 수 있습니다.

		$EncryptedData = $this->payment_lib->Encrypt();

		user_auth_log_chk('1', $user_id, null);
		
		// POQ 결제페이지로 이동
		$strPayUrl = "https://pg1.payletter.com/PGSVC/" . $strPGHostURL . "?clientparam=" . $EncryptedData;
		echo ("<SCRIPT LANGUAGE='JavaScript'>location.href='$strPayUrl';</SCRIPT>");

	}

	//본인인증 결과페이지
	function name_check_result(){
		
		//결제관련 key값 가져오기(0:아이디, 1:키, 2:키버전, 3:고객사아이디)
		$key_value = $this->key_value();

		// 암호화 키 관련 Property 추가
		$this->payment_lib->SetKey($key_value[1]);
		$this->payment_lib->SetKeyID($key_value[0]);
		$this->payment_lib->SetKeyVer($key_value[2]);

		//--페이레터의 암호화된 결제결과(clientparam)을 받아서 resultparam에 설정한다.
		$this->payment_lib->SetParam("resultparam", $_REQUEST["clientparam"]);

		//-------------------------------------------------------------
		// Name				: SetDataFunc
		// Description		: 결제 결과 정보 세팅
		//                   - 고객사에서 아래 결제 정보를 DB에 저장해 놓으시면 됩니다. 
		//                   - 아래 정보들을 디버깅성으로 파일로그를 남겨놓으시기를 권고 드립니다.
		//-------------------------------------------------------------

		$user_id	  = $this->payment_lib->GetParam("userid");		//--사용자ID
		$strOrdNm     = $this->payment_lib->GetParam("ordnm");		//--사용자명
		$strOrdNo     = $this->payment_lib->GetParam("ordno");		//--주문번호
		$strSvcNm     = $this->payment_lib->GetParam("svcnm");		//--결제서비스명
		$strPName     = $this->payment_lib->GetParam("pname");		//--결제상품명

		$strEtcParam  = $this->payment_lib->GetParam("etcparam");	//--제휴사 기타 설정 값
		$strResult	  = $this->payment_lib->GetParam("result");		//결과값
		
		user_auth_log_chk('4', $user_id, $strResult);

		if($strResult == "OK"){

			//본인인증시 추가 변수 받기
			$name		  = $this->payment_lib->GetParam("payername");		//이름
			$hptele		  = $this->payment_lib->GetParam("paytoolname");	//휴대전화번호
			$mobileco	  = $this->payment_lib->GetParam("mobileco");		//통신사(01:SKT, 02:KT, 03:LG, 04:ETC)
			$birth		  = $this->payment_lib->GetParam("authbirth");		//가입자 생년월일
			$sex		  = $this->payment_lib->GetParam("authgender");		//성별(0:여성, 1:남성)
			$nation		  = $this->payment_lib->GetParam("authnation");		//내외국인 구불(0:내국인, 1:외국인)

			$etc_param = explode("|", $strEtcParam);
			$mode = $etc_param[1];
			
			//생년월일 자르기
			$m_year		= substr($birth, 0, 4);		//년
			$m_month	= substr($birth, 4, 2);		//월
			$m_day		= substr($birth, 6, 2);		//일
			
			//휴대전화번호 자르기
			if(strlen($hptele) == "11"){
				//기본 현행 11자리의 경우
				$m_hp1 = substr($hptele, 0, 3);		//휴대폰번호1
				$m_hp2 = substr($hptele, 3, 4);		//휴대폰번호2
				$m_hp3 = substr($hptele, 7, 4);		//휴대폰번호3
			}else{
				//과거 10자리의 경우
				$m_hp1 = substr($hptele, 0, 3);		//휴대폰번호1
				$m_hp2 = substr($hptele, 3, 3);		//휴대폰번호2
				$m_hp3 = substr($hptele, 6, 4);		//휴대폰번호3
			}

			//차단 전화번호인지 체크하기

			//미성년자 체크하기
			$minor_chk = "";						//미성년자 체크 변수 선언
			$age = date('Y')-$m_year+1;				//나이
			if($age < 20){							//미성년자 체크
				$minor_chk = "미성년자";
				alert_close("미성년자는 본 사이트를 이용하실 수 없습니다.");
				exit;
			}

			//본인인증 성공
			$result = "";
			$result_script = "";
			if($mode == 1){
				//비회원일 경우
				//회원가입 처리(회원구분, 회원아이디, 회원이름, 년, 월, 일, 휴대폰번호1, 휴대폰번호2, 휴대폰번호3, 통신사, 내/외국인)
				$result = $this->regi_member_auth($mode, $user_id, $name, $m_year, $m_month, $m_day, $m_hp1, $m_hp2, $m_hp3, $mobileco, $nation);
				$result_script = "<script type='text/javascript'> alert('회원가입이 완료되었습니다.'); location.href= '/etc/app/close'; opener.location.href='/'; self.close(); </script>";			
			}else if($mode == 2 or $mode == 3){
				//회원일 경우
				//회원정보 업데이트 및 세션값 업데이트 처리
				$result = $this->member_data_update($mode, $user_id, $name, $m_year, $m_month, $m_day, $m_hp1, $m_hp2, $m_hp3, $mobileco, $nation);
				if($mode == 2){
					//회원의 정보변경시 본인인증
					$result_script = "<script type='text/javascript'> alert('회원정보가 변경되었습니다.'); location.href= '/etc/app/close'; opener.location.reload(); self.close(); </script>";
				}else{
					//휴면회원 정보변경시 본인인증
					$result_script = "
						<script type='text/javascript'>
							alert('인증에 성공하였습니다.'); 
							location.href= '/etc/app/close';
							opener.location.href='javascript:my_cert_ok();';
							self.close(); 
						</script>
					";
				}
				
			}else{
				//예외일경우
				alert_close("잘못된 접근입니다.");
			}

			$bot_data['add_script'] = "<a href='/etc/app/close'>Close</a>".$result_script;	//결과

			//view설정
			$this->load->view('top0_v');
			$this->load->view('bottom0_v', @$bot_data);

		}else{
			//본인인증 실패
			echo "<script type='text/javascript'> alert('본인인증에 실패했습니다. 다시 시도해주시기 바랍니다.'); self.close(); </script>";
		}		

	}

	//비회원일 경우 회원가입처리(회원구분, 회원아이디, 회원이름, 년, 월, 일, 휴대폰번호1, 휴대폰번호2, 휴대폰번호3, 통신사, 내/외국인)
	function regi_member_auth($mode, $user_id, $name, $year, $month, $day, $hp1, $hp2, $hp3, $mobileco, $nation){
		user_auth_log_chk('2', $user_id, $hp1."-".$hp2."-".$hp3);
		$result = "";	//결과변수 선언

		//임시세션추가(이름, 출생년도, 월, 일, 성별)
		$this->session->set_userdata(array(		
			"regi_user_name"		=> iconv("euc-kr", "utf-8", $name),
			"regi_birth_year"		=> $year,
			"regi_birth_month"		=> $month,
			"regi_birth_day"		=> $day
		));
		
		$sex = $this->session->userdata['regi_sex'];
		
		if(!is_null($data = $this->tank_auth->create_user())){	//회원가입성공
			
			//회원가입 성공후 회원정보 업데이트 처리
			$arrData = array(
				"m_hp1"					=> $hp1,
				"m_hp2"					=> $hp2,
				"m_hp3"					=> $hp3,
				"m_mobile_chk"			=> "1",
				"m_mobile_chke_date"	=> NOW
			);
			
			//성별이 여성일 경우 본인인증 하면 정회원으로 업데이트
			if($sex == "F"){
				$arrData["m_type"] = "V";
			}

			//추가 회원 정보 업데이트 처리
			$this->my_m->update('TotalMembers', array('m_userid' => $user_id), $arrData);

			//회원정보 업데이트 후 데이터 불러오기
			$mdata = $this->member_lib->get_member($user_id);
			//휴대폰 인증 및 회원등급 여부 세션에 담기
			$this->session->set_userdata(array(
				"m_mobile_chk"		=> $mdata['m_mobile_chk'],
				"m_type"			=> $mdata['m_type']
			));
			
			//임시테이블 조회후 임시저장내역 삭제하기
			$cnt = $this->my_m->cnt('reg_member', array('userid' => $user_id));
			if($cnt > 0){
				$this->my_m->del('reg_member', array('userid' => $user_id));
			}

			$my_phone = $hp1."-".$hp2."-".$hp3;
			$sms_msg = "조이헌팅입니다.\n회원가입을 축하드립니다.\nwww.joyhunting.com";
			$this->sms_lib->sms_send("#1470", array($my_phone), $sms_msg);		//회원가입메세지보내기
			reg_member_msg_log($user_id);										//문자메세지로그남기기(latest_helper)
			$result = "success";		//성공 결과값 처리
		}else{
			//인증은 성공 했으나 회원가입에 실패할경우
			$this->session->sess_destroy();
			alert_close("회원가입에 실패하였습니다. 고객센터로 문의주시기 바랍니다.");
		}
		
		if($nation == 0){ $nation_code = 3; }else{ $nation_code = 4;}

		//본인인증 로그 남기기
		$log_arrData = array(
			"m_userid"			=> $user_id,
			"m_name"			=> iconv("euc-kr", "utf-8", $name),
			"m_sex"				=> $sex,
			"m_birth"			=> $year.$month.$day,
			"m_local"			=> $nation_code,
			"m_hp1"				=> $hp1,
			"m_hp2"				=> $hp2,
			"m_hp3"				=> $hp3,
			"m_news"			=> get_mobile_code($mobileco),
			"m_gubn"			=> $mode,
			"m_gubn2"			=> "H",
			"m_result"			=> "Y",
			"m_writedate"		=> NOW
		);

		$phone_chk_log = $this->my_m->insert('member_confirm_log', $log_arrData);		//본인인증 로그
		
		return $result;
	}

	//회원의 경우 정보수정(회원구분, 회원아이디, 회원이름, 년, 월, 일, 휴대폰번호1, 휴대폰번호2, 휴대폰번호3, 통신사, 내/외국인)
	function member_data_update($mode, $user_id, $name, $year, $month, $day, $hp1, $hp2, $hp3, $mobileco, $nation){
		user_auth_log_chk('3', $user_id, $hp1."-".$hp2."-".$hp3);
		$result = "";		//결과변수 선언

		//회원 정보 가져오기
		$mdata = $this->member_lib->get_member($user_id);
		if(empty($mdata)){ return; }
		
		//회원 업데이트 데이터
		$arrData = array(
			"m_hp1"					=> $hp1,
			"m_hp2"					=> $hp2,
			"m_hp3"					=> $hp3,
			"m_mobile_chk"			=> "1",
			"m_mobile_chke_date"	=> NOW
		);

		//여성회원이 본인인증을 할경우 바로 정회원 처리
		if($mdata['m_sex'] == "F"){
			$arrData['m_type'] = "V";
		}

		//휴면회원인증일경우
		if($mode == 3){
			$arrData['last_login_day'] = NOW;
		}

		//가입한 본인 이름체크
		if(iconv("euc-kr", "utf-8", $name) <> $mdata['m_name']){
			alert_close('회원가입하신 아이디 명의와 일치하지 않습니다.');
		}
		
		//회원 테이블 업데이트
		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), $arrData);
		
		if($rtn == 1){

			//업데이트후 회원 데이터 다시 가져오기
			$mdata = $this->member_lib->get_member($user_id);
			//세션 업데이트
			$this->session->set_userdata(array(
				"m_mobile_chk"	=> $mdata['m_mobile_chk'],
				"m_type"		=> $mdata['m_type']
			));

			//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
			if(!empty($mdata['m_partner']) and !empty($mdata['m_partner_code'])){
				partner_send_curl('AUTH', $mdata['m_userid'], null);
			}
			
			$result = "success";		//성공 결과값 처리
		}

		if($nation == 0){ $nation_code = 3; }else{ $nation_code = 4;}

		//본인인증 로그 남기기
		$log_arrData = array(
			"m_userid"			=> $user_id,
			"m_name"			=> iconv("euc-kr", "utf-8", $name),
			"m_sex"				=> $mdata['m_sex'],
			"m_birth"			=> $year.$month.$day,
			"m_local"			=> $nation_code,
			"m_hp1"				=> $hp1,
			"m_hp2"				=> $hp2,
			"m_hp3"				=> $hp3,
			"m_news"			=> get_mobile_code($mobileco),
			"m_gubn"			=> $mode,
			"m_gubn2"			=> "H",
			"m_result"			=> "Y",
			"m_writedate"		=> NOW
		);

		$phone_chk_log = $this->my_m->insert('member_confirm_log', $log_arrData);		//본인인증 로그
		
		return $result;
	}

	
	//모듈관련 key value
	function key_value(){
		$szKeyID	= "c028c08ee361c2c5";   
		$szPVKey	= "02186d19b74abb060c8b7ca4bd93ce99";               
		$szKeyVer	= "001";
		$client_id	= "joyhunting";
		
		return array($szKeyID, $szPVKey, $szKeyVer, $client_id);
	}


}

/* End of file main.php */
/* Location: ./application/controllers/music_chat.php */