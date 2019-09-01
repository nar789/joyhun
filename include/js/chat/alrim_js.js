	var alrim_area = 0;  
	var z_index = 2;
	
	
	function alrim_close(obj,num){
		$(obj+num).fadeOut( "slow", function(){open_status(obj);});
	}


	function alrim_close2(obj,num){
		$(obj+num).hide(function(){open_status(obj);});
	}


	function open_alrim(obj){
		var num = 1;  //테스트
		z_index = z_index + 1;
		$(obj + num).fadeIn( "slow");
		$(obj + num).animate({bottom:0},800,function(){ setTimeout( function(){alrim_close(obj , num);} ,5000); } );
		$(obj + num).css({ zIndex:z_index});
	}
	

	function open_status(obj){		
		if($(obj + "_status").css("display") == "none"){

			bottom_area = alrim_area * 43;
			alrim_area = alrim_area + 1;

			//상태창 보이기
			$(obj + "_status").css({ bottom:bottom_area + "px"});
			$(obj + "_status").fadeIn( "slow");
		}
	}



	function open_alrim_list(obj){
		$(obj + "_list").show();
		if(obj == "#chat_alrim"){
			chat_list_data_call();
		}else if(obj == "#msg_alrim"){
			msg_list_data_call();
		}else if(obj == "#joy_alrim"){
			joy_list_data_call();
		}

	}



	function chat_layer_close(obj){
		$(obj).hide();
	}
	


	function chat_request(user_id){

		$.ajax({

			type : "post",
			url : "/chat/chat_request",
			data : {
				"user_id"		: decodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "error"){
					alert("동성과는 채팅이 불가능합니다.");
					return;
				}else if(result == "alreay_chat"){
					modal.close();
					openChatWindow(user_id);
				}else if(result == "ban"){
					alert("이미 채팅신청을 한 회원입니다.\n채팅수락 대기중입니다.");
					return;
				}else if(result == "수락" || result == ""){
					$(location).attr("href", "/profile/my_chat/chatting_list");
				}else{
					modal.open({content: result, width : 460});			
				}

			},
			error : function(result){
				alert("실패");
			}

		});
		
		
	}



	$(document).ready(function(){
		write_alrim_list();
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
				
				if(datas['chat_pop_idx'] || datas['msg_pop_idx'] || datas['joy_pop_idx']){
				
					set_alrim(datas);
					set_status(datas);
				}else{
				
					set_status(datas);
					if(datas['chat_new_cnt'] > 0){open_status('#chat_alrim');}
					if(datas['msg_new_cnt'] > 0){open_status('#msg_alrim');}
					if(datas['joy_new_cnt'] > 0){open_status('#joy_alrim');}
				}
			}
		});
	}



	function set_alrim(datas){
		if(datas['chat_pop_idx']){

			chat_new_text = decodeURIComponent(datas['chat_new_text']);
			chat_new_text = chat_new_text.replace(/'/g, "\\'");

			$('#alrim_wrap')[0].innerHTML = 
			'<div class="alarm_area" id="chat_alrim1">' +
				'<div class="alarm_top_area bg_e15148">' +
					'<div class="float_left">' +
						'<p class="alarm_title">채팅신청 수락</p>' +
					'</div>' +
					'<div class="float_right">' +
						'<a href="javascript:alrim_close2(\'#chat_alrim\',1);"><img src="/images/alert_exit_btn.png" class="block"></a>' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
				'<div class="alarm_content_area width_auto">' +
					'<div class="alarm_content_box">' +
						'<p class="color_666 font-size_12">' +
							'<b class="color_333 font-size_12 font_900"><span class="border_bottom_1_333">'+decodeURIComponent(datas['chat_new_nick'])+'</span>님</b>이 채팅신청을 하였습니다.' +
						'</p>' +
						'<div class="width_85 block ver_top margin_top_9">' +
							decodeURIComponent(datas['chat_new_pic']) +
						'</div>' +
						'<div class="block margin_top_9">' +
							'<textarea class="chat_view" readonly>'+chat_new_text+'</textarea>' +
						'</div>' +
						'<div class="margin_top_6 text-center alrim_buttons">' +
							'<input type="button" class="text_btn_de4949 alarm_chatting_btn" value="수락" onclick=chat_accept_flg("'+datas['chat_new_userid']+'");>' +
							'<input type="button" class="text_btn_ea3e3e alarm_chatting_btn" value="거절" onclick=chat_deny("'+datas['chat_new_userid']+'");>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>';
			open_alrim('#chat_alrim'); 

			chat_accept_flg(datas['chat_new_userid']);	

		}else	if(datas['msg_pop_idx']){

			if(localStorage.getItem("chat_" + datas['msg_new_userid']) != "true"){


				msg_new_nick = decodeURIComponent(datas['msg_new_nick']);
				msg_new_nick = msg_new_nick.replace(/'/g, "\\'");


				msg_new_text = decodeURIComponent(datas['msg_new_text']);
				msg_new_text = msg_new_text.replace(/'/g, "\\'");

				$('#alrim_wrap')[0].innerHTML = 
				'<div class="alarm_area" id="msg_alrim1">' +
					'<div class="alarm_top_area bg_8ab933">' +
						'<div class="float_left">' +
							'<p class="alarm_title">메시지 도착알림</p>' +
						'</div>' +
						'<div class="float_right">' +
							'<a href="javascript:alrim_close2(\'#msg_alrim\',1);"><img src="/images/alert_exit_btn.png" class="block"></a>' +
						'</div>' +
						'<div class="clear"></div>' +
					'</div>' +
					'<div class="alarm_content_area width_auto">' +
						'<div class="alarm_content_box">' +
							'<div class="width_85 height_73 block ver_top">' +
								decodeURIComponent(datas['msg_new_pic']) +
							'</div>' +
							'<div class="alarm_text width_175">' +
								'<b class="color_333 font-size_12 font_900"><span class="border_bottom_1_333 pointer" onclick=openChatWindow("'+datas['msg_new_userid']+'");>'+cutStr(msg_new_text,80)+'</span></b>' +
								'<p class="color_666 font-size_12 margin_top_8 pointer" onclick=openChatWindow("'+datas['msg_new_userid']+'");>' +
									msg_new_nick +'님으로부터 메시지가 <br> 도착했습니다.' +
								'</p>' +
							'</div>' +
						'</div>' +
					'</div>' +
				'</div>';

				open_alrim('#msg_alrim'); 

			}

		}else if(datas['joy_pop_idx']){

				joy_new_nick = decodeURIComponent(datas['joy_new_nick']);
				joy_new_nick = joy_new_nick.replace(/'/g, "\\'");


				joy_new_text = decodeURIComponent(datas['joy_new_text']);
				joy_new_text = joy_new_text.replace(/'/g, "\\'");

				chat_buff = 
				'<div class="alarm_area" id="joy_alrim1">' +
					'<div class="alarm_top_area bg_5bc0de">' +
						'<div class="float_left">' +
							'<p class="alarm_title">조이헌팅 알림</p>' +
						'</div>' +
						'<div class="float_right">' +
							'<a href="javascript:alrim_close2(\'#joy_alrim\',1);"><img src="/images/alert_exit_btn.png" class="block"></a>' +
						'</div>' +
						'<div class="clear"></div>' +
					'</div>' +
					'<div class="alarm_content_area width_auto">' +
						'<div class="alarm_content_box">';
							if(datas['joy_new_pic']){ 
							chat_buff +=
							'<div class="width_85 height_73 block ver_top">' +
								decodeURIComponent(datas['joy_new_pic']) +
							'</div>';
							}
							if(datas['joy_new_pic']){d_width = "width_175";}else{d_width = "width_248 height_73";} 
							chat_buff +=
							'<div class="alarm_text '+d_width+'">' +								
								'<p class="color_666 font-size_12 margin_top_8 pointer" onclick=go_msg_alrim("'+decodeURIComponent(datas['joy_pop_url'])+'");>' +
									joy_new_text +
								'</p>';
								if(datas['event_btn_text']){ 
									chat_buff +=
									'<p><input type="button" class="text_btn_dcdcdc alarm_jjim_btn" value="'+decodeURIComponent(datas['event_btn_text'])+'" onclick=go_msg_alrim("'+decodeURIComponent(datas['joy_pop_url'])+'");></p>';
								}
								chat_buff +=
							'</div>' +
						'</div>' +
					'</div>' +
				'</div>';

				$('#alrim_wrap')[0].innerHTML = chat_buff;

				open_alrim('#joy_alrim'); 

		}

	}


	function set_status(datas){


		if(datas['chat_new_cnt'] > 0){


			if(datas['chat_new_text'] == undefined){datas['chat_new_text'] = "";}
			chat_new_text = decodeURIComponent(datas['chat_new_text']);
			chat_new_text = chat_new_text.replace(/'/g, "\\'");

			if(datas['chat_new_cnt'] > 99){datas['chat_new_cnt'] = 99;}

			if($("#chat_alrim_status").length == 0){

				add_style = "";
			}else{

				var b = $("#chat_alrim_status").css('bottom');
				add_style = "style='display:block;bottom:"+b+"';";
			}

			$('#alrim_chat_status_wrap')[0].innerHTML = 
			'<div class="alarm_area2" id="chat_alrim_status" '+add_style+'>' +
				'<div class="alarm_small_list bg_e15148" onclick=open_alrim_list("#chat_alrim");>' +
					'<span class="alarm_small_title">채팅신청 수락</span>' +
					'<div class="alarm_cnt" id="chat_status_cnt">'+datas['chat_new_cnt']+'</div>' +
					'<span class="alarm_small_text"  id="chat_status_text">'+cutStr(chat_new_text,30)+'</span>' +
				'</div>' +
			'</div>';

			$('#chat_list_cnt')[0].innerHTML = datas['chat_new_cnt'];

			if($("#chat_alrim_list").css("display") == "block"){
				chat_list_data_call();
			}

		}else{

			if($("#chat_alrim_status").length != 0){
				$('#chat_status_cnt')[0].innerHTML = 0;
				$('#chat_list_cnt')[0].innerHTML = 0;
				$('#chat_status_text')[0].innerHTML = "";
			}
		}


		if(datas['msg_new_cnt'] > 0){
			if(datas['msg_new_text'] == undefined){datas['msg_new_text'] = "";}
			msg_new_text = decodeURIComponent(datas['msg_new_text']);
			msg_new_text = msg_new_text.replace(/'/g, "\\'");

			if(datas['msg_new_cnt'] > 99){datas['msg_new_cnt'] = 99;}

			if($("#msg_alrim_status").length == 0){
				add_style = "";
			}else{
				var b = $("#msg_alrim_status").css('bottom');
				add_style = "style='display:block;bottom:"+b+"';";
			}

			$('#alrim_msg_status_wrap')[0].innerHTML = 
			'<div class="alarm_area2" id="msg_alrim_status" '+add_style+'>' +
				'<div class="alarm_small_list bg_8ab933" onclick=open_alrim_list("#msg_alrim");>' +
					'<span class="alarm_small_title">메시지도착 알림</span>' +
					'<div class="alarm_cnt" id="msg_status_cnt">'+datas['msg_new_cnt']+'</div>' +
					'<span class="alarm_small_text"  id="msg_status_text">'+cutStr(msg_new_text,30)+'</span>' +
				'</div>' +
			'</div>';

			$('#msg_list_cnt')[0].innerHTML = datas['msg_new_cnt'];
			if($("#msg_alrim_list").css("display") == "block"){
				msg_list_data_call();
			}

			reload_get_chatting_data();

		}else{
			if($("#msg_alrim_status").length != 0){
				$('#msg_status_cnt')[0].innerHTML = 0;
				$('#msg_list_cnt')[0].innerHTML = 0;
				$('#msg_status_text')[0].innerHTML = "";
			}
			reload_get_chatting_data();
		}

	
		if(datas['joy_new_cnt'] > 0){
			if(datas['joy_new_text'] == undefined){datas['joy_new_text'] = "";}
			joy_new_text = decodeURIComponent(datas['joy_new_text']);
			joy_new_text = joy_new_text.replace(/'/g, "\\'");

			if(datas['joy_new_cnt'] > 99){datas['joy_new_cnt'] = 99;}

			if($("#joy_alrim_status").length == 0){
				add_style = "";
			}else{
				var b = $("#joy_alrim_status").css('bottom');
				add_style = "style='display:block;bottom:"+b+"';";
			}

			$('#alrim_joy_status_wrap')[0].innerHTML = 
			'<div class="alarm_area2" id="joy_alrim_status" '+add_style+'>' +
				'<div class="alarm_small_list bg_5bc0de" onclick=open_alrim_list("#joy_alrim");>' +
					'<span class="alarm_small_title">조이헌팅 알림</span>' +
					'<div class="alarm_cnt" id="joy_status_cnt">'+datas['joy_new_cnt']+'</div>' +
					'<span class="alarm_small_text"  id="joy_status_text">'+cutStr(joy_new_text,30)+'</span>' +
				'</div>' +
			'</div>';

			$('#joy_list_cnt')[0].innerHTML = datas['joy_new_cnt'];

			if($("#joy_alrim_list").css("display") == "block"){
				joy_list_data_call();
			}

		}else{
			if($("#joy_alrim_status").length != 0){
				$('#joy_status_cnt')[0].innerHTML = 0;
				$('#joy_list_cnt')[0].innerHTML = 0;
				$('#joy_status_text')[0].innerHTML = "";
			}
		}


	}
	

	function chat_accept_flg(user_id, idx){

		$.ajax({

			type : "post",
			url : "/chat/chat_accept_flg",
			data : {
			},
			cache : false,
			async : false,
			success : function(result){
				flag = result;
			},
			error : function(result){
				alert("실패 ("+result+")");
			}

		});

		if(flag == "M"){

			$.ajax({
				 
				type : "post",
				url : "/chat/chat_request",
				data : {
					"user_id"		: user_id
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == "no_pay"){
						if(confirm("채팅을 하시기 위해서는 포인트가 필요합니다.\n포인트를 충전하러 가시겠습니까?") == true){
							$(location).attr("href", "/profile/point/point_list");
						}
					}else if(result == "profile"){
						$.ajax({

							type : "post",
							url : "/chat/profile_image_layer/"+Math.random(),
							data : {
								"idx"		: idx,
								"user_id"	: user_id
							},
							cache : false,
							async : false,
							success : function(data){
								modal.open({content: data, width : 460, top:100});
							},
							error : function(data){
								alert("실패 ("+data+")");
							}

						});

					}else{
						modal.open({content: result, width : 460});
					}
					
					
				},
				error : function(result){
					alert(result);
				}
				
			});

		}else{

			$.ajax({
				 
				type : "post",
				url : "/chat/chat_request",
				data : {
					"user_id"		: user_id
				},
				cache : false,
				async : false,
				success : function(result){
					
					modal.open({content: result, width : 460});
					
				},
				error : function(result){
					alert(result);
				}
				
			});


		}

	}


	function chat_accept(user_id, idx){
			
		$.ajax({

			type : "post",
			url : "/chat/chat_accept",
			data : {
				"user_id"		: encodeURIComponent(user_id)
			},
			cache : false,
			async : false,
			success : function(result){
				

				if(result == "1" || result == "accept"){


					if(idx > 0){
						$('#chat_btn_'+idx).hide();
						$('#chat_accept_'+idx).show();	
					}

					openChatWindow(user_id);

				}else if(result == "0"){
					slide_alrim("lack_alrim", "보유하신 포인트가 부족합니다.", "2000");
					return;
					
				}else if(result == "10"){
					alert("상대방의 보유 포인트가 부족합니다.");
					return;
				}else{
					alert("잘못된 접근입니다.\n잠시후 다시 시도해 주시기 바랍니다. ("+result+")");
					return;
				}

				modal.close();

				alrim_close2('#chat_alrim',1);

			},
			error : function(result){
				alert("실패");
			}

		});
		
		
	}


	function chat_deny(user_id, idx){
		$.get('/chat/chat_deny/user_id/'+encodeURIComponent(user_id)+'/'+Math.random());

		if(idx > 0){
			$('#chat_btn_'+idx).hide();
			$('#chat_deny_'+idx).show();			
		}

		alrim_close2('#chat_alrim',1);
	}



	function open_chat_win(user_id, status, req_idx){

		if(status == "다시채팅" || status == "수락대기" || status == "상대나감"){
			openChatWindow(user_id);
		}else if(status == "채팅수락"){
			
			$.ajax({

				type : "post",
				url : "/chat/chat_request",
				data : {
					"user_id"		: decodeURIComponent(user_id)
				},
				cache : false,
				async : false,
				success : function(result){

					if(result == "profile"){
						$.ajax({

							type : "post",
							url : "/chat/profile_image_layer/"+Math.random(),
							data : {
								"idx"		: req_idx,
								"user_id"	: user_id
							},
							cache : false,
							async : false,
							success : function(data){
								modal.open({content: data, width : 460, top:100});
							},
							error : function(data){
								alert("실패 ("+data+")");
							}

						});
					}else{
						if(result == "alreay_chat"){
							alert("이미 채팅중입니다.");
							openChatWindow(user_id);
						}else{
							modal.open({content: result, width : 460});	
						}
					}
					
				},
				error : function(result){
					alert("실패");
				}

			});

		}else{

			$.get('/profile/my_chat/chat_room_chk/user_id/'+user_id+'/req_idx/'+req_idx+'/'+Math.random(), function(data){

				if(data == "F"){
					openChatWindow(user_id);
				}else{
					
					$.ajax({

						type : "post",
						url : "/chat/chat_request",
						data : {
							"user_id"		: decodeURIComponent(user_id)
						},
						cache : false,
						async : false,
						success : function(result){
							modal.open({content: result, width : 460});	
						},
						error : function(result){
							alert("실패");
						}

					});
				}

			});

		}
		
	}

	function openChatWindow(user_id){
		win = window.open( "/chat/chatting/"+ user_id ,'chat_'+user_id, "fullscreen=0,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=yes,width=400,height=700;");
	}


	function write_alrim_list(){
			$('#alrim_chat_list_wrap')[0].innerHTML = 
			'<div class="alarm_area3" id="chat_alrim_list">' +
				'<div class="alarm_top_area bg_e15148">' +
					'<div class="float_left">' +
						'<p class="alarm_title">채팅신청 수락</p>' +
						'<div class="alarm_cnt" id="chat_list_cnt">0</div>' +
					'</div>' +
					'<div class="float_right">' +
						'<a href="javascript:chat_layer_close(\'#chat_alrim_list\');"><img src="/images/alert_exit_btn.png" class="block"></a>' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
				'<div class="mCustomScrollbar alarm_content">' +
					'<div class="alarm_content_area2 border_left_right_none" id="alrim_chat_list_wrap_inlist">' +
					'</div>' +
				'</div>' +
				'<div class="alarm_list_open_box">' +
					'<div class="float_left">' +
						'<input type="button" class="text_btn_dcdcdc alarm_all_list_btn" value="전체목록 보기" onclick="chat_list_show_all()">' +
					'</div>' +
					'<div class="float_right">' +
						'<input type="button" class="text_btn_dcdcdc alarm_all_list_remove" value="전체삭제" onclick="chat_list_delete_all();">' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
			'</div>';

			$('#alrim_msg_list_wrap')[0].innerHTML = 
			'<div class="alarm_area3" id="msg_alrim_list">' +
				'<div class="alarm_top_area bg_8ab933">' +
					'<div class="float_left">' +
						'<p class="alarm_title">메시지도착 알림</p>' +
						'<div class="alarm_cnt" id="msg_list_cnt">0</div>' +
					'</div>' +
					'<div class="float_right">' +
						'<a href="javascript:chat_layer_close(\'#msg_alrim_list\');"><img src="/images/alert_exit_btn.png" class="block"></a>' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
				'<div class="mCustomScrollbar alarm_content">' +
					'<div class="alarm_content_area2 border_left_right_none" id="alrim_msg_list_wrap_inlist">' +
					'</div>' +
				'</div>' +
				'<div class="alarm_list_open_box">' +
					'<div class="float_left">' +
						'<input type="button" class="text_btn_dcdcdc alarm_all_list_btn" value="전체목록 보기">' +
					'</div>' +
					'<div class="float_right">' +
						'<input type="button" class="text_btn_dcdcdc alarm_all_list_remove" value="전체삭제" onclick="msg_list_delete_all();">' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
			'</div>';

			$('#alrim_joy_list_wrap')[0].innerHTML = 
			'<div class="alarm_area3" id="joy_alrim_list">' +
				'<div class="alarm_top_area bg_5bc0de">' +
					'<div class="float_left">' +
						'<p class="alarm_title">조이헌팅 알림</p>' +
						'<div class="alarm_cnt" id="joy_list_cnt">0</div>' +
					'</div>' +
					'<div class="float_right">' +
						'<a href="javascript:chat_layer_close(\'#joy_alrim_list\');"><img src="/images/alert_exit_btn.png" class="block"></a>' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
				'<div class="mCustomScrollbar alarm_content">' +
					'<div class="alarm_content_area2 border_left_right_none" id="alrim_joy_list_wrap_inlist">' +
					'</div>' +
				'</div>' +
				'<div class="alarm_list_open_box">' +
					'<div class="float_left">' +
					'</div>' +
					'<div class="float_right">' +
						'<input type="button" class="text_btn_dcdcdc alarm_all_list_remove" value="전체삭제" onclick="joy_list_delete_all();">' +
					'</div>' +
					'<div class="clear"></div>' +
				'</div>' +
			'</div>';

	}


	function chat_list_data_call()
	{

		$.get('/chat/hook_get_alrim_chat_list/'+Math.random(), function(data){

			if(data.length > 3){
				
				chat_buff = "";
				rows = {};
				$.each(data.split('¶'),function(index, x1) {

					datas = {};
					$.each(x1.split('|'),function(index, x2) {
						var arr = x2.split('=');
						arr[1] && (datas[arr[0]] = decodeURIComponent(arr[1]));
					});

					chat_new_text = decodeURIComponent(datas['contents']);
					chat_new_text = chat_new_text.replace(/'/g, "\\'");

					send_user_nick = decodeURIComponent(datas['send_user_nick']);
					send_user_nick = send_user_nick.replace(/'/g, "\\'");

 					if(datas['status'] == "수락"){
						div_style1 ='style="display:none;"';
						div_style2 ='';
						div_style3 ='style="display:none;"';
					}else if(datas['status'] == "거절"){
						div_style1 ='style="display:none;"';
						div_style2 ='style="display:none;"';
						div_style3 ='';
					}else{
						div_style1 ='';
						div_style2 ='style="display:none;"';
						div_style3 ='style="display:none;"';
					}


					chat_buff +=
						'<div class="alarm_content_box" id="chat_list_box_'+datas['idx']+'">' +
						'<a href="javascript:chat_list_item_close(\''+datas['idx']+'\');"><img src="/images/meet_exit_btn.gif" class="alarm_exit_btn"></a>' +
							'<p class="color_666 font-size_12">' +
								'<b class="color_333 font-size_12 font_900"><span class="border_bottom_1_333">'+send_user_nick+'</span>님</b>이 채팅신청을 하였습니다.' + 
							'</p>' +
							'<div class="width_85 block ver_top margin_top_10">' +
								decodeURIComponent(datas['thumb']) +
							'</div>' +
							'<div class="block margin_top_10">' +
								'<textarea class="chat_view" readonly>'+chat_new_text+'</textarea>' +
							'</div>' +
							'<div style="height:30px;" class="margin_top_6">'+
								'<div class="margin_left_65 alrim_buttons"  id="chat_btn_'+datas['idx']+'" '+div_style1+'>' +
									'<input type="button" class="text_btn_de4949 alarm_chatting_btn" value="수락" onclick=chat_accept_flg("'+datas['send_id']+'",'+datas['idx']+');>' +
									'<input type="button" class="text_btn_ea3e3e alarm_chatting_btn" value="거절" onclick=chat_deny("'+datas['send_id']+'",'+datas['idx']+');>' +
								'</div>' +
								'<div class="margin_left_100"  id="chat_accept_'+datas['idx']+'" '+div_style2+'>' +
									'<input type="button" class="text_btn_de4949 alarm_chatting_btn" value="다시채팅" onclick=openChatWindow("'+datas['send_id']+'");>' +
								'</div>' +
								'<div class="margin_left_85 chat_deny_text" id="chat_deny_'+datas['idx']+'" '+div_style3+'>' +
									'거절하였습니다.' +
								'</div>' +
							'</div>' +
						'</div>';

				});
				

				document.getElementById("alrim_chat_list_wrap_inlist").innerHTML = chat_buff;
				chat_buff = "";
			}

		});
	}


	function msg_list_data_call()
	{

		$.get('/chat/hook_get_alrim_msg_list/'+Math.random(), function(data){

			if(data.length > 3){
				
				chat_buff = "";
				rows = {};
				$.each(data.split('¶'),function(index, x1) {

					datas = {};
					$.each(x1.split('|'),function(index, x2) {
						var arr = x2.split('=');
						arr[1] && (datas[arr[0]] = decodeURIComponent(arr[1]));
					});

					msg_new_nick = decodeURIComponent(datas['msg_new_nick']);
					msg_new_nick = msg_new_nick.replace(/'/g, "\\'");

					msg_new_text = decodeURIComponent(datas['contents']);
					msg_new_text = msg_new_text.replace(/'/g, "\\'");


					chat_buff +=
						'<div class="alarm_content_area border_left_right_none" id="msg_list_box_'+datas['idx']+'">' +
							'<div class="alarm_content_box">' +
							'<a href="javascript:msg_list_item_close(\''+datas['idx']+'\');"><img src="/images/meet_exit_btn.gif" class="alarm_exit_btn"></a>' +
								'<div class="width_85 height_73 block ver_top">' +
									decodeURIComponent(datas['thumb']) +
								'</div>' +
								'<div class="alarm_text width_158">' +
									'<b class="color_333 font-size_12 font_900"><span class="border_bottom_1_333 pointer" onclick=openChatWindow("'+datas['send_id']+'");>'+cutStr(msg_new_text,80)+'</span></b>' +
									'<p class="color_666 font-size_12 margin_top_8 pointer" onclick=openChatWindow("'+datas['send_id']+'");>' +
										msg_new_nick +'님 으로부터 메시지가 도착했습니다.' +
									'</p>' +
								'</div>' +
							'</div>' +
						'</div>';				

				});
				

				document.getElementById("alrim_msg_list_wrap_inlist").innerHTML = chat_buff;
				chat_buff = "";
			}

		});
	}


	function joy_list_data_call()
	{


		$.get('/chat/hook_get_alrim_joy_list/'+Math.random(), function(data){

			if(data.length > 3){
				
				chat_buff = "";
				rows = {};
				$.each(data.split('¶'),function(index, x1) {

					datas = {};
					$.each(x1.split('|'),function(index, x2) {
						var arr = x2.split('=');
						arr[1] && (datas[arr[0]] = decodeURIComponent(arr[1]));
					});

	
					joy_new_nick = decodeURIComponent(datas['send_user_nick']);
					joy_new_nick = joy_new_nick.replace(/'/g, "\\'");

					joy_new_text = decodeURIComponent(datas['contents']);
					joy_new_text = joy_new_text.replace(/'/g, "\\'");

					chat_buff +=
						'<div class="alarm_content_area border_left_right_none" id="joy_list_box_'+datas['idx']+'">' +
							'<div class="alarm_content_box">' +
							'<a href="javascript:joy_list_item_close(\''+datas['idx']+'\');"><img src="/images/meet_exit_btn.gif" class="alarm_exit_btn"></a>';
								if(datas['send_user_pic']){ 
								chat_buff +=
								'<div class="width_85 height_73 block ver_top">' +
									decodeURIComponent(datas['send_user_pic']) +
								'</div>';
								}
								if(datas['send_user_pic']){d_width = "width_158";}else{d_width = "width_243 height_73";} 
								
								chat_buff +=
								'<div class="alarm_text '+d_width+'">' +
									'<p class="color_666 font-size_12 margin_top_8 pointer" >' +
										cutStr(joy_new_text,80) +
									'</p>';
									if(datas['event_btn_text']){
										chat_buff +=
										'<p><input type="button" class="text_btn_dcdcdc alarm_jjim_btn" value="'+datas['event_btn_text']+'" onclick=go_msg_alrim("'+datas['event_url']+'");></p>';
									}
								chat_buff +=
								'</div>' +
							'</div>' +
						'</div>';				

				});

				document.getElementById("alrim_joy_list_wrap_inlist").innerHTML = chat_buff;
				chat_buff = "";
			}

		});
	}


	function chat_list_item_close(idx){
		$.get('/chat/chat_list_del/idx/'+idx+'/'+Math.random());
		$('#chat_list_box_'+idx).hide();
		$('#chat_list_cnt')[0].innerHTML = $('#chat_list_cnt')[0].innerHTML - 1;
	}


	function chat_list_delete_all(){
		$.get('/chat/chat_list_del_all'+'/'+Math.random());
		$('#chat_list_cnt')[0].innerHTML = 0;
		document.getElementById("alrim_chat_list_wrap_inlist").innerHTML = "";
	}


	function msg_list_item_close(idx){
		$.get('/chat/msg_list_del/idx/'+idx+'/'+Math.random());
		$('#msg_list_box_'+idx).hide();
		$('#msg_list_cnt')[0].innerHTML = $('#msg_list_cnt')[0].innerHTML - 1;
	}


	function msg_list_delete_all(){
		$.get('/chat/msg_list_del_all'+'/'+Math.random());
		$('#msg_list_cnt')[0].innerHTML = 0;
		document.getElementById("alrim_msg_list_wrap_inlist").innerHTML = "";
	}

	function go_msg_alrim(url){
		location.href=url;
	}

	function joy_list_item_close(idx){
		$.get('/chat/joy_list_del/idx/'+idx+'/'+Math.random());
		$('#joy_list_box_'+idx).hide();
		$('#joy_list_cnt')[0].innerHTML = $('#joy_list_cnt')[0].innerHTML - 1;
	}

	function joy_list_delete_all(){
		$.get('/chat/joy_list_del_all'+'/'+Math.random());
		$('#joy_list_cnt')[0].innerHTML = 0;
		document.getElementById("alrim_joy_list_wrap_inlist").innerHTML = "";
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



	function call_message_data(){
		
		var result = "";
		var v_result = "";
		var gubn = "resend";

		$.get('/profile/message/call_message_alrim/'+Math.random(), function(data){
			
			if(data){

				result = data;			
				v_result = result.split('|');

				send_message(v_result[1], gubn, v_result[0]);
			}
			
		});

	}


	$(document).ready(function(){
		call_message_data();
	});


