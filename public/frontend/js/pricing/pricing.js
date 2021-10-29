/*$(".login-user-subscribe form").submit(function(e)
	  {   
	  	//STOP default action
	  	e.preventDefault();
	  	// var postData = $(this).serializeArray();
	  	// console.log(postData);
        var formURL = $(this).attr("action");
        var formid = $(this).attr("id");
        var type = "POST";
        $.ajax(
	      {
	        url : formURL,
	        type: type,
	        headers: {
	        	'X-CSRF-Token': csrftoken,
	        },
	        data:{
	          // data : postData,
	        },
	        success:function(data, textStatus, jqXHR) 
	        {
	        	var plan_data = JSON.parse(data.data.pricing_json);
	        	var plan_price = ((data.data.pricing_amount)*100);
	        	var plan_description = JSON.parse(plan_data.plan_description);

	          	var options_data = { 
                        "key": data.data.apiKey,
                        "plan_id" : data.data.pricing_id,
                        "amount": plan_price, 
                        "name": plan_data.plan_name,
                        // "description": plan_description[0],
                        "description": data.data.id,
                        "subsription_id" : data.data.id,
                        "note" : '',                        
                        "image": base_url + "/frontend/images/logo.svg",
                        "handler": function (response){
                           	$.ajax({
                           		url: base_url + '/razorpay-payment-success',
                           		type: 'post',
                           		dataType: 'json',
                           		headers: {
	                                'X-CSRF-Token': csrftoken
	                            },
	                            data: {
	                            	"razorpay_payment_id" : response.razorpay_payment_id
	                            },
	                            success: function (data, textStatus, jqXHR) {
	                                toastr.success(jqXHR.responseJSON.responseMessage);
			                        $('#transactionSuccess').modal('show');
			                        successRedirect(data.redirect_url);
	                            },
	                            error: function (jqXHR, textStatus, errorThrown){
	                                toastr.error(jqXHR.responseJSON.responseMessage);
	                            }
                           	});
                       	},
                        "prefill": {
                        	// "contact": '4567891230',
                        	// "email":   'avnipatel@gmail.com',
                        },
                        "theme": {
                        "color": "#0070cd"
                        }, 
                        "modal":{
                            "backdropclose":false,
                            "escape":false,
                            "handleback":false,
                            "ondismiss": function(){
                                $.ajax({
	                                url:  base_url + '/payment-cancel',
	                                type: 'post',
	                                dataType: 'json',
	                                headers: {
	                                	'X-CSRF-Token': csrftoken
	                                },
	                                data: {
	                                    "subscription_id" : data.data.id
	                                }, 
	                                success: function (data, textStatus, jqXHR) {
	                                    toastr.success(jqXHR.responseJSON.responseMessage);
	                                    location.href = data.redirect_url;
	                                },
	                                error: function (jqXHR, textStatus, errorThrown){
	                                    toastr.error(jqXHR.responseJSON.responseMessage);
	                                }
                            	});
                            }
                        }  
                    };
	          	var razorpay = new Razorpay(options_data);
	          	razorpay.open();
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
			{
	          	toastr.error(jqXHR.responseJSON.responseMessage);
	        }
	      });
	  }); */

function subscribePlan(plan_id, price){
	$.ajax(
	      {
	        url : base_url + '/subscribe',
	        method: "POST",
	        headers: {
	        	'X-CSRF-Token': csrftoken,
	        },
	        data:{
	          'plan': plan_id,
	          'price': price
	        },
	        success:function(data, textStatus, jqXHR) 
	        {
	        	console.log(jqXHR);
	        	var plan_data = JSON.parse(data.data.pricing_json);
	        	var plan_price = ((data.data.pricing_amount)*100);
	        	var plan_description = JSON.parse(plan_data.plan_description);

	          	var options_data = { 
                        "key": data.data.apiKey,
                        "plan_id" : data.data.pricing_id,
                        "amount": plan_price, 
                        "name": plan_data.plan_name,
                        // "description": plan_description[0],
                        "description": data.data.id,
                        "subsription_id" : data.data.id,
                        "note" : '',                        
                        "image": base_url + "/frontend/images/logo.svg",
                        "handler": function (response){
                           	$.ajax({
                           		url: base_url + '/razorpay-payment-success',
                           		type: 'post',
                           		dataType: 'json',
                           		headers: {
	                                'X-CSRF-Token': csrftoken
	                            },
	                            data: {
	                            	"razorpay_payment_id" : response.razorpay_payment_id
	                            },
	                            success: function (data, textStatus, jqXHR) {
	                                toastr.success(jqXHR.responseJSON.responseMessage);
			                        $('#transactionSuccess').modal('show');
			                        successRedirect(data.redirect_url);
	                            },
	                            error: function (jqXHR, textStatus, errorThrown){
	                                toastr.error(jqXHR.responseJSON.responseMessage);
	                            }
                           	});
                       	},
                        "prefill": {
                        	// "contact": '4567891230',
                        	// "email":   'avnipatel@gmail.com',
                        },
                        "theme": {
                        "color": "#0070cd"
                        }, 
                        "modal":{
                            "backdropclose":false,
                            "escape":false,
                            "handleback":false,
                            "ondismiss": function(){
                                $.ajax({
	                                url:  base_url + '/payment-cancel',
	                                type: 'post',
	                                dataType: 'json',
	                                headers: {
	                                	'X-CSRF-Token': csrftoken
	                                },
	                                data: {
	                                    "subscription_id" : data.data.id
	                                }, 
	                                success: function (data, textStatus, jqXHR) {
	                                    toastr.success(jqXHR.responseJSON.responseMessage);
	                                    location.href = data.redirect_url;
	                                },
	                                error: function (jqXHR, textStatus, errorThrown){
	                                    toastr.error(jqXHR.responseJSON.responseMessage);
	                                }
                            	});
                            }
                        }  
                    };
	          	var razorpay = new Razorpay(options_data);
	          	razorpay.open();
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
			{
				console.log(jqXHR);
	          	toastr.error(jqXHR.responseJSON.responseMessage);
	        }
	      });
}

function successRedirect(redirect_url){
	console.log(redirect_url);
	$(document).on("click","#successDone",function(e) {
	  e.preventDefault();
		location.href = redirect_url;
	});
}