@extends('layouts.app')

@section('body_class','nav-md')

@section('page')
    <div class="container body">
        <div class="main_container">
            @section('header')
                @include('admin.sections.navigation')
                @include('admin.sections.header')
            @show

            @yield('left-sidebar')

            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h1 class="h3">@yield('title')</h1>
                    </div>
                </div>
                @yield('content')
            </div>

            <footer>
                @include('admin.sections.footer')
            </footer>
        </div>
    </div>
@stop


{{--

@section('styles')
    <link rel="stylesheet" href="{{mix('assets/admin/css/admin.css')}}">
@endsection

@section('scripts')
    <script src="{{mix('assets/admin/js/admin.js')}}"></script>
@endsection--}}
