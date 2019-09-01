<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<?php
exit;
$con = mssql_connect ("joy_mssql", "JoyPoever", "vmffoxlsja!@34") or die("Couldn't connect to SQL Server on $myServer. Error: " . mssql_get_last_message());
mssql_select_db ("Joyhunting", $con);

$connect = mysql_connect("localhost","joyhunting","whdlgjsxld@db") or die("mysql DB접속에러");
mysql_select_db("joyhunting",$connect) or die("DB선택에러");

$sql= "SELECT top 1 *  FROM TotalMembers";
$result= mssql_query ($sql, $con);
$row = mssql_fetch_assoc($result);

//	$row[m_nick] = iconv("EUC-KR", "UTF-8", $row[m_nick]);
//	$row[m_nick] = iconv("CP949", "UTF-8", $row[m_nick]);
//	echo $row[m_nick];

//    echo mb_detect_encoding( $row[m_nick], "EUC-KR, UTF-8, ASCII, CP949");

//mysql_query("
//INSERT INTO `joyhunting`.`test` (`m_name`, `m_nick`) VALUES ('이홍길동','아름다운');
//");

$sql= "SELECT *  FROM test limit 1";
$result= mysql_query($sql, $connect);
$row = mysql_fetch_array($result);

echo $row[m_name]." ".$row[m_nick];


exit;

mysql_query("
INSERT INTO `joyhunting`.`Result` (`m_num`, `m_userid`, `m_pwd`, `m_pwd2`, `m_name`, `m_nick`, `m_jumin1`, `m_jumin2`, `m_age`, `m_age2`, `m_sex`, `m_region`, `m_post1`, `m_post2`, `m_addr1`, `m_addr2`, `m_hp1`, `m_hp2`, `m_hp3`, `m_hp_view`, `m_hp_sms`, `m_mail`, `m_mail_yn`, `m_job`, `m_reason`, `m_file`, `m_filename`, `m_avataid`, `m_type`, `m_partner`, `m_in_date`, `m_up_date`, `logon`, `m_ip`, `m_arsid`, `m_arsid_in`, `m_height`, `m_weight`, `m_instyle`, `m_outstyle`, `m_character`, `m_boldid`, `m_region2`, `m_level`, `m_pass_search`, `m_pass_answer`, `m_name_yn`, `m_conregion`, `m_conregion2`, `m_conregion3`, `m_school`, `m_message`, `open_cafe_code`, `m_mobile_chk`, `m_member_out`, `m_master`, `m_check_master`, `m_joinReg`, `m_otherJoin`, `m_hpcomp`, `m_blood`, `m_random`, `m_ipinck`, `m_mail_error`, `m_partner_check`, `last_login_day`, `last_login_ip`) VALUES ('$row[m_num]','$row[m_userid]','$row[m_pwd]','$row[m_pwd2]','$row[m_name]','$row[m_nick]','$row[m_jumin1]','$row[m_jumin2]','$row[m_age]','$row[m_age2]','$row[m_sex]','$row[m_region]','$row[m_post1]','$row[m_post2]','$row[m_addr1]','$row[m_addr2]','$row[m_hp1]','$row[m_hp2]','$row[m_hp3]','$row[m_hp_view]','$row[m_hp_sms]','$row[m_mail]','$row[m_mail_yn]','$row[m_job]','$row[m_reason]','$row[m_file]','$row[m_filename]','$row[m_avataid]','$row[m_type]','$row[m_partner]','$row[m_in_date]','$row[m_up_date]','$row[logon]','$row[m_ip]','$row[m_arsid]','$row[m_arsid_in]','$row[m_height]','$row[m_weight]','$row[m_instyle]','$row[m_outstyle]','$row[m_character]','$row[m_boldid]','$row[m_region2]','$row[m_level]','$row[m_pass_search]','$row[m_pass_answer]','$row[m_name_yn]','$row[m_conregion]','$row[m_conregion2]','$row[m_conregion3]','$row[m_school]','$row[m_message]','$row[open_cafe_code]','$row[m_mobile_chk]','$row[m_member_out]','$row[m_master]','$row[m_check_master]','$row[m_joinReg]','$row[m_otherJoin]','$row[m_hpcomp]','$row[m_blood]','$row[m_random]','$row[m_ipinck]','$row[m_mail_error]','$row[m_partner_check]','$row[last_login_day]','$row[last_login_ip]');
");

echo "유티에프팔 입니다<br>";

$sql= "SELECT *  FROM Result limit 1";
$result= mysql_query($sql, $connect);
$row = mysql_fetch_array($result);

echo $row[m_name]." ".$row[m_nick];


mssql_close ($con);
mysql_close ($connect);
?>