			<section id="middle">
				<div id="content" class="dashboard padding-20">

					<!-- 
						PANEL CLASSES:
							panel-default
							panel-danger
							panel-warning
							panel-info
							panel-success

						INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
								All pannels should have an unique ID or the panel collapse status will not be stored!
					-->
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>회원관리 > 회원가입 통계 </strong> <!-- panel title -->
								<small class="size-12 weight-300 text-mutted hidden-xs"><?=substr(TODAY,0,4)?>년</small>
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
							</ul>
							<!-- /right options -->

						</div>

						<!-- panel content -->
						<div class="panel-body">

							<div id="flot-sales" class="fullwidth height-250"></div>

						</div>
						<!-- /panel content -->

						<!-- panel footer -->
						<div class="panel-footer">

							<!-- 
								.md-4 is used for a responsive purpose only on col-md-4 column.
								remove .md-4 if you use on a larger column
							-->
							<ul class="easypiecharts list-unstyled">
								<li class="clearfix" style="vertical-align:middle">
									<span>오늘 07월 14일 가입자</span>
									<b style="float:right"><?=number_format($today_cnt['t_mb'])?> 명</b>
								</li>
								<li class="clearfix" style="vertical-align:middle">
									<span>어제 07월 13일 가입자</span>
									<b style="float:right"><?=number_format($yesterday_cnt['t_mb'])?>명</b>
								</li>
								<li class="clearfix" style="vertical-align:middle">
									<span>7월 총 가입자</span>
									<b style="float:right"><?=number_format($total_mb_month)?>명</b>
								</li>
								<li class="clearfix" style="vertical-align:middle">
									<span>전체회원</span>
									<b style="float:right"><?=number_format($total_mb_cnt)?> 명</b>
								</li>
							</ul>

						</div>
						<!-- /panel footer -->

					</div>
					<!-- /PANEL -->



					<!-- BOXES -->
					<div class="row">

						<!-- Feedback Box -->
						<div class="col-md-3 col-sm-6">

							<!-- BOX -->
							<div class="box danger">

								<div class="box-title"><!-- add .noborder class if box-body is removed -->
									<h4 style="font-weight:bold">오늘 총 채팅신청 <?=number_format($today_cnt['t_chat'])?>건</h4>
									<small class="block">어제 총 채팅신청 <?=number_format($yesterday_cnt['t_chat'])?>건</small>
									<i class="fa fa-comments"></i>
								</div>
	

								<div class="box-body text-center">

									<!-- #### 최근 한달치 차트 출력 #### -->
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										<?php
											if( @$month_chat_ary > 0 ){
												foreach(@$month_chat_ary as $data){

													echo $data['cnt'];

													if ($data != end($month_chat_ary)){
														echo ",";
													}
												}
											}
										?>
									</span>
								</div>

							</div>
							<!-- /BOX -->
						</div>

						<!-- Profit Box -->
						<div class="col-md-3 col-sm-6">

							<!-- BOX -->
							<div class="box warning">

								<div class="box-title"><!-- add .noborder class if box-body is removed -->
									<h4 style="font-weight:bold">오늘 총 메시지전송 <?=number_format($today_cnt['t_mes'])?>건</h4>
									<small class="block">어제 총 메시지전송 <?=number_format($yesterday_cnt['t_mes'])?>건</small>
									<i class="fa fa-bar-chart-o"></i>
								</div>

								<div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										<?php
											if( @$month_mes_ary > 0 ){
												foreach(@$month_mes_ary as $data){
													echo $data['cnt'];

													if ($data != end($month_mes_ary)){
														echo ",";
													}
												}
											}
										?>
									</span>
								</div>

							</div>
							<!-- /BOX -->

						</div>

						<!-- Orders Box -->
						<div class="col-md-3 col-sm-6">

							<!-- BOX -->
							<div class="box default"><!-- default, danger, warning, info, success -->

								<div class="box-title"><!-- add .noborder class if box-body is removed -->
									<h4 style="font-weight:bold">오늘 파트너가입 <?=number_format($today_cnt['t_part'])?>건</h4>
									<small class="block">어제 파트너가입 <?=number_format($yesterday_cnt['t_part'])?>건</small>
									<i class="fa fa-shopping-cart"></i>
								</div>

								<div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										<?php
											if( @$month_part_ary > 0 ){
												foreach(@$month_part_ary as $data){
													echo $data['cnt'];

													if ($data != end($month_part_ary)){
														echo ",";
													}
												}
											}
										?>
									</span>
								</div>

							</div>
							<!-- /BOX -->

						</div>

						<!-- Online Box -->
						<div class="col-md-3 col-sm-6">

							<!-- BOX -->
							<div class="box success"><!-- default, danger, warning, info, success -->

								<div class="box-title"><!-- add .noborder class if box-body is removed -->
									<h4 style="font-weight:bold">현재 접속자 <?=number_format($live_mb_cnt)?>명</h4>
									<small class="block">&nbsp;</small>
									<i class="fa fa-globe"></i>
								</div>

								<div class="box-body text-center">
									<span class="sparkline" style="height:35px;"></span>
								</div>

								<!-- <div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
								</div> -->

							</div>
							<!-- /BOX -->

						</div>

					</div>
					<!-- /BOXES -->



					<div class="row">

						<div class="col-md-6">

							<!-- 
								PANEL CLASSES:
									panel-default
									panel-danger
									panel-warning
									panel-info
									panel-success

								INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
										All pannels should have an unique ID or the panel collapse status will not be stored!
							-->
							<div id="panel-2" class="panel panel-default">
								<div class="panel-heading">
									<span class="title elipsis">
										<strong></strong> <!-- panel title -->
									</span>

									<!-- tabs nav -->
									<ul class="nav nav-tabs pull-right">
										<li class="active"><!-- TAB 1 -->
											<a href="#ttab1_nobg" data-toggle="tab">회원문의내역</a>
										</li>
										<li class=""><!-- TAB 2 -->
											<a href="#ttab2_nobg" data-toggle="tab">신고내역</a>
										</li>
									</ul>
									<!-- /tabs nav -->


								</div>

								<!-- panel content -->
								<div class="panel-body">

									<!-- tabs content -->
									<div class="tab-content transparent">

										<div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->

											<div class="table-responsive">
												<table class="table table-striped table-hover table-bordered">
													<thead>
														<tr>
															<th class="width-450">제목</th>
															<th>날짜</th>
															<th>답변여부</th>
															<th></th>
														</tr>
													</thead>
													<tbody>

										<?php
										if( $question > 0 )
										{
											foreach($question as $data)
											{
										?>
														<tr>
															<td><a href="/admin/service_center/my_question/my_question_view/f_num/<?=$data['f_num']?>"><?=strcut_utf8($data['f_title'],38)?></a></td>
															<td><?=$data['f_writeday']?></td>
															<td><? if($data['f_answerYN'] == "Y"){ echo "완료"; }?></td>
															<td><a href="/admin/service_center/my_question/my_question_view/f_num/<?=$data['f_num']?>" class="btn btn-default btn-xs btn-block">View</a></td>
														</tr>
										<? }
										}
										?>
													</tbody>
												</table>

												<a class="size-12" href="/admin/service_center/my_question/my_question_list">
													<i class="fa fa-arrow-right text-muted"></i> 
													회원문의내역 바로가기
												</a>

											</div>

										</div><!-- /TAB 1 CONTENT -->

										<div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->

											<div class="table-responsive">
												<table class="table table-striped table-hover table-bordered">
													<thead>
														<tr>
															<th class="width-450">제목</th>
															<th>날짜</th>
															<th>처벌상태</th>
															<th></th>
														</tr>
													</thead>
													<tbody>

										<?php
										if( $complaint > 0 )
										{
											foreach($complaint as $data)
											{
										?>
														<tr>
															<td><a href="/admin/service_center/complaint/complain_view/idx/<?=$data['c_idx']?>"><?=strcut_utf8($data['c_content'],38)?></a></td>
															<td><?=$data['c_date']?></td>
															<td><? if($data['c_success'] == '1'){ echo "접수";
															}else  if($data['c_success'] == '7'){ echo "처벌완료";
															}else  if($data['c_success'] == '4'){ echo "판결불가"; } ?></td>
															<td><a href="/admin/service_center/complaint/complain_view/idx/<?=$data['c_idx']?>" class="btn btn-default btn-xs btn-block">View</a></td>
														</tr>
										<? }
										}
										?>
													</tbody>
												</table>

												<a class="size-12" href="/admin/service_center/complaint/complain_list">
													<i class="fa fa-arrow-right text-muted"></i> 
													신고내역 바로가기
												</a>

											</div>

										</div><!-- /TAB 1 CONTENT -->

									</div>
									<!-- /tabs content -->

								</div>
								<!-- /panel content -->

							</div>
							<!-- /PANEL -->
					
						</div>

						<div class="col-md-6">

							<!-- 
								PANEL CLASSES:
									panel-default
									panel-danger
									panel-warning
									panel-info
									panel-success

								INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
										All pannels should have an unique ID or the panel collapse status will not be stored!
							-->
							<div id="panel-3" class="panel panel-default">
								<div class="panel-heading">
									<span class="title elipsis">
										<strong>결제내역</strong> <!-- panel title -->
									</span>
								</div>

								<!-- panel content -->
								<div class="panel-body">

									<ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">
									 <!-- ## 이틀정도만 ##  -->
										<?php
										if( $pay_main > 0 )
										{
											foreach($pay_main as $data)
											{
										?>
											<li <? if($data['pay_gubn'] == '시도'){?>style="background:#eeeeee;"<?}?>>
												<? if($data['pay_gubn'] == '시도'){?><span class="label label-default"><i class="fa fa-krw size-15"></i></span>
												<?}else{?><span class="label label-success"><i class="fa fa-krw size-15"></i></span><?}?>
												<a href="/admin/etc/payment/payment_list">
													<span style="width:90px;display:inline-block;">[<?=$data['pay_method']?>]</span>
													<span style="width:190px;display:inline-block;"><?=$data['m_userid']?>(<?=$data['m_nick']?>)</span>
													<?=$data['goods']?> / <?=$data['pay_gubn']?>
												</a>
											</li>
										<? }
										
										} ?>
									</ul>

								</div>
								<!-- /panel content -->

								<!-- panel footer -->
								<div class="panel-footer">

									<a href="/admin/etc/payment/payment_list"><i class="fa fa-arrow-right text-muted"></i> 결제내역 바로가기</a>

								</div>
								<!-- /panel footer -->

							</div>
							<!-- /PANEL -->

						</div>

					</div>

				</div>
			</section>


		<!-- PAGE LEVEL SCRIPT -->
		<script type="text/javascript">
			/* 
				Toastr Notification On Load 

				TYPE:
					primary
					info
					error
					success
					warning

				POSITION
					top-right
					top-left
					top-center
					top-full-width
					bottom-right
					bottom-left
					bottom-center
					bottom-full-width
					
				false = click link (example: "http://www.stepofweb.com")
			*/
			_toastr("Welcome, you have 2 new orders","top-right","success",false);




			/** SALES CHART
			******************************************* **/
			loadScript(plugin_path + "chart.flot/jquery.flot.min.js", function(){
				loadScript(plugin_path + "chart.flot/jquery.flot.resize.min.js", function(){
					loadScript(plugin_path + "chart.flot/jquery.flot.time.min.js", function(){
						loadScript(plugin_path + "chart.flot/jquery.flot.fillbetween.min.js", function(){
							loadScript(plugin_path + "chart.flot/jquery.flot.orderBars.min.js", function(){
								loadScript(plugin_path + "chart.flot/jquery.flot.pie.min.js", function(){
									loadScript(plugin_path + "chart.flot/jquery.flot.tooltip.min.js", function(){

										if (jQuery("#flot-sales").length > 0) {


											/* DEFAULTS FLOT COLORS */
											var $color_border_color = "#eaeaea",		/* light gray 	*/
												$color_second 		= "#6595b4";		/* blue      	*/

											// 상단 그래프 // 배열 만들어놓기
											var d = new Array();
											var join_last_data = new Array();

											// 데이터 가져오기 ajax
											$.ajax({
												type: "POST",
												url: "/admin/main/join_mb_cnt_list",
												data: {	},
												cache: false,
												async: false,
												success: function(data) {

													// 쪼개기
													var array_first = data.split('/');
													var array_first_cnt = array_first.length;

													for (i=0; i<array_first_cnt; i++){
														d[i] = new Array();

														join_last_data[i] = array_first[i].split('+');

														// 설정된 d 배열에 넣기
														d[i][0] = parseInt($.trim(parseInt(join_last_data[i][0])+parseInt(3600)+'000'));
														d[i][1] = $.trim(join_last_data[i][1]);
													}
												},
												error : function(data){
													alert("실패하였습니다. (" + data + ")");
												}
											});


											var options = {

												xaxis : {
													mode : "time",
													tickLength : 5,
													timeformat: "20%y-%m-%d"
												},

												series : {
													lines : {
														show : true,
														lineWidth : 1,
														fill : true,
														fillColor : {
															colors : [{
																opacity : 0.1
															}, {
																opacity : 0.15
															}]
														}
													},
												  // points: { show: true }, // //주석달기
													shadowSize : 0
												},

												selection : {
													mode : "x"
												},

												grid : {
													hoverable : true,
													clickable : true,
													tickColor : $color_border_color,
													borderWidth : 0,
													borderColor : $color_border_color,
												},

												tooltip : true,

												tooltipOpts : {
													// x:날짜, y:명수
													content : "가입자: %x <span class='block'>%y명</span>",
													dateFormat : "%y-%0m-%0d",
													defaultTheme : false
												},

												colors : [$color_second],
										
											};
										
											var plot = jQuery.plot(jQuery("#flot-sales"), [d], options);
										}

									});
								});
							});
						});
					});
				});
			});
			</script>