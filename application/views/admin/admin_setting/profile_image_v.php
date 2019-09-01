<style>
.tbl{width:100%; font-size:0.9em;}
.tbl tr{height:40px;}
.tbl th{width:10%; background-color:#F0F2F8; border-top:solid 1px #D5D5D5; border-left:solid 1px #D5D5D5;}
.tbl td{width:15%; border-top:solid 1px #D5D5D5; border-left:solid 1px #D5D5D5; padding-left:10px;}
.tbl tr:last-child{border-bottom:solid 1px #D5D5D5;}
.tbl tr td:last-child{border-right:solid 1px #D5D5D5;}

.tbl2{width:100%; font-size:0.9em;}
.tbl2 th{width:25%;}

div#select_box {
    position: relative;
    width: 200px;
    height: 30px;
    background: url('/images/etc/allow.png') 180px center no-repeat; /* 화살표 이미지 */
    border: 1px solid #E9DDDD;
}
div#select_box label {
    position: absolute;
    font-size: 1.0em;
    color: #a97228;
    top: 5px;
    left: 12px;
    letter-spacing: 1px;
}
div#select_box select#sel {
    width: 100%;
    height: 40px;
    min-height: 40px;
    line-height: 40px;
    padding: 0 10px;
    opacity: 0;
    filter: alpha(opacity=0); /* IE 8 */
}

div#select_box2 {
    position: relative;
    width: 105px;
    height: 30px;
    background: url('/images/etc/allow.png') 85px center no-repeat; /* 화살표 이미지 */
    border: 1px solid #E9DDDD;
	display:inline-block;
}
div#select_box2 label {
    position: absolute;
    font-size: 1.0em;
    color: #a97228;
    top: 5px;
    left: 12px;
    letter-spacing: 1px;
}
div#select_box2 select#sel {
    width: 100%;
    height: 40px;
    min-height: 40px;
    line-height: 40px;
    padding: 0 10px;
    opacity: 0;
    filter: alpha(opacity=0); /* IE 8 */
}

