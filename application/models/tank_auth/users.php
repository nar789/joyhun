<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authorization data. It operates the following tables:
 * - TABLE -- user account data,
 * - TABLE_PROFILE -- user profiles
 *
 * @package	Tank_auth
 * @author	Tank
 */
class Users extends CI_Model
{
	const TABLE			= 'TotalMembers';			// user accounts
	const TABLE_PROFILE	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_id($user_id, $activated = NULL)
	{
		$this->db->where('m_num', $user_id);
		if (!is_null($activated)) $this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by login (username or email)
	 *
	 * @param	string
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_login($login, $activated = NULL)
	{
		$this->db->where('m_userid', strtolower($login));
		$this->db->or_where('m_mail', strtolower($login));

		$query = $this->db->get(self::TABLE);

		if ($query->num_rows() == 1) {
			$row = $query->row();
			if (is_null($activated)) {
				return $row;
			} else {
				if ($activated) {
					if ($row->activated == 1) return $row;
				} else {
					if ($row->activated == 0) return $row;
				}
			}
		}
		return NULL;
	}

	/**
	 * Get user record by username
	 *
	 * @param	string
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_username($username, $activated = NULL)
	{
		$this->db->where('m_userid', strtolower($username));
		if (!is_null($activated)) $this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_email($email, $activated = NULL)
	{
		$this->db->where('m_mail', strtolower($email));
		if (!is_null($activated)) $this->db->where('activated', $activated ? 1 : 0);

		$query = $this->db->get(self::TABLE);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Check if username available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('m_name', strtolower($username));
		$query = $this->db->get(self::TABLE);
		return $query->num_rows() == 0;
	}

	function is_nickname_available($nickname)
	{
		$this->db->select('1', FALSE);
		$this->db->where('m_nick', strtolower($nickname));
		if(@$this->session->userdata['m_userid']){
			$this->db->where('m_userid <>', $this->session->userdata['m_userid']);
		}		
		$query = $this->db->get(self::TABLE);
		return $query->num_rows();
	}

	//회원가입시 아이디 중복검사용
	function is_userid_available2($m_userid)
	{
		//임시회원 아이디 중복검사 전용
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query = $this->db->get(self::TABLE);

		//탈퇴회원
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query2 = $this->db->get("TotalMembers_out");
		
		//임시회원
		$this->db->select('1', FALSE);
		$this->db->where('userid', strtolower($m_userid));
		$query3 = $this->db->get("reg_member");

		//휴면계정
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query4 = $this->db->get("TotalMembers_old");

		if($query->num_rows() != 0 or $query2->num_rows() != 0 or $query3->num_rows() != 0 or $query4->num_rows() != 0){
			return 0;
		}else{
			return 1;
		}
		//return $query->num_rows() == 0;
	}

	//최종 회원가입시 아이디 중복검사용 (임시회원테이블이 포함되있으면 안됨)
	function is_userid_available($m_userid)
	{
		//일반 아이디 중복검사
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query = $this->db->get(self::TABLE);

		//탈퇴회원
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query2 = $this->db->get("TotalMOut");

		//휴면계정
		$this->db->select('1', FALSE);
		$this->db->where('m_userid', strtolower($m_userid));
		$query4 = $this->db->get("TotalMembers_old");

		if($query->num_rows() != 0 or $query2->num_rows() != 0 or $query4->num_rows() != 0){
			return 0;
		}else{
			return 1;
		}
		//return $query->num_rows() == 0;
	}


	function banned_id_arr()
	{
		$this->db->select('banned_id');
        $query = $this->db->get_where('admin_setting', array('idx' => 1));
        return $query->row_array();
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('m_mail', strtolower($email));
		$this->db->or_where('new_email', strtolower($email));
		$query = $this->db->get(self::TABLE);
		return $query->num_rows() == 0;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data)
	{
		$data['m_in_date'] = date("Y-m-d H:i:s");
	//	$data['activated'] = $activated ? 1 : 0;

		if ($this->db->insert(self::TABLE, $data)) {
			$user_id = $this->db->insert_id();
		//	if ($activated)	$this->create_profile($user_id);
			$arr = array('send_id'=>'joyhunting',
				'resv_id'=>$data['m_userid'],
				'reg_date'=>date("Y-m-d H:i:s"),
				'contents'=>'조이헌팅에 회원가입을 축하드립니다.',
				'ip'=>'127.0.0.1'
			) ;
			//$this->db->insert('message', $arr);
			return array('user_id' => $user_id);
		}
		return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_user($user_id, $new_email_key)
	{
		$this->db->select('1', FALSE);
		$this->db->where('m_num', $user_id);
		$this->db->where('new_email_key', $new_email_key);
		$this->db->where('activated', 0);
		$query = $this->db->get(self::TABLE);

		if ($query->num_rows() == 1) {

			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('m_num', $user_id);
			$this->db->update(self::TABLE);

			$this->create_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function purge_na($expire_period = 172800)
	{
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete(self::TABLE);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @param	bool
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->db->where('m_num', $user_id);
		$this->db->delete(self::TABLE);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_password_key($user_id, $new_pass_key)
	{
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date("Y-m-d H:i:s"));
		$this->db->where('m_num', $user_id);
		$this->db->update(self::TABLE);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function can_reset_password($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('m_num', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);
		$query = $this->db->get(self::TABLE);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.
	 *
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('m_num', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);
		$this->db->update(self::TABLE);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('m_num', $user_id);
		$this->db->update(self::TABLE);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function set_new_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'new_email' : 'm_mail', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('m_num', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);
		$this->db->update(self::TABLE);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		$this->db->set('m_mail', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('m_num', $user_id);
		$this->db->where('new_email_key', $new_email_key);
		$this->db->update(self::TABLE);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_login_info($user_id, $record_ip, $record_time)
	{
		if(empty($user_id)){exit;}

		//특별회원 아이피 수정 안되게 막기
		$this->db->select('m_special');
		$this->db->where('m_userid', $user_id);
		$query = $this->db->get('TotalMembers');

		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		
		if(@$query->row()->m_special <> "1" and @$query->row()->m_special <> "2"){
			$this->db->set('last_login_ip', $this->input->ip_address());
		}

		$this->db->set('last_login_day', date("Y-m-d H:i:s"));
		$this->db->set('m_login_cnt','m_login_cnt+1', FALSE);

		$this->db->where('m_userid', $user_id);
		$this->db->update(self::TABLE);


	}

	/**
	 * Ban user
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function ban_user($user_id, $reason = NULL)
	{
		$this->db->where('m_num', $user_id);
		$this->db->update(self::TABLE, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	/**
	 * Unban user
	 *
	 * @param	int
	 * @return	void
	 */
	function unban_user($user_id)
	{
		$this->db->where('m_num', $user_id);
		$this->db->update(self::TABLE, array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	/**
	 * Create an empty profile for a new user
	 *
	 * @param	int
	 * @return	bool
	 */
	private function create_profile($user_id)
	{
		$this->db->set('user_id', $user_id);
		return $this->db->insert(self::TABLE_PROFILE);
	}

	/**
	 * Delete user profile
	 *
	 * @param	int
	 * @return	void
	 */
	private function delete_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete(self::TABLE_PROFILE);
	}
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */