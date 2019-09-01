<?php
class Gift_management extends MY_Controller {

	function __construct(){

		parent::__construct();
		
		$this->load->model('admin/payment_m');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->library('member_lib');

		admin_check();

	}

	function index(){
		$this->gift_list();
	}
	
	//상품관리
	function gift_list(){

		$uri_array = $this->seg_exp;

		//변수받기
		$data['v_vendor']			= $v_vendor			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'vendor')));						//벤더(업체)
		$data['v_category']			= $v_category		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'category')));					//카테고리
		$data['v_delivery']			= $v_delivery		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'delivery')));					//배송방식
		$data['v_use_yn']			= $v_use_yn			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'use_yn')));						//진열상태(A:모두, Y:진열함, N:진열안함)
		$data['v_date_1']			= $v_date_1			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'date_1')));						//등록일자1
		$data['v_date_2']			= $v_date_2			= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'date_2')));						//등록일자2
		$data['v_price_p']			= $v_price_p		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'price_p')));					//가격(포인트)
		$data['v_price_w']			= $v_price_w		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'price_w')));					//가격(원)
		$data['v_price_m']			= $v_price_m		= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'price_m')));					//가격(이익)
		$data['v_product_code']		= $v_product_code	= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'product_code')));				//상품코드
		$data['v_product_name']		= $v_product_name	= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'product_name')));				//상품이름
		$data['v_product_vendor']	= $v_product_vendor	= rawurldecode($this->security->xss_clean(@url_explode($uri_array, 'product_vendor')));				//상품코드(업체)

		//if(empty($v_date_1)){ $data['v_date_1'] = $v_date_1 = date('Y-m-')."01"; }
		if(empty($v_date_2)){ $data['v_date_2'] = $v_date_2 = date('Y-m-d'); }
		
		//검색조건
		$search = array(
			"V_VENDOR"			=> $v_vendor,
			"V_CATEGORY"		=> str_replace("|", "/", $v_category),
			"V_DELIVERY"		=> $v_delivery,
			"ex_V_WRITEDATE1"	=> "V_WRITE_DATE >= '".$v_date_1." 00:00:00'",
			"ex_V_WRITEDATE2"	=> "V_WRITE_DATE <= '".$v_date_2." 24:00:00'",
			"V_PRICE_P"			=> $v_price_p,
			"V_PRICE_W"			=> $v_price_w,
			"V_PRICE_M"			=> $v_price_m,
			"V_PRODUCT_CODE"	=> $v_product_code,
			"ex_V_PRODUCT_NAME"	=> "V_PRODUCT_NAME LIKE '%".$v_product_name."%'"
		);

		if(!empty($v_use_yn) and $v_use_yn != 'A'){
			$search['V_USE_YN'] = $v_use_yn;
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp = 10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		//저장된 상품 데이터 가져오기
		$data_array = $this->my_m->get_list_solo($start, $rp, @$search, 'GIFT_LIST', 'V_PRIORITY', 'DESC', '*');

		$data['plist']			= $data_array[0];
		$data['getTotalData']	= $data_array[1];
	
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page, $rp, $data['getTotalData'], $limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/gift/gift_management_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}
	
	//상품등록 팝업
	function reg_product_pop(){

		$v_idx = $this->security->xss_clean(@url_explode($this->seg_exp, 'v_idx'));		//상품 코드 받아오기
		
		//상품코드가 있을경우(수정)
		if(!empty($v_idx)){
			$data['v_title'] = "상품수정";
			
			$data['pdata'] = $pdata = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $v_idx));	//등록된 상품데이터 가져오기
		}else{
			$data['v_title'] = "상품등록";
		}
		
		//view 설정
		$this->load->view('admin/admin_top0_v');
		$this->load->view('admin/gift/gift_management_pop_v', $data);
		$this->load->view('admin/admin_bottom0_v');
	}

	//상품등록
	function register_product(){
		
		$v_idx				= $this->input->post('v_idx', true);					//고유번호
		$v_vendor			= $this->input->post('v_vendor', true);					//업체
		$v_category			= $this->input->post('v_category', true);				//카테고리
		$v_delivery			= $this->input->post('v_delivery', true);				//배송방식
		$v_price_p			= $this->input->post('v_price_p', true);				//가격(포인트)
		$v_price_w			= $this->input->post('v_price_w', true);				//가격(원)
		$v_price_m			= $this->input->post('v_price_m', true);				//가격(이익)
		$v_product_code		= $this->input->post('v_product_code', true);			//상품코드
		$v_product_name		= $this->input->post('v_product_name', true);			//상품이름
		$v_contents_1		= $this->input->post('v_contents_1', true);				//상품설명(상세정보)
		$v_contents_2		= $this->input->post('v_contents_2', true);				//상품설명(이용안내)
		$v_memo				= $this->input->post('v_memo', true);					//메모
		$v_use_yn			= $this->input->post('v_use_yn', true);					//진열여부
		
		//상품 이미지 파일 경로
		$dir = "/resource/product_upload/gift/";

		$config['upload_path']		= $dir;
		$config['allowed_types']	= 'gif|jpg|png|bmp|jpeg';
		$config['max_size']			= '1000';
		$config['max_width']		= '2048';
		$config['max_height']		= '1536';
		
		$this->load->library('upload', $config);

		//상품등록에 필요한 데이터 배열
		$arrData = array(
			"V_CATEGORY"			=> $v_category,
			"V_VENDOR"				=> $v_vendor,
			"V_PRODUCT_CODE"		=> $v_product_code,
			"V_PRODUCT_NAME"		=> $v_product_name,
			"V_DELIVERY"			=> $v_delivery,
			"V_PRICE_P"				=> $v_price_p,
			"V_PRICE_W"				=> $v_price_w,
			"V_PRICE_M"				=> $v_price_m,
			"V_CONTENTS_1"			=> $v_contents_1,
			"V_CONTENTS_2"			=> $v_contents_2,
			"V_MEMO"				=> $v_memo,
			//"V_PRIORITY"			=> null,
			"V_USE_YN"				=> $v_use_yn,
			"V_WRITE_DATE"			=> NOW
		);

		//상품 이미지 업로드
		if(!$this->upload->do_upload('product_img')){

			if(!empty($v_idx)){
				//상품이미지를 변경하지 않고 수정할 경우
				$this->reg_GIFT_LIST('up', $arrData, $v_idx);
			}else{
				//상품 이미지 업로드 실패했을경우
				echo iconv('utf-8', 'euc-kr', strip_tags($this->upload->display_errors()));
			}	
			
		}else{
			//상품 이미지 업로드 성공했을경우
			//리턴값 file_name, file_pth, full_path
			$data = $this->upload->data();
			
			//파일업로드시 이미지 경로 추가 
			$arrData["V_IMG_URL"] = $data['file_name'];
			
			//파일을 업로드 하고 등록 및 수정을 할경우
			if(!empty($v_idx)){
				$this->reg_GIFT_LIST('up', $arrData, $v_idx);		//상품 수정을 할경우
			}else{
				//등록된 상품중에 마지막 순번이 마지막인 상품데이터 가져오기
				$last_data = $this->my_m->row_array('GIFT_LIST', @$search, 'V_PRIORITY', 'DESC', '1');

				$v_priority = "";		//노출순위 등록

				if(empty($last_data)){
					$v_priority = "0";
				}else{
					$v_priority = $last_data['V_PRIORITY']+1;
				}

				$arrData['V_PRIORITY'] = $v_priority;

				$this->reg_GIFT_LIST('in', $arrData, null);		//상품 등록을 할경우
			}
	
		}

	}


	//상품 등록 및 수정하기 함수(insert, update) 변수 처리 insert : in, update : up
	function reg_GIFT_LIST($mode, $arrData, $v_idx = null){
		
		if(empty($mode)){ exit; }

		if($mode == "in"){
			//상품 등록하기
			$rtn = $this->my_m->insert('GIFT_LIST', $arrData);
		}else{
			//상품 수정하기
			$rtn = $this->my_m->update('GIFT_LIST', array('V_IDX' => $v_idx), $arrData);
		}

		if($rtn == "1"){
			alert_close_reload('상품이 저장되었습니다.');
		}

	}

	//상품 삭제 함수
	function product_del(){
		
		$v_idx = rawurldecode($this->input->post('v_idx', true));

		$rtn = $this->my_m->del('GIFT_LIST', array('V_IDX' => $v_idx));

		echo $rtn;

	}

	//상품 진열 여부 함수
	function product_display(){

		$v_idx		= rawurldecode($this->input->post('v_idx', true));
		$v_use_yn	= rawurldecode($this->input->post('v_use_yn', true));

		$rtn = $this->my_m->update('GIFT_LIST', array('V_IDX' => $v_idx), array('V_USE_YN' => $v_use_yn));

		echo $rtn;
	}


	//상품 노출 순서 처리 함수
	function call_product_priority(){

		$mode		= rawurldecode($this->input->post('mode', true));
		$idx		= rawurldecode($this->input->post('idx', true));
		$category	= rawurldecode($this->input->post('category', true));

		if(empty($mode) or empty($idx) or empty($category)){
			//잘못된 접근처리
			echo "1000"; exit;
		}

		$result = $this->my_m->result_array('GIFT_LIST', array('V_CATEGORY' => $category, 'V_USE_YN' => 'Y'), 'V_PRIORITY', 'DESC', NULL);
		
		$rtn_idx = "";

		if($mode == "up"){
			for($i=0; $i<count($result); $i++){

				if($result[$i]['V_IDX'] == $idx){
					$rtn_idx = @$result[$i-1]['V_IDX'];
					break;
				}
			}
		}else if($mode == "down"){
			for($i=0; $i<count($result); $i++){

				if($result[$i]['V_IDX'] == $idx){
					$rtn_idx = @$result[$i+1]['V_IDX'];
					break;
				}
			}
		}else{
			//잘못된 접근처리
			echo "1000"; exit;
		}

		if(empty($rtn_idx)){
			//해상상품이 최상위 혹은 최하위에 진열된경우 처리
			echo "1001"; exit;
		}else{

			$data_1 = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $idx, 'V_USE_YN' => 'Y'), 'V_IDX', 'DESC', '1');				//선택 상품의 데이터
			$data_2 = $this->my_m->row_array('GIFT_LIST', array('V_IDX' => $rtn_idx, 'V_USE_YN' => 'Y'), 'V_IDX', 'DESC', '1');			//선택 상품의 상,하위 데이터

			//두 데이터의 순번 바꾸기
			$rtn1 = $this->my_m->update('GIFT_LIST', array('V_IDX' => $idx, 'V_USE_YN' => 'Y'), array('V_PRIORITY' => $data_2['V_PRIORITY']));
			$rtn2 = $this->my_m->update('GIFT_LIST', array('V_IDX' => $rtn_idx, 'V_USE_YN' => 'Y'), array('V_PRIORITY' => $data_1['V_PRIORITY']));
			

			if($rtn1 == "0" or $rtn2 == "0"){
				echo "0";
			}else{
				echo "1";
			}
		}

	}
	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/