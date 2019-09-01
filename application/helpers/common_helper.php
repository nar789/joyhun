<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
 *
 * @param	string	대상이 되는 문자열
 * @return	string[]
 */
function segment_explode($seg)
{
	//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
	$len = strlen($seg);
	if(substr($seg, 0, 1) == '/')
	{
		$seg = substr($seg, 1, $len);
	}
	$len = strlen($seg);

	if(substr($seg, -1) == '/')
	{
		$seg = substr($seg, 0, $len-1);
	}
	$seg_exp = explode("/", $seg);

	return $seg_exp;
}

/**
 * url중 키값을 구분하여 값을 가져오도록.
 *
 * @param Array $url : segment_explode 한 url값
 * @param String $key : 가져오려는 값의 key
 * @return String $url[$k] : 리턴값
 */
function url_explode($url, $key)
{
	$cnt = count($url);
	for($i=0; $cnt>$i; $i++ )
	{
		if($url[$i] ==$key)
		{
			$k = $i+1;
			return $url[$k];
		}
	}
}


function pagination($seg_exp, $paging_data, $var_name = "/page", $class_name = "pagination")
{
	$link = implode('/', url_delete($seg_exp, 'page'));

	$links = "<ul class='$class_name'>";

	// The first page

	// The previous page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['prev'], '<img src="'.IMG_DIR.'/paging_arrow.gif">', array('title' => 'Go to the previous page', 'class' => 'prev_page'))."</li>";
	$links .= "\n";

	// The other pages
	for ($i = $paging_data['start']; $i <= $paging_data['end']; $i++)
	{
		if ($i == $paging_data['page'])
			$current = 'class="active"';
		else
			$current = "";

		$links .=  "<li $current>".anchor($link . $var_name.'/' . $i, $i, array('title' => 'Go to page ' . $i, 'class' => 'page'))."</li>";
		$links .= "\n";
	}

	// The next page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['next'], '<img src="'.IMG_DIR.'/paging_arrow.gif" class="paging_right_btn">', array('title' => 'Go to the next page', 'class' => 'next_page'))."</li>";
	$links .= "\n";
	// The last page

	$links .= "</ul>";
	$links .= "\n";

	return $links;
}





function pagination_admin($seg_exp, $paging_data, $var_name = "/page", $class_name = "pagination")
{
	$link = implode('/', url_delete($seg_exp, 'page'));

	$links = "<ul class='$class_name'>";

	// The first page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['first'], 'First', array('title' => 'Go to the first page', 'class' => 'first_page'))."</li>";
	$links .= "\n";
	// The previous page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['prev'], '&laquo;', array('title' => 'Go to the previous page', 'class' => 'prev_page'))."</li>";
	$links .= "\n";

	// The other pages
	for ($i = $paging_data['start']; $i <= $paging_data['end']; $i++)
	{
		if ($i == $paging_data['page'])
			$current = 'class="active"';
		else
			$current = "";

		$links .=  "<li $current>".anchor($link . $var_name.'/' . $i, $i, array('title' => 'Go to page ' . $i, 'class' => 'page'))."</li>";
		$links .= "\n";
	}

	// The next page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['next'], '&raquo;', array('title' => 'Go to the next page', 'class' => 'next_page'))."</li>";
	$links .= "\n";
	// The last page
	$links .= "<li>".anchor($link . $var_name.'/' . $paging_data['last'], 'Last', array('title' => 'Go to the last page', 'class' => 'last_page'))."</li>";
	$links .= "\n";

	$links .= "</ul>";
	$links .= "\n";

	return $links;
}



function paging($page,$rp,$total,$limit)
{
	$limit -= 1;

	$mid = floor($limit/2);

	if ($total>$rp)
		$numpages = ceil($total/$rp);
	else
		$numpages = 1;

	if ($page>$numpages) $page = $numpages;

		$npage = $page;

	while (($npage-1)>0&&$npage>($page-$mid)&&($npage>0))
		$npage -= 1;

	$lastpage = $npage + $limit;

	if ($lastpage>$numpages)
		{
		$npage = $numpages - $limit + 1;
		if ($npage<0) $npage = 1;
		$lastpage = $npage + $limit;
		if ($lastpage>$numpages) $lastpage = $numpages;
		}

	while (($lastpage-$npage)<$limit) $npage -= 1;

	if ($npage<1) $npage = 1;

	//echo $npage; exit;

	$paging['first'] = 1;
	if ($page>1) $paging['prev'] = $page - 1; else $paging['prev'] = 1;
	$paging['start'] = $npage;
	$paging['end'] = $lastpage;
	$paging['page'] = $page;
	if (($page+1)<$numpages) $paging['next'] = $page + 1; else $paging['next'] = $numpages;
	$paging['last'] = $numpages;
	$paging['total'] = $total;
	$paging['iend'] = $page * $rp;
	$paging['istart'] = ($page * $rp) - $rp + 1;

	if (($page * $rp)>$total) $paging['iend'] = $total;

	return $paging;
}

