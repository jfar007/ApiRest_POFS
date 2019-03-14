@extends('admin.layouts.admin')

@section('content')

    {{--select product--}}
    <div id="cargar" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detalle sugerencia de Productos</h2>
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
                <div id="new-product-content" class="x_content">
                    <br/>


                    {{--Add New Product Modal--}}
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Nuevo Producto</h4>
                                </div>
                                <div class="modal-body text-left">
                                    <form onsubmit="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="products">Seleccione el producto</label>
                                            <select  required name="products" class="form-control">
                                                <option value="">-Seleccione uno-</option>
                                                <option v-for="value in products.values"  v-bind:value="value.id">@{{value.name}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="middle-name">Cantidad de Productos</label>

                                            <input id="middle-name" class="form-control " type="text"
                                                   name="middle-name">
                                        </div>

                                        <div class="form-group">
                                            <label for="middle-name">Fecha de orden</label>

                                            <input id="middle-name" class="form-control " type="date"
                                                   name="middle-name">
                                        </div>


                                        <button id="agregar" type="submit" class="btn btn-success"
                                                onclick="return confirm('Desea Continuar?')">Agregar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Space Between elements--}}


                    <div class="x_title">
                        <h2>Datos de Producto</h2>
                        <div class="clearfix"></div>
                    </div>
                  {{--  <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                        Agregar Producto
                    </button>--}}

                    {{--Space Between elements--}}
                    <br>
                    <br>

                    {{--Table of elements--}}
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

                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody v-for="value in products.values">
                        <tr>
                            <td>@{{value.cod_fs}}</td>
                            <td>@{{value.name}}</td>
                            <td>@{{value.item}}</td>
                            <td>@{{value.pronunciation_in_english}}</td>
                            <td>@{{value.description}}</td>
                            <td>@{{value.packsize}}</td>
                            <td>@{{value.picture_url}}</td>
                            <td>@{{value.category.name}}</td>
                            <td>@{{value.unit.name}}</td>

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
    <script>

        const app = new Vue({
            el: '#cargar',
            created: function () {
                this.getProducts();
                this.getUnits();
                this. getCategory();
            } ,
            data: {
                products: [],
                units: [],
                category: [],
                cod_fs: '',
                item: '',
                name:'',
                pronunciation_in_english: '',
                description: '',
                packsize: '',
                picture_url:'' ,
                category_id: '',
                unit_id : '' ,
                active: ''
            },
            methods: {
                getProducts: function () {
                    var urlProducts = "api/pt";
                    axios.get(urlProducts).then(response => {this.products = response.data;  toastr.success('Datos Cargados con éxito');  });
                },

                createProduct: function () {

                    var url = 'api/pt';
                    axios.post(url, {
                        cod_fs: this.cod_fs,
                        item: this.item,
                        name: this.name,
                        pronunciation_in_english: this.pronunciation_in_english ,
                        description: this.description,
                        packsize: this.packsize,
                        picture_url: this.picture_url ,
                        category_id: this.category_id,
                        unit_id : this.unit_id ,
                        active: this.active
                    }).then(response => {
                        this.getProducts();
                    toastr.success('Producto guardado correctamente');
                    this.cleanField();

                }).catch();


                },
                getCategory: function () {
                    var url= 'api/cg';
                    axios.get(url).then(response => {this.category = response.data});
                },
                getUnits: function () {
                    var url= 'api/un';
                    axios.get(url).then(response => {this.units = response.data});
                },

                cleanField:function () {
                    this.cod_fs= '';
                    this.item= '';
                    this.name='';
                    this.pronunciation_in_english= '';
                    this.description= '';
                    this.packsize= '';
                    this. picture_url='';
                    this.category_id= '';
                    this.unit_id = '';
                    this.active = '';
                }

            }
        });


    </script>
@endsection