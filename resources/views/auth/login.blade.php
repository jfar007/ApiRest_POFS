@extends('auth.layouts.auth')

@section('body_class','login')

@section('content')
    <div class="animate form login_form row" >
        <div  style=" background: url('{{asset('/images/background-login.jpg')}}');  height:100vh" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 div-hide">

        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="login_wrapper">
                <div >
                    <section class="login_content">
                        <div class="logo-container"><img src="{{asset('images/logo.png')}}" alt=""></div>
                        <form method="POST"  action="{{route('login')}}" >
                            {{csrf_field()}}
                            <h1>Iniciar Cuenta</h1>
                            <div  style="text-align: left !important;" class="field form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="field-label">Usuario</label>

                                <input id="email"   type="text" class="form-control field-input" name="username" value="{{ old('username') }}"  autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                                @endif
                            </div>

                            <div style="text-align: left !important;" class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="field-label">Contraseña</label>

                                <input id="password" title="Presione este botón una vez que haya ingresado el usuario y la contraseña" type="password" class="form-control field-input" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('locked') ? ' has-error' : '' }}">
                                <button  style="background-color: #662482; border: none;" type="submit" class="btn btn-success pull-left">Ingresar</button>

                                @if ($errors->has('locked'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('locked') }}</strong>
                    </span>
                                @endif
                            </div>

                            <div>

                                {{--<a class="reset_pass" href="{{ route('password.request') }}">--}}
                                <a class="reset_pass pull-right" href="">
                                    Recuperar Contraseña
                                </a>
                            </div>

                            <div class="clearfix"></div>


                            <div class="separator">
                                <p class="change_link">No tienes una cuenta?
                                    <a href=""
                                       class="to_register"> Registrarse </a>
                                </p>

                                <div class="clearfix"></div>
                                <br/>

                                <div>
                                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}.
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

        </div>
    </div>


@endsection


{{--
@section('styles')
    @parent
    <link rel="stylesheet" href="{{mix('css/login.css')}}">
@endsection
--}}
@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/default.css')}}">
    <link rel="stylesheet" href="{{asset('css/customTheme.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom/customLogin.css')}}">

@endsection


@section('scripts')
    @parent
    <script src="{{asset('js/tableDynamic.js')}}"></script>
    <script src="{{asset('js/customTheme.js')}}"></script>
   {{-- <script src="{{asset('js/data.js')}}"></script>

    <script>
    const login = new Vue({
    el: '#login',
    data: {
        logins: [],
    newUser: '',
    newPassword:''
    },
    methods: {
        authenticate: function () {
            var urlLogin = "api/u/lg";
             axios.post(urlLogin, {
                 username: this.newUser,
                 password: this.newPassword

            }).then(response => {this.logins = response.data;
                     toastr.success('usuario autenticado');
        }).catch ( );
        },

    }
    });
    </script>
--}}
@endsection

