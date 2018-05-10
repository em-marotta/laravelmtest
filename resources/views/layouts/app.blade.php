<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- javascripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    
    <script type="text/javascript">
        jQuery(document).ready(function (){ 
            
            $.ajaxSetup({
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    
    <style>
        .header {
            color: #36A0FF;
            font-size: 27px;
            padding: 10px;
        }

        .bigicon {
            font-size: 35px;
            color: #36A0FF;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">{{__("Laravel Test")}} </a>
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>   
</body>
</html>
