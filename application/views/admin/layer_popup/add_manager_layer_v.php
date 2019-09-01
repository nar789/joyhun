
<div class="lightbox-ajax">

	<!-- title -->
	<h4>관리자 등록</h4>
	
	<!-- body -->
	<div class="lightbox-ajax-body">

		<form id="point_ajax" name="point_ajax" method="post" class="validate">
		<div style="position:relative; width:100%; height:230px;">
			<div class="row">
				<div class="form-group">
					<div class="col-md-3 col-sm-3">
						<label>권한</label>
						<select style="float:left;width:100%;" class="form-control" id="auth_code" name="auth_code">
							<option value="">선택하세요.</option>
							<? for ($i=1; $i<11; $i++){?>
							<option value="<?=$i?>" <? if (@$user['auth_code'] == $i && $chk){?>selected<?}?>><?=$i?></option>
							<?}?>
						</select>
					</div>
					<div class="col-md-3 col-sm-3">
						<label>아이디</label>
						<input type="text" id="userid" name="userid" value="<? if ($chk){ echo $user['userid']; }?>" class="form-control required">
					</div>
					<div class="col-md-3 col-sm-3">
						<label>이름</label>
						<input type="text" id="username" name="username" value="<? if ($chk){ echo $user['username']; }?>" class="form-control required">
					</div>
					<div class="col-md-3 col-sm-3">
						<label>닉네임</label>
						<input type="text" id="nickname" name="nickname" value="<? if ($chk){ echo $user['nickname']; }?>" class="form-control required">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12">
						<label>비밀번호</label>
						<input type="password" id="pawd" name="pawd" value="" class="form-control required">
					</div>
				</div>
			</div>
			
			<!-- 수정이면 -->
			<? if($chk){?><input type="hidden" id="modi" value="<?=$user['userid']?>"><?}?>

			<div class="row">
				<div class="form-group">
					<div class="col-md-12 col-sm-12 text-center">	
						<input type="button" id="point_btn" name="point_btn" value="<? if($chk){ ?>수정<?}else{?>저장<?}?>" class="btn btn-success" style="width:80px;" onclick="javascript:manager_add();">
					</div>
				</div>
			</div>

		</div>
		</form>

	</div>
	<!-- /body -->

</div>