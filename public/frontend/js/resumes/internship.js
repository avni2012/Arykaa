var internship_count = 0;
$(".add-internship-form").click(function(){
  $("#AddInternshipForm").prop('disabled', true);
  $("#InternshipSection").css('display','block');
  $.ajax({
      url: "get-internship-form/" + internship_count,
      dataType: 'html',
      data: {
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) { 
        var html = JSON.parse(data);
        $("#ShowInternshipForm").append(html.html);
        InternshipJS(internship_count,template_id);
        internship_count++;
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

function InternshipJS(internship_count,template_id) {
  if(template_id == 22){
    $("#InternshipDetails_Text>td").addClass('border-botm');
  }
  var activityCount = $('#InternshipDetails_new>tr').length;
    if(activityCount >= 0){
      $(".internship-section").show();
  }
  StartEndDates();
}

function DeleteInternshipDetails(p_id,input) {
    // body...
    var activityCount = $('#InternshipDetails_new>tr').length;
    if(activityCount <= 1){
      $(".internship-section").hide();
    }
    if(template_id == 22){
        $("#InternshipDetails_Text>td").removeClass('border-botm');
      }
    $('#InternshipForm_'+input).remove();
    $("#InternshipAddMore_section_"+input).remove();
     ajaxInternshipDelete(p_id);
  }

var fix_job_title = '';
  function InternshipJobTitle(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var job_title = $(obj).val();
    fix_job_title = job_title;
    if(template_id == 22){
      if(fix_internship_employer_name != ''){
        $("#internship_jobtitle_"+id).html(obj.value+', ');
      }else{
        $("#internship_jobtitle_"+id).html(obj.value);
      }
    }else{
      $("#internship_jobtitle_"+id).html(job_title);
    }
    if(job_title != ''){
      $("#internship_section_title_"+id).html(job_title);
    }else{
      $("#internship_section_title_"+id).html("Not Specified");
    }
      ajaxInternshipSave(id);
    }, 2000);
  }
  var fix_internship_employer_name = ''; 
  function InternshipEmployerName(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var employer_name = $(obj).val(); 
    fix_internship_employer_name = employer_name;
    if(template_id == 22){
      if(fix_job_title != ''){
        $("#internship_employer_name_"+id).html(', '+obj.value);
      }else{
        $("#internship_employer_name_"+id).html(obj.value);
      }
    }else{
      $("#internship_employer_name_"+id).html(employer_name);
    }
     ajaxInternshipSave(id);
    }, 2000);
  }
  function InternshipStartDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#internship_startdate_"+id).html(obj.value);
     ajaxInternshipSave(id);
    }, 2000);
  }
  function InternshipEndDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
        $("#internship_enddate_"+id).val(obj.value);
    // $("#internship_enddate_"+id).html(' - ' + obj.value);
     ajaxInternshipSave(id);
    }, 2000);
  }
  function InternshipCity(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#internshipcity_"+id).html(obj.value);
     ajaxInternshipSave(id);
    }, 2000);
  }

function DeleteInternship() {
      $("#InternshipSection").css('display','none');
      $("#AddInternshipForm").prop('disabled', false);
      $("#ShowInternshipForm").empty();
      $("#InternshipDetails_Text").hide();
      getInternshipSectionids(r_id);
  }

function getInternshipSectionids(r_id) {
    $.ajax({
      url: "get-internship-section-ids/" + r_id,
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