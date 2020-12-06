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
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css')}}">
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


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- autocompletado-->
        <link rel="stylesheet" href="{{asset('assets/awesomplete.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/awesomplete.theme.css')}}">


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
          
    .table-responsive {
    overflow: auto;
  }
  .table-responsive > .table tr th,
  .table-responsive > .table tr td {
    white-space: normal!important;
  }

    </style>
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
                            <li><i class="fa fa-th-large"></i><a href="{{url('almacen/usuario/permiso/usuario')}}">Módulos</a>
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
                @if($m->id_modulo==6)
                <li>
                        <a href="{{url('almacen/pedidosDevoluciones/devoluciones')}}"><i class="menu-icon fa fa-truck"></i>Devoluciones </a>
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
                @if($m->id_modulo==8)
                <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-barcode"></i>Facturación</a>
                        <ul class="sub-menu children dropdown-menu">                        

                            <li><i class="fa fa-list-alt"></i><a href="{{url('almacen/caja')}}">Caja</a>
                            </li> 
                            <li><i class="fa fa-shopping-cart"></i><a href="{{url('almacen/facturacion/listaVentas')}}">Nueva venta</a>
                            </li>
                            <li><i class="fa fa-list-alt"></i><a href="{{URL::action('facturacionListaVentas@show',0)}}">Lista de ventas</a>
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
                            <li><i class="fa fa-table"></i><a href="{{url('almacen/reportes/inventario')}}">Productos</a>
                            </li> 
                            <li><i class="fa fa-table"></i><a href="{{url('almacen/reportes/inventario2')}}">Inventario</a>
                            </li>                
                        </ul>
                    </li>
                  @endif
              @endforeach

          
            <li class="treeview">
              <a href="{{url('almacen/excel2')}}">
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
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/logo1.jpeg')}}" width="35" height="35">&nbsp Cosecha fresca</a>
                    <a class="navbar-brand hidden" href="{{url('/')}}"><img src="{{asset('images/logo1.jpeg')}}" width="35" height="35">&nbsp Cosecha fresca</a>
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
                        Copyright &copy; 2018 Ela Admin
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
          <h5 class="modal-title" id="exampleModalLabel">¿Desea salir?</h5>
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
    <script src="{{asset('https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!--  Chart js -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js')}}"></script>

    <!--Chartist Chart-->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js')}}"></script>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js')}}"></script>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('assets/js/init/weather-init.js')}}"></script>

    <script src="{{asset('https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js')}}"></script>
    <script src="{{asset('https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/init/fullcalendar-init.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>


    <!-- autompletado-->


<script type="text/javascript" src="{{asset('assets/awesomplete.min.js')}}"></script>
    
    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>


</body>
</html>
