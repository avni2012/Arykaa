<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Job Boosts - Power your job search today" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ config('app.name') }}</title>

    @include('layouts.frontend.includes.head')
    @yield('css')
    @yield('style')

</head>
<body>
@yield('content')

@yield('script-js-last')

@yield('script')

@include('layouts.frontend.includes.scripts')

</body>
</html>
