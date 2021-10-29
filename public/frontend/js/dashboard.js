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