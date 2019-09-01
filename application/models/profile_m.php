<?PHP
class Profile_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	/************************ 내정보관리 ************************/

	/************************ 회원탈퇴 처리 함수 ************************/
	//회원 탈퇴 처리 
	function member_secession($user_id, $m_reason, $m_reason_content){

		$sql = "";
		$sql .= " INSERT INTO TotalMembers_out(m_userid, m_pwd, m_pwd2, m_name, m_nick, m_jumin1, m_jumin2, m_age, m_age2, m_sex ";
		$sql .= " , m_region, m_post1, m_post2, m_addr1, m_addr2, m_hp1, m_hp2, m_hp3, m_hp_view, m_hp_sms, m_mail, m_mail_yn, m_job ";
		$sql .= " , m_reason, m_file, m_filename, m_filename_update, m_popularity, m_avataid, m_type, m_partner, m_in_date, m_up_date, logon ";
		$sql .= " , m_ip, m_arsid, m_arsid_in, m_height, m_weight, m_instyle, m_outstyle, m_character, m_boldid, m_region2, m_level, m_pass_search ";
		$sql .= " , m_pass_answer, m_name_yn, m_conregion, m_conregion2, m_conregion3, m_school, m_message, open_cafe_code, m_mobile_chk, m_mobile_chke_date ";
		$sql .= " , m_member_out, m_master, m_check_master, m_joinReg, m_otherJoin, m_hpcomp, m_blood, m_random, m_ipinck, m_mail_error, m_partner_check ";
		$sql .= " , last_login_day, last_login_ip, auth_code, activated, banned, ban_reason, new_password_key, new_password_requested, new_email, new_email_key ";
		$sql .= " , my_intro, m_mail_open_yn, m_main_chu, m_main_chu_date, m_nick_chk, m_login_cnt, m_special, m_partner_code, m_reg_mobile, m_select_conregion ";
		$sql .= " , m_xpoint, m_ypoint)  ";
		$sql .= " SELECT m_userid, m_pwd, m_pwd2, m_name, m_nick, m_jumin1, m_jumin2, m_age, m_age2, m_sex ";
		$sql .= " , m_region, m_post1, m_post2, m_addr1, m_addr2, m_hp1, m_hp2, m_hp3, m_hp_view, m_hp_sms, m_mail, m_mail_yn, m_job ";
		$sql .= " , m_reason, m_file, m_filename, m_filename_update, m_popularity, m_avataid, m_type, m_partner, m_in_date, m_up_date, logon ";
		$sql .= " , m_ip, m_arsid, m_arsid_in, m_height, m_weight, m_instyle, m_outstyle, m_character, m_boldid, m_region2, m_level, m_pass_search ";
		$sql .= " , m_pass_answer, m_name_yn, m_conregion, m_conregion2, m_conregion3, m_school, m_message, open_cafe_code, m_mobile_chk, m_mobile_chke_date ";
		$sql .= " , '".NOW."', m_master, m_check_master, m_joinReg, m_otherJoin, m_hpcomp, m_blood, m_random, m_ipinck, m_mail_error, m_partner_check ";
		$sql .= " , last_login_day, last_login_ip, auth_code, activated, banned, ban_reason, new_password_key, new_password_requested, new_email, new_email_key ";
		$sql .= " , my_intro, m_mail_open_yn, m_main_chu, m_main_chu_date, m_nick_chk, m_login_cnt, m_special, m_partner_code, m_reg_mobile, m_select_conregion ";
		$sql .= " , m_xpoint, m_ypoint ";
		$sql .= " FROM TotalMembers ";
		$sql .= " WHERE m_userid = '".$user_id."' ";

		$rtn = $this->db->query($sql);
		
		if($rtn == "1"){
			
			//탈퇴테이블에 탈퇴분류 및 탈퇴사유 업데이트처리
			$this->my_m->update('TotalMembers_out', array('m_userid' => $user_id), array('m_reason_val' => $m_reason, 'm_reason_content' => $m_reason_content));

			//회원탈퇴테이블에 insert성공시 기존 회원테이블에서 삭제처리
			$this->my_m->del('TotalMembers', array('m_userid' => $user_id));
			$this->my_m->del('TotalMembers_login', array('m_userid' => $user_id));

			$this->my_m->del('alrim_msg', array('user_id' => $user_id));		//alrim_msg 삭제
			$this->my_m->del('alrim_new', array('user_id' => $user_id));		//alrim_new 삭제

			//chat 삭제
			$this->my_m->del('chat', array('recv_id' => $user_id));
			$this->my_m->del('chat', array('send_id' => $user_id));

			//chat_request 삭제
			$this->my_m->del('chat_request', array('recv_id' => $user_id));
			$this->my_m->del('chat_request', array('send_id' => $user_id));

			//포인트 결제 관련 삭제
			$sql1 = "";
			$sql1 .= " insert into payment_temp_backup( ";
			$sql1 .= " m_userid, m_product_code, m_goods, m_price, m_point, m_cash_gb, m_commid, m_mobilid, m_mrchid, m_mstr, m_hp, m_payeremail, m_card_ok, m_tradeid, m_signdate, m_payment_gb ";
			$sql1 .= " , m_result_code, m_writedate, m_okdate, m_cancel, m_pay_gubn, m_ok_name, m_cancel_name, m_etc_1, m_agent, m_hp_gubn ";
			$sql1 .= " ) ";
			$sql1 .= " select m_userid, m_product_code, m_goods, m_price, m_point, m_cash_gb, m_commid, m_mobilid, m_mrchid, m_mstr, m_hp, m_payeremail, m_card_ok, m_tradeid, m_signdate, m_payment_gb ";
			$sql1 .= " , m_result_code, m_writedate, m_okdate, m_cancel, m_pay_gubn, m_ok_name, m_cancel_name, m_etc_1, m_agent, m_hp_gubn ";
			$sql1 .= " from payment_temp ";
			$sql1 .= " where 1=1 ";
			$sql1 .= " and m_userid = '".$user_id."' ";
			$sql1 .= " order by m_idx asc ";

			$this->db->query($sql1);

			$this->my_m->del('payment_temp', array('m_userid' => $user_id));
			
			//포인트 사용내역 관련 삭제
			$sql2 = "";
			$sql2 .= " insert into member_point_list_backup( ";
			$sql2 .= " m_userid, m_product_code, m_goods, m_point, m_price, m_tradeid, m_etc, m_writedate ";
			$sql2 .= " ) ";
			$sql2 .= " select m_userid, m_product_code, m_goods, m_point, m_price, m_tradeid, m_etc, m_writedate ";
			$sql2 .= " from member_point_list ";
			$sql2 .= " where 1=1 ";
			$sql2 .= " and m_userid = '".$user_id."' ";
			$sql2 .= " order by m_idx asc ";

			$this->db->query($sql2);

			$this->my_m->del('member_point_list', array('m_userid' => $user_id));


		}

		return $rtn;
		
	}

	
	/************************ 아이디찾기 ************************/

	//아이디 찾기
	function my_id_find($v_table, $arr_data){
		
		$this->db->start_cache();

		$this->db->select('m_userid')->from($v_table);
		$query = $this->db->where($arr_data)->get();
		$this->db->stop_cache();

		$totalRows = $this->db->count_all_results();

		$this->db->flush_cache();

		return array($query->result_array(), $totalRows);
	}

	/************************** 친구 **************************/

	//친구 리스트
	function my_friend_list($page, $rp, $search, $v_table, $mode, $v_group){


		$this->db->start_cache();
		$this->db->select($v_table.'.*, TotalMembers.m_nick as m_fnick, TotalMembers.m_sex as m_fsex,TotalMembers.m_age as m_fage, TotalMembers.m_conregion as m_fconregion, TotalMembers.m_conregion2 as m_fconregion2')->from($v_table);

		if($mode == "1" || $mode == "4"){
			$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.m_fuserid');
		}else{
			$this->db->join('TotalMembers', 'TotalMembers.m_userid = '.$v_table.'.m_userid');
		}
		
		if ($search) {
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
		
		if($mode == "1"){ 
			$this->db->where($v_table.'.m_userid', $this->session->userdata['m_userid']); 
			$this->db->where($v_table.'.m_gubun', '친구');
		}			//내가 등록한 친구

		if($mode == "2"){ 
			$this->db->where($v_table.'.m_fuserid', $this->session->userdata['m_userid']); 
			$this->db->where($v_table.'.m_gubun', '친구');
		}			//나를 등록한 친구

		if($mode == "4"){
			$this->db->where($v_table.'.m_userid', $this->session->userdata['m_userid']);
			$this->db->where($v_table.'.m_gubun', '나쁜친구');
		}		//나쁜친구


		if($v_group){ $this->db->where($v_table.'.m_gname', $v_group); }		//그룹

		$this->db->stop_cache();

		$query = $this->db->order_by($v_table.'.m_idx', 'desc')->limit($rp, $page)->get();
		
		$totalRows = $this->db->count_all_results();
		
		$this->db->flush_cache();
		
        return array($query->result_array(), $totalRows);

	
	}



	//서로 등록한 친구리스트
	function to_my_friend_list($page, $rp, $search, $v_table, $mode, $v_group){
	
		$sql = "";
		$sql .= " SELECT cc.* ";
		$sql .= " FROM( SELECT bb.m_gubun,bb.m_fuserid,bb.m_idx,";
		$sql .= " aa.m_nick AS m_fnick, aa.m_sex AS m_fsex, aa.m_age AS m_fage, aa.m_conregion AS m_fconregion, aa.m_conregion2 AS m_fconregion2 , bb.m_content";
		$sql .= "  FROM T_MakeFriend_List bb JOIN TotalMembers aa ON aa.m_userid = bb.m_fuserid ";
		$sql .= " WHERE aa.m_userid = bb.m_fuserid ";
		$sql .= " AND bb.m_userid = '".$this->session->userdata['m_userid']."' ";
		$sql .= " ) cc ";
		$sql .= " WHERE cc.m_fuserid IN (SELECT m_userid FROM T_MakeFriend_List WHERE m_fuserid = '".$this->session->userdata['m_userid']."' and m_gubun = '친구') ";
		$sql .= " AND cc.m_gubun = '친구' ";

		if($v_group){$sql .= "AND cc.m_gname = '".$v_group."' ";}

		$sql .= " ORDER BY cc.m_idx DESC ";

		$limit = " LIMIT ".$page.", ".$rp." ";

		//echo $strSQL;

		$query = $this->db->query($sql.$limit);		//페이징
		$query2 = $this->db->query($sql);			//결과값

		
		return array($query->result_array(), $query2->num_rows());
	}
	

	//무통장 입금 처리를 위한 검색
	function mu_deposit_data($search){

		$this->db->select('*')->from('payment_temp');

		if ($search) {
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

		$query = $this->db->order_by('m_idx', 'desc')->limit(1)->get();

		return $query->row_array();

	}


}

?>