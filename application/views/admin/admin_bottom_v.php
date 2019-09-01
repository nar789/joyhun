		<!-- PRELOADER -->
		<div id="preloader">
			<div class="inner">
				<span class="loader"></span>
			</div>
		</div>
		<!-- /PRELOADER -->


		<div id="super_send">
			<div class="inner">
				<img src="<?=IMG_DIR?>/admin/super_chat_loading2.gif" style="width:80%">
				<p id="super_info"></p>
				<!-- &nbsp;&nbsp;<button type="submit" class="btn btn-primary" id="send_mb_chat"><i class="fa fa-pause" aria-hidden="true"></i> 중지</button> -->
			</div>
		</div>

		<!-- <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i> -->


		<style>

			 #super_send{
				position: fixed;
				z-index: 9999999;
				top: 0; bottom: 0;
				right: 0; left: 0;
				display:none;
			}

			#super_send > .inner {
				text-align:center;
				width:300px;
				height:250px;
			}

			#super_info {
				display:inline-block;
				margin-top:25px;
			}



			/** Preloader
			 **************************************************************** **/

			#preloader {
				position: fixed;
				z-index: 9999999;
				top: 0; bottom: 0;
				right: 0; left: 0;
				display:none;
			}

			.inner {
				position: absolute;
				top: 0; bottom: 0;
				right: 0; left: 0;

				width: 184px;
				height: 184px;
				margin: auto;

				background: #fff;
				border: 1px solid #586566;
			}

			.page-loader{
				display:block;
				width: 100%;
				height: 100%;
				position: fixed;
				top: 0;
				left: 0;
				background: #fefefe;
				z-index: 100000;	
			}

			#preloader span.loader {
			  width: 100px;
			  height: 100px;
			  position: absolute;
			  top: 50%;
			  left: 50%;
			  margin: -50px 0 0 -50px;
			  font-size: 10px;
			  text-indent: -12345px;
			  border-top: 1px solid rgba(0,0,0, 0.08);
			  border-right: 1px solid rgba(0,0,0, 0.08);
			  border-bottom: 1px solid rgba(0,0,0, 0.08);
			  border-left: 1px solid rgba(0,0,0, 0.5);
			  
			  -webkit-border-radius: 50%;
			  -moz-border-radius: 50%;
			  border-radius: 50%;
			  
			   -webkit-animation: spinner 700ms infinite linear;
			   -moz-animation: spinner 700ms infinite linear;
			   -ms-animation: spinner 700ms infinite linear;
			   -o-animation: spinner 700ms infinite linear;
			   animation: spinner 700ms infinite linear;
			  
			  z-index: 100001;
			}

			@-webkit-keyframes spinner {
			  0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			  }

			  100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			  }
			}

			@-moz-keyframes spinner {
			  0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			  }

			  100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			  }
			}

			@-o-keyframes spinner {
			  0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			  }

			  100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			  }
			}

			@keyframes spinner {
			  0% {
				-webkit-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-ms-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			  }

			  100% {
				-webkit-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-ms-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			  }
			}

		</style>

		<script>
		/*
	if(jQuery('#preloader').length > 0) {

		jQuery(window).load(function() {
			
			jQuery('#preloader').fadeOut(1000, function() {
				jQuery('#preloader').remove();
			});

			// setTimeout(function() {}, 1000); 
		  
		});

	}
	*/
		</script>

		<?if(@$add_script){
			echo $add_script;
		}?>
	
	</body>
</html>

