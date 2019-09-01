<?
class Test_1 extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('right_menu_lib');
		$this->load->library('top_menu_lib');
		$this->load->library('member_lib');
		$this->load->library('sms_lib');
		$this->load->helper('code_change_helper');
		$this->load->helper('point_helper');
		$this->load->helper('partner_helper');
		$this->load->helper('alrim_helper');
	}

	function index(){
		$this->load->view('test/test_1_v');
	}

	function aaa(){
		$this->load->view('test/test_2_v');
	}

}

?>
