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
    <style>
        .loader {
            position: relative;
            width: 60px;
            height: 80px;
            background: #fff;
            border-radius: 4px;
        }

        @media (min-width: 768px) {
            .loader {
                width: 100px;
                height: 130px;
            }
        }

        .loader:before{
            content: '';
            position: absolute;
            width: 54px;
            height: 25px;
            left: 50%;
            top: 0;
            background-image:
                radial-gradient(ellipse at center, #0000 24%,#de3500 25%,#de3500 64%,#0000 65%),
                linear-gradient(to bottom, #0000 34%,#de3500 35%);
            background-size: 12px 12px , 100% auto;
            background-repeat: no-repeat;
            background-position: center top;
            transform: translate(-50% , -65%);
            box-shadow: 0 -3px rgba(0, 0, 0, 0.25) inset;
        }
        .loader:after{
            content: '';
            position: absolute;
            left: 50%;
            top: 20%;
            transform: translateX(-50%);
            width: 66%;
            height: 60%;
            background: linear-gradient(to bottom, #f79577 30%, #0000 31%);
            background-size: 100% 16px;
            animation: writeDown 2s ease-out infinite;
        }

        @keyframes writeDown {
            0% { height: 0%; opacity: 0;}
            20%{ height: 0%; opacity: 1;}
            80% { height: 65%; opacity: 1;}
            100% { height: 65%; opacity: 0;}
        }

    </style>
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
