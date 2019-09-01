<div class="woman_pop_con woman_pop_bg_<?=$mode?>" style="width:430px;">
	
	<div class="btn_close_box">
		<img src="<?=IMG_DIR?>/woman_pop_close.png" onclick="javascript:modal.close();">
	</div>

	<div class="sub_con">
		<div class="con_box">
			<?
				$i=0;
				$margin_class = "";
				foreach($mlist as $data){
					if($i > 0){ $margin_class = "margin_left_1";  }
			?>
			<div class="member_box <?=$margin_class?>">
				<div class="margin_top_7"><?=$this->member_lib->member_thumb($data['m_userid'], 108, 108)?></div>
				<div>
					<?=$data['m_nick']?><br>
					<?=$data['m_age']?>세<br>
					<?=$data['m_conregion']?> / <?=$data['m_conregion2']?>
				</div>
				<?
					//버튼 bg_color 팝업별
					//bg_42b2bd, bg_e35831, bg_c7404f
				?>
				<div class="<?=$btn_bg_class?>" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
					대화신청
				</div>
			</div>
			<?
				$i++;
				}
			?>
		</div>
	</div>
	
	<div class="bottom_tit_box">
		<?
			//글자 font_color 팝업별
			//color_fcafd3, color_e35831, color_c7404f
		?>
		<b class="<?=$color_class_1?>">회원님에게 어울리는 이성</b> <b class="<?=$color_class_2?>"><?=$rand_num?>명</b> <b class="<?=$color_class_1?>">대기중!!</b>
		<img src="<?=IMG_DIR?>/woman_pop_add_<?=$mode?>.png" id="btn_add_member">
	</div>

</div>


<?if(@$add_css){foreach($add_css as $css_name){?>
	<link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />
<?}}?>


<?if(@$add_js){foreach($add_js as $js_name){?>
	<script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>
<?}}?>