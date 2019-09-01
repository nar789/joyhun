<div class="content">

	<div class="left_main">
		
		<p class="font-size_18 color_333 blod">메세지</p>

		<?=$call_tabmenu?>

		<div class="margin_top_23">
			<input type="button" class="text_btn_dcdcdc width_70 height_20 color_333 blod" value="전체선택" onclick="javascript:message_all_chk('1');">&nbsp;
			<input type="button" class="text_btn_dcdcdc width_70 height_20 color_333 blod" value="선택해제" onclick="javascript:message_all_chk('2');">&nbsp;
			<!--span class="color_999">선택한 메세지를</span-->
			<input type="button" class="text_btn_dcdcdc width_50 height_20 color_333 blod" value="삭제" onclick="javascript:select_message_del('<?=$mode?>');">
		</div>

		<ul class="profile_table margin_top_5">
			<li class="text-center width_70 padding_left_37">사진</li>
			<li class="width_148 text-center">닉네임(나이)</li>
			<li class="width_130 text-center"><? if($mode == "SEND"){ echo "받은회원(나이)"; }else{ echo "접속지역"; }?></li>
			<li class="text-center width_320">메세지</li>
		</ul>

		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
		<div class="min_height_72 border_bottom_1_ececec">
			<div class="float_left">
				<div class="block margin_left_6 margin_top_26 ver_top">
					<input type="checkbox" id="chk_<?=$data['V_IDX']?>" name="chk_message" class="common_checkbox" value="<?=$data['V_IDX']?>"><label for="chk_<?=$data['V_IDX']?>" class="common_checkbox_label"></label>
				</div>
				<div class="profile_chat width_82 pointer">
					<a onclick="<?user_check("view_profile('$data[m_userid]');");?>">
						<?=$this->member_lib->member_thumb($data['V_SEND_ID'], 68, 49)?>
					</a>
				</div>
				<div class="width_136 block margin_top_30 color_333 margin_left_6 ver_top padding_left_13">
					<?=$this->member_lib->s_symbol($data['m_sex'])?> <?=$data['m_nick']?> (<?=$data['m_age']?>세)
				</div>
				<div class="width_110 block margin_top_30 color_333 ver_top padding_left_13">
					<? 
						if($mode == "SEND"){ 
							$recv_data = $this->member_lib->get_member($data['V_RECV_ID']);
							if(@$recv_data['m_sex']){
							echo $this->member_lib->s_symbol(@$recv_data['m_sex']);
							echo @$recv_data['m_nick']."(".@$recv_data['m_age']."세)";
							}
						}else{
							echo $data['m_conregion']." ".$data['m_conregion2'];
						}
					?>
					
				</div>
				<div class="width_290 block margin_top_10 color_333 padding_left_10 padding_bottom_20 break_all msg_box" <? if($data['V_SEND_ID'] != $user_id){ ?> onclick="javascript:send_message('<?=$data['V_SEND_ID']?>', 'resend', '<?=$data['V_IDX']?>');" style="cursor:pointer;" <? } ?> >
					<script type="text/javascript"> 
						//메세지 리스트페이지에서 메세지 내용 미리보기
						//글자열길이 100바이트 기준
						var v_idx = "<?=$data['V_IDX']?>";
						call_message_limit(v_idx);
					</script>
				</div>
				
			</div>
		</div>
		<? 
				}
			}else{
		?>
		<div class="list_area border_bottom_2_ececec">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div class="margin_top_5">
					메세지가 없습니다.<br>
					호감가는 이성에게 메세지를 보내보세요.
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>


		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>

	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->