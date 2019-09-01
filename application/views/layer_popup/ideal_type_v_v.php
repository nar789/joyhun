<div>
	<div class="ideal_type_v_bg">
		<div class="float_right margin_right_19 margin_top_11">
			<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
		</div>
		<div class="padding_left_19 padding_top_140">
			<!-- 
			<div class="ideal_type_text_box" style="display:table;">
				<span>내 접속지역</span> : <span><?=$this->session->userdata('m_conregion');?> <?=$this->session->userdata('m_conregion2');?></span>
			</div> -->
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb1['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="view_profile('<?=$rand_mb1['m_userid']?>');">
						<?=$this->member_lib->member_thumb($rand_mb1['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="chat_request('<?=$rand_mb1['m_userid']?>');">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb2['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="view_profile('<?=$rand_mb2['m_userid']?>');">
						<?=$this->member_lib->member_thumb($rand_mb2['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="chat_request('<?=$rand_mb2['m_userid']?>');">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb3['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="view_profile('<?=$rand_mb3['m_userid']?>');">
						<?=$this->member_lib->member_thumb($rand_mb3['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="chat_request('<?=$rand_mb3['m_userid']?>');">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb4['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="view_profile('<?=$rand_mb4['m_userid']?>');">
						<?=$this->member_lib->member_thumb($rand_mb4['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="chat_request('<?=$rand_mb4['m_userid']?>');">		
				</div>
			</div>
			<div class="text-center margin_left_mi_20 margin_top_10">
				<span>가장 최근에 접속한 추천이성을 지금 만나보세요!!</span>
			</div>
			<div class="text-center margin_left_mi_20 margin_top_10">
				<a href="#">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn02_v.gif"  onclick="location.href='/chatting/find_chatting/find_chatting';">
				</a>
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