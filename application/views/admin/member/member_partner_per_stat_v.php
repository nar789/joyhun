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


	function partner_per_view(){
		
		$(location).attr("href", "/admin/main/partner_per_stat/val1/"+$("#val1").val()+"/val2/"+$("#val2").val()+"/val3/"+$("#val3").val());
	}

	function onKeyUp(){
		if(event.keyCode == 13){
			partner_per_view();
			return;
		}
	}

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>파트너 전환률 통계</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div id="panel-1" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>전환률 통계(날짜기준)</strong> <!-- panel title -->
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
				
				<div style="position:relative; width:1100px;">
					<table cellspacing=0 cellpadding=0 class="tbl">
						<tr>
							<th>검색 일자</th>
							<td>
								<input type="text" id="val1" name="val1" class="w40p input_text" value="<?=$from_date?>">
								&nbsp;~&nbsp;
								<input type="text" id="val2" name="val1" class="w40p input_text" value="<?=$to_date?>">
							</td>
							<th>파트너 아이디</th>
							<td class="bdr">
								<input type="text" id="val3" name="val3" class="input_text_id" value="<?=$partner_id?>" onKeyUp="javascript:onKeyUp();">
							</td>
						</tr>
					</table>

					<div style="position:absolute; width:100px; top:5px; left:1020px;">
						<input type="button" id="btn_search" name="btn_search" class="btn btn-success" value="검색" style="width:70px;" onclick="javascript:partner_per_view();">
					</div>
				</div>
				
				
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

					<table class="table table-bordered table-vertical-middle nomargin">
						<thead>
						<tr class="bgc_F1F2F7">
							<th class="width-100"><nobr>파트너아이디</nobr></th>
							<th class="width-100"><nobr>가입자수<br>(임시회원)</nobr></th>
							<th class="width-100"><nobr>유료가입자수<br>(재결제 횟수)</nobr></th>
							<th class="width-100"><nobr>전환률</nobr></th>
							<th class="width-100"><nobr>최초결제(원)</nobr></th>
							<th class="width-100"><nobr>총 결제(원)</nobr></th>
							<th class="width-100"><nobr>인증률</nobr></th>			
						</tr>
						</thead>
						<tbody>
						<?
							if(!empty($partner_list)){
								foreach($partner_list as $data){
						?>
						<tr>
							<td class="text-center"><nobr><?=$data['m_partner']?></nobr></td>
							<td class="text-center"><nobr><?=$data['total_member_cnt']?> / <font style="color:red;"><?=$data['reg_member_cnt']?></font></nobr></td>
							<td class="text-center"><nobr><?=$data['pay_member']?> / <font style="color:red;"><?=$data['repay_member']?></font></nobr></td>
							<td class="text-center"><nobr><?=$data['pay_member_per']?>%</nobr></td>
							<td class="text-center"><nobr><?=number_format($data['first_total_price'])?></nobr></td>
							<td class="text-center"><nobr><?=number_format($data['total_price'])?></nobr></td>
							<td class="text-center"><nobr><?=$data['mobie_chk_per']?>%</nobr></td>
						</tr>
						<?
								}
							}else{
						?>
						<tr>
							<td class="text-center bold" colspan="7"><nobr>검색결과가 없습니다.</nobr></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
				</div>
			</div>


	</div>

</section>

<style>
.input_text{border:solid 1px #DDDDDD; width:135px; text-align:center;}
.input_text_id{border:solid 1px #DDDDDD; width:90%;}

.bdr{border-right:solid 1px #DDDDDD;}
.bgc_F1F2F7{background-color:#F1F2F7;}

.tbl{width:1000px;}
.tbl th{width:200px; height:50px; border-top:solid 1px #DDDDDD; border-bottom:solid 1px #DDDDDD; border-left:solid 1px #DDDDDD; background-color:#F1F2F7;}
.tbl td{width:300px; height:50px; border-top:solid 1px #DDDDDD; border-bottom:solid 1px #DDDDDD; border-left:solid 1px #DDDDDD; text-align:center;}
</style>