		<div class="layout_padding">
			<span><b>본인에 맞게 수정하시면 <br>채팅&미팅 성공률이 더~욱 높아집니다.</b></span>
			<div class="login_pop_content" style="margin-top:5px;">
				
				<div class="log_pop_tr">
					<div class="log_pop1_td1_m">인사말	</div>
					<div class="log_pop1_td2_m">
						<input type="hidden" id="m_reason" name="m_reason" value="<?=$m_reason?>">
						<input type="hidden" id="m_character" name="m_character" value="<?=$m_character?>">
						<textarea id="my_intro" name="my_intro"><?=$my_intro?></textarea>
					</div>
				</div>
			</div>
			<div class="text-center">
				<input type="button" id="modal_myinfo_submit" class="log_pop_sub" value="완료"/>
			</div>

		</div>


<script>

	$(document).ready(function(){  

		$("#modal_myinfo_submit").click(function(){
			if($("#my_intro").val() == ''){
				alert("인사말을 입력해주세요.");
				return false;
			}
		});
	});

</script>