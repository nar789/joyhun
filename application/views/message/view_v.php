<?php
$searcht = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
       '@<style[^>]*?>.*?</style>@siU'    // Strip style tags properly
);
?>
<style type="text/css">
img{border:0;}
a, a:link, a:visited, a:active{color:#383838; text-decoration:none;}
a:hover{text-decoration:underline;}
.boardview1{width:100%; border-top:1px solid #e0e1db; border-bottom:1px solid #efefef; color:#666; font-size:12px; border-collapse:collapse;}
.boardview1 caption{ padding:10 5 8 5; letter-spacing:-1px; text-align:left; font-weight: bold; color:#333;  font-size:14px; }
.boardview1 caption p { float:right; font:normal; font-size:9px; font-family:tahoma; letter-spacing:0px; padding-top:5px; }
.boardview1 caption strong { float:left; }
.boardview1 thead th{line-height:15px; padding:10px 0 5px 5px;; color:#333; text-align:left;}
.boardview1 thead td{padding:8px 0 5px 10px; text-align:right; }
/*.boardview1 tbody td{white-space:nowrap; text-overflow:ellipsis; overflow:hidden;}*/
.boardview1 tbody td.wr_contents{padding:10px; text-align:left; line-height:18px;}
.boardview1 tbody td.link{padding:5px; text-align:left;}
.boardview1 tbody td.sign{padding:10px; border-top:1px solid #e0e1db; border-bottom:1px solid #e0e1db; text-align:left;}
.boardview1 tbody td.good{padding:10px; text-align:right;}
.boardview1 tbody td.tags{padding:8 5 8 33px; text-align:left; background:url('/images/icon_tag.gif') no-repeat 10 8px;}
.boardview1 tbody td.files{padding:10px; text-align:left; background:#f4f4f4; border-top:1px solid #efefef; border-left:1px solid #efefef; border-right:1px solid #efefef;}
.category {color:#6C6C6C; font-size:12px; font-family:tahoma; font:normal; }
.view_num {color:#666666; font-size:9px; font-family:tahoma;}
.date {color:#888888; font-size:11px; font-family:tahoma;}
.ip {color:#B2B2B2; font-size:9px; font-family:tahoma;}

.board_button { width:100%; margin:5px 0 5px 0; padding:0px; text-align:center; }
#comment_list { width:95%; padding:10px; text-align:center; }
#comment_add { width:95%; padding:5px 15px 5px 5px; text-align:center; border:0px solid #efefef; }
/* #gBtn7 */
#gBtn7 a{display:block; background:url('/images/gBtn7_bg.gif') left 0; float:left; font:11px 돋움; color:#555; padding-left:6px; text-decoration:none; height:27px; cursor:pointer; overflow:hidden; letter-spacing:-1px; margin-left:3px;}
#gBtn7 a:hover{background:url('/images/gBtn7_bg.gif') left -27px}
#gBtn7 a span{display:block; float:left; background:url('/images/gBtn7_bg.gif') right 0; line-height:220%; padding-right:6px; height:27px; overflow:hidden}
#gBtn7 a span.btn_img{display:block; float:left; background:url('/images/gBtn7_bg.gif') right 0; line-height:220%; padding-top:4px; padding-right:6px; height:27px; overflow:hidden}
#gBtn7 a:hover span{background:url('/images/gBtn7_bg.gif') right -27px; color:#000}

.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:5px 0 10px 0; }
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

#file_list {
text-align: left;
padding: 10px 0 5px 20px;
width: 90%;
border: 3px solid #eee;
color: #ccc;
margin: 5px 0 0 0px;
}
</style>


<h2><?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '받은':'보낸'; ?> 쪽지 보기</h2>
<div class="board_button">
	<div style="float:left;" id="gBtn7">
	</div>
	<div style="float:right;" id="gBtn7">
	<a href="/message/lists/s" id="btn_list"><span>&nbsp;&nbsp;보낸 목록&nbsp;&nbsp;</span></a>
	<a href="/message/lists/r" id="btn_list"><span>&nbsp;&nbsp;받은 목록&nbsp;&nbsp;</span></a>
	</div>
</div>
<br>
<table cellspacing="0" class="boardview1" border=0>
<thead>
<tr>
	<th scope="row"><?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '보낸':'받은'; ?> 사람 : <?php echo ($views['resv_id'] == $this->session->userdata('userid'))? $views['nickname']:$views['nick'];?></th>
	<td> <?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '받은':'보낸'; ?> 일시 :  <?php echo $views['reg_date']?> , <?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '보낸':'받은'; ?> 일시 :  <?php echo $views['read_date']?>
	 </td>
</tr>
</thead>
<tbody>
<tr>
	<td colspan="2" class="wr_contents">
<?php
$views['contents'] = auto_link($views['contents']);
?>
		<!--내용 출력-->
	    <?php echo $views['contents']?>

	</td>
</tr>
<tr>
	<td colspan="2" class="good">
		<div id="gBtn7" style="float:right">
<?php
if ($views['resv_id'] == $this->session->userdata('userid')) 
{
?>
		<!--<a href="#" id="vote_against_icon" id="btn_list"><span>&nbsp;&nbsp;신고&nbsp;&nbsp;</span></a>-->
<?php
}
?>
		<a href="/message/delete/<?php echo $views['no']?>" id="btn_list"><span>&nbsp;&nbsp;삭제&nbsp;&nbsp;</span></a>
		</div>
	</td>
</tr>

</tbody>
</table>
<!--
<script>
$("#vote_against_icon").click(function(){
	var cfm = confirm('신고하시겠습니까?');
	if(cfm) {
		$.ajax({
			type: "POST",
			url: "/action/recommend",
			data: {"no":"<?php echo $views['no']?>", "mode":"blamed"},
			success: function(data, textStatus){
				alert('신고되었습니다.');
			}
		});
	}
});
</script>
-->
<BR>
<div id="comment_add">
<form name="add_comment" action="/message/views/<?php echo $views['no']?>/<?php echo ($views['resv_id'] == $this->session->userdata('userid'))? $views['send_id']: $views['resv_id'];?>" method="post">
<textarea name='contents' cols="80" rows="6"></textarea>
<input type="submit" value="<?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '답장': '다시';?> 보내기" />
</form>
<?php
if (validation_errors())
{
?>
	<div>
		<?php echo validation_errors(); ?>
 	</div>
<?php    
}
?>
</div>

<div class="board_button">
	<div style="float:left;" id="gBtn7">
	</div>
	<div style="float:right;" id="gBtn7">
	<a href="/message/lists/<?php echo ($views['resv_id'] == $this->session->userdata('userid'))? 'r':'s'; ?>" id="btn_list"><span>&nbsp;&nbsp;<?php echo ($views['resv_id'] == $this->session->userdata('userid'))? '받은':'보낸'; ?> 목록&nbsp;&nbsp;</span></a>
	 </div>
</div>