function url_delete($url_arr, $del_param)
{
	$arr_s = array_search($del_param, $url_arr);

	if($arr_s != '')
	{
		array_splice($url_arr, $arr_s, 2);
	}

	return $url_arr;
}

/**
* 내용중에서 이미지명 추출후 DB 입력, 파일갯수 리턴. fckeditor용
*/
function strip_image_tags_fck($str, $no, $type, $table, $table_no)
{
	$CI =& get_instance();
	$file_table="files";
	preg_match_all("<img [^<>]*>", $str, $out, PREG_PATTERN_ORDER);
	$strs = $out[0];
	//$arr=array();
	$cnt = count($strs);
	for ($i=0;$i<$cnt;$i++)
	{
		$arr = preg_replace("#img\s+.*?src\s*=\s*[\"']\s*\/data/images/\s*(.+?)[\"'].*?\/#", "\\1", $strs[$i]);
		$data = array(
					'module_id'=> $table_no,
					'module_name'=> $table,
					'module_no'=>$no,
					'module_type'=>$type,
					'file_name'=>$arr,
					'reg_date'=>date("Y-m-d H:i:s")
					);
		if ( count($arr) <= 25 )
		{
			$CI->db->insert($file_table, $data);
		}

	}
	return $cnt;
}

function trim_text($str,$len,$tail="..")
{
	if(strlen($str)<$len)
	{

		return $str; //자를길이보다 문자열이 작으면 그냥 리턴

	}
	else
	{
		$result_str='';
		for($i=0;$i<$len;$i++)
		{
			if((Ord($str[$i])<=127)&&(Ord($str[$i])>=0)){$result_str .=$str[$i];}
			else if((Ord($str[$i])<=223)&&(Ord($str[$i])>=194)){$result_str .=$str[$i].$str[$i+1];$i+1;}
			else if((Ord($str[$i])<=239)&&(Ord($str[$i])>=224)){$result_str .=$str[$i].$str[$i+1].$str[$i+2];$i+2;}
			else if((Ord($str[$i])<=244)&&(Ord($str[$i])>=240)){$result_str .=$str[$i].$str[$i+1].$str[$i+2].$str[$i+3];$i+3;}
		}

		return $result_str.$tail;
	}
}

/**
* checkmb=true, len=10
* 한글과 Eng (한글=2*3 + 공백=1*1 + 영문=1*1 => 10)
* checkmb=false, len=10
* 한글과 English (모두 합쳐 10자)
*/
function strcut_utf8($str, $len, $checkmb=false, $tail='..')
{
	preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

	$m = $match[0];
	$slen = strlen($str); // length of source string
	$tlen = strlen($tail); // length of tail string
	$mlen = count($m); // length of matched characters

	if ($slen <= $len) return $str;
	if (!$checkmb && $mlen <= $len) return $str;

	$ret = array();
	$count = 0;

	for ($i=0; $i < $len; $i++)
	{
		$count += ($checkmb && strlen($m[$i]) > 1)?2:1;

		if ($count + $tlen > $len) break;
		$ret[] = $m[$i];
	}

	return join('', $ret).$tail;
}

//로그인 처리용 주소 인코딩, 디코딩
function url_code($url, $type='e')
{
	if($type == 'e')
	{
		//encode
		return strtr(base64_encode(addslashes(gzcompress(serialize($url), 9))), '+/=', '-_.');
	}
	else
	{
		//decode
		return unserialize(gzuncompress(stripslashes(base64_decode(strtr($url, '-_.', '+/=')))));
	}
}

//게시판 모델에서 이동. 게시물내 오토링크
function auto_link2($str)
{
	$str = preg_replace("/&lt;/", "\t_lt_\t", $str);
	$str = preg_replace("/&gt;/", "\t_gt_\t", $str);
	$str = preg_replace("/&amp;/", "&", $str);
	$str = preg_replace("/&quot;/", "\"", $str);
	$str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
	$str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'><font color=blue><u>\\2</u></font></A>", $str);
	$str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'><font color=blue><u>\\2</u></font></A>", $str);
	// 이메일 정규표현식 수정
	//$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
	$str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
	$str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
	$str = preg_replace("/\t_lt_\t/", "&lt;", $str);
	$str = preg_replace("/\t_gt_\t/", "&gt;", $str);

	return $str;
}

//배열에서 특정문자 찾아서 배열 리턴하기 (직속데이터만)
function getParentStack($child, $stack) {
    foreach ($stack as $k => $v) {
        if (is_array($v)) {
            // If the current element of the array is an array, recurse it and capture the return
            $return = getParentStack($child, $v);
            
            // If the return is an array, stack it and return it
            if (is_array($return)) {
                return array($k => $return);
            }
        } else {
            // Since we are not on an array, compare directly
            if ($v == $child) {
                // And if we match, stack it and return it
                return array($k => $child);
            }
        }
    }
    
    // Return false since there was nothing found
    return false;
}

