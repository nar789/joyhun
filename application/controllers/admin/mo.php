<?php
exit;
class Mo extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('admin/a_member_m');
		$this->load->library('member_lib');
		$this->load->helper('code_change_helper');
		$this->load->model('admin/payment_m');
		$this->load->model('admin/member_out_m');
	}

	function index()  //무통장 체크 전용
	{

		if ($this->session->userdata('auth_code'))
		{
			$this->session->set_userdata(array(
				'admin_mode'	=> "mo"
			));

			goto("/admin/etc/payment/payment_list");
		}
		else
		{

			$this->session->set_userdata(array(
				'admin_mode'	=> "mo"
			));

			$rpath ="/admin/etc/payment/payment_list";
			$rpath_encode = url_code($rpath, 'e');

			echo "<script>";
			echo "	location=\"" . BASEURL . "auth/admin_login/" . $rpath_encode . "\"";
			echo "</script>";

		}

	}

}

/* End of file main.php */
/* Location:  /application/controllers/admin/main.php */