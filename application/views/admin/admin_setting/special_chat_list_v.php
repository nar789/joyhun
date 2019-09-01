<style>
	.text_title{float:left;}
	.send_btn{width:50px; height:25px; font-size:1.0em; line-height:10px; font-weight:bold;float:left;}
	.exit_btn{width:90px; height:25px; font-size:0.9em; line-height:10px; float:left;}
	.text_box{border:solid 1px #E5E5E5; height:25px; width:200px;float:left;}
</style>

<script>
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		var sfl_val2 = $("select[name=sfl2]").val();
		if($("#q").val() == '' && $("#q2").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/admin_setting/special_chat_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});
});

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}


//메시지 전송
function send_msg(id){

		var chat_val = $("#chat_txt_"+id).val()

		$.ajax({
			
			type : "post",
			url : "/admin/admin_setting/special_chat_save",
			data : {
				"chat_val"			: encodeURIComponent(chat_val),
				"idx"		: encodeURIComponent(id),
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("저장되었습니다.");
					$("#text_title_" + id).html(chat_val);
				}else if(result == "0"){
					alert("데이터 저장에 실패했습니다. ("+ result +")");
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result +")");
				}else{
					alert("실패 ("+ result +")");
				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

}

//채팅 나가기
function exit_chat(id){

	if(confirm("해당 채팅에서 나가시겠습니까?")){

		$.ajax({
			
			type : "post",
			url : "/admin/admin_setting/special_chat_exit",
			data : {
				"idx"		: encodeURIComponent(id),
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					$("#text_title_" + id).html("(나가기 된 채팅입니다.)");
				}else if(result == "0"){
					alert("채팅 나가기에 실패했습니다. ("+ result +")");
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result +")");
				}else{
					alert("실패1 ("+ result +")");
				}
			},
			error : function(result){
				alert("실패2 ("+ result +")");
			}

		});

	}

}


