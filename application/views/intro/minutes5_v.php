<script>
		history.pushState(null, null, "?");

		$(window).on("popstate", function(event){
			window.location.replace("http://www.joyhunting.com");
		});
</script>

<div class="text-center">
	<a href="http://www.joyhunting.com/auth/register/"><img src="<?=IMG_DIR?>/intro/minutes5_bg.jpg" class=""></a>
</div>