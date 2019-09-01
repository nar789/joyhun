$(document).ready(function(){
		
	$("#member_view_slide").touchSlider({

		view : 1,
		btn_prev : $("#btn_prev"),
		btn_next : $("#btn_next"),


		initComplete : function (e) {

			var _this = this;
			var paging = $(this).nextAll(".paging");
			
			paging.html("");
			$(this).find(" > ul > li").each(function (i, el) {
				var num = (i+1) / e._view;
				if((i+1) % e._view == 0) {
					paging.append('<div class="btn_page">page' + num + '</div>');
				}
			});
			paging.find(".btn_page").bind("click", function (e) {
				_this.go_page($(this).index());
			});
		},
		counter : function (e) {
			$(this).nextAll(".paging").find(".btn_page").removeClass("on").eq(e.current-1).addClass("on");
		}
	});

});