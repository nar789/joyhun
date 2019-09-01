<h2>쪽지 발송</h2>
<br>
<form action="/message/send/<?php echo $this->uri->segment(3)?>" method="post" name="write_post">
<table width="98%" align="center">
<tr>
	<td width="80">받는사람</td>
	<td align="left">    <?php echo $user_info['nickname']?>

	</td>
</tr>
<tr>
	<td>보낼 내용</td>
	<td align="left">
    <textarea name='contents' cols="35" rows="10"></textarea>
	</td>
</tr>
<?php
if (validation_errors())
{
?>
	<tr><td colspan="2">
            <?php echo validation_errors(); ?>
 	</td></tr>
<?php    
}
?>
<tr>
	<td colspan="2" align="center"><input type="submit" value="보내기" /></td>
</tr>
</table>
</form>