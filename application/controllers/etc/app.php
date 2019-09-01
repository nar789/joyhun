<?php

class App extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('member_lib');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
	}

	function call_full_tv(){
		//풀티비에 요청하는곳
	
		$token = "6288882"; //회원고유번호 (통신시 회원 아이디 노출을 방지하기 위해 회원idx 발송)
		$aspcode = "sangsang"; //회원사 코드  상상티비 sangsang
		$userip = "192.0.0.1"; //회원의 접속 IP

		echo "
			token : $token <br><br>
			aspcode : $aspcode <br><br>
			userip : $userip <br><br>
		";

		$ch = curl_init();
		$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt ($ch, CURLOPT_URL,"http://api.full.co.kr/asp/join"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=$token&aspCode=$aspcode&userip=$userip"); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute
		$res = curl_exec($ch);
		curl_close ($ch);

		//최종 받은 결과 임시로 찍어보기
		echo '<meta charset="UTF-8"/>';
		$arr = json_decode($res);
		print_r($arr);

	}

	function full_tv(){
		//풀티비 리턴받아 처리하는곳

		//풀티비에서 데이터 받기
		$type		= $this->input->post('type',TRUE);		
		$token		= $this->input->post('token',TRUE);  //회원고유번호
		$t			= $this->input->post('t',TRUE);
		
		//회원정보 조회하기
		$row = $this->my_m->row_array('TotalMembers', array('m_num' => $token), 'm_num', 'desc', 1);
		$f = '19';
		if(substr($row['m_jumin1'], 0, 1) == 0){
			$f = '00';
		}

		//풀티비에서 받은 데이터 배열정리
		$full_arr = array('type' => $type, 'token' => $token, 't' => $t, 'w_date' => NOW);
		
		//결과값 배열
		$result = array(
			"result"		=> true,
			"userid"		=> $row['m_userid'],
			"nickname"		=> $row['m_nick'],
			"birthday"		=> $f.$row['m_jumin1'],
			"userpw"		=> '!'.$row['m_userid'],
			"name"			=> $row['m_name'],
			"gender"		=> $row['m_sex']
		);

		$log_data = implode(',', $result);
		$etc1 = implode(',', $full_arr);
		
		$cnt = $this->my_m->cnt('fulltv_log', array('user_id' => $row['m_userid']));

		if($cnt == 0){
			//데이터 저장
			$log_insert = $this->my_m->insert('fulltv_log', array('user_id' => $row['m_userid'], 'log_data' => $log_data, 'data_url' => null, 'write_date' => NOW, 'etc1' => $etc1));
		}		

		echo json_encode($result);

	}


	function call_nomo_tv(){
		//노모티비에 요청하는곳
	
		$token = "6288882"; //회원고유번호 (통신시 회원 아이디 노출을 방지하기 위해 회원idx 발송)
		$aspcode = "joyhunting2"; //회원사 코드  상상티비 sangsang
		$userip = "192.0.0.1"; //회원의 접속 IP

		echo "
			token : $token <br><br>
			aspcode : $aspcode <br><br>
			userip : $userip <br><br>
		";

		$ch = curl_init();
		$userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt ($ch, CURLOPT_URL,"http://api.nomotv.co.kr/asp/join"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=$token&aspCode=$aspcode&userip=$userip"); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute
		$res = curl_exec($ch);
		curl_close ($ch);

		//최종 받은 결과 임시로 찍어보기
		echo '<meta charset="UTF-8"/>';
		$arr = json_decode($res);
		print_r($arr);

	}

	function  nomo_tv(){
		//노모티비 리턴받아 처리하는곳

		//노모티비에서 데이터 받기
		$type		= $this->input->post('type',TRUE);		
		$token		= $this->input->post('token',TRUE);  //회원고유번호
		$t			= $this->input->post('t',TRUE);
		
		//회원정보 조회하기
		$row = $this->my_m->row_array('TotalMembers', array('m_num' => $token), 'm_num', 'desc', 1);
		$f = '19';
		if(substr($row['m_jumin1'], 0, 1) == 0){
			$f = '00';
		}

		//풀티비에서 받은 데이터 배열정리
		$full_arr = array('type' => $type, 'token' => $token, 't' => $t, 'w_date' => NOW);
		
		//결과값 배열
		$result = array(
			"result"		=> true,
			"userid"		=> $row['m_userid'],
			"nickname"		=> $row['m_nick'],
			"birthday"		=> $f.$row['m_jumin1'],
			"userpw"		=> '!'.$row['m_userid'],
			"name"			=> $row['m_name'],
			"gender"		=> $row['m_sex']
		);

		$log_data = implode(',', $result);
		$etc1 = implode(',', $full_arr);
		
		$cnt = $this->my_m->cnt('nomotv_log', array('user_id' => $row['m_userid']));

		if($cnt == 0){
			//데이터 저장
			$log_insert = $this->my_m->insert('nomotv_log', array('user_id' => $row['m_userid'], 'log_data' => $log_data, 'data_url' => null, 'write_date' => NOW, 'etc1' => $etc1));
		}		

		echo json_encode($result);

	}



	//결제 토큰이 만료되기전에 주기적 업데이트 (cron 30분 반복실행)
	function token_refresh(){

		$CI =& get_instance();
		$CI->load->model('my_m');

		$client_id = "683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com";
		$client_secret = "CUKl_i3lDYXRIvpF1EfodY7D";

		$app_data = $this->my_m->row_array("app_setting", array('idx' => '1'));
		$refresh_token = $app_data['refresh_token'];

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "client_id=$client_id&client_secret=$client_secret&refresh_token=$refresh_token&grant_type=refresh_token"); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute
		$res = curl_exec($ch);
		curl_close ($ch);

		$json_arr = json_decode($res);
		$result = $this->my_m->update('app_setting', array('idx' => '1'), array('access_token' =>$json_arr->access_token));
		echo $res;
	}

	//우연히 만료됐다면 재발행. (수동실행)
	function token_new(){
		exit;
		//1회용. 실행은 한번만 가능.
		//코드 따오기-직접실행 : https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/androidpublisher&response_type=code&access_type=offline&redirect_uri=http://joyhunting.com/etc/app/return_url&client_id=683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com&approval_prompt=force

		$CI =& get_instance();
		$CI->load->model('my_m');

		$code = "4/ZyZE1OJYFe93vcN5RNSZGre34_3XjK1bCasymYqJkEQ";	//코드수정필요
		$client_id = "683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com";
		$client_secret = "CUKl_i3lDYXRIvpF1EfodY7D";


		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "code=$code&client_id=$client_id&client_secret=$client_secret&redirect_uri=http://joyhunting.com/etc/app/return_url&grant_type=authorization_code"); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute
		$res = curl_exec($ch);
		curl_close ($ch);

		$json_arr = json_decode($res);
		$result = $this->my_m->update('app_setting', array('idx' => '1'), array('access_token' =>$json_arr->access_token,'refresh_token' => $json_arr->refresh_token));
		echo $res;
	}
	
	function return_url(){
		echo "ok";
	}

	//구독 초기화
	function reset_product(){
			if($this->session->userdata['m_userid']){
				$payment_result = $this->my_m->update('TotalMembers', array("m_userid" => $this->session->userdata['m_userid'] ), array("m_is_muhan" => "N") );
			}

			//$this->my_m->insert('test_data', array("data1"=>$this->session->userdata['m_userid'],"data2"=>"reset") );
	}

	//현재 구독중인지 체크 저장
	function save_product(){
		if($this->session->userdata['m_userid']){
			//1.받은 결제정보 가공
			$json = $this->input->post('data',TRUE);
			
			$json_arr = json_decode($json);

			$state = str_replace("₩","",$json_arr->state);
			$id = str_replace("₩","",$json_arr->id);
			if(substr($id,0,3) == "400" ){
				if($state =="owned"){

					//결제한적이 있는가?
					$strSQL = "SELECT *  FROM payment_temp WHERE  m_userid  = '".$this->session->userdata['m_userid']."' and m_product_code like '400%' and m_card_ok = 'Y' ";
					$query = $this->db->query($strSQL);
					$data = $query->row_array();	

					if(@$data['m_idx']){

						//구독중 업데이트
						$payment_result = $this->my_m->update('TotalMembers', array("m_userid" => $this->session->userdata['m_userid'] ) , array("m_is_muhan" => "Y") );

					}

					//$this->my_m->insert('test_data', array("data1"=>$this->session->userdata['m_userid'],"data2"=>$json,"data3" => "Y") );
				}
			}
		}

		//$json_arr = json_decode($json);

	}


	//입앱 결제결과 저장  (/app/js/index.js 에서 호출)
	function save_purchase(){
	
		//1.받은 결제정보 가공
		$json = $this->input->post('data',TRUE);

		$json_arr = json_decode($json);

		$price = str_replace("₩","",$json_arr->price);
		$price = str_replace(",","",$price);
	
		$tmp_tran = explode('"downloaded":false,',$json);
		$tmp_tran2 = explode(',"valid":true',$tmp_tran[1]);
		$tran = $tmp_tran2[0];

		$tmp_tran = explode('orderId\":\"',$json);
		$tmp_tran2 = explode('\",\"',$tmp_tran[1]);
		$order_id = $tmp_tran2[0]; //json이 잘 안먹혀서 이렇게 찾음.

		//1-1 중복 데이터 들어오면 정지
		$search = $this->my_m->row_array('app_purchase', array('full_data' => $json));
		if(@$search['idx']){exit;}

		//2. 영수증 검증전 결제 시도 테이블에 저장

		//회원정보 가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//상품정보 가져오기
		$product_data = $this->my_m->row_array('product_list', array('m_product_code' => $json_arr->id));

		//주문번호 만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$m_tradeid = "GG_joyhunting_".date('YmdHis')."_".$str_rand;	//주문번호

		//결제요청전 temp_data 저장(결제 시도)
		$temp_data = array(
			"m_userid"				=> $member_data['m_userid'],											//결제자 아이디
			"m_product_code"		=> $product_data['m_product_code'],										//상품코드
			"m_goods"				=> $product_data['m_goods'],											//상품명
			"m_price"				=> $product_data['m_price'],											//상품가격
			"m_point"				=> $product_data['m_point'],											//결제포인트
			"m_cash_gb"				=> 'GG',															//결제방법(타입)
			"m_commid"				=> '',																	//결제방법이 신용카드일경우 (카드은행 코드), 실시간계좌 일경우(은행 코드)
			"m_hp"					=> $member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3'],	//결제자 핸드폰 번호
			"m_payeremail"			=> $member_data['m_mail'],												//결제자 이메일
			"m_card_ok"				=> 'N',																	//결제완료구분(N : 결제 미완료, Y : 결제 완료)
			"m_tradeid"				=> $m_tradeid,															//주문번호
			"m_payment_gb"			=> 'GG',														//결제방법(구분)
			"m_result_code"			=> '',																	//결제완료코드
			"m_writedate"			=> NOW,																	//결제시도시간
			"m_pay_gubn"			=> 'A'																	//결제시도기기
		);

		//결제시도 데이터 삽입
		$temp_insert = $this->my_m->insert('payment_temp', $temp_data);

		if($temp_insert != "1"){
			echo "error1";exit;
		}

		//3.구글 영수증 검증 실행
		$check = $this->validator($json_arr->id,$json_arr->transaction->purchaseToken);
		if($check == "error"){
			echo "error2";exit;
		}

		//4. 받은 결제정보 앱용 테이블에 저장
		$arr_data = array(
			'w_date' => NOW,
			'full_data' => $json,
			'id' => $json_arr->id,
			'alias' => $json_arr->alias,
			'type' => $json_arr->type,
			'state' => $json_arr->state,
			'title' => $json_arr->title,
			'description' => $json_arr->description,
			'price' => $price,
			'currency' => $json_arr->currency,
			'loaded' => $json_arr->loaded,
			'canPurchase' => $json_arr->canPurchase,
			'owned' => $json_arr->owned,
			'downloading' => $json_arr->downloading,
			'downloaded' => $json_arr->downloaded,
			'transaction' => $tran,
			'valid' => $json_arr->valid,
			'google_order_id' => $order_id
		);

		$rtn = $this->my_m->insert("app_purchase", $arr_data);
		
		//5. 각종 결제 완료 처리

		//결제완료 처리 데이터(update)
		$payment_data = array(
			"m_mobilid"				=>  $order_id,						//구글 거래 고유번호
			"m_card_ok"				=> 'Y',							//결제완료구분
			"m_signdate"			=> NOW,					//거래 승인시간
			"m_result_code"			=> '0000',						//결과코드
			"m_okdate"				=> NOW							//결제완료시간
		);
		
		//업데이트 조건 
		$set_where = array(
			"m_payment_gb"	=> 'GG',				//거래종류
			"m_card_ok"		=> 'N',					//결제미완료상태
			"m_tradeid"		=> $m_tradeid			//주문번호
		);

		//결제완료 데이터 업데이트
		$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

		if($payment_result <> "1"){
			//데이터 업데이트 실패
			echo "error3";exit;
		}else{
			//데이터 업데이트 성공
			
			//포인트 업데이트 처리를 위해서 결제완료 데이터 가져오기
			$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $m_tradeid, 'm_card_ok' => 'Y'));		
			
			//결제완료 또는 포인트 사용처리 helper
			//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
			$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, null);
			
			if($rtn <> "1"){
				echo "error4";exit; //포인트 충전 실패시
			}else{
				//첫 결제시 일반회원의 경우 정회원 등업
				$rtn2 = member_level_up($arrData['m_userid'], $arrData['m_tradeid']);

				//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
				$m_data = $this->member_lib->get_member($arrData['m_userid']);
				if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
					partner_send_curl('PAY', $arrData['m_userid'], $arrData['m_tradeid']);
				}
			}
		}


		echo 1;
	}

	//영수증 검증
	function validator($product_id,$p_token){

		$CI =& get_instance();
		$CI->load->model('my_m');

		$package = "com.anijcorp.joytalk"; //패키지이름
		//$product_id = "jung_33000"; //Product ID
		//$p_token = "aafemehcpnccbkejgcniioef.AO-J1OztnfIgBPQ1QNE3ztzGGCaDF7DsN5nJLIb3YGsAAvytH03rmQ0InJdVdEn7UZcdHYzUFeT7kUIJUzInQzntgA2z6vofk91eK-fuN8rOnGHS3HGAyLaLFk4qzPVcdgp_L4rBYVIT"; //결제 토큰

		$app_data = $this->my_m->row_array("app_setting", array('idx' => '1'));
		$access_token = $app_data['access_token']; //액세스 토큰

		if(substr($product_id,0,3) == "400"){
			//구독일때 테스트
			$link = preg_replace('/\r\n|\r|\n/','',"https://www.googleapis.com/androidpublisher/v1.1/applications/$package/subscriptions/$product_id/purchases/$p_token?access_token=$access_token");
		}else{
			//결제
			$link = preg_replace('/\r\n|\r|\n/','',"https://www.googleapis.com/androidpublisher/v1.1/applications/$package/inapp/$product_id/purchases/$p_token?access_token=$access_token");
		}


		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,$link); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 0); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		// Execute
		$res = curl_exec($ch);
		curl_close ($ch);

		//결과코드 purchaseState = 0 (purchased), 1 (canceled), or 2 (refunded).

		$json_arr = json_decode($res);
		if(@$json_arr->purchaseState === 0 or @$json_arr->purchaseState === 1 or @$json_arr->purchaseState === 2 or @$json_arr->autoRenewing == ture ){return "ok";}else{return "error";};

	}


	//애플 입앱 결제결과 저장  (/app_ios/js/index.js 에서 호출)  ()
	function save_purchase_ios(){

		//1.받은 결제정보 가공
		$code = $this->input->post('code',TRUE);
		$receipt = $this->input->post('receipt',TRUE);

		//4. 받은 결제정보 앱용 테이블에 저장
		$arr_data = array(
			'data' => $code,
			'receipt' => $receipt,
			'w_date' => NOW
		);

		$rtn = $this->my_m->insert("app_test", $arr_data);
		//var_dump( $arr_data);
/*
		$json_arr = json_decode($json);

		$price = str_replace("₩","",$json_arr->price);
		$price = str_replace("US$","",$price);

		$tran = $json_arr->transactions{0};

		$order_id = $tran; //json이 잘 안먹혀서 이렇게 찾음.

		//1-1 중복 데이터 들어오면 정지
		$search = $this->my_m->row_array('app_purchase', array('full_data' => $json));
		if(@$search['idx']){echo "try_error"; exit;}

		//2. 영수증 검증전 결제 시도 테이블에 저장

		//회원정보 가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//상품정보 가져오기
		$product_data = $this->my_m->row_array('product_list', array('m_product_code' => $json_arr->id));


		//주문번호 만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$m_tradeid = "GG_joyhunting_".date('YmdHis')."_".$str_rand;	//주문번호

		//결제요청전 temp_data 저장(결제 시도)
		$temp_data = array(
			"m_userid"				=> $member_data['m_userid'],											//결제자 아이디
			"m_product_code"		=> $product_data['m_product_code'],										//상품코드
			"m_goods"				=> $product_data['m_goods'],											//상품명
			"m_price"				=> $product_data['m_price'],											//상품가격
			"m_point"				=> $product_data['m_point'],											//결제포인트
			"m_cash_gb"				=> 'IOS',															//결제방법(타입)
			"m_commid"				=> '',																	//결제방법이 신용카드일경우 (카드은행 코드), 실시간계좌 일경우(은행 코드)
			"m_hp"					=> $member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3'],	//결제자 핸드폰 번호
			"m_payeremail"			=> $member_data['m_mail'],												//결제자 이메일
			"m_card_ok"				=> 'N',																	//결제완료구분(N : 결제 미완료, Y : 결제 완료)
			"m_tradeid"				=> $m_tradeid,															//주문번호
			"m_payment_gb"			=> 'IOS',														//결제방법(구분)
			"m_result_code"			=> '',																	//결제완료코드
			"m_writedate"			=> NOW,																	//결제시도시간
			"m_pay_gubn"			=> 'A'																	//결제시도기기
		);

		//결제시도 데이터 삽입
		$temp_insert = $this->my_m->insert('payment_temp', $temp_data);

		if($temp_insert != "1"){
			echo "error1";exit;
		}
*/
		//3.애플 영수증 검증 실행
		$check = $this->validator_ios($receipt,$code);
		if($check[0] != "ok"){
			echo $check;exit;
		}
		$rtn_data = $check[1];
		$result = $check[2];

		//1-1 중복 데이터 들어오면 정지
		$search = $this->my_m->row_array('app_purchase', array('transaction' => $rtn_data->receipt->in_app{0}->transaction_id ));
		if(@$search['idx']){
			echo "try_error".$rtn_data->receipt->in_app{0}->transaction_id; 
			exit;
		}

		//2. 영수증 검증전 결제 시도 테이블에 저장


		//회원정보 가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//상품정보 가져오기
		$product_data = $this->my_m->row_array('product_list', array('m_product_code' =>$rtn_data->receipt->in_app{0}->product_id));


		//주문번호 만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$m_tradeid = "GG_joyhunting_".date('YmdHis')."_".$str_rand;	//주문번호

		//결제요청전 temp_data 저장(결제 시도)
		$temp_data = array(
			"m_userid"				=> $member_data['m_userid'],											//결제자 아이디
			"m_product_code"		=> $product_data['m_product_code'],										//상품코드
			"m_goods"				=> $product_data['m_goods'],											//상품명
			"m_price"				=> $product_data['m_price'],											//상품가격
			"m_point"				=> $product_data['m_point'],											//결제포인트
			"m_cash_gb"				=> 'IOS',															//결제방법(타입)
			"m_commid"				=> '',																	//결제방법이 신용카드일경우 (카드은행 코드), 실시간계좌 일경우(은행 코드)
			"m_hp"					=> $member_data['m_hp1'].$member_data['m_hp2'].$member_data['m_hp3'],	//결제자 핸드폰 번호
			"m_payeremail"			=> $member_data['m_mail'],												//결제자 이메일
			"m_card_ok"				=> 'N',																	//결제완료구분(N : 결제 미완료, Y : 결제 완료)
			"m_tradeid"				=> $m_tradeid,															//주문번호
			"m_payment_gb"			=> 'IOS',														//결제방법(구분)
			"m_result_code"			=> '',																	//결제완료코드
			"m_writedate"			=> NOW,																	//결제시도시간
			"m_pay_gubn"			=> 'A'																	//결제시도기기
		);

		//결제시도 데이터 삽입
		$temp_insert = $this->my_m->insert('payment_temp', $temp_data);

		if($temp_insert != "1"){
			echo "error1";exit;
		}

		//$arr = implode(",",json_decode($rtn_data,1));

		//4. 받은 결제정보 앱용 테이블에 저장
		$arr_data = array(
			'w_date' => NOW,
			'full_data' => $result,
			'id' => $code,
			'alias' => $rtn_data->receipt->in_app{0}->product_id,
			'type' => '',
			'state' => '',
			'title' => '',
			'description' => '',
			'price' => '',
			'currency' => '',
			'loaded' => '',
			'canPurchase' => '',
			'owned' => '',
			'downloading' => '',
			'downloaded' => '',
			'transaction' => $rtn_data->receipt->in_app{0}->product_id,
			'valid' => '',
			'google_order_id' => '',
			'payload'	=> $receipt
		);

		$rtn = $this->my_m->insert("app_purchase", $arr_data);
		
		//5. 각종 결제 완료 처리

		//결제완료 처리 데이터(update)
		$payment_data = array(
			"m_mobilid"				=>  $rtn_data->receipt->in_app{0}->transaction_id,						//구글 거래 고유번호
			"m_card_ok"				=> 'Y',							//결제완료구분
			"m_signdate"			=> NOW,					//거래 승인시간
			"m_result_code"			=> '0000',						//결과코드
			"m_okdate"				=> NOW							//결제완료시간
		);
		
		//업데이트 조건 
		$set_where = array(
			"m_payment_gb"	=> 'IOS',				//거래종류
			"m_card_ok"		=> 'N',					//결제미완료상태
			"m_tradeid"		=> $m_tradeid			//주문번호
		);

		//결제완료 데이터 업데이트
		$payment_result = $this->my_m->update('payment_temp', $set_where, $payment_data);

		if($payment_result <> "1"){
			//데이터 업데이트 실패
			echo "error3";exit;
		}else{
			//데이터 업데이트 성공
			
			//포인트 업데이트 처리를 위해서 결제완료 데이터 가져오기
			$arrData = $this->my_m->row_array('payment_temp', array('m_tradeid' => $m_tradeid, 'm_card_ok' => 'Y'));		
			
			//결제완료 또는 포인트 사용처리 helper
			//m_userid = 회원아이디(필수), m_product_code = 상품코드(필수), m_goods = 상품명(필수), m_point = 포인트(필수), m_price = 상품가격, m_tradeid = 거래번호, m_writedate = 입력날짜, m_etc = 기타내용
			$rtn = member_point_insert($arrData['m_userid'], $arrData['m_product_code'], $arrData['m_goods'], $arrData['m_point'], $arrData['m_price'], $arrData['m_tradeid'], NOW, null);
			
			if($rtn <> "1"){
				echo "error4";exit; //포인트 충전 실패시
			}else{
				//첫 결제시 일반회원의 경우 정회원 등업
				$rtn2 = member_level_up($arrData['m_userid'], $arrData['m_tradeid']);

				//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
				$m_data = $this->member_lib->get_member($arrData['m_userid']);
				if(!empty($m_data['m_partner']) and !empty($m_data['m_partner_code'])){
					partner_send_curl('PAY', $arrData['m_userid'], $arrData['m_tradeid']);
				}
			}
		}


		echo 1;
	}

	//애플 영수증 검증
	function validator_ios($s_payload,$code){

		$CI =& get_instance();
		$CI->load->model('my_m');

		define("VERIFY_URL", "https://sandbox.itunes.apple.com/verifyReceipt"); //개발 테스트시
		//define("VERIFY_URL", "https://buy.itunes.apple.com/verifyReceipt"); //실제 서비스시 

		
		$post = json_encode( Array( 'receipt-data' => $s_payload ) ); 

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, VERIFY_URL); 
		curl_setopt($ch, CURLOPT_POST,1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$result=curl_exec($ch); 
		curl_close ($ch); 

		//var_dump($result);
		//exit;
		//echo "<br><br>";

		$o_bill = json_decode($result); 
		//var_dump($o_bill);

		if($o_bill->status != 0) { 
			return "invalid_recipt"; 
		} 

		//option : package name checking 
		if($o_bill->receipt->bundle_id != "com.joytalk.app") { 
			return "invalid_pkg_name"; 
		}	
		
		if($code != $o_bill->receipt->in_app{0}->product_id){
			//return "code error".$code."".$o_bill->receipt->in_app{0}->product_id; 
		}
		


//		echo "$code<br><br>";

//		echo $o_bill->receipt->in_app{0}->product_id."<br><br>";
//		exit;

		//t_id 체크 추가
		/*
		if($t_id != $o_bill->receipt->in_app{6}->original_transaction_id){
			return addslashes("invalid_t_id $t_id != ".$o_bill->receipt->in_app{6}->original_transaction_id); 
		}
		*/

		//echo "<br>";
		//echo $t_id."<br>";		
		//echo  $o_bill->receipt->in_app{6}->transaction_id."<br>";		

		//option : product id checking 
		/*
		if($o_bill->receipt->in_app{6}->product_id != $p_id) { 
			return addslashes("invalid_p_id  $p_id != ".$o_bill->receipt->in_app{6}->product_id); 
		} */
		
		//return 0; 
		return array("ok",$o_bill,$result);

	}

	function ios_test(){

		$this->save_purchase_ios('{"id":"2001","alias":"jung_55000","type":"consumable","state":"approved","title":null,"description":null,"priceMicros":null,"price":"US$54.99","currency":"USD","loaded":true,"canPurchase":false,"owned":false,"downloading":false,"downloaded":false,"additionalData":null,"transaction":{"type":"ios-appstore","id":"1000000354110806"},"valid":true,"transactions":["1000000354110806"]}',"MIIgtAYJKoZIhvcNAQcCoIIgpTCCIKECAQExCzAJBgUrDgMCGgUAMIIQVQYJKoZIhvcNAQcBoIIQRgSCEEIxghA+MAoCAQgCAQEEAhYAMAoCARQCAQEEAgwAMAsCAQECAQEEAwIBADALAgELAgEBBAMCAQAwCwIBDwIBAQQDAgEAMAsCARACAQEEAwIBADALAgEZAgEBBAMCAQMwDAIBCgIBAQQEFgI0KzAMAgEOAgEBBAQCAgCLMA0CAQ0CAQEEBQIDAa4WMA0CARMCAQEEBQwDMS4wMA4CAQkCAQEEBgIEUDI0OTAPAgEDAgEBBAcMBTEuMC4wMBgCAQQCAQIEEHDvcUgTS1dGvKR/jFGJJHgwGQIBAgIBAQQRDA9jb20uam95dGFsay5hcHAwGwIBAAIBAQQTDBFQcm9kdWN0aW9uU2FuZGJveDAcAgEFAgEBBBRAaqrxX/8AIAlh1535DY6joApQRjAeAgEMAgEBBBYWFDIwMTctMTItMDFUMDg6MDQ6MzNaMB4CARICAQEEFhYUMjAxMy0wOC0wMVQwNzowMDowMFowMQIBBwIBAQQpgrD8UNuWiodqLdOSMK3ACDELuPoEDSnIlyaOnjE5JJckLbxt6vnJl6AwVgIBBgIBAQROwpLdoIFA9HOtSDoDTmnUo5SqplTrJQ8SoiEZ1cyy2JO0kx8S2zHm33NvsfKfMri/I4H1xBC/qQl72BGPCj14QkaHLlvGdzovmF9ptbfBMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDEwMDEwGwICBqcCAQEEEgwQMTAwMDAwMDM1NDEwMjY1ODAbAgIGqQIBAQQSDBAxMDAwMDAwMzU0MTAyNjU4MB8CAgaoAgEBBBYWFDIwMTctMTEtMjJUMDY6NDE6MjdaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjJUMDY6NDE6MjdaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDEwMDIwGwICBqcCAQEEEgwQMTAwMDAwMDM1MzM5MjEzNDAbAgIGqQIBAQQSDBAxMDAwMDAwMzUzMzkyMTM0MB8CAgaoAgEBBBYWFDIwMTctMTEtMjBUMDM6MTI6MDVaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjBUMDM6MTI6MDVaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDEwMDMwGwICBqcCAQEEEgwQMTAwMDAwMDM1MzkyMTQ1NDAbAgIGqQIBAQQSDBAxMDAwMDAwMzUzOTIxNDU0MB8CAgaoAgEBBBYWFDIwMTctMTEtMjFUMTQ6Mjg6MTNaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjFUMTQ6Mjg6MTNaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDEwMDQwGwICBqcCAQEEEgwQMTAwMDAwMDM1MzQ4MjMyNDAbAgIGqQIBAQQSDBAxMDAwMDAwMzUzNDgyMzI0MB8CAgaoAgEBBBYWFDIwMTctMTEtMjBUMDg6NTE6MDBaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjBUMDg6NTE6MDBaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDEwMDUwGwICBqcCAQEEEgwQMTAwMDAwMDM1MzkyMTYxMzAbAgIGqQIBAQQSDBAxMDAwMDAwMzUzOTIxNjEzMB8CAgaoAgEBBBYWFDIwMTctMTEtMjFUMTQ6Mjk6MjlaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjFUMTQ6Mjk6MjlaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDIwMDEwGwICBqcCAQEEEgwQMTAwMDAwMDM1NDExMDgwNjAbAgIGqQIBAQQSDBAxMDAwMDAwMzU0MTEwODA2MB8CAgaoAgEBBBYWFDIwMTctMTEtMjJUMDc6MDc6NDJaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjJUMDc6MDc6NDJaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDIwMDIwGwICBqcCAQEEEgwQMTAwMDAwMDM1NjQwNjA4MzAbAgIGqQIBAQQSDBAxMDAwMDAwMzU2NDA2MDgzMB8CAgaoAgEBBBYWFDIwMTctMTItMDFUMDY6NTY6NTdaMB8CAgaqAgEBBBYWFDIwMTctMTItMDFUMDY6NTY6NTdaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDIwMDMwGwICBqcCAQEEEgwQMTAwMDAwMDM1NDExMzM4MjAbAgIGqQIBAQQSDBAxMDAwMDAwMzU0MTEzMzgyMB8CAgaoAgEBBBYWFDIwMTctMTEtMjJUMDc6MTc6NTZaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjJUMDc6MTc6NTZaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDUwMDEwGwICBqcCAQEEEgwQMTAwMDAwMDM1NTY3MzczMjAbAgIGqQIBAQQSDBAxMDAwMDAwMzU1NjczNzMyMB8CAgaoAgEBBBYWFDIwMTctMTEtMjlUMDI6NTg6MjdaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjlUMDI6NTg6MjdaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDUwMDIwGwICBqcCAQEEEgwQMTAwMDAwMDM1NTY3NTA3NTAbAgIGqQIBAQQSDBAxMDAwMDAwMzU1Njc1MDc1MB8CAgaoAgEBBBYWFDIwMTctMTEtMjlUMDM6MDM6MTJaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjlUMDM6MDM6MTJaMIIBSQIBEQIBAQSCAT8xggE7MAsCAgasAgEBBAIWADALAgIGrQIBAQQCDAAwCwICBrACAQEEAhYAMAsCAgayAgEBBAIMADALAgIGswIBAQQCDAAwCwICBrQCAQEEAgwAMAsCAga1AgEBBAIMADALAgIGtgIBAQQCDAAwDAICBqUCAQEEAwIBATAMAgIGqwIBAQQDAgEBMAwCAgauAgEBBAMCAQAwDAICBq8CAQEEAwIBADAMAgIGsQIBAQQDAgEAMA8CAgamAgEBBAYMBDUwMDQwGwICBqcCAQEEEgwQMTAwMDAwMDM1NTY5OTEyNDAbAgIGqQIBAQQSDBAxMDAwMDAwMzU1Njk5MTI0MB8CAgaoAgEBBBYWFDIwMTctMTEtMjlUMDQ6NDk6NTRaMB8CAgaqAgEBBBYWFDIwMTctMTEtMjlUMDQ6NDk6NTRaoIIOZTCCBXwwggRkoAMCAQICCA7rV4fnngmNMA0GCSqGSIb3DQEBBQUAMIGWMQswCQYDVQQGEwJVUzETMBEGA1UECgwKQXBwbGUgSW5jLjEsMCoGA1UECwwjQXBwbGUgV29ybGR3aWRlIERldmVsb3BlciBSZWxhdGlvbnMxRDBCBgNVBAMMO0FwcGxlIFdvcmxkd2lkZSBEZXZlbG9wZXIgUmVsYXRpb25zIENlcnRpZmljYXRpb24gQXV0aG9yaXR5MB4XDTE1MTExMzAyMTUwOVoXDTIzMDIwNzIxNDg0N1owgYkxNzA1BgNVBAMMLk1hYyBBcHAgU3RvcmUgYW5kIGlUdW5lcyBTdG9yZSBSZWNlaXB0IFNpZ25pbmcxLDAqBgNVBAsMI0FwcGxlIFdvcmxkd2lkZSBEZXZlbG9wZXIgUmVsYXRpb25zMRMwEQYDVQQKDApBcHBsZSBJbmMuMQswCQYDVQQGEwJVUzCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAKXPgf0looFb1oftI9ozHI7iI8ClxCbLPcaf7EoNVYb/pALXl8o5VG19f7JUGJ3ELFJxjmR7gs6JuknWCOW0iHHPP1tGLsbEHbgDqViiBD4heNXbt9COEo2DTFsqaDeTwvK9HsTSoQxKWFKrEuPt3R+YFZA1LcLMEsqNSIH3WHhUa+iMMTYfSgYMR1TzN5C4spKJfV+khUrhwJzguqS7gpdj9CuTwf0+b8rB9Typj1IawCUKdg7e/pn+/8Jr9VterHNRSQhWicxDkMyOgQLQoJe2XLGhaWmHkBBoJiY5uB0Qc7AKXcVz0N92O9gt2Yge4+wHz+KO0NP6JlWB7+IDSSMCAwEAAaOCAdcwggHTMD8GCCsGAQUFBwEBBDMwMTAvBggrBgEFBQcwAYYjaHR0cDovL29jc3AuYXBwbGUuY29tL29jc3AwMy13d2RyMDQwHQYDVR0OBBYEFJGknPzEdrefoIr0TfWPNl3tKwSFMAwGA1UdEwEB/wQCMAAwHwYDVR0jBBgwFoAUiCcXCam2GGCL7Ou69kdZxVJUo7cwggEeBgNVHSAEggEVMIIBETCCAQ0GCiqGSIb3Y2QFBgEwgf4wgcMGCCsGAQUFBwICMIG2DIGzUmVsaWFuY2Ugb24gdGhpcyBjZXJ0aWZpY2F0ZSBieSBhbnkgcGFydHkgYXNzdW1lcyBhY2NlcHRhbmNlIG9mIHRoZSB0aGVuIGFwcGxpY2FibGUgc3RhbmRhcmQgdGVybXMgYW5kIGNvbmRpdGlvbnMgb2YgdXNlLCBjZXJ0aWZpY2F0ZSBwb2xpY3kgYW5kIGNlcnRpZmljYXRpb24gcHJhY3RpY2Ugc3RhdGVtZW50cy4wNgYIKwYBBQUHAgEWKmh0dHA6Ly93d3cuYXBwbGUuY29tL2NlcnRpZmljYXRlYXV0aG9yaXR5LzAOBgNVHQ8BAf8EBAMCB4AwEAYKKoZIhvdjZAYLAQQCBQAwDQYJKoZIhvcNAQEFBQADggEBAA2mG9MuPeNbKwduQpZs0+iMQzCCX+Bc0Y2+vQ+9GvwlktuMhcOAWd/j4tcuBRSsDdu2uP78NS58y60Xa45/H+R3ubFnlbQTXqYZhnb4WiCV52OMD3P86O3GH66Z+GVIXKDgKDrAEDctuaAEOR9zucgF/fLefxoqKm4rAfygIFzZ630npjP49ZjgvkTbsUxn/G4KT8niBqjSl/OnjmtRolqEdWXRFgRi48Ff9Qipz2jZkgDJwYyz+I0AZLpYYMB8r491ymm5WyrWHWhumEL1TKc3GZvMOxx6GUPzo22/SGAGDDaSK+zeGLUR2i0j0I78oGmcFxuegHs5R0UwYS/HE6gwggQiMIIDCqADAgECAggB3rzEOW2gEDANBgkqhkiG9w0BAQUFADBiMQswCQYDVQQGEwJVUzETMBEGA1UEChMKQXBwbGUgSW5jLjEmMCQGA1UECxMdQXBwbGUgQ2VydGlmaWNhdGlvbiBBdXRob3JpdHkxFjAUBgNVBAMTDUFwcGxlIFJvb3QgQ0EwHhcNMTMwMjA3MjE0ODQ3WhcNMjMwMjA3MjE0ODQ3WjCBljELMAkGA1UEBhMCVVMxEzARBgNVBAoMCkFwcGxlIEluYy4xLDAqBgNVBAsMI0FwcGxlIFdvcmxkd2lkZSBEZXZlbG9wZXIgUmVsYXRpb25zMUQwQgYDVQQDDDtBcHBsZSBXb3JsZHdpZGUgRGV2ZWxvcGVyIFJlbGF0aW9ucyBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAMo4VKbLVqrIJDlI6Yzu7F+4fyaRvDRTes58Y4Bhd2RepQcjtjn+UC0VVlhwLX7EbsFKhT4v8N6EGqFXya97GP9q+hUSSRUIGayq2yoy7ZZjaFIVPYyK7L9rGJXgA6wBfZcFZ84OhZU3au0Jtq5nzVFkn8Zc0bxXbmc1gHY2pIeBbjiP2CsVTnsl2Fq/ToPBjdKT1RpxtWCcnTNOVfkSWAyGuBYNweV3RY1QSLorLeSUheHoxJ3GaKWwo/xnfnC6AllLd0KRObn1zeFM78A7SIym5SFd/Wpqu6cWNWDS5q3zRinJ6MOL6XnAamFnFbLw/eVovGJfbs+Z3e8bY/6SZasCAwEAAaOBpjCBozAdBgNVHQ4EFgQUiCcXCam2GGCL7Ou69kdZxVJUo7cwDwYDVR0TAQH/BAUwAwEB/zAfBgNVHSMEGDAWgBQr0GlHlHYJ/vRrjS5ApvdHTX8IXjAuBgNVHR8EJzAlMCOgIaAfhh1odHRwOi8vY3JsLmFwcGxlLmNvbS9yb290LmNybDAOBgNVHQ8BAf8EBAMCAYYwEAYKKoZIhvdjZAYCAQQCBQAwDQYJKoZIhvcNAQEFBQADggEBAE/P71m+LPWybC+P7hOHMugFNahui33JaQy52Re8dyzUZ+L9mm06WVzfgwG9sq4qYXKxr83DRTCPo4MNzh1HtPGTiqN0m6TDmHKHOz6vRQuSVLkyu5AYU2sKThC22R1QbCGAColOV4xrWzw9pv3e9w0jHQtKJoc/upGSTKQZEhltV/V6WId7aIrkhoxK6+JJFKql3VUAqa67SzCu4aCxvCmA5gl35b40ogHKf9ziCuY7uLvsumKV8wVjQYLNDzsdTJWk26v5yZXpT+RN5yaZgem8+bQp0gF6ZuEujPYhisX4eOGBrr/TkJ2prfOv/TgalmcwHFGlXOxxioK0bA8MFR8wggS7MIIDo6ADAgECAgECMA0GCSqGSIb3DQEBBQUAMGIxCzAJBgNVBAYTAlVTMRMwEQYDVQQKEwpBcHBsZSBJbmMuMSYwJAYDVQQLEx1BcHBsZSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTEWMBQGA1UEAxMNQXBwbGUgUm9vdCBDQTAeFw0wNjA0MjUyMTQwMzZaFw0zNTAyMDkyMTQwMzZaMGIxCzAJBgNVBAYTAlVTMRMwEQYDVQQKEwpBcHBsZSBJbmMuMSYwJAYDVQQLEx1BcHBsZSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTEWMBQGA1UEAxMNQXBwbGUgUm9vdCBDQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOSRqQkfkdseR1DrBe1eeYQt6zaiV0xV7IsZid75S2z1B6siMALoGD74UAnTf0GomPnRymacJGsR0KO75Bsqwx+VnnoMpEeLW9QWNzPLxA9NzhRp0ckZcvVdDtV/X5vyJQO6VY9NXQ3xZDUjFUsVWR2zlPf2nJ7PULrBWFBnjwi0IPfLrCwgb3C2PwEwjLdDzw+dPfMrSSgayP7OtbkO2V4c1ss9tTqt9A8OAJILsSEWLnTVPA3bYharo3GSR1NVwa8vQbP4++NwzeajTEV+H0xrUJZBicR0YgsQg0GHM4qBsTBY7FoEMoxos48d3mVz/2deZbxJ2HafMxRloXeUyS0CAwEAAaOCAXowggF2MA4GA1UdDwEB/wQEAwIBBjAPBgNVHRMBAf8EBTADAQH/MB0GA1UdDgQWBBQr0GlHlHYJ/vRrjS5ApvdHTX8IXjAfBgNVHSMEGDAWgBQr0GlHlHYJ/vRrjS5ApvdHTX8IXjCCAREGA1UdIASCAQgwggEEMIIBAAYJKoZIhvdjZAUBMIHyMCoGCCsGAQUFBwIBFh5odHRwczovL3d3dy5hcHBsZS5jb20vYXBwbGVjYS8wgcMGCCsGAQUFBwICMIG2GoGzUmVsaWFuY2Ugb24gdGhpcyBjZXJ0aWZpY2F0ZSBieSBhbnkgcGFydHkgYXNzdW1lcyBhY2NlcHRhbmNlIG9mIHRoZSB0aGVuIGFwcGxpY2FibGUgc3RhbmRhcmQgdGVybXMgYW5kIGNvbmRpdGlvbnMgb2YgdXNlLCBjZXJ0aWZpY2F0ZSBwb2xpY3kgYW5kIGNlcnRpZmljYXRpb24gcHJhY3RpY2Ugc3RhdGVtZW50cy4wDQYJKoZIhvcNAQEFBQADggEBAFw2mUwteLftjJvc83eb8nbSdzBPwR+Fg4UbmT1HN/Kpm0COLNSxkBLYvvRzm+7SZA/LeU802KI++Xj/a8gH7H05g4tTINM4xLG/mk8Ka/8r/FmnBQl8F0BWER5007eLIztHo9VvJOLr0bdw3w9F4SfK8W147ee1Fxeo3H4iNcol1dkP1mvUoiQjEfehrI9zgWDGG1sJL5Ky+ERI8GA4nhX1PSZnIIozavcNgs/e66Mv+VNqW2TAYzN39zoHLFbr2g8hDtq6cxlPtdk2f8GHVdmnmbkyQvvY1XGefqFStxu9k0IkEirHDx22TZxeY8hLgBdQqorV2uT80AkHN7B1dSExggHLMIIBxwIBATCBozCBljELMAkGA1UEBhMCVVMxEzARBgNVBAoMCkFwcGxlIEluYy4xLDAqBgNVBAsMI0FwcGxlIFdvcmxkd2lkZSBEZXZlbG9wZXIgUmVsYXRpb25zMUQwQgYDVQQDDDtBcHBsZSBXb3JsZHdpZGUgRGV2ZWxvcGVyIFJlbGF0aW9ucyBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eQIIDutXh+eeCY0wCQYFKw4DAhoFADANBgkqhkiG9w0BAQEFAASCAQCcpr9aNh21vt6ADtIVxZMzKr/KFjRTTOYkdLQjvhChkk94dNXirAfnvU2odEbqFUpzz8UAa15oeSWW5taegTp1GHWJDG2Y7m9u/Edv+GlJMZedjEIP0+KITHhT4k6dSiQwSV6L5NVwvJJr9vkLWDsnv359BnmC4GrbR0VhNs+9xW4TLkmkDiOkEQt7S1sTk+J9CTlF69VTuhJbF88uCbW8KUNx0GyObMTHgOjKPzuH2Ya4SpyFT3kPJCzpWhQj78YHi3mpO8Xdm5awxsCR6F7qOVmseUkTrAwgruwbOvUAhEOkLsYLu2w4Y3EdQNnbBmoVnIwSkneJp1UlLCXNmRBo");

		//$this->validator_ios("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","","");
	}



	//조이톡 사용자 GCM 세션 기록 저장
	function save_id(){

		$cnt = $this->my_m->cnt("joytalk_id", array('device_id' => $this->seg_exp[4]));

		if(empty($this->session->userdata['m_userid'])){
			$m_userid = null;
		}else{
			$m_userid = $this->session->userdata['m_userid'];
		}

		if($cnt > 0){
			//기계코드가 이미 있으면 업데이트

			$datas = array(
				"reg_id"	=> $this->seg_exp[3],
				"device_id"	=> $this->seg_exp[4],
				"m_userid"	=> $m_userid,
				"up_date"		=> NOW,
				"class" => $this->seg_exp[5]
			);
			$this->my_m->update("joytalk_id", array('device_id' => $this->seg_exp[4]), $datas);

		}else{
			//기계코드가 없으면 인서트

			$datas = array(
				"reg_id"	=> $this->seg_exp[3],
				"device_id"	=> $this->seg_exp[4],
				"m_userid"	=> $m_userid,
				"reg_date"		=> NOW,
				"class" => $this->seg_exp[5]
			);
			$this->my_m->insert("joytalk_id",$datas);

		}

		echo @$this->session->userdata['m_userid'];
	}

	//앱 버전 출력
	function app_ver(){

		echo "20.0.40";	//앱버전 이곳에서 출력

	}

	function send_joytalk_id_old(){
		//예전 조이톡 사용자들에게 GCM 보내기
		//테스트용 사용안함
			exit;
			//$headers = array("Content-Type:application/json","Authorization:key=AIzaSyDAZCCVIf_qLr7ff46yp2BPmQYu3jOU4pE");

			$arr['data']['title'] = "조이헌팅";
			$arr['data']['message'] = "조이헌팅 푸시 테스트 합니다2";
			$arr['data']['count'] = 1;
			//$arr['registration_ids'][] = "cPdqtOLLGF4:APA91bGJwBtldF4DWa-5VZeDJijR_DHMUEDhCgglnAxiS4jjCxqh2i08Ue8UZf3uHynA0X0AqSGREXNDBJS_5Xm7w6EspyMhA9YLCN_-oC31uzhiWouiva8oJSWE6Gc7L-RYFQS2NwZM"; # 회사 테스트폰

			$headers = array("Content-Type:application/json","Authorization:key=AIzaSyBqpy-k5kSqnGvTGptBvKOlC3CbGVs3md8");
			$arr['registration_ids'][] = "cPdqtOLLGF4:APA91bGsh7mi0SdNrattgnS1OWv6XpjIipCkXylsfBEpDFGixnPOOy5WcDrtVqk8kD87u0lIxmbwJBwKY3FCVIexVn2NbOoWOEwwnTCkW712bg29dYrbDHBxHm4wXkVO1-bUArJuHzDb";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
			curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
			curl_setopt($ch, CURLOPT_POST,    true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
			$response = curl_exec($ch);

			var_dump($response);

			curl_close($ch);

	}

	function send_joytalk_id_old2(){
		//예전 조이톡 사용자들에게 GCM 보내기
		//전체에게 발송. 사용안할때는 막아둘것.
		exit;
		$joytalk_id_old =  $this->my_m->result_array('joytalk_id_old',null);

		for($i=1;$i<count($joytalk_id_old);$i++){
				//echo $joytalk_id_old[$i]['reg_id']."<br>";
				if(($i % 1000) == 0){
					//1000개마다 2초 쉬기
					sleep(2);				
				}


				$headers = array(
					'Accept: application/json',
					'Content-Type: application/json',
					'Authorization:key=AIzaSyBqpy-k5kSqnGvTGptBvKOlC3CbGVs3md8'
				);
			
				$url = "https://android.googleapis.com/gcm/send";

				$arr   = array();
				$arr['registration_ids'] = array();
				$arr['registration_ids'][0] = $joytalk_id_old[$i]['reg_id'];
				$arr['data'] = array();
				$arr['data']['date'] = NOW; 
				$arr['data']['push_type'] = 4; 
				$arr['data']['from_id'] = "joyhunting"; 
				$arr['data']['to_id'] = "joyhunting"; 
				$arr['data']['msg_idx'] = 1; 
				$arr['data']['message'] ='새로운 조이톡 어플이 업데이트 되었습니다. 지금 업데이트하세요.'; 
				//$arr['registration_ids'] = array();
				//$arr['registration_ids'][0] = "01082522975";

				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL,			$url);
				curl_setopt($ch, CURLOPT_HTTPHEADER,	$headers);
				curl_setopt($ch, CURLOPT_POST,			true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($ch, CURLOPT_POSTFIELDS,	json_encode($arr));
				$response = curl_exec($ch);
				//echo json_encode($arr);
				echo $i." ".$response."<br>";


		}

	}

	function close(){

	}

}

/* End of file main.php */
/* Location: ./application/controllers/music_chat.php */