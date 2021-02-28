<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cosecha Fresca</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('images/Logo1.jpeg')}}">
    <link rel="shortcut icon" href="{{asset('images/Logo1.jpeg')}}">

    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="{{asset('https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css')}}" rel="stylesheet">

    <link href="{{asset('https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css')}}" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css')}}">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- autocompletado-->
        <link rel="stylesheet" href="{{asset('assets/awesomplete.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/awesomplete.theme.css')}}">


</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                 
                    
                    @foreach($modulos as $m)
              @if($m->id_modulo==1)

               <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Permisos admin</a>
                        <ul class="sub-menu children dropdown-menu">                        

                            <li><i class="fa fa-desktop"></i><a href="{{url('almacen/usuario/permiso/cargo')}}">Cargos</a>
                            </li>
                            <li><i class="fa fa-th-large"></i><a href="{{url('almacen/usuario/permiso/usuario')}}">M&oacute;dulos</a>
                            </li>
                            <li><i class="fa fa-users"></i><a href="{{url('almacen/usuario/permiso/cuenta')}}">Cuentas</a>
                            </li>
                         
                        </ul>
                    </li>
              @endif
              @endforeach


              @foreach($modulos as $m)
                @if($m->id_modulo==2)
                 <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Empleados</a>
                        <ul class="sub-menu children dropdown-menu">                        

                            <li><i class="fa fa-sign-in"></i><a href="{{url('almacen/usuario/registrar')}}">Registrarse</a>
                            </li>
                            <li><i class="fa fa-users"></i><a href="{{url('almacen/nomina/empleado')}}">Lista de empleados</a>
                            </li>                         
                        </ul>
                    </li>
                 @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==3)
                     <li>
                        <a href="{{url('almacen/proveedor')}}"><i class="menu-icon fa fa-group"></i>Proveedores </a>
                    </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==4)
                 <li>
                        <a href="{{url('almacen/cliente/cliente')}}"><i class="menu-icon fa fa-group"></i>Clientes </a>
                    </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==5)
                    <li>
                        <a href="{{url('almacen/sede')}}"><i class="menu-icon fa fa-globe"></i>Sedes </a>
                    </li>
                  @endif
              @endforeach

            
              @foreach($modulos as $m)
                @if($m->id_modulo==7)
                <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Inventario</a>
                        <ul class="sub-menu children dropdown-menu">                        

                            <li><i class="fa fa-leaf"></i><a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}">Productos</a>
                            </li>
                            <li><i class="fa fa-shopping-cart"></i><a href="{{url('almacen/inventario/proveedor-sede')}}">Stock</a>
                            </li> 
                            
                            <li><i class="fa fa-truck"></i><a href="{{url('almacen/inventario/movimiento-sede')}}">Movimiento entre sedes</a>
                            </li>                
                        </ul>
                    </li>
              @endif
              @endforeach
            


                          @foreach($modulos as $m)
                @if($m->id_modulo==9)
               <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-briefcase"></i>Reportes</a>
                        <ul class="sub-menu children dropdown-menu">                        

                            <li><i class="fa fa-table"></i><a href="{{url('almacen/reportes/ventas')}}">Ventas</a>
                            </li>
                            <li><i class="fa fa-table"></i><a href="{{url('almacen/reportes/inventario')}}">Inventario</a>
                            </li> 
                            <li><i class="fa fa-table"></i><a href="{{url('almacen/reportes/comparacion')}}">Comparacion</a>
                            </li>                
                        </ul>
                    </li>
                  @endif
              @endforeach

          
            <li class="treeview">
              <a href="">
                <i class="fa fa-info-circle"></i>
                <span>Acerca de</span>
              </a>
            </li>  


            <li>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fa fa-sign-out"></i>
                  Cerrar sesi&oacuten
                </a>

            </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/Logo1.jpeg')}}" width="35" height="35">&nbsp Cosecha fresca</a>
                    <a class="navbar-brand hidden" href="{{url('/')}}"><img src="{{asset('images/Logo1.jpeg')}}" width="35" height="35">&nbsp Cosecha fresca</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content" align="center">
             <div class="col-md-4" align="center" >

                
                      @if(session()->has('msj'))
                      <div class="alert alert-info" role="alert">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                      {{session('msj')}}
                    </div>
                      @endif

                       @if(session()->has('errormsj'))
                        <div class="alert alert-danger" role="alert">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{session('errormsj')}}
                      </div>
                        @endif

                  </div>
          <div>
                        
                    @yield('contenido')
                    </div>
                    
                    <div>                       
                    @yield('tabla')
                    </div>
                  
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2021
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">&iquest;Desea salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Salir" si est&aacute seguro de cerrar la sesi&oacuten.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{url('/logout')}}">Salir</a>
        </div>
      </div>
    </div>
  </div>

    <!-- Scripts -->
    
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!--  Chart js -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js')}}"></script>

    <!--Chartist Chart-->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js')}}"></script>


    <script src="{{asset('https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('assets/js/init/weather-init.js')}}"></script>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/init/fullcalendar-init.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    


    <!-- autompletado-->


<script type="text/javascript" src="{{asset('assets/awesomplete.min.js')}}"></script>
    
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>
