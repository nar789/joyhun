
var avata_host = "http://joyhunting.com";
var pathSmallHead = avata_host + '/images/music_chat/character/mini/';
var layerCount = 56;
var othersex;
var otherChar;
var sex = JoyHunting_getCookie('JoyHunting','mysex');
var mytempsex = JoyHunting_getCookie('JoyHunting','mytempsex');

var Expression = new Array();
	Expression[0] = '보통';
	Expression[1] = '웃음';
	Expression[2] = '울음';
	Expression[3] = '화남';
	Expression[4] = '황당';
	Expression[5] = '반함';


var DefaultAvata = new Array();
if (sex=='M'){
	DefaultAvata[0] = '1510001';
	DefaultAvata[1] = '1010001_0';
	DefaultAvata[2] = '1310001';
	DefaultAvata[3] = '0910001';
	
	otherChar = "1520001,1020001_0,1320001,0920001";
}else{
	DefaultAvata[0] = '1520001';
	DefaultAvata[1] = '1020001_0';
	DefaultAvata[2] = '1320001';
	DefaultAvata[3] = '0920001';

	otherChar = "1510001,1010001_0,1310001,0910001";
}

	if (mytempsex=='M'){
		DefaultAvata[0] = '1510001';
		DefaultAvata[1] = '1010001_0';
		DefaultAvata[2] = '1310001';
		DefaultAvata[3] = '0910001';
	
		otherChar = "1520001,1020001_0,1320001,0920001";
	}else if (mytempsex=='F'){
		DefaultAvata[0] = '1520001';
		DefaultAvata[1] = '1020001_0';
		DefaultAvata[2] = '1320001';
		DefaultAvata[3] = '0920001';

		otherChar = "1510001,1010001_0,1310001,0910001";
	}


if (!JoyHunting_getCookie('JoyHunting','shopchar'))	JoyHunting_setCookie('JoyHunting','shopchar',JoyHunting_getCookie('JoyHunting','mychar'));

var myexpression = getExpression(JoyHunting_getCookie('JoyHunting','shopchar'));
//var shopchar = JoyHunting_getCookie('JoyHunting','shopchar');


function DisplayAvata(){
	showAvata(JoyHunting_getCookie('JoyHunting','shopchar'),'','','');
}


function getExpression(tmpChar){
	var tmpExpr = 0;
	var aChar = tmpChar.split(',');
	var layerno;

	aChar.sort();
	for(var i=0;i<=aChar.length-1;i++){
		layerno = parseInt(aChar[i].substr(0,2),10);
		if(layerno==10||layerno==33){
			tmpExpr = aChar[i].substr(8);
			break;
		}
	}
	return (tmpExpr)
}


function getAvataCode(mychar,expr){
	if(!expr || expr=='') expr = getExpression(mychar);
	var aChar = mychar.split(',');
	var isDeleteTotal	= false;
	var isDeleteBody	= false;
	var isDeleteHair	= false;
	var isDeleteRing	= false;
	var isDeleteCap		= false;
	var newChar = '';
	var layerNo;

	for(var i=0;i<=aChar.length-1;i++){
		layerNo = aChar[i].substr(0,2);
		if(layerNo == '33') isDeleteTotal = true;
		if(layerNo == '14') isDeleteBody = true;
		if(layerNo == '16') isDeleteHair = true;
		if(layerNo == '26') isDeleteRing = true;
		if(layerNo == '28') isDeleteCap = true;

		if(layerNo=='10') aChar[i] = aChar[i].substr(0,7) + '_' + expr;
	}

	for(var i=0;i<=aChar.length-1;i++){
		layerNo = aChar[i].substr(0,2);
		if(isDeleteTotal && ( layerNo >= '08' && layerNo < '33' )) aChar[i] = '';
		if(isDeleteBody && ( layerNo == '09' || layerNo == '13' || layerNo == '16' )) aChar[i] = '';
		if(isDeleteHair && ( layerNo == '08' || layerNo == '09' || layerNo == '13' || layerNo == '14' || layerNo == '15' )) aChar[i] = '';
		if(isDeleteRing && ( layerNo == '24' || layerNo == '25' )) aChar[i] = '';
		if(isDeleteCap && ( layerNo >= '20' || layerNo < '24' )) aChar[i] = '';
	}

	for(var i=0;i<=aChar.length-1;i++){
		if(aChar[i]!=''){									
			if(newChar!='') newChar = newChar + ',';
			newChar = newChar + aChar[i];
		}
	}

	return newChar;
}

