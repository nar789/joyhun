<?php
class Pic_manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('profile_m');
		$this->load->helper('code_change');
		$this->load->library('member_lib');

		admin_check();
	}

	function index()  //관리자 처음화면
	{
		$this->pic_list();
	}

	function pic_list()  //프로필 사진인증 리스트
	{		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] =  urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] =  urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$search[$data['method']] = $data['s_word'];
		}

		
		@$search['TotalMembers.m_sex'] = @$data['method_sex'] =  urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sex')));

		//페이징 변수
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'member_pic', 'idx', 'user_id', 'desc'); //프로포즈 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/profile/pic_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	function pic_ok(){
		$idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		$user = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'user')));

		$arr_data = array(
			"pic_status "			=> "인증완료",
			"pic_admin_date"		=> NOW,
			"pic_admin_memo"		=> ''
		);


		// 대표사진이 있는 사람인지 체크
		$main_chk = $this->my_m->cnt('member_pic', array("user_id" => $user, "is_main_pic" => 'y'));

		// 대표사진 없으면 대표사진으로 등록
		if ($main_chk['cnt'] == 0){

			$main_add = $this->my_m->row_array('member_pic', array("user_id" => $user, "idx" => $idx));
			$pic_main_add = $this->my_m->update("TotalMembers", array("m_userid" => $user), array('m_filename' => $main_add['pic_file_name'],'m_filename_update' => NOW));
			
			$arr_data['is_main_pic'] = 'y';
		}

		$rtn = $this->my_m->update('member_pic', array("idx" => $idx), $arr_data);
		echo  $rtn;
	}

	function pic_no(){
		$idx = rawurldecode($this->input->post('idx',TRUE));
		$ban_text = rawurldecode($this->input->post('ban_text',TRUE));
		
		//정보 불러오기
		$pic_row = $this->my_m->row_array('member_pic', array('idx' => $idx));
		if(!$pic_row){exit;}

		$arr_data = array(
			"pic_status "			=> "인증거부",
			"pic_admin_date"		=> NOW,
			"pic_admin_memo"	=> $ban_text
		);
		$rtn = $this->my_m->update('member_pic', array("idx" => $idx), $arr_data);

		//대표사진일때 해제
		if($pic_row['is_main_pic'] == "y"){
			$this->my_m->update("TotalMembers", array("m_userid" => $pic_row['user_id']), array('m_filename' => '') );
		}

		echo  $rtn;
	}

	function pic_del(){
		$idx = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'idx')));
		
		$arr_data = array(
			"pic_status "			=> "인증완료",
			"pic_admin_date"		=> NOW
		);
		$rtn = $this->my_m->update('member_pic', array("idx" => $idx), $arr_data);
		echo  $rtn;
	}


	//프로필 사진 삭제
	function admin_pic_del(){

		$num = $this->security->xss_clean(url_explode($this->seg_exp, 'num')); if(!$num){exit;}
		$user_id = $this->security->xss_clean(url_explode($this->seg_exp, 'user_id')); if(!$user_id){exit;}

		//정보 불러오기
		$pic_row = $this->my_m->row_array('member_pic', array('user_id' => $user_id, 'pic_num' => $num));
		if(!$pic_row){exit;}

		$arr_data = array(
			"user_id "			=> $user_id,
			"pic_num"		=> $num
		);

		$pic_row = $this->my_m->row_array('member_pic', $arr_data, 'idx',"desc");

		//파일에서 삭제
		$this->member_lib->delete_thumb($pic_row['pic_file_name']);

		//대표사진일때 해제
		if($pic_row['is_main_pic'] == "y"){
			$this->my_m->update("TotalMembers", array("m_userid" => $user_id), array('m_filename' => '') );
		}

		//DB에서 삭제
		$arr_data = array(
			"pic_num "			=> $num,
			"user_id"		=> $user_id
		);

		$rtn = $this->my_m->del("member_pic", $arr_data);

		echo $rtn;
	}


	function pic_list_test()  //프로필 사진인증 리스트
	{
		
		//검색이 있을경우
		if( in_array('q', $this->seg_exp) )
		{
			$data['s_word'] =  urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'q')));
			$data['method'] =  urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'sfl')));
			$search[$data['method']] = $data['s_word'];
		}

		
		@$search['TotalMembers.m_sex'] = @$data['method_sex'] =  "F";
		@$search['TotalMembers.m_pwd2'] = "needting";

		//페이징 변수
		$page = $this->pre_paging();
		$rp =100; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);

		$result = $this->my_m->get_list($start, $rp, @$search, 'member_pic', 'idx', 'user_id', 'desc'); //프로포즈 리스트

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $result[1];
		
		$data['pagination_links'] = pagination_admin($this->seg_exp, paging($page,$rp,$data['getTotalData'],$limit));
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/profile/pic_list_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */