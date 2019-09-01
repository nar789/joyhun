<?
//######################################################################
// 파일명 : pb_web.php
// 작성자 : PG기술팀
// 작성일 : 2013.06
// 용  도 : 모빌리언스 표준 폰빌 결제 연동 페이지
// 버	전 : 0005

// 가맹점의 소스 임의변경에 따른 책임은 모빌리언스에서 책임을 지지 않습니다.
// 요청 파라미터 및 결제 후  가맹점측  Okurl / Notiurl 으로 Return 되는 파라미터와 가맹점 서비스처리 방법은
// 연동 매뉴얼을 반드시 참조하세요.
// 결제실서버 전환시 꼭 모빌리언스 기술지원팀으로 연락바랍니다.

// 암호화 사용시  필수 libCipher 실행파일을 가맹점측 서버에 설치

//######################################################################

define("SEEDEXE","/opt/mcash/seed/libCipher");// 좌측의 경로는 가맹점 서버에 설치한 libCipher 실행파일명 포함한 절대경로로 수정필수


/*****************************************************************
함수명 : cipher 암호화 실행
사용법 : cipher ("암복호화구분값E,D","암호화할데이터", "가맹점거래번호")
주의사항 : 절대수정금지
*****************************************************************/
function cipher($seedStr, $seedKey) {
	if( $seedStr == "" ) return "";
	return exec(SEEDEXE." E ".escapeshellarg(getKey($seedKey))." ".escapeshellarg($seedStr)." ");
}



function getKey( $value ){
	$padding = "123456789123456789";
	$tmpKey = $value;
	$keyLength = strlen( $value );
	if( $keyLength < 16 ) $tmpKey = $tmpKey.substr($padding, 0, 16-$keyLength);
	else  $tmpKey = substr( $tmpKey, strlen( $tmpKey )-16,  strlen( $tmpKey ) );
	for($i = 0 ; $i < 16; $i++) {
		$result = $result.chr(ord( substr( $tmpKey, $i, 1 ))^($i+1));
	}
	return $result;
}

?>

<?
	//######################################################################
	// 휴대폰 결제 / KT폰빌결제  구분은  CASH_GB 변수를 통해 구분함
	//	$CASH_GB = 'MC' 휴대폰 결제창 호출
	//	$CASH_GB = 'PB'  폰빌 결제창  호출
	//######################################################################
	$CASH_GB = "PB"; 	//모빌리언스 결제창을 호출할 결제수단 구분


	//######################################################################
	// 공통 필수 입력 항목
	//######################################################################
	$PAY_MODE	= "00";	//연동시 테스트,실결제구분 (00 : 테스트결제, 10 : 실거래결제)
	$Prdtnm		= "결제테스트";	//상품명 ( KT폰빌 PB : 30byte 이내)
	$Prdtprice	= "100";	//결제요청금액
	$Siteurl	= "www.joyhunting.net";	//가맹점측 도메인URL
	$Tradeid	= "1234";	//가맹점거래번호 Unique 값으로 세팅 권장
	$Okurl 		= "http://www.joyhunting.net/test/pb_test/okurl.php";	//성공URL : 결제완료통보페이지 full Url (예:http://www.cpdomain.co.kr/sample/okurl_hybrid.php)


	//######################################################################
	// 폰빌결제 필수 입력 항목
	//######################################################################
	$PB_SVCID	= "020307010010";	//서비스아이디(KT폰빌 서비스ID 세팅)
	//######################################################################
	// 폰빌결제 선택 입력 항목
	//######################################################################
	$PB_DEFAULTCOMMID	= "KT";	// 폰빌 결제창의 이통사 표시항목 (Default:KT 만 표시 , ALL:KT 와 LG U+ 둘다 표시 , KT :KT만 표시 , LGD :LG U+ / LGD경우 사전에 별도 등록 후 가능)
	$PB_Cpcode		= "";	// 리셀러하위상점key (현재 미사용)

	//######################################################################
	// 공통 선택 입력 항목
	//######################################################################
	$Userid			= "";	//가맹점결제자ID 
	$Notiurl		= "http://www.joyhunting.net/test/pb_test/notiurl.php";	//결제처리URL : 결제 완료 후, 가맹점측 과금 등 처리할 가맹점측 URL
	$Notiemail		= "";	//알림email : 입금완료 후 당사와 가맹점간의 연동이 실패한 경우 알람 메일을 받을 가맹점 담당자 이메일주소

	$Failurl		= "";	//실패URL : 결제실패시통보페이지 full Url (예:http://www.mcash.co.kr/failurl.asp)
							//결제처리에 대한 실패처리 안내를 가맹점에서 제어해야 할 경우만 사용
	$Closeurl = ""; //모빌리언스 결제창이 강제로 닫힌 경우 호출될 가맹점측 full url (현재 폰빌은 미지원)
	$MSTR			= "";	//가맹점콜백변수으로 구분자 중 & 는 사용불가
							//가맹점에서 추가적으로 파라미터가 필요한 경우 사용하며 &, % 는 사용불가 (예 : MSTR="a=1|b=2|c=3")
	$Payeremail		= "";	//결제자email
	$EMAIL_HIDDEN	= "N";	//결제자창 email 입력창 숨김(N default, Y 인경우 결제창에서 이메일항목 삭제)
	$Item			= "";	//아이템코드 (8byte 이내)
	$Prdtcd			= "";	//상품코드(40byte 이내)

	//######################################################################
	//- 디자인 관련 선택항목 ( 향후  변경될 수 있습니다  )
	//######################################################################
	$LOGO_YN	= "N";	//폰빌 경우는 현재 미지원
	$CALL_TYPE	= "P";	//결제창 호출방식(SELF 페이지전환 , P 팝업)

	//######################################################################
	//- 암호화 ( 암호화 사용시 )
	// Cryptstring 항목은 금액변조에 대한 확인용으로  반드시 아래와 같이 문자열을 생성하여야 합니다.
	//
	// 주) 암호화 해쉬키는 가맹점에서 전달하는 거래번호로 부터 추출되어 사용되므로
	//           암호화에 이용한 거래번호가  변조되어 전달될 경우 복호화 실패로 결제 진행 불가
	//######################################################################
	$Cryptyn		= "Y";					//"Y" 암호화사용, "N" 암호화미사용
	

	if($Cryptyn == "Y"){
		$Cryptstring	= $Prdtprice.$Okurl; 	//금액변조확인 (결제요청금액 + Okurl)

		$Okurl			= cipher("E",$Okurl, $Tradeid);
		$Failurl		= cipher("E",$Failurl, $Tradeid);
		$Notiurl	= cipher("E",$Notiurl, $Tradeid);
		$Prdtprice		= cipher("E",$Prdtprice, $Tradeid);
		$Cryptstring	= cipher("E",$Cryptstring, $Tradeid);
	}

