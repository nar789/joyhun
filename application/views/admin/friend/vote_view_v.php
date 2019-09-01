<script type="text/javascript">

	$(document).ready(function(){
			
		//목록 버튼 클릭시 이벤트
		$("#btn_list").click(function(){
			$(location).attr("href", "/admin/friend/vote/vote_list");
		});
		

		//수정 버튼 클릭시 이벤트
		$("#btn_write").click(function(){
			$(location).attr("href", "/admin/friend/vote/vote_write/m_code/"+<?=$m_code?>);
		});
		
	});
	
	
	
</script>

<style>
	input{border: solid 1px #D1D1D1;}
	.w80p{width:80%; text-align:center; cursor:pointer;}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>공감Poll view</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>투표내용보기</strong> <!-- panel title -->
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

			<form id="frm" name="frm" method="post">
			<input type="hidden" id="frmName" name="frmName" value="<?=$fname?>">
			<input type="hidden" id="m_code" name="m_code" value="<?=$m_code?>">

			<div class="panel-body">
				<div class="table-responsive">
					
					<table class="table table-bordered table-vertical-middle nomargin">
						<tr>
							<td width="20%" class="text-center"><b>주제</b></td>
							<td width="80%" colspan="2"><b><?=vote_title($m_code)?></b></td>
						</tr>
						<?	
							$i = 0;
							foreach($vlist as $data){
								$i += 1;
						?>
						<tr>
							<td width="20%" class="text-center">보기<?=$i?></td>
							<td width="60%"><?=vote_poll_view($m_code, $data['idx'])?></td>
							<td width="20%" class="text-center"><?=$data['per']?>% (<?=${"totalnum".$i}?>)</td>
						</tr>
						<?
							}
						?>
					</table>
					
				</div>
				
				
				<div class="table-responsive" style="margin-top:30px;">
					<span class="title elipsis">
						<strong>리플</strong> <!-- panel title -->
					</span>
					<table class="table table-bordered table-vertical-middle nomargin">
						<?
							if($getTotalData > 0){
								foreach($rlist as $data){
						?>
						<tr>
							<td class="width-100"><nobr><?=$data['m_userid']?></nobr></td>
							<td><nobr><?=$data['m_reply']?></nobr></td>
							<td class="width-200"><nobr><?=$data['m_write_day']?></nobr></td>
							<td class="width-100"><nobr><a href="/admin/friend/vote/rp_del/m_code/<?=$data['m_code']?>" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a></nobr></td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center"><nobr><b>등록된 댓글이 없습니다.</b></nobr></td>
						</tr>
						<?
							}
						?>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
				

				<div style="position:relative; width:100%; height:50px; margin-top:20px; text-align:center;">
					<button type="button" class="btn btn-success" id="btn_list" name="btn_list"><i class="fa fa-list"></i><b>목록</b></button>
					&nbsp;&nbsp;
					<button type="button" class="btn btn-danger" id="btn_write" name="btn_write"><i class="fa fa-save"></i><b>수정</b></button>					
				</div>

			</div>
			
			</form>


	</div>

</section>