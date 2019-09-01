function getDate() { 
var date = new Date();
var timer = document.getElementById('timeview').innerHTML = status;
status = "현재시간은"+date.getFullYear()+"년 "
+(date.getMonth()+1)+"월 "
+date.getDate()+"일 "
+date.getHours()+"시"
+date.getMinutes()+"분"
+date.getSeconds()+"초 입니다.";

}

//today = new Date() //첫 화면에보이는 시간
//document.write(today.toLocaleString())


function startTime(){ //흐르는 시간

   TID = setInterval("getDate()", 1000);
    
}

function stopTime(){ //일시정지

   clearInterval(TID);
}

function realtimeClock() {
  document.frm1.demo.value = dateMinus(0);
 
}
function thedayBefore() {
  document.frm1.demo.value = dateMinus(1);
}

function hours_second() {
  document.frm1.demo.value = hours_second_process(1);
}

function dateMinus(days)
{
    var nday = new Date();  //오늘 날짜..  
	nday.setDate(nday.getDate() - days);//오늘 날짜에서 days만큼을 뒤로 이동 
    var yy = nday.getFullYear(); // 년
    var mm = nday.getMonth()+1; // 월
    var dd = nday.getDate(); // 일
	var ss = nday.getHours(); // 시
	var jj = nday.getMinutes(); // 분
	var cc = nday.getSeconds(); // 초 

    if( mm<10) mm="0"+mm;
    if( dd<10) dd="0"+dd;
	if( ss<10) ss="0"+ss;
    if( jj<10) jj="0"+jj;
	if( cc<10) cc="0"+cc;

    return yy + "-" + mm + "-" + 
			dd + " " + ss + ":" + jj + ":" + cc;
}

function hours_second_process(days)
{
    var nnday = new Date();  //오늘 날짜..  
	nnday.setHours(nnday.getHours() - days);//오늘 날짜에서 시간만큼을 뒤로 이동 
    var yyy = nnday.getFullYear(); // 년
    var mmm = nnday.getMonth()+1; // 월
    var ddd = nnday.getDate(); // 일
	var sss = nnday.getHours(); // 시
	var jjj = nnday.getMinutes(); // 분
	var ccc = nnday.getSeconds(); // 초 

    if( mmm<10) mmm="0"+mmm;
    if( ddd<10) ddd="0"+ddd;
	if( sss<10) sss="0"+sss;
    if( jjj<10) jjj="0"+jjj;
	if( ccc<10) ccc="0"+ccc;

    return yyy + "-" + mmm + "-" + 
			ddd + " " + sss + ":" + jjj + ":" + ccc;
}

function myFunction_none() {
    document.getElementById("start").style.display="none";
	document.getElementById("stop").style.display="block";
}

function myFunction_block() {
    document.getElementById("stop").style.display="none";
	document.getElementById("start").style.display="block";
}

function korean() 
{ 
	var name = document.frm1.name.vlaue;
	if((event.keyCode < 12592) || (event.keyCode > 12687)) 
  {
     event.returnValue = false ;
  }
} 
function check()
{
 var form = document.frm1;
 var box = form.name_text;
 var str = box.value;
 for(i=0; i<str.length; i++)
 {
  if(!((str.charCodeAt(i) > 0x3130 && str.charCodeAt(i) < 0x318F) || (str.charCodeAt(i) >= 0xAC00 && str.charCodeAt(i) <= 0xD7A3)))
  {
   alert("반드시 한글만 입력하세요");
   box.value = "";
   return false;
  }
  else; // 처리
 }
}


//10자 이상의내용 체크 
function calBytes(str)
{
  var tcount = 0;
  var tmpStr = new String(str);
  var temp = tmpStr.length;
  var onechar;
  for ( k=0; k<temp; k++ )
  {
    onechar = tmpStr.charAt(k);
    if (escape(onechar).length > 2)
    {
      tcount += 2;
    }
    else
    {
      tcount += 1;
    }
  }
  return tcount;
}

function check() {
	
  if(frm1.time.value == "") {
    alert("시간을 입력해 주십시오.");
    frm1.time.focus();
    return false;
  }
  else if(frm1.name_text.value == "") {
    alert("이름을 입력해 주십시오.");
	frm1.name_text.focus();
    return false;
  }
  else if(calBytes(frm1.mem_text.value)<10){
    alert("10자 이상의 내용을 입력해 주십시오.");
    frm1.mem_text.focus();
    return false;
  }
  else return true;
}

