<?
class Apptest extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('alrim_helper');
	}

	function gcm_test(){
		gcm_send("wwkorea1030", "test", "test");
	}

	function callurl(){

		exit;
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "client_id=683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com&client_secret=CUKl_i3lDYXRIvpF1EfodY7D&refresh_token=1/8dMUAWcQI_AxeKbXvDkfvWi8gMYIpzJkg4x8UWdDoAY&grant_type=refresh_token"); // Post 값 Get 방식처럼적는다.
		// Execute
		curl_exec($ch);
		curl_close ($ch);

		//1회용임. 사용후에는 exit;
		exit;

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,"https://accounts.google.com/o/oauth2/token"); //접속할 URL 주소
		$result = curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "code=4/71Pxi164aUeBoum60Q0IdYVv9mnBSmpNjwPRSXRPzwA#&client_id=683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com&client_secret=CUKl_i3lDYXRIvpF1EfodY7D&redirect_uri=http://joyhunting.com/test/apptest/okurl&grant_type=authorization_code"); // Post 값 Get 방식처럼적는다.
		// Execute
		curl_exec($ch);
		curl_close ($ch);

 	}

	//{ "access_token" : "ya29.Ci96Az9Y8LgB4MIdunHy07ztO1YP3D1ntIdyWWyk_AHgcB5-YcZhXgSZ6bBZUjyAEQ", "token_type" : "Bearer", "expires_in" : 3600, "refresh_token" : "1/8dMUAWcQI_AxeKbXvDkfvWi8gMYIpzJkg4x8UWdDoAY" }  최초

	//{ "access_token" : "ya29.Ci96A3P6VT4NIdhYkRGA1pcBHmM4t1s3VIkedSJjk251ITSwRmyeZZ_Z4v-hw5ZHhQ", "token_type" : "Bearer", "expires_in" : 3600 }  리프리쉬

	//https://www.googleapis.com/androidpublisher/v1.1/applications/com.anijcorp.joytalk/inapp/jung_33000/purchases/aafemehcpnccbkejgcniioef.AO-J1OztnfIgBPQ1QNE3ztzGGCaDF7DsN5nJLIb3YGsAAvytH03rmQ0InJdVdEn7UZcdHYzUFeT7kUIJUzInQzntgA2z6vofk91eK-fuN8rOnGHS3HGAyLaLFk4qzPVcdgp_L4rBYVIT?access_token=ya29.Ci96A3P6VT4NIdhYkRGA1pcBHmM4t1s3VIkedSJjk251ITSwRmyeZZ_Z4v-hw5ZHhQ   최종호출
   //(1) 번에는 패키지 이름, (2) 번에는 인앱 빌링 한 Product ID, (3) 번에는 결재 Token, (4) 번에는 어렵게 구한 Access Token을 넣어준다.


