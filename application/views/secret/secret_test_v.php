<div class="content">
	<div class="left_main">

		<img src="<?=IMG_DIR?>/secret/secret_top.jpg">

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

		<ul>
			<?php
			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
			?>

				<li class="width_100per">
					<div class="secret_img">
					
						<? if ($data['m_sex'] == 'M'){ ?>
							<img src="<?=IMG_DIR?>/secret/secret_man_ic.gif">
						<? }else{ ?>
							<img src="<?=IMG_DIR?>/secret/secret_girl_ic.gif">
						<? } ?>
					</div>
					<div class="secret_list">
						<div class="secret_text">
							<b class="font-size_18 color_7343cb"><?=mb_level_profile($data['m_userid'])?><?=$data['m_nick']?></b><b class="font-size_18 color_666">(<?=$data['m_age']?>) <?=$data['m_conregion']?> <?=$data['m_conregion2']?></b>
							<p class='font-size_16 color_ccc'><?=talk_style_data($data['m_character'], $data['m_sex']);?> / <?=want_reason_data($data['m_reason']);?><!-- 애인만들기 / 일반싱글 여자 --></p>
						</div>
						<div class="secret_btn">
							<input type="button" class="btn_secret" value="비밀채팅신청" onclick="<?user_check("renew_chat_request('$data[m_userid]');");?>">
						</div>
					</div>
					<div class="clear"></div>
				</li>

			<?
					}
				}
			?>
			</ul>

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>

		</div>


	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>
</div>
