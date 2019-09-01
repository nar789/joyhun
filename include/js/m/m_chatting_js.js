$(document).ready(function(e) {



	//alert('ddd');
	var objDiv = document.getElementById("chat_area");
	objDiv.scrollTop = objDiv.scrollHeight;

	

	if( navigator.userAgent.indexOf('Firefox') >= 0 ) {		/*  파폭용 */
		var eventNames ="keydown"; 
			
		window.addEventListener( eventNames, function(e) {
			window.event = e;
		}, true );
	}




	$("#chat_submit").click(function(){

		chat_text = $("#chat_text").val();

		if (chat_text == "") {

				return false;

		} else {

			var chat_add_table = "";

			chat_add_table += "<div class='div_common'>";
			chat_add_table += "<table class='float_right'>";
			chat_add_table += "<tr><td class='clock_td text-right padding_right_7'>";
			chat_add_table += "<p class='read_cnt'> 1 </p>";
			chat_add_table += "오전 10:18";
			chat_add_table += "</td>";
			chat_add_table += "<td><div class='send_chat'>";
			chat_add_table += chat_text;
			chat_add_table += "<div class='send_arrow'></div>";
			chat_add_table += "</td></tr></table>";
			chat_add_table += "<div class='clear'></div></div>";
			chat_add_table += "<div id='add_chat'></div>";

			document.getElementById("add_chat").innerHTML += chat_add_table;

			$('#chat_text').val("");

			objDiv.scrollTop = objDiv.scrollHeight;
		}

	});
		
});


function chkEnter() {

	if (event.which || event.keyCode) {

		if ((event.which == 13) || (event.keyCode == 13)) {

			chat_text = $("#chat_text").val();

				document.getElementById("chat_submit").click();	
		}
	}
	else {       
		return true;
	}
}