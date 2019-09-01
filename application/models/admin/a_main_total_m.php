<?PHP
class A_main_total_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	// 오늘,내일 건수
	// 테이블명, 날짜컬럼, 출력할이름, where
	//function today_cnt($table, $date, $name, $search='')
	function day_cnt($data, $mode)
    {

		// 오늘 건수면 $day 오늘로 셋팅
		if($mode == "TODAY"){
			$day = TODAY;

		// 어제 건수면 $day 어제로 셋팅
		}else if($mode == 'YESTERDAY'){
			$day = date("Y-m-d", strtotime("-1 day", time()));
		}

		// select 변수 셋팅
		$select = '';
		for ($i = 0; $i < count($data[0]); $i++){
			$select .= $data[0][$i];

			if($i != count($data[0])-1){
				$select .= ', ';
			}
		}

		$today_q = '';
		$today_q .= "SELECT ".$select." FROM ";


		// 있는 값만큼 반복
		for ($i = 0; $i < count($data[0]); $i++){
			
			// name에서 as 값 가져오기
			$name = explode('.', $data[0][$i]);

			$today_q .= "( SELECT COUNT(*) ".$name[1]." FROM ".$data[1][$i]." WHERE ".$data[2][$i]." >= '".$day." 00:00:00' AND ".$data[2][$i]." <= '".$day." 23:59:59'";
			
			// where 추가 있으면 추가하기
			if($data[3][$i] != ''){
				$today_q .= " AND ".$data[3][$i];
			}

			$today_q .= ") ".$name[0];

			if($i != count($data[0])-1){
				$today_q .= ',';
			}

	}

	$query = $this->db->query($today_q);
	return array($query->result_array());

    }



	// 가입자출력 ( 모델에서 search 없어서 안되기때문에 여기로 이전)
	function join_mb($table)
    {
		$join_sql = "";
		$join_sql .= "SELECT COUNT(*) AS cnt ";
		$join_sql .= "FROM ".$table;

		$query = $this->db->query($join_sql);

		return $query->row()->cnt;
    }




	// 최근 몇달치 차트 출력
	function month_total($table, $date, $months, $search='')
    {
		$month_sql = "";
		$month_sql .= "SELECT DATE_FORMAT(".$date.", '%Y%m%d') AS months, COUNT(*) as cnt ";
		$month_sql .= "FROM ".$table;
		$month_sql .= " WHERE ".$date."  >= DATE_ADD(NOW(), INTERVAL -".$months." MONTH)";

		if (@$search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$month_sql .= " AND ".$value;
					}else{
						$month_sql .= " AND ".$key." = ".$value;
					}
				}
			}
  		}

		$month_sql .= " GROUP BY DATE_FORMAT(".$date.", '%Y%m%d') ORDER BY months ASC";

		$query = $this->db->query($month_sql);

		return array($query->result_array());

    }


	// 중복제거 카운트 출력
	function distinct_total($table, $column, $search='')
    {
		$dist_sql = "";
		$dist_sql .= "SELECT COUNT(DISTINCT ".$column.") AS cnt ";
		$dist_sql .= "FROM ".$table;
		$dist_sql .= " WHERE ".$search;

		$query = $this->db->query($dist_sql);

		return $query->row()->cnt;
    }


	// 메인 결제내역(무통장은 시도,성공 다 출력, 나머지는 성공만출력)
	function pay_list()
    {

		$start_day = date("Y-m-d", strtotime("-2 day"));

		$sql = "";
		$sql .= "SELECT AA.* FROM( ";
		$sql .= "SELECT IF(b.m_payment_gb='HP', '핸드폰', IF(b.m_payment_gb='BK', '가상계좌', IF(b.m_payment_gb='CARD', '신용카드' , IF(b.m_payment_gb='ACCOUNT', '실시간계좌이체', ";
		$sql .= "IF(b.m_payment_gb='PB', '일반전화(받기)', IF(b.m_payment_gb='TP', '일반전화(걸기)' , IF(b.m_payment_gb='MU', '무통장입금', '기타'))))))) pay_method ,";
		$sql .= " IF(b.m_cancel='취소', '취소', IF(b.m_result_code='', '시도', IF(b.m_result_code='0000' AND b.m_card_ok='Y', '성공' ,";
		$sql .= " IF(b.m_result_code='0000' AND b.m_card_ok='N', '취소', '실패')))) pay_gubn ";
		$sql .= ", b.m_goods goods, b.m_writedate writedate , b.m_okdate okdate,b.m_payment_gb payment_gb, b.m_idx m_idx,a.m_nick m_nick,a.m_userid m_userid ";
		$sql .= "FROM TotalMembers a, payment_temp b WHERE a.m_userid = b.m_userid ) AA WHERE 1=1 AND ";
		$sql .= "DATE(AA.writedate) >= '".$start_day."' AND DATE(AA.writedate) <= '".TODAY."'";
		$sql .= " AND ( (pay_gubn='성공' AND pay_method != '무통장입금') OR (pay_method = '무통장입금') ) ORDER BY ";
		$sql .= "AA.m_idx DESC";

		$query = $this->db->query($sql);

		return array($query->result_array());

    }

}

?>