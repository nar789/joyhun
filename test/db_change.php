<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
exit;
$DB_name = "joyhunting";
$connect = mysql_connect("localhost","joyhunting","whdldb1234!!") or die("DB접속에러");
mysql_select_db($DB_name,$connect) or die("DB선택에러");

$sql = "select m_num, m_name, m_nick, m_addr1, m_addr2, m_filename, m_conregion, m_conregion2 from Result ";

$result = mysql_query($sql,$connect);

function detectEncoding($str){

	$charSetList = array("utf-8","euc-kr","cp494","cp949");
    
	foreach ($charSetList as $c) {
          $tmp = iconv($c, $c, $str);
          if (md5($tmp) == md5($str)){
                 return $c;
          }
     }
    return false;

}

while($row = mysql_fetch_array($result)){

	$m_num = $row[m_num];

	echo $row[m_name]."<br>";
	$m_name = iconv("cp949", "UTF-8", $row[m_name]);
	echo detectEncoding($row[m_name])."<br>";
	echo iconv("cp949", "UTF-8", $row[m_name]);

	exit;

	$m_name = $row[m_name];
	$m_nick = iconv("CP949", "UTF-8", $row[m_nick]);
	$m_addr1 = iconv("CP949", "UTF-8", $row[m_addr1]);
	$m_addr2 = iconv("CP949", "UTF-8", $row[m_addr2]);
	$m_filename = iconv("CP949", "UTF-8", $row[m_filename]);
	$m_conregion = iconv("CP949", "UTF-8", $row[m_conregion]);
	$m_conregion2 = iconv("CP949", "UTF-8", $row[m_conregion2]);

	//mysql_query("update Result set m_name = '$m_name', m_nick = '$m_nick', m_addr1 = '$m_addr1', m_addr2 = '$m_addr2', m_filename = '$m_filename', m_conregion = '$m_conregion', m_conregion2 = '$m_conregion' where idx = '$idx'");

	echo "update Result set m_name = '$m_name', m_nick = '$m_nick', m_addr1 = '$m_addr1', m_addr2 = '$m_addr2', m_filename = '$m_filename', m_conregion = '$m_conregion', m_conregion2 = '$m_conregion' where m_num = '$m_num' <br>";

}

?>