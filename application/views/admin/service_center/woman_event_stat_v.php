<script type="text/javascript">

	$(document).ready(function(){
		
	});

	
	function change_stat_page(){
		$(location).attr("href", "/admin/service_center/woman_event/woman_event_stat/m_year/"+encodeURIComponent($("#m_year").val())+"/m_month/"+encodeURIComponent($("#m_month").val()));
	}

	$(document).ready(function(){
		$("#app_btn1").click(function(){
			location.href= "/admin/service_center/woman_event/woman_event_stat";
		});

		$("#app_btn2").click(function(){
			location.href= "/admin/service_center/woman_event/woman_event_list";
		});
	});

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>여성회원이벤트통계</h1>
	</header>
	<!-- /page title -->
	
	<div class="panel-body">

		<div class="tabs nomargin">

			<!-- tabs -->
			<ul class="nav nav-tabs nav-justified">
				<li class="active">
					<a aria-expanded="false" href="#" data-toggle="tab" id="app_btn1">
						<i class="fa fa-heart"></i> 여성회원이벤트통계
					</a>
				</li>
				<li >
					<a aria-expanded="true" href="#" data-toggle="tab" id="app_btn2">
						<i class="fa fa-cogs"></i> 여성회원이벤트상세정보
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
				<select id="m_year" name="m_year" OnChange="javascript:change_stat_page();">
					<option value="">- 년도 -</option>
					<option value="2016" <? if($m_year == "2016"){ echo "selected"; } ?> >2016년</option>
				</select>
				<select id="m_month" name="m_month" OnChange="javascript:change_stat_page();">
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
							<th class="width-100"><nobr>참여회원수</nobr></th>
							<th class="width-100"><nobr>완료회원수</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>지급한상품갯수</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>총금액</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if(!empty($event_stat)){
								foreach($event_stat as $data){
									$TOTAL_JOIN_CNT		= $TOTAL_JOIN_CNT + $data['V_JOIN_CNT'];
									$TOTAL_SUCCESS_CNT  = $TOTAL_SUCCESS_CNT + $data['V_SUCCESS_CNT'];
									$TOTAL_GIFT_CNT		= $TOTAL_GIFT_CNT + $data['V_GIFT_CNT'];
									$TOTAL_PRICE		= $TOTAL_PRICE + call_woman_event_gift_price($data['V_DATE']);
						?>
						<tr>
							<td class="text-center"><?=$data['V_DATE']?></td>
							<td class="text-center"><?=$data['V_JOIN_CNT']?>명</td>
							<td class="text-center"><?=$data['V_SUCCESS_CNT']?>명</td>
							<td class="text-center"><?=$data['V_GIFT_CNT']?>개</td>
							<td class="text-center"><?=number_format(call_woman_event_gift_price($data['V_DATE']))?>원</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="5" class="text-center bold">결과가 없습니다.</td>
						</tr>
						<?
							}
						?>
						
						<? if(!empty($event_stat)){ ?>
						<tr>
							<td class="text-center bold">합계</td>
							<td class="text-center bold"><?=$TOTAL_JOIN_CNT?>명</td>
							<td class="text-center bold"><?=$TOTAL_SUCCESS_CNT?>명</td>
							<td class="text-center bold"><?=$TOTAL_GIFT_CNT?>개</td>
							<td class="text-center bold"><?=number_format($TOTAL_PRICE)?>원</td>
						</tr>
						<? } ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>


	</div>

</section>