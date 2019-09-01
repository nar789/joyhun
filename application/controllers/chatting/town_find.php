<?php

class Town_find extends MY_Controller {

	//5분거리 친구찾기
	function __construct()
	{
		parent::__construct();

		$this->load->model('chatting_m');
		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('m_top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('level_helper');

	}

	function age_chatting_list($tab_menu)
	{	
		
		if(IS_LOGIN == true){ 
			member_session_up(); //latest_helper 세션값 업데이트 
		}
		
		//파라미터 변수 받기
		$data['val1'] = $val1 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val1')));		//시, 도
		$data['val2'] = $val2 = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val2')));		//구, 군
		

		//네이버 API 관련 key value(common_helper)
		$cId		= SITE_NAVER_ID;
		$cSecret	= SITE_NAVER_PW;

		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);

		if(IS_MOBILE == true){
			//모바일버전의 경우

			//모바일 로그인 체크
			user_check(null,0);

			if(empty($member_data['m_xpoint']) and empty($member_data['m_ypoint'])){
				//맵 좌표가 없을경우 내위치 변경 페이지로 이동
				goto('/chatting/town_find/my_position_map');
			}

			if(!empty($val1) and !empty($val2)){
				//검색조건이 있을경우
				$addr = $val1." ".$val2;

				$geo = get_naver_gps_code($addr, $cId, $cSecret);			//좌표구하기(common_helper)
			
				$map_data = json_decode($geo, 1);

				$data['map_x_point'] = @$map_data['result']['items'][0]['point']['x'];
				$data['map_y_point'] = @$map_data['result']['items'][0]['point']['y'];

				$m_conregion = $val1;
				$m_conregion2 = $val2;
				
				$data['map_flag'] = "1";
			}else{
				//검색조건이 없을경우
				$data['map_x_point'] = $member_data['m_xpoint'];
				$data['map_y_point'] = $member_data['m_ypoint'];
				
				$data['val1'] = $m_conregion = $member_data['m_conregion'];
				$data['val2'] = $m_conregion2 = $member_data['m_conregion2'];

				$data['map_flag'] = "";
			}

			$data['my_position_x'] = $member_data['m_xpoint'];
			$data['my_position_y'] = $member_data['m_ypoint'];

			//페이징 변수
			$page = $data['page'] = $this->pre_paging();
			$rp = 20; //리스트 갯수
			$limit = 9; //보여줄 페이지수
			$start = (($page-1) * $rp);

			$limit_rand = mt_rand(200, 400);

			//if(!$m_result = $this->cache->get('m.town_find.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'])){
				$m_result = $this->chatting_m->age_chatting_list_test(reverse_sex($member_data['m_sex']), $m_conregion, $m_conregion2, $member_data['m_xpoint'], $member_data['m_ypoint'], $limit_rand, $start, $rp);
			//	$this->cache->save('m.town_find.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'], $m_result, 1800);	//30분 캐시 사용
			//}
			
			$data['mlist'] = $mlist = $m_result[0];
			$data['getTotalData']= $total= $m_result[1];
			$data['mlist2'] = $m_result[2];
			
			$data['pagination_links'] = pagination($this->seg_exp, paging($page, $rp, $total, $limit));
			
			$add_marker = "";
				
			if(!empty($mlist)){

				foreach($mlist as $val){
					
					$add_marker .= "
						var markerOptions = {
							position: new naver.maps.LatLng('".$val['m_ypoint']."', '".$val['m_xpoint']."'),
							map: map,
							title: '".$val['m_nick']."',
							icon: {
								url: '".img_src_ex($this->member_lib->member_thumb($val['m_userid'], 40, 40))."',
								size: new naver.maps.Size(40,40),
								origin: new naver.maps.Point(0, 0),
								anchor: new naver.maps.Point(11, 35)
							}
						};

						var marker = new naver.maps.Marker(markerOptions);
					";
				}
			}
			
			$data['add_marker'] = $add_marker;
			
			//view 설정
			$top_data['add_css'] = array("/m/m_town_friend_css");
			$top_data['add_js'] = array("/m/m_town_friend_js");

			$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩
			
			if(IS_APP and APP_OS == "IOS"){
				array_push($top_data['add_css'], "/m/m_ios_add_css");
			}

			//추가 스크립트(검색조건 때문에 추가)
			$bot_data['add_script'] = "			
			<script type='text/javascript'>
				$(document).ready(function(){
					area_select('".$data['val1']."', 'town_area_2');
					$('#town_area_2').val('".$data['val2']."');
				});
			</script>
			";

			$this->load->view('m/m_top_v',$top_data);
			$this->load->view('m/town_friend/m_town_friend_v',@$data);
			$this->load->view('m/m_bottom_v', $bot_data);


		}else{
			//PC버전의 경우

			//로그인 여부 체크
			user_check(null,0);


			if($data['val1']){ $search['AA.m_conregion']  = $data['val1']; }else{ $search['AA.m_conregion'] = "서울"; $data['val1'] = "서울"; }		//시, 도 검색조건(default : 서울)
			if($data['val2']){ $search['AA.m_conregion2'] = $data['val2']; }else{ $search['AA.m_conregion2'] = "강남구"; $data['val2'] = "강남구"; }		//구, 군 검색조건(default : 강남구)

			if($member_data['m_conregion'] == $data['val1'] and $member_data['m_conregion2'] == $data['val2']){
				$data['my_position'] = "get";
			}

			//지도에 표시될 회원의 데이터 가져오기 

			if(!$addr_data = $this->cache->get('town_find.map.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'])){
				$addr_data = $this->chatting_m->geo_naver($data['val1'], $data['val2'], '100');
				$this->cache->save('town_find.map.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'], $addr_data, 1800);	//30분 캐시 사용
			}

