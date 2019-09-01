var tmpvalue_url = document.location.hostname;
if(	tmpvalue_url.indexOf("com") >= 0){
	var cookieDomain=".joyhunting.com";
}else{
	var cookieDomain=".joyhunting.co.kr";
}

//var cookieDomain2=document.location.hostname;

//////////////////////////////////////////////////////////////
/////                 ��Ű�� ���� �Լ�			         /////
///// ���� : JoyHunting_setCookie(1����Ű,2����Ű,��Ű��)    /////
///// ����   : JoyHunting_setCookie(info,id,'chance');       /////
////////////////////////////////////////////////////////////// 
function JoyHunting_setCookie(part0, part1, newValue){
  newValue = escape(newValue);
  var aCookie = document.cookie.split('; ');
  if(part1 && part1 != ''){
	var isFound = false;
	// 2�� ��Ű
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
	// 1�� ��Ű
	var newCookie = part0 + '=' + newValue;
  }

  document.cookie = newCookie + '; domain='+cookieDomain+'; path=/;';
//  document.cookie = newCookie + '; path=/;';		// js�� asp�� ����� ȣȯ�� �ȵɰ�� ���. �� �κ����� ����� ���, global.asa������ domain �ּ�ó�� �ؾ���
}



//////////////////////////////////////////////////////////////
/////                 ��Ű�� ��ȯ �Լ�                   /////
///// ���� : JoyHunting_getCookie(1����Ű,2����Ű)           /////
///// ����   : var uid=JoyHunting_getCookie(info,id);          /////
//////////////////////////////////////////////////////////////  
function JoyHunting_getCookie(part0, part1){
  var aCookie = document.cookie.split('; ');
  for (var i=0; i < aCookie.length; i++){
	if(part1 && part1 != ''){
		// 2�� ��Ű
		if(aCookie[i].substring(0, part0.length) == part0){
			var value = aCookie[i].substring(part0.length+1).split('&');
			for(var j=0; j < value.length; j++){
				if(value[j].substring(0, part1.length) == part1){
					return unescape(value[j].substring(part1.length+1));
				}
			}
		}
	} else {
		// 1�� ��Ű
		if(aCookie[i].substring(0, part0.length) == part0)
			return unescape(aCookie[i].substring(part0.length+1));
		
	}
  }

  return null;
}
