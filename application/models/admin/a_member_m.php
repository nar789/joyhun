<?PHP
class A_member_m extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

	function id_check($id) //회원가입시 기존 아이디 유무 체크
    {
        $query = $this->db->get_where('users', array('userid' => $id));
        return $query->num_rows();
    }

	function nick_check($ju) //회원가입시 기존 닉네임 유무 체크
    {
        $query = $this->db->get_where('users', array('nickname' => $ju));
		return $query->num_rows();
    }

	function name_check($ju) //게시판 영문명 중복 체크
    {
        $query = $this->db->get_where('board_list', array('name_en' => 'board_'.$ju));
		return $query->num_rows();
    }

	function member_list($page, $rp, $data, $table)
	{
		//if(empty($data)){return;exit;}

		$this->db->start_cache();
		$this->db->select('*')->from($table);

		if ($data) {
			if(@$data['method'] && @$data['s_word']){
				//휴대폰 검색처리
				if($data['method'] == "m_hp"){
					$where = "CONCAT(m_hp1, m_hp2, m_hp3) like '%".str_replace("-", "", $data['s_word'])."%'";
				}else if($data['method'] == "m_ip"){
					$where = "(m_ip = '".$data['s_word']."' or last_login_ip = '".$data['s_word']."')";
				}else{
				//그외 검색처리
					$where = array($data['method'] => $data['s_word']);
				}
				$this->db->where($where);
			}

			if(@$data['method2'] && @$data['s_word2']){
				//휴대폰 검색처리
				if($data['method2'] == "m_hp"){
					$where = "CONCAT(m_hp1, m_hp2, m_hp3) like '%".str_replace("-", "", $data['s_word2'])."%'";
				}else if($data['method'] == "m_ip"){
					$where = "(m_ip = '".$data['s_word']."' or last_login_ip = '".$data['s_word']."')";
				}else{
				//그외 검색처리
					$where = array($data['method2'] => $data['s_word2']);
				}
				$this->db->where($where);
			}
  		}

		$this->db->stop_cache();

		$totalRows = $this->db->count_all_results();
		$query = $this->db->order_by('m_num', 'desc')->limit($rp, $page)->get();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}
	
	//탈퇴회원리스트
	function member_secession_list($page, $rp, $data, $table)
	{
		$this->db->start_cache();
		$this->db->select('*')->from($table);

		if ($data) {
			if(@$data['method'] && @$data['s_word']){
				//휴대폰 검색처리
				if($data['method'] == "m_hp"){
					$where = ('CONCAT(m_hp1, m_hp2, m_hp3) like "%'.$data['s_word'].'%"');
				}else{
				//그외 검색처리
					$where = array($data['method'] => $data['s_word']);
				}
				$this->db->where($where);
			}

			if(@$data['method2'] && @$data['s_word2']){
				//휴대폰 검색처리
				if($data['method2'] == "m_hp"){
					$where = ('CONCAT(m_hp1, m_hp2, m_hp3) like "%'.$data['s_word'].'%"');
				}else{
				//그외 검색처리
					$where = array($data['method2'] => $data['s_word2']);
				}
				$this->db->where($where);
			}
  		}
		$this->db->stop_cache();
		
		
		$totalRows = $this->db->count_all_results();
		$query = $this->db->order_by('m_num', 'desc')->limit($rp, $page)->get();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);
	}



	function member_list2($mode, $search_word, $offset, $per_page)
	{

		$where = "";
		$this->db->select('*');
		$this->db->order_by('m_num', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get('TotalMembers');

        return $query->result_array();
	}

	function admin_list($mode, $search_word, $offset, $per_page)
	{
		if( $search_word )
		{
			$search_qry = "and (userid like '%".$search_word."%' or username like '%".$search_word."%'  or nickname like '%".$search_word."%' or email like '%".$search_word."%' or auth_code like '%".$search_word."%') ";
		}
		else
		{
			$search_qry = "";
		}

		if($mode =='master')
		{
			$sse = "(auth_code = 'ADMIN') and ";
		}
		elseif($mode =='member')
		{
			$sse = "(auth_code = 'USER') and ";
		}
		else
		{
			$sse = "";
		}

		$sql = "SELECT id as user_no, auth_code, userid, nickname, email, username, created, last_ip, banned
		FROM users WHERE ".$sse." 1=1 ".$search_qry."
		ORDER BY id DESC limit ".$offset.", ".$per_page." ";

		$q=$this->db->query($sql);

		return $q->result_array();
	}

	function getAdminTotalData($mode, $search_word, $offset, $per_page)
	{
		if( $search_word =='all_keyword' )
		{
			$search_qry = "";
		}
		else
		{
			$search_qry = "and (userid like '%".$search_word."%' or username like '%".$search_word."%'  or nickname like '%".$search_word."%' or email like '%".$search_word."%' or auth_code like '%".$search_word."%') ";
		}

		if($mode =='master')
		{
			$sse = "(auth_code = 'ADMIN') and ";
		}
		elseif($mode =='member')
		{
			$sse = "(auth_code = 'USER') and ";
		}
		else
		{
			$sse = "";
		}

		$sql = "SELECT id FROM users WHERE ".$sse." 1=1  ".$search_qry." ";
		$q=$this->db->query($sql);

		return $q->num_rows();
	}

	function master_add($post)
	{
		//tank_auth 비밀번호 생성
		require_once('application/libraries/phpass-0.1/PasswordHash.php');

		define('PHPASS_HASH_STRENGTH', 8);
		define('PHPASS_HASH_PORTABLE', FALSE);

		$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$hashed_password = $hasher->HashPassword($post['user_pw']);

		$data = array(
				'userid' => $post['user_id'] ,
                'username' => $post['user_nm'] ,
				'password' => $hashed_password ,
                'email' => $post['user_email'],
				'nickname' => $post['user_nickname'],
				'auth_code' => $post['auth_type'],
				'created' =>  NOW
            );
		$aa=$this->db->insert('users', $data);
		$user_nos= $this->db->insert_id();

		$data1 = array(
                'user_id' => $user_nos
            );
		$bb=$this->db->insert('user_profiles', $data1);

        return $aa;
	}

	//게시판 리스트
	function board_list($mode, $search_word, $offset, $per_page)
	{
		if( $search_word )
		{
			$search_qry = "and (name like '%".$search_word."%' or name_en like '%".$search_word."%') ";
		}
		else
		{
			$search_qry = "";
		}

		$sql = "SELECT * FROM board_list WHERE 1=1 ".$search_qry." ORDER BY no DESC limit ".$offset.", ".$per_page;

		$q=$this->db->query($sql);

		return $q->result_array();
	}

	function board_list_count($mode, $search_word, $offset, $per_page)
	{
		if( $search_word =='all_keyword' )
		{
			$search_qry = "";
		}
		else
		{
			$search_qry = "and (name like '%".$search_word."%' or name_en like '%".$search_word."%') ";
		}


		$sql = "SELECT no FROM board_list WHERE 1=1  ".$search_qry;

		$q=$this->db->query($sql);

		return $q->num_rows();
	}

	//게시판 추가
	function board_add($post)
	{
		$data = array(
				'name' => $post['name'] ,
                'name_en' => 'board_'.$post['name_en'] ,
				'enable' => $post['enable'] ,
                'permission' => $post['per1']."|".$post['per2']."|".$post['per3']."|".$post['per4'],
				'skin' => $post['skin'],
				'reg_date' =>  NOW
            );
		$aa=$this->db->insert('board_list', $data);

        return $aa;
	}


/* ## 번개팅 list */

	function beongae_list($page, $rp, $data, $table)
	{
		//번개팅 리스트
		$this->db->start_cache();
		$this->db->select('*')->from('T_MeetingDate_Bun');
		$this->db->join('TotalMembers', 'TotalMembers.m_userid = T_MeetingDate_Bun.b_userid');

		if (@$search) {
			foreach($search as $key => $value)
			{				
				if(trim($value)){
					if(substr($key,0,3) == "ex_"){
						$this->db->where($value);
					}else{
						$this->db->where($key, $value);
					}
				}
			}
  		}

		$this->db->stop_cache();

		$query = $this->db->order_by('idx', 'desc')->limit($rp, $page)->get();
		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();
        return array($query->result_array(),$totalRows);

	}
/* ## 번개팅 list */



	//회원가입 통계내역
	function register_stat($this_month){

		$sql = " select day(last_day('".$this_month."')) last_day ";

		$q = $this->db->query($sql);

		$last_day = $q->row()->last_day;
		
		$sql2 = "";
		$union = "union all";

		$m_date = explode('-', $this_month);
		$m_year		= $m_date[0];		//년
		$m_month	= $m_date[1];		//월

		$m_day = $m_year."-".$m_month;

		$m_last_day = $m_day."-".$last_day;		//해당달의 마지막 날짜

		for($i=$last_day; $i>=1; $i--){

			if($i == "1"){
				$union = "";
			}
		
			$sql2 .= " select '".$m_day."-".zero_num($i)."' m_day ".$union." ";	
		}

		$strSQL1 = "";
		$strSQL1 .= " SELECT a.m_day m_day, IFNULL(b.cnt, 0)+IFNULL(d.cnt, 0) m_cnt, IFNULL(c.cnt, 0)+IFNULL(e.cnt, 0) f_cnt, IFNULL(d.cnt, 0)+IFNULL(e.cnt, 0) r_cnt ";
		$strSQL1 .= " , IFNULL(b.cnt, 0)+IFNULL(d.cnt, 0)+IFNULL(c.cnt, 0)+IFNULL(e.cnt, 0) a_cnt, IFNULL(f.cnt, 0) out_cnt";
		$strSQL1 .= ", IFNULL(g.cnt, 0) mobile_m_cnt, IFNULL(h.cnt, 0) mobile_w_cnt ";
		$strSQL1 .= " , IFNULL(ROUND((IFNULL(g.cnt, 0)+IFNULL(h.cnt, 0))/(IFNULL(b.cnt, 0)+IFNULL(d.cnt, 0)+IFNULL(c.cnt, 0)+IFNULL(e.cnt, 0))*100, 1), 0) mobile_per ";
		$strSQL1 .= " FROM ";
		$strSQL1 .= " (".$sql2.") a ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(m_in_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM TotalMembers ";
		$strSQL1 .= " WHERE m_in_date >= '".$this_month." 00:00:00' AND m_in_date <= '".$m_last_day." 24:00:00' AND m_sex = 'M' ";
		$strSQL1 .= " GROUP BY DATE(m_in_date) ";
		$strSQL1 .= " ) b ";
		$strSQL1 .= " ON a.m_day = b.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(m_in_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM TotalMembers ";
		$strSQL1 .= " WHERE m_in_date >= '".$this_month." 00:00:00' AND m_in_date <= '".$m_last_day." 24:00:00' AND m_sex = 'F' ";
		$strSQL1 .= " GROUP BY DATE(m_in_date) ";
		$strSQL1 .= " ) c ";
		$strSQL1 .= " ON a.m_day = c.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(write_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM reg_member ";
		$strSQL1 .= " WHERE write_date >= '".$this_month." 00:00:00' AND write_date <= '".$m_last_day." 24:00:00' AND sex = 'M' ";
		$strSQL1 .= " GROUP BY DATE(write_date) ";
		$strSQL1 .= " ) d ";
		$strSQL1 .= " ON a.m_day = d.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(write_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM reg_member ";
		$strSQL1 .= " WHERE write_date >= '".$this_month." 00:00:00' AND write_date <= '".$m_last_day." 24:00:00' AND sex = 'F' ";
		$strSQL1 .= " GROUP BY DATE(write_date) ";
		$strSQL1 .= " ) e ";
		$strSQL1 .= " ON a.m_day = e.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";

		if($m_last_day >= '2017-01-01'){
			$strSQL1 .= " ( ";
			$strSQL1 .= " SELECT DATE(last_login_day) m_day, COUNT(*) cnt ";
			$strSQL1 .= " FROM TotalMembers_out ";
			$strSQL1 .= " WHERE 1=1 AND last_login_day >= '".$this_month." 00:00:00' AND last_login_day <= '".$m_last_day." 24:00:00' ";
			$strSQL1 .= " GROUP BY DATE(last_login_day) ";
			$strSQL1 .= " ) f ";
		}else{
			$strSQL1 .= " ( ";
			$strSQL1 .= " SELECT DATE(CONCAT(m_out_year ,'-',m_out_month,'-',m_out_day)) m_day, COUNT(*) cnt ";
			$strSQL1 .= " FROM TotalMOut ";
			$strSQL1 .= " WHERE CONCAT(m_out_year ,'-',m_out_month,'-',m_out_day)  >= '".$this_month." 00:00:00' AND CONCAT(m_out_year ,'-',m_out_month,'-',m_out_day) <= '".$m_last_day." 24:00:00'  ";
			$strSQL1 .= " GROUP BY DATE(CONCAT(m_out_year ,'-',m_out_month,'-',m_out_day)) ";
			$strSQL1 .= " ) f ";
		}		

		$strSQL1 .= " ON a.m_day = f.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(m_in_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM TotalMembers ";
		$strSQL1 .= " WHERE m_in_date >= '".$this_month." 00:00:00' AND m_in_date <= '".$m_last_day." 24:00:00' AND m_sex = 'M' AND m_mobile_chk = '1' ";
		$strSQL1 .= " GROUP BY DATE(m_in_date) ";
		$strSQL1 .= " ) g ";
		$strSQL1 .= " ON a.m_day = g.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(m_in_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM TotalMembers ";
		$strSQL1 .= " WHERE m_in_date >= '".$this_month." 00:00:00' AND m_in_date <= '".$m_last_day." 24:00:00' AND m_sex = 'F' AND m_mobile_chk = '1' ";
		$strSQL1 .= " GROUP BY DATE(m_in_date) ";
		$strSQL1 .= " ) h ";
		$strSQL1 .= " ON a.m_day = h.m_day ";
		$strSQL1 .= " WHERE 1=1 ";
		$strSQL1 .= " ORDER BY a.m_day DESC ";

		$strSQL2 = " SELECT COUNT(*) cnt FROM TotalMembers WHERE m_in_date >= '".$this_month." 00:00:00' AND m_in_date <= '".$m_last_day." 24:00:00' AND (m_sex = 'M' OR m_sex = 'F') ";		//정식회원 카운트
		$strSQL3 = " SELECT COUNT(*) cnt FROM reg_member WHERE write_date >= '".$this_month." 00:00:00' AND write_date <= '".$m_last_day." 24:00:00' ";			//임시회원 카운트

		$query1 = $this->db->query($strSQL1);
		$query2 = $this->db->query($strSQL2);
		$query3 = $this->db->query($strSQL3);

		return array($query1->result_array(), $query2->row()->cnt, $query3->row()->cnt);

	}


	//앱설치 일일 통계내역
	function app_stat($this_month){

		$sql = " select day(last_day('".$this_month."')) last_day ";

		$q = $this->db->query($sql);

		$last_day = $q->row()->last_day;
		
		$sql2 = "";
		$union = "union all";

		$m_date = explode('-', $this_month);
		$m_year		= $m_date[0];		//년
		$m_month	= $m_date[1];		//월

		$m_day = $m_year."-".$m_month;

		$m_last_day = $m_day."-".$last_day;		//해당달의 마지막 날짜

		for($i=$last_day; $i>=1; $i--){

			if($i == "1"){
				$union = "";
			}
		
			$sql2 .= " select '".$m_day."-".zero_num($i)."' m_day ".$union." ";	
		}

		$strSQL1 = "";
		$strSQL1 .= " SELECT a.m_day m_day, IFNULL(b.cnt, 0) m_cnt, IFNULL(c.cnt, 0) login_cnt ";
		$strSQL1 .= " FROM ";
		$strSQL1 .= " (".$sql2.") a ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(reg_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM joytalk_id ";
		$strSQL1 .= " WHERE reg_date  >= '".$this_month." 00:00:00' AND reg_date  <= '".$m_last_day." 24:00:00'  ";
		$strSQL1 .= " GROUP BY DATE(reg_date) ";
		$strSQL1 .= " ) b ";
		$strSQL1 .= " ON a.m_day = b.m_day ";
		$strSQL1 .= " LEFT OUTER JOIN ";
		$strSQL1 .= " ( ";
		$strSQL1 .= " SELECT DATE(reg_date) m_day, COUNT(*) cnt ";
		$strSQL1 .= " FROM joytalk_id ";
		$strSQL1 .= " WHERE reg_date  >= '".$this_month." 00:00:00' AND reg_date  <= '".$m_last_day." 24:00:00' and m_userid is not null ";
		$strSQL1 .= " GROUP BY DATE(reg_date) ";
		$strSQL1 .= " ) c ";
		$strSQL1 .= " ON a.m_day = c.m_day ";
		$strSQL1 .= " WHERE 1=1 ";
		$strSQL1 .= " ORDER BY a.m_day DESC ";

		$strSQL2 = " SELECT COUNT(*) cnt FROM joytalk_id WHERE reg_date >= '".$this_month." 00:00:00' AND reg_date <= '".$m_last_day." 24:00:00' ";			//이달의 앱설치

		$strSQL3 = " SELECT COUNT(*) cnt FROM joytalk_id  ";			//전체 앱설치

		$strSQL4 = " SELECT COUNT(*) cnt FROM joytalk_id WHERE reg_date >= '".$this_month." 00:00:00' AND reg_date <= '".$m_last_day." 24:00:00' and m_userid is not null ";			//이달의 앱설치자중 로그인한 회원

		$query1 = $this->db->query($strSQL1);
		$query2 = $this->db->query($strSQL2);
		$query3 = $this->db->query($strSQL3);
		$query4 = $this->db->query($strSQL4);

		return array($query1->result_array(), $query2->row()->cnt, $query3->row()->cnt, $query4->row()->cnt);

	}



	//파트너 통계관련
	//선택 기간별 파트너 아이디 검색
	function partner_id_search($from_date, $to_date){
		
		$strSQL = "";
		$strSQL .= " SELECT m_partner ";
		$strSQL .= " FROM TotalMembers ";
		$strSQL .= " WHERE m_in_date >= '".$from_date." 00:00:00' AND m_in_date <= '".$to_date." 24:00:00' AND m_partner IS NOT NULL ";
		$strSQL .= " GROUP BY m_partner ";

		$query = $this->db->query($strSQL);

		return array($query->result_array(), $strSQL);
	}
	
	//파트너 통계
	function partner_data($list, $partner, $start, $end, $sub_qurey){
		
		$sql = "";
		for($i=count($list)-1; $i>=1; $i--){
			$sql .= " , ifnull(( ";
			$sql .= " select count(*) cnt ";
			$sql .= " from( ";
			$sql .= " select m_partner from TotalMembers WHERE m_in_date >= '".$list[$i]." 00:00:00' AND m_in_date <= '".$list[$i]." 24:00:00' AND m_partner IS NOT NULL union all ";
			$sql .= " select m_partner from TotalMembers_out WHERE m_in_date >= '".$list[$i]." 00:00:00' AND m_in_date <= '".$list[$i]." 24:00:00' AND m_partner IS NOT NULL ";
			$sql .= " ) a ";
			$sql .= " where 1=1 ";
			$sql .= " and a.m_partner = t.m_partner ";
			$sql .= " group by a.m_partner ";
			$sql .= " ), 0) cnt_".$i." ";
		}

		$strSQL1 = "";
		$strSQL1 .= " SELECT t.m_partner ";
		$strSQL1 .= $sql;
		$strSQL1 .= " FROM ";
		$strSQL1 .= " ( ".$sub_qurey." ) t ";
		$strSQL1 .= " WHERE 1=1 ";
		
		$strSQL2 ="";
		$strSQL2 .= " SELECT SUM(a.cnt) cnt FROM( ";
		$strSQL2 .= " SELECT count(*) cnt FROM TotalMembers WHERE m_in_date >= '".$start." 00:00:00' AND m_in_date <= '".$end." 24:00:00' AND m_partner IS NOT NULL UNION ALL";
		$strSQL2 .= " SELECT count(*) cnt FROM TotalMembers_out WHERE m_in_date >= '".$start." 00:00:00' AND m_in_date <= '".$end." 24:00:00' AND m_partner IS NOT NULL ";
		$strSQL2 .= " ) a WHERE 1=1 ";

		$query1 = $this->db->query($strSQL1);
		$query2 = $this->db->query($strSQL2);

		$query1_result = $query1->result_array();
		$query2_result = $query2->row()->cnt;
		
		if(count($query1_result) > 0){
			
			$sql3 = "";
			$sql3_col = " select t_".(count($list)-1).".m_partner ";
			for($j=count($list)-1; $j>=1; $j--){
				
				$sql2 = "";
				for($i=0; $i<count($query1_result); $i++){
				
					if($i == count($query1_result)-1){ $union = ""; }else{ $union  = "union all"; };
					
					$sql2 .= " select '".$query1_result[$i]['m_partner']."' m_partner, ifnull(sum(price), 0) total_price ";
					$sql2 .= " from( ";
					$sql2 .= " select ifnull((select sum(p.m_price) from payment_temp p where m.m_userid = p.m_userid and p.m_card_ok = 'Y' and p.m_okdate >= '".$list[$j]." 00:00:00' and p.m_okdate <= '".$list[$j]." 24:00:00'), 0) price ";
					$sql2 .= " from( ";
					$sql2 .= " select m_partner, m_userid from TotalMembers where 1=1 and m_partner = '".$query1_result[$i]['m_partner']."' and m_in_date >= '".$list[$j]." 00:00:00' AND m_in_date <= '".$list[$j]." 24:00:00' union all ";
					$sql2 .= " select m_partner, m_userid from TotalMembers_out where 1=1 and m_partner = '".$query1_result[$i]['m_partner']."' and m_in_date >= '".$list[$j]." 00:00:00' AND m_in_date <= '".$list[$j]." 24:00:00' ";
					$sql2 .= " ) m WHERE 1=1 ) t where 1=1 ".$union." ";

				}

				$sql3_col .= " , ifnull(t_".$j.".total_price, 0) total_price_".$j." ";
				
				
				if($j == count($list)-1){
					$sql3 .= " from (".$sql2.") t_".(count($list)-1)." ";
				}else{
					$sql3 .= " left outer join (".$sql2.") t_".$j." on t_".(count($list)-1).".m_partner = t_".$j.".m_partner ";
				}

			}

			$sql4 = $sql3_col.$sql3;
		}
		
		$query3 = $this->db->query($sql4);
		$query3_result = $query3->result_array();
		
		return array($query1_result, $query2_result, $query3_result);

		
	}

	//파트너 전환률 통계
	function partner_per_data($start, $end, $partner_id){
		
		//상품코드 셋팅
		$product_where = " AND (
			a.m_product_code = '1001' OR 
			a.m_product_code = '1002' OR 
			a.m_product_code = '1003' OR 
			a.m_product_code = '1004' OR 
			a.m_product_code = '1005' OR 
			a.m_product_code = '2001' OR 
			a.m_product_code = '2002' OR 
			a.m_product_code = '2003' 
		) ";

		//파트너아이디, 가입자수, 유료가입자수(재결제횟수), 정회원전환율, 최초결제(원), 총결제(원), 인증률
		$sql = "";
		$sql .= " SELECT A.m_partner, A.total_member_cnt, D.reg_member_cnt, IFNULL(B.pay_member, 0) pay_member, IFNULL(B.repay_member, 0) repay_member ";
		$sql .= " , ROUND(IFNULL(B.pay_member, 0)/A.total_member_cnt*100, 2) pay_member_per ";
		$sql .= " , IFNULL(C.first_total_price, 0) first_total_price, IFNULL(B.total_price, 0) total_price ";
		$sql .= " , ROUND(A.total_mobile_chk/A.total_member_cnt*100, 2) mobie_chk_per ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_partner m_partner, SUM(a.cnt) total_member_cnt, SUM(mobile_chk) total_mobile_chk ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT m_partner, COUNT(*) cnt, SUM(IFNULL(m_mobile_chk, 0)) mobile_chk ";
		$sql .= " FROM TotalMembers ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND m_in_date >= '".$start." 00:00:00' ";
		$sql .= " AND m_in_date <= '".$end." 24:00:00' ";
		$sql .= " AND m_partner IS NOT NULL ";
		$sql .= " GROUP BY m_partner ";
		$sql .= " UNION ";
		$sql .= " SELECT m_partner, COUNT(*) cnt, SUM(IFNULL(m_mobile_chk, 0)) mobile_chk ";
		$sql .= " FROM TotalMembers_out ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND m_in_date >= '".$start." 00:00:00' ";
		$sql .= " AND m_in_date <= '".$end." 24:00:00' ";
		$sql .= " AND m_partner IS NOT NULL ";
		$sql .= " GROUP BY m_partner ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " GROUP BY a.m_partner ";
		$sql .= " ) A ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_partner, COUNT(a.m_userid) pay_member, SUM(a.cnt-1) repay_member, SUM(a.member_price) total_price ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_userid, COUNT(*) cnt, b.m_partner, SUM(a.m_price), SUM(a.m_price) member_price ";
		$sql .= " FROM payment_temp a ";
		$sql .= " ,( ";
		$sql .= " SELECT m_userid, m_partner FROM TotalMembers WHERE 1=1 AND m_partner IS NOT NULL UNION ALL ";
		$sql .= " SELECT m_userid, m_partner FROM TotalMembers_out WHERE 1=1 AND m_partner IS NOT NULL ";
		$sql .= " ) b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.m_userid = b.m_userid ";
		$sql .= $product_where;
		$sql .= " AND a.m_card_ok = 'Y' ";
		$sql .= " AND a.m_cancel IS NULL ";
		$sql .= " AND a.m_okdate >= '".$start." 00:00:00' ";
		$sql .= " AND a.m_okdate <= '".$end." 24:00:00' ";
		$sql .= " GROUP BY a.m_userid ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " GROUP BY a.m_partner ";
		$sql .= " ) B ";
		$sql .= " ON A.m_partner = B.m_partner ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_partner, SUM(first_price) first_total_price ";
		$sql .= " FROM ";
		$sql .= " ( ";
		$sql .= " SELECT a.m_userid, b.m_partner, (SELECT c.m_price FROM payment_temp c WHERE 1=1 AND MIN(a.m_idx) = c.m_idx) first_price ";
		$sql .= " FROM payment_temp a ";
		$sql .= " ,( ";
		$sql .= " SELECT m_userid, m_partner FROM TotalMembers WHERE 1=1 AND m_partner IS NOT NULL UNION ALL ";
		$sql .= " SELECT m_userid, m_partner FROM TotalMembers_out WHERE 1=1 AND m_partner IS NOT NULL ";
		$sql .= " ) b ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND a.m_userid = b.m_userid ";
		$sql .= $product_where;
		$sql .= " AND a.m_card_ok = 'Y' ";
		$sql .= " AND a.m_cancel IS NULL ";
		$sql .= " AND a.m_okdate >= '".$start." 00:00:00' ";
		$sql .= " AND a.m_okdate <= '".$end." 24:00:00' ";
		$sql .= " GROUP BY a.m_userid ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " GROUP BY a.m_partner ";
		$sql .= " ) C ";
		$sql .= " ON A.m_partner = C.m_partner ";
		$sql .= " LEFT OUTER JOIN ";
		$sql .= " ( ";
		$sql .= " SELECT partner m_partner, COUNT(userid) reg_member_cnt ";
		$sql .= " FROM reg_member ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND write_date >= '".$start." 00:00:00' ";
		$sql .= " AND write_date <= '".$end." 24:00:00' ";
		$sql .= " GROUP BY partner ";
		$sql .= " ) D ";
		$sql .= " ON A.m_partner = D.m_partner ";
		$sql .= " WHERE 1=1 ";

		if($partner_id){
			$sql .= " AND A.m_partner = '".$partner_id."' ";
		}

		$sql .= " ORDER BY A.total_member_cnt DESC ";
	
		$query = $this->db->query($sql);

		return $query->result_array();
	
	}
	
	//임시회원 조회 리스트
	function reg_member_list($start, $rp, $search1, $search2){

		$sql = "";
		$sql .= " SELECT a.*, b.idx, b.user_id, b.user_name, b.year, b.month, b.day, b.commid, b.hp1, b.hp2, b.hp3, b.etc, b.write_date wrdate ";
		$sql .= " FROM reg_member a ";
		$sql .= " LEFT OUTER JOIN reg_member_auth b ON a.userid = b.user_id AND b.use_yn = 'Y' ";
		$sql .= " WHERE 1=1 ";

		if(!empty($search1[0]) and !empty($search1[1])){ $sql .= " AND ".$search1[0]." = '".$search1[1]."' "; }
		if(!empty($search2[0]) and !empty($search2[1])){ $sql .= " AND ".$search2[0]." = '".$search2[1]."' "; }
		
		$sql .= " ORDER BY b.idx DESC, a.write_date DESC ";
		
		$paging = " LIMIT ".$start.", ".$rp." ";
		
		$query1 = $this->db->query($sql.$paging);
		$query2 = $this->db->query($sql);
		
		return array($query1->result_array(), $query2->num_rows());

	}

	//임시회원 회원가입 처리 대기 리스트
	function reg_member_user_list(){

		$sql = "";
		$sql .= " SELECT a.*, b.idx, b.user_id, b.user_name, b.year, b.month, b.day, b.commid, b.hp1, b.hp2, b.hp3, b.etc, b.write_date wrdate ";
		$sql .= " FROM reg_member a ";
		$sql .= " LEFT OUTER JOIN reg_member_auth b ON a.userid = b.user_id AND b.use_yn = 'Y' ";
		$sql .= " WHERE 1=1 ";
		$sql .= " AND b.idx is not null ";
		$sql .= " ORDER BY b.idx ASC ";
		$sql .= " LIMIT 20 ";

		$query = $this->db->query($sql);
		
		return $query->result_array();
			
	}

}

?>