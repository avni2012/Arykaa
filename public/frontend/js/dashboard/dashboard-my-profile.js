$(document).ready(function(){
	var input = document.querySelector("#mobile_no");
    window.intlTelInput(input, ({
        initialCountry: "in",
        autoPlaceholder: "polite",
        formatOnDisplay: true,
        separateDialCode: true,
    }));
    $('#date_of_birth').datepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
	    endDate: '+0d'
	});
});

$("#profile_update").submit(function(e)
	  {   
	  	//STOP default action
	  	e.preventDefault();
	  	// var postData = $(this).serializeArray();
	  	var formElem = $("#profile_update");
		var postData = new FormData(formElem[0]);
	  	postData.append('profile_picture', $('#profile_picture')[0].files[0]);
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
	            processData: false,
		        contentType: false,
        		dataType: "json",
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

function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#profile_picture_show').html('<img id="profile_picture_show" src="' + e.target.result + '" class="prev-img-con" alt="Profile">');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
    
$("#profile_picture").change(function(){
    readURL(this);
});
