<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
       {{-- <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><img height="50px" width="210px" src="{{asset('images/logo.png')}}" alt=""></a>
        </div>

        <div class="clearfix"></div>--}}

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic" >
                <img height="60px"  src="{{asset('images/company.jpeg')}}" alt="..." class="img-circle profile_img">

            </div>
            <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>FRIDAYS</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            @if (Auth::user()->rol_id == 1)
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Productos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('productos')}}">Producto</a></li>
                            <li><a href="{{route('categorias')}}">Categoria</a></li>
                            <li><a href="{{route('unidades')}}">Unidad</a></li>
                            <li><a href="{{route('sugerenciaProductos')}}">Sugerencia de productos</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> Pedidos<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('ordenesPedidos')}}">Mostrar Ordenes</a></li>
                            <li><a href="{{route('calendario')}}">Calendario</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Sucursales<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('sucursales')}}">Sucursales</a></li>
                            <li><a href="{{route('clientes')}}">Clientes</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('reportes')}}">General</a></li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-clone"></i>Administración<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('usuarios')}}">Usuarios</a></li>
                            <li><a href="{{route('roles')}}">Roles</a></li>
                            <li><a href="{{route('perfiles')}}">Perfiles</a></li>
                            <li><a href="#">Secciones</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-windows"></i> Tareas <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('programarOrden')}}">Programar Orden</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            @endif

                @if (Auth::user()->rol_id == 3)
            <div class="menu_section">
                <h3>Cliente</h3>
                <ul class="nav side-menu">

                    <li><a href="{{route('dashboardClient')}}"><i class="fa fa-first-order"></i>Dashboard</a></li>
                    <li><a href="{{route('ordencliente')}}"><i class="fa fa-product-hunt"></i>Solicitar pedido</a></li>
                    <li><a href="{{route('ultimasOrdenes')}}"><i class="fa fa-bullseye"></i>Mis ultimos pedidos</a></li>
                    <li><a href="{{route('estadoOrdenAcutal')}}"><i class="fa fa-dot-circle-o"></i>Estatus de mi pedido actual</a></li>
                    <li><a href="{{route('sugerenciaProductos')}}"><i class="fa fa-check"></i>Sugerencias de productos</a></li>

                </ul>
            </div>
              @endif
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
       <div class="sidebar-footer hidden-small">
          {{--  <a data-toggle="tooltip" data-placement="top" title="Configuración">
                <span class="fa fa-cog" aria-hidden="true"></span>
            </a>--}}

            <a  data-toggle="tooltip" data-placement="top" title="Salir" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="fa fa-sign-out" aria-hidden="true"></span>
            </a>

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>


@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/custom/sideBar.css')}}">
@endsection