//"transaction":{"type":"android-playstore","purchaseToken":"aafemehcpnccbkejgcniioef.AO-J1OztnfIgBPQ1QNE3ztzGGCaDF7DsN5nJLIb3YGsAAvytH03rmQ0InJdVdEn7UZcdHYzUFeT7kUIJUzInQzntgA2z6vofk91eK-fuN8rOnGHS3HGAyLaLFk4qzPVcdgp_L4rBYVIT","receipt":"{\"packageName\":\"com.anijcorp.joytalk\",\"productId\":\"jung_33000\",\"purchaseTime\":1476152911184,\"purchaseState\":0,\"purchaseToken\":\"aafemehcpnccbkejgcniioef.AO-J1OztnfIgBPQ1QNE3ztzGGCaDF7DsN5nJLIb3YGsAAvytH03rmQ0InJdVdEn7UZcdHYzUFeT7kUIJUzInQzntgA2z6vofk91eK-fuN8rOnGHS3HGAyLaLFk4qzPVcdgp_L4rBYVIT\"}","signature":"BG3n4yJrKGACOPY3yXndIwFhL6JdbACodATH/eItZ0ko6LbXjuNmob5Fhj/2OKXYuh+jhSgz7cCjq5DIFuGJQnUDDCwJFIJE8B+jJl+k1qMu9EeQ+Tzs0VzAjWzG45y4jv3reU/yj2HoQxTNS91h+9NG4UoA2mt0hDHrIeGNDBngvey3uJGGNwv/+D7GNZkM51TKQRb/m6glY8SNx7asZszQZNkwZQYDtD3pKc1lF1ZWqCvxvszvrnsE0ROsVaSFS/Zgy1I2xM2Nf/hUR9cfMMhwcPNpGs80PwfU9jp7EZky5OmiQPZdPSYK3iH8ERk/aPzrrVOjCrSKHS0mYVIw3A=="}

	function okurl(){
		//https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/androidpublisher&response_type=code&access_type=offline&redirect_uri=http://joyhunting.com/test/apptest/okurl&client_id=683538865976-onv05tkf5n5tfd56hbhom30g2qg33lrm.apps.googleusercontent.com
		//호출하면
		
		echo "ok";
		exit;
	}

	//영수증 샘플
	function checkpurchase(){
		?>
			{
			"packageName":"com.anijcorp.joytalk",
			"productId":"jung_33000",
			"purchaseTime":1476152911184,
			"purchaseState":0,
			"purchaseToken":"aafemehcpnccbkejgcniioef.AO-J1OztnfIgBPQ1QNE3ztzGGCaDF7DsN5nJLIb3YGsAAvytH03rmQ0InJdVdEn7UZcdHYzUFeT7kUIJUzInQzntgA2z6vofk91eK-fuN8rOnGHS3HGAyLaLFk4qzPVcdgp_L4rBYVIT"
			}
		<?
	}

	//저장 
	function savepurchase(){

		$json = $this->input->post('data',TRUE);

		$json_arr = json_decode($json);

		$price = str_replace("₩","",$json_arr->price);
		$price = str_replace(",","",$price);
	
		$tmp_tran = explode('"downloaded":false,',$json);
		$tmp_tran2 = explode(',"valid":true',$tmp_tran[1]);
		$tran = $tmp_tran2[0];

		$arr_data = array(
			'w_date' => NOW,
			'full_data' => $json,
			'id' => $json_arr->id,
			'alias' => $json_arr->alias,
			'type' => $json_arr->type,
			'state' => $json_arr->state,
			'title' => $json_arr->title,
			'description' => $json_arr->description,
			'price' => $price,
			'currency' => $json_arr->currency,
			'loaded' => $json_arr->loaded,
			'canPurchase' => $json_arr->canPurchase,
			'owned' => $json_arr->owned,
			'downloading' => $json_arr->downloading,
			'downloaded' => $json_arr->downloaded,
			'transaction' => $tran,
			'valid' => $json_arr->valid
		);

		$rtn = $this->my_m->insert("app_purchase", $arr_data);
		
		echo 1;
	}

	function savepurchase_test(){

		$json = '{"id":"1001","alias":"extra life","type":"consumable","state":"approved","title":"정회원 +1,500 포인트 (조이헌팅 채팅 어플)","description":"조이헌팅 1년 정회원 + 1,500포인트","price":"₩33,000","currency":"KRW","loaded":true,"canPurchase":false,"owned":false,"downloading":false,"downloaded":false,"transaction":{"type":"android-playstore","id":"GPA.1315-2603-2149-82397","purchaseToken":"fgdagmmiidpjhkckobnjaeni.AO-J1OwPlGUov7gOkDVylLppWmhommQnX2Mx99Bgmqq2sE5hkg7hU0ZlAssw-c2h3hJ3LavywEqrTMp3YU3nZaZ5TcikE82r00nI1lfbN-T5ZKG0OlSTvrw","receipt":"{"orderId":"GPA.1315-2603-2149-82397","packageName":"com.anijcorp.joytalk","productId":"1001","purchaseTime":1476427317977,"purchaseState":0,"purchaseToken":"fgdagmmiidpjhkckobnjaeni.AO-J1OwPlGUov7gOkDVylLppWmhommQnX2Mx99Bgmqq2sE5hkg7hU0ZlAssw-c2h3hJ3LavywEqrTMp3YU3nZaZ5TcikE82r00nI1lfbN-T5ZKG0OlSTvrw"}","signature":"hEJCo4nMldwkFJ5J/+mM+uh1aGwspt4hsNX66FOYMp84ATlgVYA8zYftCASlBLXikcK/VbjriF4Mkt94b76V55QtZr5eLFDbnCpw2GwPrRTm+vE19tq+AjoxcF1wSSijo+SixEROPmxuVQUBli04CELAV6mXVm0XrUH+H2rn1ZtAQVG51c+LUtRfeHlKcX0w+Di7D75hWIcLp14+9wEc2zeXZHZKb4MU/w7v7OIYFwzJysd5RohKpKzyFUb4Pa/28Fp5/E4Za3i6vSgQ83jlii7cpiQHU86tLILtJbi6XJ6Hx87DpQlGSnXHrhvKdYw+YTvQ73EZqhm/qTIAI5fs8g=="},"valid":true}';

//		$json = str_replace('"{', '{', $json);
//		$json = str_replace('}"', '}', $json);

		//$json = stripslashes($json); // 값 필터링
		$json_arr = json_decode($json);
		
		//print_r($json_arr);

		print_r($json_arr->transaction->receipt->orderId);

	}


	//앱 테스트
	function test(){

		?>

			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<meta name="format-detection" content="telephone=no" />
					<meta name="msapplication-tap-highlight" content="no" />
					<!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
					<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

					<!-- Enable all requests, inline styles, and eval() -->
					<meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">

					<style>
						* {
							-webkit-tap-highlight-color: rgba(0,0,0,0); /* make transparent link selection, adjust last value opacity 0 to 1.0 */
						}

						body {
							-webkit-touch-callout: none;                /* prevent callout to copy image, etc when tap to hold */
							-webkit-text-size-adjust: none;             /* prevent webkit from resizing text to fit */
							-webkit-user-select: none;                  /* prevent copy paste, to allow, change 'none' to 'text' */
							background-color:#E4E4E4;
							font-family:'HelveticaNeue-Light', 'HelveticaNeue', Helvetica, Arial, sans-serif;
							height:100%;
							margin:0px;
							padding:0px;
							width:100%;
						}

						.ios-only, .android-only{
							display: none;
						}
						body.android .android-only,
						body.ios .ios-only{
							display: block;
						}

						.app {
							padding: 2em;
							text-align:center;
						}

						h1 {
							font-size:24px;
							font-weight:normal;
							margin:0px;
							overflow:visible;
							padding:0px;
							text-align:center;
						}

						#log {
							font-size: 0.7em;
							font-family: monospace;
						}

						.button {
							display:inline-block;
							padding: 5px 20px;
							border: 1px solid black;
							margin: 10px 0;
						}
						.button:empty{
							border: none !important;
						}

						#subscriber-info {
							margin: 10px 0;
							font-weight: bold;
						}

						#non-consumable-hosted-content-download,
						#non-consumable-non-hosted-content-download{
							padding: 5px 20px;
						}

						#in-app-purchase-list div, .section{
							border-bottom: 1px solid #000;
							margin-bottom: 5px;
							padding-bottom: 5px;
						}
						#in-app-purchase-list div:empty, .section:empty{
							border: none !important;
						}
					</style>
					<title>Hello World</title>
				</head>
				<body>
					<!-- List of in-app purchases -->
					<div class="app">
						<h3 id="loading-indicator">Loading</h3>
						<div id="in-app-purchase-list">
							<div id="1001-purchase"></div>
							<div id="2001-purchase"></div>
							<div id="2002-purchase"></div>
							<div id="2003-purchase"></div>
							<div id="nonconsumablehosted1-purchase" class="ios-only"></div>
						</div>
					</div>

					<!-- Are we subscribers? -->
					<div id="subscriber-info" class="section">Loading subscription status...</div>

					<!-- Non-consumable non-(provider-)hosted content download -->
					<div id="non-consumable-non-hosted-content-download" class="section" style="display:none"></div>

					<!-- Non-consumable Apple-hosted content download -->
					<div id="non-consumable-hosted-content-download" class="section ios-only" style="display:none"></div>

					<div class="section">
						<!-- Button to access the full version feature: initially hidden -->
						<div id="access-full-version-button" class="button" style="display:none">Access the awesome Full Version feature</div>

						<!-- Button to access the full version feature: initially hidden -->
						<div id="refresh-button" class="button" style="display:none">Refresh purchases</div>

					</div>

					<!-- app.log will add stuff in here -->
					<div id="log" class="section" />
				
					<script src="<?php echo JS_DIR?>/jquery-1.12.0.min.js"></script>
					<script type="text/javascript" src="<?=APP_ROOT?>/cordova.js?<?=TODAY?>"></script>
					<script type="text/javascript" src="<?=APP_ROOT?>/cordova_plugins.js?<?=TODAY?>"></script>
					<script type="text/javascript" src="<?=APP_ROOT?>/js/index_test3.js?<?=NOW?>"></script>

				</body>
			</html>

		<?

	}
	
}

?>