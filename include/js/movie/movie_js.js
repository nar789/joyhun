

//결혼신청 레이어팝업 띄우기
function movie_request(idx){
	$.get('/movie/main/movie_request_popup/idx/'+idx+'/'+Math.random(), function(data){
		modal.open({content: data,width : 460});
	});
}