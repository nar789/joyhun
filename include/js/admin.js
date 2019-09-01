/**
 * 관리자모드 각종 스크립트
 */

//관리자 상단 검색
function mem_search(){
	if($("#top_q").val() == ""){
		alert("검색어를 입력해주세요.");
	}else{

	    $('#preloader').show();

		act = '/admin/main/member_list/q/'+$("#top_q").val()+'/sfl/'+$("#top_sfl").val();
		location.href= act;
	}
	return false;
}

//관리자 좌측메뉴 자동오픈
$( document ).ready(function() {
	$(function(){
	  function stripTrailingSlash(str) {
		if(str.substr(-1) == '/') {
		  return str.substr(0, str.length - 1);
		}

		tmp = str.split("/");
		var new_str = "";
		for(i=1;i<tmp.length;i++){
			if(i < 4){
				new_str = new_str + "/"+ tmp[i];
			}
		}

		return new_str;
	  }

	  var url = window.location.pathname;  
	  var activePage = stripTrailingSlash(url);

	  $('.nav li a').each(function(){  
		var currentPage = stripTrailingSlash($(this).attr('href'));
		if (activePage == currentPage) {
		  $(this).parent().addClass('active'); 
		  $(this).parent().parent().parent().addClass('active'); 
		  $(this).parent().parent().parent().parent().parent().addClass('active'); 
		} 
	  });
	});
});




//처벌하기
function punish_add(){
	
	var set_ip_block = "";
	var set_hp_block = "";

	if($("#set_ip_block").prop("checked") == true){ set_ip_block = "IP"; }
	if($("#set_hp_block").prop("checked") == true){ set_hp_block = "HP"; }

	if($("#m_userid").val() == ""){ alert("회원 아이디를 입력하세요."); $("#m_userid").focus(); return;}
	if($("#comp_cate").val() == ""){ alert("처벌사유를 선택하세요"); $("#comp_cate").focus(); return;}
	if($("#punish_card").val() == ""){ alert("처벌분류를 선택하세요."); $("#punish_card").focus(); return;}
	if($("#comp_content").val() == ""){ alert("처벌내용을 입력하세요."); $("#comp_content").focus(); return;}

	$.ajax({

		type : "post",
		url : "/admin/service_center/punishment/punish_request",
		data : {
			"m_userid"		: encodeURIComponent($("#m_userid").val()),
			"comp_cate"		: encodeURIComponent($("#comp_cate").val()),
			"punish_card"	: encodeURIComponent($("#punish_card").val()),
			"comp_content"	: encodeURIComponent($("#comp_content").val()),
			"set_ip_block"  : encodeURIComponent(set_ip_block),
			"set_hp_block"  : encodeURIComponent(set_hp_block)
		},
		cache : false,
		async : false,
		success : function(result){

			var rtn =  result.replace(/\s/gi, ''); 

			if(rtn == "1"){
				alert("처벌되었습니다.");
				location.href = '/admin/service_center/punishment/punish_list';
			}else if(rtn == "777"){
				alert("이미 영구정지인 회원입니다.");
				location.reload();
			}else{
				alert("처벌 실패");
				console.log("error : " + rtn);
			}
							
		},
		error : function(result){
			alert("실패");
			console.log("error : " + result);
		}

	});
}





var name_서울 = new Array('- 선택 -','강남구','강동구','강북구','강서구','관악구','광진구','구로구','금천구','노원구','도봉구','동대문구','동작구','마포구','서대문구','서초구','성동구','성북구','송파구','양천구','영등포구','용산구','은평구','종로구','중구','중랑구'); 
var code_서울 = new Array('','강남구','강동구','강북구','강서구','관악구','광진구','구로구','금천구','노원구','도봉구','동대문구','동작구','마포구','서대문구','서초구','성동구','성북구','송파구','양천구','영등포구','용산구','은평구','종로구','중구','중랑구'); 
 
