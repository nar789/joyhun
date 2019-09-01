<?PHP

class Users_model extends Model {

    function Users_model()
    {
        // Call the Model constructor
        parent::Model();
    }

	function my_list($arg='board_qna')
	{
		$where = "";

		$this->db->order_by('reg_date', 'desc');
		$this->db->limit(15);

  		$where .= "(is_delete='N' and original_no='0')";
  		$this->db->where($where);

		$query = $this->db->get($arg);

        return $query->result_array();
	}

	function my_reply()
	{
		if ($post) {
			$this->db->like($post["method"], $post["s_word"]);
  		}
  		$this->db->where(array('is_delete'=>'N', 'original_no'=>'0'));

		$query = $this->db->get($this->table);

        return $query->num_rows();
	}
}

?>
