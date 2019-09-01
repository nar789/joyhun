


<div>
	<div class="munjating_bg">
		<div class="float_right margin_right_11 margin_top_11">
			<a href="#"><img src="<?=IMG_DIR?>/layer_popup/close.png" border="0" onclick="modal.close();"></a>
		</div>
		<div class="clear"></div>
		<div class="width_390 height_41 margin_auto">
			<div class="margin_top_5">
				<img src="<?=IMG_DIR?>/layer_popup/munjating_benner.gif" class="pointer" onclick="javascript:location.href='/meeting/smsting/all';">
			</div>
		</div>
		<div class="munjating_bg_second">
			<div class="munjating_content">
				<div class="munjating_imgbox">
					<div class="width_100 margin_auto">
						<a href="#" onclick="javascript:member_photo_view_pop('<?=$rand_mb['m_userid']?>');"><?=$this->member_lib->member_thumb($rand_mb['m_userid'],115,140)?></a>
					</div>
				</div>
				<div class="munjating_right">
					<div class="munjating_text">
						<div class="text_cut"><?=$rand_mb['m_nick']?>(<?=$rand_mb['m_age']?>세)</div>
						<div class="text_cut"><?=$rand_mb['m_conregion']?>/<?=$rand_mb['m_conregion2']?></div>
					</div>
					<div class="clear"></div>
					<div class="margin_right_10">
						<div class="munjating_textarea">
							<div class="munjating_textarea_scroll">
								<textarea readonly><? if($rand_mb['my_intro'] ==''){ echo my_intro_data($rand_num); }else{ echo $rand_mb['my_intro']; }?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="margin_left_10">
					<b class="font-size_14 margin_left_10">보내는 내용</b>
					<div class="margin_right_10">
						<div class="munjating_textarea">
							<div class="munjating_02_textarea_scroll">
								<textarea placeholder="여기에 보낼 메시지를 입력하세요." onKeyUp="chkMsgLength(1000,sms_text,currentMsgLen);"></textarea>
							</div>
						</div>
					</div>
					<!-- <div class="text-center margin_top_10" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';"> -->
					<div class="text-center margin_top_10" onclick="location.href='/meeting/smsting/all';">
						<a href="#"><img src="<?=IMG_DIR?>/layer_popup/munjating_btn.png"></a>
					</div>
				</div>
			</div>
		</div>
		
	
	</div>
</div>


<?if(@$add_css){foreach($add_css as $css_name){?>
	<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
<?}}?>


<?if(@$add_js){foreach($add_js as $js_name){?>
	<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
<?}}?>