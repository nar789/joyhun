
<div class="lightbox-ajax">

	<!-- title -->
	<h4>당첨자 발표</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="stamp_ajax" name="stamp_ajax" method="post" class="validate">
		<div style="position:relative; width:100%; height:150px;">

			<div class="row">
				<div class="form-group" style="text-align:center;">
					<div class="col-md-12 col-sm-12">
						<label>추첨인원수</label>
						<input type="hidden" id="idx" name="idx" value="<?=$idx?>">
						<input type="text" id="win_member_cnt" name="win_member_cnt" value="20" class="form-control required text-center">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">	
						<input type="button" id="stamp_btn" name="stamp_btn" value="추첨" class="btn btn-success" style="width:80px;" onclick="javascript:call_win_member_fnc();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>