var name_인천 = new Array('- 선택 -','강화군','계양구','남구','남동구','동구','부평구','서구','연수구','옹진군','중구'); 
var code_인천 = new Array('','강화군','계양구','남구','남동구','동구','부평구','서구','연수구','옹진군','중구'); 
 
var name_부산 = new Array('- 선택 -','강서구','금정구','기장군','남구','동구','동래구','부산진구','북구','사상구','사하구','서구','수영구','연제구','영도구','중구','해운대구'); 
var code_부산 = new Array('','강서구','금정구','기장군','남구','동구','동래구','부산진구','북구','사상구','사하구','서구','수영구','연제구','영도구','중구','해운대구'); 
 
var name_대구 = new Array('- 선택 -','남구','달서구','달성군','동구','북구','서구','수성구','중구'); 
var code_대구 = new Array('','남구','달서구','달성군','동구','북구','서구','수성구','중구'); 
 
var name_대전 = new Array('- 선택 -','대덕구','동구','서구','유성구','중구'); 
var code_대전 = new Array('','대덕구','동구','서구','유성구','중구'); 
 
var name_광주 = new Array('- 선택 -','광산구','남구','동구','북구','서구'); 
var code_광주 = new Array('','광산구','남구','동구','북구','서구'); 
 
var name_울산 = new Array('- 선택 -','남구','동구','북구','울주군','중구'); 
var code_울산 = new Array('','남구','동구','북구','울주군','중구'); 
 
var name_경기 = new Array('- 선택 -','가평군','고양시','과천시','광명시','광주시','구리시','군포시','김포시','남양주시','동두천시','부천시','성남시','수원시','시흥시','안산시','안성시','안양시','양주시','양평군','여주군','연천군','오산시','용인시','의왕시','의정부시','이천시','파주시','평택시','포천시','하남시','화성시'); 
var code_경기 = new Array('','가평군','고양시','과천시','광명시','광주시','구리시','군포시','김포시','남양주시','동두천시','부천시','성남시','수원시','시흥시','안산시','안성시','안양시','양주시','양평군','여주군','연천군','오산시','용인시','의왕시','의정부시','이천시','파주시','평택시','포천시','하남시','화성시'); 
 
var name_강원 = new Array('- 선택 -','강릉시','고성군','동해시','삼척시','속초시','양구군','양양군','영월군','원주시','인제군','정선군','철원군','춘천시','태백시','평창군','홍천군','화천군','횡성군'); 
var code_강원 = new Array('','강릉시','고성군','동해시','삼척시','속초시','양구군','양양군','영월군','원주시','인제군','정선군','철원군','춘천시','태백시','평창군','홍천군','화천군','횡성군'); 
 
var name_충남 = new Array('- 선택 -','계룡시','공주시','금산군','논산시','당진군','보령시','부여군','서산시','서천군','아산시','연기군','예산군','천안시','청양군','태안군','홍성군'); 
var code_충남 = new Array('','계룡시','공주시','금산군','논산시','당진군','보령시','부여군','서산시','서천군','아산시','연기군','예산군','천안시','청양군','태안군','홍성군'); 
 
var name_충북 = new Array('- 선택 -','괴산군','단양군','보은군','영동군','옥천군','음성군','제천시','증평군','진천군','청원군','청주시','충주시'); 
var code_충북 = new Array('','괴산군','단양군','보은군','영동군','옥천군','음성군','제천시','증평군','진천군','청원군','청주시','충주시'); 
 
var name_경남 = new Array('- 선택 -','거제시','거창군','고성군','김해시','남해군','마산시','밀양시','사천시','산청군','양산시','의령군','진주시','진해시','창녕군','창원시','통영시','하동군','함안군','함양군','합천군'); 
var code_경남 = new Array('','거제시','거창군','고성군','김해시','남해군','마산시','밀양시','사천시','산청군','양산시','의령군','진주시','진해시','창녕군','창원시','통영시','하동군','함안군','함양군','합천군'); 
 
