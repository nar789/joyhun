<?
header("Access-Control-Allow-Origin: *");

function send_notification ($tokens, $message){

	$fields = array(
		 'registration_ids' => $tokens,
		 'data' => $message
	);

	$headers = array(
		'Authorization:key = AIzaSyCYOo41y8KakINlPoIB0pgfWeHheG0lR8o',
		'Content-Type: application/json'
	);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');//

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//

	curl_setopt($ch, CURLOPT_POST, true);//

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//

	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));//

	$result = curl_exec($ch);           

	if ($result === FALSE) {

	   die('Curl failed: ' . curl_error($ch));

	}

	curl_close($ch);

	echo $result;

}


//데이터베이스에 접속해서 토큰들을 가져와서 FCM에 발신요청

/*	include_once 'config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "Select Token From users";

$result = mysqli_query($conn,$sql);*/

$tokens = array();

$tokens[0] = "dpki_Htuzf4:APA91bEuDhu-VE-u4HpeYI6MVUeGvdrBppBE1zM47-J8EjsXhz1uaNc35dGPCfVwG063x8N_HyuxaKedoCGV8v4vUbDpdznmLjEbT50BKK0NH3AtC8vpD5Ev7ctyC2Dk_p4QWoGhSMV7";

/*	if(mysqli_num_rows($result) > 0 ){

	while ($row = mysqli_fetch_assoc($result)) {

		$tokens[] = $row["Token"];

	}

}*/

//	mysqli_close($conn);

//      $myMessage = $_POST['message'];

	$myMessage = "테스트입니다.";

/*	if ($myMessage == ""){

	$myMessage = "새글이 등록되었습니다.";

}*/


$message = array("message" => $myMessage);

send_notification($tokens, $message);

?>