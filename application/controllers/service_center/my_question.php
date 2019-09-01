<?php

class My_question extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('service_m');
		$this->load->library('top_menu_lib');
		$this->load->library('right_menu_lib');
		$this->load->helper('code_change_helper');
	}


	function my_question_write_mobile(){

		
		$browser = get_browser(null, true);

		if(@$browser) {
			$arr_data['f_os']		= $browser['platform'];
			$arr_data['f_browser']  = $browser['browser']." ".$browser['version'];
		}

		if(IS_LOGIN){
			$arr_data['f_userid'] = $this->session->userdata['m_userid'];
			$arr_data['f_name'] = $this->session->userdata['m_name'];

			$location = '/service_center/my_question/my_question_list';
		}else{
			$arr_data['f_userid']  = "비회원";
			$arr_data['f_name'] =  "비회원";

			$location = '/service_center';
		}

		$mode= strip_tags(rawurldecode($this->input->post('mode', true)));

		// PC 버전이면 이메일input 2개 통합
		if($mode == 'pver'){
			$arr_data['f_mail']			= strip_tags(rawurldecode($this->input->post('qna_email_1', true)))."@".strip_tags(rawurldecode($this->input->post('qna_email_2', true)));

		// MO 버전이면 이메일input 1개
		}else{
			$arr_data['f_mail']			= strip_tags(rawurldecode($this->input->post('qna_email', true)));
		}

		// 제목, 질문분류, 연락처, 질문내용, 첨부파일 (PC, Mobile 공통)
		$arr_data['f_title']			= strip_tags(rawurldecode($this->input->post('qna_title', true)));
		$arr_data['f_cate1']			= strip_tags(rawurldecode($this->input->post('qna_cate_select', true)));
		$arr_data['f_cate2']			= strip_tags(rawurldecode($this->input->post('qna_sub_select', true)));
		$arr_data['f_tel']				= strip_tags(rawurldecode($this->input->post('qna_ph', true)));
		$arr_data['f_content']			= strip_tags(rawurldecode($this->input->post('qna_content', true)));
		$arr_data['f_answerYN']			= "N";
		$arr_data['f_writeday']			= NOW;

		if(empty($arr_data['f_title']) or empty($arr_data['f_content'])){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><script>alert('잘못된 접근입니다.'); location.reload();</script>";
			return;
		}

		//첨부파일이 있으면
		if(@$_FILES['qna_upload']['name']) { 

			$config['upload_path'] = '/resource/joyhunting_upload/qna/';
			$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
			$config['max_size']	= '1000';
			$config['max_width']  = '2048';
			$config['max_height']  = '1536';

			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('qna_upload'))
			{
				echo strip_tags($this->upload->display_errors());
				exit;
			}	
			else
			{
				//리턴값 file_name, file_pth, full_path
				$data = $this->upload->data();
				$arr_data['f_filename'] = $data['file_name'];
			}

		//첨부파일이 없으면
		}else{
			$arr_data['f_filename'] = '';
		}
		// DATA insert
		$rtn = $this->my_m->insert("Faq_reporter", $arr_data);

		if($rtn == '1'){
			echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><script>alert('정상적으로 접수되었습니다. 답변은 이메일로 발송해드리겠습니다.');window.history.go(-1);</script>";
		}
	}

	function my_question_list(){	// 나의 문의내역 리스트

		user_check();

		$search['f_userid'] = $this->session->userdata['m_userid'];		//"workdict";

		$page = $this->pre_paging();
		$rp =15; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'Faq_reporter', 'f_num', 'f_userid', 'desc'); //FAQ 리스트


		$data['flist'] = $result[0];
		$data['getTotalData'] = $result[1];
		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		$data['page'] = $page;
		
		$navs = array('홈','고객센터','나의문의내역'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩

		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/my_question_js");

		$data['faq_menu'] = faq_category('all'); //카테고리 변환을위해서 전체 카테고리 호출

		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$this->load->view('top_v',$top_data);		
		$this->load->view('service_center/my_question_v',$data);
		$this->load->view('bottom_v');
	}

	function my_question_view(){	// 나의 문의내역 뷰페이지

		$data['page'] = $page = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
		$data['f_num'] = $f_num = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'f_num')));
		$data['quest'] = $this->my_m->row_array("Faq_reporter", array('f_num' => $f_num) );

		$data['faq_menu'] = faq_category('all'); //카테고리 변환을위해서 전체 카테고리 호출


		$navs = array('홈','고객센터','나의문의내역'); //상단메뉴에 들어가는 현재위치
		$top_data['top_menu'] = $this->top_menu_lib->view('privacy',$navs); //탑메뉴 로딩
		$top_data['add_css'] = array("service_center/service_css");
		$top_data['add_js'] = array("service_center/my_question_js");

		$search['f_userid'] = $this->session->userdata['m_userid']; //"workdict";

		
		$data['right_menu'] = $this->right_menu_lib->view('service'); //우측메뉴 로딩

		$this->load->view('top_v',$top_data);
			
		$this->load->view('service_center/my_question_read_v',$data);

		$this->load->view('bottom_v');
	}

	function my_question_del(){	// 나의문의내역 삭제

		$f_num = rawurldecode($this->input->post('f_num',TRUE));

		$rtn = $this->my_m->del('Faq_reporter', array('f_num' => $f_num));

		echo $rtn;
	}

}

/* End of file main.php */
/* Location: ./application/controllers/*/

