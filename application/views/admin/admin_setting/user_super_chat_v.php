

<script type="text/javascript">

	$(document).ready(function(){

		//검색
		$("#search_btn").click(function(){
			var sfl_val = $("select[name=sfl]").val();
			var sfl_val2 = $("select[name=sfl2]").val();
			if($("#q").val() == '' && $("#q2").val() == ''){
				alert('검색어를 입력하세요');
				return false;
			} else {
				$('#preloader').show();

				var act = '/admin/chatting/user_super_chat_log/chat_list';
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




</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>사용자 슈퍼채팅 로그</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>검색조건</strong> <!-- panel title -->
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
				<!-- 검색조건 -->
				<fieldset>
					<form name="fsearch" id="fsearch" method="post" class="form-inline" >
					<div class="form-group">
						<select name="sfl" id="sfl" class="form-control">
						<?php
							$sfl_arr = array('TotalMembers.m_userid'=>'아이디',  'TotalMembers.m_name'=>'이름', 'TotalMembers.m_nick'=>'닉네임');

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
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div id="panel_tit" class="panel-heading">
				<span class="title elipsis">
					<strong>리스트</strong> <!-- panel title -->
				</span>
				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
				</ul>
				<!-- /right options -->
			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th class="width-150">회원사진</th>
							<th class="width-150">보낸회원</th>
							<th class="width-500">보낸내용</th>
							<th class="width-400">받은회원</th>
							<th class="width-200">보낸조건</th>
							<th class="width-200">보낸날짜</th>
							<th class="width-100">구분</th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center"><?=$this->member_lib->member_thumb($data['m_userid'], 80, 80)?></td>
							<td class="text-center"><?=$data['m_userid']?><br><?=$data['m_nick']?>(<?=$data['m_age']?>세)<br><?=$this->member_lib->s_symbol($data['m_sex'])?><?=$data['m_name']?></td>
							<td class="text-center"><?=$data['V_SEND_CONTENTS']?></td>
							<td class="text-center">
								<div style="position:relative; width:400px; height:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?=$data['V_RECV_LIST']?>">
								<?=$data['V_RECV_LIST']?>
								</div>
							</td>
							<td class="text-center">
								<?
									$val = explode(',', str_replace(" ", "",$data['V_RECV_TERMS']));

									if(!empty($val[0])){ echo $val[0]."명, "; }
									if(!empty($val[1])){ echo $val[1].", "; }
									if(!empty($val[2])){ echo $val[2]."세, "; }
									if(!empty($val[3])){ echo $val[3]."세, "; }
									if(!empty($val[4])){ if($val[4] == "M"){ echo "남성"; }else{ echo "여성"; } }
								?>
							</td>
							<td class="text-center"><?=$data['V_WRITE_DATE']?></td>
							<td class="text-center">
								<? if($data['V_GUBN'] == "P"){ echo "PC"; }else if($data['V_GUBN'] == "M"){ echo "MOBILE"; }else if($data['V_GUBN'] == "A"){ echo "APP"; } ?>
							</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="7" class="text-center bold">결과가 없습니다.</td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>명</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>



