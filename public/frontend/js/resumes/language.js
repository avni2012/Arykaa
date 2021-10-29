var language_count = 0;
$(".add-language-form").click(function(){
  $("#AddLanguageForm").prop('disabled', true);
  $("#LanguageSection").css('display','block');
  $.ajax({
      url: "get-language-form/" + language_count,
      dataType: 'html',
      data: {
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) {
        var html = JSON.parse(data);
        $("#ShowLanguageForm").append(html.html); 
        LanguageJS(language_count,template_id);
        language_count++;
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

function LanguageJS(language_index,template_id) {
  
  if(template_id == 22){
    $("#LanguageDetails_Text>td").addClass('border-botm');
  }
  var languageCount = $('#LanguageDetails_new>tr').length;
    if(languageCount >= 0){
      $(".language-section").show();
    }
  var language_level = '';
  $('#language_level_'+language_index).on('change', function() {
    clearTimeout(time);
      time = setTimeout(function() {
    language_level = this.value;
    if(language_title != ''){
      $("#languageLevel_"+language_index).html(this.value);
    }else{
       $("#languageLevel_"+language_index).html('');
    }
     ajaxLanguageSave();
      }, 2000);
  });
}

var language_title = '';
function LanguageTitle(obj,id){
  clearTimeout(time);
      time = setTimeout(function() {
    var language = $(obj).val();
    language_title = language;
    var language_id = id;
    if(language != ''){
      $("#language_section_title_"+id).html(language);
      $("#languageTitle_"+id).html(language);
    }else{
      $("#language_section_title_"+id).html("Not Specified");
      $("#languageTitle_"+id).html(language);
      $("#languageLevel_"+id).html('');
    }
     ajaxLanguageSave(id);
      }, 2000);
  }

function DeleteLanguage() {
      $("#LanguageSection").css('display','none');
      $("#AddLanguageForm").prop('disabled', false);
      $("#ShowLanguageForm").empty();
      if(template_id == 22){
        $("#LanguageDetails_Text>td").removeClass('border-botm');
      }
      var languageCount = $('#LanguageDetails_new>tr').length;
      if(languageCount <= 1){
        $(".language-section").hide();
      }
      getLanguageSectionids(r_id);
  }

function DeleteLanguageDetails(p_id,input){
  $("#LanguageForm_"+input).remove();
  $("#LanguageAddMore_section_"+input).remove();
  ajaxLanguageDelete(p_id);
}

function getLanguageSectionids(r_id) {
    $.ajax({
      url: "get-language-section-ids/" + r_id,
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

