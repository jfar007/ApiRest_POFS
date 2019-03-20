@extends('admin.layouts.admin')

@section('content')

    {{--Create Category--}}
    <div id="crud-category">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Crear Nuevo Cliente</h2>
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
                              method="POST" action="{{route('clienteCrear')}}">

                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" required="required"
                                           class="form-control col-md-7 col-xs-12" name="name">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_phone">Telefono
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="main_phone" name="main_phone"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_address">Dirección
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="main_address" name="main_address"
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
                                        <option value="{{$profile->id}}">{{$profile->name}}</option>
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
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="reset">Limpiar Campos</button>
                                    <button type="submit" class="btn btn-success">Guardar Cliente</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lista de clientes</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Configuración</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table id="datatable" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Perfil</th>
                                <th>Activo</th>
                                <th>Acciones</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($customers as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->main_phone}}</td>
                                    <td>{{$value->main_address}}</td>
                                    <td>{{$value->nameprofile}}</td>

                                    @if($value->active == 1)
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif


                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup"
                                                aria-labelledby="dropdownMenu2">


                                                <li>

                                                    <a href="{{ route('clienteEditar', ['id' => $value->id]) }}">Modificar</a>

                                                </li>

                                                <li>
                                                    <a href="{{route('clienteEliminar', ['id' =>$value->id])}}" onclick="return confirm('Esta seguro de eliminar este cliente?')"
                                                    >Eliminar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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