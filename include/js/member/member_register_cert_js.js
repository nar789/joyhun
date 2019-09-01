var id_check = "";

$(document).ready(function(){

	/* 간편확인 / 휴대폰 인증 TAB */

	$(".regi2_content").hide(); 
	$(".regi2_content:last").show(); 

	$(".regi_tab_1").click(function() {
	
		$(this).removeClass(" regi1_on regi1_off");
		$(".regi_tab_2").removeClass(" regi2_on"); 
		$(this).addClass("regi1_on"); 
		$(".regi_tab_2").addClass(" regi2_off"); 

		$(".regi2_content:last").hide() 
		$(".regi2_content:first").show() 

		var regitab1 = $(".regi_tab_1").find("img").attr("src").split("off").join("on");
		$(".regi_tab_1").find("img").attr("src",regitab1);
		var regitab2 = $(".regi_tab_2").find("img").attr("src").split("on").join("off");
		$(".regi_tab_2").find("img").attr("src",regitab2);

	
	});

	$(".regi_tab_2").click(function() {
	
		$(this).removeClass(" regi2_on regi2_off");
		$(".regi_tab_1").removeClass(" regi1_on"); 
		$(this).addClass("regi2_on"); 
		$(".regi_tab_1").addClass(" regi1_off"); 

		$(".regi2_content:first").hide() 
		$(".regi2_content:last").show() 
		
		var regitab1 = $(".regi_tab_1").find("img").attr("src").split("on").join("off");
		$(".regi_tab_1").find("img").attr("src",regitab1);
		var regitab2 = $(".regi_tab_2").find("img").attr("src").split("off").join("on");
		$(".regi_tab_2").find("img").attr("src",regitab2);
	
	});


	//간편확인 확인하고 들어가기 버튼 클릭
	$("#submit_btn_1").click(function(){

		regi_user_name = $("#regi_user_name").val();
		if(regi_user_name == ""){
			alert("이름을 입력해 주십시오.");	
			$("#regi_user_name").focus();
			return false;
		}

		regi_birth_year = $("#regi_birth_year").val();
		if(regi_birth_year == ""){
			alert("생년월일을 선택해 주십시오.");	
			$("#regi_birth_year").focus();
			return false;
		}

		regi_birth_month = $("#regi_birth_month").val();
		if(regi_birth_month == ""){
			alert("생년월일을 선택해 주십시오.");	
			$("#regi_birth_month").focus();
			return false;
		}


		regi_birth_day = $("#regi_birth_day").val();
		if(regi_birth_day == ""){
			alert("생년월일을 선택해 주십시오.");	
			$("#regi_birth_day").focus();
			return false;
		}

		var regi_sex = $("#regi_sex").val();
		if ($('input[name="regi_sex"]:checked').val() == 'M'){
			regi_sex = 'M';
		}else{
			regi_sex = 'F';
		}

		var result = "";

		$.ajax({

			type: "POST",
			url: "/auth/register_name_check",
			data: {
				"regi_user_name": encodeURIComponent($("#regi_user_name").val()),
				"regi_birth_year": encodeURIComponent($("#regi_birth_year").val()),
				"regi_birth_month": encodeURIComponent($("#regi_birth_month").val()),
				"regi_birth_day": encodeURIComponent($("#regi_birth_day").val()),
				"regi_sex" : encodeURIComponent(regi_sex)
			},
			cache: false,
			async: false,
			success: function(result) {
				
				if(result == "1"){
					alert("본인인증에 성공했습니다.");
					location.href="/auth/register_run";
				}else{
					alert("본인인증에 실패했습니다.("+result+")");
					return;
				}

			},
			error : function(result){
				alert("실패 ("+result+") ");
			}

		});

		

	});

	

});

