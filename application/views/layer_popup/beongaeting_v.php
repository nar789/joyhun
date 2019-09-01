<div>
	<div class="beongaeting_bg">
		<div class="float_right margin_right_19 margin_top_11">
			<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
		</div>
		<div class="clear"></div>
		<div class="height_28"></div>
		<div class="beongaeting_box">
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb1['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					<a/>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb2['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb3['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb4['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb5['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb6['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class=" beongaeting_border"></div>
			<div class="clear"></div>
			<div class="beongaeting_text_box">
				<span class="width_256 block text_cut"><?=$rand_mb7['b_intro']?></span> 
				<div class="float_right margin_top_7">
					<a href="#">
						<div class="beongaeting_btn" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
							<b>번개팅 신청하기</b>
						</div>
					</a>
				</div>
			</div>
			<div class=" beongaeting_border"></div>
			<div class="text-center margin_top_10">
			<div class="clear"></div>
				<a href="#"><img src="<?=IMG_DIR?>/layer_popup/message_btn01.gif" class="margin_right_5" onclick="location.href='/meeting/beongae/today'"></a>
				<a href="#"><img src="<?=IMG_DIR?>/layer_popup/message_btn02.gif" onclick="location.href='/meeting/beongae/all'"></a>
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