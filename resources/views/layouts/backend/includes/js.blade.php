
<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('backend/js/custom.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.js') }}"></script>

<!--Jquery UI-->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!--Jquery Confirm-->
<script src="{{ asset('backend/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>

<!--Helper-->
<script src="{{ asset('backend/developer/helpers.js') }}"></script>

<!--parsley js-->
<script src="{{ asset('backend/parsley/parsley.min.js') }}"></script>

<!--ckeditor js-->
<script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/plugins/ckeditor/adapters/jquery.js') }}"></script>

<script src="{{ asset('backend/js/js.cookie.min.js') }}"></script>
<script>
    $(document).ready(function () {

        if(Cookies.get('body_class') == undefined && Cookies.get('sidebar_open') == undefined) {
            Cookies.set('sidebar_open', 0);
            Cookies.set('body_class', 'sidebar-collapse');
            $('body').addClass('sidebar-collapse')
        } else if(Cookies.get('body_class') != undefined && Cookies.get('body_class') == 'sidebar-collapse' && Cookies.get('sidebar_open') != undefined && Cookies.get('sidebar_open') == 0) {
            Cookies.set('sidebar_open', 0);
            Cookies.set('body_class', 'sidebar-collapse');
            $('body').addClass('sidebar-collapse')
        } else if(Cookies.get('body_class') != undefined && Cookies.get('body_class') == 'test' && Cookies.get('sidebar_open') != undefined && Cookies.get('sidebar_open') == 1) {
            Cookies.set('sidebar_open', 1);
            Cookies.set('body_class', 'test');
            $('body').removeClass('sidebar-collapse');
        }
    })

    $(document).on('click', '#navigation_icon', function () {
        console.log(Cookies.get('body_class'));
        console.log(Cookies.get('sidebar_open'));
        if(Cookies.get('body_class') != undefined && Cookies.get('body_class') == 'sidebar-collapse' && Cookies.get('sidebar_open') != undefined && Cookies.get('sidebar_open') == 0) {
            Cookies.set('sidebar_open', 1);
            Cookies.set('body_class', 'test');
            $('body').removeClass('sidebar-collapse');
        } else if(Cookies.get('body_class') != undefined && Cookies.get('body_class') == 'test' && Cookies.get('sidebar_open') != undefined && Cookies.get('sidebar_open') == 1) {
            Cookies.set('sidebar_open', 0);
            Cookies.set('body_class', 'sidebar-collapse');
            $('body').addClass('sidebar-collapse')
        }
        console.log(Cookies.get('body_class'));
        console.log(Cookies.get('sidebar_open'));
    })
</script>