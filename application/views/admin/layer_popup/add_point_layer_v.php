
<div class="lightbox-ajax">

	<!-- title -->
	<h4>포인트 지급</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="point_ajax" name="point_ajax" method="post" class="validate">
		<div style="position:relative; width:100%; height:230px;">
			<div class="row">
				<div class="form-group">
					<div class="col-md-6 col-sm-6">
						<label>회원아이디</label>
						<input type="text" id="m_userid" name="m_userid" value="<?=@$m_userid?>" class="form-control required">
					</div>
					<div class="col-md-6 col-sm-6">
						<label>지급포인트</label>
						<input type="text" id="m_point" name="m_point" value="" class="form-control required">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12">
						<label>지급 내용</label>
						<input type="text" id="m_etc" name="m_etc" value="" class="form-control required">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">	
						<input type="button" id="point_btn" name="point_btn" value="저장" class="btn btn-success" style="width:80px;" onclick="javascript:point_provide();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>

