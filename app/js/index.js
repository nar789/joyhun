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
        document.addEventListener('deviceready', this.onDeviceReady, false);
    	document.addEventListener('deviceready', this.bind(this.initStore), false);

		var url = window.location.pathname;
		if(url == "/auth/register"){
			document.addEventListener('backbutton', onBackButton, false); // back button press event
		}
	//	document.addEventListener('menubutton', onMenuButton, false); // menu button press event
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        //app.receivedEvent('deviceready');

	    cordova.plugins.notification.badge.set(0);

        //checkConnection();

		//조이헌팅 앱버전 받아오기
		$.get('/etc/app/app_ver', function(data){

			if(data > AppVersion.version){

				navigator.notification.alert(
					'조이헌팅 어플 새 버전이 나왔습니다.\n안드로이드 마켓으로 이동합니다.',  // message
					alertDismissed,         // callback
					'조이헌팅 업데이트',            // title
					'확인'                  // buttonName
				);
				location.href='https://play.google.com/store/apps/details?id=com.anijcorp.joytalk';
			}
		});
		

		//테스트
		FCMPlugin.getToken(
		  function(token){
			$.get('/etc/app/save_id/'+token + '/'+device.uuid+ '/android', function(data){
			});
		  },
		  function(err){
			//console.log('error retrieving token: ' + err);
		  }
		);

		FCMPlugin.onNotification(
		  function(data){
			/*
			if(data.wasTapped){
			  alert( JSON.stringify(data) );
			}else{
			  alert( JSON.stringify(data) );
			}
			*/
		  },

		  function(msg){
			/*
			alert('onNotification callback successfully registered: ' + msg)
			console.log('onNotification callback successfully registered: ' + msg);
			*/
		  },

		  function(err){
			//console.log('Error registering onNotification callback: ' + err);
		  }
		);

    },
    onResume: function() {
	    cordova.plugins.notification.badge.set(0);
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {

    }
};

function alertDismissed() {
    // do something
	
}

function onBackButton(){

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

    store.register({
        id:    '1002', // id without package name!
        alias: 'point_33000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '1003', // id without package name!
        alias: 'point_55000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '1004', // id without package name!
        alias: 'point_110000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '1005', // id without package name!
        alias: 'point_220000',
        type:   store.CONSUMABLE
    });

    store.register({
        id:    '4003', // id without package name!
        alias: 'point_month',
        type:   store.PAID_SUBSCRIPTION
    });


    // When any product gets updated, refresh the HTML.
    store.when("product").updated(function (p) {
        //app.renderIAP(p);
    });

	is_save_product = false;

	$.ajax({
			type:"POST",  
			url :"/etc/app/reset_product",
			data:{}, 
			success:function(args){
			},   
			error:function(e){
			} 
	});  		


	store.when("product").updated(function(product) {
		if (product.owned && is_save_product == false){
			is_save_product = true;
			$.ajax({
					type:"POST",  
					url :"/etc/app/save_product",
					data:{data : JSON.stringify(product)}, // data를 json 형식으로 파싱하여 전달,
					success:function(args){
					},   
					error:function(e){
					} 
			});  		
		}
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
					  // alert(args);
			           order.finish();
					}
				},   
				error:function(e){  
				//   alert("결제에 실패하였습니다2." + e);
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


//구글 결제 전용
function google_payment(){
	if($("input[name='point_lv']:checked").length == "0"){
		alert("하나의 상품을 선택하세요.");
		return;
	}
	code = $("input[name='point_lv']:checked").val();
	store.order(code);	//app/js/index.js
}