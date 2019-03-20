@extends('admin.layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crear nueva lista de productos para el cliente</h2>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de lista<span
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                <input type="text" id="description" required="required" v-model="item"
                                       class="form-control col-md-7 col-xs-12" name="description">

                                @if ($errors->has('description'))
                                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="customer_id"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Seleccion de cliente</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                                <select id="customer_id" class="form-control col-md-7 col-xs-12"
                                        v-model="category_id" name="customer_id">
                                    @foreach($customers as $customer)
                                        <option value="{{$customer ->id}}"> <strong style="font-weight: bold !important;">{{$customer -> name}}</strong>  - Teléfono: {{$customer->main_phone}} </option>
                                    @endforeach

                                        @if ($errors->has('customer_id'))
                                            <span class="help-block"><strong>{{ $errors->first('customer_id') }}</strong></span>
                                        @endif
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="active" class="control-label col-md-3 col-sm-3 col-xs-12">Activar Lista</label>

                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input id="active" class="form-control col-md-3 col-xs-12" type="checkbox" checked
                                       name="active" value="1">
                            </div>
                        </div>




                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Limpiar Campos</button>
                                <button id="saveData" type="button" class="btn btn-success">Guardar Lista</button>
                            </div>
                        </div>

                    </form>

                    {{--Space Between elements--}}
                    <br>
                    <br>

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

                                    <form onsubmit="addRow(event)">

                                        <div class="form-group">
                                            <label for="products">Seleccione el producto</label>
                                            <select  required name="products" class="form-control">

                                                @foreach($products as $product)
                                                    <option  value="{{$product ->id}}">{{$product -> name}} - {{$product-> description}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="suggest">Sugerido</label>
                                            <select  required name="suggest" class="form-control">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="priority">Prioridad</label>
                                            <select  required name="priority" class="form-control">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label  for="active">Activo</label>
                                            <select  required name="active" class="form-control">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>



                                        <button id="agregar" type="submit" class="btn btn-success">Agregar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Space Between elements--}}


                    <div class="x_title">
                        <h2>Agregar productos a la lista del cliente</h2>
                        <div class="clearfix"></div>
                    </div>
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                        Agregar Producto
                    </button>

                    {{--Space Between elements--}}
                    <br>
                    <br>

                    {{--Table of elements--}}
                    <table id="datable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id Producto</th>
                            <th>Producto</th>
                            <th>Id Sugerido</th>
                            <th>Sugerido</th>
                            <th>Id Prioridad</th>
                            <th>Prioridad</th>
                            <th>Id</th>
                            <th>Activo</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody id="data" >

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

        $(document).ready(function () {
            $('th:nth-child(1)').hide();
            $('th:nth-child(3)').hide();
            $('th:nth-child(5)').hide();
            $('th:nth-child(7)').hide();

        });



        function createRow(data) {
            return (
                '<tr>' +
                '<td>' + data.productId + '</td>' +
                '<td>' + data.productVal + '</td>' +
                '<td>' + data.suggestId + '</td>' +
                '<td>' + data.suggestVal + '</td>' +
                '<td>' + data.priorityId + '</td>' +
                '<td>' + data.priorityVal + '</td>' +
                '<td>' + data.activeId + '</td>' +
                '<td>' + data.activeVal + '</td>' +
                '<td><a  style="margin-right: 8px;" href=""> <button id="delete" type="submit" class="btn btn-danger">Eliminar</button></a></td>' +
                '</tr>'
            );
        }



        //Codigo de confiracion para el boton de eliminar en el formulario
        $(document).on('click', '#delete', function (event) {
            var confirmacion = event.messageType = confirm('Desea eliminar este producto');
            if (confirmacion) {
                $(this).closest('tr').remove();
                event.preventDefault();
                return href = "";
            } else {

                event.preventDefault();

            }
        });


        function addRow(e) {
            e.preventDefault();
            const row = createRow({
                productId: $("select[name='products'] :selected").val(),
                productVal: $("select[name='products'] :selected").text(),

                suggestId: $("select[name='suggest'] :selected").val(),
                suggestVal: $("select[name='suggest'] :selected").text(),

                priorityId: $("select[name='priority'] :selected").val(),
                priorityVal: $("select[name='priority'] :selected").text(),

                activeId: $("select[name='active'] :selected").val(),
                activeVal: $("select[name='active'] :selected").text(),



            });
            $('table tbody').append(row);


            $('td:nth-child(1)').hide();
            $('td:nth-child(3)').hide();
            $('td:nth-child(5)').hide();
            $('td:nth-child(7)').hide();


            /*
             voidField();
             */
        }

        $(document).on('click', '#saveData', function (event) {

            var confirmation = confirm('¿Deseas guardar la lista y los productos?');
            if (confirmation) {
                var dataRequest = {


                    name: $('input:text[name=name]').val(),
                    description: $('input:text[name=description]').val(),
                    customer_id: $("select[name='customer_id'] :selected").val(),
                    active: $('input:checkbox[name=active]').val()


                };

                var filas = $("#data").find("tr"); //devulve las filas del body de la tabla.
                var datas = [];
                for (i = 0; i < filas.length; i++) { //Recorre las filas 1 a 1
                    var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

                    product_id = $(celdas[0]).text();
                    suggest = $(celdas[2]).text();
                    priorit = $(celdas[4]).text();
                    active = $(celdas[6]).text();

                    //agregar los datos al array
                    datas.push([product_id, suggest, priorit, active ]);
                }

                if (datas.length > 0) {
                    $.ajax({
                        url: "{{ route('guardarListaProductos')}}",
                        data: {dataRequest: dataRequest, data: datas, "_token": "{{ csrf_token() }}"},
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            toastr.success(data)
                         window.location.href = "createproductsuggestionsview";
                            console.log(data);
                        }

                    });
                } else {

                    toastr.success("Agregue productos a la lista");

                }
            }
        });


    </script>

@endsection