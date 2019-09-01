<div>
	<div class="ideal_type_bg">
		<div class="float_right margin_right_19 margin_top_11">
			<img src="<?=IMG_DIR?>/layer_popup/close.png" class="pointer" onclick="modal.close();">
		</div>
		<div class="padding_left_19 padding_top_128">
			<div class="ideal_type_text_box" style="display:table;">
				<span>내 접속지역</span> : <span><?=$this->session->userdata('m_conregion');?> <?=$this->session->userdata('m_conregion2');?></span>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb1['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
						<?=$this->member_lib->member_thumb($rand_mb1['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb2['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
						<?=$this->member_lib->member_thumb($rand_mb2['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb3['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
						<?=$this->member_lib->member_thumb($rand_mb3['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">		
				</div>
			</div>
			<div class="width_96 block">
				<div class="ideal_type_imgbox">
					<div class="height_24 text-center line-height_24">
						<p><?=$rand_mb4['m_nick']?></p>
					</div>
					<div class="ideal_type_imgbd" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
						<?=$this->member_lib->member_thumb($rand_mb4['m_userid'],83,88)?>
					</div>
				</div>
				<div class="ideal_type_btnbox ">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn01.png" class="pointer" onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">		
				</div>
			</div>
			<div class="text-center margin_left_mi_20 ">
				<span>회원님의 이성조건에 맞는 이성들
				<!-- <b>253명</b>  -->
				접속 중!!</span>
			</div>
			<div class="text-center margin_left_mi_20 margin_top_10">
				<a href="#">
					<img src="<?=IMG_DIR?>/layer_popup/ideal_type_btn02.png"  onclick="alert('정회원 가입후 이용해주세요.');location.href='/profile/point/point_charge';">
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