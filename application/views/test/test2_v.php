
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

	<?if(@$add_css){foreach($add_css as $css_name){?>
		<!-- <link href="<?php echo CSS_DIR?>/<?=$css_name?>.css?<?=NOW?>" rel="stylesheet" />-->
	<?}}?>

	<?if(@$add_js){foreach($add_js as $js_name){?>
		<!-- <script src="<?php echo JS_DIR?>/<?=$js_name?>.js?<?=NOW?>"></script>-->
	<?}}?>


<h1>글쓰기</h1>

<!--  
 
time, userid, title, intro
 

<?

	$tmp = array("1","2","3");
//var_dump($tmp);
//echo "<br><br>";
	$tmp2 = array("bb"=>"a","2"=>"b","3"=>"c");
//var_dump($tmp2);

//echo $tmp2["bb"];

foreach($tmp2 as $val){
	echo $val."<br>";
}


?>
-->
<form method="post" action="/test/test1/test_post" name="frm" >
 
	<table id="jointable">
		<tr>
			<th>날짜</th>
			<td><input type="text" name="time" id="time" size="12" maxlength="12" /></td>
		</tr>
		<tr>
			<th>아이디</th>
			<td>
			<input type="text" name="id" id="id"size="12" maxlength="12" />
			<input type="button" value="중복확인" class="pointer" id="id_check">
			</td>
		</tr>
		<tr>
			<th>제목</th>
			<td><input type="text" name="title" id="title" size="12" maxlength="12" /></td>
		</tr>
		<tr>
			<th>내용</th>
			<td>
				<textarea id="intro" name="intro" style="width:300px; height:100px;"></textarea>
			</td>
		</tr>
		<tr>
		   
			<td colspan="2" style="text-align:center; padding-top:10px;">
				<input type="submit" id="btn_join" value="작성">
			</td>
		</tr>
	</table>
</form>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>	
	$(function() {
		$( "#time" ).datepicker({
			changeMonth: true, 
			dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
			dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], 
			monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dateFormat: "yy-mm-dd"
		});
	});
	
    $(document).ready(function() {

		var chke_cnt= 0;

		var id_check_confirm = false;

		$("#id_check").click(function(){
			
			if ($("#id").val() =="") {
				alert( "아이디를 입력하세요")
				$("#id").focus();
				return false;
			}else{
		
				var chek_id = $("#id").val();

				$.get('/test/test1/id_check/userid/'+chek_id+'/'+Math.random(), function(data){
					if(data > 0   ){
						id_check_confirm = true;
						alert("아이디가 있습니다.");
					}else{
						id_check_confirm = false;
						alert("아이디가 없습니다.");
						return false; 
					} 
					

				});
			}

		});
 
		$("#btn_join").click(function() {
		   
			if ($("#time").val() == "") {
				alert("날짜를 꼭 입력하세요!");
				$("#time").focus();
				return false;
			} else if ($("#id").val() == "") {
				alert("아이디를 꼭 입력하세요!");
				$("#id").focus();
				return false;
			} else if ($("#title").val() == "") {
				alert("제목을 꼭 입력하세요!");
				$("#title").focus();
				return false;
			} else if ($("#intro").val() == "") {
				alert("내용을 꼭 입력하세요!");
				$("#intro").focus();
				return false;
			} else if (id_check_confirm == false) {
				alert( "아이디를 확인 해주세요")
				$("#id").focus();
				return false;
			} else {
				alert("글쓰기 완료");
				 return true;
			}
		});
	});


</script>