<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class testpage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

	}
	
	/**
     * 사이트 헤더, 푸터를 자동으로 추가해준다.
     *
     */
 

	function index()
	{
		//				$this->load->library('tank_auth');

		require "./application/libraries/phpass-0.1/PasswordHash.php";


//		$this->load->library('phpass-0.1/passwordhash');
		$hasher = new PasswordHash(8, FALSE);
		$hashed_password = $hasher->HashPassword("qlqjs");

		echo $hashed_password;
	}
	

	
}