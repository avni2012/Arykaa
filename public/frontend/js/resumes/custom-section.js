// Add Custom Section
  var custom_section_count = 0;
  $(".add-custom-form").click(function(){
  $("#AddCustomSection").prop('disabled', true);
  $("#CustomSection").css('display','block');
    $.ajax({
        url: "get-custom-section-form/" + custom_section_count,
        dataType: 'html',
        data: {
          r_id: r_id
        },
        success: function (data, textStatus, jqXHR) { 
          var html = JSON.parse(data);
          $("#ShowCustomSectionForm").append(html.html);
          CustomSectionJS(custom_section_count, template_id);
          custom_section_count++;
        },
        error: function(jqXHR, textStatus, errorThrown){
          var error = $.parseJSON(jqXHR.responseText);
          toastr.error(error.responseMessage);
        }
    });
  });

  function CustomSectionJS(custom_count, template_id){

    if(template_id == 22){
        $("#CustomSectionDetails_Text>td").addClass('border-botm');
      }
    var courseCount = $('#CustomSectionDetails_new>tr').length;
    if(courseCount >= 0){
      $(".custom-section").show();
    }
    StartEndDates();
  }

  function DeleteCustomSection(p_id,input) {
    // body...
    var courseCount = $('#CustomSectionDetails_new>tr').length;
    if(courseCount <= 1){
      $(".custom-section").hide();
    }
    if(template_id == 22){
        $("#CustomSectionDetails_Text>td").removeClass('border-botm');
      }
    $('#CustomSectionForm_'+input).remove();
    // $("#EmployeeData_"+input).remove();
    $("#CustomSectionAddMore_section_"+input).remove();
    ajaxCustomSectionDelete(p_id);
  }

  function CustomJobTitle(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var job_title = $(obj).val();
    $("#custom_job_title_"+id).html(job_title);
    $("#CustomSectionHeading__"+id).html(job_title);
    $("#custom_section_heading_"+id).val(job_title);
    if(job_title != ''){
      $("#custom_section_title_"+id).html(job_title);
    }else{
      $("#custom_section_title_"+id).html("Not Specified");
    }
    ajaxCustomSectionSave(id);
      }, 2000);
  }
  function CustomStartDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#custom_startdate_"+id).html(obj.value);
    ajaxCustomSectionSave(id);
      }, 2000);
  }
  function CustomEndDate(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#custom_enddate_"+id).val(obj.value);    
    // $("#custom_enddate_"+id).html(' - ' + obj.value);
    ajaxCustomSectionSave(id);
      }, 2000);
  }
  function CustomSectionCity(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#customsection_city_"+id).html(obj.value);
    ajaxCustomSectionSave(id);
      }, 2000);
  }

  function DeleteCustomForm(){
    $("#CustomSection").css('display','none');
    $("#AddCustomSection").prop('disabled', false);
    $("#ShowCustomSectionForm").empty();
    if(template_id == 22){
        $("#CustomSectionDetails_Text>td").removeClass('border-botm');
      }
    getcustomSectionids(r_id);
  }

  function getcustomSectionids(r_id) {
    $.ajax({
      url: "get-custom-section-ids/" + r_id,
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