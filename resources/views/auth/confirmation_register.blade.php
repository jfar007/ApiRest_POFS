@extends('auth.layouts.auth')

@section('body_class','register')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alertDismissible">
            {{ session('error') }}
        </div>
    @endif

    <div>
        <div class="login_wrapper">
            <div class="animate form">
                <section class="login_content">
                    
                    
                    <div style="background: #000"><img src="{{asset('images/logo.png')}}" alt=""></div>
                    <br><br>
                    <h2>Usuario Registrado, Confirme su cuenta desde su correo </h2>
                    
                    <div class="clearfix"></div>
                    <br/>

                    <div class="separator">
                        <p class="change_link">
                            <a href="{{route('login')}}"
                               class="to_register">Login</a>
                        </p>
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}.
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    @parent
    {{--
        link component ui template
    --}}

    <link rel="stylesheet" href="{{asset('css/default.css')}}">
    {{--last link template--}}
    <link rel="stylesheet" href="{{asset('css/customTheme.css')}}">



    {{--
        links custom
    --}}
    <link rel="stylesheet" href="{{asset('css/custom/sideBar.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom/custom.css')}}">
@endsection


@section('scripts')
    @parent
    <script src="{{asset('js/customTheme.js')}}"></script>
    <script>


    </script>

    @include('partials.notify')

@endsection