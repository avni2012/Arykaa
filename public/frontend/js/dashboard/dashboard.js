function deleteResume(id){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover resume!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
          $.ajax(
              {
                  url : base_url+ '/delete-resume-builder/' + id,
                  type: 'POST',
                  data : {"_token":csrftoken},  
                  success:function(data, textStatus, jqXHR) 
                  {
                      toastr.success(jqXHR.responseJSON.responseMessage);
                      location.href = data.redirect_url;
                  },
                  error: function(jqXHR, textStatus, errorThrown) 
                  {
                      //if fails
                      toastr.error(jqXHR.responseJSON.responseMessage);
                  }
              });
      }
    });
  }

let time = 0;
function changeResumeTitle(id){
    $("#ResumeMainTitle_"+id).select();
    $('#ResumeMainTitle_'+id).focus();
    $('#ResumeMainTitle_'+id).on('input', function() {
      var resume_title = $('#ResumeMainTitle_'+id).val();
      clearTimeout(time);
      time = setTimeout(function() {
        $.ajax(
              {
                  url : base_url+ '/change-resume-title',
                  type: 'POST',
                  headers: {
                    'X-CSRF-TOKEN': csrftoken
                  },
                  data: {
                    'resume_id': id,
                    'resume_title': resume_title
                  },  
                  success:function(data, textStatus, jqXHR) 
                  {
                      toastr.success(jqXHR.responseJSON.responseMessage);
                      location.href = data.redirect_url;
                  },
                  error: function(jqXHR, textStatus, errorThrown) 
                  {
                      toastr.error(jqXHR.responseJSON.responseMessage);
                  }
              });
      }, 2000);
    });
}