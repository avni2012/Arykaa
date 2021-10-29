function EmploymentJs(index,template_id){
  var employerCount = $('#EmployerDetails_new>tr').length;
    if(employerCount >= 0){
      $(".employment-section").show();
    }
  StartEndDates();
}

  function DeleteEmployer(p_id,emp_count) {
    // body...
    var employerCount = $('#EmployerDetails_new>tr').length;
    if(employerCount <= 1){
      $(".employment-section").hide();
    }
    $('#EmploymentForm_'+emp_count).remove();
    $("#EmployeeData_"+emp_count).remove();
    $("#EmployerAddMore_section_"+emp_count).remove();
    ajaxEmploymentDelete(p_id);
  }

  var fix_job_title = '';
  function EmployerJobTitle(obj,id){
    clearTimeout(time);
    time = setTimeout(function() {
    fix_job_title = obj.value;
    $("#job_title_"+id).html(obj.value);
    if(template_id != 21){
      if((fix_job_title != '' || fix_emp_city != '') && fix_employer_name != ''){
        $("#job_title_"+id).html(obj.value+', ');
      }else{
        $("#job_title_"+id).html(obj.value);
      }
    }
    if(obj.value != ''){
      $("#employment_section_title_"+id).html(obj.value);
    }else{
      $("#employment_section_title_"+id).html("Not Specified");
    }
      ajaxEmploymentSave(id);
      // ajaxEmploymentSave();
    }, 2000);
  } 
  var fix_employer_name = '';
  function EmployerName(obj,id){
    clearTimeout(time);
    time = setTimeout(function() {
    fix_employer_name = obj.value;
    $("#employer_name_"+id).html(obj.value);
    if(template_id != 21){
      if((fix_employer_name != '' || fix_emp_city != '') && fix_job_title != ''){
        $("#employer_name_"+id).html(', '+obj.value);
      }else{
        $("#employer_name_"+id).html(obj.value);
      }
    } 
      ajaxEmploymentSave(id);
    }, 2000);
  }
  function EmployerStartDate(obj,id){
    clearTimeout(time);
    time = setTimeout(function() {
    $("#employer_startdate_"+id).html(obj.value);
      ajaxEmploymentSave(id);
    }, 2000);
  }
  function EmployerEndDate(obj,id){
    clearTimeout(time);
    time = setTimeout(function() {
    $("#employer_enddate_"+id).val(obj.value);
    // $("#employer_enddate_"+id).html(' - ' + obj.value);
      ajaxEmploymentSave(id);
    }, 2000);
  }
  var fix_emp_city = '';
  function EmployerCity(obj,id){
    clearTimeout(time);
    time = setTimeout(function() {
    fix_emp_city = obj.value;
    if(template_id != 21){
        if((fix_employer_name == '' || fix_job_title == '') && fix_emp_city != ''){
          $("#employercity_"+id).html(obj.value);
        }else{
          $("#employercity_"+id).html(', '+obj.value);
        }
    }else{
      $("#employercity_"+id).html(obj.value);
    }
      ajaxEmploymentSave(id);
    }, 2000);
  }