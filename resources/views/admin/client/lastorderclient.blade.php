@extends('admin.layouts.admin')

@section('content')

    <div id="crud" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Peido #2 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Configuración</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div  class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>DESCRIPCION DEL PRODUCTO</th>
                            <th>EMPAQUE</th>
                            <th>UNIDAD DE PEDIDO</th>
                            <th>CANTIDADES</th>

                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody v-for="value in products.values">
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div id="crud" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pedido #1 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Configuración</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div  class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>DESCRIPCION DEL PRODUCTO</th>
                            <th>EMPAQUE</th>
                            <th>UNIDAD DE PEDIDO</th>
                            <th>CANTIDADES</th>

                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody v-for="value in products.values">
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MYCT-001</td>
                            <td>MISSION 6 YELLOW CORN TORTILLAS</td>
                            <td>12/60 CT</td>
                            <td>CAJA</td>
                            <td>20</td>


                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}

                                        </li>

                                        <li>
                                            <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"
                                               href="">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{--Mostrar Productos--}}


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

@endsection