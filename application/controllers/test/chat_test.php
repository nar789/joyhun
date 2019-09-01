<?
class Chat_test extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('chat_lib');
	}


	function chat_send(){

		$this->chat_lib->set_send_id("goodlove4022");
		$this->chat_lib->set_recv_id("wwkorea1030");
		$this->chat_lib->chatting_save("네 안녕하세요");

	}

	function chat_request(){

		$this->chat_lib->set_recv_id("goodlove4022");
		$this->chat_lib->chat_request_submit("채팅신청 보냅니다.");

	}

	
}


	

?>
