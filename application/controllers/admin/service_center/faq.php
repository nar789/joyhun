<?php
class Faq extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();
	}

	function faq_view()  // 조회
	{

		$userid = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));
		if(empty($userid)){alert_only("회원아이디가 넘어오지 않았습니다.");}
		
		//회원정보 불러오기
		$data['views'] = $this->member_lib->get_member($userid);

		if(empty($data['views'])){alert_only("존재하지 않는 회원입니다.");}


		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/faq_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}

	function faq_write()
	{
		$idx = rawurldecode($this->input->post('idx',TRUE));

		$data = array(
			'userid' => $this->session->userdata('userid'),
			'nick' =>  $this->session->userdata('nickname'),
			'title' => rawurldecode($this->input->post('title',TRUE)),
			'content' => rawurldecode($this->input->post('content',TRUE)),
			'gubn1' => rawurldecode($this->input->post('gubn1',TRUE)),
			'gubn2' => rawurldecode($this->input->post('gubn2',TRUE)),
			'order' => rawurldecode($this->input->post('order',TRUE)),
			"f_date"		=> NOW
		);
	
		if(@$idx){
			$rtn = $this->my_m->update("faq_list", array('idx' => $idx), $data);
		}else{
			$rtn = $this->my_m->insert("faq_list", $data);
		}
		echo $rtn;		//정상등록
	}

	function faq_modi()  //faq 내용보기
	{
		$data['idx'] = $idx = urldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'idx')));
		
		if(!empty($idx)){ //idx값이 넘어오면 수정
			$data['list'] = $this->my_m->row_array("faq_list", array('idx' => $idx) );
			$gubn1 = $data['list']['gubn1'];
			$gubn2 = $data['list']['gubn2'];

			$bot_data['add_script'] = "
			<script>
				$(document).ready(function(){					
					qna_select('$gubn1', 'faq_cate_select2','$idx');

					$('#faq_cate_select').val('$gubn1').attr('selected', 'selected');
					$('#faq_cate_select2').val('$gubn2').attr('selected', 'selected');
				});
			</script>
			";
		}
		
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/faq_write_v',@$data);
		$this->load->view('admin/admin_bottom_v', @$bot_data);
		
	}


	function faq_list()  //FAQ 리스트
	{
		
		//검색이 있을경우
		$data['s_word'] = $this->input->post('q',TRUE);
		if(!empty($data['s_word'])){
			$search['ex_s_word'] = "(title like '%".$data['s_word']."%' or content like '%".$data['s_word']."%')";
		}

		//검색후 페이징처리를 위해 주소에서 page를 삭제
		$url = implode('/', url_delete($this->seg_exp, 'page'));

		$search['gubn1'] = $data['sel1'] = $this->input->post('sel1',TRUE);
		$search['gubn2'] = $data['sel2'] = $this->input->post('sel2',TRUE);

		if(empty($search['gubn1'])){
			//1차분류가 없을때
			$data['faq_sub_select_style'] = "hidden";
		}else{
			//1차분류가 들어왔을때
			$data['faq_sub_select_style'] = "";
			$key = faq_sub_category($search['gubn1']); //배열에서 value 검색해서 key value 리턴
			$array = faq_category($key);

			$data['sfl_arr2'] = $array['cate'];
		}

		$view_mode = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'view_mode')));
		if($view_mode){
			$search['ex_choice'] = 'choice is not null';
		}

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'faq_list', 'idx', 'userid', 'desc'); //FAQ 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/faq_v', @$data);
		$this->load->view('admin/admin_bottom_v');

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

		ob_start();
		$this->load->view('service_center/faq_cate_v',$data);

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	//FAQ 리스트 삭제
	function del_faq(){

		$m_idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		
		$rtn = $this->my_m->del('faq_list', array('idx' => $m_idx));
		
		echo $rtn;
	}

	function add_question(){


		$search['idx']	 = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		$check['choice'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'num')));

		$check_cnt = $this->my_m->cnt('faq_list', $check);

		//이미 해당 순서에 등록이 되어있을경우
		if ($check_cnt != 0){
			
			echo "4";
		
		// 자주묻는질문으로 추가
		}else{

			$set_array = array(
				'choice'			=>	$check['choice']
			);

			$check_cnt = $this->my_m->update('faq_list', $search, $set_array);
			echo $check_cnt;

		}

	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */