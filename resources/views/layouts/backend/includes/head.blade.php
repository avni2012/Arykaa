  <link rel="stylesheet" href="{{ asset('backend/font-awesome/font-awesome.css') }}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('backend/fonts-family/fonts-family.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/custom_style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/theme-color.css') }}">

   <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/ionicons/ionicons.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/developer/developer.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.css') }}">

  <!--Jquery UI-->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.css') }}">

  <!--Jquery Confirm-->
  <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-confirm/jquery-confirm.min.css') }}">

  <!--parsley css-->
  <link rel="stylesheet" href="{{ asset('backend/parsley/parsley.css') }}">

  <!-- jQuery -->
  <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
  
  <script>
      const getUserData = '{{ route('admin.get-user-data') }}';
      const getStatesByCountry = '{{ route('get-states') }}';
      const getCitiesByState = '{{ route('get-cities') }}';
      const getuserAddressEditForm = '{{ route('admin.edit-user-address') }}';
      const deleteuserAddress = '{{ route('admin.delete-user-address') }}';
  </script>
