<div class="m_contents">
	<img src="<?=IMG_DIR?>/service_center/vacance_bg.gif" id="vacance_img" useMap="#Map" style="width:100%;">
	<div class="result"></div>
</div>

<div class="posi_rel solo_content_bg">

	<div class="bg_fff width_100per">
		<div class="padding_top_3per padding_bottom_3per width_100per ">
			<div class="solo_title_left">&nbsp;</div>
			<div class="float_left"><b>&nbsp; 참여자&nbsp;</b></div>
			<div class="float_right width_78per">
				<div></div>
			</div>
			<div class="clear"></div>
		</div>

		<div id="div_tbl_on" class="bg_fefefe">
			<table class="width_95per margin_auto m_intro_table">
				<?
					if($getTotalData > 0){
						foreach($mlist as $data){

							if($data['m_sex'] == "M"){ $m_color = "color_02bae2"; }
							if($data['m_sex'] == "F"){ $m_color = "color_ea3c3c"; }
				?>
				<tr>
					<td class="width_17per now_member pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');"><?=$this->member_lib->member_thumb($data['m_userid'], 200, 200)?></td>
					<td class="m_intro_text_td padding_top_3per padding_bottom_3per">
						
						<div class="float_left width_70per">
							<b class=" color_333 margin_left_3per level_m_online_img <?=$m_color?> pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
								<?=$data['m_nick']?>
							</b>
							<b class="color_888 pointer" onclick="javascript:chat_request('<?=$data['m_userid']?>');">(<?=$data['m_age']?>) <?=$data['m_conregion']?> <?=$data['m_conregion2']?></b>
							<p class="margin_top_3 margin_left_3per">
								<?=vacance_event_code($data['gubn'])?>	
							</p>
						</div>
						<div class="float_left width_30per text-right">
							<input type="button" value="비밀채팅신청" class="secret_btn blcok" onclick="javascript:chat_request('<?=$data['m_userid']?>');">
						</div>
						<div class="clear"></div>
					</td>
				</tr>
				<?
						}
					}else{
				?>
				<!-- 등록된 글이 없을 경우 -->
				<?
					}
				?>
			
			</table>
		</div>		
	</div>

	<!-- 더보기 리스트 부분 -->
	<div class="bg_fefefe">
		<table id="tbl" class="width_95per margin_auto m_intro_table">
		</table>
	</div>
	<!-- 더보기 리스트 부분 -->

	<div id="more_btn" class="borad_add">
		<div id="more" page="<?=$page+1?>" rp="<?=$rp?>" gubn="vacance" class="board_more text-center">
		more &nbsp;<div></div>
		</div>
	</div>

</div>

<map id="Map" name="Map">
<area coords="237, 1021, 521, 1089" id="v_btn_01" name="v_btn_01" onfocus="blur();" onclick="javascript:<?user_check("sel_card_clk();");?>">
</map>

<map id="result_map" name="result_map">
<area coords="124,755,400,827" id="v_btn_02" name="v_btn_02" onfocus="blur();" onclick="javascript:location.href='/m/online_mb';">
</map>

<script type="text/javascript">
	$(document).ready(function(){
		imageMap("vacance_img","760","237","1021","521","1089","v_btn_01");
	});
</script>