<div class="content">

	<div class="left_main">
	
		<div class="make_anne_top">
			<div class="make_anne_area">
				<form method="post" action="">
					<div class="make_anne_box">
						<div class="top_textarea_img" id="noimg_check">
						<? if (IS_LOGIN){	//로그인 했으면 프로필사진 ?>
							<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71)?>
						<? } else { //로그인안했으면 user_check ?>
							<a href="#" onclick="<?=user_check("javascript:form_check();")?>"><span>대표사진 등록</span></a>
						<? } ?>
						</div>
						<textarea id="m_dbcontent" name="m_dbcontent" class="top_textarea" placeholder="앤들에게 소식을 전하세요~" maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
						<!--<div class="text_btn_da284b top_textarea_subbtn" onclick="<php user_check("form_check();"); php>">//-->
						<div class="text_btn_da284b top_textarea_subbtn" onclick="return false;">
							<div class="margin_top_30 font-size_14">등록하기</div>
						</div>					
					</div>
				</form>
			</div>
		</div>


		<div class="tab_content_top_area">
			<div class="float_right">
				<ul>
					<li class="submenu_gender_<?=$sex_class1?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>',' ');"><a>전체</a></li>
					<li class="submenu_gender_<?=$sex_class2?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','F');"><a>여자</a></li>
					<li class="submenu_gender_<?=$sex_class3?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','M');"><a>남자</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>


		<!-- 앤만들기 List -->
		<?php if ($getTotalData > 0) : ?>
		<?php foreach ( $mlist as $data) :?>
		<div class="list_area min_height_72">
			<div class="anne_thumb" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
				<a href="#"><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></a>
			</div>		<!-- ## light_list_img end ## -->

			<div class="onetr_list_first width_98 text_cut">
				<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?>
				<span class="color_333 blod"><?=$data['m_nick']?></span>
			</div>

			<div class="color_666 anne_content break_all">
				<?=$data['m_dbcontent']?>
			</div>

			<div class="onetr_list_btn margin_left_0">
				<div class="text_btn_fe727b width_56 onetr_chat_btn color_fff pointer margin_left_12 pointer" onclick="<?user_check("anne_request('$data[m_userid]');");?>">
					앤되기&nbsp;
					<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
			</div>
		</div><!-- ## list_area end ## -->
		<?php endforeach; ?>
		<?php else : ?>
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						앤만들기 리스트가 없습니다.<Br>
						앤만들기를 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>			
		<?php endif; ?>




		<div class="list_footer padding_0 height_0">
		</div>
		

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<ul class="pagination">
					<?= @$pagination_links?>
				</ul>
			</div>
		</div>



	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>