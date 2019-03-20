@extends('admin.layouts.admin')

@section('content')

    {{--Crear usuario--}}
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crear Usuarios</h2>
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
                          action="{{route('usuarioCrearAdmin')}}" method="POST">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">username<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('username') ? ' has-error' : '' }}">
                                <input type="text" id="username" required="required"
                                       class="form-control col-md-7 col-xs-12" name="username">

                                @if ($errors->has('username'))
                                    <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nueva Contraseña
                                <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" id="password" required="required"
                                       class="form-control col-md-7 col-xs-12" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_password">Confirmar
                                Contraseña
                                <span
                                        class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                <input type="password" id="confirm_password" required="required"
                                       class="form-control col-md-7 col-xs-12" name="confirm_password">

                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('confirm_password') }}</strong></span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="name"
                                   class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">Nombre <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('main_address') ? ' has-error' : '' }}">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" required="required"
                                       name="name">

                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email"
                                   class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">Email <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" required="required"
                                       name="email">

                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email"
                                   class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('branch_office') ? ' has-error' : '' }}">Sucursal Referencia<span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('branch_office') ? ' has-error' : '' }}">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" required="required"
                                       name="branch_office">

                                @if ($errors->has('branch_office'))
                                    <span class="help-block"><strong>{{ $errors->first('branch_office') }}</strong></span>
                                @endif

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="mobile_phone"
                                   class="control-label col-md-3 col-sm-3 col-xs-12 {{ $errors->has('mobile_phone') ? ' has-error' : '' }}">Teléfono
                                Movil <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="mobile_phone" class="form-control col-md-7 col-xs-12" type="text" required="required"
                                       name="mobile_phone">

                                @if ($errors->has('mobile_phone'))
                                    <span class="help-block"><strong>{{ $errors->first('mobile_phone') }}</strong></span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="landline" class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono Fijo <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('landline') ? ' has-error' : '' }}">
                                <input id="landline" class="form-control col-md-7 col-xs-12"
                                       v-model="latitude_longitude_elevation" type="text" required="required"
                                       name="landline">

                                @if ($errors->has('landline'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('landline') }}</strong>
                                      </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('address') ? ' has-error' : '' }}">
                                <input id="landline" class="form-control col-md-7 col-xs-12"
                                       type="text"
                                       name="address" required="required">

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                      </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="latitude_longitude_elevation" class="control-label col-md-3 col-sm-3 col-xs-12">Coordenadas
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('address') ? ' has-error' : '' }}">
                                <input id="latitude_longitude_elevation" class="form-control col-md-7 col-xs-12"
                                       type="text"
                                       name="latitude_longitude_elevation">

                                @if ($errors->has('latitude_longitude_elevation'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('latitude_longitude_elevation') }}</strong>
                                      </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="rol_id"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Selecione el rol</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="rol_id" class="form-control col-md-7 col-xs-12"
                                        name="rol_id">
                                    @foreach($roles as $rol)
                                        <option value="{{$rol ->id}}">{{$rol -> name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="customer_id"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="customer_id" class="form-control col-md-7 col-xs-12"
                                        name="customer_id">
                                    @foreach($customers as $customer)
                                        <option value="{{$customer ->id}}">{{$customer -> name}}
                                            - {{$customer->main_phone}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="branch_office_cf_id"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Seleccione la sucursal</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="branch_office_cf_id" class="form-control col-md-7 col-xs-12"
                                        name="branch_office_cf_id">
                                    @foreach($branches as $branch)
                                        <option value="{{$branch ->id}}">{{$branch -> name}}
                                            - {{$branch->main_phone}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmed"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Confirmado</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="confirmed" class="form-control col-md-7 col-xs-12"
                                        name="confirmed">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="active"
                                   class="control-label col-md-3 col-sm-3 col-xs-12">Activo <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="active" class="form-control col-md-7 col-xs-12" required="required"
                                        name="active">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Limpiar Campos</button>
                                <button type="submit" class="btn btn-success">Guardar usuario</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{--Lista  usuarios--}}
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lista de Usuarios </h2>
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

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Sucursal Referencia</th>
                            <th>Teléfono Movil</th>
                            <th>Teléfono Fijo</th>
                            <th>Dirección</th>
                            <th>Ubicación</th>
                            <th>Rol</th>
                            <th>Cliente</th>
                            <th>Sucursal</th>
                            <th>Confirmado</th>
                            <th>Activado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($users as $value)
                            <tr>
                                <td>{{$value->username}}</td>
                                <td>{{$value->password}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->branch_office}}</td>
                                <td>{{$value->mobile_phone}}</td>
                                <td>{{$value->landline}}</td>
                                <td>{{$value->address}}</td>
                                <td>{{ $value->latitude_longitude_elevation}}</td>
                                <td>{{ $value->rol_id}}</td>
                                <td>{{ $value->customer_id}}</td>
                                <td>{{ $value->branch_office_cf_id}}</td>

                                @if($value->confirmed == 1)
                                    <td>Si</td>
                                    @else
                                    <td>No</td>
                                    @endif

                                @if($value->active == 1)
                                    <td>Si</td>
                                @else
                                    <td>No</td>
                                @endif




                                <td>
                                    <div class="dropdown table-actions-dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <ul class="dropdown-menu table-actions-dropdown-popup"
                                            aria-labelledby="dropdownMenu2">

                                            <li>

                                                <a href="">Modificar</a>

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
    {{-- <script src="{{asset('js/data.js')}}"></script>--}}


        @include('partials.notify')


@endsection