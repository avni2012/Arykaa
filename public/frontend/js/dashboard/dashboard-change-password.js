$("#user_change_password").submit(function(e)
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
		        data : postData,
		        success:function(data, textStatus, jqXHR) 
		        {
		          	toastr.success(jqXHR.responseJSON.responseMessage);
		          	window.setTimeout(function(){
	        			location.href = data.redirect_url;
				    }, 2000);
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		          	toastr.error(jqXHR.responseJSON.responseMessage);
		        }
	      });
	  }); 