<div class="clear"></div>
<div class="width_100per">
	<div class="gift_box_tab" id="recv_gift">
		<b>받은 선물함 (<?=count($recv_data)?>)</b>
	</div>
	<div class="gift_box_tab" id="send_gift">
		<b>보낸 선물함 (<?=count($send_data)?>)</b>
	</div>
</div>
<div class="clear"></div>
<div id="first_gift_box" style="height:400px; overflow-y:scroll;">
	<? 
		if(!empty($recv_data)){ 
			foreach($recv_data as $data){
	?>
	<div class="width_100per border_bottom_1_dcdcdc">
		<div class="padding_20">
			<div class="gift_box_txt"><b><?=$data['GIFT_NAME']?></b></div>
			<div class="gift_box_btn">
				<? if($data['V_SEND_YN'] == "N"){ ?>
				<img src="<?=IMG_DIR?>/layer_popup/gift_box_btn.gif" onclick="javascript:gift_take_it_layer('<?=$data['V_IDX']?>');">
				<? }else if($data['V_SEND_YN'] == "Y"){ ?>
				<b>발송완료</b>
				<? }else if($data['V_SEND_YN'] == "I"){ ?>
				<b>발송중</b>
				<? } ?>				
			</div>
			<div class="margin_top_10 block">
				<span><?=$data['SEND_NICK']?></span>&nbsp;&nbsp;
				<span><?=date("Y-m-d", strtotime($data['V_SEND_DATE']))?></span>&nbsp;&nbsp;
				<span><?=$data['USE_DATE']?>일 남음</span>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?
			}
		}else{
	?>
	<div class="width_100per border_bottom_1_dcdcdc">
		<div class="padding_20" style="text-align:center;">
			<div class="gift_box_txt">
				<b>선물받은 상품이 없습니다.</b>
			</div>
		</div>
	</div>
	<?
		}
	?>
</div>

<div class="clear"></div>

<div id="last_gift_box" style="height:400px; overflow-y:scroll;">
	<? 
		if(!empty($send_data)){ 
			foreach($send_data as $data){
	?>
	<div class="width_100per border_bottom_1_dcdcdc">
		<div class="padding_20">
			<div class="gift_box_txt_second"><b><?=$data['GIFT_NAME']?></b></div>
			<div class="margin_top_10 block">
				<span><?=$data['RECV_NICK']?></span>&nbsp;&nbsp;
				<span><?=date("Y-m-d", strtotime($data['V_SEND_DATE']))?></span>&nbsp;&nbsp;
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?
			}
		}else{
	?>
	<div class="width_100per border_bottom_1_dcdcdc">
		<div class="padding_20" style="text-align:center;">
			<div class="gift_box_txt">
				<b>선물한 상품이 없습니다.</b>
			</div>
		</div>
	</div>
	<?
		}
	?>	
</div>
<div class="clear"></div>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		//모바일 받은선물함, 보낸선물함 탭메뉴
		$("#recv_gift").click(function(){
			$("#recv_gift > b").css("color", "#EA3C3C");
			$("#send_gift > b").css("color", "#000");
			$("#first_gift_box").show();
			$("#last_gift_box").hide();
		});

		$("#send_gift").click(function(){
			$("#send_gift > b").css("color", "#EA3C3C");
			$("#recv_gift > b").css("color", "#000");
			$("#first_gift_box").hide();
			$("#last_gift_box").show();
		});

	});

</script>