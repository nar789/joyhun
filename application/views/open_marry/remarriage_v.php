<div class="content">

	<div class="left_main">

		<?=$call_top?>

		<div class="tab_content_top_area">
			<div class="float_right">
				<ul>
					<li class="submenu_gender_<?=$sex_class1?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>',' ');"><a>전체</a></li>
					<li class="submenu_gender_<?=$sex_class2?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','F');"><a>여자</a></li>
					<li class="submenu_gender_<?=$sex_class3?> pointer" onclick="javascript:search_sex('<?=$this->uri->segment(3)?>','M');"><a>남자</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		
		<?
			if($getTotalData > 0){
				foreach($mlist as $data){
		?>


		<div class="list_area">
			<div class="float_left padding_16 marriage_thumb">
				<a href="#" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
					<?=$this->member_lib->member_thumb($data['m_userid'], 98, 97)?>
				</a>
				<div class="block margin_left_18 width_98">
					<p class="margin_top_9 margin_bottom_6 marriage_img"><?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><span class="color_333"><?=@$data['m_nick']?></span></p>
					<span class="color_666 line-height_18"><? echo date('Y')-@$data['m_age']+1?>년생 (<?=@$data['m_age']?>세)<br><?=@$data['m_conregion']?> <?=@$data['m_conregion2']?><br><?=@$data['m_job']?></span>
				</div>
			</div>
			<div class="float_right width_465 min_height_130">
				
				<div class="margin_top_23">
					<p class="love_per_title block ver_top margin_top_3">러브궁합도</p>
					<div class="love_per_frame float_none block">
						<div class="love_per_frame_box" style="width:<?=love_per($data['m_conregion'],$data['m_conregion2'],$data['m_age'],$data['m_sex'])?>%;"></div>	<!-- ## style ## -->
					</div>
					<p class="love_per_name float_none block ver_top margin_top_0 margin_left_mi_3"><?=love_per($data['m_conregion'],$data['m_conregion2'],$data['m_age'],$data['m_sex'])?>%</p>
				</div>
				<div class="float_left margin_top_10">
					<div class="marriage_content">
						<p class="blod height_14 color_004151"><?=@$data['m_title']?></p>
						<p class="color_666 margin_top_4 line-height_16"><?=@$data['m_content']?></p>
					</div>
				</div>
				<div class="float_right margin_top_10">
					<input type="button" class="join_btn width_95 border-radius_2" value="상세정보보기" onclick="javascript:m_request_user('<?=$data['m_userid']?>');">
					<div class="text_btn_fe727b width_95 height_37 line-height_38 margin_top_5" onclick="javascript:propose_reuqest('<?=$data['m_userid']?>', '재혼');">
						프로포즈하기 <img src="<?=IMG_DIR?>/meeting/arrow_btn_fff.gif">
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>		<!-- ## list_area end ## -->

		
		<?
				}
			}else{
			
		?>

		<div class="list_area border_bottom_1_ececec height_95">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div class="margin_top_10">
					검색에 해당하는 회원이 없습니다.
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<?
			}
		?>




		<div class="list_footer">
			<input type="button" class="text_btn_ea3e3e width_165 font-size_14 margin_right_8" value="프로포즈함 가기" onclick="javascript:location.href='/profile/propose/send_propose';">
		</div>
		

		<div class="list_pg margin_top_23">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>
		
	</div>
	<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

</div>
<!-- CONTENT END -->
