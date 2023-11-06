<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    .col-md-8 {
   flex: 10%;
max-width: 65%;
margin-left: 50% !important;
  }
  .col-md-8{
    margin-top: 8%;
  }
  .card-body{
    background-color: lightgoldenrodyellow;
  }
</style>

</head>
 
<body>
    <!-- style="background-image: url('/uploads/chruch.png');
height: 560px;
/*background-repeat: no-repeat;*/
background-size: 41rem 27rem!important;
  background-position:25px;
  background-repeat: no-repeat;
  /*background-size: 383px;*/
  margin-bottom: 6rem !important;" -->
  
    <div id="app">
        <main class="py-0">
            @yield('content')
        </main>
    </div>
</body>
</html>