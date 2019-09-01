<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once DOC_ROOT."/application/controllers/auth.php";

class M_auth extends Auth
{
	function _remap($method)
    {
		if(IS_MOBILE == true){
			if ( method_exists($this,$method.'_mobile')){
				$this->{"{$method}_mobile"}();
			}else if ( method_exists($this,$method)){
				$this->{$method}();
			}else{
				goto("/");
			}
		}else{
			$this->{$method}();
		}
	}

	function __construct()
	{
		parent::__construct();

		$this->load->library("Mobile_Detect");
	}

	function test_mobile(){
		//echo $this->mobile_detect->isMobile();

		echo 1;
	}

	function test(){
		//echo $this->mobile_detect->isMobile();

		echo 2;
	}

	function m_login()
	{
		echo 2;
		//$this->login();
		//var_dump($top_data);
	}

}