?>

<!--  가맹점의 결제요청 페이지 -->
<html>
<head>
<?
	/*****************************************************************************************
	 가맹점에서는 아래 js 파일을 반드시 include
	 실 결제환경 구성시 모빌리언스 담당자와 상의 요망
	*****************************************************************************************/
?>
<script src="https://mcash.mobilians.co.kr/js/ext/ext_inc_comm.js"></script>

<script language="javascript">
	function payRequest(){
		//아래와 같이 ext_inc_comm.js에 선언되어 있는 함수를 호출
		MCASH_PAYMENT(document.payForm);
	}
</script>
</head>

<body>
<form name="payForm" accept-charset="euc-kr">
<table border="1" width="100%">
	<tr>
		<td align="center" colspan="6"><font size="15pt"><b>모빌리언스 표준 폰빌 결제  SAMPLE PAGE</b></font></td>
	</tr>
	<tr>
		<td align="center" colspan="6"><b>공통 항목(<font color="red">적색</font>은 필수 이외는 선택사항)</b></td>
	</tr>
		<tr>
		<td align="center"><font color="red">결제수단</font></td>
		<td align="center"><font color="red">CASH_GB</font></td>
		<td><select name="CASH_GB" id="CASH_GB" >
			   <option value="PB" >폰빌결제(PB)</option>
	        </select>	 </td>
		<td align="center"><font color="red">거래종류</font></td>
		<td align="center"><font color="red">PAY_MODE</font></td>
		<td>
			<select name="PAY_MODE" id="PAY_MODE" >
	           <option value="00" selected>TEST(00)</option>
			   <option value="10" >REAL(10)</option>
	        </select>	 
	</tr>
		<tr>
		<td align="center"><font color="red">폰빌 서비스아이디</font></td>
		<td align="center"><font color="red">PB_SVCID</font></td>
		<td><input type="text" name="PB_SVCID" id="PB_SVCID" size="30"  value="<?echo $PB_SVCID;?>" ></td>
		<td align="center"></td>
		<td align="center"></td>
		<td></td>

	</tr>
		<tr>
		<td align="center"><font color="red">가맹점거래번호</font></td>
		<td align="center"><font color="red">Tradeid</font></td>
		<td><input type="text" name="Tradeid" id="Tradeid" size="30" value="<?echo $Tradeid;?>"></td>
		<td align="center"><font color="red">가맹점도메인</font></td>
		<td align="center"><font color="red">Siteurl</font></td>
		<td><input type="text" name="Siteurl" id="Siteurl" size="30" value="<?echo $Siteurl;?>"></td>
		</tr>
	<tr>
		<td align="center"><font color="red">가맹점측 성공URL</font></td>
		<td align="center"><font color="red">*Okurl</font></td>
		<td><input type="text" name="Okurl" id="Okurl" size="30" value="<?echo $Okurl;?>"></td>
		<td align="center"><font color="red">상품명</font></td>
		<td align="center"><font color="red">Prdtnm</font></td>
		<td><input type="text" name="Prdtnm" id="Prdtnm" size="30" value="<?echo $Prdtnm;?>"></td>
	</tr>
	<tr>
		<td align="center"><font color="red">결제요청금액</font></td>
		<td align="center"><font color="red">*Prdtprice</font></td>
		<td><input type="text" name="Prdtprice" id="Prdtprice" size="30" value="<?echo $Prdtprice;?>"></td>
		<td align="center"><font color="red"></font></td>
		<td align="center"><font color="red"></font></td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td align="center">결제창 호출방식</td>
		<td align="center">CALL_TYPE</td>
		<td><input type="text" name="CALL_TYPE" id="CALL_TYPE" size="10" value="<?echo $CALL_TYPE;?>">(미설정시 기본 팝업)</td>
		<td align="center">가맹점 로고 사용여부</td>
		<td align="center">LOGO_YN</td>
		<td><input type="text" name="LOGO_YN" id="LOGO_YN" size="10" value="<?echo $LOGO_YN;?>"></td>
	</tr>
	<tr>
		<td align="center">가맹점측 실패URL</td>
		<td align="center">*Failurl</td>
		<td><input type="text" name="Failurl" id="Failurl" size="30" value="<?echo $Failurl;?>"></td>
		<td align="center">가맹점콜백변수</td>
		<td align="center">MSTR</td>
		<td><input type="text" name="MSTR" id="MSTR" size="30" value="<?echo $MSTR;?>"></td>
	</tr>
	<tr>
		<td align="center">알림E-mail</td>
		<td align="center">Notiemail</td>
		<td><input type="text" name="Notiemail" id="Notiemail" size="30" value="<?echo $Notiemail;?>"></td>
		<td align="center">가맹점측 결제처리URL</td>
		<td align="center">*Notiurl</td>
		<td><input type="text" name="Notiurl" id="Notiurl" size="30" value="<?echo $Notiurl;?>"></td>
	</tr>
	<tr>
		<td align="center">결제자E-mail</td>
		<td align="center">Payeremail</td>
		<td><input type="text" name="Payeremail" id="Payeremail" size="30" value="<?echo $Payeremail;?>"></td>
		<td align="center">가맹점결제자ID</td>
		<td align="center">Userid</td>
		<td><input type="text" name="Userid" id="Userid" size="30" value="<?echo $Userid;?>"></td>
	</tr>
	<tr>
		<td align="center">상품코드</td>
		<td align="center">Prdtcd</td>
		<td><input type="text" name="Prdtcd" id="Prdtcd" size="30" value="<?echo $Prdtcd;?>"></td>
		<td align="center">아이템코드</td>
		<td align="center">Item</td>
		<td><input type="text" name="Item" id="Item" size="30" value="<?echo $Item;?>"></td>
	</tr>

	<tr>
		<td align="center">암호화검증</td>
		<td align="center">*Cryptstring</td>
		<td><input type="text" name="Cryptstring" id="Cryptstring" size="30" value="<?echo $Cryptstring;?>"></td>
		<td align="center">암호화사용여부</td>
		<td align="center">Cryptyn</td>
		<td><input type="text" name="Cryptyn" id="Cryptyn" size="30" value="<?echo $Cryptyn;?>"> </td>
	</tr>
	<tr>
	<td align="center">이메일항목 숨김여부 </td>
		<td align="center">EMAIL_HIDDEN</td>
		<td><input type="text" name="EMAIL_HIDDEN" id="EMAIL_HIDDEN" size="30"  value="<?echo $EMAIL_HIDDEN;?>"></td>
		<td></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="left"></td>
		
	</tr>

	<tr>
		<td align="center" colspan="6"><b>폰빌 선택 항목</b></td>
	</tr>
	<tr>
		<td align="center">결제창 폰빌 이통사 표시<br>(LGD는 선등록 후 사용가능)</td>
		<td align="center">PB_DEFAULTCOMMID</td>
		<td><select name="PB_DEFAULTCOMMID" id="PB_DEFAULTCOMMID">
 				<option value="">미선택(KT기본)</option>
 				<option value="ALL">ALL(KT+LGD)</option> 				
 				<option value="KT">KT</option>
 				<option value="LGD">LGD</option>			
 			</select>
		</td>
		<td align="center">리셀러하위상점Key</td>
 		<td align="center">PB_Cpcode(미사용)</td>
 		<td><input type="text" name="PB_Cpcode" id="PB_Cpcode" size="30"></td>
	</tr>
	<tr>
		<td align="center" colspan="6"> </td>
	</tr>
	<tr>
		<td align="center" colspan="6"><input type="button" value="폰빌 결제창 호출하기" onclick="payRequest()"></td>
	</tr>
</table>
</form>
</body>
</html>