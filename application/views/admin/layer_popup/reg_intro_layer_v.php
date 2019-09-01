
<div class="lightbox-ajax">

	<!-- title -->
	<h4>인사말 등록</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="intro_ajax" name="intro_ajax" method="post" class="validate">
		<input type="hidden" id="v_idx" name="v_idx" value="<?=@$V_IDX?>">
		<div style="position:relative; width:100%; height:230px;">
			<div class="row">
				<div class="form-group">
					<div class="col-md-4 col-sm-4">
						<label>구분값</label>
						<select id="v_code" name="v_code" class="form-control required">
							<option value="">- 선택 -</option>
							<option value="intro" <? if($V_CODE == "intro"){ echo "selected"; } ?> >- 인사말 -</option>
						</select>
					</div>
					<div class="col-md-4 col-sm-4">
						<label>성별</label>
						<select id="v_sex" name="v_sex" class="form-control required">
							<option value="">- 선택 -</option>
							<option value="A" <? if($V_SEX == "A"){ echo "selected"; } ?> >- 전체 -</option>
							<option value="M" <? if($V_SEX == "M"){ echo "selected"; } ?> >- 남성 -</option>
							<option value="F" <? if($V_SEX == "F"){ echo "selected"; } ?> >- 여성 -</option>
						</select>
					</div>
					<div class="col-md-4 col-sm-4">
						<label>사용여부</label>
						<select id="v_use_yn" name="v_use_yn" class="form-control required">
							<option value="">- 선택 -</option>
							<option value="Y" <? if($V_USE_YN == "Y"){ echo "selected"; } ?> >- 사용 -</option>
							<option value="N" <? if($V_USE_YN == "N"){ echo "selected"; } ?> >- 사용안함 -</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12">
						<label>내용</label>
						<input type="text" id="v_text" name="v_text" value="<?=$V_TEXT?>" class="form-control required">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">	
						<input type="button" id="intro_btn" name="intro_btn" value="저장" class="btn btn-success" style="width:80px;" onclick="javascript:reg_intro_func();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>