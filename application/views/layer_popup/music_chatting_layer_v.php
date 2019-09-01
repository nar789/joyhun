<div class="layout_padding">
	<div class="alarm_chat_area">
	
		<div class="margin_top_10">
			<div class="contents_box">
				<div class="member_thumb">
					<?=$this->member_lib->member_thumb($m_data['m_userid'], 123, 124)?>
				</div>
				<div class="sub_contents">
					<p style="padding-left:10px;">
						<span style="font-size:1.2em;"><?=$m_data['m_nick']?></span>
						<span style="color:#999999;"><?=$m_data['m_conregion']?> /</span>
						<span style="color:#999999;"><?=$m_data['m_conregion2']?> /</span>
						<span style="color:#999999;"><?=$m_data['m_age']?>세</span>
					</p>
					<div style="position:absolute; width:271px; height:60px; top:40px; background-color:#FCFCFC;">
						<p style="padding-left:10px; line-height:20px; color:#8C8C8C;">
							· 음악채팅을 신청하시고 즐거운 채팅 즐기세요.<br>
							· 음악채팅을 처음 이용시 안내에 따라 설치해 주시기 바랍니다.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="margin_top_19 text-center padding_bottom_10">
		<input type="button" class="text_btn_de4949 alarm_chat_btn" value="음악채팅 입장하기" onclick="javascript:<?=user_check("music_chat_run();", 9);?>" style="width:120px;">
	</div>
</div>

<script type="text/javascript">

	//음악채팅 레이어팝업 탑이 이미지라서 예외로 집어넣음
	$(document).ready(function(){
		$(".modal_pop_title").empty();
		$(".modal_pop_title").html("<img src='/images/layer_popup/music_top.png'>");;
		$(".modal_pop_title").height('107');
		$(".modal_pop_title").append("<div style='position:absolute; top:3px; left:435px;'><img src='/images/layer_popup/exit_btn.png' onclick='javascript:modal.close();' style='cursor:pointer'></div>")
	});

</script>

<style>
.contents_box{position:relative; width:420px; height:125px;}
.contents_box .member_thumb{position:relative; width:123px; height:124px;}
.contents_box .sub_contents{position:absolute; width:297px; height:114px; top:0px; left:123px; padding-top:10px; padding-left:10px;}
</style>
