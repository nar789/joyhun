		<div class="layout_padding">
			<div class="login_pop_content">
				<div class="log_pop_tr">
					<div class="log_pop1_td1">원하는 만남</div>
					<div class="log_pop1_td2">
						<select name="m_reason" id="m_reason">
						<? 
							$arr = want_reason_data("all");
							foreach ($arr as $key => $value) {
						?>
								<option value="<?=$key?>"><?=$value?></option>
						<? } ?>
						</select>
					</div>
				</div>
				<div class="log_pop_tr">
					<div class="log_pop1_td1">대화 스타일</div>
					<div class="log_pop1_td2">
						<select name="m_character" id="m_character">
						<? 
							$arr = talk_style_data("all", $this->session->userdata('m_sex'));
							foreach ($arr as $key => $value) {
						?>
							<option value="<?=$key?>"><?=$value?></option>
						<? } ?>
						</select>				
					</div>
				</div>
				<div class="log_pop_tr">
					<div class="log_pop2_td1">인사말</div>
					<div class="log_pop2_td2">
						<textarea id="my_intro" name="my_intro"><?=$my_intro?></textarea>
					</div>
				</div>
			</div>
			<div class="text-center">
				<input type="button" id="modal_myinfo_submit" class="log_pop_sub" value="완료"/>
			</div>

		</div>


<script>
	$("#m_reason").val("<?=$m_reason?>").attr("selected", "selected");
	$("#m_character").val("<?=$m_character?>").attr("selected", "selected");

	$(document).ready(function(){  

		$("#modal_myinfo_submit").click(function(){
			if($("#my_intro").val() == ''){
				alert("인사말을 입력해주세요.");
				return false;
			}
		});
	});

</script>