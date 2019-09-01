<div class="contents_box">
	<div class="sub_tit">
		최근 접속한 추천 남성회원입니다.<br>
		지금 <b>무료로 대화를 신청</b>해보세요.
	</div>
	<div class="sub_con">
		<?
			$i=1;
			foreach($mlist as $data){
				if($i == 1){ $margin_left_class = "margin_left_11"; }else{ $margin_left_class = "margin_left_3"; }
		?>
		<div class="member_box <?=$margin_left_class?>">
			<div class="member_thumb">
				<?=$this->member_lib->member_thumb($data['m_userid'], 81, 90)?>
			</div>
			<div>
				<?=$data['m_nick']?><br>
				<?=$data['m_age']?>세<br>
				<?=$data['m_conregion']?> / <?=$data['m_conregion2']?>
			</div>
			<div onclick="javascript:chat_request('<?=$data['m_userid']?>');">
				대화신청
			</div>
		</div>
		<?
			$i++;
			}
		?>
	</div>
</div>
