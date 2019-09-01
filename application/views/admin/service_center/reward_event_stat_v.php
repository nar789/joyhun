<script type="text/javascript">

	$(document).ready(function(){
		
	});


	function register_view(){
		
		$(location).attr("href", "/admin/service_center/reward_event/reward_event_stat/val1/"+$("#m_year").val()+"/val2/"+$("#m_month").val());
	}

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>여성전용 리워드 이벤트 통계</h1>
	</header>
	<!-- /page title -->

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
				
				<!--span class="bold" style="padding-left:50px;">
					(
						
					)
				</span-->

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
							<th class="width-200" style="vertical-align:middle;"><nobr>날짜</nobr></th>
							<th class="width-100"><nobr>참여인원</nobr></th>
							<th class="width-100"><nobr>받을포인트</nobr></th>
							<th class="width-100"><nobr>지급인원</nobr></th>
							<th class="width-100"><nobr>지급포인트</nobr></th>			
						</tr>
						</thead>
						<?
							if(!empty($mlist)){
								foreach($mlist as $data){
						?>
						<tr>
							<td class="text-center bold"><nobr><?=$data['m_day']?></nobr></td>
							<td class="text-center"><nobr><?=$data['R_USER']?></nobr></td>
							<td class="text-center"><nobr><?=number_format($data['R_POINT'])?></nobr></td>
							<td class="text-center"><nobr><?=$data['G_USER']?></nobr></td>
							<td class="text-center"><nobr><?=number_format($data['G_POINT'])?></nobr></td>											
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td colspan="5" class="text-center bold"><nobr>결과가 없습니다.</nobr></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					</div>
					<!--div class="padding-top-20">
						<div class="col-md-10"><strong>이달의 회원가입 건수 Total :</strong><span class="text-danger">&nbsp;  &nbsp;</span>명</div>
						<div class="col-md-2"></div>
					</div-->
				</div>
			</div>


	</div>

</section>