<?php
class Event extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/event_m');

		admin_check();
	}
	
	function index(){
		$this->event_list();
	}

	//관리자 페이지 이벤트 등록 리스트
	function event_list(){
		
		//검색조건 변수받기
		$data['v'] = $v = rawurldecode($this->input->post('v_search', true));
		$data['q'] = $q = rawurldecode($this->input->post('q', true));
		
		if(!@empty($v)){
			if($v == "m_idx"){
				$search['ex_v'] = $v." = ".$q;
			}else{
				$search['ex_v'] = $v." like '%".$q."%' ";
			}
		}		

		$data['m_type'] = "frmList";

		//페이징 변수
		//이벤트
		$page = $this->pre_paging();
		$rp =10; //리스트 갯수
		$limit = 9; //보여줄 페이지수
		$start = (($page-1) * $rp);
		
		$result = $this->event_m->event_list($start, $rp, @$search, 'reg_event_list');

		$data['mlist'] = $result[0];
		$data['getTotalData'] = $total = $result[1];

		$data['pagination_links'] = pagination($this->seg_exp, paging($page,$rp,$total,$limit));

		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/service_center/event_v', $data);
		$this->load->view('admin/admin_bottom_v');

	}
	
	//관리자 페이지 이벤트 등록/수정 페이지
	function event_write(){

		$m_idx = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'm_idx')));		//게시물번호 받아오기
		
		if(!@empty($m_idx)){
			$data = $this->my_m->row_array('reg_event_list', array('m_idx' => $m_idx));		//등록된 이벤트 내용 가져오기
			$data['m_type'] = "frmView";
		}else{
			$data['m_type'] = "frmWrite";
		}

		$data['reg_temp'] = "event";

		//view 설정
		$top_data['add_js'] = array("naver/HuskyEZCreator");

		$this->load->view('admin/admin_top_v', $top_data);
		$this->load->view('admin/service_center/event_write_v', $data);
		$this->load->view('admin/admin_bottom_v');
	}
	
	//이벤트 등록하기
	function reg_event_data(){
		
		$fname			= rawurldecode($this->input->post('fname', true)); 
		$m_idx			= rawurldecode($this->input->post('m_idx', true)); 
		$m_start_day	= rawurldecode($this->input->post('m_start_day', true)); 
		$m_last_day		= rawurldecode($this->input->post('m_last_day', true)); 
		$m_title		= rawurldecode($this->input->post('m_title', true)); 
		$m_sub_content	= rawurldecode($this->input->post('m_sub_content', true)); 
		$m_list_file	= rawurldecode($this->input->post('m_list_file', true)); 
		$m_main_file	= rawurldecode($this->input->post('m_main_file', true)); 
		$m_contents		= rawurldecode($this->input->post('m_contents', true)); 
		$m_use_yn		= rawurldecode($this->input->post('m_use_yn', true)); 
		$m_move_url		= rawurldecode($this->input->post('m_move_url', true)); 
		$m_gubn			= rawurldecode($this->input->post('m_gubn', true)); 
		
		$v_table = "reg_event_list";		//이벤트 등록 테이블

		if(empty($m_idx) || $m_idx == ""){
			$m_idx = $this->event_m->event_idx($v_table);		//첫 이벤트 동록이나 신규등록일경우 m_idx 값 추가
		}
		
		$arrData = array(
			"m_idx"				=> $m_idx,
			"m_title"			=> $m_title,
			"m_sub_content"		=> $m_sub_content,
			"m_list_img_url"	=> $m_list_file,
			"m_main_img_url"	=> $m_main_file,
			"m_contents"		=> $m_contents,
			"m_write_day"		=> date('Y-m-d'),
			"m_start_day"		=> $m_start_day,
			"m_last_day"		=> $m_last_day,
			"m_use_yn"			=> $m_use_yn,
			"m_move_url"		=> $m_move_url,
			"m_gubn"			=> $m_gubn
		);

		if($fname == "frmWrite"){
			//이벤트 신규등록
			$rtn = $this->my_m->insert($v_table, $arrData);

		}else if($fname == "frmView"){
			//이벤트 수정
			$rtn = $this->my_m->update($v_table, array("m_idx" => $m_idx), $arrData);

		}else{
			//잘못된 접근
			$rtn = "9";
		}

		echo $rtn;
		
	}

	//이벤트 삭제하기 
	function del_event(){
		
		$m_idx			= rawurldecode($this->input->post('m_idx', true));	//삭제할 게시물 번호

		$rtn = $this->my_m->del('reg_event_list', array('m_idx' =>  $m_idx));

		if($rtn == "1"){
			echo "1";		//성공
		}else{
			echo "9";		//실패
		}
	}


	//리스트 이미지 등록 팝업
	function list_photo_pop(){

		$data['set_id'] = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'set_id')));
		
		if($data['set_id'] == "" || empty($data['set_id'])){
			alert_close('잘못된접근입니다.');
			exit;
		}

		//view 설정
		$this->load->view('admin/admin_top0_v');
		$this->load->view('admin/layer_popup/list_photo_layer_v', $data);
		$this->load->view('admin/admin_bottom0_v');
	}

	//리스트 이미지 등록
	function list_img_reg(){

		$set_id = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'set_id')));
		
		$config['upload_path'] = '/resource/naver_upload/event/';
		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size']	= '1000';
		$config['max_width']  = '2048';
		$config['max_height']  = '1536';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = $this->upload->display_errors();
			
			echo $error;

			$bot_data['add_script'] =  "
			<script type='text/javascript'>
				$(document).ready(function(){
					alert('$error');
					self.close();
				});
			</script>
			";
		}	
		else
		{
			//리턴값 file_name, file_pth, full_path
			$data = $this->upload->data();
			
			$full_file_name = $data['file_name'];		//업로드 사진 파일명

			$bot_data['add_script'] =  "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#".$set_id."', opener.document).val('$full_file_name');
					self.close();
				});
			</script>
			";

		}

		$this->load->view('admin/admin_top0_v');
		$this->load->view('admin/admin_bottom0_v', @$bot_data);

		

	}

	//이벤트 등록 파일 업로더 페이지
	function event_file_upload(){
		
		// default redirection
		$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
		$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

		// SUCCESSFUL
		if(bSuccessUpload) {

			$tmp_name = $_FILES['Filedata']['tmp_name'];
			$name = $_FILES['Filedata']['name'];

			//파일명 겹치지 않게 변경하기
			$name_val = explode('.', $name);
			
			if(count($name_val) == "2"){
				$name = "joy_event_".date('YmdHis').".".$name_val[1];
			}			
			
			$filename_ext = strtolower(array_pop(explode('.',$name)));
			$allow_file = array("jpg", "png", "bmp", "gif");
			
			if(!in_array($filename_ext, $allow_file)) {
				$url .= '&errstr='.$name;
				
			} else {

				$uploadDir = '/resource/naver_upload/event/';
				if(!is_dir($uploadDir)){
					mkdir($uploadDir, 0777);
				}
				
				$newPath = $uploadDir.$name;
		
				@move_uploaded_file($tmp_name, $newPath);
				
				$url .= "&bNewLine=true";
				$url .= "&sFileName=".urlencode(urlencode($name));
				$url .= "&sFileURL=/upload/naver_upload/event/".urlencode(urlencode($name));

			}
		}
		// FAILED
		else {
			$url .= '&errstr=error';
		}
		
		//echo "<script>alert('$name_val');</script>"; exit;
		//header('Location: '. $url);
		echo "<script>location.href='$url';</script>";
	}

	
	//이벤트 삭제하기 
	function del_mb_event(){
		
		$m_idx			= rawurldecode($this->input->post('m_idx', true));	//삭제할 게시물 번호

		$rtn = $this->my_m->del('reg_event_member', array('m_idx' =>  $m_idx));

		if($rtn == "1"){
			echo "1";		//성공
		}else{
			echo "9";		//실패
		}
	}


}

/* End of file main.php */
/* Location:  /application/controllers/admin/ */