@extends('admin.layouts.admin')

@section('content')

    <div id="crud-users" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lista de usuarios </h2>
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
                            <th>Nombre de usuario</th>
                            <th>Contraseña</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sucursal</th>
                            <th>Teléfono celular</th>
                            <th width="10px">Télefono Convencional</th>
                            <th>Dirección</th>
                            <th>Latitud-longitud elevación</th>
                            <th>Rol</th>
                            <th>Cliente</th>
                            <th>Sucursal</th>
                            <th>Confirmado</th>
                            <th>Código de confirmación</th>
                            <th>Activado</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody v-for="value in users.values">
                        <tr >
                            <td>@{{value.username}}</td>
                            <td>@{{value.password}}</td>
                            <td>@{{value.name}}</td>
                            <td>@{{value.email}}</td>
                            <td>@{{value.branch_office}}</td>
                            <td>@{{value.mobile_phone}}</td>
                            <td>@{{value.landline}}</td>
                            <td>@{{value.address}}</td>
                            <td>@{{value.latitude_longitud_elevation}}</td>
                            <td>@{{value.rol_id}}</td>
                            <td>@{{value.customer_id}}</td>
                            <td>@{{value.branch_office_cf_id}}</td>
                            <td>@{{value.confirmed}}</td>
                            <td>@{{value.confirmation_code}}</td>
                            <td>@{{value.active}}</td>

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
                                               v-on:click.prevent="deleteCategory(value)">Eliminar</a>
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
   {{-- <script src="{{asset('js/data.js')}}"></script>--}}

    <script>
        const users = new Vue({
            el: '#crud-users',
            created: function () {
                this.getUsers();
            } ,
            data: {
                users: []
            },
            methods: {
                getUsers: function () {

                    var urlUser = "api/u";
                    axios.get(urlUser).then(response => {this.users = response.data});

                },

                deleteCategory: function (value) {


                }


            }
        });

    </script>

@endsection