<div class="event_con">
	<img src="<?=IMG_DIR?>/service_center/event_main.png" border=0 useMap="#Map">

	<div><?=$this->session->userdata['m_nick']?></div>
	<div>2016.07.25 ~ 2016.08.15</div>

</div>

<map id="Map" name="Map">
	<area shape="rect" coords="227,767,752,812" href="javascript:alert();" onfocus="blur();">
</map>



<style>
.event_con{position:relative; width:960px; margin:auto;}
.event_con div:nth-child(2){position:absolute; width:140px; height:48px; top:545px; left:280px; text-align:center; font-size:1.9em; font-weight:bold; color:#FFF; line-height:45px;}
.event_con div:nth-child(3){position:absolute; width:280px; height:48px; top:1230px; left:40px; font-size:1.9em; font-weight:bold; color:#878789; line-height:45px;}
</style>