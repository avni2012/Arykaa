/**
 * On country select
 */
$(function () {
    $( "#user-dob" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "-100:+0", // last hundred years
    });
});
/**
 * Get Address update form
 * */
$(".edit-user-address-modal").on('click',function (){
    $.ajax({
        url: getuserAddressEditForm,
        type: 'GET',
        dataType: 'json',
        data:{
          addressId : $(this).data('address-id'),
          userId : $(this).data('user-id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (!response.error) {
                $('#update-user-address-form').html(response.data.form);
                $('#update-user-address-modal').modal('toggle');
                // Load state and country functions
                loadData();
            }
        },
        error: function (jqXHR) {
            swal({
                title: jqXHR.responseJSON.message,
                icon: "error",
            });
        }
    })
});
function loadData(){
    $(".country-dropdown").select2({
        placeholder: "Select a country",
        allowClear: true,
        theme: "classic"
    });
    $(".state-dropdown").select2({
        placeholder: "Select a state",
        allowClear: true,
        theme: "classic"
    });
    $(".city-dropdown").select2({
        placeholder: "Select a city",
        allowClear: true,
        theme: "classic"
    });

    $('.country-dropdown').trigger('change');
    $("#country").on('change',function (){
        let countryId = $(this).val();
        let state = $("#state");
        if(countryId){
            $.ajax({
                url: getStatesByCountry,
                dataType: 'Json',
                data: {'countryId':countryId},
                success: function(response) {
                    if(response.data){
                        // Append states
                        state.empty();
                        $.each(response.data.states, function(key, stateObj) {
                            let stateId = $("#user_selected_state_id").val();
                            let selected = (stateId == stateObj.id) ? 'selected' : '';

                            state.append('<option value="'+ stateObj.id +'" '+selected+'>'+ stateObj.name +'</option>');
                        });
                        $('.state-dropdown').trigger('change');
                    }
                },
                error:function (jqXHR){
                    state.empty();
                    console.error(jqXHR.responseJSON.message);
                }
            });
        }
        state.empty();
    });

    /**
     * On State change
     */
    $("#state").on('change',function (){
        let stateId = $(this).val();
        let city = $("#city");
        if(stateId){
            $.ajax({
                url: getCitiesByState,
                dataType: 'Json',
                data: {'stateId': stateId },
                success: function(response) {
                    if(response.data){
                        // Append states
                        city.empty();
                        $.each(response.data.cities, function(key, cityObj) {
                            let cityId = $("#user_selected_city_id").val();
                            let selected = (cityId == cityObj.id) ? 'selected' : '';
                            city.append('<option value="'+ cityObj.id +'" '+selected+'>'+ cityObj.name +'</option>');
                        });
                    }
                },
                error:function (jqXHR){
                    city.empty();
                    console.error(jqXHR.responseJSON.message);
                }
            });
        }
        city.empty();
    });
}
/**
 * Update Address
 * */
$("#update-user-address-form").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: this.action,
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
           if(!response.error){
               swal({
                   title: response.message,
                   icon: "success",
                   ok : function (){
                       $('#update-user-address-modal').modal('hide');
                   }
               });
           }
        },
        error: function (jqXHR) {
            swal({
                title: jqXHR.responseJSON.message,
                icon: "error",
            });
        }
    })
});
/* End Update Address */
$(".delete-user-address").on('click',function (){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax(
                    {
                        url : deleteuserAddress,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {
                            "addressId": $(this).data("address-id"),
                            userId: $(this).data("user-id")
                        },
                        dataType:'json',
                        success:function(response)
                        {
                            swal({
                                title: response.message,
                                icon: "success",
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title: jqXHR.responseJSON.message,
                                icon: "error",
                            });
                        }
                    });
            }
        });
});
