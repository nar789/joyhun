

$(document).ready(function() {
	// 등급있으면 한칸 띄우기
	if ($(".m_intro_text_td > div > b > img").length > 0){
		$(".m_intro_text_td > div > b > img").after('&nbsp;');
	}
});