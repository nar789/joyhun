


//<![CDATA[



$(function(){


	$('.blind_thum img').each(function(){ 

		$(this).hide();

		if (this.naturalWidth > this.naturalHeight){		//썸네일의 가로값이 더 길면 가로기준
			$(this).css('height','auto');
		}else if (this.naturalHeight > this.naturalWidth){	//썸네일의 세로값이 더 길면 세로기준
			$(this).css('height','100%');
		}
		$(this).show();

	});

	$("#blind_slider").touchSlider({

		view : 1,
		btn_prev : $("#blind_slider").next().find(".btn_prev"),
		btn_next : $("#blind_slider").next().find(".btn_next"),


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
//]]>


/* 
jquery.event.drag.js ~ v1.5 ~ Copyright (c) 2008, Three Dub Media (http://threedubmedia.com)  
Liscensed under the MIT License ~ http://threedubmedia.googlecode.com/files/MIT-LICENSE.txt
v1.5.1 : jQuery 1.9 이상에서 동작 가능하도록 수정 (by dohoons)
*/
(function(E){E.fn.drag=function(L,K,J){if(K){this.bind("dragstart",L)}if(J){this.bind("dragend",J)}return !L?this.trigger("drag"):this.bind("drag",K?K:L)};var A=E.event,B=A.special,F=B.drag={not:":input",distance:0,which:1,dragging:false,setup:function(J){J=E.extend({distance:F.distance,which:F.which,not:F.not},J||{});J.distance=I(J.distance);A.add(this,"mousedown",H,J);if(this.attachEvent){this.attachEvent("ondragstart",D)}},teardown:function(){A.remove(this,"mousedown",H);if(this===F.dragging){F.dragging=F.proxy=false}G(this,true);if(this.detachEvent){this.detachEvent("ondragstart",D)}}};B.dragstart=B.dragend={setup:function(){},teardown:function(){}};function H(L){var K=this,J,M=L.data||{};if(M.elem){K=L.dragTarget=M.elem;L.dragProxy=F.proxy||K;L.cursorOffsetX=M.pageX-M.left;L.cursorOffsetY=M.pageY-M.top;L.offsetX=L.pageX-L.cursorOffsetX;L.offsetY=L.pageY-L.cursorOffsetY}else{if(F.dragging||(M.which>0&&L.which!=M.which)||E(L.target).is(M.not)){return }}switch(L.type){case"mousedown":E.extend(M,E(K).offset(),{elem:K,target:L.target,pageX:L.pageX,pageY:L.pageY});A.add(document,"mousemove mouseup",H,M);G(K,false);F.dragging=null;return false;case !F.dragging&&"mousemove":if(I(L.pageX-M.pageX)+I(L.pageY-M.pageY)<M.distance){break}L.target=M.target;J=C(L,"dragstart",K);if(J!==false){F.dragging=K;F.proxy=L.dragProxy=E(J||K)[0]}case"mousemove":if(F.dragging){J=C(L,"drag",K);if(B.drop){B.drop.allowed=(J!==false);B.drop.handler(L)}if(J!==false){break}L.type="mouseup"}case"mouseup":A.remove(document,"mousemove mouseup",H);if(F.dragging){if(B.drop){B.drop.handler(L)}C(L,"dragend",K)}G(K,true);F.dragging=F.proxy=M.elem=false;break}return true}function C(M,K,L){M.type=K;var J=E.event.dispatch.call(L,M);return J===false?false:J||M.result}function I(J){return Math.pow(J,2)}function D(){return(F.dragging===false)}function G(K,J){if(!K){return }K.unselectable=J?"off":"on";K.onselectstart=function(){return J};if(K.style){K.style.MozUserSelect=J?"":"none"}}})(jQuery);





/**
 * @name	jQuery.touchSlider
 * @author	dohoons ( http://dohoons.com/ )
 *
 * @version	1.1.1
 * @since	201106
 *
 * @param Object	settings	환경변수 오브젝트
 *		roll			-	순환 (default true)
 *		flexible		-	유동 레이아웃 (default true)
 *		resize			-	리사이즈 사용 (default false)
 *		view			-	다중 컬럼 (default 1)
 *		speed			-	애니메이션 속도 (default 75)
 *		range			-	넘김 판정 범위 (default 0.15)
 *		page			-	초기 페이지 (default 1)
 *		transition		-	CSS3 transition 사용 (default true)
 *		btn_prev		-	prev 버튼 (jQuery Object, default null)
 *		btn_next		-	next 버튼 (jQuery Object, default null)
 *		paging			-	page 버튼 (jQuery Object, default null)
 *		sidePage		-	사이드 페이지 사용 (default false)
 *		initComplete 	-	초기화 콜백
 *		counter			-	슬라이드 콜백, 카운터
 *		autoplay		-	자동움직임 관련 옵션 (Object)
 *
 * @example
 
	$("#target").touchSlider({
		page : 2
	});

*/

(function ($) {
	
	$.fn.touchSlider = function (settings) {
		
		$.fn.touchSlider.defaults = {
			roll : true,
			flexible : true,
			resize : false,
			btn_prev : null,
			btn_next : null,
			paging : null,
			speed : 150,
			view : 1,
			range : 0.15,
			page : 1,
			sidePage : false,
			transition : false,
			initComplete : null,
			counter : null,
			propagation : false,
			autoplay : {
				enable : false,
				pauseHover : true,
				addHoverTarget : "",
				interval : 3500
			},
			supportsCssTransitions : (function (style) {
				var prefixes = ['Webkit','Moz','Ms'];
				for(var i=0, l=prefixes.length; i < l; i++ ) {
					if( typeof style[prefixes[i] + 'Transition'] !== 'undefined') {
						return true;
					}
				}
				return false;
			})(document.createElement('div').style)
		};
		
		var opts = $.extend(true, {}, $.fn.touchSlider.defaults, settings);
		
		return this.each(function () {
			
			var _this = this;
			
			$.fn.extend(this, touchSlider);	
			this.opts = opts;
			this.init();
			
			$(window).on("orientationchange resize", function () {
				_this.resize(_this);
			});
		});
	
	};
	
	var touchSlider = {
		
		init : function () {
			var _this = this;
			
			this._view = this.opts.view;
			this._speed = this.opts.speed;
			this._tg = $(this);
			this._list = this._tg.children().children();
			this._width = parseInt(this._tg.css("width"));
			this._item_w = parseInt(this._list.css("width"));
			this._len = this._list.length;
			this._range = this.opts.range * this._width;
			this._pos = [];
			this._start = [];
			this._startX = 0;
			this._startY = 0;
			this._left = 0;
			this._top = 0;
			this._drag = false;
			this._link = true;
			this._scroll = false;
			this._btn_prev;
			this._btn_next;
			this._timer;
			this._hover_tg = [];
			
			this._tg
					.off("touchstart", this.touchstart)
					.off("touchmove", this.touchmove)
					.off("touchend", this.touchend)
					.off("touchcancel", this.touchend)
					.off("dragstart", this.touchstart)
					.off("drag", this.touchmove)
					.off("dragend", this.touchend)
					.on("touchstart", this.touchstart)
					.on("touchmove", this.touchmove)
					.on("touchend", this.touchend)
					.on("touchcancel", this.touchend)
					.on("dragstart", this.touchstart)
					.on("drag", this.touchmove)
					.on("dragend", this.touchend);
			
			this._tg.children().css({
				"width":this._width + "px",
				"overflow":"visible"
			});
			
			if(this.opts.flexible) this._item_w = this._width / this._view;
			
			if(this.opts.roll) {
				if(this._len % this._view > 0) {
					var blank = $(document.createElement(this._list.eq(0).prop("tagName"))).hide();
					var cnt = this._view - (this._len % this._view);
					for(var i=0; i<cnt; ++i) {
						this._list.parent().append(blank.clone());
					}
				}
				this._list = this._tg.children().children();
				this._len = this._list.length;
				this._len = (this._len / this._view) * this._view;
			}
			
			var page_gap = (this.opts.page > 1 && this.opts.page <= this._len) ? (this.opts.page - 1) * this._item_w * this._view : 0;
			
			for(var i=0, len=this._len; i<len; ++i) {
				this._pos[i] = this._item_w * i - page_gap;

				this._start[i] = this._pos[i];
				this._list.eq(i).css({
					"float" : "none",
					"position" : "absolute",
					"top" : "0",
					"width" : this._item_w + "px"
				});
					
				this.move({
					tg : this._list.eq(i),
					speed : 0,
					to : this._pos[i]
				});
			}
			
			if(this.opts.btn_prev && this.opts.btn_next) {	//왼쪽 오른쪽버튼
				this.opts.btn_prev.off("click").on("click", function() {
					_this.animate(1, true);
					return false;
				})
				this.opts.btn_next.off("click").on("click", function() {
					_this.animate(-1, true);
					return false;
				});
			}
			
			if(this.opts.paging) {	//페이징
				$(this._list).each(function (i, el) {
					var btn_page = _this.opts.paging.eq(0).clone();
					_this.opts.paging.before(btn_page);
					
					btn_page.off("click").on("click", function(e) {
						_this.go_page(i, e);
						return false;
					});
				});
				
				this.opts.paging.remove();
			}
			
			if(this.opts.autoplay.enable) {		//자동슬라이드시
				this._hover_tg = [];
				this._hover_tg.push(this._tg);
				
				if(this.opts.btn_prev && this.opts.btn_next) {
					this._hover_tg.push(this.opts.btn_prev);
					this._hover_tg.push(this.opts.btn_next);
				}
				
				if(this.opts.autoplay.addHoverTarget != "") {
					this._hover_tg.push($(this.opts.autoplay.addHoverTarget));
				}
				
				if(this.opts.autoplay.pauseHover) {
					$(this._hover_tg).each(function(i, el) {
						$(this).off("mouseenter mouseleave").on("mouseenter mouseleave", function (e) {
							if(e.type == "mouseenter") {
								_this.autoStop();
							} else {
								_this.autoPlay();
							}
						});
					});
				}
				
				this.autoStop();
				this.autoPlay();
			}
			
			this._tg.find("a").off("click").on("click", function (e) {
				if(!_this._link) {
					return false;
				}
			});
			
			this.initComplete();
			this.counter();

		},
		
		initComplete : function () {
			if(this.opts.sidePage) {
				this.animate(-1, true, 0);
				this.animate(1, true, 0);
			}
			if(typeof(this.opts.initComplete) == "function") {
				this.opts.initComplete.call(this,this);
			}
		},
		
		resize : function (e) {
			if(e.opts.flexible) {
				var tmp_w = e._item_w;
				
				e._width = parseInt(e._tg.css("width"));
				e._item_w = e._width / e._view;
				e._range = e.opts.range * e._width;
				
				for(var i=0, len=e._len; i<len; ++i) {
					e._pos[i] = e._pos[i] / tmp_w * e._item_w;
					e._start[i] = e._start[i] / tmp_w * e._item_w;
					e._list.eq(i).css({
						"width" : e._item_w + "px"
					});
					
					this.move({
						tg : e._list.eq(i),
						speed : 0,
						to : e._pos[i]
					});
				}
			}
			
			this.counter();
		},
		
		touchstart : function (e) {
			if(!this.opts.propagation) {
				e.stopPropagation();
			}
			if((e.type == "touchstart" && e.originalEvent.touches.length <= 1) || e.type == "dragstart") {
				this._startX = e.pageX || e.originalEvent.touches[0].pageX;
				this._startY = e.pageY || e.originalEvent.touches[0].pageY;
				this._scroll = false;
				this._start = this._pos.slice(0);
			}
		},
		
		touchmove : function (e) {
			if(!this.opts.propagation) {
				e.stopPropagation();
			}
			if((e.type == "touchmove" && e.originalEvent.touches.length <= 1) || e.type == "drag") {
				this._left = (e.pageX || e.originalEvent.touches[0].pageX) - this._startX;
				this._top = (e.pageY || e.originalEvent.touches[0].pageY) - this._startY;
				var w = this._left < 0 ? this._left * -1 : this._left;
				var h = this._top < 0 ? this._top * -1 : this._top;
				
				if (w < h || this._scroll) {
					this._left = 0;
					this._drag = false;
					this._link = true;
					this._scroll = true;
				} else {
					e.preventDefault();
					this._drag = true;
					this._link = false;
					this._scroll = false;
					this.position(e);
				}
				
				for(var i=0, len=this._len; i<len; ++i) {
					var tmp = this._start[i] + this._left;
					
					this.move({
						tg : this._list.eq(i),
						speed : 0,
						to : tmp
					});
					
					this._pos[i] = tmp;
				}
			}
		},
		
		touchend : function (e) {
			if(!this.opts.propagation) {
				e.stopPropagation();
			}
			if(this._scroll) {
				this._drag = false;
				this._link = true;
				this._scroll = false;
			} else {
				this.animate(this.direction());
				this._drag = false;
				this._scroll = true;
				
				var _this = this;
				setTimeout(function () {
					_this._link = true;
				},50);
			}
		},
		
		position : function (d) { 
			var len = this._len,
				view = this._view,
				gap = view * this._item_w;
			
			if(d == -1 || d == 1) {
				this._startX = 0;
				this._start = this._pos.slice(0);
				this._left = d * gap;
			} else {
				if(this._left > gap) this._left = gap;
				if(this._left < - gap) this._left = - gap;
			}
			
			if(this.opts.roll) {
				var tmp_pos = this._pos.slice(0).sort(function(a,b){return a-b;}),
					max_chk = tmp_pos[len-view],
					p_min = $.inArray(tmp_pos[0], this._pos),
					p_max = $.inArray(max_chk, this._pos),
					p = (this.opts.sidePage) ? 3 : 1;

				if(view <= 1) max_chk = len - p;

				
				if((d == 1 && tmp_pos[p-1] >= 0) || (this._drag && tmp_pos[p-1] > 0)) {
					for(var i=0; i<view; ++i, ++p_min, ++p_max) {
						this._start[p_max] = this._start[p_min] - gap;
						this.move({
							tg : this._list.eq(p_max),
							speed : 0,
							to : this._start[p_max]
						});
					}
				} else if((d == -1 && tmp_pos[max_chk] <= 0) || (this._drag && tmp_pos[max_chk] <= 0)) {	//이노미다!!!!!!! d == -1일때

					for(var i=0; i<view; ++i, ++p_min, ++p_max) {
						this._start[p_min] = this._start[p_max] + gap;
						this.move({
							tg : this._list.eq(p_min),		//##
							speed : 0,
							to : this._start[p_min]
						});

							//console.log(p_min);
					}
					//console.log("else");
				}
			} else {
				if(this.limit_chk()) this._left = this._left / 2;
			}
		},
		
		move : function (obj) {

			var transition = obj.speed + "ms",
				transform = "translate3d(" + obj.to + "px,0,0)";

			if(this.opts.supportsCssTransitions && this.opts.transition) {

				obj.tg.css({
					"left" : "0",
					"-moz-transition" : transition,
					"-moz-transform" : transform,
					"-ms-transition" : transition,
					"-ms-transform" : transform,
					"-webkit-transition" : transition,
					"-webkit-transform" : transform,
					"transition" : transition,
					"transform" : transform
				});
			} else {
				obj.tg.css("left", obj.to + "px");
			}

		},
		
		animate : function (d, btn_click, speed) {
			if(this._drag || !this._scroll || btn_click) {
				/////////////////////////////////////////////////


				var speed = (speed > -1) ? speed : this._speed,
					gap = d * (this._item_w * this._view),
					list = this._list,
					len = this._len,
					transition = speed + "ms ease",
					transform = "";
				
				if(btn_click) this.position(d);
				
				if(this._left == 0 || (!this.opts.roll && this.limit_chk()) ) gap = 0;

				for(var i=0; i<len; ++i) {
					this._pos[i] = this._start[i] + gap;

					//console.log(this._pos[i]);
					//console.log(i+"메롱");

					if(this.opts.supportsCssTransitions && this.opts.transition) {	//true && true


						transform = "translate3d(" + this._pos[i] + "px,0,0)";
						list.eq(i).css({
							"left" : "0",
							"-moz-transition" : transition,
							"-moz-transform" : transform,
							"-ms-transition" : transition,
							"-ms-transform" : transform,
							"-webkit-transition" : transition,
							"-webkit-transform" : transform,
							"transition" : transition,
							"transform" : transform
						});
					} else {
						list.eq(i).stop().animate({"left": this._pos[i] + "px"}, speed);
					}

					if (this._pos[len-1] == 0){
						//console.log("★★★마지막페이지");
					}
				}	

				//console.log("/////////////////경계선//////////////////////");


				/////////////////////////////////////////////////
				/*
				console.log(gap + " --> gap");
				console.log(this._start[0] + gap + " --> this._start[0] + gap");
				console.log(transform + " --> transform");
				console.log(this._pos[0] + " --> this._pos[0]");
				console.log("----------------------끝---------------------");
				*/
				this.counter();
			}
		},
		
		direction : function () { 
			var r = 0;
		
			if(this._left < -(this._range)) r = -1;
			else if(this._left > this._range) r = 1;
			
			if(!this._drag || this._scroll) r = 0;
			
			return r;
		},
		
		limit_chk : function () {
			var last_p = parseInt((this._len - 1) / this._view) * this._view;
			return ( (this._start[0] == 0 && this._left > 0) || (this._start[last_p] == 0 && this._left < 0) );
		},
		
		go_page : function (i, e) {
			var crt = ($.inArray(0, this._pos) / this._view) + 1;
			var cal = crt - (i + 1);
			
			while(cal != 0) {
				if(cal < 0) {
					this.animate(-1, true);
					cal++;
				} else if(cal > 0) {
					this.animate(1, true);
					cal--;
				}
			}
		},
		
		get_page : function () {
			return {
				obj : this,
				total : Math.ceil(this._len / this._view),
				current : ($.inArray(0, this._pos) / this._view) + 1
			}
		},
		
		counter : function () {
			if($.inArray(0, this._pos) < 0) {
				this.init();
			}
			this.opts.page = this.get_page().current;
			if(this.opts.resize) {
				this._tg.css({
					"height" : this._list.eq(this.opts.page-1).height() + "px"
				});
			}
			if(typeof(this.opts.counter) == "function") {
				this.opts.counter.call(this, this.get_page());
			}
		},
		
		/* 여기도 자동 */
		autoPlay : function () {
			var _this = this;
			this._timer = setInterval(function () {
				if(_this.opts.autoplay.enable) {
					var page = _this.get_page();
					if(page.current == page.total) {
						_this.go_page(0);
					} else {
						_this.animate(-1, true);
					}
				}
			}, this.opts.autoplay.interval);
		},
		
		autoStop : function () {
			clearInterval(this._timer);
		},
		
		autoPauseToggle : function () {
			if(this.opts.autoplay.enable) {
				this.autoStop();
				this.opts.autoplay.enable = false;
				return "stopped";
			} else {
				this.opts.autoplay.enable = true;
				this.autoPlay();
				return "started";
			}
		}
		
	};

})(jQuery);



//소개팅 시작하기 모바일
function m_blind_start(){
	
	if(confirm("소개팅은 하루에 한번 가능합니다.시작하시겠습니까?") == true){
		
		$.get('/blindmeet/blind/m_blind_start', function(result){
			
			if(result == "909"){
				alert("정회원 가입후 이용가능합니다.");
				$(location).attr("href", "/profile/point/payment_f");
				return false;
			}else if(result == "0"){
				location.reload();
			}else{
				alert("오늘은 이미 소개팅 받으셨습니다.");
				return;
			}

		});

	}

}

//한명더 소개받기 모바일
function m_one_more(){
	
	if(confirm("한명더 소개받으시겠습니까?") == true){
		
		$.get('/blindmeet/blind/m_one_more', function(result){
			$("#one_more").empty();
			$("#one_more").html(result);
		});

	}

}

//모바일 소개팅 좋아요 버튼 클릭 이벤트
function m_ilike_check(m_num){
	
	if(confirm("좋아요를 보내시겠습니까?") == true){
		ilike(m_num);
	}

}

//좋아요 이벤트(레이어팝업)
function ilike(m_num){

	$.get('/blindmeet/blind/request_popup/idx/'+m_num+'/'+Math.random(), function(result){
		//modal.open({content: result, width : 9*($(window).width()/10)});
		modal.open({content: result, width : 280});
	});

}