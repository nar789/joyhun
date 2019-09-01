/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
    	    document.addEventListener('deviceready', this.bind(this.onDeviceReady), false);
    	    document.addEventListener('deviceready', this.bind(this.initStore), false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        //app.receivedEvent('deviceready');
		//cordova.plugins.notification.badge.set(0);

		app_initialize();
	  //  this.initStore();
    }
};

function alertDismissed() {
    // do something
	
}

function app_initialize()
{

	//조이헌팅 앱버전 받아오기
	$.get('/etc/app/app_ver', function(data){
		if(data > AppVersion.version){

			navigator.notification.alert(
				'조이헌팅 어플 새 버전이 나왔습니다.\n안드로이드 마켓으로 이동합니다.',  // message
				alertDismissed,         // callback
				'조이헌팅 업데이트',            // title
				'확인'                  // buttonName
			);

		}
	});

	var push = PushNotification.init({
			"android": { "senderID": "683538865976" },
			"ios": {},
			"windows": {}
	});

	push.on('registration', function(data) {

			$.get('/etc/app/save_id/'+data.registrationId + '/'+device.uuid, function(data){
			});

			localStorage.setItem("pushID", data.registrationId);

			if( document.URL == 'http://hm.auton-gift.com/main/cordova' )
			{
				var session_res;
				session_res = session_save( data.registrationId );
			}
			if( device.uuid != 'cf33e5c40ab51aa4' )
			{
				if( document.URL == 'http://hm.auton-gift.com/main/cordova' ) setTimeout("move_home()", 2000);
			}else{
				assign_debug('<p>DEVICE TEST</p>');
				cordova.getAppVersion().then(function (version){
					assign_debug('<p>app_version : '+version+'</p>');
					var app_version = localStorage.setItem("app_ver", version);
				});
				//document.removeEventListener('backbutton', onBackButton, false);
				if( document.URL == 'http://hm.auton-gift.com/main/cordova' ) setTimeout("move_home()", 2000);
			}
	});

	push.on('notification', function(data) {
		// assign_debug('<p class="full">'+JSON.stringify(data)+'</p>');
		// assign_debug('<p>DEEP LINK : '+data.additionalData.link+'</p>');
		//alert(data.message);
		if( data.additionalData.link != undefined )
		{
			location.href = data.additionalData.link;
		}
	});

	push.on('error', function(e) {
			// e.message
			//assign_debug('<p class="full">PUSH ERROR : '+ e.message +'</p>');
			// console.log("push error");
	});

	/*
	# PUSH INITIALIZE
	var push = PushNotification.init({ "android": {"senderID": "12345679"},"ios": {}, "windows": {} } );

	# PUSH REGISTERATION
	push.on('registration', function(data) {
			// data.registrationId
	});

	# PUSH NOTIFICATION EVENT
	push.on('notification', function(data) {
			// data.message,
			// data.title,
			// data.count,
			// data.sound,
			// data.image,
			// data.additionalData
	});

	# ERROR HANDLER
	push.on('error', function(e) {
		// e.message
	});

	# UNREGISTGER
	push.unregister(successHandler, errorHandler);


	assign_debug('<p>DEVICE UID : '+device.uuid+'</p>');
	assign_debug('<p>DEVICE PLATFORM : '+device.platform+'</p>');
	assign_debug('<p>DEVICE MODEL : '+device.model+'</p>');
	assign_debug('<p>DEVICE VERSION : '+device.version+'</p>');
	*/
}

function assign_debug(str)
{
	if( device.uuid == 'cf33e5c40ab51aa4' ) debug_mode = true;

	// DEBUG PRINT DEBUG
	if( debug_mode == true )
	{
		$(".debug").css('display','block');
		$(".debug").append(str);
	}
}

function alertCallback(e)
{
	location.reload();
	// assign_debug('<p>PRESS ALERT CALL BACK</p>');
}

function onMenuButton()
{
	//navigator.notification.confirm('PUSH ID 를 해제하겠습니까?',alertCallback,'푸시설정',['예','아니요']);
	navigator.notification.alert(
			'화면을 갱신합니다.',	// message
			alertCallback,			// callback
			'알림',							// title
			'새로고침'						// buttonName
	);
}

function onBackButton(e)
{

	if( $('#home').length > 0 )
	{
		navigator.notification.confirm('종료하시겠습니까?', onBackButtonKeyDown, '알림', '종료, 취소');
	}else{
		history.back();
	}

}

function onBackButtonKeyDown(e)
{
	if( e == 1 ) navigator.app.exitApp();
	/*
	토큰값 저장을 위한 테스트 코드
	if( e == 2 )
	{
		var regID = localStorage.getItem("pushID");
		$.ajax({
			async: false,
			url: "/main/save_token/?token="+regID,
			dataType:"html", // xml, json, script, or html
			success: function(html){
				assign_debug('<p>ADD : ' + html + '</p>');
			},
			error: function(msg){ alert('네트워크 연결을 확인해주세요'); }
		})
	}
	*/
}


/******************************* 인앱결제 ********************************/

// initialize the purchase plugin if available
app.initStore = function() {

    // Enable maximum logging level
    store.verbosity = store.DEBUG;

    // Inform the store of your products
    store.register({
        id:    '1001', // id without package name!
        alias: 'jung_33000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '2001', // id without package name!
        alias: 'jung_55000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '2002', // id without package name!
        alias: 'jung_110000',
        type:  store.CONSUMABLE
    });

    store.register({
        id:    '2003', // id without package name!
        alias: 'jung_220000',
        type:   store.CONSUMABLE
    });

    // When any product gets updated, refresh the HTML.
    store.when("product").updated(function (p) {
        //app.renderIAP(p);
    });


    store.when("product").approved(function (order) {
		$.ajax({
				type:"POST",  
				url :"/etc/app/save_purchase",
				data:{data : JSON.stringify(order)}, // data를 json 형식으로 파싱하여 전달,
				success:function(args){
					if(args == 1){
					   alert("결제가 완료되었습니다.");
			           order.finish();
					   location.href="/m/add_menu";
					}else{
					   alert("결제에 실패하였습니다1." + args);
			           order.finish();
					}
				},   
				error:function(e){  
				   alert("결제에 실패하였습니다2." + e);
		           order.finish();
				} 
		});  

    });

    store.refresh();
};

app.bind = function(fn) {
    return function() {
        fn.call(app, arguments);
    };
};


app.initialize();