<?

	/*###################################################################################
	# 결제 성공시 웹 페이지 전환으로 호출되는 페이지이며 가맹점에서 구현해야하는 페이지
	#
	# 결제 성공에 따른 결과를 사용자에게 출력 또는 서비스처리 페이지
	# notiurl 에서 결과 저장시 중복 처리 주의 필요
	# 팝업 형식의 결제창 사용시 가맹점 부모창에 대한 스크립트 처리를 하시면 됩니다.
	###################################################################################*/

	$CASH_GB    = $_POST["CASH_GB"   ]; //결제수단
	$Mrchid     = $_POST["Mrchid"    ]; //상점아이디
	$Svcid      = $_POST["Svcid"     ]; //서비스아이디
	$Mobilid    = $_POST["Mobilid"   ]; //모빌리언스 거래번호
	$Signdate   = $_POST["Signdate"  ]; //결제일자
	$Tradeid    = $_POST["Tradeid"   ]; //상점거래번호
	$Prdtnm     = $_POST["Prdtnm"    ]; //상품명
	$Prdtcd     = $_POST["Prdtcd"    ]; //상품코드
	$Prdtprice  = $_POST["Prdtprice" ]; //상품가격
	$Commid     = $_POST["Commid"    ]; //이통사
	$No         = $_POST["No"        ]; //폰번호
	$Resultcd   = $_POST["Resultcd"  ]; //결과코드
	$Resultmsg  = $_POST["Resultmsg" ]; //결과메세지
	$Userid     = $_POST["Userid"    ]; //사용자ID
	$MSTR       = $_POST["MSTR"      ]; //가맹점 전달 콜백변수
	$Payeremail = $_POST["Payeremail"]; //결제자 이메일
	$Item = $_POST["Item"]; //아이템

/* 리턴되는 파라미터 확인시
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$http_vars = $_GET;
		} else if($_SERVER["REQUEST_METHOD"] == "POST") {
			$http_vars = $_POST;
		}

		reset($http_vars);
		while(list($key, $val) = each($http_vars))
		{
			echo $key."[".$val."]<br> ";
		}
*/

	/*####################################################################################
	' 아래는 결과를 단순히 출력하는 샘플입니다.
	' 가맹점에서는 부모창 전환등 스크립트 처리등을 하시면 됩니다.
	####################################################################################*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>가맹점 OKURL 모빌리언스 폰빌결제</title>
</head>
<body>
<!-- input user information# -->
<table border ='1' width="100%">
	<tr>
		<td>CASH_GB</td>
		<td><?echo $CASH_GB;?></td>
	</tr>
	<tr>
		<td width="25%">Mrchid</td>
		<td width="75%"><?echo $Mrchid;?></td>
	</tr>
	<tr>
		<td>Svcid</td>
		<td><?echo $Svcid;?></td>
	</tr>
	<tr>
		<td>Mobilid</td>
		<td><?echo $Mobilid;?></td>
	</tr>
	<tr>
		<td>Signdate</td>
		<td><?echo $Signdate;?></td>
	</tr>
	<tr>
		<td>Tradeid</td>
		<td><?echo $Tradeid;?></td>
	</tr>
	<tr>
		<td>Prdtnm</td>
		<td><?echo $Prdtnm;?></td>
	</tr>
	<tr>
		<td>Prdtprice</td>
		<td><?echo $Prdtprice;?></td>
	</tr>
	<tr>
		<td>No</td>
		<td><?echo $No;?></td>
	</tr>
	<tr>
		<td>Commid</td>
		<td><?echo $Commid;?></td>
	</tr>
	<tr>
		<td>Resultcd</td>
		<td><?echo $Resultcd;?></td>
	</tr>
	<tr>
		<td>Resultmsg</td>
		<td><?echo $Resultmsg;?></td>
	</tr>
	<tr>
		<td>Userid</td>
		<td><?echo $Userid;?></td>
	</tr>
	<tr>
		<td>MSTR</td>
		<td><?echo $MSTR;?></td>
	</tr>
	<tr>
		<td>Prdtcd</td>
		<td><?echo $Prdtcd;?></td>
	</tr>
	<tr>
		<td>Payeremail</td>
		<td><?echo $Payeremail;?></td>
	</tr>
	<tr>
		<td>Item</td>
		<td><?echo $Item;?></td>
	</tr>
</table>
</body>
</html>