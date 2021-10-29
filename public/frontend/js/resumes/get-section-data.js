$(document).ready(function(){
        loadTemplate(r_id);
        getAllSectionData();
    });
    function loadTemplate(template_id){
        $.ajax({
          url: "get-sample-template/" + r_id,
          dataType: 'html',
          success: function (data, textStatus, jqXHR) { 
            $("#select_frame").html(data);
            $("#MainHeading").hide();
            $(".skill-section").hide();
          },
          error: function(jqXHR, textStatus, errorThrown){
            toastr.error(jqXHR.responseJSON.responseMessage);
          }
        });
    }

function getAllSectionData(){
  if(employment_details !== '[]' && employment_details !== 0){
                $.ajax({
                  url: 'get-employer-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowEmployerForm").append(data);
                    EmploymentJs(employment_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
  }
  if(education_details !== '[]' && education_details !== 0){
            $.ajax({
                  url: 'get-education-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowEducationForm").append(data);
                    EducationJS(education_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(website_links !== '[]' && website_links !== 0){
            $.ajax({
                  url: 'get-website-and-social-link-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowWebsiteAndSocialLinkForm").append(data);
                    WebsiteSocialLinkJS(website_social_link_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(skill_details !== '[]' && skill_details !== 0){
            $.ajax({
                  url: 'get-skill-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowSkillsForm").append(data);
                    SkillsJS(skills_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(custom_details !== '[]' && custom_details !== 0){
            $.ajax({
                  url: 'get-custom-section-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowCustomSectionForm").append(data);
                    $("#AddCustomSection").prop('disabled', true);
                    $("#CustomSection").css('display','block');
                    CustomSectionJS(custom_section_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(internship_details !== '[]' && internship_details !== 0){
           $.ajax({
                  url: 'get-internship-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowInternshipForm").append(data);
                    $("#AddInternshipForm").prop('disabled', true);
                    $("#InternshipSection").css('display','block');
                    InternshipJS(internship_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(course_details !== '[]' && course_details !== 0){
            $.ajax({
                  url: 'get-course-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowCoursesForm").append(data);
                    $("#AddCoursesForm").prop('disabled', true);
                    $("#CourseSection").css('display','block');
                    CourseJS(course_link_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(extra_activity_details !== '[]' && extra_activity_details !== 0){
    $.ajax({
                  url: 'get-extra-curricular-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowExtraCurricularActivityForm").append(data);
                    $("#AddExtraCurricularActivityForm").prop('disabled', true);
                    $("#ExtraCurricularActivitySection").css('display','block');
                    ExtraCurricularActivityJS(extra_curricular_activity_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });          
  }
  if(hobbies != 'null' && hobbies != null && hobbies != ''){
          var hobby = JSON.parse(hobbies);
          $.ajax({
                  url: 'get-hobbies-form/' + r_id,
                  data: { 
                    hobbies: hobby.uh_hobby
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#HobbiesSection").show(); 
                    $("#AddHobbiesForm").prop('disabled', true);
                    $("#ShowHobbiesForm").append(data);
                    HobbiesJS(r_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
  if(language_details !== 0){
          $.ajax({
                  url: 'get-language-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowLanguageForm").append(data);
                    $("#AddLanguageForm").prop('disabled', true);
                    $("#LanguageSection").css('display','block');
                    LanguageJS(language_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });          
  }
  if(reference_details !== 0){
      $.ajax({
                  url: 'get-reference-data/' + r_id,
                  data: { 
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#ShowReferenceForm").append(data);
                    $("#AddReferenceForm").prop('disabled', true);
                    $("#ReferenceSection").css('display','block');
                    ReferenceJS(reference_count,template_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });          
  }
}
/*function getAllSectionData() {
  if(employment_details !== 0){
            $.each(JSON.parse(employment_details), function(key,value){
                $.ajax({
                  url: 'get-employer-form/' + key,
                  data: { 
                    employment_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    var html = JSON.parse(data);
                    $("#ShowEmployerForm").append(html.html);
                    EmploymentJs(key,template_id);
                    if(typeof employment_count != 'undefined'){
                      employment_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(education_details !== 0){
            $.each(JSON.parse(education_details), function(key,value){
                $.ajax({
                  url: 'get-education-form/' + key,
                  data: { 
                    education_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowEducationForm").append(html.html);
                    EducationJS(key,template_id);
                    if(typeof education_count != 'undefined'){
                      education_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(website_links !== 0){
            $.each(JSON.parse(website_links), function(key,value){
                $.ajax({
                  url: 'get-website-and-social-link-form/' + key,
                  data: { 
                    website_links: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowWebsiteAndSocialLinkForm").append(html.html);
                    WebsiteSocialLinkJS(key,template_id);
                    if(typeof website_social_link_count != 'undefined'){
                      website_social_link_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(skill_details !== 0){
            $.each(JSON.parse(skill_details), function(key,value){
                $.ajax({
                  url: 'get-skill-form/' + key,
                  data: { 
                    skill_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    var html = JSON.parse(data);
                    $("#ShowSkillsForm").append(html.html); 
                    SkillsJS(key,template_id);
                    if(typeof skills_count != 'undefined'){
                      skills_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(hobbies != 'null' && hobbies != null && hobbies != ''){
          var hobby = JSON.parse(hobbies);
          $.ajax({
                  url: 'get-hobbies-form/' + r_id,
                  data: { 
                    hobbies: hobby.uh_hobby
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#HobbiesSection").show(); 
                    $("#AddHobbiesForm").prop('disabled', true);
                    $("#ShowHobbiesForm").append(data);
                    HobbiesJS(r_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }
        /*console.log(hobbies);
        if(hobbies != '' && hobbies != null){
          var hobby = JSON.parse(hobbies); 
          console.log(hobby);
          if(typeof hobbies[0] !== 'undefined'){
            var hb = hobby[0].uh_hobby;
          }
                $.ajax({
                  url: 'get-hobbies-form/' + r_id,
                  data: { 
                    hobbies: hb
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) {
                    $("#HobbiesSection").show(); 
                    $("#AddHobbiesForm").prop('disabled', true);
                    $("#ShowHobbiesForm").append(data);
                    HobbiesJS(r_id);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
        }*/
        /*----------------if(custom_details !== 0){
            $.each(JSON.parse(custom_details), function(key,value){
                $.ajax({
                  url: 'get-custom-section-form/' + key,
                  data: { 
                    custom_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowCustomSectionForm").append(html.html);
                    $("#AddCustomSection").prop('disabled', true);
                    $("#CustomSection").css('display','block');
                    CustomSectionJS(key,template_id);
                    if(typeof custom_section_count != 'undefined'){
                      custom_section_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(internship_details !== 0){
            $.each(JSON.parse(internship_details), function(key,value){
                $.ajax({
                  url: 'get-internship-form/' + key,
                  data: { 
                    internship_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowInternshipForm").append(html.html);
                    $("#AddInternshipForm").prop('disabled', true);
                    $("#InternshipSection").css('display','block');
                    InternshipJS(key,template_id);
                    if(typeof internship_count != 'undefined'){
                      internship_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(course_details !== 0){
            $.each(JSON.parse(course_details), function(key,value){
                $.ajax({
                  url: 'get-course-form/' + key,
                  data: { 
                    course_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowCoursesForm").append(html.html);
                    $("#AddCoursesForm").prop('disabled', true);
                    $("#CourseSection").css('display','block');
                    CourseJS(key,template_id);
                    if(typeof course_link_count != 'undefined'){
                      course_link_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(extra_activity_details !== 0){
            $.each(JSON.parse(extra_activity_details), function(key,value){
                $.ajax({
                  url: 'get-extra-curricular-activity-form/' + key,
                  data: { 
                    extra_activity_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowExtraCurricularActivityForm").append(html.html);
                    $("#AddExtraCurricularActivityForm").prop('disabled', true);
                    $("#ExtraCurricularActivitySection").css('display','block');
                    ExtraCurricularActivityJS(key,template_id);
                    if(typeof extra_curricular_activity_count != 'undefined'){
                      extra_curricular_activity_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(language_details !== 0){
            $.each(JSON.parse(language_details), function(key,value){
                $.ajax({
                  url: 'get-language-form/' + key,
                  data: { 
                    language_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowLanguageForm").append(html.html);
                    $("#AddLanguageForm").prop('disabled', true);
                    $("#LanguageSection").css('display','block');
                    LanguageJS(key,template_id);
                    if(typeof language_count != 'undefined'){
                      language_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
        if(reference_details !== 0){
            $.each(JSON.parse(reference_details), function(key,value){
                $.ajax({
                  url: 'get-reference-form/' + key,
                  data: { 
                    reference_details: value,
                    template : template_id
                  },
                  dataType: 'html',
                  success: function (data, textStatus, jqXHR) { 
                    var html = JSON.parse(data);
                    $("#ShowReferenceForm").append(html.html);
                    $("#AddReferenceForm").prop('disabled', true);
                    $("#ReferenceSection").css('display','block');
                    ReferenceJS(key,template_id);
                    if(typeof reference_count != 'undefined'){
                      reference_count++;
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    console.log(jqXHR);
                  }
                });
            });
        }
}*/