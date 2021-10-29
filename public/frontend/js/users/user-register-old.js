$(".login-form form").submit(function(e)
	  {   
	  	//STOP default action
	  	e.preventDefault();
	  	var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var formid = $(this).attr("id");
        var type = "POST";
        $.ajax(
	      {
	          url : formURL,
	          type: type,
	           headers: {
	                    'X-CSRF-Token': "{{ csrf_token() }}",
	               },
	          data : postData,
	          success:function(data, textStatus, jqXHR) 
	          {
	          	if(jqXHR.status == 200){
	          		toastr.success(jqXHR.responseJSON.responseMessage);
	          		$("#exampleModalCenter").modal('hide');
	          		if(data.redirect_url != '/')
					{
						location.href = data.redirect_url;
					}else{
					  	location.href = base_url;
					}
	          	}
	          },
	          error: function(jqXHR, textStatus, errorThrown) 
	          {
	          	if(jqXHR.status == 400){
	          		toastr.error(jqXHR.responseJSON.responseMessage);
	          	}
	          }
	      });
	  }); 

$(".register-user form").submit(function(e)
	  {   
	  	//STOP default action
	  	e.preventDefault();
	  	var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var formid = $(this).attr("id");
        var type = "POST";
        $.ajax(
	      {
	          url : formURL,
	          type: type,
	          headers: {
	                    'X-CSRF-Token': csrftoken
	               },
	          data : postData,
	          success:function(data, textStatus, jqXHR) 
	          {
	          	toastr.success(jqXHR.responseJSON.responseMessage); 
	          	var plan_data = $.parseJSON(data.data.pricing_json);
	          	var plan_description = JSON.parse(plan_data.plan_description);

	          	razorpayCommon(data.data.apiKey, plan_data.id, plan_data.discounted_price, plan_data.plan_name, plan_description, data.data.order_id, data.data.id);
	          	/*var options_data = {
                        "key": data.data.apiKey,
                        "plan_id" : plan_data.id,
                        "amount": plan_price, 
                        "name": plan_data.plan_name,
                        "description": plan_description[0],
                        "order_id" : plan_data.order_id,
                        "subsription_id" : data.data.id,
                        "note" : '',                        
                        "image": base_url + "/frontend/images/logo.svg",
                        "handler": function (response){
                           console.log(response);
                           	$.ajax({
                           		url: base_url + '/razorpay-payment-success',
                           		type: 'post',
                           		dataType: 'json',
                           		headers: {
	                                'X-CSRF-Token': csrftoken
	                            },
	                            data: {
	                            	"razorpay_payment_id" : response.razorpay_payment_id
	                            	// "order_id" : plan_data.order_id,
	                            	// "amount" : plan_price
	                            },
	                            success: function (data, textStatus, jqXHR) {
	                            	console.log(jqXHR);
	                            	console.log(data);
	                                toastr.success(jqXHR.responseJSON.responseMessage);
	                                /*if(data.redirect_url == '/'){
	                                	location.href = base_url;
	                                }*/
	                            /*},
	                            error: function (jqXHR, textStatus, errorThrown){
	                            	console.log(jqXHR);
	                                // toastr.error(error.responseMessage);
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
	                                    "subsription_id" : data.data.id
	                                }, 
	                                success: function (data, textStatus, jqXHR) {
	                                    toastr.success(jqXHR.responseJSON.responseMessage);
	                                    if(data.redirect_url == 'pricing'){
	                                    	location.href = data.redirect_url;
	                                    }
	                                },
	                                error: function (jqXHR, textStatus, errorThrown){
	                                	console.log(jqXHR);
	                                    // toastr.error(error.responseMessage);
	                                }
                            	});
                            }
                        }  
                    };
	          	var razorpay = new Razorpay(options_data);
	          	razorpay.open();*/
	          },
	          error: function(jqXHR, textStatus, errorThrown) 
	          {
	          	toastr.error(jqXHR.responseJSON.responseMessage);
	          }
	      });
	  }); 

	$(".login-user-subscribe form").submit(function(e)
	  {   
	  	//STOP default action
	  	e.preventDefault();
	  	var postData = $(this).serializeArray();
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
	          // data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	          	// var plan_price = ((data.data.discounted_price)*100); // 2000 paise = INR 20
	          	var plan_description = JSON.parse(data.data.plan_description);
	          	var details = data.data;
	          	razorpayCommon(details.apiKey, details.plan_id, data.data.discounted_price, details.plan_name, plan_description);
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
			{
	          	toastr.error(jqXHR.responseJSON.responseMessage);
	        }
	      });
	  }); 

function razorpayCommon(apiKey, plan_id, amount, plan_name, plan_desc, order_id = null, subsription_id = null){
	var plan_price = amount * 100;
	var options_data = { 
                        "key": apiKey,
                        "plan_id" : plan_id,
                        "amount": plan_price, 
                        "name": plan_name,
                        "description": plan_desc,
                        "order_id" : order_id,
                        "subsription_id" : subsription_id,
                        "note" : '',                        
                        "image": base_url + "/frontend/images/logo.svg",
                        "handler": function (response){
                           console.log(response);
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
	                                /*if(data.redirect_url == '/'){
	                                	location.href = base_url;
	                                }*/
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
	                                    "subsription_id" : subsription_id
	                                }, 
	                                success: function (data, textStatus, jqXHR) {
	                                    toastr.success(jqXHR.responseJSON.responseMessage);
	                                    if(data.redirect_url == 'pricing'){
	                                    	location.href = data.redirect_url;
	                                    }
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
}
