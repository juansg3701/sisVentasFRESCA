<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
   

    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link  rel="icon"   href="img/Logo1.jpeg" type="image/jpeg" />
    <link rel="stylesheet" href="{{asset('main.css')}}">
  </head>
  <body class="hold-transition skin-blue sidebar-mini" >
    
    <div class="wrapper ">
      <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><img src="{{asset('img/Logo2.jpeg')}}" style="width: 50px; height: 50px;"></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><img src="{{asset('img/Logo2.jpeg')}}" style="width: 50px; height: 50px;"><font size=3 face="Verdana">&nbsp SISTEMA POS</font></b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->



          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">En línea</small>
                  <span class="hidden-xs">Usuario:{{ Auth::user()->name }}
                  @if(auth()->user())
                  autenticado
                  @endif

                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
            
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        <!--
            <img  id="logo" src="{{asset('img/name.svg')}}" align="left" 
            style="margin-top: 10px; width: 200px"
            > 
          
                  <img  src="{{asset('img/logo.svg')}}" align="Right" style="margin-top: 5px; margin-right:20px; margin-bottom: 5px; width: 100px">
      
         -->


   <img id="name_img" src="{{asset('img/name.svg')}}" style="margin-top: 5px">
      <img id="logo" src="{{asset('img/logo.svg')}}" align="Right" style="margin-right:20px">

     </nav>
     
      </header>
      
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            

              @foreach($modulos as $m)
              @if($m->id_modulo==1)

               <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios                </span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                <li class="treeview">
                  <a href="#">
                  <i class="fa fa-circle-o"></i>
                    <span>Permisos de Administrador 

                    </span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                    <ul class="treeview-menu">
                    <li><a href="{{url('almacen/usuario/permiso/cargo')}}"><i class="fa fa-circle-o"></i> Cargos</a></li> 
                    <li><a href="{{url('almacen/usuario/permiso/usuario')}}"><i class="fa fa-circle-o"></i> Permiso de Usuarios</a></li>
                    <li><a href="{{url('almacen/usuario/permiso/cuenta')}}"><i class="fa fa-circle-o"></i> Cuentas</a></li>
                  </ul>
                </li>

                <li><a href="{{url('almacen/usuario/registrar')}}"><i class="fa fa-circle-o"></i> Registrar Usuario</a></li>
                
                
                </ul>
            </li>
              @endif
              @endforeach


              @foreach($modulos as $m)
                @if($m->id_modulo==2)
                  <li class="treeview">
                <a href="{{url('almacen/proveedor')}}">
                  <i class="fa fa-book"></i>
                  <span>Proveedores</span>
                </a>
              </li>
                 @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==3)
                   <li class="treeview">
              <a href="{{url('almacen/cliente')}}">
                <i class="fa fa-male"></i>
                <span>Clientes</span>
              </a>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==4)
                 <li class="treeview">
              <a href="{{url('almacen/caja')}}">
                <i class="fa fa-archive"></i>
                <span>Caja</span>
              </a>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==5)
                 <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i>
                <span>Inventarios</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="{{url('almacen/inventario/proveedor-sede')}}"><i class="fa fa-circle-o"></i> Stock</a></li>
                <li><a href="{{url('almacen/inventario/movimiento-sede')}}"><i class="fa fa-circle-o"></i> Movimiento Sede</a></li>
                <li><a href="{{url('almacen/inventario/corte-sede/cortes')}}"><i class="fa fa-circle-o"></i> Cortes</a></li>
              </ul>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==6)
               <li class="treeview">
              <a href="{{url('almacen/nomina')}}">
                <i class="fa fa-list"></i>
                <span>Nómina</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li><a href="{{url('almacen/nomina/valores')}}"><i class="fa fa-circle-o"></i> Valores-Hora</a></li>
                <li class="treeview">
                  <a href="#">
                  <i class="fa fa-circle-o"></i>
                    <span>Empleados</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                    <ul class="treeview-menu">
                    <li><a href="{{url('almacen/nomina/empleado/lista')}}"><i class="fa fa-circle-o"></i>Lista de empleados</a></li> 
                    <li><a href="{{url('almacen/nomina/empleado')}}"><i class="fa fa-circle-o"></i>Empleados Temporales</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                  <i class="fa fa-circle-o"></i>
                    <span>Horarios</span>
                    <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                     <li><a href="{{url('almacen/nomina/horario')}}"><i class="fa fa-circle-o"></i>Registrar Horarios</a></li> 
                    <li>@include('almacen.nomina.horario.search2')</li>
                  </ul>
                </li>
              </ul>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==7)
                <li class="treeview">
              <a href="#">
                <i class="fa fa-cart-plus"></i>
                <span>Pedidos y Devoluciones</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::action('facturacionListaPedidosClientes@show',0)}}"><i class="fa fa-circle-o"></i> Pedido-Cliente</a></li>
                <li><a href="{{URL::action('facturacionListaPedidosProveedor@show',0)}}"><i class="fa fa-circle-o"></i> Pedido-Proveedor</a></li>
                <li><a href="{{url('almacen/pedidosDevoluciones/devoluciones')}}"><i class="fa fa-circle-o"></i> Devolución</a></li>
              </ul>
            </li>
              @endif
              @endforeach


              @foreach($modulos as $m)
                @if($m->id_modulo==8)
                <li class="treeview">
              <a href="#">
                <i class="fa fa-sticky-note"></i>
                <span>Facturación</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('almacen/facturacion/listaVentas')}}"><i class="fa fa-circle-o"></i> Nueva venta</a></li>
                <li><a href="{{URL::action('facturacionListaVentas@show',0)}}"><i class="fa fa-circle-o"></i> Lista Ventas</a></li>
                <li><a href="{{url('almacen/facturacion/cuentasBancarias')}}"><i class="fa fa-circle-o"></i> Cuentas Bancarias</a></li>
              </ul>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==9)
                <li class="treeview">
              <a href="#">
                <i class="fa fa-calculator"></i>
                <span>Pagos y Cobros</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('almacen/pagosCobros/FacturasPagar')}}"><i class="fa fa-circle-o"></i> Facturas por Pagar</a></li>
                <li><a href="{{url('almacen/pagosCobros/FacturasCobrar')}}"><i class="fa fa-circle-o"></i> Facturas por Cobrar</a></li>
              </ul>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==10)
                 <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Reportes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#">
                  <i class="fa fa-circle-o"></i>
                    <span>Inventario</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                    <ul class="treeview-menu">
                    <li><a href="{{url('almacen/reportes/inventario')}}"><i class="fa fa-circle-o"></i>Productos-Sede</a></li> 
                    <li><a href="{{url('almacen/reportes/inventario2')}}"><i class="fa fa-circle-o"></i>Productos-Proveedor</a></li>
                  </ul>
                </li>

                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Pedidos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('almacen/reportes/pedidos')}}"><i class="fa fa-circle-o"></i>Pedidos-Cliente</a></li> 
                    <li><a href="{{url('almacen/reportes/pedidos2')}}"><i class="fa fa-circle-o"></i>Pedidos-Proveedor</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Ventas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('almacen/reportes/ventas')}}"><i class="fa fa-circle-o"></i>Métodos de Pago</a></li>  
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Pagos - Cobros</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  
                  <ul class="treeview-menu">
                    <li><a href="{{url('almacen/reportes/pagosCobros/pagos')}}"><i class="fa fa-circle-o"></i>Facturas por pagar</a></li>
                    <li><a href="{{url('almacen/reportes/pagosCobros/cobros')}}"><i class="fa fa-circle-o"></i>Facturas por cobrar</a></li>
                  </ul>
                </li>


                
                <li><a href="{{url('almacen/reportes/caja/caja')}}"><i class="fa fa-circle-o"></i>Caja</a></li>
                <li><a href="{{url('almacen/reportes/bancos/bancos')}}"><i class="fa fa-circle-o"></i>Bancos</a></li>

                <li><a href="{{url('almacen/reportes/nomina')}}"><i class="fa fa-circle-o"></i>Nómina</a></li>
              </ul>
            </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==11)
                <li class="treeview">
              <a href="{{url('almacen/sede')}}">
                <i class="fa fa-institution"></i>
                <span>Sedes</span>
              </a>
            </li>
              @endif
              @endforeach
              <li class="treeview">
              <a href="{{url('almacen/excel2')}}">
                <i class="fa fa-info-circle"></i>
                <span>Cargar Excel</span>
              </a>
            </li>
   
            <li class="treeview">
              <a href="{{url('almacen/excel2')}}">
                <i class="fa fa-info-circle"></i>
                <span>Acerca de</span>
              </a>
            </li>  


            <li><a href="{{url('/logout')}}"><i class="fa fa-circle-o"></i> Cerrar Sesión</a></li>
                         
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color:#F8F8FF;">
        
        <!-- Main content -->
        <section class="content" >
          <div class="row">
           
            <div class="col-md-12">

              <div class="box" align="center">
               <div class="box-header with-border">
                  <font size=5 face="Verdana">SISTEMA DE VENTAS E INVENTARIO</font><br><br>
                  <div class="col-md-4" >
                  </div>
                  <div class="col-md-4" >

                
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
                  <div class="col-md-4" >
                </div>
                </div>
              </div>  

                    
            </div>
            <div class="col-md-3"></div>


            <div class="col-md-6">
            

              <div class="box">
                
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box">
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('tabla')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2019 <a href="">Sistema POS</a>.</strong> All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!--opc-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
$( function() {
  @if(isset($eanP))
  var eanPA = [
            @foreach ($eanP as $e)
              '{{$e->ean}}',
            @endforeach
      ];

     var nombrePA = [
            @foreach ($eanP as $e)
              '{{$e->nombre}}',
            @endforeach
      ];

      var pluPA = [
            @foreach ($eanP as $e)
              '{{$e->plu}}',
            @endforeach
      ];


    $( "#tags" ).autocomplete({
      source: eanPA
    });
     $( "#buscar2" ).autocomplete({
      source: nombrePA
    });
     $( "#pluP" ).autocomplete({
      source: pluPA
    });
  @endif

  @if(isset($clientesP))
    var cliPN = [
            @foreach ($clientesP as $c)
              '{{$c->nombre}}',
            @endforeach
      ];

     var cliPD = [
            @foreach ($clientesP as $c)
              '{{$c->documento}}',
            @endforeach
      ];

      var cliPT = [
            @foreach ($clientesP as $c)
              '{{$c->telefono}}',
            @endforeach
      ];

      $( "#cli1" ).autocomplete({
      source: cliPN
    });
     $( "#cli2" ).autocomplete({
      source: cliPD
    });
     $( "#cli3" ).autocomplete({
      source: cliPT
    });
  @endif

  @if(isset($proveedoresP))
    var proPN = [
            @foreach ($proveedoresP as $p)
              '{{$p->nombre_empresa}}',
            @endforeach
      ];

     var proPD = [
            @foreach ($proveedoresP as $p)
              '{{$p->documento}}',
            @endforeach
      ];

      var proPNP = [
            @foreach ($proveedoresP as $p)
              '{{$p->nombre_proveedor}}',
            @endforeach
      ];

      $("#pro1" ).autocomplete({
      source: proPN
    });
     $( "#pro2" ).autocomplete({
      source: proPD
    });
     $( "#pro3" ).autocomplete({
      source: proPNP
    });
    
  @endif

   @if(isset($modulosP))
    var carPN = [
            @foreach ($modulosP as $p)
              '{{$p->nombre}}',
            @endforeach
      ];

      $("#car1" ).autocomplete({
      source: carPN
    });
    
  @endif

   @if(isset($usersP) && isset($modulosP) && isset($sedesP))
    var usePN = [
            @foreach ($usersP as $u)
              '{{$u->name}}',
            @endforeach
      ];

      var usePC = [
            @foreach ($modulosP as $p)
              '{{$p->nombre}}',
            @endforeach
      ];

      var usePS = [
            @foreach ($sedesP as $s)
              '{{$s->nombre_sede}}',
            @endforeach
      ];

      $("#cu1" ).autocomplete({
      source: usePN
    });
      $("#cu3" ).autocomplete({
      source: usePC
    });
      $("#cu2" ).autocomplete({
      source: usePS
    });
    
  @endif

  @if(isset($impuP))
    var imP = [
            @foreach ($impuP as $i)
              '{{$i->nombre}}',
            @endforeach
      ];

      $("#im1" ).autocomplete({
      source: imP
    });
   
  @endif

    @if(isset($catP))
    var cateP = [
            @foreach ($catP as $c)
              '{{$c->nombre}}',
            @endforeach
      ];

      $("#cat1" ).autocomplete({
      source: cateP
    });
   
  @endif

  @if(isset($sedesP))
    var sedPS = [
            @foreach ($sedesP as $s)
              '{{$s->nombre_sede}}',
            @endforeach
      ];

      $("#sed1" ).autocomplete({
      source: sedPS
    });
   
  @endif

  @if(isset($empleadoP))
    var emplPN = [
            @foreach ($empleadoP as $e)
              '{{$e->nombre}}',
            @endforeach
      ];

      $("#em1" ).autocomplete({
      source: emplPN
    });
    
  @endif

  @if(isset($pedidoP))
    var pedR = [
            @foreach ($pedidoP as $p)
              '{{$p->id_remision}}',
            @endforeach
      ];

      $("#ped1" ).autocomplete({
      source: pedR
    });
    
  @endif

  @if(isset($pedidoPP))
    var pedR2= [
            @foreach ($pedidoPP as $p)
              '{{$p->id_rproveedor}}',
            @endforeach
      ];

      $("#ped2" ).autocomplete({
      source: pedR2
    });
    
  @endif

  @if(isset($descuentoP))
    var desc1= [
            @foreach ($descuentoP as $d)
              '{{$d->nombre}}',
            @endforeach
      ];

      $("#des1" ).autocomplete({
      source: desc1
    });
    
  @endif

  @if(isset($bancosP))
    var banP= [
            @foreach ($bancosP as $b)
              '{{$b->nombre_banco}}',
            @endforeach
      ];

      $("#ban1" ).autocomplete({
      source: banP
    });
    
  @endif

    @if(isset($facturasP))
    var facP= [
            @foreach ($facturasP as $f)
              '{{$f->nombrepago}}',
            @endforeach
      ];

      $("#fac1" ).autocomplete({
      source: facP
    });
    
  @endif

    
  } );
</script>

  </body>
</html>
