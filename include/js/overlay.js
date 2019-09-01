//레이어 팝업창 자바스크립트 (CSS는 head_css.css 안에 들어있음)

			var modal = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content,
				$close;

				// Center the modal in the viewport
				method.center = function (setting_top) {
					var top, left;
			
					top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;				
					left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;
					
					if(setting_top){
						$modal.css({
							left:left + $(window).scrollLeft()
						});
					}else{


						if(is_mobile == true){

							$modal.css({
								top:Math.max($(window).height() - $modal.outerHeight(), 0) / 2 , 
								left:Math.max($(window).width() - $modal.outerWidth(), 0) / 2 + $(window).scrollLeft()
							});

							//가로 세로 변환시 다시 window의 넓이,높이 가져오기
							window.onorientationchange = function() { 
								$modal.css({
									top:Math.max($(window).height() - $modal.outerHeight(), 0) / 2 , 
									left:Math.max($(window).width() - $modal.outerWidth(), 0) / 2 + $(window).scrollLeft()
								});
							}

						}else if (is_mobile == false){

							$modal.css({
								top:top, 
								left:left + $(window).scrollLeft()
							});

						}

					}
				};

				// Open the modal
				method.open = function (settings) {

					$content.empty().append(settings.content);
				
					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto',
						top: settings.top || 'auto'

					});

					method.center(settings.top);
					$(window).bind('resize.modal', method.center);

					$modal.show();
					$overlay.show();
				};

				// Close the modal
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content.empty();
					$(window).unbind('resize.modal');
				};

				// Generate the HTML and add it to the document
				$overlay = $('<div id="overlay"></div>');
				$modal = $('<div id="modal" style="position:fixed"></div>');
				$content = $('<div id="md_content"></div>');
				$close = $('#close');

				$modal.hide();
				$overlay.hide();
				$modal.append($content, $close);

				$(document).ready(function(){
					$('body').append($overlay, $modal);						
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());



			var modal2 = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content,
				$close;

				// Center the modal in the viewport
				method.center = function (setting_top) {
					var top, left;
			
					top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;				
					left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;
					
					if(setting_top){
						$modal.css({
							left:left + $(window).scrollLeft()
						});
					}else{


						if(is_mobile == true){

							$modal.css({
								top:Math.max($(window).height() - $modal.outerHeight(), 0) / 2 , 
								left:Math.max($(window).width() - $modal.outerWidth(), 0) / 2 + $(window).scrollLeft()
							});

							//가로 세로 변환시 다시 window의 넓이,높이 가져오기
							window.onorientationchange = function() { 
								$modal.css({
									top:Math.max($(window).height() - $modal.outerHeight(), 0) / 2 , 
									left:Math.max($(window).width() - $modal.outerWidth(), 0) / 2 + $(window).scrollLeft()
								});
							}

						}else if (is_mobile == false){

							$modal.css({
								top:top, 
								left:left + $(window).scrollLeft()
							});

						}

					}
				};

				// Open the modal
				method.open = function (settings) {

					$content.empty().append(settings.content);
				
					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto',
						top: settings.top || 'auto'

					});

					method.center(settings.top);
					$(window).bind('resize.modal', method.center);
					$modal.show();
					$overlay.show();
				};

				// Close the modal
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content.empty();
					$(window).unbind('resize.modal');
				};

				// Generate the HTML and add it to the document
				$overlay = $('<div id="overlay2"></div>');
				$modal = $('<div id="modal2" style="position:fixed"></div>');
				$content = $('<div id="md_content"></div>');
				$close = $('#close');

				$modal.hide();
				$overlay.hide();
				$modal.append($content, $close);

				$(document).ready(function(){
					$('body').append($overlay, $modal);						
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());




			// Wait until the DOM has loaded before querying the document
			/*
			$(document).ready(function(){

				//$.get('ajax.html', function(data){
				//	modal.open({content: data});
				//});

				$('a#howdy').click(function(e){
					//modal.open({content: "Hows it going?"});

					$.get('/main/register_ok_popup', function(data){
						modal.open({content: data,width : 560});
					});

					e.preventDefault();
				});
			});
			*/