

<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>소개팅 좋아요 관리</h1>
		<ol class="breadcrumb">
			<li><a href="#">소개팅</a></li>
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
				<fieldset>
					<form name="fsearch" id="fsearch" method="post" class="form-inline" >
					<div class="form-group">
						<select name="sfl" id="sfl" class="form-control">
						<?php
							$sfl_arr = array('TotalMembers.m_userid'=>'작성자 아이디',  'TotalMembers.m_name'=>'작성자 이름', 'TotalMembers.m_nick'=>'작성자 닉네임');

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


		<div id="tmp"></div><!-- 데이터 찍어보기 용도-->

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>소개팅 좋아요 리스트</strong> <!-- panel title -->
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
							<th class="width-100"><nobr>보낸 회원사진</nobr></th>
							<th class="width-200"><nobr>보낸 회원아이디</nobr></th>
							<th colspan="4"><nobr>받은 회원</nobr></th>
							<th class="width-300"><nobr>소개팅 날짜</nobr></th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							$blind_cnt = 0;	//총 행 갯수

								if( @$getTotalData > 0 ){

									foreach(@$mlist as $data){
							?>

							<? if ($i%4 == 0){	// 배열을 4개씩 카운트 ?>
								<tr>
									<td class="text-center" rowspan="3"><nobr><?=$this->member_lib->member_thumb($mlist[$i]['b_id'],68,49);?></nobr></td>
									<td class="text-center" rowspan="3"><nobr><?=$mlist[$i]['b_id']?></nobr></td>
									<? for ($x = $blind_cnt; $x <$blind_cnt+4; $x++){	//회원 아이디 배열에서 4번째까지 반복(회원당 4명의 회원 소개팅) ?>
									<td class="text-center"><nobr><?=$mlist[$x]['b_mb']?></nobr></td>
									<? } ?>
									<td class="text-center" rowspan="3"><nobr><?=$data['b_today']?></nobr></td>
								</tr>
								<tr>
									<? for ($x = $blind_cnt; $x <$blind_cnt+4; $x++){	//회원 사진 배열에서 4번째까지 반복(회원당 4명의 회원 소개팅) ?>
									<td class="text-center"><nobr><?=$this->member_lib->member_thumb($mlist[$x]['b_mb'],68,49)?></nobr></td>
									<? } ?>
								</tr>
								<tr>
									<? for ($x = $blind_cnt; $x <$blind_cnt+4; $x++){ //좋아요카운트 배열에서 4번째까지 반복(회원당 4명의 회원 소개팅) ?>
									<td class="text-center"><nobr><? if ( $together[$i] == $mlist[$x]['b_mb'] ){ echo "서로 좋아요"; }else{ echo "X"; }?> / <? if ( $good[$i] == $mlist[$x]['b_mb'] ){ echo "보낸 좋아요"; }else{ echo "X"; }?></nobr></td>
									<? } $blind_cnt = $blind_cnt+4;	//다음줄을 위해 4증가?>
								</tr>

							<?
							}
								$i++;
								}
							}else{
							?>
							<tr>
								<td colspan="7" style="text-align:center">검색결과가 없습니다.</td>
							</tr>
							<?}?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$blind_total)?> &nbsp;</span>명</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>