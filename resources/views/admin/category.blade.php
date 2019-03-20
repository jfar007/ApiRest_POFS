@extends('admin.layouts.admin')

@section('content')

    {{--Create Category--}}
    <div id="crud-category">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Crear Nueva Categoria</h2>
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
                              method="POST" action="{{route('categoriasCrear')}}">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="short_name">Nombre
                                    Abreviado<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="short_name" name="short_name"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
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
                                    <button type="submit" class="btn btn-success">Guardar Categoria</button>
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
                        <h2>Lista de Categorias </h2>
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
                                <th>Categoria</th>
                                <th>Nombre Abreviado</th>
                                <th>Activo</th>

                                <th>Acciones</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($categories as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->short_name}}</td>
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

                                                    <a href="{{ route('categoriasEditar', ['id' => $value->id]) }}">Modificar</a>

                                                </li>

                                                <li>
                                                    <a href="{{route('categoriasEliminar', ['id' =>$value->id])}}" onclick="return confirm('Esta seguro de eliminar esta categoria?')"
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