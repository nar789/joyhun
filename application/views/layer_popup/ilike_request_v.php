

			<div class="padding_top_20 padding_left_11 text-center">
				<p class="color_333 font-size_14">콕 찍은 이성에게 <span class="font-size_14 color_ff87a0">좋아요</span>를 보냈습니다.</p>

				<p class="margin_top_7 color_999">상대방이 수락하면 프로필이 공개됩니다.</p>	

				<div class="bg_f4f4f4 height_72  <? if(IS_MOBILE){?>width_90per<?}else{?>width_236<? }?> margin_top_19 padding_10">
					<div class="float_left ver_top">
						<?=$this->member_lib->member_thumb($good_pop['m_userid'],74,71)?>
					</div>
					<div class="float_right width_150 padding_top_4">
						<span class="blod color_ea3c3c"><?=$good_pop['m_nick']?></span>

						<p class="color_999 blod line-height_18 margin_top_18">
							좋아요 보낸시간<br>
							<? echo date("Y-m-d H:i"); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="margin_top_20 text-center padding_bottom_30">
				<input type="button" class="text_btn_de4949 width_130 height_30" id="like_url" value="좋아요 관리함가기" onclick="location.href='/blindmeet/blind/recv_like';"/>
			</div>