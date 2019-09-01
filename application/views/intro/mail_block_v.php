<div class="content">
	<div class="anm_bg">
		<table class="table_box">
			<tr>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_01.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_02.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_03.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_04.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_05.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_06.gif"></a></td>
				<td><a href="#"><img src="<?=IMG_DIR?>/etc/mail/b_07.gif"></a></td>
			</tr>
		</table>
		<div class="text_box">
			<? if(!empty($m_mail)){ ?>
			<b><?=$m_mail?></b>
			<? }else{ ?>
			<input type="text" id="block_mail_user" name="block_mail_user" value="" style="width:100%; height:88%; border:solid 1px #FFF; text-align:center; font-size:1.2em; margin-top:2px;">
			<? } ?>
		</div>
		<div class="text-center margin_top_55">	
			<img src="<?=IMG_DIR?>/etc/mail/btn_01.gif" class="padding_right_10 pointer" id="block_btn">
			<!--a href="#"><img src="<?=IMG_DIR?>/etc/mail/btn_02.gif"></a-->
		</div>
	</div>
</div>

