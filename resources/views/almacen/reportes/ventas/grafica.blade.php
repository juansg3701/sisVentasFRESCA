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

          graficaCS[0]=parseInt(<?php echo $NoPagoD[0]->numero?>,10);
          graficaCS[1]=parseInt(<?php echo $NoPagoE[0]->numero?>,10);
          graficaCS[2]=parseInt(<?php echo $NoPagoP[0]->numero?>,10);
          graficaCS[3]=parseInt(<?php echo $NoPagoC[0]->numero?>,10);

          data.addRows([["Pago efectivo",graficaCS[0]]]);
          data.addRows([["Pago datafono",graficaCS[1]]]);
          data.addRows([["Pago pasarela",graficaCS[2]]]);
          data.addRows([["Pago cartera",graficaCS[3]]]);
          

        var options = {
          title: 'Gráfica de ventas'
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
              <h2 class="pb-2 display-5">REPORTE DE VENTAS</h2>
            </div><br>
            <div class="row" align="center">  
              <div class="col-sm-3" align="center"></div>
                <div class="col-sm-6" align="center">
                  <div class="card" align="center">
               
                     <div align="center">
                            <div class="row">
                               <div id="piechart" style="width: 620px; height: 300px;"></div>
                          </div>

                          <div align="center">
                            <a href="{{url('almacen/reportes/ventas')}}" class="btn btn-danger">Volver</a>
                            
                          </div>
                          </div>
                  </div>
                </div>
              <div class="col-sm-3" align="center"></div>
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
              <th>No. PRODUCTOS</th>
              <th>PAGO TOTAL</th>
              <th>METODO DE PAGO</th>
            </thead>
            @foreach($ventas as $ps)
            <tr>
              <td>{{ $ps->id_factura}}</td>
              <td>{{ $ps->fecha}}</td>
              <td>{{ $ps->noproductos}}</td>
              <td>{{ $ps->pago_total}}</td>
              <td>{{ $ps->tipo_pago_id_tpago}}</td>
            </tr>   
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