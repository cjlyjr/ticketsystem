<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket System') }}</title>

    
    

   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Scripts -->
   
    <script type="text/javascript" rel="script" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" rel="script" src="{{asset('js/custom.js')}}"></script>
</head>
<body>
    <div id="app">
            
        @include('inc.header')

        <main class="py-4">
            <div class="container">
            @include('inc.messages')
    <script type="text/javascript" rel="script" src="{{asset('/ticket/ckeditor-class/ckeditor.js')}}"></script>    
            
    @yield('content')
            </div>
        </main>
    </div>
    
</body>
</html>
