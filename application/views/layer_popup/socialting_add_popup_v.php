
			<input type="hidden" id="m_idx" name="m_idx" value="<?=@$my_data['m_idx']?>">
			<input type="hidden" id="m_userid" name="m_userid" value="<?=@$my_data['m_userid']?>">

			<div class="bg_f4f4f4 height_156">
				<div class="padding_top_20 padding_left_20">
					<div class="popup_img_L ver_top">
						<?php
							//프로필 신규등록
							if (IS_LOGIN == false || @$my_data['m_userid'] == ""){
								if ($this->session->userdata('m_sex') == "M") echo "<img src='/images/meeting/man_ic.png' class='bg_e7f0ff'>";
								if ($this->session->userdata('m_sex') == "F") echo "<img src='/images/meeting/girl_ic.png' class='bg_ffe7eb'>";
							}else{
								echo $this->member_lib->member_thumb($my_data['m_userid'],123,126);
							}
						?>
						
					</div>
					<div class="block width_290 padding_top_8 padding_left_6">
						<span class="color_333 font-size_14">소개글 입력</span> <span class="color_999 font-size_12">(성격/취미/지역/원하는 친구/좋아하는 것)</span>
						<textarea class="social_textarea" <?if(@$placeholder){?>placeholder="입력해주세요"<?}?> id="m_content" name="m_content" <?=@$read_only?>><?=@$my_data['m_content']?></textarea>
					</div>
				</div>
			</div>
			
			<div class="padding_20 padding_bottom_none">
				<table class="popup_border_table">
					<tr>
						<td>카카오톡</td>
						<td>
							<div class="height_22 margin_right_2 block line-height_22 float_left">
								<input type="text" <?if(@$placeholder){?>placeholder="아이디"<?}?> class="color_666 width_103 height_22" id="m_kakao" name="m_kakao" value="<?=@$my_data['m_kakao']?>" <?=@$read_only?>/>
							</div>
							<div class="clear"></div>
						</td>
					</tr>
					<tr>
						<td>네이트</td>
						<td>
							<div class="height_22 margin_right_2 block color_666 line-height_22">
								<input type="text" <?if(@$placeholder){?>placeholder="아이디"<?}?> class="color_666 width_320 height_22" id="m_nateon" name="m_nateon" value="<?=@$my_data['m_nateon']?>" <?=@$read_only?>/> 
							</div>
							<div class="clear"></div>
						</td>
					</tr>
					<tr>
						<td>싸이월드</td>
						<td>
							<div class="height_22 margin_right_2 block color_666 line-height_22">
								http://cyworld.com/<input type="text" <?if(@$placeholder){?>placeholder="싸이월드 계정"<?}?> class="color_666 width_201 height_22 margin_left_7" id="m_cyworld" name="m_cyworld" value="<?=@$my_data['m_cyworld']?>" <?=@$read_only?>/>
							</div>
							<div class="clear"></div>
						</td>
					</tr>
					<tr>
						<td>페이스북</td>
						<td>
							<div class="height_22 margin_right_2 block color_666 line-height_22">
								<input type="text" <?if(@$placeholder){?>placeholder="아이디"<?}?> class="color_666 width_320 height_22" id="m_facebook" name="m_facebook" value="<?=@$my_data['m_facebook']?>" <?=@$read_only?>/> 
								</div>
							<div class="clear"></div>
						</td>
					</tr>
					<tr>
						<td>트위터</td>
						<td>
							<div class="height_22 margin_right_2 block color_666 line-height_22">
								http://twitter.com/<input type="text" <?if(@$placeholder){?>placeholder="트위터 계정"<?}?> class="color_666 width_201 height_22 margin_left_13" id="m_twitter" name="m_twitter" value="<?=@$my_data['m_twitter']?>" <?=@$read_only?>/>
							</div>
							<div class="clear"></div>
						</td>
					</tr>
					<tr>
						<td>미투데이</td>
						<td>
							<div class="height_22 margin_right_2 block color_666 line-height_22">
								http://me2day.net/<input type="text" <?if(@$placeholder){?>placeholder="미투데이 계정"<?}?> class="color_666 width_201 height_22 margin_left_12" id="m_me2day" name="m_me2day" value="<?=@$my_data['m_me2day']?>" <?=@$read_only?>/>
							</div>
							<div class="clear"></div>
						</td>
					</tr>

				</table>

				<div class="social_profile_noti">
					※ 사용중인 SNS 주소 또는 아이디를 1개 이상 입력하세요<br>
					※ 조이헌팅 대표사진과 SNS에 사진을 등록하셔야 인증이 완료됩니다. 
				</div>


				<?php
					//연락처확인시 본인이 아닐경우 삭제 버튼 숨기기
					if($this->session->userdata('m_userid') == @$my_data['m_userid']){
					if (IS_LOGIN && @$my_data['m_userid'] <> ""){
				?>
				<div class="socialting_del_box">

					소셜팅 등록을 해지합니다.
					<input type="button" value="확인" class="text_btn_dcdcdc width_36 height_22" onclick="javascript:profile_delete();"/>
					
				</div>
				<?
					}}
				?>

			</div>

			
			<div class="margin_top_20 text-center padding_bottom_30">
				<?php

					//연락처확인시 본인이 아닐경우 저장 버튼 숨기기
					if(($this->session->userdata('m_userid') == @$my_data['m_userid']) || (@$my_data['m_userid'] == "")){

					//프로필 신규등록
					if (IS_LOGIN == false || @$my_data['m_userid'] == ""){
				?>
				<input type="button" class="text_btn_de4949 width_62 height_30" value="완료" onclick="javascript:profile_insert();"/>
				<?
					}
					//프로필 수정
					else{
				?>
				<input type="button" class="text_btn_de4949 width_62 height_30" value="완료" onclick="javascript:profile_update();"/>
				<?
					}}
				?>
				
			</div>
		
