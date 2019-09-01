
<div class="bg_fff">
	<? 
		//여성전용 이벤트 배너 popup_helper
		call_woman_event_pop();
	?>
	
	<div style="width:100%; background-size: 100%;">
		<!--m_top_bg.png-->
		<div class="width_95per margin_auto">
			<table class="m_top_area width_100per">
				<tr>
					<td class="width_25per">
						<? if(IS_LOGIN == false){?>
							<? if(!@$this->session->userdata['regi_id']){ ?>
							<input type="button" value="회원가입" class="width_80per m_top_edga_btn" onclick="location.href='/auth/register/';">
							<? } ?>
						<?}else{?>
						<a href="/profile/main/user" class="m_left"><?=$this->member_lib->member_thumb($this->session->userdata['m_userid'], 150, 150)?></a>
						<?}?>
					</td>
					<td class="width_50per text-center">
						<a href="/"><img src="<?=IMG_DIR?>/m/m_top_logo.gif" class="m_rogo" style="width:70% !important;"></a>
					</td>

					<?
						//조이헌팅 로고
						//기본 m_top_logo.gif
						//봄
						//여름
						//가을
						//겨울 m_winter_rogo.png
					?>

					<td class="width_25per text-right">
						<? if(IS_APP and APP_OS == "IOS"){ ?>
						<? }else{ ?>
							<? if(@$this->session->userdata['m_type'] == "V" and @$this->session->userdata['m_sex'] == "M"  ){?>
							<!--<a href="javascript:fulltv_pop_layer(1);">-->
							<a href="/event/tv_event"><img src="<?=IMG_DIR?>/top_tv2.png" class="tv_box pointer" border="0"></a>
							<!--</a>-->
							<?}?>
						<? } ?>

						<? if(IS_LOGIN == false){?>
							<? if(!@$this->session->userdata['regi_id']){ ?>
							<input type="button" value="로그인" class="width_70per m_top_edga_btn margin_left_20per" onclick="location.href='/auth/login/';">
							<? } ?>
						<?}else{?>
						<? if(IS_APP and APP_OS == "IOS"){ ?>
						<? }else{ ?>
							<img src="<?=IMG_DIR?>/m/gift_box.png" class="gift_box pointer"></a> 
						<? } ?>
						
						<!--<a href="/profile/main/user"><img src="<?=IMG_DIR?>/m/m_top_right.gif"></a> 
						<a href="/profile/main/user"><?=$this->member_lib->member_thumb($this->session->userdata['m_userid'], 150, 150)?></a>-->
						<div class="gift_tab">
							<ul>
								<li>
									<a href="javascript:gift_shop('list', 'test', 'shop');"><img src="<?=IMG_DIR?>/m/gift_shop_01.png" class=" pointer" style="width:100%;"></a>
								</li>
								<li>
									<a href="javascript:btn_gift_clk('recv');"><img src="<?=IMG_DIR?>/m/gift_shop_04.png" class=" pointer" style="width:100%;"></a>
								</li>
							</ul>
						</div>
						<?}?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?if(IS_LOGIN == true){?>
	<ul class="m_top_menu">
		<li class="" onclick="javascript:location.href='/m/online_mb';" style="cursor:pointer;"><a href="/m/online_mb" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_1.png"><p>접속자</p></a></li>
		<li class="" onclick="javascript:location.href='/profile/my_chat/chatting_list';" style="cursor:pointer;"><a href="/profile/my_chat/chatting_list" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_2.png"><p>채팅</p></a>
			<div class="chat_cnt" id="chat_cnt">1</div>
		</li>
		<li class="" onclick="javascript:location.href='/chatting/town_find/order_login';" style="cursor:pointer;"><a href="/chatting/town_find/order_login" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_5.png"><p>지역채팅</p></a></li>
		<li class="" onclick="javascript:location.href='/blindmeet/blind';" style="cursor:pointer;"><a href="/blindmeet/blind" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_3.png"><p>소개팅</p></a></li>
		<li class="" onclick="javascript:location.href='/m/add_menu';" style="cursor:pointer;"><a href="/m/add_menu" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_4.png"><p>더보기</p></a></li>
	</ul>
	<div class="clear"></div>
<?}else{?>
	<? if(@$this->session->userdata['regi_id']){ ?>

		<ul class="m_top_menu">
			<li class="" onclick="javascript:location.href='/m/regi_demo/demo1';" style="cursor:pointer;"><a href="/m/regi_demo/demo1" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_1.png"><p>접속자</p></a></li>
			<li class="" onclick="javascript:location.href='/m/regi_demo/demo2';" style="cursor:pointer;"><a href="/m/regi_demo/demo2" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_2.png"><p>채팅</p></a></li>
			<li class="" onclick="javascript:location.href='/m/regi_demo/demo3';" style="cursor:pointer;"><a href="/m/regi_demo/demo3" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_5.png"><p>지역채팅</p></a></li>
			<li class="" onclick="javascript:location.href='/m/regi_demo/demo4';" style="cursor:pointer;"><a href="/m/regi_demo/demo4" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_3.png"><p>소개팅</p></a></li>
			<li class="" onclick="javascript:location.href='/m/regi_demo/demo5';" style="cursor:pointer;"><a href="/m/regi_demo/demo5" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_4.png"><p>더보기</p></a></li>
		</ul>
		<div class="clear"></div>

	<? }else{ ?>
		
		<ul class="m_top_menu">
			<li class="" onclick="javascript:location.href='/auth/register';" style="cursor:pointer;"><a href="/auth/register" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_1.png"><p>접속자</p></a></li>
			<li class="" onclick="javascript:location.href='/auth/register';" style="cursor:pointer;"><a href="/auth/register" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_2.png"><p>채팅</p></a>
				<div class="chat_cnt" id="chat_cnt">1</div>
			</li>
			<li class="" onclick="javascript:location.href='/auth/register';" style="cursor:pointer;"><a href="/auth/register" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_5.png"><p>지역채팅</p></a></li>
			<li class="" onclick="javascript:location.href='/auth/register';" style="cursor:pointer;"><a href="/auth/register" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_3.png"><p>소개팅</p></a></li>
			<li class="" onclick="javascript:location.href='/auth/register';" style="cursor:pointer;"><a href="/auth/register" class="top_sub_menu"><img src="<?=IMG_DIR?>/m/m_menu_4.png"><p>더보기</p></a></li>
		</ul>
		<div class="clear"></div>

	<? } ?>
	
<?}?>


<script>

$(document).ready(function(){

  $('.gift_box').click(function(){
	$('.gift_tab').toggle();
  });

 $("#gift_shop").click(function(){

	var width = $(window).width();
	gift_shop(width);

  });
 
  $("#gift_box").click(function(){

	var width = $(window).width();
	gift_box_layer(width);

  });

});
</script>

