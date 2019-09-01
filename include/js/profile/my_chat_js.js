$(document).ready(function(){
	
	$("#alrim_save_btn").click(function(){
		
		if(confirm("알림 설정을 변경하시겠습니까?") == true){
			
			$.ajax({

				type : "post",
				url : "/profile/my_alarm/alarm_set",
				data : {
					//"m_chat_1"      : $("input[id='m_chat_1']:checked").val(),
					//"m_chat_2"      : $("input[id='m_chat_2']:checked").val(),
					"m_propose_1"   : $("input[id='m_propose_1']:checked").val(),
					"m_propose_2"   : $("input[id='m_propose_2']:checked").val(),
					"m_meeting_1"   : $("input[id='m_meeting_1']:checked").val(),
					"m_meeting_2"   : $("input[id='m_meeting_2']:checked").val(),
					"m_beongae_1"   : $("input[id='m_beongae_1']:checked").val(),
					"m_beongae_2"   : $("input[id='m_beongae_2']:checked").val(),
					"m_jjack_1"     : $("input[id='m_jjack_1']:checked").val(),
					"m_jjack_2"     : $("input[id='m_jjack_2']:checked").val(),
					"m_jjim_1"      : $("input[id='m_jjim_1']:checked").val(),
					"m_jjim_2"      : $("input[id='m_jjim_2']:checked").val(),
					"m_reg_f1_1"    : $("input[id='m_reg_f1_1']:checked").val(),
					"m_reg_f1_2"    : $("input[id='m_reg_f1_2']:checked").val(),
					"m_reg_f2_1"    : $("input[id='m_reg_f2_1']:checked").val(),
					"m_reg_f2_2"    : $("input[id='m_reg_f2_2']:checked").val(),
					"m_f_profile_1" : $("input[id='m_f_profile_1']:checked").val(),
					"m_f_profile_2" : $("input[id='m_f_profile_2']:checked").val(),
					"m_f_meeting_1" : $("input[id='m_f_meeting_1']:checked").val(),
					"m_f_meeting_2" : $("input[id='m_f_meeting_2']:checked").val(),
					"m_f_beongae_1" : $("input[id='m_f_beongae_1']:checked").val(),
					"m_f_beongae_2" : $("input[id='m_f_beongae_2']:checked").val(),
					"m_reg_anne_1"  : $("input[id='m_reg_anne_1']:checked").val(),
					"m_reg_anne_2"  : $("input[id='m_reg_anne_2']:checked").val(),
					"m_to_anne_1"   : $("input[id='m_to_anne_1']:checked").val(),
					"m_to_anne_2"   : $("input[id='m_to_anne_2']:checked").val()
				},
				cache : false,
				async : false,
				success : function(result){
					
					alert("알림 설정이 변경되었습니다.");
					location.reload();

					/*if(result == "1"){
						alert("알림 설정이 변경되었습니다.");
						$(location).reload();
					}else{
						alert("알림 설정 변경에 실패했습니다. ("+result+")");
					}*/
				},
				error : function(result){
					alert("실패 ("+result+")");
				}

			});

		}

	});
});

var tmp_page = "";

//채팅함 내용 AJAX 호출
function get_chatting_data(page){

	tmp_page = page;

	$.get('/profile/my_chat/ajax_chatting_list/page/'+page + '/'+Math.random(), function(data){
		$("#chat_list_div")[0].innerHTML = data;
	});		

}