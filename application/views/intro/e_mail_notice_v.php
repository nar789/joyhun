<?
	//회원사진 가져오기
	$member_thumb = $this->member_lib->member_thumb($send_data['m_userid'], 150, 150);
	
	//이미지 검사
	$img_bg = "";
	if(strpos($member_thumb, "man_ic") !== false){
		$img_bg= "background-color:#E7F0FF;";
	}else if(strpos($member_thumb, "girl_ic") !== false){
		$img_bg= "background-color:#FFE7EB;";
	}else{
		$img_bg = "";
	}
	
	//이메일 검사(폰트사이즈)
	$mail_font = "";
	if(strpos($recv_data['m_mail'], "nate") !== false){
		$mail_font = "font-size:0.8em;";
	}else{
		$mail_font = "font-size:1.0em;";
	}

?>

<div style="border:solid 1px #B6B6B6; position:relative; width:676px; margin:auto; <?=$mail_font?>">
	
	<div style="position:relative; width:100%;">
		<table cellspacing=0 cellpadding=0 style="width:100%;">
			<tr>
				<td><a href="http://www.joyhunting.com"><img src="http://www.joyhunting.com/images/intro/alirm_1.png" useMap="#alrim_1" border=0></a></td>
			</tr>
		</table>
	</div>

	<div style="position:relative; width:100%;">
		<div style="position:relative; width:90%; height:70px; margin:auto; margin-top:10px; margin-bottom:10px; border-radius:10px; background-color:#E7F4FF; text-align:center; line-height:20px;">
			<p style="padding-top:15px;">
				<?=$contents?>
			</p>
		</div>
	</div>

	<div style="position:relative; width:100%;">
		<div style="position:relative; width:90%; height:150px; margin:auto; margin-top:20px;">
			<table cellpadding=0 cellspacing=0 style="width:100%;">
				<tr style="height:150px;">
					<td style="width:28%;">
						<div style="border:solid 1px #AFAFAF; position:relative; width:98%; height:120px; <?=$img_bg?> text-align:center; padding-top:30px;">
							<?=$this->member_lib->member_thumb($send_data['m_userid'], 170, 150)?>
						</div>
					</td>
					<td style="width:72%;">
						<div style="border:solid 1px #AFAFAF; position:relative; width:100%; height:150px;">
							<textarea style="border:0; width:95%; height:130px; margin-top:10px; margin-left:10px; overflow:hidden;" readonly><?=$send_data['my_intro']?></textarea>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div style="position:relative; width:100%;">
		<div style="border-top:solid 1px #000; border-bottom:solid 1px #B6B6B6; position:relative; width:90%; height:150px; margin:auto; margin-top:20px; background-color:#F4F4F6;">
			<table cellspacing=0 cellpadding=0 style="width:100%;">
				<tr style="height:50px;">
					<td style="width:30%; text-align:center;"><b>지역</b></td>
					<td style="width:70%; padding-left:10px;"><?=$send_data['m_conregion']?></td>
				</tr>
				<tr style="height:50px;">
					<td style="width:30%; text-align:center;"><b>나이</b></td>
					<td style="width:70%; padding-left:10px;"><?=$send_data['m_age']?>세</td>
				</tr>
				<tr style="height:50px;">
					<td style="width:30%; text-align:center;"><b>원하는 만남</b></td>
					<td style="width:70%; padding-left:10px;"><?=want_reason_data($send_data['m_reason'])?></td>
				</tr>
			</table>
		</div>
	</div>

	<div style="position:relative; width:100%;">
		<table cellspacing=0 cellpadding=0 style="width:100%;">
			<tr>
				<td><img src="http://www.joyhunting.com/images/intro/alrim_3.png" useMap="#alrim_3" border=0></td>
			</tr>
		</table>
	</div>

</div>

<map name="alrim_1">
	<area shape="rect" coords="18,24,179,72" href="http://www.joyhunting.com" target="_blank">
</map>

<map name="alrim_3">
	<area shape="rect" coords="227,49,395,81" href="http://www.joyhunting.com" target="_blank">
	<area shape="rect" coords="356,141,423,160" href="http://www.joyhunting.com/service_center" target="_blank">
	<area shape="rect" coords="149,161,203,175" href="http://www.joyhunting.com/intro/e_mail/block/mail/<?=urlencode($recv_data['m_mail'])?>" target="_blank">
	<area shape="rect" coords="23,199,137,239" href="http://www.joyhunting.com" target="_blank">
</map>
