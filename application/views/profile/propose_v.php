<div class="content">

	<div class="left_main">

		<p class="font-size_18 color_333 blod">프로포즈</p>

		<?=$call_tabmenu?>
		<div id="tmp"><input type="hidden" id="success_val" name="success_val" value=""></div>			<!-- 데이터 결과값 찍어보는 용도 -->

		<div class="margin_top_23">
			<span class="color_999">선택한 프로포즈를</span> <input type="button" class="text_btn_dcdcdc width_40 height_20 color_333 blod" value="삭제" onclick="javascript:propose_del('<?=$v_mode?>');"/>
		</div>

		<ul class="profile_table margin_top_5">
			<li class="text-center width_210">아이디(나이)</li>
			<li class="text-center width_115">접속지역</li>
			<li class="text-center width_256">내용</li>
		</ul>
		<?
			if($getTotalData > 0){
				foreach($mlist as $data){

		?>
		<div class="min_height_72 border_bottom_1_ececec">
			<div class="float_left">
				<div class="block margin_left_6 margin_top_26 ver_top">
					<input type="checkbox" id="propose_<?=$data['m_idx']?>" name="propose_chk" value="<?=$data['m_idx']?>" class="common_checkbox"><label for="propose_<?=$data['m_idx']?>" class="common_checkbox_label"></label>
				</div>				
				<!--
					$flag = p 일경우 보낸 프로포즈 
					$flag = m 일경우 받은 프로포즈 
					구분 컬럼명 앞이 달라서 $flag로 구분 
				-->
				<div class="width_130 block margin_top_30 color_333 margin_left_18 ver_top">
					<?if($flag == "m"){
						echo '<span class="color_8a98f0 font_900">♂</span>';
					}else{
						echo '<span class="color_f08a8e font_900">♀</span>';
					}?>

					<?=$data[$flag.'_nick']?> (<?=$data[$flag.'_age']?>세)
				</div>
				<div class="width_109 margin_left_60 block margin_top_30 color_333 ver_top">
					<?=$data[$flag.'_conregion']?> <?=$data[$flag.'_conregion2']?>
				</div>

			</div>
			<div class="width_234 block margin_top_30 color_333 text-center ver_top padding_bottom_20 break_all">
				<?=$data['m_content']?>
			</div>
			<div class="float_right margin_top_18" title="프로필 보기"onclick="<?user_check("javascript:view_profile('$data[m_userid]');");?>">
				<div class="icon_btn_bababa">
					<span class="img_mail_btn"></span>
				</div>
				<div class="icon_btn_bababa" onclick="javascript:send_message('<?=$data['m_userid']?>', 'send', '');">
					<span class="img_talk_btn"></span>
				</div>
				<div class="icon_btn_bababa" title="찜하기" onclick="<?user_check("javascript:jjim_request('$data[m_userid]');");?>">
					<span class="img_heart_btn"></span>
				</div>
			</div>
		</div>
		<?
				}
			}else{
		?>
		<div class="list_area border_bottom_2_ececec">
			<div class="light_img_null">
				<img src="<?=IMG_DIR?>/meeting/light_null.gif">
				<div class="margin_top_5">
					프로포즈가 없습니다.<Br>
					마음에 드는 이성에게 프로포즈하고 더욱 더 가까워져 보세요~
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
			}
		?>

		

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
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