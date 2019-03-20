@extends('admin.layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Modificar lista de productos para el cliente</h2>
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

                            <input name="idList" hidden type="text" value="{{$listclient[0]->idList}}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de lista<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" id="name" required="required" v-model="cod_fs"
                                       class="form-control col-md-7 col-xs-12" name="name"
                                       value="{{$listclient[0]->nameList}}">

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
                                       class="form-control col-md-7 col-xs-12" name="description"
                                       value="{{$listclient[0]->descriptionList}}">
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
                                        <option value="{{$customer ->id}} " {{$listclient[0]->id == $customer->id ? 'selected="selected"': ''}} >
                                            <strong style="font-weight: bold !important;">{{$customer -> name}}</strong>
                                            - Teléfono: {{$customer->main_phone}} </option>
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
                                            <select required name="products" class="form-control">

                                                @foreach($products as $product)
                                                    <option value="{{$product ->id}}">{{$product -> name}}
                                                        - {{$product-> description}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="suggest">Sugerido</label>
                                            <select required name="suggest" class="form-control">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="priority">Prioridad</label>
                                            <select required name="priority" class="form-control">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="active">Activo</label>
                                            <select required name="active" class="form-control">
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
                            <th>Id Lista</th>
                            <th>Id Producto</th>
                            <th>Producto</th>

                            <th>Id sugerido</th>

                            <th>Sugerido</th>

                            <th>Id Prioridad</th>
                            <th>Prioridad</th>

                            <th>Id Activo</th>
                            <th>Activo</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>


                        <tbody id="data">
                        @foreach($listProducts as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->product_id}}</td>
                                <td>{{$value->full_name}}</td>

                                <td>{{$value->suggest}}</td>

                                @if($value->suggest == 1)
                                    <td>Si</td>
                                @else
                                    <td>Si</td>
                                @endif

                                <td>{{$value->priority}}</td>

                                @if($value->priority == 1)
                                    <td>Si</td>
                                @else
                                    <td>Si</td>
                                @endif

                                <td>{{$value ->active}}</td>

                                @if($value->active == 1)
                                    <td>Si</td>
                                @else
                                    <td>Si</td>
                                @endif


                                <td><a style="margin-right: 8px;" href="">
                                        <button id="delete" name="delete_row" type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </a></td>
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

        $(document).ready(function () {


            $('th:nth-child(1)').hide();
            $('td:nth-child(1)').hide();

            $('th:nth-child(2)').hide();
            $('td:nth-child(2)').hide();

            $('th:nth-child(4)').hide();
            $('td:nth-child(4)').hide();

            $('th:nth-child(6)').hide();
            $('td:nth-child(6)').hide();

            $('th:nth-child(8)').hide();
            $('td:nth-child(8)').hide();

        });


        function createRow(data) {
            return (
                '<tr>' +
                '<td>' + data.listId + '</td>' +
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


        var itemss = [];
        $(document).on('click', '#delete', function (event) {
            var confirmacion = event.messageType = confirm('Desea realizar la eliminacion?');
            if (confirmacion) {

                var cod = $(this).closest('tr').find("td:nth-child(1)").text()
                itemss.push(cod);
                toastr.success(cod);
                $(this).closest('tr').remove();
                event.preventDefault();
            } else {
                event.preventDefault();

            }
        });

        function addRow(e) {
            e.preventDefault();
            const row = createRow({
                listId: '',
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
            $('td:nth-child(2)').hide();
            $('td:nth-child(4)').hide();
            $('td:nth-child(6)').hide();
            $('td:nth-child(8)').hide();


            /*
             voidField();
             */
        }

        $(document).on('click', '#saveData', function (event) {

            var confirmation = confirm('¿Deseas guardar la lista y los productos?');
            if (confirmation) {
                var dataRequest = {


                    idListProduct: $('input:text[name=idList]').val(),
                    name: $('input:text[name=name]').val(),
                    description: $('input:text[name=description]').val(),
                    customer_id: $("select[name='customer_id'] :selected").val(),
                    active: $('input:checkbox[name=active]').val()


                };

                var filas = $("#data").find("tr"); //devulve las filas del body de la tabla.
                var datas = [];
                for (i = 0; i < filas.length; i++) { //Recorre las filas 1 a 1
                    var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

                    listId = $(celdas[0]).text();
                    product_id = $(celdas[1]).text();
                    suggest = $(celdas[3]).text();
                    priorit = $(celdas[5]).text();
                    active = $(celdas[7]).text();

                    //agregar los datos al array
                    datas.push([listId, product_id, suggest, priorit, active]);
                }

                if (datas.length > 0) {
                    $.ajax({
                        url: "{{ route('listaProductoSugeridosActualizar')}}",
                        data: {
                            dataRequest: dataRequest,
                            data: datas,
                            deleteData: itemss,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {

                            window.location.href = "/listproductsuggestionsview";
                            toastr.success(data)
                        }

                    });
                } else {

                    toastr.success("Agregue productos a la lista");

                }
            }
        });


    </script>

@endsection