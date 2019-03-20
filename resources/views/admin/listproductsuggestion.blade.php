@extends('admin.layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Lista de productos de clientes </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">

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
                            <th>Description</th>
                            <th>Activa</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody>
                        @foreach($lists as $value)
                            <tr>
                                <td>{{$value->nameList}}</td>
                                <td>{{$value->descriptionList}}</td>
                                @if($value->activeList == 1)
                                    <td>Activo</td>
                                @else
                                    <td>Desactivado</td>
                                @endif
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
                                                <a href="{{ route('listaProductoSugeridosDetalles', ['id' => $value->idList]) }}">Detalles</a>
                                            </li>

                                            <li>
                                                <a href="{{route('listaProductoSugeridosEditar', ['id'=>$value->idList])}}">Modificar</a>
                                            </li>

                                            <li>
                                                <a href="{{route('listaProductoSugeridosEliminar', ['id' =>$value->idList])}}"
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

    @include('partials.notify')

    <script>


    </script>

@endsection