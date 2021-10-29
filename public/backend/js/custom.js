$(document).ready(function(){
	
	$('.one_time').hide();
	$('.recurring').hide();

	$( ".free_label" ).click(function() {
		$('.one_time').hide();
		$('.recurring').hide();
	});
	$( ".one_time_label" ).click(function() {
	  $('.one_time').show();
	  $('.recurring').hide();
	});
	$( ".recurring_label" ).click(function() {
	  $('.one_time').hide();
	  $('.recurring').show();
	});

	$('.toggle_active_inactive .inactive').css('visibility','hidden');
	$('.toggle_active_inactive input[type="checkbox"]').click(function(){
        if($(this).prop("checked") == true){
            console.log("Checkbox is checked.");
            $('.toggle_active_inactive .active').css('visibility','visible');
            $('.toggle_active_inactive .inactive').css('visibility','hidden');
        }
        else if($(this).prop("checked") == false){
            console.log("Checkbox is unchecked.");
            $('.toggle_active_inactive .inactive').css('visibility','visible');
            $('.toggle_active_inactive .active').css('visibility','hidden');
        }
    });	

    $("form").on("change", ".file-upload-field", function(){ 
    	$(this).parent(".file-upload-wrapper").attr("data-text",$(this).val().replace(/.*(\/|\\)/, '') );
	});
})