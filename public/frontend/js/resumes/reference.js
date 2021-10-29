var reference_count = 0;
$(".add-reference-form").click(function(){
  $("#AddReferenceForm").prop('disabled', true);
  $("#ReferenceSection").css('display','block');
  $("#ReferenceDetails_Text").show();
  $.ajax({
      url: "get-reference-form/" + reference_count,
      dataType: 'html',
      data: {
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) { 
        var html = JSON.parse(data);
        $("#ShowReferenceForm").append(html.html); 
        ReferenceJS(reference_count,template_id);
        reference_count++;
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

function ReferenceJS(reference_index,$template_id){
  if(template_id == 22){
        $("#ReferenceDetails_Text>td").addClass('border-botm');
      }
  var courseCount = $('#ReferenceDetails_new>tr').length;
    if(courseCount >= 0){
      $(".reference-section").show();
    }

  /*var reference_add_more_count = reference_index;
  $.ajax({
    url: "get-reference-add-more-section/" + reference_add_more_count + '/' + template_id,
    dataType: 'html',
    success: function (data, textStatus, jqXHR) { 
      $("#ReferenceDetails_new").append(data);
      reference_add_more_count++;
    },
    error: function(jqXHR, textStatus, errorThrown){
      var error = $.parseJSON(jqXHR.responseText);
      toastr.error(error.responseMessage);
    }
  });*/
  if($("#ReferencecustomSwitches").is(":checked"))
  {
      $("#ReferencePresentLabel").val('1');
  }
  
  $("#ReferencecustomSwitches").change(function() 
  { 
    if(this.checked) { 
      clearTimeout(time);
      time = setTimeout(function() {
      $(".referenceDetail").hide();
      $("#hideReference").empty();
      $("#hideReference").html('References available upon request');
      $("#ReferencePresentLabel").val('1');
      ajaxReferenceSave();
      }, 2000);
    }else{ 
      clearTimeout(time);
      time = setTimeout(function() {
      $(".referenceDetail").show();
      $("#hideReference").html('');
      $("#ReferencePresentLabel").val('0');
      ajaxReferenceSave();
      }, 2000);
    }
  });
}

function DeleteReferenceDetails(p_id,input) {
    // body...
    var referenceCount = $('#ReferenceDetails_new>tr').length;
    if(referenceCount <= 1){
      $(".reference-section").hide();
    }
    if(template_id == 22){
        $("#ReferenceDetails_Text>td").removeClass('border-botm');
      }
    $('#ReferenceForm_'+input).remove();
    $("#ReferenceAddMore_section_"+input).remove();
    ajaxReferenceDelete(p_id);
  }

  var fix_reference_name = '';
  function ReferentName(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var reference_name = $(obj).val();
    fix_reference_name = reference_name;
    $("#referentname_"+id).html(reference_name);
    if(template_id == 22){
      if(fix_reference_company != '' && reference_name != ''){
        $("#referentname_"+id).html(reference_name+ ' from ');
      }
    }
    if(reference_name != ''){
      $("#reference_section_title_"+id).html(reference_name);
    }else{
      $("#reference_section_title_"+id).html("Not Specified");
    }
    ajaxReferenceSave(id);
      }, 2000);
  }

  var fix_reference_company = '';
  function ReferenceCompany(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    var reference_company = $(obj).val(); 
    fix_reference_company = reference_company;
    $("#referencecompany_"+id).html(reference_company);
     if(template_id == 22){
      if(fix_reference_name != '' && reference_company != ''){
        $("#referencecompany_"+id).html(' from '+reference_company);
      }
    }
    ajaxReferenceSave(id);
      }, 2000);
  }

  function ReferentPhone(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#referentphone_"+id).html(' . ' + obj.value);
    ajaxReferenceSave(id);
      }, 2000);
  }

  function ReferentEmail(obj,id){
    clearTimeout(time);
      time = setTimeout(function() {
    $("#referentemail_"+id).html(obj.value);
    ajaxReferenceSave(id);
      }, 2000);
  }

  function DeleteReference() {
      $("#ReferenceSection").css('display','none');
      $("#AddReferenceForm").prop('disabled', false);
      $("#ShowReferenceForm").empty();
      // $(".reference-section").remove();
      $("#ReferenceDetails_Text").hide();
      getreferenceSectionids(r_id);
  }

  function getreferenceSectionids(r_id) {
    $.ajax({
      url: "get-reference-section-ids/" + r_id,
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