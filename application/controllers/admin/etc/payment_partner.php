<?php
class Payment_partner extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('code_change');
		$this->load->library('member_lib');
		$this->load->model('admin/payment_stat_m');

		admin_check();

	}

	function index(){
		$this->payment_partner_view();
	}
	
	//결제 통계페이지
	function payment_partner_view(){
		
		//view 설정
		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/etc/payment_partner_v', @$data);
		$this->load->view('admin/admin_bottom_v');

	}

	

}

/* End of file main.php */
/* Location:  /application/controllers/admin/*/