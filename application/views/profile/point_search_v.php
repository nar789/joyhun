<div class="point_search_area">
	<div class="point_search_left">조회기간</div>
	<div class="point_search_right">
		<div class="point_term">
			<input type="button" class="term_chos_no" id="btn_date1" value="15일" on_value="15" onclick="javascript:date_search_btn($(this).attr('on_value'), '<?=$tabmenu?>');">
			<input type="button" class="term_chos" id="btn_date2" value="1개월" on_value="30" onclick="javascript:date_search_btn($(this).attr('on_value'), '<?=$tabmenu?>');">
			<input type="button" class="term_chos_no" id="btn_date3" value="6개월" on_value="180" onclick="javascript:date_search_btn($(this).attr('on_value'), '<?=$tabmenu?>');">
			<input type="button" class="term_chos_no" id="btn_date4" value="1년" on_value="365" onclick="javascript:date_search_btn($(this).attr('on_value'), '<?=$tabmenu?>');">
		</div>

		<div class="point_term_search">

			<div class="select_box_border">
				<select class="width_80 height_35" id="before_year" name="before_year">
					<? for($i=date('Y'); $i>2002; $i--){ ?>
					<option value="<?=$i?>" <? if($b_year == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
				<select class="width_60 height_35" id="before_month" name="before_month">
					<? for($i=1; $i<13; $i++){ ?>
					<option value="<?=$i?>" <? if($b_month == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
				<select class="width_60 height_35" id="before_day" name="before_day">
					<? for($i=1; $i<32; $i++){ ?>
					<option value="<?=$i?>" <? if($b_day == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
			</div>

			~

			<div class="select_box_border">
				<select class="width_80 height_35" id="after_year" name="after_year">
					<? for($i=date('Y'); $i>2002; $i--){ ?>
					<option value="<?=$i?>" <? if($a_year == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
				<select class="width_60 height_35" id="after_month" name="after_month">
					<? for($i=1; $i<13; $i++){ ?>
					<option value="<?=$i?>" <? if($a_month == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
				<select class="width_60 height_35" id="after_day" name="after_day">
					<? for($i=1; $i<32; $i++){ ?>
					<option value="<?=$i?>" <? if($a_day == $i){ ?> selected <? } ?> ><?=$i?></option>
					<? } ?>
				</select>
			</div>

			<div class="submenu_select_box block padding_top_0">
				<input type="button" id="point_btn_search" name="point_btn_search" value="조회" onclick="javascript:point_btn_search('<?=$tabmenu?>');"/>
			</div>

		</div>




	</div>
	<div class="clear"></div>

</div>