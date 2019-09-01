
<div>
	<div class="special_bg">
		<div class="float_right margin_right_19 margin_top_11 height_24">
			<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
		</div>
		<div class="clear"></div>
		<div class="special_main_bg">
			<div class="special_main_box">
				<img src="<?=IMG_DIR?>/layer_popup/special_top.gif">
				<div class="height_140 margin_top_18">
					<div class="special_img_box" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
					<?=$this->member_lib->member_thumb($rand_mb['m_userid'],108,136)?>
					</div>
					<table>
						<tr>
							<td>
								<img src="<?=IMG_DIR?>/layer_popup/special_ic.gif"><b>닉네임</b>
							</td>
							<td><?=$rand_mb['m_nick']?></td>
						</tr>
						<tr>
							<td>
								<img src="<?=IMG_DIR?>/layer_popup/special_ic.gif"><b>지역</b>
							</td>
							<td><?=$rand_mb['m_conregion']?>/<?=$rand_mb['m_conregion2']?></td>
						</tr>
						<tr>
							<td>
								<img src="<?=IMG_DIR?>/layer_popup/special_ic.gif"><b>나이</b>
							</td>
							<td><?=$rand_mb['m_age']?>세</td>
						</tr>
						<tr>
							<td>
								<img src="<?=IMG_DIR?>/layer_popup/special_ic.gif"><b>원하는만남</b>
							</td>
							<td><div class="width_115 text_cut"><?=want_reason_data($rand_mb['m_reason'])?></div></td>
						</tr>
						<tr>
							<td>
								<img src="<?=IMG_DIR?>/layer_popup/special_ic.gif"><b>대화스타일</b>
							</td>
							<td><div class="width_115 text_cut"><?=talk_style_data($rand_mb['m_character'],$rand_mb['m_sex'])?></div></td>
						</tr>
					</table>
				</div>
				<div class="margin_top_10">
					<div class="special_text_bg">
						<div class="text-center" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b><?=$rand_mb['m_nick']?></b> 
							<b>님이 마음에 드신다면 채팅 신청해보세요.</b>
						</div>
					</div>
				</div>
			</div>
			<div class="margin_top_20 text-center">
				<a href="#"><img src="<?=IMG_DIR?>/layer_popup/special_btn.gif" onclick="<?user_check("chat_request('$rand_mb[m_userid]');");?>"></a>
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
