$("#AddHobbiesForm").click(function(){
  $("#AddHobbiesForm").prop('disabled', true);
  $("#HobbiesSection").css('display','block');
  $.ajax({
      url: "get-hobbies-form/" + template_id,
      dataType: 'html',
      data:{
        r_id: r_id
      },
      success: function (data, textStatus, jqXHR) { 
        $('#ShowHobbiesForm').append(data);
        HobbiesJS(template_id);
      },
      error: function(jqXHR, textStatus, errorThrown){
        var error = $.parseJSON(jqXHR.responseText);
        toastr.error(error.responseMessage);
      }
  });
});

  function HobbiesJS(template_id) {
      $(".hobbies-section").show();
      if(template_id == 22){
        $("#HobbiesSection>td").addClass('border-botm');
      }
      $('#hobbies').on('input', function() {
        clearTimeout(time);
     time = setTimeout(function() {
      text = $('#hobbies').val();
      $('#Hobbies_Text').html(text);
      ajaxHobbySave();
    }, 2000);
    });
  }

 function DeleteHobbies() {
      $(".hobbies-section").hide(); 
      $("#HobbiesSection").css('display','none');
      $("#AddHobbiesForm").prop('disabled', false);
      $("#ShowHobbiesForm").empty();
      if(template_id == 22){
      $("#HobbiesSection>td").removeClass('border-botm');
      }
      $("#Hobbies_Text").empty();
      getHobbiesSectionids(r_id);
  }

  function getHobbiesSectionids(r_id) {
    $.ajax({
      url: "get-hobby-section-ids/" + r_id,
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