var name_경북 = new Array('- 선택 -','경산시','경주시','고령군','구미시','군위군','김천시','문경시','봉화군','상주시','성주군','안동시','영덕군','영양군','영주시','영천시','예천군','울릉군','울진군','의성군','청도군','청송군','칠곡군','포항시'); 
var code_경북 = new Array('','경산시','경주시','고령군','구미시','군위군','김천시','문경시','봉화군','상주시','성주군','안동시','영덕군','영양군','영주시','영천시','예천군','울릉군','울진군','의성군','청도군','청송군','칠곡군','포항시'); 
 
var name_전남 = new Array('- 선택 -','강진군','고흥군','곡성군','광양시','구례군','나주시','담양군','목포시','무안군','보성군','순천시','신안군','여수시','영광군','영암군','완도군','장성군','장흥군','진도군','함평군','해남군','화순군'); 
var code_전남 = new Array('','강진군','고흥군','곡성군','광양시','구례군','나주시','담양군','목포시','무안군','보성군','순천시','신안군','여수시','영광군','영암군','완도군','장성군','장흥군','진도군','함평군','해남군','화순군'); 
 
var name_전북 = new Array('- 선택 -','고창군','군산시','김제시','남원시','무주군','부안군','순창군','완주군','익산시','임실군','장수군','전주시','정읍시','진안군'); 
var code_전북 = new Array('','고창군','군산시','김제시','남원시','무주군','부안군','순창군','완주군','익산시','임실군','장수군','전주시','정읍시','진안군'); 
 
var name_제주 = new Array('- 선택 -','서귀포시','제주시'); 
var code_제주 = new Array('','서귀포시','제주시'); 

var name_세종 = new Array('- 선택 -','반곡동', '소담동', '보람동', '대평동', '가람동', '한솔동', '나성동', '새롬동', '다정동', '어진동', '종촌동', '고운동', '아름동', '도담동', '조치원읍', '연기면', '연동면', '부강면', '금남면', '장군면', '연서면', '전의면', '전동면', '소정면'); 
var code_세종 = new Array('','반곡동', '소담동', '보람동', '대평동', '가람동', '한솔동', '나성동', '새롬동', '다정동', '어진동', '종촌동', '고운동', '아름동', '도담동', '조치원읍', '연기면', '연동면', '부강면', '금남면', '장군면', '연서면', '전의면', '전동면', '소정면');

 
 function area_select(sel1_val,sel2){ 

	if(sel1_val == '') { 
		for(i=sel.length-1; i>=0; i--) 
		sel.options[i] = null; 
		sel.options[0] = new Option('- 선택 -',''); 
		return; 
	} 

	sel = document.getElementById(sel2); 
	var lis = eval('name_'+ sel1_val); 
	var val = eval('code_'+ sel1_val); 
	 
	for(i=sel.length-1; i>=0; i--) 
		sel.options[i] = null; 
		sel.options[0] = new Option(lis[0],val[0], '', 'true'); 
		for(i=1; i<lis.length; i++){ 
			sel.options[i] = new Option(lis[i],val[i]); 
	} 
} 



//신규차단 버튼 클릭시 이벤트
function member_block_pop(gubn, user_id){

	var w = 600;
	var h = 500;

	var res_w = ( screen.availWidth - w ) / 2;
	var res_h = ( screen.availHeight - h ) / 2;
	
	var v_url = "/admin/service_center/member_block/member_block_pop";

	if(gubn){ v_url = v_url+"/gubn/"+gubn; }
	if(user_id){ v_url = v_url+"/user_id/"+user_id; }

	var popUrl = v_url;
	var popOption = "width="+w+", height="+h+", top="+res_h+", left="+res_w+", resizable=no, scrollbars=no, status=no;";  
	var open_window = window.open(popUrl, "reg_product", popOption);	

	if(open_window == null){ 
		alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
	}
}