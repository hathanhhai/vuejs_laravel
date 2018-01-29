<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" >
        <!-- Fonts -->

        <!-- Styles -->
    </head>
    <body>

        <div class="container" id="app">
            <task></task>

        </div>

        <script src="{{asset('js/app.js')}}">


        </script>

    </body>
</html>
