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
          title: 'Gráfica de Facturas por pagar'
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
    <a href="{{URL::action('reportesPC@index',0)}}"><button class="btn btn-danger">Volver</button></a>
  </div>

</body>
@stop


@section('tabla')

<div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>ID</th>
              <th>CUOTAS TOTALES</th>
              <th>CUOTAS RESTANTES</th>
              <th>NOMBRE FACTURA</th>
              <th>DESCRIPCION</th>
              <th>BANCO</th>
              <th>NO. CUENTA</th>
              <th>INTERESES</th>
              <th>EMPLEADO</th>
              <th>SALDO FINAL</th>
              <th>ATRASO</th>
             
            </thead>
            @foreach($productos as $ps)
            <tr>
              <td>{{ $ps->id_ctaspagar}}</td>
              <td>{{ $ps->cuotas_totales}}</td>
              <td>{{ $ps->cuotas_restantes}}</td>
              <td>{{ $ps->nombrepago}}</td>
              <td>{{ $ps->descripcion}}</td>
              <td>{{ $ps->bancos}}</td>
              <td>{{ $ps->nocuenta}}</td>
              <td>{{ $ps->intereses}}</td>
              <td>{{ $ps->nombreE}}</td>
              <td>{{ $ps->total}}</td>
              <td>
                @if($ps->cuotas_restantes!='0')
                <input type="color" value="#ff0000"  disabled="true">
                @endif
                @if($ps->cuotas_restantes=='0')
                <input type="color" value="#008f39"  disabled="true">
                @endif
              </td>

            </tr>   
            @endforeach
          </table>
        </div>
        {{$productos->render()}}
      </div>
      </div><br>
@stop