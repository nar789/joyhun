<!-- <div style="background:url('<?=IMG_DIR?>/intro/email_bg.png');width:870px;height:916px;">

	<div style="width:675px;height:804px;padding-top:210px;margin-left:97px;">
		<div style="width:90%;margin:0 auto;">

			<p style="font-weight:bold;margin-bottom:15px;">고객님, 안녕하세요!<br>
			고객님께서 <?=$ye?>년 <?=$mo?>월 <?=$da?>일에 문의하신내용입니다. </p>


			<div style="background:#f4f4f6;border-top:1px solid #333333;border-bottom:1px solid #ececec;margin:0 auto;max-height:400px;">
				<div style="width:90%;margin-top:20px;"><b>Q</b><br><?=$f_content?></div>
				<div style="width:90%;margin-top:20px;padding-bottom:20px;"><b>A</b><br><?=$f_answer?></div>
			</div>

			<p style="color:#666;margin-top:5px;">언제나 고객님을 위해 최선을 다하겠습니다. 앞으로도 조이헌팅에 대한 관심 부탁드립니다. 감사합니다.</p>

			<div style="text-align:center;">
				
				<div style="background:#ed4949;font-weight:bold;border-radius:4px;border:none;cursor:pointer;width:110px;height:30px;margin:0 auto;margin-top:20px;line-height:30px;">
					<a href="http://www.joyhunting.com" target="_blank" style="font-size:12px;color:#fff;text-decoration: none;">조이헌팅 가기</a>
				</div>
			</div>

		</div>

	</div>

</div>

 -->

<div style="width:676px;border:1px solid #d7d7d7;">
	<table border='0' width="676px" cellspacing=0 cellpadding=0>
		<tr>
			<td height="307px;"><a href="http://www.joyhunting.com"><img src="<?=IMG_DIR?>/intro/email_top.gif"></a></td>
		</tr>
		<tr>
			<td>
				<div style="width:90%;padding-top:40px;margin:0 auto;">
					<p style="font-weight:bold;margin-bottom:15px;">고객님, 안녕하세요!<br>
					고객님께서 <?=$ye?>년 <?=$mo?>월 <?=$da?>일에 문의하신내용입니다. </p>


					<div style="background:#f4f4f6;border-top:1px solid #333333;border-bottom:1px solid #ececec;margin:0 auto;">
						<div style="width:90%;margin-top:20px;"><b>Q</b><br><?=$f_content?></div>
						<div style="width:90%;margin-top:20px;padding-bottom:20px;"><b>A</b><br><?=$f_answer?></div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td height="209px">
				<div style="margin-top:50px;width:95%;background:#f9f9f9;height:58px;">
					<p style="font-size:11px;color:#656565;margin-left:18px;padding-top:13px;">본 메일은 발신전용이오니 문의사항이 있으시면 <a style="color:#000;font-weight:bold;text-decoration:none;" href="http://www.joyhunting.com/service_center">고객센터</a> 또는 <a href="http://www.joyhunting.com/service_center" style="text-decoration:underline;color:#ea3c3c;font-weight:bold;">이메일 상담</a>으로 문의하여 주시기 바랍니다.<br>
					수신을 원치 않으시면 <a href="http://www.joyhunting.com/intro/e_mail/block/mail/<?=urlencode(@$m_data['m_mail'])?>" style="text-decoration:underline;color:#ea3c3c;font-weight:bold;">수신거부</a> 신청하세요.</p>
				</div>

				<table cellspacing=0 cellpadding=0 style="margin-top:20px;">
					<tr>
						<td><img src="<?=IMG_DIR?>/intro/email_logo.gif"><td>
						<td><p style="color:#959595;font-size:11px;">경기도수원시팔달구인계로132 201~203호&nbsp;&nbsp;|&nbsp;&nbsp;대표이사  이흥일&nbsp;&nbsp;|&nbsp;&nbsp;상호  위드유<br>사업자등록번호  135-24-79774&nbsp;&nbsp;|&nbsp;&nbsp;전화  070-7439-4260&nbsp;&nbsp;|&nbsp;&nbsp;이메일  matchshop@nate.com<br>COPYRIGHTS (C) 2016 JOYHUNTING. All Rights Reserved.</p>
						</td>
					</tr>
				<table>	
			</td>
		</tr>
	</table>
</div>