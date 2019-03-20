@extends('admin.layouts.admin')

@section('content')

    {{--Create Category--}}
    <div id="crud-category">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Modificar Cliente</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Configurar</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div id="new-product-content" class="x_content">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                              method="POST" action="{{route('clienteModificar', ['id' => $customer[0]->id])}}">

                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" required="required"
                                           class="form-control col-md-7 col-xs-12" name="name" value="{{$customer[0]->name}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_phone">Telefono
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="main_phone" name="main_phone" value="{{$customer[0]->main_phone}}"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_address">Dirección
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="main_address" name="main_address" value="{{$customer[0]->main_address}}"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="profile_id"
                                       class="control-label col-md-3 col-sm-3 col-xs-12">Perfil</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="active" class="form-control col-md-7 col-xs-12"
                                            name="profile_id">
                                        @foreach($profiles as $profile)
                                            <option  value="{{$profile->id}}"  {{$profile->id == $customer[0]->profile_id ? 'selected="selected"' : ''}}>{{$profile->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active"
                                       class="control-label col-md-3 col-sm-3 col-xs-12">Activo</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="active" class="form-control col-md-7 col-xs-12"
                                            name="active">
                                        <option {{$customer[0]->active == 0 ? 'selected':''}} value="0">No</option>
                                        <option  {{$customer[0]->active == 1 ? 'selected':''}}  value="1">Si</option>
                                    </select>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a class="btn btn-primary" href="{{route('clientes')}}">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Modificar Cliente</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
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
    <script>


    </script>

    @include('partials.notify')

@endsection