</script>

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>특별회원 채팅 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">리스트</a></li>
		</ol>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>회원 검색</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>
			<div class="panel-body">
				<div style="float:left;">
				<fieldset>
					<form name="fsearch" id="fsearch" method="post" class="form-inline" >
					<div class="form-group">
						<select name="sfl" id="sfl" class="form-control">
						<?php
							$sfl_arr = array('chat.recv_id'=>'특별회원아이디',  'chat.send_id'=>'보낸아이디');

							while (list($key, $value) = each($sfl_arr))
							{
								if ($method == $key) {
									$chk = ' selected';
							} else {
								$chk = '';
							}
						?>
							<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
						<?
							}
						?>
						</select>
						<div class="input-group">
							<input type="text" name="q" value="<?=@$s_word?>" id="q" class="form-control" size="15" maxlength="20" placeholder="검색어" onkeypress="board_search_enter(document.q);">
						</div>
					</div>
					<button type="submit" class="btn btn-success" id="search_btn"><i class="fa fa-search"></i> 검색</button>
					</form>
				</fieldset>
				</div>
				<div style="float:right;">
					<button type="button" class="btn btn-info" id="search_btn" onclick="location.reload();"><i class="fa fa-spinner"></i> 새로고침</button>
				</div>
			</div>
		</div>


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->


		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>받은 채팅 리스트</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>


			<div class="panel-body">
				
				<table class="table table-bordered table-vertical-middle nomargin">
					<thead>
						<tr>
							<th class="width-100"><nobr>받은날짜</nobr></th>
							<th class="width-50"><nobr>분류</nobr></th>
							<th class="width-400" colspan="2"><nobr>보낸이</nobr></th>
							<th class="width-400" colspan="2"><nobr>받은특별아이디</nobr></th>
						</tr>
					</thead>
					<tbody>
					<? 
						if (!empty ($mlist)){

							foreach($mlist as $key => $val)
							{
								$sender = $this->member_lib->get_member($val['send_id']);		//보낸이 정보

								$search = array('m_userid' => $sender['m_userid']);
								$point = $this->my_m->row_array('member_total_point', $search);	//보낸이의 포인트

								$search = array('m_userid' => $sender['m_userid'],'m_result_code' => '0000');
								$payment = $this->my_m->row_array('payment_temp', $search, $order_filed = "m_idx", $desc = "desc", $limit = 1);	//보낸이의 결제정보

								if($val['mode'] == 'chat_req'){
									$chat_text = "(채팅신청) ".$val['contents'];
								}else{
									$chat_text = $val['contents'];
								}

								//보낸채팅이 있는가?
								$c_search['req_idx'] = $val['req_idx'];
								$c_search['mode'] = 'chat';
								$c_search['send_id'] = $val['recv_id'];
								$c_search['ex_chat_idx'] = "idx > ".$val['idx'];
								
								$send_chat = $this->my_m->row_array('chat', $c_search, 'idx', 'asc', 1);	

								//이미 나간채팅인가?
								$exit_chk = $this->my_m->row_array('chat', array('mode' => 'exit', 'req_idx' => $val['req_idx']));

					?>

						<tr>
							<td class="text-center" rowspan="3"><?=$val['reg_date']?></td>
							<td class="text-center" rowspan="3"><?if($val['mode'] == 'chat'){echo "대화";}else if($val['mode'] == 'chat_req'){echo "채팅신청";}?></td>
							<td class="width-50"><?=$this->member_lib->member_thumb($val['send_id'],68,49)?></td>
							<td>
									<b><?=$sender['m_nick']?></b> / <?=$sender['m_userid']?> / <?=$sender['m_name']?> / <?if($sender['m_sex'] == 'M'){echo "남";}else{echo "여";}?> / <?=$sender['m_age']?>
										<a class="btn btn-default btn-xs" href="/admin/admin_setting/special_chat_list/q/<?=$sender['m_userid']?>/sfl/chat.send_id">채팅내역 </a>									
									<br>
									회원가입 : <?=$sender['m_in_date']?><br>
									결제일시 : <?=@$payment['m_okdate']?><br>
									보유 포인트 :  <?=number_format(@$point['total_point']);?> / 총 로그인수 : <?=$sender['m_login_cnt']?>번
							</td>
							<td class="width-50"><?=$this->member_lib->member_thumb($val['m_userid'],68,49)?></td>
							<td>
									<?=$val['m_nick']?> / <?=$val['m_userid']?> / <?=$val['m_name']?> / <?if($val['m_sex'] == 'M'){echo "남";}else{echo "여";}?> / <?=$val['m_age']?>
										<a class="btn btn-default btn-xs" href="/admin/admin_setting/special_chat_list/q/<?=$val['m_userid']?>/sfl/chat.recv_id">채팅내역 </a>
										<a class="btn btn-default btn-xs" href="http://m.joyhunting.com/profile/my_chat/chatting_list/auto_login/<?=$val['m_userid']?>" target="_blank">로그인 </a>
									<br>
									등록 지역 : <?=$val['m_conregion']?> / <?=$val['m_conregion2']?><br>
									선택지역 : <?=$val['m_select_conregion']?>
							</td>
						</tr>
						<tr>
							<td colspan="4">받은채팅 : <?=$chat_text?></td>
						</tr>
						<tr>
							<td colspan="4">
								<span class="text_title">보낸채팅 :&nbsp;&nbsp;</span>
								<span id="text_title_<?=$val['idx']?>">
									<?	
									if(!empty($exit_chk['idx']) ){
											echo "(나가기 된 채팅입니다.)";
									}else if(@$send_chat['contents']){
											echo $send_chat['contents'];
									}else{?>
									<input type=text name="chat_txt" id="chat_txt_<?=$val['idx']?>" class="text_box form-control" >
									<input class="btn btn-success send_btn" onclick="javascript:send_msg('<?=$val['idx']?>');" type="button" value="전송">
									<input class="btn btn-default exit_btn" onclick="javascript:exit_chat('<?=$val['idx']?>');" type="button" value="채팅 나가기">
									<?}?>
								</span>
							</td>
						</tr>

					<?}
					
					}else{?>
						<tr>
							<td colspan="15"class="text-center">검색된 리스트가 없습니다.</td>
						</tr>
					<? } ?>
					</tbody>
				</table>
				<div class="padding-top-20">
					<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
					<div class="col-md-8 text-center"><?=@$pagination_links?></div>
					<div class="col-md-2"></div>
				</div>

			</div>

		</div>

	</div>

</section>