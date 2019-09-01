		<div class="mylog_box_add">
			<div class="sms_phone_bg">
				<div class="sms_phone_top">

					<? if(IS_LOGIN == false) { ?>
						<div style="width:123px;height:124px;border:1px solid #dcdcdc;margin-left:26px;">
							<p style="text-align:center;margin-top:46px;">로그인 후<br>이용가능합니다.</p>
						</div>
					<? }else{ ?>
						<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),123,124)?>
					<? } ?>
					<div class="sms_textarea">
						<div class="sms_textarea_scroll">
							<textarea placeholder="내용을 입력하세요." id="sms_text" onKeyUp="chkMsgLength(1000,sms_text,currentMsgLen);"></textarea>
						</div>
						<div class="meet_sms_byte"><span id="currentMsgLen">0</span>/1000byte</div>
					</div>
				</div>
				<div class="sms_phone_list_box">
				
					<div class="sms_phone_list_top">
						<div class="float_left sms_phone_list_text">
							<!-- 전송가능횟수 : 0 -->
							현재 포인트 : <?=total_point_sum($this->session->userdata('m_userid'))?>P
						</div>
						<div class="float_right">
							<input type="button" class="sms_phone_list_btn" value="충전" onclick="javascript:point_add();">
						</div>
						<div class="clear"></div>
					</div>

					<div class="sms_phone_list">
						<div class="sms_phone_search">
							<input type="text" class="sms_phone_search_text" id="sms_search_id"/>
							<input type="button" class="sms_phone_search_btn" value="검색" onclick="<?=user_check('sms_phone_search();')?>">
						</div>
						<div class="mCustomScrollbar height_80 color_fff" id="sms_id_list">
						</div>
					</div>
					
					<div class="sms_phone_bottom">
						<span>보내는 사람</span>
						<input type="text" class="sms_phone_bottom_text" value="<?=$this->session->userdata('m_nick')?>" readonly>
					</div>
				</div>
				<div class="sms_phone_subm_box">
					<input type="button" class="sms_phone_btn" value="설정" onclick="<?=user_check("location.href='/meeting/smsting/my_smsting_recv';")?>"/>
					<input type="submit" class="sms_phone_subm_btn" value="보내기" onclick="<?=user_check("sms_send_request(getCookie('sms_list'));")?>"/>
					<input type="button" class="sms_phone_btn margin_left_mi_2" value="해지" onclick="<?=user_check("sms_chk_delete('".$this->session->userdata('m_userid')."');")?>"/>
				</div>
			</div>
		</div>