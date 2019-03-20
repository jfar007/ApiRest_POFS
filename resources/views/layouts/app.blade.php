<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


       {{--<meta name="csrf-token" content="{{ csrf_token() }}">
--}}
        {{--Title and Meta--}}


        {{--Common App Styles--}}
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        {{--Common App Styles--}}

        {{--<link rel="stylesheet" href="{{asset('css/default.css')}}">--}}
        <link rel="stylesheet" href="{{asset('css/toastr.css')}}">

        {{--Styles--}}
        @yield('styles')

        {{--Head--}}
        @yield('head')

    </head>
    <body class="@yield('body_class')">


        {{--Page--}}
        @yield('page')

        {{--Common Scripts--}}
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/toastr.js')}}"></script>


        {{--Laravel Js Variables--}}
        {{--Scripts--}}
        @yield('scripts')

    </body>
</html>
