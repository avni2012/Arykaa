/**
 * Single delete for backend listing modules
 *
 * @param url
 */
function deleteTableRow(url){
    $.confirm({
        title: 'Are you sure?',
        content: 'Once deleted, you will not be able to recover this data !',
        type: 'orange',
        icon: 'fa fa-warning',
        buttons: {
            confirm: function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "DELETE",
                    data:{ _method : "DELETE" },
                    success:function(response){
                        $.alert({
                            title: 'success',
                            type: 'blue',
                            content: response.message,
                            icon: 'fa fa-smile-o',
                            buttons: {
                                ok: function () {
                                    $("#usersDatatable").DataTable().ajax.reload();
                                },
                            }
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $.alert({
                            title: 'oops !',
                            type: 'red',
                            icon: 'fa fa-bug',
                            content: jqXHR.responseJSON.message,
                        });
                    }
                });
            },
            cancel: function () {
                //$.alert('Canceled!');
            },
        }
    })
}

/**
 * Multiple delete for backend listing modules
 *
 * @param url
 * @param tableName
 */
function deleteMultipleTableRow(url,tableName){
    let title = tableName.replace('Datatable','');
    let ids = [];
    $(':checkbox:checked').each(function(i){
        ids[i] = $(this).val();
    });
    if(ids.length > 0)
    {
        $.confirm({
            title: 'Are you sure?',
            content: 'Selected data Once deleted, you will not be able to recover this data !',
            type: 'orange',
            icon: 'fa fa-warning',
            buttons: {
                confirm: function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: "POST",
                        data : {
                            "ids":ids
                        },
                        dataType:'json',
                        success:function(response){
                            $.alert({
                                title: 'success',
                                type: 'blue',
                                icon: 'fa fa-smile-o    ',
                                content: response.message,
                                buttons: {
                                    ok: function () {
                                        if(!response.error){
                                            $('#'+tableName).DataTable().ajax.reload();
                                            $(".select_all INPUT[type='checkbox'] ").prop("checked", false);
                                        }
                                    },
                                }
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $.alert({
                                title: textStatus,
                                type: 'red',
                                icon: 'fa fa-bug',
                                content: jqXHR.responseJSON.message,
                            });
                        }
                    });
                },
                cancel: function () {
                    //$.alert('Canceled!');
                },
            }
        })
    }
}
/**
 * Document on ready
 */
$(function () {
    $(".select_all INPUT[type='checkbox'] ").click( function(e) {
        if($(this).prop("checked") === true){
            $(" INPUT[type='checkbox']").attr('checked', true);
        }
        else if($(this).prop("checked") === false){
            $(" INPUT[type='checkbox']").attr('checked', false);
        }
    });
});
