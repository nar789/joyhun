<div>
	<div class="minutest5_bg">
		<div class="float_right margin_right_19 margin_top_11">
			<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
		</div>
		<div class="clear"></div>
		<div class="width_380  margin_auto">
			<div class="margin_top_83">
				<div class="minutest5_cont_box">
					<div class="margin_top_10 text-center">
						<a href="#"><img src="<?=IMG_DIR?>/layer_popup/minutes5_ic.gif"></a>
						<div class="blocks">
							<span>최근 <b><?=$this->session->userdata('m_conregion');?> <?=$this->session->userdata('m_conregion2');?></b> 에서 접속한 이성<!-- 은 <b>1,751명</b>  -->입니다.</span>
						</div>
					</div>
					<div class="width_340 margin_auto">
						<div class=" minutest5_imgbox pointer" onclick="javascript:member_photo_view_pop('<?=$rand_mb['m_userid']?>');">
							<?=$this->member_lib->member_thumb($rand_mb['m_userid'],108,136)?>
						</div>
						<div class="minutest5_textbox">
							<div class="minutest5_text"><? if($rand_mb['my_intro'] ==''){ echo my_intro_data($rand_num); }else{ echo $rand_mb['my_intro']; }?></div>
						</div>
						<div class="clear"></div>
						<div>
							<div class="minutest5_textbox_second">
								<b><?=$rand_mb['m_nick']?></b>
								<p><?=$rand_mb['m_age']?>세</p>
								<p><?=$this->session->userdata('m_conregion');?> <?=$this->session->userdata('m_conregion2');?></p>
							</div>
							<div class="block margin_top_10 margin_left_5">
								<a href="#"><img src="<?=IMG_DIR?>/layer_popup/minutes5_btn.gif" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="minutest5_text_text">
					<b><?=$this->session->userdata('m_conregion');?> <?=$this->session->userdata('m_conregion2');?></b>에 계시죠? 다른지역의 이상형도 찾아보세요!</div>
				<div class="float_right margin_right_12 margin_top_14">
					<a href="#"><img src="<?=IMG_DIR?>/layer_popup/minutes5_bot.gif" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';"></a>
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