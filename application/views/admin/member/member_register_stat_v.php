<script type="text/javascript">

	$(document).ready(function(){
		
	});


	function register_view(){
		
		$(location).attr("href", "/admin/main/register_stat/val1/"+$("#m_year").val()+"/val2/"+$("#m_month").val());
	}

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>회원가입통계</h1>
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
					<? for($i=date("Y"); $i>=2016; $i--){ ?>
					<option value="<?=$i?>" <? if($i == $m_year){ echo "selected"; } ?> ><?=$i?>년</option>
					<? } ?>
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
					총 회원가입 : <font style="color:red;"><?=number_format($total_member+$reg_member)?></font>명, &nbsp;
					정식회원 : <font style="color:red;"><?=number_format($total_member)?></font>명, &nbsp;
					임시회원 : <font style="color:red;"><?=number_format($reg_member)?></font>명
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
							<th class="width-100"><nobr>남자</nobr></th>
							<th class="width-100"><nobr>여자</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>계</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>인증률</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>임시회원</nobr></th>
							<th class="width-100" style="vertical-align:middle;"><nobr>탈퇴회원</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if($total_member+$reg_member > 0){
								foreach($mlist as $data){
									$total_m = $total_m+$data['m_cnt'];
									$total_f = $total_f+$data['f_cnt'];
									$total_a = $total_a+$data['a_cnt'];
									$total_r = $total_r+$data['r_cnt'];
									$total_out = $total_out+$data['out_cnt'];
									$total_mobile_m = $total_mobile_m+$data['mobile_m_cnt'];
									$total_mobile_w = $total_mobile_w+$data['mobile_w_cnt'];
						?>
						<tr>
							<td class="text-center"><nobr><?=$data['m_day']?></nobr></td>
							<td class="text-center"><nobr><?=number_format($data['m_cnt'])?>명</nobr></td>
							<td class="text-center"><nobr><?=number_format($data['f_cnt'])?>명</nobr></td>
							<td class="text-center" style="background-color:#F0F0F0;"><nobr><?=number_format($data['a_cnt'])?>명</nobr></td>
							<td class="text-center bold"><nobr><?=$data['mobile_per']?>%</nobr></td>
							<td class="text-center"><nobr><?=number_format($data['r_cnt'])?>명</nobr></td>
							<td class="text-center"><nobr><?=number_format($data['out_cnt'])?>명</nobr></td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center" colspan="7"><nobr><b>검색 결과가 없습니다.</b></nobr></td>
						</tr>
						<?
							}
						?>

						<? if($total_member+$reg_member > 0){ ?>
						<tr>
							<td class="text-center bold"><nobr>합계</nobr></td>
							<td class="text-center bold"><nobr><?=number_format($total_m)?>명</nobr></td>
							<td class="text-center bold"><nobr><?=number_format($total_f)?>명</nobr></td>
							<td class="text-center bold" style="background-color:#F0F0F0;"><nobr><?=number_format($total_a)?>명</nobr></td>			
							<td class="text-center bold"><nobr><?=round(($total_mobile_m+$total_mobile_w)/$total_a*100, 1)?>%</nobr></td>
							<td class="text-center bold"><nobr><?=number_format($total_r)?>명</nobr></td>
							<td class="text-center bold"><nobr><?=number_format($total_out)?>명</nobr></td>
						</tr>
						<? } ?>

						</tbody>
					</table>
					</div>
					<div class="padding-top-20">
						<div class="col-md-10"><strong>이달의 회원가입 건수 Total :</strong><span class="text-danger">&nbsp; <?=$total_member+$reg_member?> &nbsp;</span>명</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>