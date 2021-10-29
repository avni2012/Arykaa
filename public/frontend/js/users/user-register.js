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
	          	var plan_price = ((data.data.pricing_amount)*100);
	          	var options_data = {
                        "key": data.data.apiKey,
                        "plan_id" : plan_data.id,
                        "amount": plan_price, 
                        "name": plan_data.plan_name,
                        // "description": plan_description[0],
                        "description": data.data.id,
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
	                            },
	                            success: function (data, textStatus, jqXHR) {
	                                toastr.success(jqXHR.responseJSON.responseMessage);
                                  $('#transactionSuccess').modal('show');
                                  successRedirectPlan(data.redirect_url);
	                                // location.href = data.redirect_url;
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
	  }); 

$(document).ready(function(){
	let time = 0;
	var input = document.querySelector("#mobile_no");
    window.intlTelInput(input, ({
        initialCountry: "in",
        autoPlaceholder: "polite",
        formatOnDisplay: true,
        separateDialCode: true,
    }));
    $("#email").on('input', function() {
        clearTimeout(time);
        time = setTimeout(function() {
            var email = $('#email').val();
            if(email.length > 0){
                $.ajax(
                {
                    url : base_url + '/verify-email',
                    type: "POST",
                    headers: {
                      'X-CSRF-Token': csrftoken
                    },
                    data : {
                        email: email
                    },
                    success:function(data, textStatus, jqXHR) 
                    {
                        toastr.success(jqXHR.responseJSON.responseMessage);
                        $("#VerifyOTP").show();
                        verifyOTPHtml();
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                      toastr.error(jqXHR.responseJSON.responseMessage);
                    }
                });
            }else{
                $("#VerifyOTP").hide();
            }
        }, 1000);
    });
    $(document).on('click', '#validate_otp', function(e) {
        var otp = $("#otp").val();
            $.ajax(
                    {
                        url : base_url + '/verify-otp',
                        type: "POST",
                        headers: {
                          'X-CSRF-Token': csrftoken
                        },
                        data : {
                            otp: otp
                        },
                        success:function(data, textStatus, jqXHR) 
                        {
                        	console.log(data);
                            toastr.success(jqXHR.responseJSON.responseMessage);
                            timerOn = false;
                            $('#otp').prop('disabled', true);
                            $('#validate_otp').prop('disabled', true);
                            $('#register_user').removeAttr('disabled');
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                          console.log(jqXHR);
                          toastr.error(jqXHR.responseJSON.responseMessage);
                        }
                    });
    });
    $(document).on('click', '#resend_otp', function(e) {
        var email = $('#email').val();
        var otp = $("#otp").val();
            $.ajax(
                    {
                        url : base_url + '/resend-otp',
                        type: "POST",
                        headers: {
                          'X-CSRF-Token': csrftoken
                        },
                        data : {
                            email: email
                            // otp: otp
                        },
                        success:function(data, textStatus, jqXHR) 
                        {
                        	$("#OTP_btn").empty();
                        	$("#OTP_btn").html('<label></label><button id="validate_otp" class="btn btn-primary d-block w-80" type="button">Validate</button>');
                            toastr.success(jqXHR.responseJSON.responseMessage);
                        	timer(30);
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                          console.log(jqXHR);
                          toastr.error(jqXHR.responseJSON.responseMessage);
                        }
                    });
    });
})

let timerOn = true;
function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }
  if(!timerOn) {
    return;
  }
  // Do timeout stuff here
  $("#OTP_btn").empty();
  $("#OTP_btn").html('<label></label><button id="resend_otp" class="btn btn-primary d-block w-80" type="button">Resend</button>');
}

function verifyOTPHtml(){
	$.ajax({
      url: "get-otp-form/",
      dataType: 'html',
      success: function (data, textStatus, jqXHR) { 
      	$("#VerifyOTP").html(data);
		timer(30);
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
}

/*function successRedirectPlan(user_id){
  $(document).on("click","#successDone",function(e) {
    e.preventDefault();
    $.ajax({
      url: base_url + '/login-after-purchase-plan',
      type: 'post',
      dataType: 'json',
      headers: {
        'X-CSRF-Token': csrftoken
      },
      data: {
        "user_id" : user_id
      },
      success: function (data, textStatus, jqXHR) {
        console.log(data);
        toastr.success(jqXHR.responseJSON.responseMessage);
        // location.href = data.redirect_url;
      },
      error: function (jqXHR, textStatus, errorThrown){
        toastr.error(jqXHR.responseJSON.responseMessage);
      }
    });
  });
}*/
function successRedirectPlan(redirect_url){
  $(document).on("click","#successDone",function(e) {
    e.preventDefault();
    location.href = redirect_url;
  });
}

$("#forgetpassword form").submit(function(e)
    {   
      //STOP default action
      e.preventDefault();
      var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        var formid =$(this).attr("id");
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
                  toastr.success(data.responseMessage);  
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              toastr.error(jqXHR.responseJSON.responseMessage); 
            }
        });
    });

// Coupon
function ApplyCoupon(){
  var plan_id = $("#pricing_plans").val();
  var coupon_code = $("#coupon_code").val();
  if(plan_id.length == ''){
    toastr.error('Please select atleast one plan.');  
    return false;
  }else if(plan_id == '1'){
    toastr.error('This plan doesn\'t have any coupons!');  
    return false;
  }else{
      $.ajax(
        {
            url : base_url + '/apply-coupon',
            type: "POST",
            headers: {
              'X-CSRF-Token': csrftoken
            },
            data: {
              "plan_id": plan_id,
              "coupon_code": coupon_code
            },
            success:function(data, textStatus, jqXHR) 
            {
              $(".coupon-success").html(jqXHR.responseJSON.responseMessage);
              $(".coupon-error").html('');
              $("#coupon_code").prop("readonly", true);
              $("#apply_coupon").prop("disabled", true);
              $(".remove-coupon").html('<button class="btn btn-primary d-block w-100" type="button" id="remove_coupon">Remove</button>');
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              $(".coupon-success").html('');
              $(".coupon-error").html(jqXHR.responseJSON.responseMessage);
            }
        });
  }
}

$(document).on('click', '#remove_coupon', function(e) {
  $("#coupon_code").val('');
  $("#coupon_code").prop("readonly", false);
  $("#apply_coupon").prop("disabled", false);
  $(".coupon-success").html('');
  $.ajax(
        {
            url : base_url + '/remove-coupon',
            type: "POST",
            headers: {
              'X-CSRF-Token': csrftoken
            },
            success:function(data, textStatus, jqXHR) 
            {
                $(".remove-coupon").empty();
                $(".coupon-success").html(jqXHR.responseJSON.responseMessage);
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              $(".coupon-error").html(jqXHR.responseJSON.responseMessage);
            }
        });
}); 