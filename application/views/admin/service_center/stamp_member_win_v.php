
<section id="middle">

	<!-- page title -->
	<header id="page-header">
		<h1>출석체크 당첨자</h1>
	</header>
	<!-- /page title -->

	
	<div id="content" class="padding-20">
		<div id="panel-2" class="panel panel-default">			
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>당첨자 리스트</strong> <!-- panel title -->
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
				
				<span><b><?=$m_year?>년 <?=$m_month?>월 출석체크 이벤트 당첨자</b></span>
				<div style="border:solid 1px #D2D2D2; position:relative; width:100%; height:200px; padding:10px 10px 10px 10px;">
					<?=$resut_array?>
				</div>



				<div class="text-center margin-top-20">
					<button type="button" class="btn btn-info btn-lg" id="notice_list" onclick="location.href='/admin/service_center/stamp_event/stamp_member'">목록</button>
				</div>
			</div>
			<!-- /panel content -->
		</form>
	</fieldset>
	<!-- /PANEL -->

	</div>
</div>
</section>
<!-- /MIDDLE -->

