<?php

class Point extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');		
		$this->load->library('member_lib');
		$this->load->library('sms_lib');

		$this->load->library('m_top_menu_lib');
	}

	function ma_point($tabmenu)
	{

		user_check(null,0);

		//회원데이터 가져오기 
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		if($member_data['m_type'] == "F"){
			$data['flg'] = "F";		//일반회원
			goto('/profile/point/point_charge');
		}else{
			$data['flg'] = "V";		//정회원
		}
	
		//조회기간 변수
		$mode				= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'i')));
		$before_date		= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'before_date')));
		$after_date			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'after_date')));
		
		if($mode == ""){ $mode = "2"; }		//mode 값이 없을 경우 기본값 : 2 셋팅

		//조회기간 기본값(1개월) 셋팅 search_helper
		if(!@$after_date || !@$before_date){
			$search_date = point_date_search();
			
			//조회기간 년,월,일 셋팅(기본값)
			$date_data = array(
				"a_year"	=> $search_date['a_year'],
				"a_month"	=> $search_date['a_month'],
				"a_day"		=> $search_date['a_day'],
				"b_year"	=> $search_date['b_year'],
				"b_month"	=> $search_date['b_month'],
				"b_day"		=> $search_date['b_day']
			);
			
			$before_date = date_value($search_date['b_year'], $search_date['b_month'], $search_date['b_day']);
			$after_date = date_value($search_date['a_year'], $search_date['a_month'], $search_date['a_day']);
		}else{

			$b_date = date_split($before_date);		//이전날짜 쪼개기
			$a_date = date_split($after_date);		//현재날짜 쪼개기

			//조회기간 년,월,일 셋팅
			$date_data = array(
				"a_year"	=> $a_date['year'],
				"a_month"	=> $a_date['month'],
				"a_day"		=> $a_date['day'],
				"b_year"	=> $b_date['year'],
				"b_month"	=> $b_date['month'],
				"b_day"		=> $b_date['day']
			);
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		if($tabmenu == "1"){
			//포인트 사용내역
			$search = array(
				"member_point_list.m_userid"  => $this->session->userdata['m_userid'],
				"ex_m_tradeid" => "m_tradeid is null",
				"ex_m_writedate" => "REPLACE(DATE(m_writedate), '-', '') >= '".$before_date."' and REPLACE(DATE(m_writedate), '-', '') <= '".$after_date."' ",
			);

			$data['use_gubn'] = "사용";

		}else{
			//포인트 충전내역
			$search = array(
				"member_point_list.m_userid"  => $this->session->userdata['m_userid'],
				"ex_m_tradeid" => "m_tradeid is not null",
				"ex_m_writedate" => "REPLACE(DATE(m_writedate), '-', '') >= '".$before_date."' and REPLACE(DATE(m_writedate), '-', '') <= '".$after_date."' ",
			);	

			$data['use_gubn'] = "충전";
		}

		$date_data['tabmenu'] = $tabmenu;		//조회url 때문에 넘김

		$result = $this->my_m->get_list($start, $rp, $search, 'member_point_list', 'm_idx', 'm_userid');	//포인트 사용 및 충전내역
		
		$data['mlist']			= $result[0];
		$data['getTotalData']	= $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		$navs = array('프로필','포인트/충전'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/point_js");

		$data['call_tabmenu'] = $this->call_tabmenu($tabmenu); //포인트 탭메뉴
		$data['call_search'] = $this->call_search(@$date_data); //포인트 검색창
		
		//보유포인트
		$data['tp'] = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));
		
		$bot_data['add_script'] = "
		<script>
			$(document).ready(function(){
				
				for(i=1; i<5; i++){

					if('".$mode."' == i){
						$('#btn_date'+i).removeClass('term_chos_no').addClass('term_chos');
					}else{
						$('#btn_date'+i).removeClass('term_chos').addClass('term_chos_no');
					}
				}

			});
		</script>
		";

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/point_v', $data);
		$this->load->view('bottom_v', @$bot_data);
	}

	function point_list()
	{	
		$this->ma_point(1); //포인트 사용내역
	}

	function charge_list()
	{
		$this->ma_point(2); //포인트 충전하기
	}


	function point_charge()
	{
		//로그인여부 확인
		user_check(null,5);

		//정회원인지 구분(정회원이 아닐경우만 이페이지에서 결제)
		//회원정보가져오기(세션값)
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//이미 정회원인경우 결제페이지를 레이어팝업으로 이동(m_type : V=정회원, F=일반회원)
		if($member_data['m_type'] == "F"){
			
		}else{
			goto('/profile/point/point_list');
		}
		
		//$this->ma_point(2); //포인트 충전내역
		$navs = array('프로필','채팅함'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('profile',$navs); //탑메뉴 로딩
		$data['right_menu'] = $this->right_menu_lib->view('profile_right'); //우측메뉴 로딩

		$top_data['add_css'] = array("profile/profile_css");
		$top_data['add_js'] = array("profile/point_js");

		$this->load->view('top_v',$top_data);
		$this->load->view('profile/point_first_v', $data);
		
		$this->load->view('bottom_v');
	}
	
	function call_tabmenu($num){
		//포인트 상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $num){
				$data["tap_menu_css_$i"]  = "tab_on";			
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";			
			}
		}

		ob_start();

		//회원데이터 가져오기 
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		if($member_data['m_type'] == "F"){
			$data['flg'] = "F";		//일반회원
		}else{
			$data['flg'] = "V";		//정회원
		}

		$this->load->view('profile/point_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_search($date_data){
		//포인트 검색
		ob_start();
		
		$this->load->view('profile/point_search_v', $date_data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function point_add_popup(){
		//포인트충전하기 레이어팝업 AJAX

		//회원의 총 포인트 가져오기
		$member_total_point = $this->my_m->row_array('member_total_point', array('m_userid' => $this->session->userdata['m_userid']));

		$data['t_point'] = @$member_total_point['total_point'];		//개인 총 충전 포인트

		//상품메뉴
		$product_list = $this->my_m->result_array('product_list', array('m_use_yn' => 'Y', 'm_gubn' => 'V'), 'm_product_code', 'asc');		//상품리스트

		$data['mlist'] = $product_list;

		//view 설정
		$top_data['add_css'] = array("layer_popup/point_add_popup_css");
		$top_data['add_js'] = array("layer_popup/point_add_popup_js");
		$top_data['add_title'] = "포인트충전하기";
		$top_data['add_text'] = "";

		$data['placeholder'] = true;

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/point_add_popup_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//무통장입금 레이어 팝업
	function mu_account_deposit(){

		$data['mode']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));		//결제방법(mu : 무통장입금)
		$data['code']			= rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'code')));		//상품코드

		$product_list = $this->my_m->row_array('product_list', array('m_product_code' => $data['code'], 'm_use_yn' => 'Y'));		//상품코드로 상품내역 가져오기
		
		$data['plist'] = $product_list;
		
		$data['deposit_tit'] = "무통장 입금을 선택하셨습니다.<br>아래 내용을 확인하시고 [결제하기]버튼을 클릭하시면 결제가 진행됩니다.";

		//view 설정
		$top_data['add_css'] = array("layer_popup/point_add_popup_css");
		$top_data['add_js'] = array("layer_popup/point_add_popup_js");
		$top_data['add_title'] = "포인트충전하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/mu_account_deposit_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');

	}

	//무통장입금 결과 레이어팝업
	function mu_account_deposit_result(){

		$data['tid'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'tid')));		//거래번호

		$user_trade_data = $this->my_m->row_array('payment_temp', array('m_cash_gb' => 'MU', 'm_tradeid' => $data['tid'], 'm_card_ok' => 'N'));		//거래신청내역 가져오기

		$data['deposit_tit'] = "입금정보 입력이 완료되었습니다.<br>아래의 계좌번호로 24시간 이내에 입금해주시면 처리해드리겠습니다.";

		$data['mlist'] = array(
			"m_name"		=> $user_trade_data['m_mstr'],
			"m_price"		=> $user_trade_data['m_price']
		);

		if(IS_MOBILE == true){
			$data['flg'] = "m";
			$data['customer_contents'] = "&nbsp;&nbsp;※입금후에도 결제완료 처리가 되지않을경우 꼭 고객센터로<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;문의해주시기 바랍니다.<br>
			&nbsp;&nbsp;※고객센터 070-7434-2782 (평일 10시~12시, 13~17시)";
		}else{
			$data['flg'] = "p";
			$data['customer_contents'] = "&nbsp;&nbsp;※입금후에도 결제완료 처리가 되지않을경우 꼭 고객센터로 문의해주시기 바랍니다.<br>
			&nbsp;&nbsp;※고객센터 070-7434-2782 (평일 10시~12시, 13~17시)";
		}

		//view 설정
		$top_data['add_css'] = array("layer_popup/point_add_popup_css");
		$top_data['add_js'] = array("layer_popup/point_add_popup_js");
		$top_data['add_title'] = "포인트충전하기";
		$top_data['add_text'] = "";

		$this->load->view('layer_popup/popup_top_v', $top_data);
		$this->load->view('layer_popup/mu_account_deposit_result_v', $data);
		$this->load->view('layer_popup/popup_bottom_v');
	}


	//무통장입금 결제하기 버튼
	function mu_deposit_btn_event(){

		$code		= rawurldecode($this->input->post('code', true));
		$m_name		= rawurldecode($this->input->post('m_name', true));
		$m_hp1		= rawurldecode($this->input->post('m_hp1', true));
		$m_hp2		= rawurldecode($this->input->post('m_hp2', true));
		$m_hp3		= rawurldecode($this->input->post('m_hp3', true));

		$hptele = $m_hp1.$m_hp2.$m_hp3;

		//거래번호만들기
		$str_rand = str_pad(mt_rand(0, 999999), 6, 0);				//랜덤 6자리 숫자 
		$tid = 'MU_joyhunting_'.date('YmdHis')."_".$str_rand;			//거래번호만들기
		
		$membere_data = $this->member_lib->get_member($this->session->userdata['m_userid']);							//회원정보가져오기
		$product_list = $this->my_m->row_array('product_list', array('m_product_code' => $code, 'm_use_yn' => 'Y'));	//상품내역가져오기

		if(IS_MOBILE == true){
			if(IS_APP == true){
				$m_pay_gubn = "A";
			}else{
				$m_pay_gubn = "M";
			}			
		}else{
			$m_pay_gubn = "P";
		}
		
		//결제 시도데이터
		$temp_arrData = array(
			
			"m_userid"				=> $membere_data['m_userid'],
			"m_product_code"		=> $product_list['m_product_code'],
			"m_goods"				=> $product_list['m_goods'],
			"m_price"				=> $product_list['m_price'],
			"m_point"				=> $product_list['m_point'],
			"m_cash_gb"				=> 'MU',
			"m_commid"				=> '',
			"m_mobilid"				=> '',
			"m_mrchid"				=> '',
			"m_mstr"				=> $m_name,
			"m_hp"					=> $hptele,
			"m_payeremail"			=> $membere_data['m_mail'],
			"m_card_ok"				=> 'N',
			"m_tradeid"				=> $tid,
			"m_signdate"			=> '',
			"m_payment_gb"			=> 'MU',
			"m_result_code"			=> '',
			"m_writedate"			=> NOW,
			"m_pay_gubn"			=> $m_pay_gubn

		);

		$rtn = $this->my_m->insert('payment_temp', $temp_arrData);

		if($rtn == "1"){
			//문자로 계좌번호 보내기
			$sms_rtn = $this->sms_lib->sms_send('', array($hptele), "조이헌팅입니다.\n상품명 : ".$product_list['m_goods']."\n상품 금액 : ".$product_list['m_price']."원\n입금은행 : 우리은행\n계좌번호 : 1005-301-131626\n예금주 : 위드유(이흥일) 입니다.");		//문자메시지 발송
			echo $tid;
		}else{
			echo "0";
		}

	}


	//모바일 포인트 충전 페이지
	function point_list_mobile(){

		//모바일 버전의 경우
		//모바일 로그인 체크
		user_check(null,0);
		
		//회원데이터 가져오기
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		//정회원인지 체크
		if($member_data['m_type'] == "F"){
			goto('/profile/point/payment_f');
		}
		
		$code = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'code')));
		$mode = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'mode')));
		

		//회원 보유 포인트 가져오기(point_helper)
		$data['total_point'] = total_point_sum($this->session->userdata['m_userid']);
			
		//상품 리스트 가져오기
		//m_use_yn (Y:현재 파는 상품, N:현재 팔지 않는 상품), m_gubn(F:첫구매고객상품, V:정회원전용구매상품, A:관라자전용)
		$data['product_list'] = $this->my_m->result_array('product_list', array('m_use_yn' => 'Y', 'm_gubn' => 'V'), 'm_product_code', 'asc');

		$top_data['add_css'] = array("/m/m_point_css");
		$top_data['add_js'] = array("/m/m_point_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"포인트 충전"); //탑메뉴 로딩
		
		//파라미터에 상품코드와 결제방법이 있을경우 결제 결과 팝업 띄우기
		if(!empty($code) && !empty($mode)){
			$bot_data['add_script'] = "
			<script type='text/javascript'>
				
				$(document).ready(function(){
					payment_popup('$code', '$mode');					
				});

			</script>
			";
		}

		$this->load->view('/m/m_top_v',$top_data);
			$this->load->view('/m/etc/m_point_v', @$data);
		$this->load->view('m/m_bottom0_v', @$bot_data);

	}

	//모바일페이지 정회원 결제페이지
	function payment_f_mobile(){
		
		//정회원관련 상품만 출력
		$search = array("ex_where" => "(m_product_code = '1001' or m_product_code = '2001' or m_product_code = '2002' or m_product_code = '2003')");
		$data['product_list'] = $this->my_m->result_array('product_list', @$search, 'm_idx', 'asc', null);

		//view 설정
		//if($_SERVER["REMOTE_ADDR"] == "14.33.132.241"){
		//	$top_data['add_css'] = array("/m/m_jung_css2");
		//}else{
			if(IS_APP){ 
				$top_data['add_css'] = array("/m/m_jung_css2");
			}else{
				$top_data['add_css'] = array("/m/m_jung_css");
			}
		//}

		$top_data['add_js'] = array("/m/m_jung_js", "/m/m_point_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view('single_back',"포인트 충전"); //탑메뉴 로딩

		$this->load->view('m/m_top_v',$top_data);
		//if($_SERVER["REMOTE_ADDR"] == "14.33.132.241"){
		//	$this->load->view('m/etc/m_jung2_v', @$data);
		//}else{

			if(IS_APP){ 
				$this->load->view('m/etc/m_jung2_v', @$data);
			}else{
				$this->load->view('m/etc/m_jung_v', @$data);
			}
		//}
		
		$this->load->view('m/m_bottom0_v', @$bot_data);

	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/