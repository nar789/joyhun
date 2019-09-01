<div class="content">

	<div class="left_main">
		
		<?=$call_top?>

		<?=$call_tabmenu?>

		<?=$call_search?>

			<div class="tab_content_top_area">
				<div class="float_left">
					<p><span class="color_333">1월 23일</span> 총 <span class="color_333">23건</span>의 번개팅이 진행중입니다.</p>
				</div>
				<div class="float_right">
					<ul>
						<li class="meeting_gender_on"><a href="#">전체</a></li>
						<li class="meeting_gender_off"><a href="#">여자</a></li>
						<li class="meeting_gender_off"><a href="#">남자</a></li>
					</ul>
				</div>
			</div>
			
			<!-- ## if NULL ## -->
			<div class="list_area">
				
				<div class="light_img_null">
					<img src="/images/meeting/light_null.gif">
					<div>
						등록된 번개팅이 없습니다.<Br>
						번개팅을 등록하고 새로운 인연을 만나보세요! 
					</div>
					<div class="clear"></div>
				</div>		<!-- ## light_img_null end ## -->

				
			</div>
			<!-- ## if NULL end ## -->

			<div class="list_footer">
				<input type="button" class="text_btn_ea3e3e light_add_btn" onclick="go_top();" value="번개팅 등록하기">
			</div>

			<div class="list_pg">		<!-- ## 페이징 div ## -->
				<div>
					<ul class="pagination">
						<li><a href="#"><img src="<?=IMG_DIR?>/paging_arrow.gif"></a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">6</a></li>
						<li><a href="#">7</a></li>
						<li><a href="#">8</a></li>
						<li><a href="#">9</a></li>
						<li><a href="#">10</a></li>
						<li><a href="#"><img src="<?=IMG_DIR?>/paging_arrow.gif" class="paging_right_btn"></a></li>
					</ul>
				</div>
			</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>