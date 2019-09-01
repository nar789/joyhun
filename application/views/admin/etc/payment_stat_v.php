<script type="text/javascript">

	$(document).ready(function(){
		
	});


	function pay_view(){
		
		$(location).attr("href", "/admin/etc/payment_stat/payment_stat_view/val1/"+$("#m_year").val()+"/val2/"+$("#m_month").val());
	}

</script>

<style>
	.bg_f0fff0{
		background-color:#f0fff0;
	}

	.right_line{
		border-right-color: #919191 !important;
	}

	.left_line{
		border-left-color: #919191 !important;
	}

	.top_line{
		border-top-width:2px !important;
	}
</style>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>결제내역통계</h1>
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
				<select id="m_year" name="m_year" onChange="javascript:pay_view();">
					<option value="">- 년도 -</option>
					<? for($i=date("Y"); $i>=2016; $i--){ ?>
					<option value="<?=$i?>" <? if($i == $m_year){ echo "selected"; } ?> ><?=$i?>년</option>
					<? } ?>
				</select>
				<select id="m_month" name="m_month" onChange="javascript:pay_view();">
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
					<strong>결제내역 리스트</strong> <!-- panel title -->
				</span>

				<span class="bold" style="padding-left:50px;">
					(총 매출액 : <font style="color:red;"><?=number_format($total_sales['sales'])?></font>원, &nbsp;총 결제 건수 : <font style="color:red;"><?=$total_sales['cnt']?></font>건)
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
					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr>
							<th class="width-100" rowspan="2" style="vertical-align:middle;"><nobr>날짜</nobr></th>
							<th colspan="7" class="right_line"><nobr>PC결제</nobr></th>
							<th colspan="3" class="right_line"><nobr>MOBILE결제</nobr></th>
							<th colspan="4" class="right_line"><nobr>APP결제</nobr></th>
							<th class="width-150 left_line" rowspan="2" style="vertical-align:middle;"><nobr>계<br>(매출)</nobr></th>
							<th class="width-50" rowspan="2" style="vertical-align:middle;"><nobr>계<br>(결제건수)</nobr></th>
						</tr>
						<tr>
							<th class="width-100"><nobr>핸드폰</nobr></th>
							<th class="width-100"><nobr>신용카드</nobr></th>
							<th class="width-100"><nobr>가상계좌</nobr></th>
							<th class="width-100"><nobr>계좌이체</nobr></th>
							<th class="width-100"><nobr>무통장</nobr></th>
							<th class="width-100"><nobr>ARS(걸기)</nobr></th>
							<th class="width-100 right_line"><nobr>ARS(받기)</nobr></th>
							<th class="width-100"><nobr>핸드폰</nobr></th>
							<th class="width-100"><nobr>신용카드</nobr></th>
							<th class="width-100 right_line"><nobr>무통장</nobr></th>
							<th class="width-100"><nobr>구글인앱</nobr></th>
							<th class="width-100"><nobr>핸드폰</nobr></th>
							<th class="width-100"><nobr>신용카드</nobr></th>
							<th class="width-100 right_line"><nobr>무통장</nobr></th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								foreach($mlist as $data){
									$TOTAL_HP1 = $TOTAL_HP1+$data['HP1'];
									$TOTAL_CD1 = $TOTAL_CD1+$data['CD1'];
									$TOTAL_BK1 = $TOTAL_BK1+$data['BK1'];
									$TOTAL_AC1 = $TOTAL_AC1+$data['AC1'];
									$TOTAL_MU1 = $TOTAL_MU1+$data['MU1'];
									$TOTAL_TP1 = $TOTAL_TP1+$data['TP1'];
									$TOTAL_PB1 = $TOTAL_PB1+$data['PB1'];
									$TOTAL_HP2 = $TOTAL_HP2+$data['HP2'];
									$TOTAL_CD2 = $TOTAL_CD2+$data['CD2'];
									$TOTAL_MU2 = $TOTAL_MU2+$data['MU2'];
									$TOTAL_GG = $TOTAL_GG+$data['GG'];
									$TOTAL_HP3 = $TOTAL_HP3+$data['HP3'];
									$TOTAL_CD3 = $TOTAL_CD3+$data['CD3'];
									$TOTAL_MU3 = $TOTAL_MU3+$data['MU3'];
									$TOTAL_ALL = $TOTAL_ALL+$data['DAY_TOTAL'];
									$TOTAL_CNT = $TOTAL_CNT+$data['PAY_CNT'];
						?>
						<tr class="<?if($data['m_day'] == TODAY){echo "bg_f0fff0";}?>" onmouseover="this.style.background='#e3f1ff'" onmouseout="this.style.background=''">
							<td class="text-center" title="날짜"><nobr><?=$data['m_day']?></nobr></td>
							<td class="text-center" title="PC-핸드폰"><nobr><?=number_format($data['HP1'])?></nobr></td>
							<td class="text-center" title="PC-신용카드"><nobr><?=number_format($data['CD1'])?></nobr></td>
							<td class="text-center" title="PC-가상계좌"><nobr><?=number_format($data['BK1'])?></nobr></td>
							<td class="text-center" title="PC-계좌이체"><nobr><?=number_format($data['AC1'])?></nobr></td>
							<td class="text-center" title="PC-무통장"><nobr><?=number_format($data['MU1'])?></nobr></td>
							<td class="text-center" title="PC-ARS(걸기)"><nobr><?=number_format($data['TP1'])?></nobr></td>
							<td class="text-center right_line" title="PC-ARS(받기)"><nobr><?=number_format($data['PB1'])?></nobr></td>
							<td class="text-center" title="MOBILE-핸드폰"><nobr><?=number_format($data['HP2'])?></nobr></td>
							<td class="text-center" title="MOBILE-신용카드"><nobr><?=number_format($data['CD2'])?></nobr></td>
							<td class="text-center right_line" title="MOBILE-무통장"><nobr><?=number_format($data['MU2'])?></nobr></td>
							<td class="text-center" title="APP-구글인앱"><nobr><?=number_format($data['GG'])?></nobr></td>
							<td class="text-center" title="APP-핸드폰"><nobr><?=number_format($data['HP3'])?></nobr></td>
							<td class="text-center" title="APP-신용카드"><nobr><?=number_format($data['CD3'])?></nobr></td>
							<td class="text-center right_line" title="APP-무통장"><nobr><?=number_format($data['MU3'])?></nobr></td>
							<td class="text-center" title="계(매출)"><nobr><?=number_format($data['DAY_TOTAL'])?></nobr></td>
							<td class="text-center" title="계(결제건수)"><nobr></nobr><?=$data['PAY_CNT']?>건</td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center" colspan="15"><nobr><b>검색 결과가 없습니다.</b></nobr></td>
						</tr>
						<?
							}
						?>

						<? if($getTotalData > 0){ ?>
						<tr>
							<td class="text-center bold top_line"><nobr>합계</nobr></td>
							<td class="text-center bold top_line" title="PC-핸드폰"><nobr><?=number_format($TOTAL_HP1)?></nobr></td>
							<td class="text-center bold top_line" title="PC-신용카드"><nobr><?=number_format($TOTAL_CD1)?></nobr></td>
							<td class="text-center bold top_line" title="PC-가상계좌"><nobr><?=number_format($TOTAL_BK1)?></nobr></td>
							<td class="text-center bold top_line" title="PC-계좌이체"><nobr><?=number_format($TOTAL_AC1)?></nobr></td>
							<td class="text-center bold top_line" title="PC-무통장"><nobr><?=number_format($TOTAL_MU1)?></nobr></td>
							<td class="text-center bold top_line" title="PC-ARS(걸기)"><nobr><?=number_format($TOTAL_TP1)?></nobr></td>
							<td class="text-center bold right_line top_line" title="PC-ARS(받기)"><nobr><?=number_format($TOTAL_PB1)?></nobr></td>
							<td class="text-center bold top_line" title="MOBILE-핸드폰"><nobr><?=number_format($TOTAL_HP2)?></nobr></td>
							<td class="text-center bold top_line" title="MOBILE-신용카드"><nobr><?=number_format($TOTAL_CD2)?></nobr></td>
							<td class="text-center bold right_line top_line" title="MOBILE-무통장"><nobr><?=number_format($TOTAL_MU2)?></nobr></td>
							<td class="text-center bold top_line" title="APP-구글인앱"><nobr><?=number_format($TOTAL_GG)?></nobr></td>
							<td class="text-center bold top_line" title="APP-핸드폰"><nobr><?=number_format($TOTAL_HP3)?></nobr></td>
							<td class="text-center bold top_line" title="APP-신용카드"><nobr><?=number_format($TOTAL_CD3)?></nobr></td>
							<td class="text-center bold right_line top_line" title="APP-무통장"><nobr><?=number_format($TOTAL_MU3)?></nobr></td>
							<td class="text-center bold top_line" title="계(매출)"><nobr><?=number_format($TOTAL_ALL)?></nobr></td>
							<td class="text-center bold top_line" title="계(결제건수)"><nobr><?=$TOTAL_CNT?>건</nobr></td>
						</tr>
						<? } ?>

						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>이달의 결제 건수 Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>건</div>
						<div class="col-md-8 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>


	</div>

</section>