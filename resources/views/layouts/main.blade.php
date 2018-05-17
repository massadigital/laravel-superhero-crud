<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SuperHero CRUD</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="/css/app.css" rel="stylesheet">
		<link rel="stylesheet" href="/vendor/dropzone/dropzone.css">
		<link rel="stylesheet" href="/vendor/bootstrap-select/css/bootstrap-select.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" class="index">
    
        @include('layouts.partials._navigation')
    
        {{-- @include('layouts.partials._header') --}}
    
        @yield('content')
    
        @include('layouts.partials._footer')
    
    </body>
</html>