function getAvataCode_agit(mychar,expr){
	if(!expr || expr=='') expr = getExpression(mychar);
	var aChar = mychar.split(',');
	var isDeleteTotal	= false;
	var isDeleteBody	= false;
	var isDeleteHair	= false;
	var isDeleteRing	= false;
	var isDeleteCap		= false;
	var newChar = '';
	var layerNo;

	for(var i=0;i<=aChar.length-1;i++){
		layerNo = aChar[i].substr(0,2);
		//if(layerNo == '33') isDeleteTotal = true;
		if(layerNo == '14' ||  layerNo == '05' ) isDeleteBody = true;
		if(layerNo == '16') isDeleteHair = true;
		if(layerNo == '26') isDeleteRing = true;
		if(layerNo == '28') isDeleteCap = true;

		if(layerNo=='10') aChar[i] = aChar[i].substr(0,7) + '_' + expr;
	}

	for(var i=0;i<=aChar.length-1;i++){
		layerNo = aChar[i].substr(0,2);
		if(isDeleteTotal && ( layerNo >= '08' && layerNo < '34' )) aChar[i] = '';
		if(isDeleteBody && ( layerNo == '09' || layerNo == '13' || layerNo == '16'  ||  layerNo == '05' )) aChar[i] = '';
		if(isDeleteHair && ( layerNo == '08' || layerNo == '09' || layerNo == '13' || layerNo == '14' || layerNo == '15' )) aChar[i] = '';
		if(isDeleteRing && ( layerNo == '24' || layerNo == '25' )) aChar[i] = '';
		if(isDeleteCap && ( layerNo >= '20' || layerNo < '24' )) aChar[i] = '';
	}

	for(var i=0;i<=aChar.length-1;i++){
		if(aChar[i]!=''){									
			if(newChar!='') newChar = newChar + ',';
				layerNo = aChar[i].substr(0,2);
					if(layerNo < '34') newChar = newChar + aChar[i];
		}
	}

	return newChar;
}

function showAvata_agit(avata_code, whereDiv, word, ck){

	if(! whereDiv ) whereDiv = 'avata';

	var no,filename,file;
	var aChar = getAvataCode_agit(avata_code).split(',')
	var blankImg = avata_host + '/blank_new.gif';
	var idx = aChar.length-1;
	var layerno;

	aChar.sort();

	for(var i=layerCount;i>=1;i--){
			if( idx>=0 && parseInt(aChar[idx].substr(0,2),10) == i )
			{
				if( (parseInt(aChar[idx].substr(0,2),10) >= 5)  ){
					
					//alert("11ff"+aChar[idx].substr(0,2));
					
					layerno = parseInt(aChar[idx].substr(0,2),10);				
					filename = avata_host + '/mini_layers/' + aChar[idx].substr(0,2) + '/' + aChar[idx] + '.gif';
					file = '<img id="'+whereDiv+layerno+'"src="'+filename+'" style="position:absolute;z-index:'+layerno+'" >';

					if( ! document.all[whereDiv+layerno] ) document.all[whereDiv].insertAdjacentHTML('beforeEnd',file);
					document.all[whereDiv+layerno].src = filename;

					idx--;
				}
			}else{
			
				if( document.all[whereDiv+i] ) document.all[whereDiv+i].src = blankImg;
			}		
	}

	if(!document.all[whereDiv+'blank']) document.all[whereDiv].insertAdjacentHTML('beforeEnd','<img id="'+whereDiv+'blank" src="'+blankImg+'" style="position:absolute;z-index:99"  onmouseover="this.style.border=\'1 groove black\';this.style.pixelTop=this.style.pixelTop-1;this.style.pixelLeft=this.style.pixelLeft-1;" onmouseout="this.style.border=0;this.style.pixelTop=this.style.pixelTop+1;this.style.pixelLeft=this.style.pixelLeft+1;">');
}

