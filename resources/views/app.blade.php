<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- VERY IMPORTANT: Bypass Inertia's standard processing and send data directly -->
    @if(isset($page))
    <script type="text/javascript">
        window.initialPage = @json($page);
    </script>
    @endif

    <title>{{ config('app.name', 'Azam TV Bulk SMS') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- AdminLTE CSS & JS are loaded directly by Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- We're using a completely clean app div with NO @inertia directive -->
    <div id="app"></div>
</body>
</html>