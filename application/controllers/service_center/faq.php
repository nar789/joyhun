<?php

class Faq extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->helper('code_change_helper');
	}

	function privacy(){
		$this->faq_list('1');
	}
	
	function login_faq(){
		$this->faq_list('2');
	}

	function service_faq(){
		$this->faq_list('3');
	}

	function payment(){
		$this->faq_list('4');
	}

	function faq_list($chatset_sub = null){
		

		$f1 = $this->security->xss_clean(urldecode(url_explode($this->seg_exp, 'f1')));	//카테고리1
		$f2 = $this->security->xss_clean(urldecode(url_explode($this->seg_exp, 'f2')));	//카테고리2
		
		$f1 =  iconv_substr($f1,0,12,"utf-8");
		$f2 =  iconv_substr($f2,0,12,"utf-8");

		$data['s_word'] = $this->security->xss_clean(rawurldecode($this->input->post('qna_sch',TRUE)));	//검색어
		if(!empty($data['s_word'])){
			$data['s_word'] =  iconv_substr($data['s_word'],0,10,"utf-8");
				
			$search['ex_s_word'] = "(title like '%".$data['s_word']."%' or content like '%".$data['s_word']."%')";
		}
		
		$navs = array('홈','고객센터','FAQ'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/faq_js");

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$data['call_search'] = $this->call_search(); //FAQ 검색창

		if(!empty($chatset_sub)){ 
			$data['call_category'] = $this->call_category($chatset_sub); //FAQ 상단 카테고리 제목
		}else{
			//FAQ 전체 검색으로 넘어왔을때
			$data['call_category'] = "<p class='color_333 blod font-size_18 margin_top_38' id='privacy_title'>FAQ 전체검색</p>";
		}
		

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$f1 = str_replace("|","/",$f1);
		$f2 = str_replace("|","/",$f2);

		//카테고리가 넘어왔으면
		if($f1)
		{	
			$search['gubn1'] = $f1;
			$search['gubn2'] = $f2;
		}
		else
		{
			//FAQ 전체 검색으로 넘어오지 않았을때만 제목 출력
			if(!empty($chatset_sub)){
				$array = faq_category($chatset_sub);
				$search['gubn1'] = $array['faq_title'];
			}
		}
		
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'faq_list', 'idx', 'desc'); //FAQ 리스트
		$data['flist'] = $result[0];
		$data['getTotalData'] = $result[1];
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));

		$bot_data['add_script'] = "
		<script>
			$(document).ready(function(){
				var cate = decodeURIComponent('".$f2."');
				$('#qna_sch').val('".$data['s_word']."');	
				if(cate){
					for(i=0; i<=10; i++){
						var sub_id = $('#idx_'+i).text();
						if(sub_id.indexOf(cate) != '-1'){
							$('#idx_'+i).addClass('faq_cate_on');
						}else{
							$('#idx_'+i).removeClass();
							$('#idx_t').removeClass();
						}
					}
				}	
			});			
		</script>
		";
		
		//view 설정
		$this->load->view('top_v',$top_data);
		$this->load->view('service_center/faq_v',@$data);
		$this->load->view('bottom_v', @$bot_data);
		
	}

	function call_search(){
		//FAQ 검색
		ob_start();
		
		$this->load->view('service_center/faq_search_v');

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function call_category($chatset_sub){
		//FAQ 카테고리

		$data = faq_category($chatset_sub);
		$data['cate_cnt'] = count($data);	//카테고리의 갯수
		$data['chatset_sub'] = $chatset_sub;
		
		ob_start();

		$this->load->view('service_center/faq_cate_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function qna_rpy_view(){
		
		// FAQ 답변보이기 (AJAX 리턴)
		$t_idx = rawurldecode($this->input->post('t_idx', true));	//FAQ idx	
		$data['list'] = $this->my_m->row_array("faq_list", array('idx' => $t_idx) );
		$contents = nl2br($data['list']['content']);	
		echo $contents;

	}

	function faq_cate1_call(){		//고객상담문의하기 첫번째 질문분류
		$select_num = $this->security->xss_clean(url_explode($this->seg_exp, 'sel1_val')) ; 

		$data_arr = faq_category($select_num);
		$txt = "";

		for ($i=1; $i < count($data_arr)+1; $i++){
			if($txt != ""){$txt .= "♬";}
			$txt .= $data_arr[$i]['faq_title'];
		}

		echo $txt;
	}

	function faq_cate2_call(){		//고객상담문의하기 두번째 질문분류

		//넘어온 faq값
		$select_num = $this->security->xss_clean(url_explode($this->seg_exp, 'sel1_val')) ; 

		$data_arr = faq_category($select_num);

		$txt = "";
		foreach($data_arr as $key => $value){
			
			if($key == "cate"){
				foreach($value as $key2 => $value2){
					if($txt != ""){$txt .= "♬";}
					$txt .= $value2;
				}
			}

		}

		echo $txt;

	}


	
}

/* End of file main.php */
/* Location: ./application/controllers/*/

