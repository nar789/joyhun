
<div class="lightbox-ajax">

	<!-- title -->
	<h4>처벌하기</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="point_ajax" name="point_ajax" method="post" class="validate">
		<div style="position:relative; width:100%; height:230px;">
			<div class="row">
				<div class="form-group">
					<div class="col-md-4">
						<label>처벌대상 아이디</label>
						<input type="text" id="m_userid" name="m_userid" value="<?=@$user_id?>" class="form-control required">
					</div>
					<div class="col-md-4">
						<label>처벌사유</label>
						<select class="form-control" id="comp_cate">
							<option value="" selected>선택</option>
							<option value="1">욕설</option>
							<option value="2">음담패설</option>
							<option value="3">음란사진등록</option>
							<option value="4">불량게시물</option>
							<option value="5">개인정보 도용</option>
							<option value="6">불건전이용</option>
							<option value="7">현금거래</option>
							<option value="8">운영자사칭</option>
							<option value="9">기타</option>
							<option value="10">불법광고 타사이트 홍보</option>
						</select>
					</div>
					<div class="col-md-4">
						<label>처벌분류</label>
						<select class="form-control" id="punish_card">
							<option value="">선택</option>
							<option value="1">경고</option>
							<option value="2">화이트카드(12시간)</option>
							<option value="3">옐로카드(24시간)</option>
							<option value="4">레드카드(3일)</option>
							<option value="5">블랙카드(영구정지)</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12">
						<label>처벌 내용</label>
						<textarea rows="4" id="comp_content" name="comp_content" class="form-control required"></textarea>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">

						<div style="position:absolute; width:300px; height:40px; top:0px; left:18px; text-align:left;">
							아이피 차단 <input type="checkbox" id="set_ip_block" name="set_ip_block" value="ip" style="vertical-align:-1px; margin-left:5px; cursor:pointer;">
							&nbsp;&nbsp;&nbsp;&nbsp;
							휴대전화번호 차단<input type="checkbox" id="set_hp_block" name="set_hp_block" value="hp" style="vertical-align:-1px; margin-left:5px; cursor:pointer;">
						</div>

						<input type="button" id="punish_btn" name="punish_btn" value="저장" class="btn btn-success" style="width:80px;" onclick="javascript:punish_add();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>
