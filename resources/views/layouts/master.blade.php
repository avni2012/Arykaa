<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    @include('layouts.common.header')
    @yield('css')
    @yield('style')
	<script>
		var BASE_URL = "{{ url('/') }}";
	</script>	
</head>
<body>
    @yield('content')
    @include('layouts.common.footer')
<!-- PAGE SCRIPTS -->
@yield('script-js-last')

@yield('script')
</body>
</html>
