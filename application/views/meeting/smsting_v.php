<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_search?>

		<div class="meeting_msm_list">
			<ul>

		<?php

		$id_num = 1;
			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
		?>
				<li class="meeting_sms_list_box ver_top">
					<div class="meeting_sms_top">
						<input type="checkbox" id="meet_sms_list_<?=$id_num?>" name="meet_sms_list" class="chk_989898" value="<?=$data['m_nick']?>" onclick="sms_phone_chkbox('<?=$data['m_userid']?>','<?=$data['m_nick']?>','<?=$id_num?>');">
						<label for="meet_sms_list_<?=$id_num?>" class="meet_sms_list_title"><?=$data['m_conregion']?>/<?=$data['m_conregion2']?></label>
					</div>
					<div class="sms_ting_thum">
						<a href="#" onclick="<?user_check("view_profile('$data[m_userid]');");?>"><?=$this->member_lib->member_thumb($data['m_userid'],145,146)?></a>
					</div>
					<div class="meeting_sms_bottom">
						<p style="width:142px;" class="text_cut"><?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_nick']?> (<?=$data['m_age']?>세)</p>
						<p><?=strcut_utf8(job_text($data['msgting_m_job']),6)?> | <?=outstyle_text($data['msgting_m_outstyle'])?> | <?=character_text($data['msgting_m_character'])?></p>
						<p>수신시간 : <?php if($data['m_receive_time'] == 'Y'){?>항상가능
									  <?php }else{ $ex = explode("|",$data['m_receive_time']); echo $ex[0]; echo "시 ~ "; echo $ex[1]; echo "시"; } ?></p>
						<input type="button" class="text_btn_dcdcdc meeting_sms_list_btn" value="받는사람 추가하기" onclick="sms_phone_btn_add('<?=$data['m_nick']?>','<?=$data['m_userid']?>');">
					</div>
				</li>

				<style>
					.meeting_sms_bottom > p:first-child > img { vertical-align:top; margin-top:3px; }
				</style>
		<?php 

			$id_num++;
		
			} }else{ ?>

			<div class="list_area border_none">
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div class="margin_top_5">
						문자팅이 없습니다.<Br>
						문자팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->
			</div>

			<? } ?>
			</ul>
		</div>

		<div class="meet_border2_footer">
			<input type="button" class="text_btn_ea3e3e sms_alladd_btn margin_top_10" value="선택회원 한번에 추가" onclick="javascript:sms_chk();">
		</div>

		<div class="list_pg">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>



