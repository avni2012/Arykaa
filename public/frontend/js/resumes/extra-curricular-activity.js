var extra_curricular_activity_count = 0;
$(".add-extra-curricular-activity-form").click(function(){
  $("#AddExtraCurricularActivityForm").prop('disabled', true);
  $("#ExtraCurricularActivitySection").css('display','block');
  $("#ExtraCurricularActivityDetails_Text").show();
  $.ajax({
      url: "get-extra-curricular-activity-form/" + extra_curricular_activity_count,
      dataType: 'html',
      data: {
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) { 
        var html = JSON.parse(data);
        $("#ShowExtraCurricularActivityForm").append(html.html);
        ExtraCurricularActivityJS(extra_curricular_activity_count,template_id);
        extra_curricular_activity_count++;
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

function ExtraCurricularActivityJS(extra_curricular_activity_count,template_id) {
  var activityCount = $('#ExtraCurricularSectionDetails_new>tr').length;
    if(activityCount >= 0){
      $(".activity-section").show();
    }
  StartEndDates();
}

function DeleteExtraCurricularSection(p_id,input) {
    // body...
    var activityCount = $('#ExtraCurricularSectionDetails_new>tr').length;
    if(activityCount <= 1){
      $(".activity-section").hide();
    }
    $('#ExtraCurricularActivityForm_'+input).remove();
    $("#ExtraCurricularAddMore_section_"+input).remove();
    ajaxExtraActivityDelete(p_id);
  }
  var fix_job_title = '';
  function FunctionTitle(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var job_title = $(obj).val();
    fix_job_title = job_title;
    $("#functiontitle_"+id).html(job_title);
    /*if(template_id == "london"){
      if(fix_extra_employer_name != ''){
        $("#functiontitle_"+id).html(job_title+', ');
      }
    }*/
    if(template_id != 21){
      if((fix_job_title != '' || fix_extra_city != '') && fix_extra_employer_name != ''){
        $("#functiontitle_"+id).html(obj.value+', ');
      }else{
        $("#functiontitle_"+id).html(obj.value);
      }
    }
    if(job_title != ''){
      $("#extra_curricular_activity_section_title_"+id).html(job_title);
    }else{
      $("#extra_curricular_activity_section_title_"+id).html("Not Specified");
    }
    ajaxExtraCurricularActivitySave(id);
      }, 2000);
  }
  var fix_extra_employer_name = ''; 
  function ExtraCurricularEmployerName(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var employer_name = $(obj).val(); 
    fix_extra_employer_name = employer_name;
    $("#extra_curricular_employer_name_"+id).html(employer_name);
    /*if(template_id == "london"){
      if(fix_job_title != ''){
        $("#extra_curricular_employer_name_"+id).html(', '+employer_name);
      }
    }*/
    if(template_id != 21){
      if((fix_extra_employer_name != '' || fix_extra_city != '') && fix_job_title != ''){
        $("#extra_curricular_employer_name_"+id).html(', '+obj.value);
      }else{
        $("#extra_curricular_employer_name_"+id).html(obj.value);
      }
    } 
    ajaxExtraCurricularActivitySave(id);
      }, 2000);
  }
  function ExtraCurricularStartDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#extracurricular_startdate_"+id).html(obj.value);
    ajaxExtraCurricularActivitySave(id);
      }, 2000);
  }
  function ExtraCurricularEndDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
        $("#extracurricular_enddate_"+id).val(obj.value);
    // $("#extracurricular_enddate_"+id).html(' - ' + obj.value);
    ajaxExtraCurricularActivitySave(id);
      }, 2000);
  }
  var fix_extra_city = '';
  function ExtraCurricularCity(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    // $("#extracurricular_city_"+id).html(obj.value);
    fix_extra_city = obj.value;
    if(template_id != 21){
        if((fix_extra_employer_name == '' || fix_job_title == '') && fix_emp_city != ''){
          $("#extracurricular_city_"+id).html(obj.value);
        }else{
          $("#extracurricular_city_"+id).html(', '+obj.value);
        }
    }else{
      $("#extracurricular_city_"+id).html(obj.value);
    }
    ajaxExtraCurricularActivitySave(id);
      }, 2000);
  }
  function DeleteExtraCurricularActivity() {
      $("#ExtraCurricularActivitySection").css('display','none');
      $("#AddExtraCurricularActivityForm").prop('disabled', false);
      $("#ShowExtraCurricularActivityForm").empty();
      $(".extra-curricular-add-more-section").remove();
      $("#ExtraCurricularActivityDetails_Text").hide();
      getextraCurricularSectionids(r_id);
  }

  function getextraCurricularSectionids(r_id) {
    $.ajax({
      url: "get-extra-curricular-section-ids/" + r_id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) { 
        saveReloadPDF();
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
    });
  }