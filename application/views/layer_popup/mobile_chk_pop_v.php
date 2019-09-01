<img src="<?=IMG_DIR?>/m/mobile_chk_pop.gif" usemap="#mobile_chk">

<map name="mobile_chk">
	<area shape="rect" coords="308,0,358,45" href="javascript:modal.close();" style="cursor:pointer">
	<area shape="rect" coords="20,308,340,367" href="javascript:name_check();" style="cursor:pointer"/>
	<!--area shape="rect" coords="20,308,340,367" href="javascript:reg_phone_chk('2', '<?=@$this->session->userdata['m_userid']?>');" style="cursor:pointer"/-->
</map>



<style>
#md_content { background:none !important; }
#modal		{ top:285px !important; }
</style>