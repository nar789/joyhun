var S_Time = new Date();	//최초 시간 설정
var C_Time, D_Time;
var Filter_ck = 0;			//최초 카운터 설정

//화면 처리 함수
function Print_Ment_Screen(Print_Ment_Width)
{
//	var alert_str = "<table width='"+Print_Ment_Width+"' cellpadding='0' cellspacing='0' border='0' align='center'>";
//	alert_str += "<tr>";
//	alert_str += "<td style='padding-left:15px;padding-right:15px;padding-top:5px;padding-bottom:5px;' class='ln16' align='centent'>";
//	alert_str += "<font color='#A9A9A9' face='돋움체'>최근 ";
//	alert_str += "<font color='#FF0000'><b>조건만남</b></font>";
//	alert_str += "을 빙자한 사기 및 ";
//	alert_str += "<font color='#FF0000'><b>060불법통화</b></font>";
//	alert_str += "에 의한 피해사례가 빈번하게 발생되고 있으니, ";
//	alert_str += "<font color='#FF0000'><b>금전요구</b></font>";
//	alert_str += " 및 ";
//	alert_str += "<font color='#FF0000'><b>060불법통화유도</b></font>";
//	alert_str += "시 절대 응하지 마시고 신고 부탁드립니다.</font>";
//	alert_str += "</td>";
//	alert_str += "</tr>";
//	alert_str += "</table>";

	var alert_str = "<table width='"+Print_Ment_Width+"' cellpadding='0' cellspacing='0' border='0' align='center'>";
	alert_str += "<tr>";
	alert_str += "<td style='padding-left:15px;padding-right:15px;padding-top:5px;padding-bottom:5px;' class='ln16' align='centent'>";
	alert_str += "<font color='#A9A9A9' face='돋움체'>최근 ";
	alert_str += "<font color='#FF0000'><b>조건만남</b></font>";
	alert_str += "을 빌미로 ";
	alert_str += "<font color='#FF0000'><b>선입금 요구, 060전화통화 유도, 운영자사칭, 화상채팅 권유, 불법사이트 가입</b></font>";
	alert_str += "을 유도하는 등의 사기가 발생하고 있으니 주의하시기 바랍니다.</font> ";
	alert_str += "</td>";
	alert_str += "</tr>";
	alert_str += "</table>";

	return alert_str;
}

//시간 체크 함수
function Check_Timer(Chk_Min, Param_Width)
{
	var def_M, timer_return;
	timer_return = '';
	C_Time = new Date();										//현재 시간 재설정
	D_Time = C_Time.getTime() - S_Time.getTime();				//시간 차 계산

	def_M = (D_Time/1000) / 60;									//분으로 환산

	if ((Filter_ck == 0) || (parseInt(def_M) >= Chk_Min)){		//처음 돌아가거나 해당시간이 되었거나
		S_Time = new Date();									//시작시간 재설정
		timer_return = Print_Ment_Screen(Param_Width);			//화면에 처리할 함수
		Filter_ck += 1;											//카운터 1 증가
	}
	
	return timer_return;
}

//문자열 비교 검색 함수(필터 단어로 Split하고 그 길이를 반환)
function SplitCheck_String(s_Str, c_Str)
{
	var fnc_return, split_string;
	split_string = s_Str.split(c_Str);
	fnc_return = split_string.length;
	return fnc_return;
}

//문자열 비교 검색 함수
function Filter_Check(vals, time_chk, Table_Width)
{
	//check_ment 에 배열형식으로 문구 추가
	var i, chk_S, filter_return;
	var Check_ment = ['입금','이체','송금','계좌','계좌번호','뱅킹','인출','급전','은행','대출',
						'060','조건만남','ㅈㄱ','조이폰','만남','조건',
						'만원','십만원','10만원','20만원','30만원','070','예약'];

	filter_return = '';

	for (i=0; i<Check_ment.length; i++){
		chk_S = SplitCheck_String(vals, Check_ment[i]);

		if (chk_S > 1){													//비교 결과가 있을 경우, 시간 체크
			filter_return = Check_Timer(time_chk, Table_Width);			//파라메타로 시간 설정(단위:분), Table Width
			break;
		}
	}

	return filter_return;
}
