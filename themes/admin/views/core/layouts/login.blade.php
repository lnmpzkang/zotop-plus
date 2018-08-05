{{-- title:后台登录页面模板 --}}
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <title>{{$title or ''}} @yield('title')</title>
    <link href="{{theme::asset('favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="{{theme::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{theme::asset('css/fontawesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{theme::asset('css/global.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{theme::asset('css/login.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body class="{{app('current.module')}}-{{app('current.controller')}}-{{app('current.action')}}">
    @yield('content')
    <script src="{{theme::asset('js/jquery.min.js')}}"></script>
    <script src="{{theme::asset('js/popper.min.js')}}"></script>    
    <script src="{{theme::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{theme::asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{theme::asset('js/jquery.nicescroll.min.js')}}"></script> 
    <script src="{{theme::asset('js/cms.js')}}"></script>
    <script src="{{theme::asset('js/global.js')}}"></script>
    @if(!App::isLocale('en'))
    <script src="{{theme::asset('lang/'.App::getLocale().'/jquery.validate.js')}}"></script>
    @endif
    @stack('js')
</body>
</html>
