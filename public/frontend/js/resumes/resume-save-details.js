let time = 0;
$('#job_title, #first_name, #last_name, #email, #phone, #country, #city, #address, #postal_code, #driving_licence, #nationality, #place_of_birth, #date_of_birth, #ResumeMainTitle, #resume_variation').on('input', function() {
     clearTimeout(time);
     time = setTimeout(function() {
	  /// Personal Details show in right section
	  var job_title = $('#job_title').val();
	  var first_name = $('#first_name').val();
	  var last_name = $('#last_name').val();
	  var fullname = $('#fullname').val();
	  var email = $('#email').val();
	  var phone = $('#phone').val();
	  var country = $("#country").val();
	  var city = $("#city").val();
	  var address = $("#address").val();
	  var postal_code = $("#postal_code").val();
	  var driving_licence = $("#driving_licence").val();
	  var nationality = $("#nationality").val();
	  var place_of_birth = $("#place_of_birth").val();
	  var date_of_birth = $("#date_of_birth").val();
	  var main_title = $("#ResumeMainTitle").val();
	  var first_name_bottom = $("#FirstNameBottom_Text").val();
	  var resume_variation = $("#resume_variation").val();
	  $("#MainHeading").show();
	  $('#JobTitle_Text').html(job_title);
	  $('#FirstName_Text').html(first_name);
	  $('#LastName_Text').html(last_name);
	  if(job_title.length == 0 && fullname == 0){
	    $('#MainHeading').hide();
	  }else{
	    $("#MainHeading").show();
	  }
	  $('#Email_Text').html(email);
	  $('#ContactNumber_Text').html(phone);
	  $('#CountryName_Text').html(country);
	  $('#CityName_Text').html(city);
	  $('#Address_Text').html(address);
	  $('#PostalCode_Text').html(postal_code);
	  $('#DrivingLicence_Text').html(driving_licence);
	  $('#Nationality_Text').html(nationality);
	  $('#PlaceOfBirth_Text').html(place_of_birth);
	  $('#DateOfBirth_Text').html(date_of_birth);
	  $('#ResumeMainTitle_Text').html(main_title);
	  $('#FirstNameBottom_Text').html(first_name_bottom);
	  $('#ResumeVariation').html(resume_variation);

	  $('.resume-user-name').html(first_name + ' ' + last_name);
	  $('.resume-user-email').html(email);
	  $('.resume-user-mobile').html(phone);

	  	if(template_id == 17){
		    if(email != '' || address != '' || postal_code != '' || city != '' || country != '' || phone != ''){
		      $("#Extra_Details").show();
		      $(".tokyo-extra-details").addClass('cont-det');
		    }else{
		      $("#Extra_Details").hide();
		      $(".tokyo-extra-details").removeClass('cont-det');
		    }
		    text = [address, city, country, postal_code].filter(Boolean).join(", ");
		    if(text != ''){
		      $("#ExtraDetails").html('<img src="' + base_url + '/frontend/images/resume_templates/tokyo-images/tokyo-locationl.png"/> ' +text);
		      $(".address-text").html(address);
		      $(".city-name").html(city);
		      $(".postal-code").html(postal_code);
		      $(".country-name").html(country);
		    }else{
		      $("#ExtraDetails").html('');
		      $(".address-text").html('');
		      $(".city-name").html('');
		      $(".country-name").html('');
		      $(".postal-code").html('');
		    }
		    /*if(email != ''){
		      $('#Email_Text').html('<a href="mailto:someone@example.com"><img src="' + base_url + '/frontend/images/resume_templates/tokyo-images/tokyo-mail.png"/> ' +email+ '</a>');
		      $(".email-text").html(email);
		    }else{
		      $('#Email_Text').html('');
		      $(".email-text").html('');
		    }*/
		    if(phone != ''){
		      $('#ContactNumber_Text').html('<img src="' + base_url + '/frontend/images/resume_templates/tokyo-images/tokyo-calll.png"/> ' +phone);
		      $(".contact-number").html(phone);
		    }else{
		      $('#ContactNumber_Text').html('');
		      $(".contact-number").html('');
		    }
		    if(date_of_birth != '' || place_of_birth != ''){
		      $(".date-place-of-birth").show();
		    }else{
		      $(".date-place-of-birth").hide();
		    }
  		}
	    ajaxSave();
     }, 2000);
});

