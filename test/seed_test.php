<?
/*
	모빌리언스 결제 데이터 Seed 암호화  TEST 환경설정 부분
*/
define("VER","0000");					// 암호화 버전
define("CRYPTGB","1");				// 암호화 구분  1 :수정불가
define("CURKEY","0");					// 암호화 key 설정값  0 :default / 1: 사용자지정1  / 2: 사용자지정2 
define("KEY1","42353454");						// 암호화 key 가맹점이 지정한1값 (8byte)
define("KEY2","45687534");						// 암호화 key 가맹점이 지정한2값 (8btye)

///////////////////////////////////////////////////////////////////////////////////////////
// 설치된 암호화 C 모듈 실행파일을 포함해서 가맹점 서버에 설치한 절대경로를 적어주셔야 합니다.
// ex) /usr/local/bin/libChiper 
//////////////////////////////////////////////////////////////////////////////////////////
define("SEEDEXE","/opt/mcash/seed/libCipher");	// 이 경로는 임의의 경로입니다.수정바랍니다.


/*****************************************************************
함수명 : seed_exe_test 암복호화 실행 TEST
사용법 : seed_exe_test ("암복호화구분","암복호화키번호","암복호화할데이터")
주의사항 : 절대수정금지
*****************************************************************/
function seed_exe_test($seedMode,$seedKey,$seedStr)
{
	global $gSvcid;
	$gSvcid="00000000"; 
	
	$str = "";
	
	//seedKey 번호가    0 :default  / 1 : KEY1 가맹점의 설정값1 / 2 : KEY2 가맹점의 설정값2  [seedKey 값은 16byte 고정]
	if(CRYPTGB == 0){ 

		return $seedStr;

	}else if(CRYPTGB== 1){

		if($seedKey == 0){
			$seedKey = substr($gSvcid,0,8).substr($gSvcid,0,8);
		}else if($seedKey == 1){
			$seedKey = KEY1.substr($gSvcid,0,8);
		}else if($seedKey == 2){
			$seedKey = KEY2.substr($gSvcid,0,8);
		}

		$str = exec(SEEDEXE." ".$seedMode." ".$seedKey." '".$seedStr."'");
	
		if( $seedMode == "E" ){
			return $str;
		}else if( $seedMode== "D" ){  //복호화일때는 마지막 1byte 자른 후 리턴 (마지막이 빈공백인 경우 값이 없어지는 부분 처리)
			return substr($str,0,-1);
		}

	}

}

//암호화 일때
if($_REQUEST['cmd'] == "E"){
	$encodestr=$_REQUEST['seedStr'];
	$encode_str = seed_exe_test("E",CURKEY,$encodestr);

	//테스트 값으로 정상적인 암호화되는지 판별
	if($seedKey == 0 && $encodestr == "test1234"){
		if(	$encode_str == "16de69f56f9b40fe43887859bf310265"){
			$encode_yn = "<font color='blue'>암호화가 정상적으로 실행되었습니다.</font>";
		}else{
			$encode_yn = "<font color='red'>암복호화 실행파일이 정상적으로 설치가 되지 않았습니다.</font>";
		}
	}

}else{ //복호화일때

	$encode_str = $_REQUEST['seedStr'];
	$encode_str = seed_exe_test("E",CURKEY,$_REQUEST['seedStr']);
	$decodestr=$_REQUEST['encodestr'];
	$decode_str = seed_exe_test("D",CURKEY,$decodestr);

	//테스트 값으로 정상적인 복호화되는지 판별
	if($decodestr == "16de69f56f9b40fe43887859bf310265"){
		if(	$seedKey == 0 && $decode_str == "test1234"){
			$decode_yn = "<font color='blue'>복호화가 정상적으로 실행되었습니다.</font>";
		}else{
			$decode_yn = "<font color='red'>암복호화 실행파일이 정상적으로 설치가 되지 않았습니다.</font>";
		}
	}

}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> SEED TEST [PHP] </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <SCRIPT LANGUAGE="JavaScript">
  <!--
	function seedTest(str){
	
		if (str=="E"){

			if(document.forms[0].seedStr.value.length==0){
				alert("암호화 TEST 할 값을 넣어주세요!!");
				return;
			}

			document.forms[0].cmd.value=str;
			document.forms[0].encodestr.value=document.forms[0].seedStr.value;
		}else{

			if(document.forms[0].decodestr.value.length==0){
				alert("복호화 할 값이 없습니다. 확인해 주세요!!");
				return;
			}

			document.forms[0].cmd.value=str;
		}
		document.forms[0].submit();
	}
  //-->
  </SCRIPT>
 </HEAD>

 <BODY>
  <TABLE border="0"  style="padding:5 5 5 5">
  <form method="get" name="seed" action="seed_test.php">
  <input type="hidden"  name="cmd" value="">
  <input type="hidden"  name="encodestr" size="40"  value="<?echo $encode_str?>">
  <TR>
	<TD colspan="2"><b>[ 암호화 / 복호화 테스트 ]</b></TD>
  </TR>
   <TR>
	<TD colspan="2" height="20">* 암호화 할 String값에 앞 중간 뒤에 공백도 포함시켜서 테스트 해보세요.<br>
	<pre>ex) [test 11234] , [  2003 testvalue] , [testabcd     ]
	<b>test1234</b>  를 암호화 했을 때 <b>16de69f56f9b40fe43887859bf310265</b>  로 나오면 정상
	그 외 값으로 리턴되면 비정상적인 설치경우로 모빌리언스 기술지원팀으로 문의바람</pre>
	</TD>
  </TR>
  <TR>
	<TD>암호화 할 String값<br>(최대16자리)</TD>
	<TD>&nbsp;<input type="text"  name="seedStr" size="40" value="<?if(!isset($seedStr)){echo "test1234"; }else{ echo $seedStr;}?>" maxlength="16"></TD>
  </TR>
  <TR>
	<TD></TD>
	<TD>&nbsp; 암호화 할 String값 Length : <?echo strlen($seedStr)?><br>
	<?echo $encode_yn?>
	</TD>
  </TR>
    <TR>
	<TD>&nbsp;</TD>
	<TD align="center"><input type="button"  name="e" value="암호화실행"  onClick="javascript:seedTest('E');"></TD>
  </TR>
     <TR>
	<TD>암호화 된 결과값</TD>
	<TD>&nbsp;<pre>[<?echo $encode_str?>]</pre></TD>
  </TR>

  </TR>
     <TR>
	<TD colspan="2">=====================================================================</TD>
  </TR>

  
  <TR>
	<TD>복호화 할 String값</TD>
	<TD>&nbsp;<input type="text"  name="decodestr" size="40" value="<?echo $encode_str?>"></TD>
  </TR>
  <TR>
	<TD>&nbsp;</TD>
	<TD align="center"><input type="button"  name="d" value="복호화실행" onClick="javascript:seedTest('D');"></TD>
  </TR>
 <TR>
	<TD>복호화 결과값</TD>
	<TD>&nbsp;[<?echo $decode_str?>] Length : <?echo strlen($decode_str)?>
	<br>
	<?echo $decode_yn?>
	</TD>
  </TR>

  <TR>
	<TD colspan="2" align="center">&nbsp;<a href="seed_test.php">초기화</a></TD>
  </TR>
  </form>
  </TABLE>


 </BODY>
</HTML>