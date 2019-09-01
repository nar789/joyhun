<style>
	div.row > div img.img-responsive{
		width:100%;
	}
	#portfolio div.col-md-2 h2, #portfolio div.col-md-2 h3
		font-size:13px !important;
		line-height:13px !important;
	}
	.table th, td{text-align:center;}

	.img_none_icon{cursor:pointer;}
</style>

<script>
var tmp_page = "";
var page_mode = "TotalMembers";
	//사진 데이터 가져오기
	function get_pic_data(page){
		tmp_page = page;

		$.get('/admin/chatting/total_woman_pic/get_data/page/'+page + '/page_mode/'+page_mode+'/'+Math.random(), function(data){
			$("#pic_grid")[0].innerHTML = $("#pic_grid")[0].innerHTML + data;
		});		
	}

	var scrollCurrentTop = 0;
	$(window).scroll(function () {

		if (($(window).scrollTop() == $(document).height() - $(window).height()) && $(window).scrollTop() != scrollCurrentTop) {

			scrollCurrentTop = $(window).scrollTop();
	
			tmp_page = Number(tmp_page) + 1;

			get_pic_data(tmp_page);

		}

	});


	$(document).ready(function(){
		$("#app_btn1").click(function(){
			location.href= "/admin/chatting/total_woman_pic/pic_list";
		});

		$("#app_btn2").click(function(){
			location.href= "/admin/chatting/total_woman_pic/pic_list_dormancy";
		});
	});


</script>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>전체 여성회원 사진</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">채팅관리</span></li>
						<li class="active">전체 여성회원 사진</li>
					</ol>
				</header>
				<!-- /page title -->

				<div class="panel-body">

					<div class="tabs nomargin">

						<!-- tabs -->
						<ul class="nav nav-tabs nav-justified">
							<li class="<?if($page_mode == "TotalMembers"){echo "active";}?>">
								<a aria-expanded="false" href="#" data-toggle="tab" id="app_btn1">
									<i class="fa fa-heart"></i> 일반 여성회원
								</a>
							</li>
							<li class="<?if($page_mode == "TotalMembers_old"){echo "active";}?>">
								<a aria-expanded="true" href="#" data-toggle="tab" id="app_btn2">
									<i class="fa fa-cogs"></i> 휴면계정 여성회원
								</a>
							</li>
						</ul>

					</div>

				</div>


				<div id="content" class="padding-20">

						<div class="portfolio-nogutter" id="portfolio">

								<div class="row mix-grid" id="pic_grid">


								</div>
						</div>


				</div> <!--end content-->

			</section>
			<!-- /MIDDLE -->