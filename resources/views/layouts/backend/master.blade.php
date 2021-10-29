<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    @include('layouts.backend.includes.head')
    @yield('css')
    @yield('style')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('layouts.backend.includes.header')

    @include('layouts.backend.includes.sidebar')

    <!--Contect here-->
        @yield('content')
    <!--End Contect here-->
</div>
    @include('layouts.backend.includes.footer')
    @include('layouts.backend.includes.js')
<!-- PAGE SCRIPTS -->
@yield('script-js-last')

@yield('script')
</body>
</html>
