var tmpvalue_url = document.location.hostname;
if(	tmpvalue_url.indexOf("com") >= 0){
	var cookieDomain=".joyhunting.com";
}else{
	var cookieDomain=".joyhunting.co.kr";
}

//var cookieDomain2=document.location.hostname;

//////////////////////////////////////////////////////////////
/////                 쿠키값 설정 함수			         /////
///// 사용법 : JoyHunting_setCookie(1단쿠키,2단쿠키,쿠키값)    /////
///// 예제   : JoyHunting_setCookie(info,id,'chance');       /////
////////////////////////////////////////////////////////////// 
function JoyHunting_setCookie(part0, part1, newValue){
  newValue = escape(newValue);
  var aCookie = document.cookie.split('; ');
  if(part1 && part1 != ''){
	var isFound = false;
	// 2단 쿠키
	var newCookie = part0 + '=';
	for (var i=0; i < aCookie.length; i++){
		if(aCookie[i].substring(0, part0.length) == part0){
			var value = aCookie[i].substring(part0.length+1).split('&');
			for(var j=0; j < value.length; j++){
				if(j > 0) 
					newCookie = newCookie + '&';
				if(value[j].substring(0, part1.length) == part1){
					isFound = true;
					newCookie = newCookie + part1 + '=' + newValue;
				} else {
					newCookie = newCookie + value[j];
				}
			}
		}
	}
	if(! isFound && newCookie != (part0 + '='))
		newCookie = newCookie + '&';
		
	if(! isFound)
		newCookie = newCookie + part1 + '=' + newValue;
		
  } else {
	// 1단 쿠키
	var newCookie = part0 + '=' + newValue;
  }

  document.cookie = newCookie + '; domain='+cookieDomain+'; path=/;';
//  document.cookie = newCookie + '; path=/;';		// js와 asp가 제대로 호환이 안될경우 사용. 이 부분으로 사용할 경우, global.asa에서도 domain 주석처리 해야함
}



//////////////////////////////////////////////////////////////
/////                 쿠키값 반환 함수                   /////
///// 사용법 : JoyHunting_getCookie(1단쿠키,2단쿠키)           /////
///// 예제   : var uid=JoyHunting_getCookie(info,id);          /////
//////////////////////////////////////////////////////////////  
function JoyHunting_getCookie(part0, part1){
  var aCookie = document.cookie.split('; ');
  for (var i=0; i < aCookie.length; i++){
	if(part1 && part1 != ''){
		// 2단 쿠키
		if(aCookie[i].substring(0, part0.length) == part0){
			var value = aCookie[i].substring(part0.length+1).split('&');
			for(var j=0; j < value.length; j++){
				if(value[j].substring(0, part1.length) == part1){
					return unescape(value[j].substring(part1.length+1));
				}
			}
		}
	} else {
		// 1단 쿠키
		if(aCookie[i].substring(0, part0.length) == part0)
			return unescape(aCookie[i].substring(part0.length+1));
		
	}
  }

  return null;
}
