<div class="m_intro_top">
	<p>우리둘만 <b>아찔하게 비밀톡챗<span>!!</span></b></p>
	<p>채팅방을 나가면 <b class="color_fff">24시간뒤 흔적이 사라지는</b> 아찔한 대화~</p>
	<?if(IS_LOGIN == true){?>
		<input type="button" value="채팅시작하기" class="m_intro_top_btn" onclick="javascript:location.href='/m/online_mb';">
	<?}else{?>	
		<a href="/auth/register"> 
		<input type="button" value="채팅시작하기" class="m_intro_top_btn" onclick="javascript:alert('로그인 후 사용이 가능합니다.')"></a>
	<?}?>
</div>
<input type="button" value="팝업" onclick="popup();">
<Script>
	function popup(){
		$.get('/etc/popups/chat_lay_pop_01/'+Math.random(), function(data){
			modal.open({content: data,width : 320, top:0});
		});
	}
</script>
<div class="m_main_area">
	<img src="<?=IMG_DIR?>/m/this_week_top.gif" class="width_100per">

	<div class="bg_fefefe">
		<table class="width_95per margin_auto m_intro_table">
			
			<?
				if(!empty($this_week_rank)){
					foreach($this_week_rank as $data){
			?>
			<!-- <tr>
				<td class="width_15per week_td"><?=$this->member_lib->member_thumb($data['m_userid'], 200, 200)?></td>
				<td class="m_intro_text_td">
					 <div class="float_left width_77per">
						<b class="color_333"><?=$data['m_nick']?></b><b class="color_888">(<?=$data['m_age']?>) <?=$data['m_conregion']?><?//=$data['last_login_day']?> <?=$data['m_conregion2']?></b><br>
						<div class="color_888 float_left height_0">
							<img src="<?=IMG_DIR?>/m/add_menu_gold.gif" class="main_ic">
						</div>
						<p class="margin_left_28 margin_top_7"><?=strcut_utf8($data['my_intro'],78)?></p>
					 </div>
					<div class="float_right">
						<p class="color_ccc"><?=str_replace('PM', '오후', str_replace('AM', '오전', time_stamp_am_pm($data['last_login_day'])))?></p>
					</div>
					<div class="clear"></div>
				</td>
			</tr> -->
			<tr>
				<td class="width_15per week_td"><?=$this->member_lib->member_thumb($data['m_userid'], 200, 200)?></td>
				<td class="m_intro_text_td">
					 <div class="float_left width_77per">
						<b class="color_333"><?=$data['m_nick']?></b><b class="color_888">(<?=$data['m_age']?>) <?=$data['m_conregion']?><?//=$data['last_login_day']?> <?=$data['m_conregion2']?></b>
						<div style="width:100%" class="margin_top_7">
							<div class="level_img"><img src="<?=IMG_DIR?>/m/add_menu_gold.gif" style="width:100%;"></div>
							<p style="display:inline-block;width:90%;"><?=strcut_utf8($data['my_intro'],78)?></p>
						</div>
					 </div>
					<div class="float_right">
						<p class="color_ccc"><?=str_replace('PM', '오후', str_replace('AM', '오전', time_stamp_am_pm($data['last_login_day'])))?></p>
					</div>
					<div class="clear"></div>
				</td>
			</tr>
			<?
					}
				}else{
			?> 
			<? 
				}
			?>
		</table>
	</div>

	<div onclick="javascript:send_kakao('1');">
	<img src="<?=IMG_DIR?>/m/m_banner_for_kakao.gif" class="width_100per margin_top_20" id="kakao-link-btn1">
	</div>


	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;현재 접속자&nbsp;</p></div>
		<div class="clear"></div>
	</div>


	<div class="bg_fefefe">
		<table class="width_95per margin_auto m_intro_table">
			<?
			// 5명으로 줄이라하셔서 페이징주석달아 놓음
			/*
				if($getTotalData > 0){
					foreach($mlist as $data){*/
			if (count($m_result) > 0){
				foreach($m_result as $key => $val){
			?>
			<tr>
				<td class="width_15per now_member"><?=$this->member_lib->member_thumb($val['m_userid'], 200, 200)?></td>
				<td class="m_intro_text_td">
					<div class="float_left width_70per margin_top_3">
						<b class="color_333"><?=$val['m_nick']?></b><b class="color_888">(<?=$val['m_age']?>) <?=$val['m_conregion']?> <?=$val['m_conregion2']?></b>
						<p class="width_100per text_cut"><?=want_reason_data($val['m_reason'])?>/<?=talk_style_data($val['m_character'], $val['m_sex'])?></p>
					</div>
					<div class="float_left width_30per text-right">
					<?if(IS_LOGIN == true){?>
					<input type="button" value="비밀톡챗신청" class="secret_btn" onclick="javascript:chat_request('joyhunting');">
					<?}else{?>	
					<a href="/auth/register/">
					<input type="button" value="비밀톡챗신청" class="secret_btn" onclick="javascript:alert('로그인 후 사용이 가능합니다.');"></a>
					<?}?>
					</div>
					<div class="clear"></div>
				</td>
			</tr>
			<?
				}
					}else{
			?>
			<!-- 현재 접속자가 없을경우 -->
			<?
				}
			?>
		</table>
	</div><!-- 
	<div onclick="javascript:send_kakao('2');">
	<img src="<?=IMG_DIR?>/m/m_banner_for_kakao.gif" class="width_100per" id="kakao-link-btn2">
	</div> -->


	<table class="m_noti_area">
		<tr>
			<td class="width_15per"><div class="m_noti_title">공지</div></td>
			<td class="width_75per text_cut">
				<a href="/service_center/notice/noti_list"><span><?=$noti['n_title']?></span></a>
			</td>
		</tr>
	</table>