CKEDITOR.replace('professional_summary', {
    height: 150
  });
var editor = CKEDITOR.instances['professional_summary'];
CKEDITOR.instances.professional_summary.on('change', function() { 
	clearTimeout(time);
    time = setTimeout(function() {
	    professional_summary_data = editor.getData();
	    $("#ProfileSummary").show();
	    $("#ProfessionalSummary_Text").html(professional_summary_data);
	    if(professional_summary_data === ''){
	      $('#ProfileSummary').hide();  
	    }
	    if(template_id == 22){
	      if(professional_summary_data !== ''){
	        $('.profile-summary').addClass('border-botm');  
	      }else{
	        $('.profile-summary').removeClass('border-botm'); 
	      }
	    }
	    ajaxSave();
    }, 2000);
});

function ajaxSave(){
	  var job_title = $('#job_title').val();
	  var fullname = $('#fullname').val();
	  var email = $('#email').val();
	  var phone = $('#phone').val();
	  var country = $("#country").val();
	  var city = $("#city").val();
	  var address = $("#address").val();
	  var postal_code = $("#postal_code").val();
	  var driving_licence = $("#driving_licence").val();
	  var nationality = $("#nationality").val();
	  var place_of_birth = $("#place_of_birth").val();
	  var date_of_birth = $("#date_of_birth").val();
	  var main_title = $("#ResumeMainTitle").val();
	  var first_name_bottom = $("#FirstNameBottom_Text").val();
	  var resume_variation = $("#resume_variation").val();
	  var professional_summary = CKEDITOR.instances.professional_summary.getData();
	$.ajax(
	        {
	            url : base_url + '/store-user-resume-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	            	job_title: job_title,
	            	template_id: template_id,
	            	fullname: fullname,
	            	email: email,
	            	phone: phone,
	            	country: country,
	            	city: city,
	            	address: address,
	            	postal_code: postal_code,
	            	driving_licence: driving_licence,
	            	nationality: nationality,
	            	place_of_birth: place_of_birth,
	            	date_of_birth: date_of_birth,
	            	main_title: main_title,
	            	first_name_bottom: first_name_bottom,
	            	professional_summary: professional_summary,
	            	resume_id: r_id,
	            	resume_variation: resume_variation
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              console.log(jqXHR);
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxEmploymentSave(id){
	var employment = [];
	$.each($("#employment_form").serializeArray(), function(key,value){
		
		if(value.name.indexOf('employment_description')>=0){
			var id = $('[name="'+value.name+'"]').attr('id');
			var desc = CKEDITOR.instances[id];
			var text = desc.getData();
			employment.push({ 
				"name" : value.name,
				"value": text
			});
		}else{
			employment.push(value);	
		}
	});
	var employment_data = $.param(employment);
	$.ajax(
	        {
	            url : base_url + '/store-user-career-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             employment_data: employment_data,
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#EmployerDelete_"+id).attr("onclick", 'DeleteEmployer("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              console.log(jqXHR);
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxEducationSave(id){
	var education = [];
	$.each($("#education_form").serializeArray(), function(key,value){
		
		if(value.name.indexOf('education_description')>=0){
			var id = $('[name="'+value.name+'"]').attr('id');
			var desc = CKEDITOR.instances[id];
			var text = desc.getData();
			education.push({ 
				"name" : value.name,
				"value": text
			});
		}else{
			education.push(value);	
		}
	});
	var education_data = $.param(education);
	$.ajax(
	        {
	            url : base_url + '/store-user-education-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             education_data: education_data,
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#EducationDelete"+id).attr("onclick", 'DeleteEducation("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF(data);
				},
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxWebsiteSocialLinkSave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-website-social-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             website_social_link_data: $('#website_social_link_form').serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#WebsiteSocialLinkDelete"+id).attr("onclick", 'DeleteWebsiteSocialLink("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxSkillsSave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-skill-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             skill_data: $('.skill_form').serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {

	            	$("#SkillDelete"+id).attr("onclick", 'DeleteSkill("' + data.data.id+ '","' + id + '","' + data.data.us_skill + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxHobbySave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-hobby',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             hobby_data: $('#hobby_form').serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#EducationDelete"+id).attr("onclick", 'DeleteEducation("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}
function ajaxCustomSectionSave(id){
	var custom = [];
	$.each($("#custom_section_form").serializeArray(), function(key,value){
		if(value.name.indexOf('custom_description')>=0){
			var id = $('[name="'+value.name+'"]').attr('id');
			var desc = CKEDITOR.instances[id];
			var text = desc.getData();
			custom.push({ 
				"name" : value.name,
				"value": text
			});
		}else{
			custom.push(value);	
		}
	});
	var custom_data = $.param(custom);
	$.ajax(
	        {
	            url : base_url + '/store-user-custom-section-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             custom_data: custom_data,
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	/*$("#CustomSectionDelete_"+id).attr("onclick", 'DeleteCustomSection("' + data.data.id+ '","' + id + '")');*/
	            	// $("#CustomSectionDelete_"+id).attr("data-id",data.data.id);
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxInternshipSave(id){
	var internship = [];
	$.each($("#internship_form").serializeArray(), function(key,value){
		
		if(value.name.indexOf('internship_description')>=0){
			var id = $('[name="'+value.name+'"]').attr('id');
			var desc = CKEDITOR.instances[id];
			var text = desc.getData();
			internship.push({ 
				"name" : value.name,
				"value": text
			});
		}else{
			internship.push(value);	
		}
	});
	var internship_data = $.param(internship);
	$.ajax(
	        {
	            url : base_url + '/store-user-internship-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             internship_data: internship_data,
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#InternshipDelete_"+id).attr("onclick", 'DeleteInternshipDetails("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxCourseSave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-course-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             course_data: $("#course_form").serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#CourseDelete_"+id).attr("onclick", 'DeleteCourse("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF(data);
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxExtraCurricularActivitySave(id){
	var extra_activity = [];
	$.each($("#extra_curricular_form").serializeArray(), function(key,value){
		
		if(value.name.indexOf('extra_curricular_description')>=0){
			var id = $('[name="'+value.name+'"]').attr('id');
			var desc = CKEDITOR.instances[id];
			var text = desc.getData();
			extra_activity.push({ 
				"name" : value.name,
				"value": text
			});
		}else{
			extra_activity.push(value);	
		}
	});
	var extra_activity_data = $.param(extra_activity);
	$.ajax(
	        {
	            url : base_url + '/store-user-extra-curricular-activity-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             extra_activity_data: extra_activity_data,
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#ExtraCurricularSectionDelete_"+id).attr("onclick", 'DeleteExtraCurricularSection("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxLanguageSave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-language-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             language_data: $('#language_form').serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#LanguageDelete_"+id).attr("onclick", 'DeleteLanguageDetails("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF(data);
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxReferenceSave(id){
	$.ajax(
	        {
	            url : base_url + '/store-user-reference-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data : {
	             reference_data: $('#reference_form').serialize(),
	             template_id: template_id,
	             r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$("#ReferenceDelete_"+id).attr("onclick", 'DeleteReferenceDetails("' + data.data.id+ '","' + id + '")');
	            	saveReloadPDF(data);
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxEmploymentDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-career-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxEducationDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-education-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxWebsiteLinksDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-website-links-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxSkillDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-skill-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxCustomSectionDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-custom-section-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxCourseDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-course-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxExtraActivityDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-extra-activity-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxInternshipDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-internship-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxHobbyDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-hobbies-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxLanguageDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-language-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ajaxReferenceDelete(p_id){
	$.ajax(
	        {
	            url : base_url + '/delete-user-reference-data',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	p_id: p_id,
	            	r_id: r_id
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function ChangeColorCode(id, color){
	$.ajax(
	        {
	            url : base_url + '/change-resume-color',
	            type: "POST",
	            headers: {
	              'X-CSRF-Token': csrftoken
	            },
	            data: {
	            	'resume_id': id,
	            	'color': color
	            },
	            success:function(data, textStatus, jqXHR) 
	            {
	            	$(".resume-color-codes").load(location.href + " .resume-color-codes");
	            	saveReloadPDF();
	            },
	            error: function(jqXHR, textStatus, errorThrown) 
	            {
	              toastr.error(jqXHR.responseJSON.responseMessage);
	            }
	        });
}

function saveReloadPDF(){
	/*$.getScript(base_url + "/frontend/js/pdf-view.js", function() {
		$("#my_pdf_viewer").html();
	});*/
	loadPDF();
}
