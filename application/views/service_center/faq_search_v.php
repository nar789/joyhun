		<div class="faq_top_area">
			<div class="float_left height_89">
				<b class="color_ea3c3c font-size_28">FAQ</b> <span class="color_333 font-size_22">검색</span>
				<form method="post" action="/service_center/faq/faq_list/">
				<div class="">
					<input type="text" class="service_search_text width_375" placeholder="검색을 이용하시면 보다 빠르게 원하시는 답변을 얻으실 수 있습니다." name="qna_sch" id="qna_sch" value="<?=@$s_word?>" />
					<input type="submit" class="search_btn_766a6a height_36 width_100 ver_top margin_left_2" value="검색">
				</div>
				</form>
			</div>
			<div class="float_right height_89">
				<p class="margin_top_3 color_333 font-size_14 line-height_18">
					<span class="color_e93d3b font-size_14">원하시는 정보</span>를<br> 못 찾으셨나요?
				</p>
				<input type="button" class="text_btn_5959 blod" value="문의하기"  onclick="javascript:qna_add();"/>
			</div>
			<div class="clear"></div>
		</div>