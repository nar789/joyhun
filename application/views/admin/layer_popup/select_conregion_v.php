
<div class="lightbox-ajax">

	<!-- title -->
	<h4>선택지역 선택</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">
		
		<form id="point_ajax" name="point_ajax" method="post" class="validate">
		<div style="position:relative; width:100%; height:230px;">
			
			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">
						<label><b>- 선택지역 -</b></label>
						<div style="position:relatlive; width:100%; font-weight:bold;">
							<input type="hidden" id="user_id" name="user_id" value="<?=$user_id?>">
							<table cellspacing=0 cellpadding=0 style="border:solid 1px #D2D2D2; width:80%; margin:auto;">
								<tr height="50">
									<td>
										서울&nbsp;&nbsp;<input type="checkbox" id="chk_1" name="chk_1" value="서울" style="vertical-align:-1px;" <? if(@$chk_1 == "서울"){ echo "checked"; }?> >&nbsp;&nbsp;
										인천&nbsp;&nbsp;<input type="checkbox" id="chk_2" name="chk_2" value="인천" style="vertical-align:-1px;" <? if(@$chk_2 == "인천"){ echo "checked"; }?> >&nbsp;&nbsp;
										부산&nbsp;&nbsp;<input type="checkbox" id="chk_3" name="chk_3" value="부산" style="vertical-align:-1px;" <? if(@$chk_3 == "부산"){ echo "checked"; }?> >&nbsp;&nbsp;
										대구&nbsp;&nbsp;<input type="checkbox" id="chk_4" name="chk_4" value="대구" style="vertical-align:-1px;" <? if(@$chk_4 == "대구"){ echo "checked"; }?> >&nbsp;&nbsp;
										대전&nbsp;&nbsp;<input type="checkbox" id="chk_5" name="chk_5" value="대전" style="vertical-align:-1px;" <? if(@$chk_5 == "대전"){ echo "checked"; }?> >&nbsp;&nbsp;
										광주&nbsp;&nbsp;<input type="checkbox" id="chk_6" name="chk_6" value="광주" style="vertical-align:-1px;" <? if(@$chk_6 == "광주"){ echo "checked"; }?> >&nbsp;&nbsp;
										울산&nbsp;&nbsp;<input type="checkbox" id="chk_7" name="chk_7" value="울산" style="vertical-align:-1px;" <? if(@$chk_7 == "울산"){ echo "checked"; }?> >&nbsp;&nbsp;
										경기&nbsp;&nbsp;<input type="checkbox" id="chk_8" name="chk_8" value="경기" style="vertical-align:-1px;" <? if(@$chk_8 == "경기"){ echo "checked"; }?> >&nbsp;&nbsp;
									</td>
								</tr>
								<tr height="50">
									<td>
										강원&nbsp;&nbsp;<input type="checkbox" id="chk_9" name="chk_9" value="강원" style="vertical-align:-1px;" <? if(@$chk_9 == "강원"){ echo "checked"; }?> >&nbsp;&nbsp;
										충남&nbsp;&nbsp;<input type="checkbox" id="chk_10" name="chk_10" value="충남" style="vertical-align:-1px;" <? if(@$chk_10 == "충남"){ echo "checked"; }?> >&nbsp;&nbsp;
										충북&nbsp;&nbsp;<input type="checkbox" id="chk_11" name="chk_11" value="충북" style="vertical-align:-1px;" <? if(@$chk_11 == "충북"){ echo "checked"; }?> >&nbsp;&nbsp;
										경남&nbsp;&nbsp;<input type="checkbox" id="chk_12" name="chk_12" value="경남" style="vertical-align:-1px;" <? if(@$chk_12 == "경남"){ echo "checked"; }?> >&nbsp;&nbsp;
										경북&nbsp;&nbsp;<input type="checkbox" id="chk_13" name="chk_13" value="경북" style="vertical-align:-1px;" <? if(@$chk_13 == "경북"){ echo "checked"; }?> >&nbsp;&nbsp;
										전남&nbsp;&nbsp;<input type="checkbox" id="chk_14" name="chk_14" value="전남" style="vertical-align:-1px;" <? if(@$chk_14 == "전남"){ echo "checked"; }?> >&nbsp;&nbsp;
										전북&nbsp;&nbsp;<input type="checkbox" id="chk_15" name="chk_15" value="전북" style="vertical-align:-1px;" <? if(@$chk_15 == "전북"){ echo "checked"; }?> >&nbsp;&nbsp;
										제주&nbsp;&nbsp;<input type="checkbox" id="chk_16" name="chk_16" value="제주" style="vertical-align:-1px;" <? if(@$chk_16 == "제주"){ echo "checked"; }?> >&nbsp;&nbsp;
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12" style="text-align:center;">	
						<input type="button" id="point_btn" name="point_btn" value="저장" class="btn btn-success" style="width:80px;" onclick="javascript:sel_conregion_click();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>