@extends('auth.layouts.auth')

@section('body_class','register')

@section('content')



    <div>
                <div class="login_wrapper">

            <div class="animate form">

                @if(session('error'))
                    <div class="alert alert-danger alertDismissible">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alertDismissible">
                        {{ session('success') }}
                    </div>
                @endif

                <section class="login_content">
                    <form method="POST" action="{{route('reestablecerPassword')}}" >
                        {{csrf_field()}}

                        <div class="h1"><h1> Reestablecer Pass</h1></div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" value="{{ old('email') }}"
                                   required/>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>

    
                        <div>
                            <button type="submit"
                                    class="btn btn-default submit">Reestablecer
                            </button>
                        </div>


                    </form>


                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">
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