function showAvata_agit_none(avata_code, whereDiv, word, ck){

	if(! whereDiv ) whereDiv = 'avata';

	var no,filename,file;
	var aChar = getAvataCode_agit(avata_code).split(',')
	var blankImg = avata_host + '/blank_new.gif';
	var idx = aChar.length-1;
	var layerno;

	aChar.sort();

	for(var i=layerCount;i>=1;i--){
			if( idx>=0 && parseInt(aChar[idx].substr(0,2),10) == i )
			{
				if( (parseInt(aChar[idx].substr(0,2),10) >= 5)  ){
					
					//alert("11ff"+aChar[idx].substr(0,2));
					
					layerno = parseInt(aChar[idx].substr(0,2),10);				
					filename = avata_host + '/mini_layers/' + aChar[idx].substr(0,2) + '/' + aChar[idx] + '.gif';
					file = '<img id="'+whereDiv+layerno+'"src="'+filename+'" style="position:absolute;z-index:'+layerno+'" >';
										
					//if(JoyHunting_getCookie('JoyHunting','myid')=='')
					//{
					//	alert(filename);
					//}
					
					if( ! document.all[whereDiv+layerno] ) document.all[whereDiv].insertAdjacentHTML('beforeEnd',file);
					document.all[whereDiv+layerno].src = filename;

					idx--;
				}
			}else{
			
				if( document.all[whereDiv+i] ) document.all[whereDiv+i].src = blankImg;
			}		
	}

	if(!document.all[whereDiv+'blank']) document.all[whereDiv].insertAdjacentHTML('beforeEnd','<img id="'+whereDiv+'blank" src="'+blankImg+'" style="position:absolute;z-index:99" >');
}

function showAvata(avata_code, whereDiv, word, ck){

	if(! whereDiv ) whereDiv = 'avata';

	var no,filename,file;
	var aChar = getAvataCode(avata_code).split(',')
	var blankImg = avata_host + '/blank.gif';
	var idx = aChar.length-1;
	var layerno;

	aChar.sort();

	for(var i=layerCount;i>=1;i--){
		if( idx>=0 && parseInt(aChar[idx].substr(0,2),10) == i ){
			layerno = parseInt(aChar[idx].substr(0,2),10);				
			filename = avata_host + '/layers/' + aChar[idx].substr(0,2) + '/' + aChar[idx] + '.gif';
			file = '<img id="'+whereDiv+layerno+'"src="'+filename+'" border="0" style="position:absolute;z-index:'+layerno+'">';

			if( ! document.all[whereDiv+layerno] ) document.all[whereDiv].insertAdjacentHTML('beforeEnd',file);
			document.all[whereDiv+layerno].src = filename;

			idx--;
		}else{
			if( document.all[whereDiv+i] ) document.all[whereDiv+i].src = blankImg;
		}
	}

	if(!document.all[whereDiv+'blank']) document.all[whereDiv].insertAdjacentHTML('beforeEnd','<img id="'+whereDiv+'blank" border="0" src="'+blankImg+'" style="position:absolute;z-index:99">');
}



