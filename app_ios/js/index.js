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

var iAPState = true;
var appStoreReceipt;
var orderData;
var get_try = '';

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

		var url = window.location.pathname;
		if(url == "/profile/point/point_list" || url == "/profile/point/payment_f"){
			document.addEventListener('deviceready', this.bind(this.initStore), false);
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

		//앱버전 받아오기
		/*
		$.get('/etc/app/app_ver', function(data){

			if(data > AppVersion.version){

				navigator.notification.alert(
					'어플 새 버전이 나왔습니다.\n안드로이드 마켓으로 이동합니다.',  // message
					alertDismissed,         // callback
					'어플 업데이트',            // title
					'확인'                  // buttonName
				);
				location.href='https://play.google.com/store/apps/details?id=com.daisseo.app';
			}
		});
		*/

		//테스트
		FCMPlugin.getToken(		
		  function(token){		
			$.get('/etc/app/save_id/'+token + '/'+device.uuid+ '/ios', function(data){
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


app.bind = function(fn) {
    return function() {
        fn.call(app, arguments);
    };
};




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


	store.when("product").updated(function(product) {
				if(product.loaded && product.valid && product.state === store.APPROVED) {
				   product.finish();
				}
	}); 

/*
	store.validator = function(product, callback) {
			alert(JSON.stringify(product));
	});

	store.when("product").verified(function(product) {
		alert(4);
		alert(JSON.stringify(product));
		product.finish();
	});
*/

    store.when("product").approved(function (order) {
/*
		if(get_try == ''){
			setTimeout(function(){ 
					alert("get_try"); 
					get_try = '';
					apple_payment();
			}, 7000);
		}
		get_try = 'y';
*/
		//alert(1);
		var txt = JSON.stringify(order);
		var txt2 = JSON.parse(txt);
		//alert(txt);

		if(txt2.transaction.appStoreReceipt){
			//alert(3);
			//alert(JSON.stringify(order));
			appStoreReceipt = txt2.transaction.appStoreReceipt;
			//alert(appStoreReceipt);
			//alert(33);
			//order.finish();
		}

	if(appStoreReceipt){
			//alert(5);

			$.ajax({
					type:"POST",  
					url :"/etc/app/save_purchase_ios",	
					data:{ receipt : appStoreReceipt,code :  $("input[name='point_lv']:checked").val() }, // data를 json 형식으로 파싱하여 전달,
					success:function(args){
						//alert(args);
						if(args == 1){
						   alert("결제가 완료되었습니다.");
						   order.finish();
						   location.href="/m/add_menu";
							$("#pay_loading").hide();
						}else{
						  alert("결제오류.");
						  alert(args);
						  order.finish();
							$("#pay_loading").hide();
						}
					},   
					error:function(e){  
					   //alert("결제에 실패하였습니다2." + e);
					   order.finish();
						$("#pay_loading").hide();
					} 
			});  

		}
		//alert(2);
	
    });

/*
	store.when("product").finished(function(p){
		alert("product");
			  if(iAPState == true)
			  {
							   alert('IAP for Tips called');
								transid=p.transaction.id;
							   alert(alias+" finished " + p.state + ", title is " + p.title+" "+JSON.stringify(p) );
							   iAPState=false;
			  }
	});
*/

/*
	store.when("1002").updated(function(order) {
		//alert(order.id);
	});

	store.when("product").unverified(function(product) {
	  //alert("UnVerified !");
	});

	store.when("product").expired(function(product) {
	  //alert("Expired !");
	});

	store.when("product").cancelled(function (product) {
	  //alert("Cancelled !");
	});

	store.when("product").error(function (product) {
	  //alert("Error !");
	});

    store.when("product").updated(function (p) {
       
    });

    store.when("product").approved(function (order) {
		alert(JSON.stringify(order));
		//return;
	     alert(order.transaction.transactionReceipt);

		$.ajax({
				type:"POST",  
				url :"/etc/app/save_purchase_ios",	
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

	store.error(function(e){
		console.log("storekit ERROR " + e.code + ": " + e.message);
	});
	*/


		setTimeout(function(){ 
			//alert('ref');
			store.refresh();
		}, 1000);

};



app.bind = function(fn) {
    return function() {
        fn.call(app, arguments);
    };
};

app.initialize();

//구매복원
function restorePurchases (){            
            store.refresh();      
}

//애플 결제 전용
function apple_payment(){
	if($("input[name='point_lv']:checked").length == "0"){
		alert("하나의 상품을 선택하세요.");
		return;
	}
	code = $("input[name='point_lv']:checked").val();
	store.refresh();    
	store.order(code);	//app/js/index.js
	$("#pay_loading").show();
}

