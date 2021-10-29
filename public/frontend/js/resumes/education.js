function EducationJS(education_index,template_id) {
  var educationCount = $('#EducationDetails_new>tr>td').length;
  if(educationCount >= 0){
    $(".education-section").show();
  }
  StartEndDates();
}

function DeleteEducation(p_id,input){
  if(template_id == 22){
    var educationCount = $('#EducationDetails_new>tr').length;
    if(educationCount <= 1){
      $(".education-section").hide();
    }
  }else{
    var educationCount = $('#EducationDetails_new td').length;
    if(educationCount <= 1){
      $(".education-section").hide();
    }
  }
  $("#EducationForm_"+input).remove();
  $("#EducationData_"+input).remove();
  $("#EducationAddMore_section_"+input).remove();
  ajaxEducationDelete(p_id);
}
var fix_education_school = '';
function EducationSchool(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
  var education_school = $(obj).val();
  fix_education_school = education_school;
  $("#educationSchool_"+id).html(education_school);
  if(template_id == 22){
    if(fix_education_degree != ''){
      $("#educationSchool_"+id).html(', '+education_school);
    }
  }
  if(education_school != ''){
    $("#education_section_title_"+id).html(education_school);
  }else{
    $("#education_section_title_"+id).html("Not Specified");
  }
  ajaxEducationSave(id);
      }, 2000);
}
var fix_education_degree = '';
function EducationDegree(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
  var education_degree = $(obj).val(); 
  fix_education_degree = education_degree;
  $("#educationDegree_"+id).html(education_degree);
  if(template_id == 22){
    if(fix_education_school != ''){
      $("#educationDegree_"+id).html(education_degree+', ');
    }
  }
  ajaxEducationSave(id);
      }, 2000);
}
function EducationStartDate(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
  $("#educationStartDate_"+id).html(obj.value);
  ajaxEducationSave(id);
      }, 2000);
}
function EducationEndDate(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
        $("#education_enddate_"+id).val(obj.value);
  $("#educationEndDate_"+id).html(' - ' + obj.value);
  ajaxEducationSave(id);
      }, 2000);
}
function EducationCity(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
  $("#educationCity_"+id).html(obj.value);
  ajaxEducationSave(id);
      }, 2000);
}