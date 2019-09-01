
<div class="content">

	<div class="left_main">
		<div class="point_main_top">
			<div class="point_main_my">
				 <p class="block color_666 font-size_14 blod">내 보유 포인트</p>
				 <p class="block color_ea3c3c font-size_20 blod ver_top text-center width_175">
					 <? if(@$tp['total_point']){ ?>
					 <?=number_format($tp['total_point'])?> p
					 <? }else{ ?>
					 0 p
					 <? } ?>
				 </p>
				 <input type="button" class="text_btn_de4949 margin_top_10 width_85 height_22 float_right" value="충전하기" onclick="javascript:point_charg_flg('<?=$flg?>');"/>
				 <div class="clear"></div>
			</div>
		</div>

		<?=$call_tabmenu?>

		<?=$call_search?>


		<ul class="profile_table margin_top_40">
			<li class="text-center width_240"><?=$use_gubn?>날짜</li>
			<li class="text-center width_303"><?=$use_gubn?>내역</li>
			<li class="text-center width_160"><?=$use_gubn?>포인트</li>
		</ul>
		
		<? 
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>
			
			<div class="border_bottom_1_ececec min_height_40 color_333">
				<div class="block text-center width_240 padding_top_12 ver_top"><?=$data['m_writedate']?></div>
				<div class="block text-center width_303 padding_top_12 padding_bottom_10 ver_top break_all"><?=$data['m_goods']?></div>
				<div class="block text-center width_160 padding_top_12 ver_top"><?=$data['m_point']?> P</div>
			</div>

		<?		}
			}else{ 
		?>
		<div class="list_area border_bottom_2_ececec">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div>
					<?=$use_gubn?>내역이 없습니다.
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<? 
			}
		?>

	


		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= @$pagination_links?>
			</div>
		</div>

	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
<!-- CONTENT END -->