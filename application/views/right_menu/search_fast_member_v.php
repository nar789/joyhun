		<div class="search_frame margin_top_8">
			<div class="search_box">

				<div class="search_title">
					<img src="<?=IMG_DIR?>/search_btn_04.gif" class="float_left"><p class="color_29b2ff">빠른 회원 찾기</p>
				</div>

				<div class="search_border">
					<div class="search_select">
						<select name="search_what">
							<option value="m_userid">아이디</option>
							<option value="m_nick">닉네임</option>
						</select>
					</div>
					<input type="text" name="search_text" onkeydown="javascript: if (event.keyCode == 13) {chk_val();}"/>
				</div>

			<input type="submit" class="serach_btn" value="검색" onclick="javascript:chk_val();"/>

			</div>		<!-- ## search_box end ## -->
		</div>		<!-- ## search_frame end ## -->