			$search['ex_m_userid'] = "AA.m_userid <> '".$this->session->userdata['m_userid']."' ";		//현재접속자에 본인은 빼기
			
			//네이버 지도 좌표 구하기
			//주소 만들기
			$addr = $data['val1']." ".$data['val2'];					//주소		
			$geo  = get_naver_gps_code($addr, $cId, $cSecret);			//좌표구하기(common_helper)

			$map_data = json_decode($geo, 1);

			$data['map_x_point'] = @$map_data['result']['items'][0]['point']['x'];
			$data['map_y_point'] = @$map_data['result']['items'][0]['point']['y'];

			//페이징 변수
			$page = $this->pre_paging();
			$rp =10; //리스트 갯수
			$limit = 9; //보여줄 페이지수
			$start = (($page-1) * $rp);
		
			if($page == "1"){
				if(!$m_result = $this->cache->get('town_find.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'])){
					$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
					$this->cache->save('town_find.'.$data['val1'].'.'.$data['val2'].'.'.$this->session->userdata['m_sex'], $m_result, 1800);	//30분 캐시 사용
				}
			}else{
				$m_result = $this->chatting_m->age_chatting_list($start, $rp, $tab_menu, @$search);
			}

			$data['mlist'] = $m_result[0];
			$data['getTotalData']= $total= $m_result[1];
		
			$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

			if(!@empty($m_result)){
				//접속회원 좌표 셋팅
				$data['member_geo'] = @member_geo($addr, $cId, $cSecret, $addr_data, $geo);		//common_helper
			}

			// view 설정
			$navs = array('조이채팅','5분거리 친구찾기'); //상단메뉴에 들어가는 현재위치
			$top_data['top_menu'] = $this->top_menu_lib->view('chatting',$navs); //탑메뉴 로딩
			$data['right_menu'] = $this->right_menu_lib->view('meeting_beongae'); //우측메뉴 로딩

			$top_data['add_css'] = array("chatting/chatting_css");
			$top_data['add_js'] = array("chatting/town_find_js");
			
			$data['call_top'] = $this->call_top($data); //본문 상단
			$data['call_tabmenu'] = $this->call_tabmenu($tab_menu, $data); //탭메뉴

			//추가 스크립트(검색조건 때문에 추가)
			$bot_data['add_script'] = "
			
			<script type='text/javascript'>
				$(document).ready(function(){
					area_select('".$data['val1']."', 'town_area_2');
					$('#town_area_2').val('".$data['val2']."');
				});
			</script>
			";

			$this->load->view('top_v',$top_data);
			$this->load->view('chatting/town_find_v', $data);
			$this->load->view('bottom_v', $bot_data);

		}
				
		
	}

	function order_login(){
		$this->age_chatting_list(1); //최근 로그인순
	}

	function order_join_date(){
		$this->age_chatting_list(2); //최근 가입순
	}

	function order_activity_v(){
		$this->age_chatting_list(3); //활동량 많은순
	}

	function order_activity_cnt(){
		$this->age_chatting_list(4); //활동현황순
	}

	function order_like_cnt(){
		$this->age_chatting_list(5); //인기 지수순
	}

	function order_manner(){
		$this->age_chatting_list(6); //매너 점수순
	}


	function call_top($data){
		//본문 상단
		ob_start();
		
		$this->load->view('chatting/town_find_top_v', $data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_tabmenu($tab_menu, $data){
		//상단 탭메뉴

		for($i=1;$i<10;$i++){
			if($i == $tab_menu){
				$data["tap_menu_css_$i"]  = "tab_on";
			}else{
				$data["tap_menu_css_$i"]  = "tab_off";
			}
		}

		ob_start();
		
		$this->load->view('chatting/town_find_tabmenu_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	//모바일 5분거리 리스트 더보기
	function more_find_friend(){

		//지역 변수 받기
		$data['val1'] = $val1 = rawurldecode($this->input->post('val1', true));
		$data['val2'] = $val2 = rawurldecode($this->input->post('val2', true));
		
		$member_data = $this->member_lib->get_member($this->session->userdata['m_userid']);
		
		//페이징 변수
		$page = rawurldecode($this->input->post('page', true));
		$rp = $data['rp'] = 20; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$m_conregion = $val1;
		$m_conregion2 = $val2;

		$m_result = $this->chatting_m->age_chatting_list_test(reverse_sex($member_data['m_sex']), $m_conregion, $m_conregion2, $member_data['m_xpoint'], $member_data['m_ypoint'], '500', $start, $rp);

		$mlist = $m_result[2];

		if(empty($mlist)){
			echo "0";		//데이터가 더이상 없을경우
		}else{

			$add_html = "";
			$i = $start;

			$last_km = (rand(1,2)/10);

			foreach($mlist as $data){

				if($data['m_sex'] == "M"){
					$class_color = "color_02bae2";
				}else{
					$class_color = "color_ea3c3c";
				}

				$add_html .= "
					<div class='height_60 width_100per line-height_55 border_bottom_1_ececec'>
						<div class='member_thumb margin_top_5'>".$this->member_lib->member_thumb($data['m_userid'], 80, 80)."</div>
						<b class='".$class_color." pointer margin_top_5 media_nick_class'>".$data['m_nick']."</b>
						<b class='color_888 pointer media_age_class'>(".$data['m_age'].")</b>
						<div class='m_cont_right_box' id='aaa".$i."' m_userid='".$data['m_userid']."' class='secret_btn' onclick='javascript:redirect_chat(".$i.");'>
							<div class='m_cont_right_btn blod'>5분거리 대화하기</div>
						</div>
						<div class='float_right width_60 color_888 media_km_class margin_top_20 _distance'>
							".$data['to_distance']."km
						</div>
					</div>
				";
				$i++;
				$last_km = $last_km + (rand(1,15) / 100);
			}
			
			echo $add_html;
		}

	}

	// 5분거리 접속이성 찾기 검색
	function banner_cnt(){

		$search['ex_m_conregion']			= "TotalMembers_login.m_conregion = '".rawurldecode($this->input->post('m_conregion', true))."'";
		$search['ex_m_conregion2']			= "TotalMembers_login.m_conregion2 = '".rawurldecode($this->input->post('m_conregion2', true))."'";

		$friend_chk = $this->chatting_m->cnt('TotalMembers_login', $search);

        $final_search = $friend_chk."##";

		$friend_mb = $this->chatting_m->result_array('TotalMembers_login', $search);

		for($i=0; $i<$friend_chk; $i++){

			$userid = $friend_mb[$i]['m_userid'];
		
			// 프로필 보기
			ob_start();
			user_check("view_profile('".$userid."');");
			$find_profile = ob_get_contents();
			ob_end_clean();

			// 메세지 보내기
			ob_start();
			user_check("send_message('".$userid."','send','');");
			$find_mesege = ob_get_contents();
			ob_end_clean();

			$final_search .= "<div class='find_member_box'>";
			$final_search .= "<div onclick=\"".$find_profile."\">".$this->member_lib->member_thumb($friend_mb[$i]['m_userid'],40,40)."</div><ul>";
			$final_search .= "<li><p>".$friend_mb[$i]['m_nick']."</p></li><li>".$friend_mb[$i]['m_conregion']." ".$friend_mb[$i]['m_conregion2']."</li></ul>";
			$final_search .= "<div class='find_5_btn' onclick=\"".$find_mesege."\">메세지</div></div>";

		}

		echo $final_search;

	}


	//내위치 변경 페이지
	function my_position_map(){
		
		//파라미터 변수 받기
		$data['val1'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val1')));		//시, 도
		$data['val2'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'val2')));		//구, 군

		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ goto('/'); }
		
		$mdata = $this->member_lib->get_member($user_id);
	
		//검색조건이 있을경우 지도 재정의 
		if(empty($data['val1']) or empty($data['val2'])){
			//검색을 하지 않았을경우
			if(empty($mdata['m_xpoint']) or empty($mdata['m_ypoint'])){
				//x좌표 혹은 y좌표가 없을경우 회원 지역으로 좌표 재정의
				$point = getGeo($mdata['m_userid']);
				$data['xpoint'] = $point[0];
				$data['ypoint'] = $point[1];
			}else{
				$data['xpoint'] = $mdata['m_xpoint'];
				$data['ypoint'] = $mdata['m_ypoint'];
			}

			$data['my_position'] = "get";		//내위치 marker 표시

			$data['val1'] = $mdata['m_conregion'];
			$data['val2'] = $mdata['m_conregion2'];

		}else{
			//검색을 하였을 경우			
			if($mdata['m_conregion'] == $data['val1'] and $mdata['m_conregion2'] == $data['val2']){
				//회원지역과 검색지역이 같을경우
				$data['my_position'] = "get";
				$data['xpoint'] = $mdata['m_xpoint'];
				$data['ypoint'] = $mdata['m_ypoint'];
			}else{

				$addr = $data['val1']." ".$data['val2'];

				$geo = get_naver_gps_code($addr, SITE_NAVER_ID, SITE_NAVER_PW);

				$map_data = json_decode($geo, 1);

				$data['xpoint'] = @$map_data['result']['items'][0]['point']['x'];
				$data['ypoint'] = @$map_data['result']['items'][0]['point']['y'];
				
				$data['my_position'] = "get";		//내위치 marker 표시

				//지역변경시 본인 위치 변경
				$this->my_position_up($data['xpoint'].",".$data['ypoint']);
			}
		}

		$data['marker'] = $data['xpoint'].",".$data['ypoint'];

		//view 설정
		$top_data['add_css'] = array("/m/m_town_friend_css");
		$top_data['add_js'] = array("/m/m_town_friend_js");

		$top_data['top_menu'] = $this->m_top_menu_lib->view(); //탑메뉴 로딩


		$bot_data['add_script'] = "
		<script type='text/javascript'>
			
			$(document).ready(function(){
				area_select('".$data['val1']."', 'town_area_2');
				$('#town_area_2').val('".$data['val2']."');
			});

		</script>
		";

		$this->load->view('m/m_top_v',$top_data);
		$this->load->view('m/town_friend/m_my_position_v', $data);
		$this->load->view('m/m_bottom_v', $bot_data);
	}

	//내위치 변경함수
	function my_position_up($map_val = null){
		
		if(empty($map_val)){
			$val = rawurldecode($this->input->post('val', true));
		}else{
			$val = $map_val;
		}		

		//좌표로 지역 찾아오기
		$get_addr = get_naver_gps_code_reverse($val, SITE_NAVER_ID, SITE_NAVER_PW);
		$map_data = json_decode($get_addr, 1);
		$addr = @$map_data['result']['items'][0]['address'];

		if(!empty($addr)){			
			$addr_array = explode(" ", $addr);
			$m_conregion = get_my_position($addr_array[0]);
			$m_conregion2 = $addr_array[1];
		}
		
		$user_id = $this->session->userdata['m_userid'];
		if(empty($user_id)){ echo "1000"; exit; }

		if(!empty($m_conregion) and !empty($m_conregion2)){
			$this->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_conregion' => $m_conregion, 'm_conregion2' => $m_conregion2));
		}else{
			echo "1000"; exit;		//잘못된 접근
		}

		$map = explode(",", $val);
		$map_x = $map[0];
		$map_y = $map[1];
		
		$rtn = $this->my_m->update('TotalMembers', array('m_userid' => $user_id), array('m_xpoint' => $map_x, 'm_ypoint' => $map_y));
		
		if(empty($map_val)){ echo $rtn; }
		
	}



}

/* End of file main.php */
/* Location: ./application/controllers/ */