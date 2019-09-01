<div class="content">

	<div class="left_main width_760" style="height:818px;">

		<img src="<?=IMG_DIR?>/service_center/service_center.gif" usemap="#service_top" />
		<map name="service_top">
			<area shape="rect" coords="63,64,152,160"  href="/service_center/faq/privacy" alt="개인정보문의">
			<area shape="rect" coords="200,64,288,160" href="/service_center/faq/service_faq" alt="서비스문의">
			<area shape="rect" coords="334,64,422,160" href="/service_center/joy_police/declaration" alt="조이폴리스">
			<area shape="rect" coords="468,64,556,160" href="/service_center/my_question/my_question_list" alt="나의 문의내역">
			<area shape="rect" coords="605,64,694,160" href="#" alt="고객상담문의" onclick="javascript:qna_add();"/>
		</map>

		<div class="faq_search">
			<form method="post" action="/service_center/faq/faq_list/">
			<div class="padding_top_20">
				<b class="color_ea3c3c font-size_28">FAQ</b> <span class="color_333 font-size_22">검색</span>
				<input type="text" class="service_search_text margin_left_15" placeholder="검색을 이용하시면 보다 빠르게 원하시는 답변을 얻으실 수 있습니다." name="qna_sch" id="qna_sch" value="<?=@$s_word?>"/>
				<input type="submit" class="search_btn_766a6a height_36 width_100 ver_top margin_left_2" value="검색">
			</div>
			</form>
		</div>

		<div class="margin_top_47">
			<div class="float_left width_360">
				<a href="/service_center/faq/privacy"><p class="service_main_title">자주묻는 질문 TOP 10</p></a>

				<ol class="service_li service_list">
				<?
					foreach( board_list('10', 'faq_list', '*', 'choice','choice IS NOT NULL', 'asc') as $key => $val)
					{
						if ($val['gubn1'] == '개인정보')	{ $urL = "privacy";
				  }else if ($val['gubn1'] == '로그인/접속') { $urL = "login_faq";
				  }else if ($val['gubn1'] == '서비스')		{ $urL = "service_faq";
				  }else if ($val['gubn1'] == '결제')		{ $urL = "payment"; }
				?>
					<li class="width_347 text_cut"><a href="/service_center/faq/<?=$urL?>/f1/<?=$val['gubn1']?>/f2/<?=$val['gubn2']?>/idx/<?=$val['idx']?>">[<?=$val['gubn1']?>/<?=$val['gubn2']?>]<?=$val['title']?></a></li>
				<? } ?>
				</ol>
			</div>

			<div class="float_right width_360">
				<a href="/service_center/notice/noti_list"><p class="service_main_title">공지사항</p></a>

				<ul class="service_li">
				<?
					foreach( board_list('10', 'notice_list', '*', 'n_date') as $key => $val)
					{
				?>
					<li class="width_347 text_cut"><a href="/service_center/notice/noti_view/idx/<?=$val['idx']?>"><? if(@$val['sel1']){ echo "[".$val['sel1']."]"; }else{ echo "[공지사항]"; }?> <?=$val['n_title']?></a></li>

				<? } ?>
				</ul>
			</div>

			<div class="clear"></div>
		</div>

	</div>		<!-- ## LEFT_MAIN END ## -->

	<div class="right_main width_192">
		<?=$right_menu?>
	</div>

</div>