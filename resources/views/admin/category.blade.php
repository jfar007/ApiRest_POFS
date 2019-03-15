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
                              method="POST" v-on:submit.prevent="createCategory">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Categoria<span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="category" v-model="newCategory" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shortname">Nombre
                                    Abreviado<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="shortname" name="shortname" v-model="newShortName"
                                           required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="control-label col-md-3 col-sm-3 col-xs-12">Activar</label>

                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <input id="active" v-model="newActive" class="form-control col-md-3 col-xs-12"
                                           type="checkbox" checked>
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
                                <th>Fecha Creación</th>
                                <th>Fecha Modificación</th>
                                <th>Acciones</th>

                            </tr>
                            </thead>


                            <tbody v-for="value in categories.values">
                            <tr>
                                <td>@{{value.name}}</td>
                                <td>@{{value.short_name}}</td>
                                <td>@{{value.active}}</td>
                                <td>@{{value.created_at}}</td>
                                <td>@{{value.updated_at}}</td>
                                <td>
                                    <div class="dropdown table-actions-dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu table-actions-dropdown-popup"
                                            aria-labelledby="dropdownMenu2">

                                            <li>
                                                {{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}
                                                <a  data-toggle="modal" data-target="#myModal"
                                                   v-on:click.prevent="editCategory(value)">Modificar</a>
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

        {{--/Modal Update Category--}}
        {{--Add New Product Modal--}}
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Editar Categoria</h4>
                    </div>
                    <div class="modal-body text-left">
                        <form  method="POST" v-on:submit.prevent="updateCategory(fill.id)">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <input id="category" v-model="fill.category" class="form-control " type="text"
                                       name="middle-name">
                            </div>

                            <div class="form-group">
                                <label for="shortname">Nombre Abreviado</label>
                                <input id="shortname" v-model="fill.shortname" class="form-control " type="text">
                            </div>

                            <div class="form-group">
                                <label for="active">Activo</label>
                                <input id="active" v-model="fill.active" class="form-control " type="checkbox">
                            </div>


                            <button id="agregar" type="submit" class="btn btn-success"
                                   >Actualizar
                            </button>
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
        const category = new Vue({
            el: '#crud-category',
            created: function () {
                this.getCategory();
            },
            data: {
                categories: [],
                newCategory: '',
                newShortName: '',
                newActive: '',
                fill: {'id': '', 'category': '', 'shortname': '', 'active': ''}
            },
            methods: {
                getCategory: function () {
                    var urlCategory = "api/cg";
                    axios.get(urlCategory).then(response => {this.categories = response.data; toastr.success('Datos Cargados con éxito');});

                },

                deleteCategory: function (value) {
                    var url = 'api/cg/' + value.id;


                },

                createCategory: function () {

                    var url = 'api/cg';
                    axios.post(url, {
                        name: this.newCategory,
                        short_name: this.newShortName,
                        active: this.newActive

                    }).then(response => {

                        this.getCategory();
                        this. cleanField();
                }).
                    catch();


                },
                
                editCategory: function (value) {

                 this.fill.id = value.id;
                 this.fill.category = value.name;
                 this.fill.shortname = value.short_name;
                 this.fill.active = value.active;

                },
                
                updateCategory:function (id) {
                var url = 'cg/' + id;

                axios.post(url,this.fill).then(response => {
                    toastr.success('Categoria actializada correctamente');
                    this.getCategory();});

                },
                cleanField: function () {

                       newCategory= '',
                        newShortName= '',
                        newActive=''
                }


            }
        });


    </script>


@endsection