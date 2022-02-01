<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('title')
    <style>
        body{
            background-color: rgb(236, 236, 236);
        }
    </style>
</head>
<body>
    @yield('content')
    <script src="{{asset('js/code.js')}}"></script>
    <script src="{{asset('js/bootstrap5.js')}}"></script>
</body>
</html>