//배열에서 특정문자 찾아서 배열 리턴하기 (연관데이터까지)
function getParentStackComplete($child, $stack) {
    $return = array();
    foreach ($stack as $k => $v) {
        if (is_array($v)) {
            // If the current element of the array is an array, recurse it 
            // and capture the return stack
            $stack = getParentStackComplete($child, $v);
            
            // If the return stack is an array, add it to the return
            if (is_array($stack) && !empty($stack)) {
                $return[$k] = $stack;
            }
        } else {
            // Since we are not on an array, compare directly
            if ($v == $child) {
                // And if we match, stack it and return it
                $return[$k] = $child;
            }
        }
    }
    
    // Return the stack
    return empty($return) ? false: $return;
}



//비밀번호찾기
//랜덤문자열만들기(비밀번호찾기 임시비밀번호용)
function GenerateString($length)  
{  
	$characters  = "0123456789";  
	$characters .= "abcdefghijklmnopqrstuvwxyz";  
	//$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
	  
	$string_generated = "";  
	  
	$nmr_loops = $length;  
	while ($nmr_loops--)  
	{  
		$string_generated = $string_generated.$characters[mt_rand(0, strlen($characters))];  
	}  
	  
	return $string_generated;  
} 

//비밀번호암호화
function encryption_pass($passwd){
	require_once(LIB_ROOT.'phpass-0.1/PasswordHash.php');
	$hasher = new PasswordHash(8, False);
	$hashed_password = $hasher->HashPassword($passwd);
	
	return $hashed_password;
}

//쿼리찍기
function q()
{
	$CI =& get_instance();
	echo $CI->db->last_query();
}

//2016-01-30 12:00:00 같은 날짜를 -> 2016.01.30 으로 변환
function change_date($datetime){
	$tmp = explode(" ",$datetime);
	$new_date = str_replace("-",".",$tmp[0]);
	return $new_date;
}

// BMP 전용 썸네일용 함수
function imagecreatefrombmp( $filename ) 
{ 
    $file = fopen( $filename, "rb" ); 
    $read = fread( $file, 10 ); 
    while( !feof( $file ) && $read != "" ) 
    { 
        $read .= fread( $file, 1024 ); 
    } 
    $temp = unpack( "H*", $read ); 
    $hex = $temp[1]; 
    $header = substr( $hex, 0, 104 ); 
    $body = str_split( substr( $hex, 108 ), 6 ); 
    if( substr( $header, 0, 4 ) == "424d" ) 
    { 
        $header = substr( $header, 4 ); 
        // Remove some stuff? 
        $header = substr( $header, 32 ); 
        // Get the width 
        $width = hexdec( substr( $header, 0, 2 ) ); 
        // Remove some stuff? 
        $header = substr( $header, 8 ); 
        // Get the height 
        $height = hexdec( substr( $header, 0, 2 ) ); 
        unset( $header ); 
    } 
    $x = 0; 
    $y = 1; 
    $image = imagecreatetruecolor( $width, $height ); 
    foreach( $body as $rgb ) 
    { 
        $r = hexdec( substr( $rgb, 4, 2 ) ); 
        $g = hexdec( substr( $rgb, 2, 2 ) ); 
        $b = hexdec( substr( $rgb, 0, 2 ) ); 
        $color = imagecolorallocate( $image, $r, $g, $b ); 
        imagesetpixel( $image, $x, $height-$y, $color ); 
        $x++; 
        if( $x >= $width ) 
        { 
            $x = 0; 
            $y++; 
        } 
    } 
    return $image; 
}  

//캐시 검색해서 삭제 (주의 : 비슷한 이름도 모두 삭제)
function delete_cache($cache_name){
	if($cache_name){	//변수가 넘어왔을때만 작동
		$map = directory_map('/ramdisk/joyhunting_web_cache');
		foreach( $map as $val ) {
			if(strpos($val, $cache_name) !== false){		//파일명에 변수가 포함이 되어있으면 삭제
				@unlink("/ramdisk/joyhunting_web_cache/".$val);
			}
		}
	}
}


//css 파일 내용 읽어와서 출력(레이어팝업용)
//경로, 파일이름,확장자
function file_read_echo($file_dir, $ext){
	
	if(empty($file_dir)){ return; }
	
	$file_val = read_file('./include/'.$ext.'/'.$file_dir.".".$ext);
	
	if($ext == "css"){
		echo "<style type='text/css'>".$file_val."</style>";
	}else{
		echo "<script type='text/javascript'>".$file_val."</script>";
	}

}


