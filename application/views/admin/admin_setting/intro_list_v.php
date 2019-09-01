<style>
.tbl{width:100%;}
.tbl th{width:12.5%; height:40px; background-color:#F1F2F7;}
.tbl td{width:12.5%; text-align:center;}
.tbl td input[type=text]{border:solid 1px #D2D2D2;}
.tbl td input[type=button]{width:100px; height:30px;}
.tbl td input[type=radio]{cursor:pointer; vertical-align:-1px;}

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

input[type=checkbox]{cursor:pointer;}


</style>

<script>

	$(document).ready(function(){

		//select box 관련 함수
		var select = $("select#sel");

		//select box 기본 셋팅
		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});

		if($("select[name='v_code']").val()){
			var v_code = $("select[name='v_code']").children("option:selected").text();
			$("select[name='v_code']").siblings("label").text(v_code);
		}	
		
		//검색 파라미터 변수 초기화 셋팅
		var v_para = "";

		//검색버튼 클릭시 이벤트
		$("#btn_search").click(function(){
			
			if($("#v_text").val()){ v_para += "/v_text/"+encodeURIComponent($("#v_text").val()); }
			if($("select[name='v_code']").val()){ v_para += "/v_code/"+encodeURIComponent($("select[name='v_code']").val()); }
			if($("input[name='v_sex']:checked").val()){ v_para += "/v_sex/"+encodeURIComponent($("input[name='v_sex']:checked").val()); }
			if($("input[name='v_use_yn']:checked").val()){ v_para += "/v_use_yn/"+encodeURIComponent($("input[name='v_use_yn']:checked").val()); }

			$(location).attr("href", "/admin/admin_setting/intro_list/"+v_para);			
		});

		//input type들 엔터처리
		$('input').keyup(function(e) {
			if(e.keyCode == 13) $("#btn_search").click();        
		});
		
		//전체 체크/ 전체 해지
		$("#all_chk").click(function(){
			if($("#all_chk").prop("checked")){
				$("input[id='intro_chk']").prop("checked", true);
			}else{
				$("input[id='intro_chk']").prop("checked", false);
			}
		});

		//선택 삭제 버튼 클릭 이벤트
		$("#btn_sel_del").click(function(){
			
			if($("#intro_chk").is(":checked") == false){
				alert("삭제할 리스트를 선택하세요.");
				return;
			}else{
				
				var chk_val = "";

				$("input[id='intro_chk']:checked").each(function(){
					
					if(chk_val){
						chk_val = chk_val+"|"+$(this).val();
					}else{
						chk_val = $(this).val();
					}

				});
				//삭제함수 호출
				intro_list_del(chk_val);
			}

		});
	
	});

	//인사말 신규등록 및 수정
	function reg_intro_func(){
		
		//변수받기
		var v_idx		= $("#v_idx").val();
		var v_code		= $("#v_code").val();
		var v_sex		= $("#v_sex").val();
		var v_use_yn	= $("#v_use_yn").val();
		var v_text		= $("#v_text").val();
		
		var v_gubn = "";
		
		//신규등록인지 업데이트인지 구분값 설정
		if(v_idx == ""){
			v_gubn = "insert";
		}else{
			v_gubn = "update";
		}
		
		//폼체크
		if(v_code == ""){alert("구분값을 선택하세요."); return;}
		if(v_sex == ""){alert("성별을 선택하세요."); return;}
		if(v_use_yn == ""){alert("사용여부를 선택하세요."); return;}
		if(v_text == ""){alert("내용을 입력하세요."); return;}

		$.ajax({
			
			type : "post",
			url : "/admin/admin_setting/call_reg_intro",
			data : {
				"v_idx"			: encodeURIComponent(v_idx),
				"v_code"		: encodeURIComponent(v_code),
				"v_sex"			: encodeURIComponent(v_sex),
				"v_use_yn"		: encodeURIComponent(v_use_yn),
				"v_text"		: encodeURIComponent(v_text),
				"v_gubn"		: encodeURIComponent(v_gubn)
			},
			cache : false,
			async : false,
			success : function(result){
				
				if(result == "1"){
					alert("저장되었습니다.");
					location.reload();
				}else if(result == "0"){
					alert("데이터 저장에 실패했습니다. ("+ result +")");
				}else if(result == "1000"){
					alert("잘못된 접근입니다. ("+ result +")");
				}else{
					alert("실패 ("+ result +")");
				}
			},
			error : function(result){
				alert("실패 ("+ result +")");
			}

		});

	}

	//삭제처리 함수
	function intro_list_del(val){
		
		if(confirm("선택하신 리스트를 삭제하시겠습니까?") == true){

			$.ajax({

				type : "post",
				url : "/admin/admin_setting/intro_list_del",
				data : {
					"val"	: encodeURIComponent(val)
				},
				cache : false,
				async : false,
				success : function(result){
					
					if(result == "1"){
						alert("선택한 리스트가 삭제되었습니다.");
						location.reload();
					}else if(result == "0"){
						alert("삭제에 실패했습니다. ("+ result +")");
						location.reload();
					}else{
						alert("실패 ("+ result +")");
						return;
					}

				},
				error : function(result){
					alert("실패 ("+ result +")");
				}

			});

		}

	}

