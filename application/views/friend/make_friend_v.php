<div class="content">

	<div class="left_main">
	
		<div class="make_friend_bg">
			<div class="make_friend_title">
				<div class="make_friend_left_box">
					<b class="color_fff font-size_14">친구등록</b>
					<p class="font-size_11">관심있는 이성을 친구로 등록해서 친하게 지내보세요~!</p>
				</div>
				<div class="make_friend_right_box">
					<b class="color_fff font-size_14">추천 이성친구</b>
					<p class="font-size_11">지역,관심사에 의한 추천</p><!-- 원하는만남 -->
				</div>
			</div>
			<div class="friend_add">
				<input type="text" class="friend_add_text friend_id" name="friend_add_id" placeholder="닉네임"/>
				<div class="select_box_border">
					<select class="friend_select" name="friend_add_group">
						<option value="">그룹선택</option>
						<? foreach (call_friend_group($this->session->userdata['m_userid']) as $k => $v){ ?>
							<option value="<?=$v?>"><?=$v?></option>
						<? } ?>
					</select>
				</div>
				<input type="text" class="friend_add_text friend_memo" name="friend_add_memo" placeholder="한줄메모"/>
				<!--<input type="button" class="text_btn_c32a6f friend_add_btn" value="등록하기" onclick="javascript:top_frined_add();"/>-->
				<input type="button" class="text_btn_c32a6f friend_add_btn" value="등록하기" onclick="return false;"/>
			</div>
			<div class="mCustomScrollbar friend_scroll">
			<!-- <div class=" friend_scroll" style="height:500px;"> -->
				<?
					// 추천 이성친구
					foreach(push_friend('T_MakeFriend_PR',$user_info['m_sex'],array('TotalMembers.m_reason' => $user_info['m_reason'],'TotalMembers.m_conregion' => $user_info['m_conregion']),'m_writedate','10') as $key => $val)
					{

				?>
				<div class="friend_scroll_list">
					<span class="friend_scroll_id"><?=$val['m_nick']?></span><input type="button" value="친구등록" class="text_btn_dcdcdc friend_scroll_btn" onclick="<?user_check("friend_request('$val[m_userid]');");?>">
				</div>
				<? } ?>
			</div>
		</div>

		<div class="make_pr_bg">
			<div style="width:718px;height:42px;">
			<p class="make_pr_title">내 PR하기</p>
			<? if (IS_LOGIN): ?>
			<span class="color_666 margin_left_5"><span><?=$this->session->userdata('m_nick')?>님</span> 멋진 소개말로 더욱 많은 친구를 사겨보세요~!</span>
			<? else : ?>
			<span class="color_666 margin_left_5"><span>회원가입 후 멋진 소개말로 더욱 많은 친구를 사겨보세요~!</span>			
			<? endif ; ?>
			</div>

			<div>
				<div style="width:718px;height:82px">
					<form method="post" action="">
						<textarea id="m_content" name="m_content" class="make_pr_text" placeholder="소개말을 입력해주세요(200자 이내로 적어주세요)." maxlength="200" onkeyup="return textarea_maxlength(this)"></textarea>
						<!--<div class="make_pr_text_cnt"></div>-->
					<!--<input type="button" class="text_btn_c32a6f make_pr_btn" value="등록하기" onclick="<php user_check("form_check();",9);php>">//-->
					<input type="button" class="text_btn_c32a6f make_pr_btn" value="등록하기" onclick="return false;">
					</form>
				</div>
			</div>
		</div>

		<div id="tmp"></div>	<!-- 데이터 찍어보기 위한 용도 -->

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

		<!-- 친구만들기 List -->
		<?php 
			if ($getTotalData > 0) : ?>
		<?php foreach ( $mlist as $data) :?>

		<div class="min_height_78 list_area">
			<div class="list_img2 margin_left_16" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
				<a href="#"><?=$this->member_lib->member_thumb($data['m_userid'],68,49)?></a>
			</div>		<!-- ## light_list_img end ## -->

			<div class="onetr_list_first width_111 line-height_20 ver_top text_cut margin_o">
				<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?>
				<span class="color_333"><?=$data['m_nick']?></span>
				<p class="color_999"><?=$data['m_conregion2']?>(<?=$data['m_age']?>) </p>
			</div>

			<div class="make_friend_list line-height_16 margin_bottom_16<?php if (strlen($data['m_content']) > 50){ echo " pointer"; }?>" onClick="this.innerHTML = '<?=$data["m_content"];?>' " >
				<?php echo strcut_utf8($data['m_content'],50); ?>
			</div>

			<div class="onetr_list_btn margin_top_19 inline float_right">
				<div class="text_btn_fe727b onetr_chat_btn pointer" onclick="<?user_check("friend_request('$data[m_userid]');");?>">
					친구등록&nbsp;
					<img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa margin_left_1" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa" onclick="<?user_check("jjim_request('$data[m_userid]');");?>">
					<span class="img_heart_btn"></span>
				</div>
			</div>
		</div>		<!-- ## list_area end ## -->
		<?php endforeach; ?>
		<?php else : ?>
			<div class="list_area">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						내PR하기가 없습니다.<Br>
						내PR하기를 등록하고 새로운 인연을 만나보세요! 
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