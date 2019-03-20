@extends('admin.layouts.admin')

@section('content')


    <div >
        {{--Modificar Producto--}}
        <div  class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Modificar Producto</h2>
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
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="{{route('actualizarProducto', ['id' => $product->id])}}"  method="POST" enctype="multipart/form-data" >
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cod_fs">Código<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('cod_fs') ? ' has-error' : '' }}">
                                    <input type="text" id="cod_fs" required="required" value="{{$product->cod_fs}}" class="form-control col-md-7 col-xs-12" name="cod_fs">

                                    @if ($errors->has('cod_fs'))
                                        <span class="help-block"><strong>{{ $errors->first('cod_fs') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item">Item<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('item') ? ' has-error' : '' }}">
                                    <input type="text" id="item"  required="required" value="{{$product->item}}" class="form-control col-md-7 col-xs-12" name="item">

                                    @if ($errors->has('item'))
                                        <span class="help-block"><strong>{{ $errors->first('item') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="name" class="form-control col-md-7 col-xs-12" value="{{$product->name}}" type="text" name="name">

                                    @if ($errors->has('name'))
                                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pronunciation_in_english" class="control-label col-md-3 col-sm-3 col-xs-12">Pronunciación en Ingles</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('pronunciation_in_english') ? ' has-error' : '' }}">
                                    <input id="pronunciation_in_english" class="form-control col-md-7 col-xs-12" value="{{$product->pronunciation_in_english}}" type="text" name="pronunciation_in_english">

                                    @if ($errors->has('pronunciation_in_english'))
                                        <span class="help-block"><strong>{{ $errors->first('pronunciation_in_english') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <input id="description" class="form-control col-md-7 col-xs-12" value="{{$product->description}}" type="text" name="description">

                                    @if ($errors->has('description'))
                                        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="packsize" class="control-label col-md-3 col-sm-3 col-xs-12">Tamaño del paquete</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('packsize') ? ' has-error' : '' }}">
                                    <input id="packsize" class="form-control col-md-7 col-xs-12"  value="{{$product->packsize}}" type="text" name="packsize" >

                                    @if ($errors->has('packsize'))
                                        <span class="help-block"><strong>{{ $errors->first('packsize') }}</strong></span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="picture_url" class="control-label col-md-3 col-sm-3 col-xs-12">Subir imagen</label>

                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('picture_url') ? ' has-error' : '' }}">
                                    <input id="picture_url" class="form-control col-md-7 col-xs-12"  type="file" name="picture_url">
                                    <div><img src="{{asset('/images/products/'. $product->picture_url)}}" alt=""></div>

                                    @if ($errors->has('picture_url'))
                                        <span class="help-block"><strong>{{ $errors->first('picture_url') }}</strong></span>
                                    @endif

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="category_id" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <select  id="category_id" class="form-control col-md-7 col-xs-12" v-model="category_id" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category ->id}}" {{$category->id == $product->category_id ? 'selected="selected"' : ''}}>{{$category -> name}} </option>
                                        @endforeach

                                            @if ($errors->has('category_id'))
                                                <span class="help-block"><strong>{{ $errors->first('category_id') }}</strong></span>
                                            @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="unit_id" class="control-label col-md-3 col-sm-3 col-xs-12">Unidad</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 {{ $errors->has('unit_id') ? ' has-error' : '' }}">

                                    <select  id="unit_id" class="form-control col-md-7 col-xs-12" v-model="unit_id" name="unit_id">
                                        @foreach($units as $unit)
                                            <option value="{{$unit ->id}}" {{$unit->id == $product->unit_id ? 'selected="selected"': ''}}>{{$unit -> name}}</option>

                                            @if ($errors->has('unit_id'))
                                                <span class="help-block"><strong>{{ $errors->first('unit_id') }}</strong></span>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active" class="control-label col-md-3 col-sm-3 col-xs-12">Activar</label>

                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <input id="active" class="form-control col-md-3 col-xs-12" value="{{$product->active}}" type="checkbox" {{$product->active == 1 ? 'checked="checked"': '' }} name="active">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{route('productos')}}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar Producto</button>
                                </div>
                            </div>

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



@endsection


