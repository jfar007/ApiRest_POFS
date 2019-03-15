@extends('admin.layouts.admin')

@section('content')

    <div class="row tile_count">

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Productos Disponibles</span>
            <div class="count">2500</div>
{{--
            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
--}}
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Pedidos Total</span>
            <div class="count">80</div>
           {{-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>--}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Productos Ultimo Pedido</span>
            <div class="count">12</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar"></i>Fecha Ultimo Pedido</span>
            <div class="count " style="color: #662482;"> <span style="font-size: 24px">14/03/2019</span></div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Productos Sugeridos</span>
            <div class="count">50</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Catetorias Productos</span>
            <div class="count">15</div>
        </div>
    </div>





@endsection



@section('styles')
    @parent
    {{--
      link component ui template
  --}}

    <link rel="stylesheet" href="{{asset('css/tableDynamic.css')}}">

    {{--last link template--}}
    <link rel="stylesheet" href="{{asset('css/customTheme.css')}}">
    <link rel="stylesheet" href="{{asset('css/default.css')}}">
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