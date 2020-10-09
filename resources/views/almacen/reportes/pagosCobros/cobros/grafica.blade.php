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

        graficaCS[0]=parseInt(<?php echo $atrasados[0]->atrasado?>,10);
        graficaCS[1]=parseInt(<?php echo $pagos[0]->pago?>,10);

        data.addRows([["Facturas Atrasadas",graficaCS[0]]]);
        data.addRows([["Facturas Pagas",graficaCS[1]]]);
          
        var options = {  
          title: 'Gráfica de Facturas por cobrar'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
   </head>

<body>

	<div class="row">
			 <div id="piechart" style="width: 620px; height: 300px;"></div>
	</div>

	<div align="center">
    <a href="{{URL::action('reportesPC2@index',0)}}"><button class="btn btn-danger">Volver</button></a>
  </div>

</body>
@stop


@section('tabla')
<div class="container">
<div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>ID</th>
              <th>CUOTAS TOTALES</th>
              <th>CUOTAS RESTANTES</th>
              <th>CLIENTE</th>
              <th>CORREO CL.</th>
              <th>TOTAL</th>
              <th>FECHA</th>
              <th>ATRASO</th>
              <th>FACTURA</th>
             
            </thead>
            @foreach($productos as $ps)
            <tr>
              <td>{{ $ps->id}}</td>
              <td>{{ $ps->cuotasTotales}}</td>
              <td>{{ $ps->cuotasRestantes}}</td>
              <td>{{ $ps->nombre}}</td>
              <td>{{ $ps->correo}}</td>
              <td>{{ $ps->valortotal}}</td>
              <td>{{ $ps->fecha}}</td>
              <td>{{ $ps->atraso}}

              @if($ps->cuotasRestantes!='0')
                <input type="color" value="#ff0000"  disabled="true">
                @endif
                @if($ps->cuotasRestantes=='0')
                <input type="color" value="#008f39"  disabled="true">
                @endif

              </td>

              <td>{{ $ps->nofactura}}</td>
              
            </tr>   
            @endforeach
          </table>
        </div>
        {{$productos->render()}}

      </div><br>
      </div>
@stop