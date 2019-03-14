@extends('admin.layouts.admin')

@section('content')

    {{--Product Data--}}
  {{--  <div id="" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Datos del Pedido</h2>
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

                    --}}{{--Form of new product--}}{{--
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer Id<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="" type="text" id="first-name" required="required"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sucursal Id<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="last-name" required="required"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"
                                       name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de
                                corte</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"
                                       name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estado Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"
                                       name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Usuario
                                Id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"
                                       name="middle-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">User lm
                                id</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"
                                       name="middle-name">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Limpiar Campos</button>
                                <button type="submit" class="btn btn-success">Enviar Pedido</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>--}}


    {{--select product--}}
{{--    <div id="crud" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Productos del pedido</h2>
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


                    --}}{{--Add New Product Modal--}}{{--
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

                    --}}{{--Space Between elements--}}{{--
                    <br>
                    <br>

                    <div class="x_title">
                        <h2>Datos de Producto</h2>
                        <div class="clearfix"></div>
                    </div>
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                        Agregar Producto
                    </button>

                    --}}{{--Space Between elements--}}{{--
                    <br>
                    <br>

                    --}}{{--Table of elements--}}{{--
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
                            <th>Id Categoria</th>
                            <th>Categoria</th>
                            <th>Id Unidad</th>
                            <th>Unidad</th>
                            <th>Fecha Creación</th>
                            <th>Fecha Modificacion</th>
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
                            <td>@{{value.category_id}}</td>
                            <td>@{{value.category.name}}</td>
                            <td>@{{value.unit_id}}</td>
                            <td>@{{value.unit.name}}</td>
                            <td>@{{value.created_at}}</td>
                            <td>@{{value.updated_at}}</td>

                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">


                                        <li>
                                            <a href="">Modificar</a>
                                            --}}{{-- <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>--}}{{--

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
    </div>--}}
    {{--Mostrar Productos--}}

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Solicitar Pedido <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">

                            </ul>
                        </li>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <!-- Smart Wizard -->
                    <p>Comience a seleccionar sus productos para una nueva orden</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step-1">
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                              Paso 1<br />
                                              <small>Seleccionar todos sus producto</small>
                                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                              Paso 2<br />
                                              <small>Seleccionar Accion</small>
                                          </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                              Paso 3<br />
                                              <small>Realizar Accion</small>
                                          </span>
                                </a>
                            </li>
                           {{-- <li>
                                <a href="#step-4">
                                    <span class="step_no">4</span>
                                    <span class="step_descr">
                                              Step 4<br />
                                              <small>Step 4 description</small>
                                          </span>
                                </a>
                            </li>--}}
                        </ul>
                        <div id="step-1">


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
                                                        <option v-for="value in products.values" ></option>
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
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                                Agregar Producto
                            </button>

                            {{--Space Between elements--}}
                            <br>
                            <br>

                            {{--Table of elements--}}
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
                        <div id="step-2" class="text-center">
                            <h2 class="StepTitle">Paso 2 Seleccionar</h2>
                           <div>

                               <div class="form-check">
                                   <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                   <label class="form-check-label" for="exampleRadios1">
                                       Guardar Pedido
                                   </label>
                               </div>
                               <div class="form-check">
                                   <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                   <label class="form-check-label" for="exampleRadios2">
Generar Pedido                                   </label>
                               </div>
                           </div>
                        </div>
                        <div id="step-3" class="text-center">
                            <h2 class="StepTitle">Generar Accion</h2>
                            <p>
                                De Click en "FINISH" para generar acción
                            </p>

                        </div>


                    </div>
                    <!-- End SmartWizard Content -->





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
       {{--link component --}}
    <script src="{{asset('js/tableDynamic.js')}}"></script>
{{--
    last link tamplate
--}}
    <script src="{{asset('js/default.js')}}"></script>
    <script src="{{asset('js/customTheme.js')}}"></script>

    {{--link component custom--}}
    <script src="{{asset('js/data.js')}}"></script>

@endsection
