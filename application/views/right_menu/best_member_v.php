		<div class="best_member">
		
			<div class="best_member_title_box">
				<div class="float_left">
					<p class="font-size_14"><span class="color_ff1c24 font-size_14">베스트</span> 회원</p>
				</div>
				<div class="float_right">
					<a href="/chatting/find_chatting/order_like_cnt"><img src="<?=IMG_DIR?>/meeting/add_btn2.gif" class="padding_top_17"></a>
				</div>
				<div class="clear"></div>
			</div>

			<?
//				if(!$right_best_member_f = $this->cache->get('right_best_member_f')){
//						$right_best_member_f =  best_mb('F');
//						$this->cache->save('right_best_member_f', $right_best_member_f, 600);	//10분 캐시 사용
//				}

				// 베스트 회원 여자
				foreach( best_mb('F') as $key => $val)
				{
			?>
			<div class="best_member_con_box">
				<div class="best_member_content">
					<div class="best_mb_img" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><?=$this->member_lib->member_thumb($val['m_userid'],103,99)?></div>
					<a href="#" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><p class="color_333 width_103 text_cut"><?=mb_level_profile($val['m_userid'])?><?=$val['m_nick']?></p></a>
					<p class="color_999"><?=$val['m_conregion']?> / <?=$this->member_lib->s_symbol($val['m_sex'])?><?=$val['m_age']?>세</p>
				</div>
			</div>
			<? } ?>

			<?
//				if(!$right_best_member_m = $this->cache->get('right_best_member_m')){
//						$right_best_member_m =  best_mb('M');
//						$this->cache->save('right_best_member_m', $right_best_member_m, 600);	//10분 캐시 사용
//				}

				// 베스트 회원 남자
				foreach( best_mb('M') as $key => $val)
				{
			?>
			<div class="best_member_con_box">
				<div class="best_member_content">
					<div class="best_mb_img" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><?=@$this->member_lib->member_thumb($val['m_userid'],103,99)?></div>
					<a href="#" onclick="<?user_check("view_profile('$val[m_userid]');");?>"><p class="color_333 width_103 text_cut"><?=mb_level_profile($val['m_userid'])?><?=$val['m_nick']?></p></a>
					<p class="color_999"><?=$val['m_conregion']?> / <?=@$this->member_lib->s_symbol($val['m_sex'])?><?=$val['m_age']?>세</p>
				</div>
			</div>
			<? } ?>

			<div class="clear"></div>
		
		</div>