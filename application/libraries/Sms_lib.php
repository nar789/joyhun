<?php 
/*place this in libraries folder*/ 
//	SMS : $rtn = $this->sms_lib->sms_send($send_num,$recv_num,$text);
//	LMS : $rtn = $this->sms_lib->sms_send($send_num,$recv_num,$text,$lms_title);
//	MMS : $rtn = $this->sms_lib->sms_send($send_num,$recv_num,$text,$lms_title,$arr_images);

/*
	$send_num	: 보내는번호  (ex.#14709123456)
	$recv_num	: 받는번호	(배열로)
	$text		: 문자보낼 내용
	
	if (LMS일경우){		// 이미지는없고,TEXT만 길때
		$lms_title	: LMS의 제목 (ex.[조이헌팅] 문자팅 도착)
	}

	if (MMS일경우){		// 이미지있을때
		$lms_title	: LMS의 제목 (ex.[조이헌팅] 문자팅 도착)
		$arr_images : MMS용 배열
					  ex.  'attach_file_group_key'  => 이미지의 그룹키(primary_key),
						   'attach_file_subpath'	=> 이미지의 파일의 경로,
						   'attach_file_name'		=> 이미지 네임
	}
*/

class Sms_lib{ 

	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('sms_m');
	}

	//Sms_lib->sms_send('',array('010-1234-1234'),"회원님의 새비밀번호는 000입니다.");
	function sms_send($send_num,$recv_num,$text,$lms_title='',$arr_images=''){
		
		if(!$send_num){$send_num = "#1470";}

		$recv_cnt = count($recv_num);
		$time = date("Y/m/d H:i:s", mktime(date("H"), date("i"), date("s")+3, date("m"), date("d"), date("Y"))); //NOW 보다 3초뒤

		if (@$arr_images != ''){			// 파일이 있으면 MMS
			
			//대표사진이 없어서 조이헌팅 기본 성별 이미지 일경우 lms 전환
			if(strpos($arr_images['attach_file_name'], 'man_icon') !== false || strpos($arr_images['attach_file_name'], 'girl_icon') !== false){
				$rtn = $this->lms_send($send_num,$recv_num,$time,$text,$lms_title,$recv_cnt);

			}else{
				//대표사진이 제대로 있을경우 mms
				$rtn = $this->mms_send($send_num,$recv_num,$time,$text,$lms_title,$arr_images,$recv_cnt);
			}			

			return $rtn;

		}else if (strlen($text) > '90'){	// 파일없는데 text가 길면 LMS

			$this->lms_send($send_num,$recv_num,$time,$text,$lms_title,$recv_cnt);

		}else{								// 다 아니면 SMS

			for($i = 0; $i < $recv_cnt; $i++){
				$smsarr_data = array(
					'date_client_req' => $time,
					'content' => $text,
					'callback' => $send_num,
					'service_type' => '0',
					'recipient_num' => $recv_num[$i]
				);

				$rtn = $this->ci->db->insert("em_smt_tran", $smsarr_data);	
			}

			return $rtn;
		}

	}	//## sms_send END



	function lms_send($send_num,$recv_num,$time,$text,$lms_title,$recv_cnt){

		for($i = 0; $i < $recv_cnt; $i++){
			$arr_data = array(
				'date_client_req' => $time,
				'subject' => $lms_title,
				'content' => $text,
				'callback' => $send_num,
				'service_type' => '3',
				'recipient_num' => $recv_num[$i]
			);

			$rtn = $this->ci->db->insert("em_mmt_tran", $arr_data);	
		}
		return $rtn;

	}	//## lms_send END



	function mms_send($send_num,$recv_num,$time,$text,$lms_title,$arr_images,$recv_cnt){


		$search['attach_file_group_key']	= $arr_images['attach_file_group_key'];
		$sms_file_cnt = $this->ci->my_m->cnt('em_mmt_file', $search);	//이미지 파일이 이미 있는지 검사(idx + file_path + file_name)

		if ($sms_file_cnt == '0'){	// em_mmt_file 테이블에 파일이 없으면 파일추가(중복불가때문에 검사)
					
			$image_data = array(
						'attach_file_group_key'		=> $arr_images['attach_file_group_key'],
						'attach_file_group_seq'		=> 1,
						'attach_file_seq'			=> 1,
						'attach_file_subpath'		=> $arr_images['attach_file_subpath'],
						'attach_file_name'			=> $arr_images['attach_file_name']
					);
			$rtn_img = $this->ci->db->insert("em_mmt_file", $image_data);

		}else if($sms_file_cnt == '1'){

			$image_data = array(
						'attach_file_group_seq'		=> 1,
						'attach_file_seq'			=> 1,
						'attach_file_subpath'		=> $arr_images['attach_file_subpath'],
						'attach_file_name'			=> $arr_images['attach_file_name'],
						'reg_date'					=> $time
					);
			
			$rtn_img = $this->ci->db->update("em_mmt_file", $image_data, array('attach_file_group_key' => $arr_images['attach_file_group_key']));
		}

		for($i = 0; $i < $recv_cnt; $i++){

			$arr_data = array(
				'date_client_req' => $time,
				'subject' => $lms_title,
				'content' => $text,
				'callback' => $send_num,
				'service_type' => '2',
				'recipient_num' => $recv_num[$i],
				'attach_file_group_key' => $arr_images['attach_file_group_key']
			);

			$rtn = $this->ci->db->insert("em_mmt_tran", $arr_data);
		}

		return $rtn;

	}	//## mms_send END
	

}
?>