</script>
			<section id="middle">

				<!-- page title -->
				<header id="page-header">
					<h1>인사말 관리</h1>
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
				
				<div style="position:relative; width:100%;">
					<table class="table table-bordered table-vertical-middle nomargin tbl">
						<tr>
							<th>검색어</th>
							<td>
								<input type="text" id="v_text" name="v_text" value="<?=$v_text?>">
							</td>
							<th>구분값</th>
							<td>
								<div id="select_box">
									<label for="sel">- 전체 -</label>
									<select id="sel" name="v_code">
										<option value="">- 전체 -</option>
										<option value="intro" <? if($v_code == "intro"){ echo "selected"; } ?> >- 인사말 -</option>
									</select>
								</div>
							</td>
							<th>성별</th>
							<td>
								전체 <input type="radio" id="v_sex" name="v_sex" value="A" <? if($v_sex == "A"){ echo "checked"; } ?> >&nbsp;&nbsp;
								남성 <input type="radio" id="v_sex" name="v_sex" value="M" <? if($v_sex == "M"){ echo "checked"; } ?> >&nbsp;&nbsp;
								여성 <input type="radio" id="v_sex" name="v_sex" value="F" <? if($v_sex == "F"){ echo "checked"; } ?> >
							</td>
							<th>사용여부</th>
							<td>
								전체 <input type="radio" id="v_use_yn" name="v_use_yn" value="A" <? if($v_use_yn == "A"){ echo "checked"; } ?> >&nbsp;&nbsp;
								사용 <input type="radio" id="v_use_yn" name="v_use_yn" value="Y" <? if($v_use_yn == "Y"){ echo "checked"; } ?> >&nbsp;&nbsp;
								안함 <input type="radio" id="v_use_yn" name="v_use_yn" value="N" <? if($v_use_yn == "N"){ echo "checked"; } ?> >
							</td>
						</tr>
						<tr>
							<td colspan="8"><input type="button" id="btn_search" name="btn_search" value="검색" class="btn btn-success"></td>
						</tr>
					</table>
				</div>

			</div>
		</div>

		<div id="panel-2" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>인사말 리스트</strong> <!-- panel title -->
				</span>
				
				<span style="padding-left:20px;"><input type="button" id="btn_sel_del" name="btn_sel_del" value="선택삭제" class="btn btn-danger" style="width:100px; height:30px;"></span>
				<span style="padding-left:20px;">
					<a class="btn btn-info lightbox" href="/admin/admin_setting/intro_layer/<?=mt_rand(0, 999999)?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}' style="width:100px; height:30px; line-height:20px;">
					<b>신규등록</b>
					</a>
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
							<th class="width-50"><input type="checkbox" id="all_chk" name="all_chk" value=""></th>
							<th class="width-100">순번</th>
							<th class="width-150">구분값</th>
							<th class="width-100">성별</th>
							<th>내용</th>
							<th class="width-100">사용횟수</th>
							<th class="width-150">마지막사용일</th>
							<th class="width-100">사용여부</th>
							<th class="width-100">삭제</th>
						</tr>
						</thead>
						<tbody>
						<?
							if($getTotalData > 0){
								$i=($getTotalData+19)-(($page-1)*$rp);
								foreach($list as $data){
						?>
						<tr>
							<td class="text-center"><input type="checkbox" id="intro_chk" name="intro_chk" value="<?=$data['V_IDX']?>"></td>
							<td class="text-center"><?=$i?></td>
							<td class="text-center"><?=call_intro_code_change('code', $data['V_CODE'])?></td>
							<td class="text-center"><?=call_intro_code_change('sex', $data['V_SEX'])?></td>
							<td>
								<a class="lightbox" href="/admin/admin_setting/intro_layer/idx/<?=$data['V_IDX']?>/<?=mt_rand(0, 999999)?>" data-lightbox="iframe" data-plugin-options='{"type":"ajax", "closeOnContentClick":false}'>
								<?=$data['V_TEXT']?>
								</a>
							</td>
							<td class="text-center"><?=$data['use_cnt']?></td>
							<td class="text-center"><?=$data['last_use_date']?></td>
							<td class="text-center"><?=call_intro_code_change('use', $data['V_USE_YN'])?></td>
							<td class="text-center">
								<input type="button" id="btn_del" name="btn_del" value="삭제" class="btn btn-danger" style="width:80px; height:30px;" onclick="javascript:intro_list_del('<?=$data['V_IDX']?>');">
							</td>
						</tr>
						<?
								$i--;
								}
							}else{
						?>
						<tr>
							<td colspan="9" class="text-center"><b>결과가 없습니다.</b></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					<div class="padding-top-20">
						<div class="col-md-2"><strong>Total :</strong><span class="text-danger">&nbsp; <?=number_format(@$getTotalData)?> &nbsp;</span>개</div>
						<div class="col-md-12 text-center"><?=@$pagination_links?></div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>



				</div>

			</section>
			<!-- /MIDDLE -->
