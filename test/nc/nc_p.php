<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<?php 

$sSiteID = "AC26";  	// NICE평가정보에서 부여받은 사이트아이디(사이트코드)를 수정한다.
$sSitePW = "53497206";    // NICE평가정보에서 부여받은 비밀번호 수정한다.

	/*
	┌ cb_encode_path 변수에 대한 설명  ─────────────────────────────────────────────────────
		모듈 경로설정은, '/절대경로/모듈명' 으로 정의해 주셔야 합니다.
		
		+ FTP 로 모듈 업로드시 전송형태를 'binary' 로 지정해 주시고, 권한은 755 로 설정해 주세요.
		
		+ 절대경로 확인방법
		  1. Telnet 또는 SSH 접속 후, cd 명령어를 이용하여 모듈이 존재하는 곳까지 이동합니다.
		  2. pwd 명령어을 이용하면 절대경로를 확인하실 수 있습니다.
		  3. 확인된 절대경로에 '/모듈명'을 추가로 정의해 주세요.
	└────────────────────────────────────────────────────────────────────
	*/
	$cb_encode_path = "/home/joyhunting/www/include/nice/SNameCheck";			// SNameCheck 모듈이 설치된 위치의 절대경로와 SNameCheck 모듈명까지 입력한다.


	$strJumin= $_POST["jumin"];		// 주민번호
	$strName = iconv('utf-8', 'euc-kr', $_POST["name"]);		//이름
	$strgender = $_POST["gender"];		// 여성 0, 남성 1 
	
	$iReturnCode  = "";	

								// shell_exec() 와 같은 실행함수 호출부 입니다. 홑따옴표가 아니오니 이점 참고해 주세요.
	//실행함수 호출하여 iReturnCode 의 변수에 값을 담는다.		
	//$iReturnCode = `$cb_encode_path $sSiteID $sSitePW $strJumin $strName`;	//주민번호 앞자리 인증(주민6자리, 이름)
	//$iReturnCode = `$cb_encode_path $sSiteID $sSitePW $strJumin $strgender $strName`;	//생년월일 인증(생년월일8자리, 성별, 이름)	
	
	$iReturnCode = `$cb_encode_path $sSiteID $sSitePW $strJumin $strgender $strName`;
								
								//iReturnCode 변수값에 따라 아래 참고하셔서 처리해주세요.(결과값의 자세한 사항은 리턴코드.txt 파일을 참고해 주세요~)
								//iReturnCode :	1 이면 --> 실명인증 성공 : XXX.php 로 페이지 이동. 
								//							2 이면 --> 실명인증 실패 : 주민과 이름이 일치하지 않음. 사용자가 직접 www.namecheck.co.kr 로 접속하여 등록 or 1600-1522 콜센터로 접수요청.
								//												아래와 같이 NICE평가정보에서 제공한 자바스크립트 이용하셔도 됩니다.		
								//							3 이면 --> NICE평가정보 해당자료 없음 : 사용자가 직접 www.namecheck.co.kr 로 접속하여 등록 or 1600-1522 콜센터로 접수요청.
								//												아래와 같이 NICE평가정보에서 제공한 자바스크립트 이용하셔도 됩니다.
								//							5 이면 --> 체크썸오류(주민번호생성규칙에 어긋난 경우: 임의로 생성한 값입니다.)
								//							50이면 --> 크레딧뱅크의 명의도용차단 서비스 가입자임 : 직접 명의도용차단 해제 후 실명인증 재시도.
								//												아래와 같이 NICE평가정보에서 제공한 자바스크립트 이용하셔도 됩니다.
								//							그밖에 --> 30번대, 60번대 : 통신오류 ip: 203.234.219.72 port: 81~85(5개) 방화벽 관련 오픈등록해준다. 
								//												(결과값의 자세한 사항은 리턴코드.txt 파일을 참고해 주세요~) 

        switch($iReturnCode){
        //실명인증 성공입니다. 업체에 맞게 페이지 처리 하시면 됩니다.
    	case 1:
        echo $iReturnCode;
        
?>
			<script language='javascript'>     
      	alert("인증성공!! ^^");          
      </script>
      
                                
			<!-- 페이지 처리를 하실때에는 아래와같이 처리하셔도 됩니다. 이동할 페이지로 수정해서 사용하시면 됩니다. 
			<html>
				<head>
				</head>
				<body onLoad="document.form1.submit()">
					<form name="form1" method="post" action=XXX.php>
						<input type="hidden" name="jumin1" value="<?=$jumin1?>">
						<input type="hidden" name="jumin2" value="<?=$jumin2?>">
						<input type="hidden" name="name" value="<?=$strName?>">
					</form>
				</body>
			</html>
			-->
     
<?
			break;
			//리턴값 2인 사용자의 경우, www.namecheck.co.kr 의 실명등록확인 또는 02-1600-1522 콜센터로 문의주시기 바랍니다.   			
		case 2:   
?>
            <script language="javascript">
               history.go(-1); 
               var URL ="http://www.creditbank.co.kr/its/its.cb?m=namecheckMismatch"; 
               var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no, width= 640, height= 480, top=0,left=20"; 
               window.open(URL,"",status); 
            </script> 

<?
			break;
			//'리턴값 3인 사용자의 경우, www.namecheck.co.kr 의 실명등록확인 또는 02-1600-1522 콜센터로 문의주시기 바랍니다.   			
		case 3:
?>
            <script language="javascript">
			alert("<?=$iReturnCode?>");
			history.back(-1);
               //history.go(-1); 
               //var URL ="http://www.creditbank.co.kr/its/its.cb?m=namecheckMismatch"; 
               //var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no, width= 640, height= 480, top=0,left=20"; 
               //window.open(URL,"",status); 
            </script> 

<?
			break;
			//리턴값 50 명의도용차단 서비스 가입자의 경우, www.creditbank.co.kr 에서 명의도용차단해제 후 재시도 해주시면 됩니다. 
			// 또는 02-1600-1533 콜센터로문의주세요.                                                                             
		case 50;
?>
            <script language="javascript">
               history.go(-1); 
               var URL ="http://www.creditbank.co.kr/its/itsProtect.cb?m=namecheckProtected"; 
               var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no, width= 640, height= 480, top=0,left=20"; 
               window.open(URL,"",status); 
            </script> 

<?
			break;
		default:
		
?>
		   <script language='javascript'>
				alert("인증에 실패 하였습니다 성명이나 주민번호를 확인하세요. 리턴코드:[<?=$iReturnCode?>]");
				history.go(-1);
		   </script>
<?
			break;
 }
?>
 
