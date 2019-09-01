<?PHP

class Search_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table = '';
    }

	//통합검색 기능
	function search_list($page, $rp, $post)
	{
		$field = " no, contents, subject, user_name, user_id, hit, voted_count, reply_count, reg_date ";
        $where = " WHERE (subject like \"%".$post['s_word']."%\" or contents like \"%".$post['s_word']."%\") and is_delete = 'N' and original_no = '0' ";

        $sql = "SELECT b.nickname, a.table, a.tbn, a.no, a.contents, a.subject, a.user_name, a.user_id, a.hit, a.voted_count, a.reply_count, a.reg_date from ( ";
        $sql.= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', ".$field." FROM board_notice ".$where.") UNION ";
        $sql.= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', ".$field." FROM board_free ".$where.") ";
        $sql.= " ) as a, users b where a.user_id=b.userid ";
        $sql.= "order by reg_date desc ";
		$sql.= 'limit '.$page.', '.$rp;
		//echo $sql; exit;
		$rs = $this->db->query($sql);
        return $rs->result_array();
	}

	//통합검색 기능
	function search_total($post){

		$field = " no, contents, subject, user_name, user_id, hit, voted_count, reply_count, reg_date ";
        $where = " WHERE (subject like \"%".$post['s_word']."%\" or contents like \"%".$post['s_word']."%\") and is_delete = 'N' and original_no = '0' ";

        $sql = "SELECT b.nickname, a.table, a.tbn, a.no, a.contents, a.subject, a.user_name, a.user_id, a.hit, a.voted_count, a.reply_count, a.reg_date from ( ";
        $sql.= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', ".$field." FROM board_notice ".$where.") UNION ";
        $sql.= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', ".$field." FROM board_free ".$where.") ";
        $sql.= " ) as a, users b where a.user_id=b.userid ";
        $sql.= "order by reg_date desc ";

		$rs = $this->db->query($sql);

        return $rs->num_rows();
	}

	//자기글 기능
	//페이지, 글갯수, 글쓴이 아이디, 원글-리플여부
	function my_list($page, $rp, $id, $reply){

		if($reply == 'REPLY') {
			$res = " and original_no != '0' ";
		} else {
			$res = " and original_no = '0' ";
		}
		$field = " no, contents, subject, user_name, user_id, hit, voted_count, reply_count, reg_date, original_no ";
        $where = " WHERE user_id = '".$id."' and is_delete = 'N' ".$res;

        $sql = "SELECT a.original_no, b.nickname, a.table, a.tbn, a.no, a.contents, a.subject, a.user_name, a.user_id, a.hit, a.voted_count, a.reply_count, a.reg_date from ( ";
        $sql.= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', ".$field." FROM board_notice ".$where.") UNION ";
        $sql.= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', ".$field." FROM board_free ".$where.") ";
        $sql.= " ) as a, users b where a.user_id=b.userid ";
        $sql.= "order by reg_date desc ";
		$sql.= 'limit '.$page.', '.$rp;

		$rs = $this->db->query($sql);
        return $rs->result_array();
	}

	//자기글 기능추가
	function my_total($id, $reply){

		if($reply == 'REPLY') {
			$res = " and original_no != '0' ";
		} else {
			$res = " and original_no = '0' ";
		}
		$field = " no, contents, subject, user_name, user_id, hit, voted_count, reply_count, reg_date, original_no ";
         $where = " WHERE user_id = '".$id."' and is_delete = 'N' ".$res;

        $sql = "SELECT a.original_no, b.nickname, a.table, a.tbn, a.no, a.contents, a.subject, a.user_name, a.user_id, a.hit, a.voted_count, a.reply_count, a.reg_date from ( ";
        $sql.= "(SELECT '공지사항'    as 'table', 'notice' as 'tbn', ".$field." FROM board_notice ".$where.") UNION ";
        $sql.= "(SELECT '자유게시판'    as 'table', 'free' as 'tbn', ".$field." FROM board_free ".$where.") ";
        $sql.= " ) as a, users b where a.user_id=b.userid ";
        $sql.= "order by reg_date desc ";

		$rs = $this->db->query($sql);
		//return $rs->result();

        return $rs->num_rows();
	}
}

?>
