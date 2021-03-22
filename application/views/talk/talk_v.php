<div class="content">

	<div class="left_main">

		<div class="talk_top_banner">
			<div class="padding_left_222 padding_top_96">
				<div class="talk_top_box">
					<div class="padding_top_15 padding_left_13">
						<div class="top_textarea_img" id="noimg_check">
						<? if (IS_LOGIN){	//로그인 했으면 프로필사진 ?>
							<?=$this->member_lib->member_thumb($this->session->userdata('m_userid'),74,71)?>
						<? } else { //로그인안했으면 user_check ?>
							<a href="#" onclick="<?=user_check("javascript:form_check();")?>"><span>대표사진 등록</span></a>
						<? } ?>
						</div>
						<textarea class="top_textarea border_1_7b5dfb width_291" id="t_context" placeholder="안녕하세요~ 반갑습니다."></textarea>
						<!--<div class="text_btn_de4949 top_textarea_subbtn bg_fdeb08" onclick="<php user_check("talk_insert('$v_userid', '1');");php>">//-->
						<div class="text_btn_de4949 top_textarea_subbtn bg_fdeb08" onclick="return false;">
							<div class="margin_top_19 font-size_14 blod color_7b5dfb">토크<br>올리기</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="tab_content_top_area">
		</div>

		<div id="tmp">
			<input type="hidden" id="m_userid" name="m_userid" value="<?=@$this->session->userdata['m_userid']?>">
		</div>

		<?php
			if( $getTotalData > 0 )
			{

				foreach($mlist as $data)
				{
		?>

		<div class="list_area min_height_108">
			<div class="float_left talk_thumb" onclick="<?user_check("view_profile('$data[m_userid]');");?>">
				<?=$this->member_lib->member_thumb($data['m_userid'],74,71)?>
			</div>
			<div class="float_right margin_top_16 width_605">
				<div class="float_left padding_bottom_10">
					<div class="block width_454 ver_top">
						<p class="margin_top_8 level_img_talk">
							<?=mb_level_profile($data['m_userid'])?><?=$this->member_lib->s_symbol($data['m_sex'])?><b class="color_333333"><?=$data['m_nick']?></b>
							<span class="block color_999 margin_left_21"><?=$data['t_write']?></span>
							<? if(@$this->session->userdata['m_userid'] == @$data['m_userid']){ ?>
							<input type="button" class="rep_del_btn" style="margin-right:200px;" onclick="javascript:user_talk_del('<?=$data['t_idx']?>');">
							<? } ?>
						</p>
						<div class="color_666 margin_top_10 line-height_16 padding_bottom_8 break_all">
							<?=$data['t_context']?>
						</div>
					</div>
					<div class="comment_box margin_top_47" onclick="javascript:comment_view('<?=$data['t_idx']?>', '<?=$v_userid?>');">
						<span>댓글 </span><em id="rpy_cnt_<?=$data['t_idx']?>"><?=$data['t_repl']?></em>
						<div class="block comment_arrow" id="arrow_<?=$data['t_idx']?>"></div>
					</div>
				</div>
				<div class="float_right margin_bottom_10 width_75">
					<input type="button" class="text_btn_de4949 width_75 height_37" value="친구등록" onclick="<?user_check("friend_request('$data[m_userid]');");?>">
					<input type="button" class="text_btn2_ea3e3e width_75 height_37 margin_top_3" value="메세지" onclick="<?user_check("send_message('$data[m_userid]', 'send', '');");?>">
				</div>
				<div class="clear"></div>
				<div class="comment_rep_box" id="talk_comment_<?=$data['t_idx']?>">
					<!-- reply list -->
				</div>	<!-- ## comment_rep_box end ## -->
			</div>
			<div class="clear"></div>
		</div>
		<?
				}
			}else{
		?>
		<div class="list_area min_height_108">
			<div class="light_img_null">
				<img src="/images/meeting/light_null.gif">
				<div>
					토크 리스트가 없습니다.<Br>
					토트를 등록하고 새로운 인연을 만나보세요! 
				</div>
				<div class="clear"></div>
			</div>		<!-- ## light_img_null end ## -->
		</div>
		<?}?>

		

		<div class="list_pg margin_top_33">		<!-- ## 페이징 div ## -->
			<div>
				<?= $pagination_links?>
			</div>
		</div>


	</div>		<!-- ## left_main end ## -->

	<div class="right_main">
		<?=$right_menu?>
	</div>

	</div>
</div>