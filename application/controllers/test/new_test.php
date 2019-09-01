<?php

/**
 * Created by PhpStorm.
 * User: lee
 * Date: 2017-01-16
 * Time: 오후 4:47
 */
class new_test extends CI_Controller
{
    public function  __construct()
    {
           parent::__construct();
    }

    public function index(){

        $url = $this->uri->segment(0);

    }
}