<?PHP

	class Payment_stat_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	//해당 달의 마지막 날짜를 찾아서 날짜 임시테이블 만들기
	function from_to_date($this_month){
		
		$sql = " select day(last_day('".$this_month."')) last_day ";

		$q = $this->db->query($sql);

		$last_day = $q->row()->last_day;
		
		$sql2 = "";
		$union = "union all";

		$m_date = explode('-', $this_month);
		$m_year		= $m_date[0];		//년
		$m_month	= $m_date[1];		//월

		$m_day = $m_year."-".$m_month;

		for($i=$last_day; $i>=1; $i--){

			if($i == "1"){
				$union = "";
			}
		
			$sql2 .= " select '".$m_day."-".zero_num($i)."' m_day ".$union." ";	
		}
		
		//이달의 결제현황통계
		$sql = "";
		$sql .= " SELECT a.m_day, IFNULL(b.price, 0) HP1, IFNULL(c.price, 0) CD1, IFNULL(d.price, 0) BK1, IFNULL(e.price, 0) AC1, IFNULL(f.price, 0) MU1, IFNULL(g.price, 0) TP1, IFNULL(h.price, 0) PB1 ";
		$sql .= " , IFNULL(i.price, 0) HP2, IFNULL(j.price, 0) CD2, IFNULL(k.price, 0) MU2, IFNULL(o.price, 0) GG, IFNULL(l.price, 0) HP3, IFNULL(m.price, 0) CD3, IFNULL(n.price, 0) MU3 ";
		$sql .= " , IFNULL(b.price, 0)+IFNULL(c.price, 0)+IFNULL(d.price, 0)+IFNULL(e.price, 0)+IFNULL(f.price, 0)+IFNULL(g.price, 0)+IFNULL(h.price, 0)+IFNULL(i.price, 0)+IFNULL(j.price, 0)+IFNULL(k.price, 0)+IFNULL(l.price, 0)+IFNULL(m.price, 0)+IFNULL(n.price, 0)+IFNULL(o.price, 0) DAY_TOTAL ";
		$sql .= " , IFNULL(b.cnt, 0)+IFNULL(c.cnt, 0)+IFNULL(d.cnt, 0)+IFNULL(e.cnt, 0)+IFNULL(f.cnt, 0)+IFNULL(g.cnt, 0)+IFNULL(h.cnt, 0)+IFNULL(i.cnt, 0)+IFNULL(j.cnt, 0)+IFNULL(k.cnt, 0)+IFNULL(l.cnt, 0)+IFNULL(m.cnt, 0)+IFNULL(n.cnt, 0)+IFNULL(o.cnt, 0) PAY_CNT ";
		$sql .= " FROM ";
		$sql .= " ( ".$sql2." ) a ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'HP' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) b ";
		$sql .= " ON a.m_day = b.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'CD' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) c ";
		$sql .= " ON a.m_day = c.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'BK' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) d ";
		$sql .= " ON a.m_day = d.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'AC' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) e ";
		$sql .= " ON a.m_day = e.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'MU' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) f ";
		$sql .= " ON a.m_day = f.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'TP' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) g ";
		$sql .= " ON a.m_day = g.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'P' AND m_payment_gb = 'PB' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) h ";
		$sql .= " ON a.m_day = h.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'M' AND m_payment_gb = 'HP' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) i ";
		$sql .= " ON a.m_day = i.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'M' AND m_payment_gb = 'CD' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) j ";
		$sql .= " ON a.m_day = j.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'M' AND m_payment_gb = 'MU' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) k ";
		$sql .= " ON a.m_day = k.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'A' AND m_payment_gb = 'HP' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) l ";
		$sql .= " ON a.m_day = l.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'A' AND m_payment_gb = 'CD' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) m ";
		$sql .= " ON a.m_day = m.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'A' AND m_payment_gb = 'MU' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) n ";
		$sql .= " ON a.m_day = n.m_day ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT DATE(m_okdate) m_day, SUM(m_price) price, COUNT(*) cnt ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND m_pay_gubn = 'A' AND m_payment_gb = 'GG' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' ";
		$sql .= " AND m_cancel IS NULL ";
		$sql .= " GROUP BY DATE(m_okdate) ";
		$sql .= " ) o ";
		$sql .= " ON a.m_day = o.m_day ";
		$sql .= " WHERE 1=1 ";
	
		$query = $this->db->query($sql);
		
		//이달의 총 결제 건수
		$sql2 = "";
		$sql2 .= " SELECT COUNT(*) cnt ";
		$sql2 .= " FROM payment_temp ";
		$sql2 .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' AND m_cancel IS NULL ";

		$query2 = $this->db->query($sql2);

		return array($query->result_array(), $query2->row()->cnt);

	}

	//해당 년 월의 총 매출액
	function total_sales($this_month){

		$m_date = explode('-', $this_month);
		$m_year		= $m_date[0];		//년
		$m_month	= $m_date[1];		//월

		$sql = "";
		$sql .= " SELECT COUNT(m_price) cnt, SUM(m_price) sales ";
		$sql .= " FROM payment_temp ";
		$sql .= " WHERE m_product_code <> '2000' AND m_card_ok = 'Y' AND SUBSTR(m_okdate, 1, 4) = '".$m_year."' AND SUBSTR(m_okdate, 6, 2) = '".$m_month."' AND m_cancel IS NULL ";
		
		$query = $this->db->query($sql);

		return $query->row_array();

	}

}

?>
