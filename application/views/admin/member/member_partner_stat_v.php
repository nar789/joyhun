<script type="text/javascript">

	$(document).ready(function(){
		
		$(".w40p").datepicker({			
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			yearSuffix: '년'

		});	
		
	});


	function partner_view(){
		
		$(location).attr("href", "/admin/main/partner_stat/val1/"+$("#from_date").val()+"/val2/"+$("#to_date").val());
	}



</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>파트너가입 통계</h1>
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
				
				<span><b>검색일자</b></span>
				<span>&nbsp;&nbsp;					
					<input type="text" id="from_date" name="from_date" class="input_text w40p" value="<?=$from_date?>">
					~
					<input type="text" id="to_date" name="to_date" class="input_text w40p" value="<?=$to_date?>">
				</span>
				<span class="span_width_100">&nbsp;</span>
				<!--span><b>성별</b></span>
				<span>&nbsp;&nbsp;
					<input type="radio" id="m_sex" name="m_sex" value="A"> 모두&nbsp;&nbsp;
					<input type="radio" id="m_sex" name="m_sex" value="M"> 남자&nbsp;&nbsp;
					<input type="radio" id="m_sex" name="m_sex" value="F"> 여자
				</span>
				<span class="span_width_100">&nbsp;</span-->
				<span><input type="button" id="btn_search" name="btn_search" class="btn btn-success" value="검색" style="width:70px;" onclick="javascript:partner_view();"></span>
			</div>
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>통계 리스트</strong> <!-- panel title -->
				</span>
				
				<span class="bold" style="padding-left:50px;">
					(
					해당기간의
					총 회원가입 : <font style="color:red;"><?=$total_members?></font>명 &nbsp;
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
					<div style="position:relative; <?=$div_max_width?>">
					
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th class="width-100"><nobr>아이디</nobr></th>
							<th class="width-100"><nobr>합계</nobr></th>
							<?
								if(!empty($list)){
									for($i=count($list)-1; $i>=1; $i--){
							?>
							<th class="width-100" id="day_<?=$i?>"><nobr><?=$list[$i]?></nobr></th>
							<?
									}
								}
							?>
						</tr>
						</thead>
						<tbody>
						<?
							if(!empty($partner_data)){
								$j=0;
								foreach($partner_data as $data){
						?>
						<tr>
							<td class="text-center" id="partner_<?=$j?>"><nobr><?=$data['m_partner']?></nobr></td>
							<td class="text-center"><nobr>
							<? 
								$total = "0";
								$total_price = "0";
								for($i=count($list)-1; $i>=1; $i--){ 
									$total = $total+$data['cnt_'.$i];
									$total_price = $total_price+$partner_price[$j]['total_price_'.$i];
								}
							?>
							<?=$total?>명<br><?=number_format($total_price)?>원
							</nobr></td>
							<?
								if(!empty($list)){
									for($i=count($list)-1; $i>=1; $i--){
							?>
							<td class="text-center"><nobr><?=$data['cnt_'.$i]?>명<br><span><?=number_format($partner_price[$j]['total_price_'.$i])?>원</span></nobr></td>
							<?
									}
								}
							?>
						</tr>
						<?
									$j++;									
								}
							}
						?>
						</tbody>
					</table>
					</div>
					<div class="padding-top-20">
						<div class="col-md-10"><strong>이달의 회원가입 건수 Total :</strong><span class="text-danger">&nbsp;  <?=$total_members?>&nbsp;</span>명</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>

<style>
.input_text{border:solid 1px #DDDDDD; width:100px;}
.span_width_100{display:inline-block; width:100px;}
</style>