function Put_Wears(mychar, wearObj){

	var layerno, idx;
	var expr, sex;
	var aChar = mychar.split(',');
	var hasTop = true;
	var hasFace = true;
	var hasBottom = true;
	var hasHair = true;

	var sex = wearObj.item_code.substr(2,1);

	for(var i=0; i<aChar.length; i++){
		layerno = parseInt(aChar[i].substr(0,2),10);
		if( layerno == 10 || layerno == 33){
			sex = aChar[i].substr(2,1);
			expr = aChar[i].substr(8,1);
		}
	}
	
	if( wearObj.item_sex != '0' && wearObj.item_sex != sex ){
		return -1;
	}

	if( mychar.indexOf(wearObj.item_code) >= 0 ){
		return -2;
	}

	if( wearObj.item_type == '33'){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( layerno >= 8 && layerno < 33 ){
				aChar[i] = '';
			}
		}
	}

	if( wearObj.item_type == '16'){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( layerno == 8 || layerno == 9 || layerno == 13 || layerno == 14 || layerno == 15 || layerno == 33 ) aChar[i] = '';
			
			if( layerno == 33 )  hasFace = false;
		}
	}

	if( wearObj.item_type == '14'){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( layerno == 9 || layerno == 13 || layerno == 16 || layerno == 33 ) aChar[i] = '';

			if( layerno == 16 ) hasHair = false;
			if( layerno == 33 ){
				hasFace = false;
				hasHair = false;
			}
		}

	}

	if( wearObj.item_type == '09' || wearObj.item_type == '13'){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( wearObj.item_type == '09' && layerno == 14 ){
				aChar[i] = '';
				hasTop = false;
			}else if( wearObj.item_type == '13' && layerno == 14 ){
				aChar[i] = '';
				hasBottom = false;
			}else if( wearObj.item_type == '09' && layerno == 16 ){
				aChar[i] = '';
				hasHair = false;
				hasTop = false;
			}else if( wearObj.item_type == '13' && layerno == 16 ){
				aChar[i] = '';
				hasHair = false;
				hasBottom = false;
			}else if( wearObj.item_type == '09' && layerno == 33 ){
				aChar[i] = '';
				hasHair = false;
				hasFace = false;
				hasTop = false;
			}else if( wearObj.item_type == '13' && layerno == 33 ){
				aChar[i] = '';
				hasHair = false;
				hasFace = false;
				hasBottom = false;
			}
		}
	}

	if( wearObj.item_type == '15'){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( layerno == 8 ){
				aChar[i] = '';
			}else if( layerno == 16 ){
				aChar[i] = '';
				hasTop = false;
				hasBottom = false;
			}else if( layerno == 33 ){
				aChar[i] = '';
				hasFace = false;
				hasTop = false;
				hasBottom = false;
			}
		}
	}

	tmplayrno = parseInt(wearObj.item_type,10);
	if( tmplayrno > 9 && tmplayrno < 33 && tmplayrno !=13 && tmplayrno !=14 && tmplayrno !=15 && tmplayrno !=16 ){
		for(var i=0; i<aChar.length; i++){
			layerno = parseInt(aChar[i].substr(0,2),10);
			if( tmplayrno==9 && (layerno == 14 || layerno == 16 || layerno == 33) ){
				aChar[i] = '';
				hasTop = false;
			}

			if( tmplayrno == 13 && (layerno == 14 || layerno == 16 || layerno == 33) ){
				aChar[i] = '';
				hasBottom = false;
			}

			if( layerno == 33 ){
				aChar[i] = '';
				hasFace = false;
				hasHair = false;
				hasTop = false;
				hasBottom = false;
			}
		}
	}


	if( ! hasHair ){
		idx = aChar.length;
		aChar[idx] = DefaultAvata[0]
	}
	if( ! hasFace ){
		idx = aChar.length;
		aChar[idx] = DefaultAvata[1]
	}
	if( ! hasTop ){
		idx = aChar.length;
		aChar[idx] = DefaultAvata[2]
	}
	if( ! hasBottom ){
		idx = aChar.length;
		aChar[idx] = DefaultAvata[3]
	}

	for(var i=0; i<aChar.length; i++){
		if(wearObj.item_code.substr(0,2) == aChar[i].substr(0,2)) aChar[i] = '';
		if(wearObj.base_code1.substr(0,2) == aChar[i].substr(0,2)) aChar[i] = '';
		if(wearObj.base_code2.substr(0,2) == aChar[i].substr(0,2)) aChar[i] = '';
		if(wearObj.base_code3.substr(0,2) == aChar[i].substr(0,2)) aChar[i] = '';
		if(wearObj.base_code1_2.substr(0,2) == aChar[i].substr(0,2)) aChar[i] = '';
	}

	if( wearObj.item_code != '' ) {
		idx = aChar.length;
		aChar[idx] = wearObj.item_code;
	}

	if( wearObj.base_code1 != '' ) {
		idx = aChar.length;
		aChar[idx] = wearObj.base_code1;
	}
	if( wearObj.base_code2 != '' ) {
		idx = aChar.length;
		aChar[idx] = wearObj.base_code2;
	}
	if( wearObj.base_code3 != '' ) {
		idx = aChar.length;
		aChar[idx] = wearObj.base_code3;
	}
	if( wearObj.base_code1_2 != '' ) {
		idx = aChar.length;
		aChar[idx] = wearObj.base_code1_2;
	}

	aChar.sort();
	var new_mychar = '';
	for(var i=0; i<aChar.length; i++){
		if( aChar[i] != ''){
			if(new_mychar != '') new_mychar = new_mychar + ',';
			new_mychar = new_mychar + aChar[i];
		}
	}

	return new_mychar;
}


