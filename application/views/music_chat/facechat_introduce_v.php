<SCRIPT LANGUAGE="JavaScript">

	var userid;
	var nickname;
	var agestr;
	var mysex;
	var m_character;
	var m_instyle;
	var m_height;
	var m_region;
	var m_job;
	var m_reason;
	var exp;

	nickname = '<?=@$m_nick?>';

	while(nickname != (nickname = nickname.replace(";", "")));

	agestr = '<?=@$m_age?>';
	mysex = '<?=@$m_sex?>';
	m_character = '<?=@$m_character?>';
	m_reason = '<?=@$m_reason?>';
	m_region = '<?=@$m_region?>';
	m_job = '<?=@$m_job?>';
	exp = '<?=@$content?>';

//	while(exp != (exp = exp.replace(";", "")));

	agestr = agestr + "세";
	
	var t = "\n";

	var sexname = '<?=@$sex_value?>';

//	exp = setTagCode(exp);
//	while(exp != (exp = exp.replace("\r\n", "|")));
	
	t += "나이: " + agestr + "(" +sexname + ")<br>대화 스타일: " + m_character + "<br>";
	t += "원하는만남: " + m_reason + "<br><br>* 소개말<br><br>" + exp;

	var strMessage = '<br><table align=center bgcolor=white width=300 cellpadding=10 height=80 style=\"border:C2C2C2; border-style:solid; border-width:1px\" valign=top><tr>';
	strMessage += '<td>▶<b>' +nickname + '</b> <font color=#666666>(<?=@$m_userid?>) </font><br><br>';
	strMessage += t + "</td></tr></table><br>";

	//alert(strMessage);

	parent.txtoutput.document.write(strMessage);
	parent.txtoutput.document.body.scrollTop=1000000;


// 태그 방지 함수
function setTagCode(strString){
	while(strString != (strString = strString.replace("<", "&lt;")));
	while(strString != (strString = strString.replace(">", "&gt;")));
	return strString;
}

</SCRIPT>
