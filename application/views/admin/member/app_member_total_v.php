<script>
	function register_view(){		
		$(location).attr("href", "/admin/main/app_member_total/val1/"+$("#m_year").val()+"/val2/"+$("#m_month").val());
	}


$(document).ready(function(){
	$("#search_btn").click(function(){
		var sfl_val = $("select[name=sfl]").val();
		var sfl_val2 = $("select[name=sfl2]").val();
		if($("#q").val() == '' && $("#q2").val() == ''){
			alert('검색어를 입력하세요');
			return false;
		} else {
		    $('#preloader').show();

			var act = '/admin/main/app_member_list';
			if($("#q").val() && sfl_val){
				act += '/q/'+$("#q").val()+'/sfl/'+sfl_val;
			}
			if($("#q2").val() && sfl_val2){
				act += '/q2/'+$("#q2").val()+'/sfl2/'+sfl_val2;
			}
			$("#fsearch").attr('action', act).submit();
    	}
	});

	$("#app_btn1").click(function(){
		location.href= "/admin/main/app_member_total";
	});

	$("#app_btn2").click(function(){
		location.href= "/admin/main/app_member_list";
	});

});


function board_search_enter(form) {
    var keycode = window.event.keyCode;
    if(keycode == 13) $("#search_btn").click();
}
</script>
			
			<style>
				.table th, td{text-align:center;}
			</style>

			<!-- 
				MIDDLE 
			-->
			<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>앱설치 일일 통계</h1>
					<ol class="breadcrumb">
						<li><span class="text-info">앱 설치회원 리스트</span></li>
						<li class="active">앱설치 일일 통계</li>
					</ol>
				</header>
				<!-- /page title -->


				<div class="panel-body">

					<div class="tabs nomargin">

						<!-- tabs -->
						<ul class="nav nav-tabs nav-justified">
							<li class="active">
								<a aria-expanded="false" href="#" data-toggle="tab" id="app_btn1">
									<i class="fa fa-heart"></i> 앱설치 일일 통계
								</a>
							</li>
							<li >
								<a aria-expanded="true" href="#" data-toggle="tab" id="app_btn2">
									<i class="fa fa-cogs"></i> 앱설치 회원 목록
								</a>
							</li>
						</ul>

					</div>

				</div>


				<div id="content" class="padding-20">
					<div id="panel-1" class="panel panel-default">			
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>검색조건</strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->
						</div>
						<div class="panel-body">
							<select id="m_year" name="m_year" onChange="javascript:register_view();">
								<option value="">- 년도 -</option>
								<option value="2016" <? if($m_year == "2016"){ echo "selected"; } ?> >2016년</option>
							</select>
							<select id="m_month" name="m_month" onChange="javascript:register_view();">
								<option value="">- 월 -</option>
								<option value="01" <? if($m_month == "01"){ echo "selected"; } ?> >1월</option>
								<option value="02" <? if($m_month == "02"){ echo "selected"; } ?> >2월</option>
								<option value="03" <? if($m_month == "03"){ echo "selected"; } ?> >3월</option>
								<option value="04" <? if($m_month == "04"){ echo "selected"; } ?> >4월</option>
								<option value="05" <? if($m_month == "05"){ echo "selected"; } ?> >5월</option>
								<option value="06" <? if($m_month == "06"){ echo "selected"; } ?> >6월</option>
								<option value="07" <? if($m_month == "07"){ echo "selected"; } ?> >7월</option>
								<option value="08" <? if($m_month == "08"){ echo "selected"; } ?> >8월</option>
								<option value="09" <? if($m_month == "09"){ echo "selected"; } ?> >9월</option>
								<option value="10" <? if($m_month == "10"){ echo "selected"; } ?> >10월</option>
								<option value="11" <? if($m_month == "11"){ echo "selected"; } ?> >11월</option>
								<option value="12" <? if($m_month == "12"){ echo "selected"; } ?> >12월</option>
							</select>
						</div>
					</div>
					
					<div id="panel-2" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>통계 리스트</strong> <!-- panel title -->
							</span>
							
							<span class="bold" style="padding-left:50px;">
								(
								이달의 
								총 앱 설치 : <font style="color:red;"><?=number_format($month_app)?></font>명,

								전체
								앱 설치 : <font style="color:red;"><?=number_format($total_app)?></font>명

								)
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->
						</div>

						<!-- panel content -->
						<div class="panel-body">
							<div class="table-responsive">
								<div style="position:relative; width:600px;">
								<table class="table table-bordered table-vertical-middle nomargin">
									<thead>
									<tr>
										<th class="width-100" style="vertical-align:middle;"><nobr>날짜</nobr></th>
										<th class="width-100"><nobr>설치자</nobr></th>
										<th class="width-100"><nobr>설치자중 로그인한 회원</nobr></th>										
									</tr>
									</thead>
									<tbody>
									<?
										if($month_app> 0){
											foreach($mlist as $data){
									?>
									<tr>
										<td class="text-center"><nobr><?=$data['m_day']?></nobr></td>
										<td class="text-center"><nobr><?=number_format($data['m_cnt'])?>명</nobr></td>
										<td class="text-center"><nobr><?=number_format($data['login_cnt'])?>명</nobr></td>
									</tr>
									<?
											}
										}else{
									?>
									<tr>
										<td class="text-center" colspan="4"><nobr><b>검색 결과가 없습니다.</b></nobr></td>
									</tr>
									<?
										}
									?>

									<? if($month_app> 0){ ?>
									<tr>
										<td class="text-center bold"><nobr>합계</nobr></td>
										<td class="text-center bold"><nobr><?=number_format($month_app)?>명</nobr></td>	
										<td class="text-center bold"><nobr><?=number_format($month_login)?>명</nobr></td>	
									</tr>
									<? } ?>

									</tbody>
								</table>
								</div>
							</div>
						</div>



					</div>
					<!-- /PANEL -->

				</div>

			</section>
			<!-- /MIDDLE -->