// curl 통신 하기 
function getHttp($url, $headers=null){

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$result = curl_exec($ch);

	curl_close($ch);

	return $result;

}


//네이버 지도 주소->좌표
function get_naver_gps_code($addr, $cId, $cSecret){

	//세종시 검사 후 처리(세종 -> 세종틀별자치시)
	$region = explode(" ", $addr);
	if($region[0] == "세종"){
		$addr = str_replace("세종", "세종특별자치시", $addr);
	}
	
	$addr = urlencode($addr);
	$url = "https://openapi.naver.com/v1/map/geocode?encoding=utf-8&coord=latlng&output=json&query=".$addr;

	$headers = array();

	$headers[] = "GET https://openapi.naver.com/v1/map/geocode?".$addr;
	$headers[] ="Host: openapi.naver.com";
	$headers[] ="Accept: */*";
	$headers[] ="Content-Type: application/json";
	$headers[] ="X-Naver-Client-Id: ".$cId;
	$headers[] ="X-Naver-Client-Secret: ".$cSecret;
	$headers[] ="Connection: Close";

	$result = getHttp($url, $headers);		//common_helper

	return $result;
}

//네이버 지도 좌표->주소
function get_naver_gps_code_reverse($addr, $cId, $cSecret){

	$addr = urlencode($addr);
	$url = "https://openapi.naver.com/v1/map/reversegeocode?encoding=utf-8&coord=latlng&output=json&query=".$addr;

	$headers = array();

	$headers[] = "GET https://openapi.naver.com/v1/map/reversegeocode?".$addr;
	$headers[] ="Host: openapi.naver.com";
	$headers[] ="Accept: */*";
	$headers[] ="Content-Type: application/json";
	$headers[] ="X-Naver-Client-Id: ".$cId;
	$headers[] ="X-Naver-Client-Secret: ".$cSecret;
	$headers[] ="Connection: Close";

	$result = getHttp($url, $headers);		//common_helper

	return $result;
}

//구글 단축url 생성
function google_url_create($url = null){

	$CI =& get_instance();
	$CI->load->library('google_url_lib');

	if(empty($url)){ $url = "http://www.joyhunting.com/auth/reg_member_msg/".date("YmdHis"); }

	$url = rawurldecode($url);
	$key = "AIzaSyDAMSqFKlleg2WPhubmpgf2V3ml9Wo6KtI";		//googl.gl key값

	$googl = new google_url_lib($key);
	
	$cut_url = $googl->shorten($url);
	unset($googl);
	
	return $cut_url;	
}


//접속자 좌표 셋팅
function member_geo($addr, $cId, $cSecret, $m_result, $geo){
	
	$CI =& get_instance();
	$CI->load->library('member_lib');

	$member_array = "";

	foreach($m_result as $member){		
		if(empty($member_array) || $member_array == ""){
			$member_array = $member['m_userid'];
		}else{
			$member_array = $member_array."|".$member['m_userid'];
		}
	}

	$member = explode('|', $member_array);

	$add_marker = "";

	for($i=0; $i<count(explode('|', $member_array)); $i++){
	
		$m_data = $CI->member_lib->get_member($member[$i]);
		
		if(!empty($m_data)){
			
			$mod = $i%2;
		
			${"map_data".$i} = json_decode($geo, 1);
			
			if($mod == "1"){
				${"map_x_point".$i} = ${"map_data".$i}['result']['items'][0]['point']['x']+str_rand();
				${"map_y_point".$i} = ${"map_data".$i}['result']['items'][0]['point']['y']+str_rand();
			}else{
				${"map_x_point".$i} = ${"map_data".$i}['result']['items'][0]['point']['x']-str_rand();
				${"map_y_point".$i} = ${"map_data".$i}['result']['items'][0]['point']['y']-str_rand();
			}
			

			$add_marker .= "
				var markerOptions = {
					position: new naver.maps.LatLng('".${"map_y_point".$i}."', '".${"map_x_point".$i}."'),
					map: map,
					title: '".$m_data['m_nick']."',
					icon: {
						url: '".img_src_ex($CI->member_lib->member_thumb($member[$i], 40, 40))."',
						size: new naver.maps.Size(40,40),
						origin: new naver.maps.Point(0, 0),
						anchor: new naver.maps.Point(11, 35)
					}
				};

				var marker = new naver.maps.Marker(markerOptions);
			";
		}

	}

	return $add_marker;
					
}

function str_rand(){
	$plus = mt_rand(0,1);
	if($plus == 0){
		return "-0.00".mt_rand(0, 9).str_pad(mt_rand(0, 99), 2, 0);				//랜덤 소수 만의 자리수
	}else{
		return "0.00".mt_rand(0, 9).str_pad(mt_rand(0, 99), 2, 0);				//랜덤 소수 만의 자리수
	}
}

?>