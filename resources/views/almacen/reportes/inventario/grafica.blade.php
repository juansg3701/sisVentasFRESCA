@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

         var graficaCS = [];



          var data = new google.visualization.DataTable();

          data.addColumn('string', 'Producto');
          data.addColumn('number', 'Cantidad');

          graficaCS[0]=parseInt(<?php echo $Transformado[0]->numero?>,10);
          graficaCS[1]=parseInt(<?php echo $NoTransformado[0]->numero?>,10);

          data.addRows([["Transformado",graficaCS[0]]]);
          data.addRows([["No transformado",graficaCS[1]]]);
          

        var options = {
          title: 'Gráfica de inventario'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
   </head>

<body>
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTE DE INVENTARIO</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                            <div  class="col-sm-8" align="center">
                                 <div id="piechart" style="width: 620px; height: 300px;"></div>

                            </div>
                            <div class="col-sm-4">
                              <div align="center">
                                <?php 
                             $total_ventas=$Transformado[0]->numero+$NoTransformado[0]->numero;
                             ?> 
                             <br>
                           <b> Compras generadas entre:</b><br>
                            {{$r->fechaInicial}} y {{$r->fechaFinal}}<br>
                            <b>Total comprado:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                              </div>
                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/inventario')}}" class="btn btn-danger">Volver</a>
                            </div>
                               
                            </div>

                          </div>
                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
</body>
@stop


@section('tabla')


<!--Tabla de registros realizados-->
<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" align="center">
            <h3 class="pb-2 display-5">DETALLE DE REPORTE</h3>
            
            
          </div>

          <div class="card-body">
      
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>PRODUCTO</th>
              <th>PAGO TOTAL</th>
              <th>METODO DE PAGO</th>
            </thead>
            @foreach($ventas as $ps)
              @foreach($productos as $pr)
                @if($pr->id_producto==$ps->producto_id_producto)
              <tr>
              <td>{{ $ps->id_stock}}</td>
              <td>{{ $ps->fecha_registro}}</td>
              <td>{{ $pr->nombre}}</td>
              <td>{{ $ps->total}}</td>
              <td>{{ $ps->categoria}}</td>
            </tr>
                @endif  
              @endforeach
            @endforeach
          </table>
        </div>
        {{$ventas->render()}}
        </div>
      </div>
    </div>
  </div>
</div>

@stop