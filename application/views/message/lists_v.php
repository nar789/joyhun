<script type="text/javascript" src="<?php echo JS_DIR ?>/jquery.post.js"></script>
<script>
$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $(":select:option[name=sfl]:selected").val();
		if($("#q").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
			var act = '<?php echo  $url ?>/q/'+$("#q").val()+'/sfl/'+sfl_val;
			$("#bd_search").attr('action', act).submit();
    	}
	});
});

function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}
</script>
<style>
.board_list { clear:both; width:100%; table-layout:fixed; margin:5px 0 0 0; }
.board_list th { font-weight:bold; font-size:12px; }
.board_list th { white-space:nowrap; height:34px; overflow:hidden; text-align:center; }
.board_list th { border-top:1px solid #ddd; border-bottom:1px solid #ddd; }

.board_list tr.bg1 { background-color:#fafafa; border-bottom:1px solid #ddd; }
.board_list tr.bg0 { background-color:#ffffff; border-bottom:1px solid #ddd; }

.board_list td { padding:.5em; font-family:Tahoma; font-size:12px; color:#808080; }

.board_list td.num { color:#999999; text-align:center; }
.board_list td.checkbox { text-align:center; }
.board_list td.subject { overflow:hidden; }
.board_list td.name { padding:0 0 0 10px; }
.board_list td.datetime { font:normal 12px tahoma; text-align:center; }
.board_list td.hit { font:normal 12px tahoma; text-align:center; }
.board_list td.good { font:normal 12px tahoma; text-align:center; }
.board_list td.nogood { font:normal 12px tahoma; text-align:center; }

.board_list .notice { font-weight:normal; }
.board_list .current { font:bold 11px tahoma; color:#E15916; }
.board_list .comment { font-family:Tahoma; font-size:10px; color:#EE5A00; }

.board_button { clear:both; margin:10px 0 0 0; }

.board_page { clear:both; font:normal 12px tahoma; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:#777; }

.board_search { text-align:center; margin:10px 0 0 0; }
.board_search .stx { height:18px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; }
</style>

<h2><?php echo ($type == 'r')? '받은':'보낸'; ?> 쪽지 목록</h2>
<div class="board_button">
	<div style="float:left;" id="gBtn7">
	</div>
	<div style="float:right;" id="gBtn7">
	<a href="/message/lists/s" id="btn_list"><span>&nbsp;&nbsp;보낸 목록&nbsp;&nbsp;</span></a>
	<a href="/message/lists/r" id="btn_list"><span>&nbsp;&nbsp;받은 목록&nbsp;&nbsp;</span></a>
	</div>
</div>
<br>
<table width="99%" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td>
    <table cellspacing="0" cellpadding="0" class="board_list">
    <col width="50" />
    <col />
    <col width="100" />
    <col width="100" />
	<col width="100" />
	<tr>
	    <th>번호</th>
	    <th>내용</th>
	    <th><?php echo ($type == 's')? '받은':'보낸'; ?>사람</th>
	    <th><?php echo ($type == 'r')? '받은':'보낸'; ?>일시</th>
	    <th>읽은일시</th>
	</tr>

<?php
if($list_total > 0) {

foreach ($list as $lt)
{
	$b1 = $b2 = '';
	if ($type == 'r' and $lt['read_date'] == '0000-00-00 00:00:00')
	{
    	$b1 = "<b>";
    	$b2 = "</b>";
 	}
?>
 	<tr class="bg0">
    	<td class="num"><?php echo  $lt['no'] ?></td>
     	<td class="subject"><a href="/message/views/<?php echo $lt['no']?>/<?php echo $type?>"><?php echo  $b1.strcut_utf8(strip_tags($lt['contents']), 27).$b2 ?></a></td>
		<td class="hit"><?php echo  ($type == 'r')? $lt['nickname']:$lt['nick'] ?></td>
		<td class="datetime"><?php echo  substr($lt['reg_date'], 0, 10) ?></td>
        <td class="datetime"><?php echo  substr($lt['read_date'], 0, 10) ?></td>
  	</tr>
<?php
}
}
else
{
?>
	<tr class="bg0">
		<td class="num" colspan="5">쪽지가 없습니다.</td>
  	</tr>
<?php
}
?>
    </table>

    <!-- 페이지 -->
    <div class="board_page"><?php echo  $pagination_links ?></div>

    <!-- 검색 -->
    <div class="board_search">
    <form id="bd_search" method="post" onsubmit="javascript:return false;">
<?php
$sfl_arr = array('contents'=>'내용', 'send_id'=>'보낸아이디', 'send_user_name'=>'보낸닉네임');
?>
        <select name="sfl">
<?php
while (list($key, $value) = each($sfl_arr))
{
	if ($sfl == $key) {
		$chk = ' selected';
	} else {
		$chk = '';
	}
?>
        	<option value="<?php echo $key?>" <?php echo $chk?>><?php echo $value?></option>
<?php
}
?>

        </select>
        <input name="q" id="q" class="stx" maxlength="15" value="<?php echo $search_word?>" onkeypress="board_search_enter(document.q);">
        <input type="button" id="search_btn" value="검색">
    </form>
    </div>

	</td>
</tr>
</table>
