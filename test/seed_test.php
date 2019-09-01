<?
/*
	������� ���� ������ Seed ��ȣȭ  TEST ȯ�漳�� �κ�
*/
define("VER","0000");					// ��ȣȭ ����
define("CRYPTGB","1");				// ��ȣȭ ����  1 :�����Ұ�
define("CURKEY","0");					// ��ȣȭ key ������  0 :default / 1: ���������1  / 2: ���������2 
define("KEY1","42353454");						// ��ȣȭ key �������� ������1�� (8byte)
define("KEY2","45687534");						// ��ȣȭ key �������� ������2�� (8btye)

///////////////////////////////////////////////////////////////////////////////////////////
// ��ġ�� ��ȣȭ C ��� ���������� �����ؼ� ������ ������ ��ġ�� �����θ� �����ּž� �մϴ�.
// ex) /usr/local/bin/libChiper 
//////////////////////////////////////////////////////////////////////////////////////////
define("SEEDEXE","/opt/mcash/seed/libCipher");	// �� ��δ� ������ ����Դϴ�.�����ٶ��ϴ�.


/*****************************************************************
�Լ��� : seed_exe_test �Ϻ�ȣȭ ���� TEST
���� : seed_exe_test ("�Ϻ�ȣȭ����","�Ϻ�ȣȭŰ��ȣ","�Ϻ�ȣȭ�ҵ�����")
���ǻ��� : �����������
*****************************************************************/
function seed_exe_test($seedMode,$seedKey,$seedStr)
{
	global $gSvcid;
	$gSvcid="00000000"; 
	
	$str = "";
	
	//seedKey ��ȣ��    0 :default  / 1 : KEY1 �������� ������1 / 2 : KEY2 �������� ������2  [seedKey ���� 16byte ����]
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
		}else if( $seedMode== "D" ){  //��ȣȭ�϶��� ������ 1byte �ڸ� �� ���� (�������� ������� ��� ���� �������� �κ� ó��)
			return substr($str,0,-1);
		}

	}

}

//��ȣȭ �϶�
if($_REQUEST['cmd'] == "E"){
	$encodestr=$_REQUEST['seedStr'];
	$encode_str = seed_exe_test("E",CURKEY,$encodestr);

	//�׽�Ʈ ������ �������� ��ȣȭ�Ǵ��� �Ǻ�
	if($seedKey == 0 && $encodestr == "test1234"){
		if(	$encode_str == "16de69f56f9b40fe43887859bf310265"){
			$encode_yn = "<font color='blue'>��ȣȭ�� ���������� ����Ǿ����ϴ�.</font>";
		}else{
			$encode_yn = "<font color='red'>�Ϻ�ȣȭ ���������� ���������� ��ġ�� ���� �ʾҽ��ϴ�.</font>";
		}
	}

}else{ //��ȣȭ�϶�

	$encode_str = $_REQUEST['seedStr'];
	$encode_str = seed_exe_test("E",CURKEY,$_REQUEST['seedStr']);
	$decodestr=$_REQUEST['encodestr'];
	$decode_str = seed_exe_test("D",CURKEY,$decodestr);

	//�׽�Ʈ ������ �������� ��ȣȭ�Ǵ��� �Ǻ�
	if($decodestr == "16de69f56f9b40fe43887859bf310265"){
		if(	$seedKey == 0 && $decode_str == "test1234"){
			$decode_yn = "<font color='blue'>��ȣȭ�� ���������� ����Ǿ����ϴ�.</font>";
		}else{
			$decode_yn = "<font color='red'>�Ϻ�ȣȭ ���������� ���������� ��ġ�� ���� �ʾҽ��ϴ�.</font>";
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
				alert("��ȣȭ TEST �� ���� �־��ּ���!!");
				return;
			}

			document.forms[0].cmd.value=str;
			document.forms[0].encodestr.value=document.forms[0].seedStr.value;
		}else{

			if(document.forms[0].decodestr.value.length==0){
				alert("��ȣȭ �� ���� �����ϴ�. Ȯ���� �ּ���!!");
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
	<TD colspan="2"><b>[ ��ȣȭ / ��ȣȭ �׽�Ʈ ]</b></TD>
  </TR>
   <TR>
	<TD colspan="2" height="20">* ��ȣȭ �� String���� �� �߰� �ڿ� ���鵵 ���Խ��Ѽ� �׽�Ʈ �غ�����.<br>
	<pre>ex) [test 11234] , [  2003 testvalue] , [testabcd     ]
	<b>test1234</b>  �� ��ȣȭ ���� �� <b>16de69f56f9b40fe43887859bf310265</b>  �� ������ ����
	�� �� ������ ���ϵǸ� ���������� ��ġ���� ������� ������������� ���ǹٶ�</pre>
	</TD>
  </TR>
  <TR>
	<TD>��ȣȭ �� String��<br>(�ִ�16�ڸ�)</TD>
	<TD>&nbsp;<input type="text"  name="seedStr" size="40" value="<?if(!isset($seedStr)){echo "test1234"; }else{ echo $seedStr;}?>" maxlength="16"></TD>
  </TR>
  <TR>
	<TD></TD>
	<TD>&nbsp; ��ȣȭ �� String�� Length : <?echo strlen($seedStr)?><br>
	<?echo $encode_yn?>
	</TD>
  </TR>
    <TR>
	<TD>&nbsp;</TD>
	<TD align="center"><input type="button"  name="e" value="��ȣȭ����"  onClick="javascript:seedTest('E');"></TD>
  </TR>
     <TR>
	<TD>��ȣȭ �� �����</TD>
	<TD>&nbsp;<pre>[<?echo $encode_str?>]</pre></TD>
  </TR>

  </TR>
     <TR>
	<TD colspan="2">=====================================================================</TD>
  </TR>

  
  <TR>
	<TD>��ȣȭ �� String��</TD>
	<TD>&nbsp;<input type="text"  name="decodestr" size="40" value="<?echo $encode_str?>"></TD>
  </TR>
  <TR>
	<TD>&nbsp;</TD>
	<TD align="center"><input type="button"  name="d" value="��ȣȭ����" onClick="javascript:seedTest('D');"></TD>
  </TR>
 <TR>
	<TD>��ȣȭ �����</TD>
	<TD>&nbsp;[<?echo $decode_str?>] Length : <?echo strlen($decode_str)?>
	<br>
	<?echo $decode_yn?>
	</TD>
  </TR>

  <TR>
	<TD colspan="2" align="center">&nbsp;<a href="seed_test.php">�ʱ�ȭ</a></TD>
  </TR>
  </form>
  </TABLE>


 </BODY>
</HTML>