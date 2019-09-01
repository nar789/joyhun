

<script>

//<![CDATA[
	function aa(cnt) {
		$('#fileinput_'+cnt).click();
	}
 //]]>

</script>


<style>
	
	input[type="file"] { display:none; }

</style>
						
	<div class="padding_top_10">
		<table class="m_profile_pic_table">
			<tr>
				<td class="width_33per ver_top text-center">
					<?=$user_pic1?>
				</td>
				<td class="width_33per ver_top text-center">
					<?=$user_pic2?>
				</td>
				<td class="width_33per ver_top text-center">
					<?=$user_pic3?>
				</td>
			</tr>
		</table>
	</div>

	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;인사말&nbsp;</p></div>
		<div class="clear"></div>
	</div>

	<div class="height_100 bg_fefefe text-center">
		<textarea class="m_profile_textarea" id="my_intro" name="my_intro"><?=$member_data['my_intro']?></textarea>
	</div>


	<div class="width_100per margin_top_7 margin_bottom_16">
		<div class="now_online_li">&nbsp;</div>
		<div class="now_online_hr"><p class="now_online_title">&nbsp;기본프로필&nbsp;</p></div>
		<div class="clear"></div>
	</div>

	<div class="m_profile_table_area">
		<table class="mobile_border_table">
			<tr>
				<td>원하는 만남</td>
				<td>
					<div class="width_95per margin_auto mobile_select">
						<select id="m_reason" name="m_reason" class="border_none height_28 width_95per border_0 text_5 color_666">
							<option value="">- 선택 _</option>
							<? for($i=1; $i<16; $i++){ ?>
							<option value="<?=$i?>" <? if($member_data['m_reason'] == $i){ echo "selected"; } ?>><?=want_reason_data($i)?></option>
							<? } ?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>대화스타일</td>
				<td>
					<div class="width_95per margin_auto mobile_select">
						<select id="m_character" name="m_character" class="border_none height_28 width_95per border_0 text_5 color_666">
							<option value="">- 선택 _</option>
							<?
								if($member_data['m_sex'] == "M"){ $min_i = 1; $max_i = 20; }
								if($member_data['m_sex'] == "F"){ $min_i = 101; $max_i = 118; }

								for($i=$min_i; $i<$max_i; $i++){
							?>
							<option value="<?=$i?>" <? if($member_data['m_character'] == $i){ echo "selected"; } ?>><?=talk_style_data($i, $member_data['m_sex'])?></option>
							<? } ?>
						</select>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<? if($this->session->userdata['m_userid'] == $recv_id){ ?>
	<div class="text-center padding_bottom_20 padding_top_20">
		<input type="button" class="m_d53b3b_btn height_40 width_30per border-radius_2" value="수정하기" onclick="javascript:m_profile_modi();">
	</div>
	<? } ?>

	<? if($member_data['m_mobile_chk'] == "1"){ ?>

	<div class="width_90per margin_bottom_5per margin_left_5per">
		<div class="add_bottom_btn_box pointer" onclick="javascript:location.href='#'">
			<img src="<?=IMG_DIR?>/m/m_bottom_btn_second.png" class="width_100per">
			<div class="posi_rel add_bottom_textbox">
				<div class="add_bottom_textbox_second">
					<b class="color_fff"><?=$member_data['m_hp1']?>-<?=$member_data['m_hp2']?>-<?=$member_data['m_hp3']?></b>
				</div>
			</div>
		</div>
	</div> 
	
	<? }else{ ?>
	<img src="<?=IMG_DIR?>/m/m_bottom_btn.png" class="margin_left_4per width_92per margin_bottom_3per margin_top_3per pointer" onclick="javascript:name_check();"> 
	<!--img src="<?=IMG_DIR?>/m/m_bottom_btn.png" class="margin_left_4per width_92per margin_bottom_3per margin_top_3per pointer" onclick="javascript:reg_phone_chk('2', '<?=$this->session->userdata('m_userid')?>');"--> 
	<? } ?>