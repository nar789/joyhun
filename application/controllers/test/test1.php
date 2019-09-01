<?
class Test1 extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->helper('code_change');
		$this->load->helper('point');
		$this->load->helper('partner');
	}

	function test22(){
			partner_send_curl('JOIN', 'ljw1997', null);
	}

	function testpage()
	{
		$top_data['add_css'] = array("test/test_css");
		$top_data['add_js'] = array("test/test_js");

//		$this->load->view('top_intro_v',$top_data);
		$this->load->view('test/test_v');


	}

	function testpage2()
	{


		$top_data['add_css'] = array("test/test2_css");
		$top_data['add_js'] = array("test/test2_js");

//		$this->load->view('top_intro_v',$top_data);
		$this->load->view('test/test2_v');
                                                                                                                                                                                                                                                          
	}
	function test_post() {
	$test['time'] = NOW;
			
	$test['time'] = rawurldecode($this->input->post('time', true));
	$test['name'] = rawurldecode($this->input->post('name', true));
	$test['title'] = rawurldecode($this->input->post('title', true));
	$test['intro'] = rawurldecode($this->input->post('intro', true));
	
	print_r($test);

	}

	function id_check(){


		$userid = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'userid')));

		$check = $this->my_m->cnt('TotalMembers_login', array("m_userid" => $userid));

		echo $check;

 // Produces: INSERT INTO mytable (title, name, date) VALUES ('{$title}', '{$name}', '{$date}')




		/*
		$m_alrim = $this->my_m->row_array('m_userid' => $m_userid);
		
		/* $user = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'user'))); 

		$v_result = $this->profile_m->my_id_find('TotalMembers', 'id');		//회원아이디 검색

		$result		= $v_result[0];		//아이디결과값
		$total_rows = $v_result[1];		//아이디총갯수
		*/
				
		

	}
			/*$str = $this->a_member_m->id_check($id);
			if ($str > 0)
			{
				$this->form_validation->set_message('id_check', '중복된 아이디입니다.');
				return FALSE;
			}
			else if (in_array($id))
			{
				$this->form_validation->set_message('id_check', '사용할 수 없는 아이디입니다.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		//$userid = $search['m_userid'] = urldecode($this->security->xss_clean(url_explode($this->seg_exp, 'userid')));
		//$data['urerid'] = $this->my_m->cnt('TotalMembers', $search);
			 
		//아이디 중복검사
		//$data['userid'] = $this->member_lib->get_member($userid);
		//if(empty($data['userid'])){alert_only("사용하실 수 있습니다.");}
		//$cnt=mysql_num_rows($
		/* 
		post 방식 
		$page = rawurldecode($this->input->post('page', true)); 
		*/		
		


	function encrypt($string, $key) {
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	function decrypt($string, $key) {
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	function aes_encrypt($plaintext, $password) { 
		$password = hash('sha256', $password, true); 
		$plaintext = gzcompress($plaintext); 
		$iv_source = defined('MCRYPT_DEV_URANDOM') ? MCRYPT_DEV_URANDOM : MCRYPT_RAND; 
		$iv = mcrypt_create_iv(32, $iv_source); 
		$ciphertext = mcrypt_encrypt('rijndael-256', $password, $plaintext, 'cbc', $iv); 
		$hmac = hash_hmac('sha256', $ciphertext, $password, true); 
		return base64_encode($ciphertext . $iv . $hmac); 
	}

	function aes_decrypt($ciphertext, $password) { 

		$ciphertext = @base64_decode($ciphertext, true); 
		if ($ciphertext === false) return false; 
		$len = strlen($ciphertext); 
		if ($len < 64) return false; 
		$iv = substr($ciphertext, $len - 64, 32); 
		$hmac = substr($ciphertext, $len - 32, 32); 
		$ciphertext = substr($ciphertext, 0, $len - 64); 
		$password = hash('sha256', $password, true); 
		$hmac_check = hash_hmac('sha256', $ciphertext, $password, true); 
		if ($hmac !== $hmac_check) return false; 
		$plaintext = @mcrypt_decrypt('rijndael-256', $password, $ciphertext, 'cbc', $iv); 
		if ($plaintext === false) return false; 
		$plaintext = @gzuncompress($plaintext); 
		if ($plaintext === false) return false; 
		return $plaintext; 
	} 


}


/*		$this->email->from('admin@joyhunting.net', 'joyhunting');
		$this->email->to('wwkorea@nate.com'); 
		$this->email->subject('이메일 발송 테스트입니다.');
		$this->email->message('이메일 발송 내용입니다.');

		$this->email->send();
*/

	

?>
