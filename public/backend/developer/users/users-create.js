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
});
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
                        state.append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                    });
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
                        city.append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
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
