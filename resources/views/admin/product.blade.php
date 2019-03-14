@extends('admin.layouts.admin')

@section('content')

    <div id="crud" >

    {{--Crear Producto--}}
    <div  class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crear Nuevo Producto</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Configurar</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="new-product-content" class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  method="POST" v-on:submit.prevent="createProduct()">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required" v-model="cod_fs" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Item<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="last-name" required="required" v-model="item" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" v-model="name" type="text" name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Pronunciación en Ingles</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" v-model="pronunciation_in_english" type="text" name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" v-model="description" type="text" name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tamaño del paquete</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" v-model="packsize" type="text" name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Subir imagen</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" v-model="picture_url" type="file" name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select  id="middle-name" class="form-control col-md-7 col-xs-12" v-model="category_id">
                                    <option v-for="value in category.values"  :value="value.id">@{{value.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-namess" class="control-label col-md-3 col-sm-3 col-xs-12">Unidad</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

{{--
                                <input id="middle-namess" class="form-control col-md-7 col-xs-12" v-model="unit_id" type="text" name="middle-name">
--}}
                                <select  id="middle-namess" class="form-control col-md-7 col-xs-12" v-model="unit_id">
                                    <option v-for="value in units.values"  :value="value.id">@{{value.name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Activar</label>

                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input id="middle-name" class="form-control col-md-3 col-xs-12" v-model="active" type="checkbox" checked name="middle-name">
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

    <div  class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lista de productos </h2>
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
                        <tr >
                            <td>@{{value.cod_fs}}</td>
                            <td>@{{value.item}}</td>
                            <td>@{{value.name}}</td>
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

        const app = new Vue({
            el: '#crud',
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

