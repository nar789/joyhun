<?
class Test extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$config['global_xss_filtering'] = FALSE;
		$this->load->helper('test_helper');
		$this->load->helper('code_change_helper');
		$this->load->helper('partner_helper');
		$this->load->helper('chat_helper');
		$this->load->helper('point_helper');
		$this->load->library('member_lib');
	}


	function back(){

		exit;
		$sql = "SELECT A.* FROM TotalMembers as A left join member_point_list as B ON A.m_userid = B.m_userid where A.m_sex = 'F' and B.m_product_code = '8000' ";
		$query = $this->db->query($sql);
		$member = $query->result_array();


		if(!empty($member)){
			foreach($member as $data){

					$chat_pd = $this->my_m->row_array('product_list', array('m_product_code' => '8001', 'm_use_yn' =>'Y', 'm_gubn' => 'A'));
					member_point_insert($data['m_userid'], $chat_pd['m_product_code'], $chat_pd['m_goods'], $chat_pd['m_point'], null, null, NOW, null);

			}
		}

	}


	function main(){
exit;
		chat_auto_accept();

	}

	function c_test(){
exit;
		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';

		$p_data = $this->my_m->result_array('chat_request', array('refund' => '환불대상',  'ex_date' => 'DATE_ADD(request_date, INTERVAL 24 HOUR) <= SYSDATE()' )	, 'idx', 'DESC', NULL);		

		if(!empty($p_data)){
			foreach($p_data as $data){
				
				//	var_dump($data);

				//1. 발송자 / 수신자 누가 남자인가?
					if($this->member_lib->get_member($data['send_id']) == "M"){
						$user_id = $data['send_id'];
					}else{
						$user_id = $data['recv_id'];
					}
				//2. 포인트 돌려주기

					member_point_insert($user_id, 8888, "채팅포인트 환불", 70, null, null, NOW, null);

				//3.  환불완료 체크

					$this->my_m->update('chat_request', array('idx' => $data['idx']), array('refund' => ''));

			}
		}
		
		echo 1;

		$this->load->view('bottom0_v');
	}


	function test23(){
exit;		
		//파트너 아이디 와 파트너 광고코드가 있는경우(partner_helper)
		if(!empty($this->session->userdata['m_partner']) and !empty($this->session->userdata['m_partner_code'])){
			$this->my_m->insert('partner_log', array('user_id' => $this->session->userdata['m_userid'], 'plaintext' => '', 'write_date' => NOW, 'result' => '파트너 체크 들어가기전'));
			partner_send_curl('JOIN', $this->session->userdata['m_userid'], null);
			$this->my_m->insert('partner_log', array('user_id' => $this->session->userdata['m_userid'], 'plaintext' => '', 'write_date' => NOW, 'result' => '파트너 체크 완료후'));
		}

	}

	//이벤트 이메일 테스트
	function evnet_email_test(){

		$this->load->view('top0_v');
		$this->load->view('/test/mail_v');
		$this->load->view('bottom0_v');
	}


	//선물채팅관련 테스트
	function chat_test(){

		$this->load->view('top0_v');
		$this->load->view('/test/chat_test_v');
		$this->load->view('bottom0_v');

	}



	function member_image_test2(){
exit;
		$sql = "SELECT m_userid,m_filename FROM TotalMembers WHERE (m_joinReg = '8') ORDER BY m_num DESC ";
		$query = $this->db->query($sql);
		$member = $query->result_array();

		foreach($member as $data){
				

				$ori_file = "/home/resource_inlove/member_pic/".$data['m_filename']; //구경로 원본파일

				$sql = "update TotalMembers set m_joinReg = '9'  WHERE m_userid = '".$data['m_userid']."' ";
				$this->db->query($sql);


				if(is_file($ori_file)){
					echo $data['m_userid']." : $ori_file (old)<br>";

					//구경로 검색
					///home/joyhunting/www/upload/member_pic/2016/05/01/yalee1009_22_45_35.jpg (old)

					$file = explode("/",$ori_file);
					$file =  $file[count($file)-1];
					//o_dir = "/home/joyhunting/www/copy_img";
					//$tmp = "";
					//for($i=1;$i<count($dir)-1;$i++){
					
					//	$tmp = $tmp."/".$dir[$i];
					//	$new_dir = $o_dir.$tmp;
					//	if(!is_dir($new_dir) ){	mkdir($new_dir); }
					//}
					copy($ori_file, "/resource/member_pic/".$file);

				}else{
					//신경로로 다시 검색
					$ori_file = $data['m_filename']; //원본파일
					if(is_file($ori_file)){
						echo $data['m_userid']." : $ori_file (new)<br>";
//
//						$dir = explode("/",$ori_file);
//						$o_dir = "/home/joyhunting/www/copy_img";
//						$tmp = "";
//						for($i=1;$i<count($dir)-1;$i++){
//						
//							$tmp = $tmp."/".$dir[$i];
//							$new_dir = $o_dir.$tmp;
//							if(!is_dir($new_dir) ){	mkdir($new_dir); }
//						}
//						copy($ori_file, $o_dir.$ori_file);
					}else{
						echo $data['m_userid']." : no fiile<br>";
					}
				}


		}

	}


	function member_image_test(){
	exit;
		$sql = "SELECT * FROM TotalMembers WHERE (m_special = '1' OR m_special = '2') ORDER BY m_num DESC";
		$query = $this->db->query($sql);
		$member = $query->result_array();

		foreach($member as $data){
				

				$ori_file = UPLOAD_ROOT."/member_pic/".$data['m_filename']; //구경로 원본파일

				if(is_file($ori_file)){
					echo $data['m_userid']." : $ori_file (old)<br>";

					//구경로 검색
					///home/joyhunting/www/upload/member_pic//2016/05/01/yalee1009_22_45_35.jpg (old)

//					$dir = explode("/",$ori_file);
//					$o_dir = "/home/joyhunting/www/copy_img";
//					$tmp = "";
//					for($i=1;$i<count($dir)-1;$i++){
//					
//						$tmp = $tmp."/".$dir[$i];
//						$new_dir = $o_dir.$tmp;
//						if(!is_dir($new_dir) ){	mkdir($new_dir); }
//					}
//					copy($ori_file, $o_dir.$ori_file);

				}else{
					//신경로로 다시 검색
					$ori_file = $data['m_filename']; //원본파일
					if(is_file($ori_file)){
						echo $data['m_userid']." : $ori_file (new)<br>";
//
//						$dir = explode("/",$ori_file);
//						$o_dir = "/home/joyhunting/www/copy_img";
//						$tmp = "";
//						for($i=1;$i<count($dir)-1;$i++){
//						
//							$tmp = $tmp."/".$dir[$i];
//							$new_dir = $o_dir.$tmp;
//							if(!is_dir($new_dir) ){	mkdir($new_dir); }
//						}
//						copy($ori_file, $o_dir.$ori_file);
					}else{
						echo $data['m_userid']." : no fiile<br>";
					}
				}

		}

	}
	
	
	function aaa(){
		$this->load->helper("point_helper");
		
		//reg_member_sms_represend();
		echo "123";	
		
	}

	function joy_check(){

		$sql = "SELECT * FROM mem_tmp where code = '' limit 400, 100 ";
		$query = $this->db->query($sql);
		$member = $query->result_array();

		foreach($member as $data){
			echo $data['idx'];

			//1.  이름 + 생년월일 검색
			$sql = "SELECT * FROM TotalMembers WHERE m_name = '".$data['m_name']. "' AND m_jumin1 = '".$data['m_jumin1']. "'  ";
			$query = $this->db->query($sql);
			$row = $query->row(); 

			//2. 이메일 검색
			if(empty($row)){
				$sql = "SELECT * FROM TotalMembers WHERE m_mail = '".$data['m_mail']. "'  ";
				$query = $this->db->query($sql);
				$row = $query->row(); 
			}

			//3. 휴대폰 번호 검색
			if(empty($row)){
				$m_hp = explode("-", $data['m_hp']);
				$sql = "SELECT * FROM TotalMembers WHERE m_hp1 = '".$m_hp[0]. "' and m_hp2 = '".$m_hp[1]. "' and m_hp3 = '".$m_hp[2]. "'  ";
				$query = $this->db->query($sql);
				$row = $query->row(); 
			}

			//4 아이디 검색
			if(empty($row)){
				$m_hp = explode("-", $data['m_hp']);
				$sql = "SELECT * FROM TotalMembers WHERE m_userid = '".$data['m_userid']. "'   ";
				$query = $this->db->query($sql);
				$row = $query->row(); 
			}


			//못찾았으면
			if(empty($row)){
				echo " - not found"."<br>";
			}else if(!empty($row)){
				echo " - found (".$row->m_userid.")"."<br>";
			}

		}

	}

	function rand_test(){
		
		if(@strpos('관리자zz', '관리자') !== false or @strpos('관리자zz', '운영자') !== false){
			echo "123";
		}
		exit;
	}

	
}
?>
