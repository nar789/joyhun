<?PHP
class Main_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function main_list($table_name, $table)
	{
		$this->db->cache_on();
		$tables = "board_".$table;
		$this->db->order_by($tables.'.no', 'desc');
		$this->db->limit(7);
  		$this->db->where(array("is_delete" => 'N', 'original_no' => '0'));
		$query = $this->db->get($tables);
		$this->db->cache_off();
		$return_val = '
		<div class="q_latest">

		<ol class="q_latest_ol">
			<li>
				<h4><a href="/'.$table.'/lists/page/1">'.$table_name.'</a></h4>
			</li>
			<ul>';
			foreach ($query->result_array() as $list)
			{

			$return_val .= '
				<li>
					<div style="float:left;">
						<img src="/images/main/arrow.gif"> <a href="/'.$table.'/view/'.$list['no'].'/page/1"> '.strcut_utf8(strip_tags($list['subject']), 21).' </a>';

						if ($list['reply_count'] > 0) {
							$return_val .= '&nbsp;<span class="comment">'.$list['reply_count'].'</span>';
						}
					$return_val .= '
					</div>
					<div style="float:right;">'.substr($list['reg_date'], 0, 10).'</div>
					<div class="q_latest_line"></div>
				</li>';
			 }
			$return_val .= '
			</ul>
		</ol>';

		if ($query->num_rows() == 0)
		{
			$return_val .= '
			<div><br>&nbsp; 게시물이 없습니다.
			</div>';
		}

		$return_val .= '</div><br>';
		return $return_val;
	}

	/**
	* 코멘트 최근리스트 표시
   	* @access private : 접근형태
    * @return String $return_val : 문자열
    */
	function comment_list()
	{
		$this->db->cache_on();

		$sql  = "SELECT b.nickname, a.table, a.tbn, a.no, a.original_no, a.contents, a.user_name, a.user_id, a.reg_date from ( ";
		$sql .= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_notice  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 ) UNION ";
		$sql .= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', no, original_no, contents, user_name, user_id, reg_date FROM board_free  WHERE  is_delete = 'N' and original_no != '0' order by no desc limit 7 )  ";


		$sql .= ") as a, users b where a.user_id=b.userid order by reg_date desc limit 7";

		$rs = $this->db->query($sql);

		$this->db->cache_off();

		$return_val = '
		<div class="q_latest">

		<ol class="q_latest_ol">
			<li>
				<h4><a href="/search/recent_comment">최근 코멘트</a></h4>
			</li>
			<ul>';
			foreach ($rs->result_array() as $list)
			{
				if($list['nickname'])
				{
					$name= $list['nickname'];
				}
				else
				{
					$name= $list['user_name'];
				}
			$return_val .= '
				<li>
					<div style="float:left;">
						<img src="/images/main/arrow.gif"> <a href="/'.$list['tbn'].'/view/'.$list['original_no'].'/page/1#row_num_'.$list['no'].'"> '.strcut_utf8(strip_tags($list['contents']), 21).' </a>';

					$return_val .= '
					</div>
					<div style="float:right;">'.substr($list['reg_date'], 0, 10).'</div>
					<div class="q_latest_line"></div>
				</li>';
			 }
		$return_val .= '
			</ul>
		</ol>';

		if ($rs->num_rows() == 0)
		{
		$return_val .= '
		<div><br>&nbsp; 게시물이 없습니다.
		</div>';
		}

		$return_val .= '</div><br>';
		return $return_val;
	}

	/**
	* 코멘트 최근리스트 표시
   	* @access private : 접근형태
    * @return String $return_val : 문자열
    */
	function comment_list_full()
	{

		$sql  = "SELECT b.nickname, a.table, a.tbn, a.no, a.original_no, a.contents, a.user_name, a.user_id, a.reg_date, a.subject, a.hit, a.voted_count, a.reply_count from ( ";
		$sql .= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_notice  WHERE  is_delete = 'N' and original_no != '0' ) UNION ";
		$sql .= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', no, original_no, contents, user_name, user_id, reg_date, subject, hit, voted_count, reply_count FROM board_free  WHERE  is_delete = 'N' and original_no != '0' ) ";

		$sql .= ") as a, users b where a.user_id=b.userid and a.reg_date like '".TODAY."%' order by no desc";

		$rs = $this->db->query($sql);

		return $rs->result_array();
	}

	//조이매거진 게시물 랜덤으로 2개 출력
	function joy_magazine_rand_list(){

		$sql = "";
		$sql .= " SELECT a.* ";
		$sql .= " FROM( ";
		$sql .= " SELECT * ";
		$sql .= " FROM joy_magazine ";
		$sql .= " WHERE use_yn = 'Y' ";
		$sql .= " ORDER BY idx DESC ";
		$sql .= " LIMIT 5 ";
		$sql .= " ) a ";
		$sql .= " WHERE 1=1 ";
		$sql .= " ORDER BY RAND() ";
		$sql .= " LIMIT 2 ";

		$query = $this->db->query($sql);

		return $query->result_array();
	}
}
?>