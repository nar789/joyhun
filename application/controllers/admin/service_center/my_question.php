<?php

class My_question extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->helper('alrim_helper');

		admin_check();
	}




	function my_question_view(){  //나의문의내역 내용보기

		$data['page'] = $page = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
		$data['f_num'] = $f_num = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'f_num')));
		$data['quest'] = $this->my_m->row_array("Faq_reporter", array('f_num' => $f_num) );

		$data['faq_menu'] = faq_category('all'); //카테고리 변환을위해서 전체 카테고리 호출

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/my_question_write_v',@$data);
		$this->load->view('admin/admin_bottom_v', @$bot_data);
	}

	function my_question_modi(){	// 나의문의내역 수정

		$f_num = rawurldecode($this->input->post('f_num',TRUE));
		$f_alrim = rawurldecode($this->input->post('f_alrim',TRUE));
		$data= array(
			'f_answerid' => $this->session->userdata('username'),
			'f_answer' => rawurldecode($this->input->post('f_answer',TRUE)),
			'f_answerYN' => "Y",
			'f_answerwriteday' => NOW
		);

		$rtn = $this->my_m->update("Faq_reporter", array('f_num' => $f_num), $data);

		if($rtn == 1){
			joyhunting_alrim("고객문의답변", $f_alrim);

			$search['f_num'] = $f_num;
			$data = $this->my_m->row_array('Faq_reporter', $search);

			$data['ye'] = substr($data['f_writeday'], 0, 3);
			$data['mo'] = substr($data['f_writeday'], 5, 2);
			$data['da'] = substr($data['f_writeday'], 8, 2);
			
			$html = "";
			$html .= $this->load->view('top0_v', @$top_data, true);
			$html .= $this->load->view('intro/question_e_mail_v', $data, true);
			$html .= $this->load->view('bottom0_v', @$bot_data, true);
			
			//alrim_helper 이메일보내기(수신자, 타이틀, 내용)
			$email_rtn = joyhunting_email(rawurldecode($this->input->post('f_email',TRUE)), '조이헌팅 문의답변입니다.', $html);

			return $email_rtn;

		}

	}

	function my_question_del(){	// 나의문의내역 삭제

		$f_num = rawurldecode($this->input->post('f_num',TRUE));

		$rtn = $this->my_m->del('Faq_reporter', array('f_num' => $f_num));

		echo $rtn;

	}


	function my_question_list(){	// 나의문의내역 리스트

		//검색이 있을경우
		//아이디
		$data['s_word'] = trim($this->input->post('q',TRUE));
		if(!empty($data['s_word'])){
			$search['ex_s_word'] = "(Faq_reporter.f_userid like '%".$data['s_word']."%' or Faq_reporter.f_name like '%".$data['s_word']."%')";
		}
		//전화번호
		$data['search_word'] = $this->input->post('p',TRUE);
		if(!empty($data['search_word'])){
			$search['ex_search_word'] = "(Faq_reporter.f_tel like '%".$data['search_word']."%') ";
		}


		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		 $data['sel1'] = $this->input->post('sel1',TRUE);
		 $data['sel2'] = $this->input->post('sel2',TRUE);

		if(!empty($data['sel1'])){

			$key = faq_sub_category($data['sel1']); //배열에서 value 검색해서 key value 리턴
			$array = faq_category($key);
			$data['sfl_arr2'] = $array['cate'];
			
			$key2 = array_search($data['sel2'],$data['sfl_arr2']);

			$search['f_cate1'] = $key;
			$search['f_cate2'] = $key2;
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		$result = $this->my_m->get_list_solo($start, $rp, @$search, 'Faq_reporter', 'f_num'); //FAQ 리스트

		//print_r($result[0]);

		$data['my_quest_list'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		$data['page'] = $page;

		$data['faq_menu'] = faq_category('all'); //카테고리 변환을위해서 전체 카테고리 호출
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/my_question_v', @$data);
		$this->load->view('admin/admin_bottom_v');
	}



}

?>