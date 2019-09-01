

<!-- 
	MIDDLE 
-->

<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<h1>광고, 사업제휴문의</h1>
	</header>
	<!-- /page title -->

	
	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>광고, 사업제휴문의</strong> <!-- panel title -->
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

				<div class="row">
					<div class="form-group">
						<div class="form-group col-md-6 col-sm-12 form-inline">
							<div class="margin-bottom-6">
								카테고리&nbsp;
								<input type="text" class="form-control required" value="<?=$bu['bu_cate']?>" readonly>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label>이름</label>
							<div class="margin-bottom-6"><input type="text" class="form-control required" value="<?=$bu['bu_name']?>" readonly></div>
						</div>
						<div class="col-md-6">
							<label>회사명</label>
							<div class="margin-bottom-6"><input type="text" class="form-control required" value="<?=$bu['bu_company']?>" readonly></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label>연락처</label>
							<div class="margin-bottom-6"><input type="text" class="form-control required" value="<?=$bu['bu_phone']?>" readonly></div>
						</div>
						<div class="col-md-6">
							<label>이메일</label>이메일
							<div class="margin-bottom-6"><input type="text" class="form-control required" value="<?=$bu['bu_email']?>" readonly></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label>회사소개</label>
							<textarea name="n_content" id="n_content" rows="8" class="form-control required warning" readonly><?=$bu['bu_info']?></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="col-md-12">
							<label>문의내용</label>
							<textarea name="n_content" id="n_content" rows="8" class="form-control required warning" readonly><?=$bu['bu_content']?></textarea>
						</div>
					</div>
				</div>

				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-info btn-lg" id="notice_list" onclick="location.href='/admin/service_center/business/business_list/page/<?=$page?>'">목록</button>
				</div>
			</div>
			<!-- /panel content -->
		</form>
	</fieldset>
	<!-- /PANEL -->

	</div>
</div>
</section>
<!-- /MIDDLE -->

