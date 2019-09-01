
	function chat_request(user_id, gubn){

		$.get('/chat/chat_request/user_id/'+encodeURIComponent(user_id)+'/gubn/'+encodeURIComponent(gubn)+'/'+Math.random(), function(data){

			if(data == "error"){
				alert("동성간의 채팅은 불가능합니다.");
				return;
			}else if(data == "alreay_chat"){
				if(confirm("이미 채팅중인 회원입니다.\n채팅창으로 이동하시겠습니까?") == true){
					$(location).attr("href", "/chat/chatting/"+user_id);
				}else{
					modal.close();
				}
			}else if(data == "ban"){
				alert("이미 채팅신청을 한 회원입니다.\n채팅수락 대기중입니다.");
				return;
			}else if(data == "수락" || data == ""){
				$(location).attr("href", "/profile/my_chat/chatting_list");
			}else{
				modal.open({content: data, width : 320, top:15});
			}		
		});
	}


	function recv_chat_request(user_id, chat_pop_idx){
		$.get('/chat/m_recv_chat_request/user_id/'+user_id+'/chat_pop_idx/'+ chat_pop_idx + '/'+Math.random(), function(data){
			if(data == "already_chat"){
				$(location).attr("href", "/chat/chatting/"+user_id);
			}else if(data == ""){
				modal.open({content: data,width : 320, top:15});
			}else if(data == "profile"){
				$.ajax({

					type : "post",
					url : "/chat/profile_image_layer/"+Math.random(),
					data : {
						"idx"		: chat_pop_idx,
						"user_id"	: user_id
					},
					cache : false,
					async : false,
					success : function(result){
						modal.open({content: result,width : 320, top:15});
					},
					error : function(data){
						alert("실패 ("+data+")");
					}

				});
			}else{
				modal.open({content: data,width : 320, top:15});
			}			
		});
	}

	function openChatWindow(user_id){
		location.replace( "/chat/chatting/"+ user_id ,'chat_'+user_id, "fullscreen=0,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=yes,width=400,height=700;");
	}

	$(document).ready(function(){
		alrim_ajax_call(); 
		setInterval("alrim_ajax_call()", 5000); 
	});


	function alrim_ajax_call(){
	
		$.get('/chat/hook_get_alrim/'+Math.random(), function(data){
	
				if(data.length > 3){
			
				datas = {};
				$.each(data.split('|'),function(index, x) {
					var arr = x.split('=');
					arr[1] && (datas[arr[0]] = arr[1]);
				});
				
				if(datas['chat_pop_idx']){
			
					set_alrim(datas);
				}else if(datas['msg_pop_idx']){
					set_alrim(datas);
				}
				set_status(datas);
			}
		});
	}



	function set_alrim(datas){

		if(datas['chat_pop_idx']){
			recv_chat_request(datas['chat_new_userid'], datas['chat_pop_idx']);
		}else if(datas['msg_pop_idx']){
		
			msg_new_text = decodeURIComponent(datas['msg_new_text']);
			msg_new_text = msg_new_text.replace(/'/g, "\\'");


			msg_new_nick = decodeURIComponent(datas['msg_new_nick']);
			msg_new_nick = msg_new_nick.replace(/'/g, "\\'");

			$('#m_alarm_area')[0].innerHTML = 
				'<div class="m_alarm_box">' +
					'<div class="m_alarm_align pointer">' +
						'<div class="m_alarm_img now_member" onclick=openChatWindow("'+datas['msg_new_userid']+'");>' +
							decodeURIComponent(datas['msg_new_pic']) +
						'</div>' +
						'<div class="m_alarm_text_area">' +
							'<div class="m_alarm_text" onclick=openChatWindow("'+datas['msg_new_userid']+'");>' +
								'<b class="color_fff">'+msg_new_nick+'</b>' +
								'<p class="color_ccc">'+msg_new_text+'</p>' +
							'</div>' +
							'<div class="m_alarm_exit">' +
								'<img src="/images/m/mobile_alr.gif" onclick="hide_alrim();" class="pointer">' +
							'</div>' +
						'</div>' +
					'</div>' +
				'</div> ';
			show_alrim();

		}

	}



	function set_status(datas){

	
		if(datas['msg_new_cnt'] > 0 || datas['chat_new_cnt'] > 0){

			t_cnt = parseInt(datas['msg_new_cnt']) ;

			if(t_cnt > 99){t_cnt = 99;}
			
			if($('#chat_cnt').length > 0){
				$('#chat_cnt')[0].innerHTML = t_cnt;
				$('#chat_cnt').show();
			}

			reload_get_chatting_data(); 

		}else{
			$('#chat_cnt').hide();
			reload_get_chatting_data(); 
		}

	}



	function show_alrim(){
		$("#m_alarm_area").fadeIn(
			function(){ setTimeout( function(){ $("#m_alarm_area").fadeOut(); } ,2500); }
		);
	}


	function hide_alrim(){
		 $("#m_alarm_area").fadeOut(); 
	}


	function chat_accept_flg(user_id, idx){
		
		$.get('/chat/chat_accept_flg/'+Math.random(), function(flg){
			
			if(flg == "M"){
				
				$.get('/chat/m_recv_chat_ajax/user_id/'+user_id+'/idx/'+idx+'/'+Math.random(), function(data){
					if(data == "no_pay" || data == "error"){
						slide_alrim("lack_alrim", "보유하신 포인트가 부족합니다.", "2000");
					}else{
						chat_accept(user_id, idx);
					}
				});

			}else{
				

				chat_accept(user_id, idx);
			}

		});

	}



	function chat_accept(user_id, idx){

		modal.close();

		$.get('/chat/chat_accept/user_id/'+encodeURIComponent(user_id)+'/'+Math.random(), function(result){
			
	
			if(result == "1" || result == "accept"){
	
				$(location).attr("href", "/chat/chatting/"+user_id);
			}else if(result == "0"){
			
				if(confirm("보유하신 포인트가 부족합니다.\n포인트를 충전하시겠습니까?") == true){
					$(location).attr("href", "/profile/point/point_list");
				}else{
					return;
				}
			}else if(result == "10"){
				alert("상대방의 보유 포인트가 부족합니다.");
				return;
			}else{

				alert("잘못된 접근입니다.\n잠시후 다시 시도해 주시기 바랍니다. ("+result+")");
				return;
			}

		});


		//openChatWindow(user_id);
	}



	function chat_deny(user_id){

		deny_msg = $("#deny_msg").val(); 
		if(deny_msg == ""){
			deny_msg = "2";
			//alert("거절메세지를 선택해 주세요.");
			//$("#deny_msg").focus(); 
			//return;
		}

		$.get('/chat/chat_deny/user_id/'+encodeURIComponent(user_id)+'/deny_msg/'+deny_msg+'/'+Math.random());


		modal.close();
		location.reload();
	}



	function reload_get_chatting_data(){
		/* 새로고침쿼리에 대한 cpu부하가 커서 주석처리
		if (typeof tmp_page != 'undefined') {
			$.get('/profile/my_chat/ajax_chatting_list/page/'+tmp_page + '/'+Math.random(), function(data){
				$("#chat_list_div")[0].innerHTML = data;
			});	
		}
		*/
	}



	$(document).ready(function(){
		setInterval("auto_check()", 10000); 
	});


	function auto_check(){
		$.get('/chat/hook_auto_check/'+Math.random(), function(data){
		});
	}