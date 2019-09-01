<?PHP
	//결제리스트 관리 모델
	class Payment_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	function payment_list($page, $rp, $search){

		$sql = "";
		$sql .= " SELECT AA.* ";
		$sql .= " FROM( ";
		$sql .= " SELECT IF(b.m_payment_gb='HP', '핸드폰', IF(b.m_payment_gb='GG', '구글인앱', IF(b.m_payment_gb='BK', '가상계좌', IF(b.m_payment_gb='CD', '신용카드' ";
		$sql .= " , IF(b.m_payment_gb='AC', '실시간계좌이체', IF(b.m_payment_gb='PB', '일반전화(받기)', IF(b.m_payment_gb='TP', '일반전화(걸기)' ";
		$sql .= " , IF(b.m_payment_gb='MU', '무통장입금', '기타')))))))) pay_method ";
		$sql .= " , IF(b.m_cancel='취소', '취소', IF(b.m_result_code='', '시도', IF(b.m_result_code='0000' AND b.m_card_ok='Y', '성공' ";
		$sql .= " , IF(b.m_result_code='0000' AND b.m_card_ok='N', '취소', '실패')))) pay_gubn ";
		$sql .= " , b.m_result_code result_code, b.m_userid userid, b.m_payeremail email, CONCAT(a.m_hp1, '-', a.m_hp2, '-', a.m_hp3) hptele ";
		$sql .= " , b.m_tradeid tid, b.m_goods goods, b.m_price price, b.m_point point, b.m_writedate writedate ";
		$sql .= " , b.m_okdate okdate, a.m_name name, b.m_payment_gb payment_gb, b.m_idx m_idx, b.m_mstr m_mstr ";
		$sql .= " , a.m_nick m_nick, b.m_ok_name m_ok_name, b.m_cancel_name m_cancel_name, b.m_mobilid, '회원' member_gubn, a.m_partner, a.m_partner_code ";
		$sql .= " FROM TotalMembers a, payment_temp b ";
		$sql .= " WHERE a.m_userid = b.m_userid ";
		$sql .= " UNION ALL ";
		$sql .= " SELECT IF(b.m_payment_gb='HP', '핸드폰', IF(b.m_payment_gb='GG', '구글인앱', IF(b.m_payment_gb='BK', '가상계좌', IF(b.m_payment_gb='CD', '신용카드' ";
		$sql .= " , IF(b.m_payment_gb='AC', '실시간계좌이체', IF(b.m_payment_gb='PB', '일반전화(받기)', IF(b.m_payment_gb='TP', '일반전화(걸기)' ";
		$sql .= " , IF(b.m_payment_gb='MU', '무통장입금', '기타')))))))) pay_method ";
		$sql .= " , IF(b.m_cancel='취소', '취소', IF(b.m_result_code='', '시도', IF(b.m_result_code='0000' AND b.m_card_ok='Y', '성공' ";
		$sql .= " , IF(b.m_result_code='0000' AND b.m_card_ok='N', '취소', '실패')))) pay_gubn ";
		$sql .= " , b.m_result_code result_code, b.m_userid userid, b.m_payeremail email, CONCAT(a.m_hp1, '-', a.m_hp2, '-', a.m_hp3) hptele ";
		$sql .= " , b.m_tradeid tid, b.m_goods goods, b.m_price price, b.m_point point, b.m_writedate writedate ";
		$sql .= " , b.m_okdate okdate, a.m_name name, b.m_payment_gb payment_gb, b.m_idx m_idx, b.m_mstr m_mstr ";
		$sql .= " , a.m_nick m_nick, b.m_ok_name m_ok_name, b.m_cancel_name m_cancel_name, b.m_mobilid, '탈퇴회원' member_gubn, '' as m_partner, '' as m_partner_code ";
		$sql .= " FROM TotalMembers_out a, payment_temp b ";
		$sql .= " WHERE a.m_userid = b.m_userid AND b.m_card_ok = 'Y' ";
		$sql .= " ) AA ";
		$sql .= " WHERE 1=1 ";


		if($search){
			if($search['s_payment_gb'] <> "")	{ $sql .= " AND AA.payment_gb = '".$search['s_payment_gb']."' "; }
			if($search['s_result'] <> "")		{ $sql .= " AND AA.pay_gubn = '".$search['s_result']."' "; }
			if($search['s_writedate_1'] <> "")	{ $sql .= " AND date(AA.writedate) >= '".$search['s_writedate_1']."' "; }
			if($search['s_writedate_2'] <> "")	{ $sql .= " AND date(AA.writedate) <= '".$search['s_writedate_2']."' "; }
			if($search['s_okdate_1'] <> "")		{ $sql .= " AND date(AA.okdate) >= '".$search['s_okdate_1']."' "; }
			if($search['s_okdate_2'] <> "")		{ $sql .= " AND date(AA.okdate) <= '".$search['s_okdate_2']."' "; }
			if($search['s_name'] <> "")			{ $sql .= " AND (AA.name = trim('".$search['s_name']."')  or m_mstr = trim('".$search['s_name']."'))"; }
			if($search['s_hptele'] <> "")		{ $sql .= " AND AA.hptele like trim('%".$search['s_hptele']."%') "; }
			if($search['s_userid'] <> "")		{ $sql .= " AND AA.userid = trim('".$search['s_userid']."') "; }
			if($search['s_tid'] <> "")			{ $sql .= " AND AA.tid = trim('".$search['s_tid']."') "; }
			if($search['s_member_gubn'] <> "")	{ $sql .= " AND AA.member_gubn = '".$search['s_member_gubn']."' "; }
			if($search['s_m_partner'] <> "")		{ $sql .= " AND AA.m_partner = trim('".$search['s_m_partner']."') "; }
			if($search['s_m_partner_code'] <> "")		{ $sql .= " AND AA.m_partner_code = trim('".$search['s_m_partner_code']."') "; }
		}

		$sql .= " ORDER BY AA.m_idx DESC ";

		$str_paging = " LIMIT ".$page.", ".$rp." ";
		
		$query = $this->db->query($sql.$str_paging);		//결과 페이징
		$query2 = $this->db->query($sql);				//총개수
		
		return array($query->result_array(), $query2->num_rows());
	}


	// 원하는 갯수만큼 다배열 셀렉트
	function payment_result($search, $rp ="", $gubn = ''){

		if($gubn == "out"){
			$v_table = "TotalMembers_out";
		}else if($gubn == "old"){
			$v_table = "TotalMembers_old";
		}else{
			$v_table = "TotalMembers";
		}

		$sql = "";
		$sql .=" SELECT AA.* ";
		$sql .=" FROM( ";
		$sql .=" SELECT IF(b.m_payment_gb='HP', '핸드폰', IF(b.m_payment_gb='GG', '구글인앱', IF(b.m_payment_gb='BK', '가상계좌', IF(b.m_payment_gb='CD', '신용카드' ";
		$sql .=" , IF(b.m_payment_gb='AC', '실시간계좌이체', IF(b.m_payment_gb='PB', '일반전화(받기)', IF(b.m_payment_gb='TP', '일반전화(걸기)' ";
		$sql .=" , IF(b.m_payment_gb='MU', '무통장입금', '기타')))))))) pay_method ";
		$sql .=" , IF(b.m_cancel='취소', '취소', IF(b.m_result_code='', '시도', IF(b.m_result_code='0000' AND b.m_card_ok='Y', '성공' ";
		$sql .=" , IF(b.m_result_code='0000' AND b.m_card_ok='N', '취소', '실패')))) pay_gubn ";
		$sql .=" , b.m_result_code result_code, b.m_userid userid, b.m_payeremail email, CONCAT(a.m_hp1, '-', a.m_hp2, '-', a.m_hp3) hptele ";
		$sql .=" , b.m_tradeid tid, b.m_goods goods, b.m_price price, b.m_point point, b.m_writedate writedate ";
		$sql .=" , b.m_okdate okdate, a.m_name name, b.m_payment_gb payment_gb, b.m_idx m_idx, b.m_mstr m_mstr, b.m_ok_name m_ok_name, b.m_cancel_name m_cancel_name ";
		$sql .=" FROM ".$v_table." a, payment_temp b ";
		$sql .=" WHERE a.m_userid = b.m_userid ";

		if($gubn == "out"){ $sql .= " AND b.m_card_ok ='Y' "; }

		$sql .=" ) AA ";
		$sql .=" WHERE 1=1 ";

		if($search){
			if($search['s_userid'] <> "")		{ $sql .=" AND AA.userid = trim('".$search['s_userid']."') "; }
		}

		$sql .=" ORDER BY AA.m_idx DESC ";
		if ($rp){ $sql .=" LIMIT 0, ".$rp." "; }

		$query = $this->db->query($sql);	

		return array($query->result_array());

	}


	//환불 관려 쿼리
	//회원 내역 검색(정회원만 검색)
	function refund_member_search($m_userid, $p_code = '1001'){
		
		$sql = "";
		$sql .= " SELECT a.m_userid m_userid, a.m_nick m_nick, a.m_name m_name, a.m_type m_type, b.m_writedate m_writedate, c.total_point total_point, b.m_tradeid m_tradeid ";
		$sql .= " FROM TotalMembers a, member_point_list b, member_total_point c ";
		$sql .= " WHERE a.m_userid = b.m_userid AND a.m_userid = c.m_userid AND b.m_userid = c.m_userid ";
		$sql .= " AND a.m_userid = '".$m_userid."' AND b.m_product_code = '".$p_code."' AND b.m_etc IS NULL ";
		$sql .= " ORDER BY b.m_idx DESC ";
		$sql .= " LIMIT 1 ";
		
		$query = $this->db->query($sql);
		
		return $query->row_array();
	}



}

?>
