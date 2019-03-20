@extends('admin.layouts.admin')

@section('content')

    <div id="crud">

        {{--Crear Producto--}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Crear Nueva Sucursal</h2>
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
                              action="{{route('sucursalCrear')}}" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de la
                                    surcursal<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" id="name" required="required" v-model="cod_fs"
                                           class="form-control col-md-7 col-xs-12" name="name">

                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_phone">Teléfono
                                    <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('main_phone') ? ' has-error' : '' }}">
                                    <input type="text" id="main_phone" required="required"
                                           class="form-control col-md-7 col-xs-12" name="main_phone">

                                    @if ($errors->has('main_phone'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('main_phone') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name"
                                       class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('main_address') ? ' has-error' : '' }}">Dirreción</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('main_address') ? ' has-error' : '' }}">
                                    <input id="name" class="form-control col-md-7 col-xs-12" type="text"
                                           name="main_address">

                                    @if ($errors->has('main_address'))
                                        <span class="help-block"><strong>{{ $errors->first('main_address') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="pronunciation_in_english" class="control-label col-md-3 col-sm-3 col-xs-12">Latitud-Longitud-Elevación
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('latitude_longitude_elevation') ? ' has-error' : '' }}">
                                    <input id="pronunciation_in_english" class="form-control col-md-7 col-xs-12"
                                           v-model="latitude_longitude_elevation" type="text"
                                           name="latitude_longitude_elevation">

                                    @if ($errors->has('latitude_longitude_elevation'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('latitude_longitude_elevation') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="customer_id"
                                       class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="customer_id" class="form-control col-md-7 col-xs-12"
                                            name="customer_id">
                                        @foreach($customers as $customer)
                                            <option value="{{$customer ->id}}">{{$customer -> name}}
                                                - {{$customer->main_phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="active" class="control-label col-md-3 col-sm-3 col-xs-12">Activar</label>

                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <input id="active" class="form-control col-md-3 col-xs-12" type="checkbox" checked
                                           name="active" value="1">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="reset">Limpiar Campos</button>
                                    <button type="submit" class="btn btn-success">Guardar Producto</button>
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
                        <h2>Lista de sucursales </h2>
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

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Latidtud-Longitud-Elevación</th>
                                <th>Cliente</th>
                                <th>Activo</th>
                                <th>Acciones</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($braches as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->main_phone}}</td>
                                    <td>{{$value->main_address}}</td>
                                    <td>{{$value->latitude_longitude_elevation}}</td>
                                    <td>{{$value->customer_full_name}}</td>
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

                                                    <a href="{{ route('sucursalEdit', ['id' => $value->id]) }}">Modificar</a>

                                                </li>

                                                <li>
                                                    <a href="{{route('sucursalEliminar', ['id' =>$value->id])}}"
                                                       onclick="return confirm('Esta seguro de eliminar este producto?')"
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
        {{--Mostrar Productos--}}
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
    <link rel="stylesheet" href="{{asset('css/custom/custom.css')}}">
@endsection


@section('scripts')
    @parent
    <script src="{{asset('js/tableDynamic.js')}}"></script>
    <script src="{{asset('js/customTheme.js')}}"></script>
    <script src="{{asset('js/data.js')}}"></script>

    @include('partials.notify')

@endsection

