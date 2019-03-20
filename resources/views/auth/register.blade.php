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

            @if ($errors->has('message'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $errors->first('message') }}</strong>
                </div>
            @endif

            <div class="animate form">
                <section class="login_content">
                    <form method="POST" action="{{route('registrarUsuario')}}">

                        {{csrf_field()}}

                        <h1>Solicitar Cuenta</h1>
                        <div>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Nombre"
                                   value="{{ old('name') }}" required autofocus/>

                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" value="{{ old('email') }}"
                                   required/>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('branch_office') ? ' has-error' : '' }}">
                            <input type="text" name="branch_office" class="form-control"
                                   placeholder="Sucursal" value="{{ old('branch_office') }}"
                                   required/>
                            @if ($errors->has('branch_office'))
                                <span class="help-block"><strong>{{ $errors->first('branch_office') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
                            <input type="text" name="address" class="form-control"
                                   placeholder="Dirección" value="{{ old('address') }}"
                                   required/>
                            @if ($errors->has('address'))
                                <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('mobile_phone') ? ' has-error' : '' }}">
                            <input type="text" name="mobile_phone" class="form-control"
                                   placeholder="Teléfono móvil" value="{{ old('mobile_phone') }}"
                                   required/>
                            @if ($errors->has('mobile_phone'))
                                <span class="help-block"><strong>{{ $errors->first('mobile_phone') }}</strong></span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('landline') ? ' has-error' : '' }}">
                            <input type="text" name="landline" class="form-control"
                                   placeholder="Teléfono fijo" value="{{ old('landline') }}"
                                   required/>
                            @if ($errors->has('landline'))
                                <span class="help-block"><strong>{{ $errors->first('landline') }}</strong></span>
                            @endif
                        </div>


                        <div>
                            <button type="submit"
                                    class="btn btn-default submit">Registrarse
                            </button>
                        </div>

                    </form>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Ya tiene una cuenta?
                            <a href="{{ route('login') }}" class="to_register"> Login </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <div class="h1">{{ config('app.name') }}</div>
                        </div>
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
    <link rel="stylesheet" href="{{asset('css/tableDynamic.css')}}">

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
    <script src="{{asset('js/tableDynamic.js')}}"></script>
    <script src="{{asset('js/customTheme.js')}}"></script>
    <script>


    </script>

    @include('partials.notify')

@endsection