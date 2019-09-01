<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//사이트 전체 클래스 확장을 위한 상속용 클래스 입니다.
class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->driver('cache',array('adapter' => 'file'));

		$this->pre_paging();
	}

	//모바일 모드 지원 메소드
	function _remap($method)
    {
		if(@$this->session->userdata['m_userid'] == "wwkorea1040"){
			//$this->output->enable_profiler(TRUE); //벤치마크 프로파일링 주석처리하면 숨겨짐
		}

		if(IS_MOBILE == true){ //모바일 모드일때
			if ( method_exists($this,$method.'_mobile')){ //메소드 뒤에 _mobile 우선 검색
				$this->{"{$method}_mobile"}();
			}else if ( method_exists($this,$method)){ //없으면 동일이름 메소드 검색. 그안에서 IS_MOBILE 변수로 다른 VIEW 불러오기 가능.
				$this->{$method}();
			}else{
				goto("/");
			}
		}else{

			$this->{$method}();

			
		}

	}

	//페이징 간소화
	//불필요한 페이징 기능 단축
	function pre_paging(){

		$this->seg_exp = $uri_array = segment_explode($this->uri->uri_string());

		if( in_array('page', $uri_array) )
		{
			$page = rawurldecode($this->security->xss_clean(url_explode($uri_array, 'page')));
		}
		else{ $page = 1;	}
		if(!is_numeric($page)){$page = 1;	}

		return $page;

	}



}
