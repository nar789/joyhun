<?
echo phpinfo();exit;

//css 파일 내용 읽어와서 출력(레이어팝업용)
//경로, 파일이름,확장자
function file_read_echo($DIR,$file_name,$ext){
	
	if(empty($file_name)){ return; }
	
	$file_val = "";

	$file = fopen($DIR."/".$file_name.".".$ext, 'r');
	$f_con = fread($file, 1024*100);
	
	$file_val .= $f_con;

	if($ext == "css"){
		echo "".$file_val."";
	}else{
		echo "<script>".$file_val."</script>";
	}

}

file_read_echo("/home/joyhunting/www/include/css/layer_popup", "point_add_popup_css","css");

?>