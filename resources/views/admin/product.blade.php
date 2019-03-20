@extends('admin.layouts.admin')

@section('content')



    <h2></h2>

    <div id="crud">

        {{--Crear Producto--}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Crear Nuevo Producto</h2>
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
                              action="{{route('guardarProducto')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cod_fs">Código<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('code_fs') ? ' has-error' : '' }}">
                                    <input type="text" id="cod_fs" required="required" v-model="cod_fs"
                                           class="form-control col-md-7 col-xs-12" name="cod_fs">

                                    @if ($errors->has('cod_fs'))
                                        <span class="help-block"><strong>{{ $errors->first('cod_fs') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item">Item<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('item') ? ' has-error' : '' }}">
                                    <input type="text" id="item" required="required" v-model="item"
                                           class="form-control col-md-7 col-xs-12" name="item">
                                    @if ($errors->has('item'))
                                        <span class="help-block">
                        <strong>{{ $errors->first('item') }}</strong>
                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name"
                                       class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">Nombre</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" v-model="name" type="text"
                                           name="name">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pronunciation_in_english" class="control-label col-md-3 col-sm-3 col-xs-12">Pronunciación
                                    en Ingles</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('pronunciation_in_english') ? ' has-error' : '' }}">
                                    <input id="pronunciation_in_english" class="form-control col-md-7 col-xs-12"
                                           v-model="pronunciation_in_english" type="text"
                                           name="pronunciation_in_english">

                                    @if ($errors->has('pronunciation_in_english'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('pronunciation_in_english') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"
                                       class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="description" class="form-control col-md-7 col-xs-12 {{ $errors->has('description') ? ' has-error' : '' }}"
                                           v-model="description" type="text" name="description">
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="packsize" class="control-label col-md-3 col-sm-3 col-xs-12">Tamaño del
                                    paquete</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="packsize" class="form-control col-md-7 col-xs-12 {{ $errors->has('packsize') ? ' has-error' : '' }}" v-model="packsize"
                                           type="text" name="packsize">
                                    @if ($errors->has('packsize'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('packsize') }}</strong>
                                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="picture_url" class="control-label col-md-3 col-sm-3 col-xs-12">Subir
                                    imagen</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="picture_url" class="form-control col-md-7 col-xs-12"
                                           v-model="picture_url" type="file" name="picture_url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_id"
                                       class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="category_id" class="form-control col-md-7 col-xs-12"
                                            v-model="category_id" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category ->id}}">{{$category -> name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="unit_id" class="control-label col-md-3 col-sm-3 col-xs-12">Unidad</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    {{--
                                                                    <input id="middle-namess" class="form-control col-md-7 col-xs-12" v-model="unit_id" type="text" name="middle-name">
                                    --}}
                                    <select id="unit_id" class="form-control col-md-7 col-xs-12" v-model="unit_id"
                                            name="unit_id">
                                        @foreach($units as $unit)
                                            <option value="{{$unit ->id}}">{{$unit -> name}}</option>
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
                        <h2>Lista de productos </h2>
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
                                <th>Código</th>
                                <th>Item</th>
                                <th>Nombre</th>
                                <th>Pronunciación</th>
                                <th>Descripción</th>
                                <th>Tamaño</th>
                                <th width="10px">Imagen</th>
                                <th>Categoria</th>
                                <th>Unidad</th>
                                {{--     <th>Activo</th>--}}
                                <th>Acciones</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($products as $value)
                                <tr>
                                    <td>{{$value->cod_fs}}</td>
                                    <td>{{$value->item}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->pronunciation_in_english}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>{{$value->packsize}}</td>
                                    <td><img src="{{asset('/images/products/'. $value->picture_url)}}" alt=""></td>
                                    <td>{{ $value->categoryp}}</td>
                                    <td>{{ $value->unitp}}</td>
                                    {{-- <td>{{ $value->active}}</td>--}}


                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup"
                                                aria-labelledby="dropdownMenu2">


                                                <li>

                                                    <a href="{{ route('editarProducto', ['id' => $value->id]) }}">Modificar</a>

                                                </li>

                                                <li>
                                                    <a href="{{route('eliminarProducto', ['id' =>$value->id])}}" onclick="return confirm('Esta seguro de eliminar este producto?')"
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

