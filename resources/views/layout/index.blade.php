<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystylesheet.css') }}"/>
    <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Page Specific CSS -->
</head>

<body>
@include('admin.navbar')
@yield('content')

<!-- JavaScript -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<!-- Page Specific Plugins -->
<script src="{{ asset('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}"></script>
<script src="{{ asset('js/tablesorter/jquery.tablesorter.js') }}"></script>
<script src="{{ asset('js/tablesorter/tables.js') }}"></script>
{{--<script src="{{ asset('https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js') }}"></script>--}}
@yield('js')

</body>
</html>
