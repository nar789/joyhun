<?php

class Total_woman_pic extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		admin_check();

		$this->load->library('member_lib');
	}

	function pic_list(){		//슈퍼채팅 리스트

		
		$bot_data['add_script'] = "<script>page_mode='TotalMembers';get_pic_data('1');</script>";
		
		$data['page_mode'] = "TotalMembers";

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/total_woman_pic_v',@$data);
		$this->load->view('admin/admin_bottom_v',$bot_data);

	}


	function pic_list_dormancy(){		//슈퍼채팅 리스트

		
		$bot_data['add_script'] = "<script>page_mode='TotalMembers_old';get_pic_data('1');</script>";

		$data['page_mode'] = "TotalMembers_old";

		$this->load->view('admin/admin_top_v');
		$this->load->view('admin/member/total_woman_pic_v',@$data);
		$this->load->view('admin/admin_bottom_v',$bot_data);

	}

	function get_data(){
			$page = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page')));
			$page_mode = rawurldecode($this->security->xss_clean(@url_explode($this->seg_exp, 'page_mode')));
			if(empty($page)){$page = 1;}
			
			$limit = 500;
			$start = ($page) * $limit - $limit;

			if($page_mode == "TotalMembers"){
				$db_name = "TotalMembers";
			}else if($page_mode == "TotalMembers_old"){
				$db_name = "TotalMembers_old";
			}

			$m_result = $this->my_m->get_list_solo($start,$limit, array("m_sex" => "F","ex_m_filename" => "m_filename is not null"), $db_name, "m_num", "desc");

			foreach($m_result[0] as $member){		

				$last_login_day = explode(" ",$member['last_login_day']);
				$m_in_date = explode(" ",$member['m_in_date']);

				$m_pic = $this->member_lib->member_thumb($member['m_userid'],200,200,$db_name);


				if(strpos($m_pic, "/images/meeting/girl_ic.png") == false and strpos($m_pic, "no_image_f.gif") == false) {  

					echo '
					<div class="col-md-2 col-sm-4 mix development mix_all" style="display: block; opacity: 1;">

						<div class="item-box">
							<figure>
								<a href="/profile/main/user/user_id/'.$member['m_userid'].'" target="_blank">'.$m_pic.'</a>
							</figure>

							<div class="item-box-desc">
								<div>
									<a href="/admin/main/member_view/userid/'.$member['m_userid'].'/gubn/new" target="_blank">'.$member['m_userid'].'</a><br>
									'.$member['m_nick'].' ('.$member['m_age'].'세)<br>
									가입일 '.$m_in_date[0].'<br>마지막접속 '.$last_login_day[0].'
								</div>
							</div>

						</div>

					</div>
					';
				}


			}

	}

}