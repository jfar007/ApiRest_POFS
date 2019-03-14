@extends('admin.layouts.admin')

@section('content')

    desde sucursal

@endsection



@section('styles')
    @parent
    link component ui template
    --}}
    <link rel="stylesheet" href="{{asset('css/default.css')}}">
    <link rel="stylesheet" href="{{asset('css/tableDynamic.css')}}">

    {{--last link template--}}
    <link rel="stylesheet" href="{{asset('css/customTheme.css')}}">

    {{--
        links custom
    --}}
    <link rel="stylesheet" href="{{asset('css/custom/sideBar.css')}}">
@endsection


@section('scripts')
    @parent
    <script src="{{asset('js/tableDynamic.js')}}"></script>
    <script src="{{asset('js/customTheme.js')}}"></script>
    <script src="{{asset('js/data.js')}}"></script>

@endsection