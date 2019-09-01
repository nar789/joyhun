<div class="content">

	<div class="left_main">
		<section class="autoplay slider">
			<div>
			  <a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_img_01.gif" alt=""></a>
			</div>
			<div>
			   <a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_img_02.gif" alt=""></a>
			</div>
			<div>
			   <a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_img_03.gif" alt=""></a>
			</div>
		</section>
	
		<a href="javascript:<?=user_check("music_chat_run();", 9);?>"><img src="<?=IMG_DIR?>/chatting/music_btn.png" alt="" class="music_main_btn"></a> <!-- popup.js-->

		<div class="music_chat_main_content_box">
			<div class="music_chat_list">
				<div class="margin_top_30 height_143 text-center">
					<div class="block padding_bottom_5">
						<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_ic_01.png"></a>
					</div>	
					<div class="title_color_333">
						<a href="<?=login_goto("#", "/auth/register");?>"><b>정통음악방</b></a>
					</div>
					<div class="title_color_333">
						<p>누구나 CJ가 된다.<br>취향대로 음악을 들으면서<br>무료로 채팅을!!</p>
					</div>
				</div>
			</div>
			<div class="music_chat_list">
				<div class="margin_top_30 height_143 text-center">
					<div class="block padding_bottom_5">
						<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_ic_02.png"></a>
					</div>	
					<div class="title_color_333">
						<a href="<?=login_goto("#", "/auth/register");?>"><b>1:1채팅방</b></a>
					</div>
					<div class="title_color_333">
					<p>우리둘만!!<br>통하는 우리둘이<br>재미있는 대화해봐요~</p>
					</div>
				</div>
			</div>
			<div class="music_chat_list">
				<div class="margin_top_30 height_143 text-center">
					<div class="block padding_bottom_5">
						<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_ic_03.png"></a>
					</div>	
					<div class="title_color_333">
						<a href="<?=login_goto("#", "/auth/register");?>"><b>취미대화방</b></a>
					</div>
					<div class="title_color_333">
						<p>같이 취미생활로<br>인생을 즐기는 우리~<br>이번엔 어떤걸 해볼까?</p>
					</div>
				</div>
			</div>
			<div class="music_chat_list">
				<div class="margin_top_30 height_143 text-center">
					<div class="block padding_bottom_5">
						<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/music_chatting_main_ic_04.png"></a>
					</div>	
					<div class="title_color_333">
						<a href="<?=login_goto("#", "/auth/register");?>"><b>인연찾기</b></a>
					</div>
					<div class="title_color_333">
						<p>일탈을 꿈꾸는<br>소중한 내인연을 찾는<br>우리모두 모이자~</p>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>


		<div class="content_02" id="container">
			<img src="<?=IMG_DIR?>/conte_02_ribbon.gif" class="live_on_ribbon">
			<div class="live_on_menu_area">
				<div class="margin_left_30 margin_top_2">
					<b class="live_on_channel">On 채널</b>
					<div class="arrow_right_3_ff5f0c margin_top_13"></div>
					<ul class="live_on_menu">
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>음악듣기방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>영화보기방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>편안한대화</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>이성사귀기</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>카페채팅방</b></a></li>
						<li><img src="<?=IMG_DIR?>/live_chat_bar.gif" class="margin_top_11 ver_top"></li>
						<li><a href="<?=login_goto("#", "/auth/register");?>"><b>1:1데이트</b></a></li>
					</ul>
				</div> 
			</div>

			<ul class="live_on_list">
<?
		//음악채팅 방 리스트
		for($r=0;$r<count($room_list);$r++){
				?>
				<li class="pointer">
					<div><?=($r+1)?></div>
					<div><?=music_chat_code($room_list[$r]['c_cate'])?></div>
					<div id="live_slide_<?=($r+1)?>">
						<div><?=title_style(iconv('euc-kr','utf-8',urldecode($room_list[$r]['c_title'])))?></div>
					</div>
					<div><?=$room_list[$r]['c_nowin']?>/<?=$room_list[$r]['c_inwon']?></div>
					<div onclick="javascript:<?=user_check("music_chat_run();", 9);?>">
						채팅방 입장하기 <div class="arrow_right_3_fff ver_auto"></div>
					</div>
					<div class="clear"></div>
				</li>
			<?
		}
?>

			</ul> 

		</div>		<!-- ## content_02 end ## -->

	
		<div class="clear"></div>

		<div class="live_music_box">
			<a href="<?=login_goto("#", "/auth/register");?>">
				<div class="live_music_item">
				실시간 음악채팅 on!! 100배 즐기기
				</div>
			</a>

			<div class="live_music_content">
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_01.gif" class="live_music_list_img"></a>
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">ID 숨기기</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">채팅방 입장시 아이디를 <br>숨기고 입장하세요.</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_02.gif" class="live_music_list_img"></a>
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">이성작업방</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">동성은 들어오지마세요.<br>이성회원만 입장가능!!</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_03.gif" class="live_music_list_img"></a>
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">비밀방</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">내 채팅방을 비밀로 개설해서<br>더욱 은밀하게 즐기세요~</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
				<div class="border_dotted"></div>
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_04.gif" class="live_music_list_img"></a>
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">방제목꾸미기</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">내 채팅방 제목을 눈에 확 띄게<br>꾸며보세요~</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_05.gif" class="live_music_list_img"></a>
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">우선노출</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">내가만든방을 대기실<br>최상단으로 올리세요~!!</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
				<div class="live_music_list">
					<a href="<?=login_goto("#", "/auth/register");?>"><img src="<?=IMG_DIR?>/chatting/item_60.gif" class="live_music_list_img">
					<div class="block ver_top margin_top_13 margin_left_7">
						<a href="<?=login_goto("#", "/auth/register");?>"><b class="color_333">이모티콘 자유이용권</b></a>
						<a href="<?=login_goto("#", "/auth/register");?>"><p class="color_999 margin_top_4">나만의 이모티콘을 날려<br>나를 부각시키세요!</p></a>
						<!-- <input type="button" class="text_btn_dcdcdc live_music_item_btn" value="효과보기" /> -->
					</div>
				</div>
			</div>
		</div>

		<div class="music_soft_box">
			<img src="<?=IMG_DIR?>/chatting/music_software.gif" usemap="#music_soft_box">
		</div>
		<map name="music_soft_box">
			<area shape="rect" coords="16,65,109,114" href="#" alt="Media Player">
			<area shape="rect" coords="122,64,217,115" href="#" alt="MS DirectX">
		</map>

		<div class="music_noti_area">
			<div>
				<div class="float_left color_333 blod margin_top_18 margin_left_18"><span class="font-size_14">공지사항</span></div>
				<div class="float_right margin_top_18 margin_right_15"><a href="#"><img src="<?=IMG_DIR?>/add_btn.png"></a></div>
				<div class="clear"></div>
			</div>
			<div class="margin_left_34">
				<ul class="music_noti_ul margin_top_12">
					<?
						foreach( board_list('4', 'notice_list', 'n_title,idx,n_date', 'n_date') as $key => $val)
						{
					?>
					<li>
						<div class="width_360 block">
							<a href="/service_center/notice/noti_view/idx/<?=$val['idx']?>" class="color_666"><?=$val['n_title']?></a>
						</div>
						<div class="block color_999">
							<?=substr($val['n_date'], 0, 11);?>
						</div>
					</li>
					<? } ?>
				</ul>
			</div>
		</div>

	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>