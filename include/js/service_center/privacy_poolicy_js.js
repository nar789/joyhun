


$(document).ready(function(){

	$.mCustomScrollbar.defaults.scrollButtons.enable=true;

	if ($('#checked_1').is(":checked")){	//개인정보 취급방침

		$("#content-1").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('개인정보 취급방침');

		$("#content-1").show();
		$("#content-2").hide();
		$("#content-3").hide();

	}else if ($('#checked_2').is(":checked")){	//이용약관

		$("#content-2").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('이용약관');

		$("#content-1").hide();
		$("#content-2").show();
		$("#content-3").hide();

	}else if ($('#checked_3').is(":checked")){	//청소년보호정책

		$("#content-3").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('청소년보호정책');

		$("#content-1").hide();
		$("#content-2").hide();
		$("#content-3").show();

	}

});

function privacy_what(what){

	if(what == "1"){	//개인정보 취급방침

		$("#content-1").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('개인정보 취급방침');

		$("#content-1").show();
		$("#content-2").hide();
		$("#content-3").hide();

	}else if (what == "2"){	//이용약관
		
		$("#content-2").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('이용약관');

		$("#content-1").hide();
		$("#content-2").show();
		$("#content-3").hide();

	}else if (what == "3"){	//청소년보호정책
		
		$("#content-3").mCustomScrollbar({theme:"inset"});
		$('#privacy_title').html('청소년보호정책');

		$("#content-1").hide();
		$("#content-2").hide();
		$("#content-3").show();
	}

}
