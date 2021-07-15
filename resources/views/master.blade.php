<!DOCTYPE html>
<html>
    <head>
        <title>ePonuda - Gigatron Products</title>  
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        <script defer src="{{ mix('js/app.js') }}"></script>     
    </head>
    <body>
        <div id="app">            
            @yield('content')            
        </div>                        
    </body>
</html>