$(document).ready(function(){
	
	$("#gift_tab1").click(function(){ $(location).attr("href", "/gift_shop/gift/gift_recv_box") });			//받은선물함
	$("#gift_tab2").click(function(){ $(location).attr("href", "/gift_shop/gift/gift_send_box") });			//보낸선물함

	//선택삭제 버튼 클릭시 이벤트
	$(".gift_box_delete").click(function(){
		
		if($("input[name='chk_gift']").is(":checked") == false){
			alert("삭제하실 리스트를 선택하세요.");
			return;
		}else{
			
			if(confirm("선택한 리스트를 삭제하시겠습니까?") == true){

				var chk_list = "";

				$("input[name='chk_gift']:checked").each(function(){
					 
					 if(chk_list){
						 chk_list = chk_list+"|"+$(this).val();
					 }else{
						 chk_list = $(this).val();
					 }
				});

				$.ajax({

					type : "post",
					url : "/gift_shop/gift/call_gift_list_del",
					data : {
						"chk_list"		: encodeURIComponent(chk_list)
					},
					cache : false,
					async : false,
					success : function(result){
						
						if(result == "1"){
							alert("선택한 리스트를 삭제했습니다.");
							location.reload();
						}else if(result == "0"){
							alert("선택한 리스트를 삭제에 실패했습니다.");
							location.reload();
						}

					},
					error : function(result){
						alert("실패 ("+ result +")");
					}

				});

			}
			
		}

	});



});


//탭메뉴 클릭 이벤트
function tab_menu_click(val){
	//변수에서 /를 |로 치환처리
	var category = val.replace('/', '|');
	$(location).attr('href', '/gift_shop/gift/gift_list/category/'+encodeURIComponent(category));
}

//탭메뉴 border 체크
function tab_menu_border(val){

	$("#tabs tr td").each(function(){
		
		var v_text = $(this).text().replace(/^\s+|\s+$/g,'');
		if(v_text == val){
			$(this).removeClass('gift_tab_off');
			$(this).addClass('gift_tab_on');
		}else{
			$(this).removeClass('gift_tab_on');
			$(this).addClass('gift_tab_off');
		}

	});
}