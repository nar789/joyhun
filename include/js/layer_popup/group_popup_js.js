var counter = 11;	
var newRow = ""; 
$(document).ready(function(){
   
	$('#group_add_btn').on('click', function(){ //추가	  
		
		if ($("tr[name=group_tr]").length == 4)  {
		   alert("그룹등록은 4개까지 가능합니다.");
		   exit; 
		}   	  

		newRow = ('<tr name="group_tr"><td class="padding_0 width_33 text-center"><input type="checkbox" name="chkList" id="group_checkbox' +
			counter + '" class="popup_checkbox"><label for="group_checkbox' +
			counter + '" class="popup_checkbox_label"></label></td><td><input type="text" name="m_gname[]" maxlength="8" class="group_text color_666"/></td></tr>');
		$('table.popup_border_table').append(newRow);			

		counter++;
	});

	$('#group_del_btn').on('click', function(){ //삭제	  

		if( $(":checkbox[name='chkList']:checked").length==0 ){
			alert("삭제할 항목을 하나이상 체크해주세요.");
			return;
		}

		$(":checkbox[name='chkList']:checked").each(function(pi,po){
			//alert(pi.value);
			$(this).parent().parent().remove(); 
		});

	});

});

function group_add()
{
	if(confirm("그룹을 수정하시겠습니까?"))
	{	
//		g_form.submit();
	}	
}

$(document).ready(function(){
	//그룹내용 폼전송
	$('#g_form').ajaxForm({
			beforeSubmit: function (data, frm, opt) {
				if(!confirm("그룹을 수정하시겠습니까?"))
				{
					return false;
				}
			},
			//submit이후의 처리
			success: function(responseText, statusText){
				if(responseText == 'ok'){
					alert("수정되었습니다.");
					modal.close();
					friend_request(user_id);
				}
			},
			//ajax error
			error: function(){
				alert("그룹등록중 오류가 발생하였습니다.");
			}
	});
});