@extends('admin.layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Detalles de la lista </h2>
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


                    <div class="row">
                        <div class="form-group col-md-10 col-md-offset-1">
                            <label>Nombre de la lista: </label>
                            <span style="font-size: 14px">{{$customerList[0]->namelist}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10 col-md-offset-1">
                            <label>Descripción de la lista: </label>
                            <span style="font-size: 14px">{{$customerList[0]->descriptionlist}}</span>
                        </div>
                    </div>
                    <br>

                    <h2>Información del cliente</h2>
                    <hr>
                    <div class="row ">
                        <div class="form-group col-md-10 col-md-offset-1">
                            <label>Nombre del cliente: </label>
                            <span style="font-size: 14px">{{$customerList[0]->name}}</span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="form-group col-md-10 col-md-offset-1">
                            <label>Teléfono del cliente: </label>
                            <span style="font-size: 14px">{{$customerList[0]->main_phone}}</span>
                        </div>
                    </div>

                    <br>
                    <h2>Productos de la lista</h2>
                    <hr>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tamaño del paquete</th>
                            <th>Sugerido</th>
                            <th>Prioridad</th>
                            <th>Activo</th>

                        </tr>
                        </thead>


                        <tbody>
                        @foreach($listProducts as $value)
                            <tr>
                                <td>{{$value->full_name}}</td>
                                <td>{{$value->packsize}}</td>

                                @if($value->suggest == 1)
                                    <td>Si</td>
                                @else
                                    <td>no</td>
                                @endif


                                @if($value->priority == 1)
                                    <td>Si</td>
                                @else
                                    <td>no</td>
                                @endif

                                @if($value->active == 1)
                                    <td>Si</td>
                                @else
                                    <td>no</td>
                                @endif



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