function TakeOffWears(mychar, wearObj){
	var layerno, idx;
	var expr, sex;
	var aChar = mychar.split(',');
	var sex = wearObj.item_code.substr(2,1);
	var hasTop = true;
	var hasFace = true;
	var hasBottom = true;
	var hasHair = true;

	for(var i=0; i<aChar.length; i++){
		layerno = parseInt(aChar[i].substr(0,2),10);
		if( layerno == 10 ){
			sex = aChar[i].substr(2,1);
			expr = aChar[i].substr(8,1);
		}
	}

	if( wearObj.item_sex != '0' && wearObj.item_sex != sex ){
		return mychar;
	}

	if( mychar.indexOf(wearObj.item_code) >= 0 ){
		if( wearObj.item_type == '15' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 8 || layerno == 15 ){
					aChar[i] = '';
					hasHair = false;
				}
			}
		} else if( wearObj.item_type == '13' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 13 ){
					aChar[i] = '';
					hasTop = false;
				}
			}
		} else if( wearObj.item_type == '09' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 9 ){
					aChar[i] = '';
					hasBottom = false;
				}
			}
		} else if( wearObj.item_type == '14' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 14 ){
					aChar[i] = '';
					hasTop = false;
					hasBottom = false;
				}
			}
		} else if( wearObj.item_type == '16' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 16 ){
					aChar[i] = '';
					hasHair = false;
					hasTop = false;
					hasBottom = false;
				}
			}
		} else if( wearObj.item_type == '33' ){
			for(var i=0; i<aChar.length; i++){
				layerno = parseInt(aChar[i].substr(0,2),10);
				if( layerno == 33 ){
					aChar[i] = '';
					hasHair = false;
					hasFace = false;
					hasTop = false;
					hasBottom = false;
				}
			}
		} else {
			for(var i=0; i<aChar.length; i++){
				if( aChar[i] == wearObj.item_code || aChar[i] == wearObj.base_code1 || aChar[i] == wearObj.base_code2 || aChar[i] == wearObj.base_code3 || aChar[i] == wearObj.base_code1_2 ){
					aChar[i] = '';
				}
			}
		}

		if( ! hasHair ){
			idx = aChar.length;
			aChar[idx] = DefaultAvata[0]
		}
		if( ! hasFace ){
			idx = aChar.length;
			aChar[idx] = DefaultAvata[1]
		}
		if( ! hasTop ){
			idx = aChar.length;
			aChar[idx] = DefaultAvata[2]
		}
		if( ! hasBottom ){
			idx = aChar.length;
			aChar[idx] = DefaultAvata[3]
		}

	}

	aChar.sort();
	var new_mychar = '';
	for(var i=0; i<aChar.length; i++){
		if( aChar[i] != ''){
			if(new_mychar != '') new_mychar = new_mychar + ',';
			new_mychar = new_mychar + aChar[i];
		}
	}
	
	return new_mychar;
}

function NewWindow(myPage,myName,xWidth,xHeight,xScroll,xPos,xResize, xReturn){
  var xLeftPosition,xTopPosition;
  var xSettings;
  var win=null; 
  var xResizable;

  if(!xResize) xResizable = 'no';
  else xResizable = xResize;

  if(xPos=="random"){
    xLeftPosition = (screen.width)?Math.floor(Math.random()*((screen.width-xWidth)-75)):100;
    xTopPosition = (screen.height)?Math.floor(Math.random()*((screen.height-xHeight)-75)):100;
  }else if(xPos=="center"){
    xLeftPosition = (screen.width)?(screen.width-xWidth)/2:100;
    xTopPosition = (screen.height)?(screen.height-xHeight)/2:100;
  }else{
    xLeftPosition = 0;
    xTopPosition = 20;
  }

  if(xResizable=='no')	xSettings = 'height='+xHeight+',width='+xWidth+',top='+xTopPosition+',left='+xLeftPosition+',scrollbars='+xScroll;
  else					xSettings = 'height='+xHeight+',width='+xWidth+',top='+xTopPosition+',left='+xLeftPosition+',scrollbars='+xScroll+',resizable';

  win = window.open(myPage,myName,xSettings);
  win.focus();

  if(xReturn==null || xReturn == true)
	return win;
} 

