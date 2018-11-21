<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{asset('./templateEditor/ckeditorfull/ckeditor.js')}}"></script>    
   
    
    
    <title>Ticket System</title>

        
    </head>
    <body>
        @include('inc.header')
       <div class="container">
        @include('inc.messages')
       
     
       <!-- <script type="text/javascript" src="{{ asset('nicEdit/nicEdit.js') }}"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
          </script>-->
     
        @yield('content')
        </div>
        @include('inc.footer')
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
