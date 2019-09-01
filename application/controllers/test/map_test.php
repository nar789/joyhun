<?
class Map_test extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('member_lib');
		$this->load->helper('common_helper');
		$this->load->helper('code_change_helper');
	}

	function index(){	

		$this->load->view('top0_v');
		$this->load->view('test/map_test_v');
		$this->load->view('bottom0_v');

	}

	function map_iframe(){

		header("Content-Type: text/html; charset=UTF-8");		

		$sql2 = "";
		$sql2 .= " SELECT * ";
		$sql2 .= " FROM TotalMembers ";
		$sql2 .= " WHERE 1=1 ";
		$sql2 .= " AND m_pwd2 = 'needting' ";
		$sql2 .= " AND (m_xpoint IS NULL OR m_ypoint IS NULL) ";
		$sql2 .= " ORDER BY m_num DESC ";
		$sql3 = " LIMIT 50 ";
		
		$query2 = $this->db->query($sql2.$sql3);
		$query3 = $this->db->query($sql2);

		$member = $query2->result_array();
		$total = $query3->num_rows();
		
		//$dong = array('반곡동', '소담동', '보람동', '대평동', '가람동', '한솔동', '나성동', '새롬동', '다정동', '어진동', '종촌동', '고운동', '아름동', '도담동', '조치원읍', '연기면', '연동면', '부강면', '금남면', '장군면', '연서면', '전의면', '전동면', '소정면');
		
		
		if(!empty($member)){
			
			foreach($member as $data){
				
				$sql = "";
				$sql .= " SELECT * ";
				$sql .= " FROM( ";
				$sql .= " SELECT sido, gugun, dong ";
				$sql .= " FROM addr_temp ";
				$sql .= " GROUP BY dong ";
				$sql .= " ORDER BY sido ASC, gugun ASC, dong ASC ";
				$sql .= " ) a ";
				$sql .= " WHERE 1=1 ";
				$sql .= " AND SIDO = '".$data['m_conregion']."' AND GUGUN = '".$data['m_conregion2']."' ";
				
				$query = $this->db->query($sql);

				$address = $query->result_array();

				if(count($address) > 0){		
					$rand_num = mt_rand(0, count($address)-1);
					$addr = $data['m_conregion']." ".$data['m_conregion2']." ".$address[$rand_num]['dong'];
				}else{
					if($data['m_conregion2'] == "세부지역"){
						$addr = $data['m_conregion'];
					}else{
						$addr = $data['m_conregion']." ".$data['m_conregion2'];
					}					
				}
										
				$map_data = $this->get_map_addr($addr);
				
				//좌표 업데이트
				$this->my_m->update('TotalMembers', array('m_userid' => $data['m_userid']), array('m_xpoint' => $map_data[0], 'm_ypoint' => $map_data[1]));
			}
			echo "남은 갯수 : ".$total;
			
		}else{
			echo "데이터 없음(완료)";
		}

	}


	function get_map_addr($addr){

		//네이버 API 관련 key value(common_helper)
		$cId		= get_naver_cid('id');
		$cSecret	= get_naver_cid('pw');

		$result = get_naver_gps_code($addr, $cId, $cSecret);			//지역에 따른 좌표 구하기(common_helper)

		$map_data = json_decode($result, 1);
		
		$gubn = array('-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-', '+', '-', '+', '+', '-', '+', '-', '+', '-', '-');
		$x_num = mt_rand(0, count($gubn)-1);
		$y_num = mt_rand(0, count($gubn)-1);

		$str_x_rand = $gubn[$x_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);
		$str_y_rand = $gubn[$y_num]."0.00".str_pad(mt_rand(0, 999), 3, 0);

		$x_point = @$map_data['result']['items'][0]['point']['x']+$str_x_rand;		//x좌표
		$y_point = @$map_data['result']['items'][0]['point']['y']+$str_y_rand;		//y좌표

		return array($x_point, $y_point);

	}
	

	function get_member_sido(){

		
		exit; 

		$sql = "";
		$sql .= " SELECT * FROM TotalMembers WHERE m_conregion = '' limit 3 ";

		$query = $this->db->query($sql);

		$user_data = $query->result_array();
		
		$addr_sql = "";
		$addr_sql .= " SELECT sido FROM addr_temp GROUP BY sido ORDER BY sido ASC ";

		$addr_query = $this->db->query($addr_sql);

		$addr = $addr_query->result_array();

		for($i=0; $i<count($user_data); $i++){
			
			$rand_num = mt_rand(0, count($addr)-1);
			
			if(empty($user_data[$i]['m_userid'])){ break; }

			$update_sql = "";
			$update_sql .= " update TotalMembers set m_conregion = '".$addr[$rand_num]['sido']."' where m_userid = '".$user_data[$i]['m_userid']."' ";

			$this->db->query($update_sql);

		}

		echo "123";

	}

	function get_member_gugun(){

		exit;
		
		//세종시가 아닌 회원중에 시군구가 없는 회원 없데이트 
		$sql = "";
		$sql .= " SELECT * FROM TotalMembers WHERE m_conregion is not null and m_conregion <> '' and m_conregion <> '세종' and m_conregion2 = '' and m_xpoint is null limit 5000 ";

		$query = $this->db->query($sql);

		$user_data = $query->result_array();
		
		foreach($user_data as $data){

			$sql2 = "";
			$sql2 .= " SELECT gugun FROM addr_temp WHERE 1=1 AND sido = '".$data['m_conregion']."' GROUP BY gugun ORDER BY RAND() LIMIT 1 ";

			$query2 = $this->db->query($sql2);

			$addr_gugun = $query2->row()->gugun;

			$up_sql = "";
			$up_sql .= " update TotalMembers set m_conregion2 = '".str_replace(strstr($addr_gugun, " "), "", $addr_gugun)."' where m_userid = '".$data['m_userid']."' ";

			$this->db->query($up_sql);
			
		}

		echo "success";

	}


	function get_gugun($sido = null){
		
		if(empty($sido) or $sido == "세종"){ return; }

		$sql = "";
		$sql .= " select gugun from addr_temp where 1=1 and sido = '".$sido."' group by gugun order by rand() limit 1 ";


	}


	function get_sejeong(){
		
		//반곡동, 소담동, 보람동, 대평동, 가람동, 한솔동, 나성동, 새롬동, 다정동, 어진동, 종촌동, 고운동, 아름동, 도담동, 조치원읍, 연기면, 연동면, 부강면, 금남면, 장군면, 연서면, 전의면, 전동면, 소정면

		$addr = "세종특별자치시 조치원읍";

		//네이버 API 관련 key value(common_helper)
		$cId		= get_naver_cid('id');
		$cSecret	= get_naver_cid('pw');

		$addr = urlencode($addr);
		$url = "https://openapi.naver.com/v1/map/geocode?encoding=utf-8&coord=latlng&output=json&query=".$addr;

		$headers = array();

		$headers[] = "GET https://openapi.naver.com/v1/map/geocode?".$addr;
		$headers[] ="Host: openapi.naver.com";
		$headers[] ="Accept: */*";
		$headers[] ="Content-Type: application/json";
		$headers[] ="X-Naver-Client-Id: ".$cId;
		$headers[] ="X-Naver-Client-Secret: ".$cSecret;
		$headers[] ="Connection: Close";

		$result = getHttp($url, $headers);		//common_helper

		$map_data = json_decode($result, 1);

		var_dump($map_data);

		
	}
	
}


	

?>
