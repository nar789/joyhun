<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends MY_Controller {
	/*
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('alrim_helper');
	}

	public function index()
	{
	}

	function pp(){
		gcm_send('wwkorea1030', '조이헌팅', '푸쉬테스트');
	}

	function ss(){
		
		$datas = array(
			"s_name"	=> $this->seg_exp[3],
			"s_date"		=> NOW
		);

		$this->my_m->insert("test_joytalk",$datas);

		echo $this->seg_exp[3];
	}

	public function auto()
	{
		$sql  = "SELECT * ";
		$sql .= "FROM {$this->table['push_list']} ";
		$sql .= "WHERE send_state='N' ";
		$sql .= "ORDER BY regidate ASC ";
		$sql .= "LIMIT 1 ";
		$res = $this->db->query($sql);
		foreach( $res->result_array() as $data ) $push = $data;

		if( !empty($push['uid']) )
		{
			$arr['data']['title'] = "현대카마스터몰";
			$arr['data']['message'] = $push['push_message'];
			$arr['data']['count'] = 1;

			# 이미지 전송 푸시의 경우
			if( !empty($push['push_image']) )
			{
				$arr['data']['summaryText'] = $push['push_message'];
				$arr['data']['style'] = "picture";
				$arr['data']['picture'] = "https://kia.auton.kr:8443".$push['push_image'];
			}

			# 내부 링크를 호출할 경우
			if( !empty($push['push_link']) )
			{
				$arr['data']['link'] = $push['push_link'];
			}

			$sql  = "SELECT T1.*, T2.mobile_platform, T2.device_token ";
			$sql .= "FROM {$this->table['push_user']} AS T1 LEFT JOIN {$this->table['account']} AS T2 ON T1.acid=T2.acid ";
			$sql .= "WHERE T1.send_yn='N' AND T1.push_uid='{$push['uid']}' AND T2.mobile_platform='ANDROID' AND T2.device_token IS NOT NULL ";
			$sql .= "LIMIT 1000 ";
			$res = $this->db->query($sql);
			foreach( $res->result_array() as $data ) $user[] = $data;

			if( COUNT($user) > 0 )
			{
				$run_push="Y";
				for($i=0; $i<COUNT($user); $i++)
				{
					$arr['registration_ids'][] = $user[$i]['device_token'];
					$sql  = "UPDATE {$this->table['push_user']} SET send_yn='Y' WHERE uid='{$user[$i]['uid']}'";
					$res = $this->db->query($sql);
				}
			}

			if( $run_push == 'Y' )
			{
				$sql = "SELECT COUNT(*) AS TOT FROM {$this->table['push_user']} WHERE push_uid='{$push['uid']}' AND send_yn = 'N' ";
				$res = $this->db->query($sql);
				foreach( $res->result_array() as $data ) $TOT = $data['TOT'];

				if( $TOT < 1 )
				{
					$sql  = "UPDATE {$this->table['push_list']} SET send_state='Y' WHERE uid='{$push['uid']}'";
					$res = $this->db->query($sql);
				}

				$google_api_key = $this->config->item('google_api_key');
				$headers = array("Content-Type:application/json","Authorization:key={$google_api_key}");
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
				curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
				curl_setopt($ch, CURLOPT_POST,    true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
				$response = curl_exec($ch);
				#$this->data['debug'] = $response;
				curl_close($ch);
			}
		}
		echo $response;
		exit;
	}

	public function gcm_send()
	{
		//echo 11;exit;

		$headers = array("Content-Type:application/json","Authorization:key=AIzaSyDAZCCVIf_qLr7ff46yp2BPmQYu3jOU4pE");
		$arr['data']['title'] = "조이헌팅";
		$arr['data']['message'] = "조이헌팅 푸시 테스트 합니다2";
		$arr['data']['count'] = 1;

//		$arr['data']['style'] = "picture";
//		$arr['data']['picture'] = "http://joyhunting.com/upload/thumb/ae/aera/aerang/girl_01.gif.80x56.jpg";
//		$arr['data']['summaryText'] = "테스트 사진";

		#$arr['data']['link']  = "http://hm.auton-gift.com/search/item/view/1736";
		#$arr['data']['image'] = "http://kiatest.auton.kr/dev/upload/images/product/Product_1427928945933.jpg";
		#$arr['data']['sound'] = "ping.wav";
		$arr['registration_ids'][] = "dSDzesKDLvc:APA91bFoyHVJb7uMuQBlh-K-WaTh1xUswRpfmFJ6P-S1NgqBEevmvqgTG3VYquLUU1n8PaPPkIXXBk5iOdk_xGw52WDImFp1EVALIfkbwuSD4dEe-sC2JZi1xI3IEfEC2ufnc20Q-fSA"; # 회사 테스트폰


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
		curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
		curl_setopt($ch, CURLOPT_POST,    true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		#curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
		$response = curl_exec($ch);
		$this->data['debug'] = $response;
		curl_close($ch);
	}

}