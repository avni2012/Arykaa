/**
 * Listings of users
 * @type {jQuery}
 */

let UsersTable = $('#usersDatatable').DataTable({
    columnDefs: [
        {
            "targets":"_all",
            "className": "text-center",
            /* "width": "auto"*/
        }
    ],
    order: [[ 1, "desc" ]],
    processing: true,
    serverSide: true,
    ajax: {
        url: getUserData
    },
    columns: [
        {data: 'check', name:'check', orderable: false, searchable: false, visible: true},
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, visible: true},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'mobile_no', name: 'mobile_no'},
        {data: 'status', name: 'status'},
        {data: 'email_verified_at',name:'email_verified_at'},
        {data: 'action', name: 'action', orderable: false, searchable: false, visible: true}
    ],
});