.it{border:solid 1px #D5D5D5; width:80%;}
.it_50{border:solid 1px #D5D5D5; width:40%; text-align:center;}

#btn_search{width:200px; height:30px;}


</style>


<script type="text/javascript">

	$(document).ready(function(){

		//달력
		$(".cal").datepicker({			
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

		//select box 관련 함수
		var select = $("select#sel");

		//select box 기본 셋팅
		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
			
			//나이선택시 이벤트
			if($(this).attr("name") == "v_age_1"){
				$("select[name='v_age_2']").empty();
				$("select[name='v_age_2']").append("<option value=''>- 나이 -</option>");
				for(i=$(this).val(); i<70; i++){
					$("select[name='v_age_2']").append("<option value='"+i+"'>- "+i+"세 -</option>");
				}
			}
		});
		
		//지역값을 있을경우 selected
		if($("select[name='v_area']").val()){
			var v_area = $("select[name='v_area']").children("option:selected").text();
			$("select[name='v_area']").siblings("label").text(v_area);
		}
		
		//나이값이 있을경우 selected
		if($("select[name='v_age_1']").val()){
			var v_age_1 = $("select[name='v_age_1']").children("option:selected").text();
			$("select[name='v_age_1']").siblings("label").text(v_age_1);

			$("seelct[name='v_age_2']").empty();
			$("select[name='v_age_2']").append("<option value=''>- 나이 -</option>");
			for(i=$("select[name='v_age_1']").val(); i<70; i++){
				$("select[name='v_age_2']").append("<option value='"+i+"'>- "+i+"세 -</option>");
			}

			if("<?=$v_age_2?>"){
				$("select[name='v_age_2']").val("<?=$v_age_2?>");
				var v_age_2 = $("select[name='v_age_2']").children("option:selected").text();
				$("select[name='v_age_2']").siblings("label").text(v_age_2);
			}			
			
		}

		
		//input type들 엔터처리
		$('input').keyup(function(e) {
			if(e.keyCode == 13) btn_search();        
		});



	});

	
	//검색버튼 클릭시 이벤트
	function btn_search(){

		var v_para = "";		//파라미터 변수 초기화 셋팅
		
		if($("#v_point").val()){ v_para += "/point/"+encodeURIComponent($("#v_point").val()); }											//포인트변수 파라미터
		if($("select[name='v_area']").val()){ v_para += "/area/"+encodeURIComponent($("select[name='v_area']").val()); }					//지역변수 파라미터
		if($("select[name='v_age_1']").val()){ v_para += "/age_1/"+encodeURIComponent($("select[name='v_age_1']").val()); }				//나이1변수 파라미터
		if($("select[name='v_age_2']").val()){ v_para += "/age_2/"+encodeURIComponent($("select[name='v_age_2']").val()); }				//나이2변수 파라미터
		if($("select[name='v_type']").val()){ v_para += "/type/"+encodeURIComponent($("select[name='v_type']").val()); }					//회원등급변수 파라미터
		if($("#v_access_1").val()){ v_para += "/access_1/"+encodeURIComponent($("#v_access_1").val()); }								//접속날짜1변수 파라미터
		if($("#v_access_2").val()){ v_para += "/access_2/"+encodeURIComponent($("#v_access_2").val()); }								//접속날짜2변수 파라미터
		if($("#v_join_1").val()){ v_para += "/join_1/"+encodeURIComponent($("#v_join_1").val()); }										//가입날짜1변수 파라미터
		if($("#v_join_2").val()){ v_para += "/join_2/"+encodeURIComponent($("#v_join_2").val()); }										//가입날짜2변수 파라미터

		$(location).attr("href", "/admin/chatting/profile_image/main"+v_para);
	}

</script>


<section id="middle">
	
	<!-- page title -->
	<header id="page-header">
		<h1>프로필 이미지 쪽지 보내기</h1>
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
				<!-- 검색조건 -->
				<div style="position:relative; width:100%;">
					<table cellspacing=0 cellpadding=0 class="tbl">
						<tr>
							<th>포인트</th>
							<td>
								<input type="text" id="v_point" name="v_point" value="<?=@$v_point?>" class="it text-center"> P이상
							</td>
							<th>지역</th>
							<td>
								<div id="select_box">
									<label for="sel">- 지역 -</label>
									<select id="sel" name="v_area">
										<option value="">- 지역 -</option>
										<option value="1" <? if(@$v_area == "1"){ echo "selected"; } ?> >- 서울/경기/인천 -</option>
										<option value="2" <? if(@$v_area == "2"){ echo "selected"; } ?> >- 부산/울산/경남 -</option>
										<option value="3" <? if(@$v_area == "3"){ echo "selected"; } ?> >- 대구/경북 -</option>
										<option value="4" <? if(@$v_area == "4"){ echo "selected"; } ?> >- 광주/전남/전북 -</option>
										<option value="5" <? if(@$v_area == "5"){ echo "selected"; } ?> >- 대전/충남/충북 -</option>
										<option value="6" <? if(@$v_area == "6"){ echo "selected"; } ?> >- 강원 -</option>
										<option value="7" <? if(@$v_area == "7"){ echo "selected"; } ?> >- 제주 -</option>
										<option value="8" <? if(@$v_area == "8"){ echo "selected"; } ?> >- 해외 -</option>
									</select>
								</div>
							</td>
							<th>나이</th>
							<td>
								<div id="select_box2">
									<label for="sel">- 나이 -</label>
									<select id="sel" name="v_age_1">
										<option value="">- 나이 -</option>
										<? for($i=20; $i<70; $i++){ ?>
										<option value="<?=$i?>" <? if(@$v_age_1 == $i){ echo "selected"; } ?> >- <?=$i?>세 -</option>
										<? } ?>
									</select>
								</div>
								~
								<div id="select_box2">
									<label for="sel">- 나이 -</label>
									<select id="sel" name="v_age_2">
										<option value="">- 나이 -</option>							
									</select>
								</div>
							</td>
							<th>정회원여부</th>
							<td>
								<div id="select_box">
									<label for="sel">- 회원등급 -</label>
									<select id="sel" name="v_type">
										<option value="">- 회원등급 -</option>
										<option value="A" <? if(@$v_type == "A"){ echo "selected"; } ?> >- 전체(정회원+준회원) -</option>
										<option value="V" <? if(@$v_type == "V"){ echo "selected"; } ?> >- 정회원 -</option>
										<option value="F" <? if(@$v_type == "F"){ echo "selected"; } ?> >- 준회원 -</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<th>접속날짜</th>
							<td>
								<input type="text" id="v_access_1" name="v_access_1" value="<?=@$v_access_1?>" class="it_50 cal">
								~
								<input type="text" id="v_access_2" name="v_access_2" value="<?=@$v_access_2?>" class="it_50 cal">
							</td>
							<th>가입날짜</th>
							<td>
								<input type="text" id="v_join_1" name="v_join_1" value="<?=@$v_join_1?>" class="it_50 cal">
								~
								<input type="text" id="v_join_2" name="v_join_2" value="<?=@$v_join_2?>" class="it_50 cal">
							</td>
							<th></th>
							<td></td>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<td colspan="8" class="text-center">
								<input type="button" id="btn_search" name="btn_search" value="검색" class="btn btn-success" onclick="javascript:btn_search();">
							</td>
						</tr>
					</table>
				</div>
				
			</div>
		</div>
		
		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>받는 회원 리스트 미리보기</strong> <!-- panel title -->
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
								<th class="width-100">사진</th>
								<th class="width-100">회원아이디</th>
								<th class="width-100">이름</th>
								<th class="width-100">닉네임</th>
								<th class="width-100">나이</th>
								<th class="width-100">지역</th>
								<th class="width-100">회원등급</th>
								<th class="width-100">보유포인트</th>
								<th class="width-100">가입날짜</th>
								<th class="width-100">접속날짜</th>
							</tr>
						</thead>
					</table>
					<div style="width:100%; height:300px; overflow:auto;">
					<table class="table table-bordered table-vertical-middle nomargin">
						<tbody>
							<?
								if(@$total > 0){
									foreach($mlist as $data){
							?>
							<tr>
								<td class="width-100 text-center"><?=$this->member_lib->member_thumb($data['m_userid'], 50, 50)?></td>
								<td class="width-100 text-center"><?=$data['m_userid']?></td>
								<td class="width-100 text-center"><?=$data['m_name']?></td>
								<td class="width-100 text-center"><?=$data['m_nick']?></td>
								<td class="width-100 text-center"><?=$data['m_age']?></td>
								<td class="width-100 text-center"><?=$data['m_conregion']?></td>
								<td class="width-100 text-center"><?=$data['m_type']?></td>
								<td class="width-100 text-center"><?=$data['total_point']?></td>
								<td class="width-100 text-center"><?=$data['m_in_date']?></td>
								<td class="width-100 text-center"><?=$data['last_login_day']?></td>
							</tr>
							<?
									}
								}else{
							?>
							<tr>
								<td colspan="10" class="text-center bold">검색된회원이 없습니다.</td>
							</tr>
							<?
								}
							?>
						</tbody>
					</table>
					</div>
				</div>
			</div>


	</div>

</section>



