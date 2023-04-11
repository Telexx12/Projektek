<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <wireui:scripts />
    <script src="{{asset('js/app.js')}}" defer></script>

</head>
<body>
    {{$slot}}
    @livewireScripts
    <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
    <x-livewire-alert::scripts />
</body>
</html>