function executeHidden (strURL){
  var oIFRAME = document.createElement("<IFRAME style='display:none'></IFRAME>");
  document.body.appendChild(oIFRAME);
  oIFRAME.src = strURL;
}

function executeHidden2 (strURL){
  hiddenIFrame.location.href = strURL;
}


function buy_item_total(){ 
	JoyHunting_setCookie('JoyHunting','buycodetotal',JoyHunting_getCookie('JoyHunting','shopchar')); 
	NewWindow('pop_buy_total.asp?reload=1','pop_buy_total',335,405,'no','center','yes'); 
}

//////////////////////////////
// 거지아바타Show
/////////////////////////////

function defaultAvataShow(aCode,uid)  //내아바타가 아닐경우 반드시 uid에 아이디 load!
{
	var avataCode = aCode;
	var avataUid = uid;
	var avataMyid = JoyHunting_getCookie('JoyHunting','myid');

	if (avataCode==''||avataCode==null)
	{
		var mychar = JoyHunting_getCookie('JoyHunting','mychar');
		var exMychar = mychar + ',5600012';
	}
	else
	{
		var mychar = avataCode;
		var exMychar = mychar + ',5600012';
	}
											
	if (mychar=='1510001,1010001_0,1310001,0910001'||mychar=='1520001,1020001_0,1320001,0920001'||mychar=='1510001,1010001_1,1310001,0910001'||mychar=='1520001,1020001_1,1320001,0920001'||mychar=='1510001,1010001_2,1310001,0910001'||mychar=='1520001,1020001_2,1320001,0920001'||mychar=='1510001,1010001_3,1310001,0910001'||mychar=='1520001,1020001_3,1320001,0920001'||mychar=='1510001,1010001_4,1310001,0910001'||mychar=='1520001,1020001_4,1320001,0920001'||mychar=='1510001,1010001_5,1310001,0910001'||mychar=='1520001,1020001_5,1320001,0920001') 
	{
		if (mychar=='1510001,1010001_0,1310001,0910001' || mychar=='1510001,1010001_1,1310001,0910001' || mychar=='1510001,1010001_2,1310001,0910001' || mychar=='1510001,1010001_3,1310001,0910001' || mychar=='1510001,1010001_4,1310001,0910001' || mychar=='1510001,1010001_5,1310001,0910001') 
		{
		//남자아바타		
			showAvata(mychar,'','','')

			if (avataUid==avataMyid||avataUid==''||avataUid==null)
			{
				setTimeout("showAvata('3310017_0,5600012','','','')", 1000*5);  //나일경우
				setTimeout("showAvata('3310020_0,5600012','','','')", 1000*12); 
			}
			else
			{
				setTimeout("showAvata('3310018_0,5600012','','','')", 1000*5);	//내가아닐경우
				setTimeout("showAvata('3310019_0,5600012','','','')", 1000*12);
			}

			setTimeout("showAvata('"+exMychar+"','','','')", 1000*18);
			setTimeout("defaultAvataShow('"+mychar+"')", 1000*19)
		}
		else if (mychar=='1520001,1020001_0,1320001,0920001'|| mychar=='1520001,1020001_1,1320001,0920001'|| mychar=='1520001,1020001_2,1320001,0920001'|| mychar=='1520001,1020001_3,1320001,0920001'|| mychar=='1520001,1020001_4,1320001,0920001'|| mychar=='1520001,1020001_5,1320001,0920001') 
		{
		//여자아바타
			showAvata(mychar,'','','')
			
			if (avataUid==avataMyid||avataUid==''||avataUid==null)
			{
				setTimeout("showAvata('3320023_0,5600012','','','')", 1000*5);	//나일경우
				setTimeout("showAvata('3320026_0,5600012','','','')", 1000*12);	
			}
			else
			{
				setTimeout("showAvata('3320024_0,5600012','','','')", 1000*5);	//내가아닐경우
				setTimeout("showAvata('3320025_0,5600012','','','')", 1000*12);	
			}
			setTimeout("showAvata('"+exMychar+"','','','')", 1000*18);
			setTimeout("defaultAvataShow('"+mychar+"')", 1000*19)
		}
		
	}
	else
	{
		showAvata(mychar,'','','')
	}
}
