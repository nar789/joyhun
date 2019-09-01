
	<div class="right_service_area">

		<img src="<?=IMG_DIR?>/service_center/service_right.gif" class="pointer" onclick="location.href='/service_center'">

		<div class="two_depth">
			<a href="/service_center/faq/privacy" ex_serach="/service_center/faq/privacy,/service_center/faq/login_faq,/service_center/faq/service_faq,/service_center/faq/payment,/service_center/faq/faq_list">FAQ</a>
			<ul class="third_depth">
				<?
					//code_chagne_helper.php 안의 헬퍼에 메뉴지정
					$faq_menu = faq_category('all');

					foreach($faq_menu as $key => $value){
				?>
						<li><a href="<?=$value['href']?>" class="font-size_14"><?=$value['faq_title']?></a></li>
				<?
					}
				?>

			</ul>
		</div>

		<div class="two_depth">
			<a href="/service_center/joy_police/declaration">조이폴리스</a>
			<ul class="third_depth">
				<li><a href="/service_center/joy_police/declaration" class="font-size_14">신고방법</a></li>
				<li><a href="/service_center/joy_police/punishment" class="font-size_14" ex_serach="/service_center/joy_police/punishment2,/service_center/joy_police/punishment3">처벌기준</a></li>
				<li><a href="/service_center/joy_police/my_caution" class="font-size_14"
				ex_serach="/service_center/joy_police/my_caution2">나의경고기록</a></li>
				<li><a href="/service_center/joy_police/fraud_ex" class="font-size_14"
				ex_serach="/service_center/joy_police/fraud_ex2,/service_center/joy_police/fraud_ex3,/service_center/joy_police/fraud_ex4">사기피혜사례</a></li>
				<li><a href="/service_center/joy_police/baduse_ex" class="font-size_14"
				ex_serach="/service_center/joy_police/baduse_ex2,/service_center/joy_police/baduse_ex3">불량이용사례</a></li>
			</ul>
		</div>

		<div class="two_depth">
			<a href="/service_center/notice/noti_list" ex_serach="/service_center/notice/noti_view,/service_center/notice/noti_list">공지사항</a>
		</div>
			
		<div class="two_depth">
			<a href="/service_center/joy_magazine/all" ex_serach="/service_center/joy_magazine/all,/service_center/joy_magazine/magazine_view">조이매거진</a>
		</div>

		<div class="two_depth">
			<a href="/service_center/event/ing_event" ex_serach="/service_center/event_stamp/stamp_event">이벤트</a>
		</div>

		<div class="two_depth">
			<a href="/service_center/my_question/my_question_list">나의문의내역</a>
		</div>

	</div>
