
@extends ('layouts.admin')
@section ('contenido')
  
  
<head>
  <title>Proveedor</title>
   <script data-require="chart.js@*" data-semver="1.0.2" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['Método de pago', 'numero'],
            ['Efectivo',{{$NoPagoEfectivo[0]->numero}}],['T. crédito',{{$NoPagoTcredito[0]->numero}}],['T. debito',{{$NoPagoTdebito[0]->numero}}],
            ['Link de pago',{{$NoPagoLinkPago[0]->numero}}]
      ]);
        
        var options = {  
          title: 'Gráfica de ventas por método de pago'
        };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
</head>
@stop

@section('tabla')

  <body>
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="container" aling="center">
    
    <h1 style="color:#000099">SOFTWARE COSECHA FRESCA</h1>
    <hr>
    <h2 style="color:#0000CC">Punto No.1: Calle 109</h2>
    <hr>
        <div class="container">
        <div class="col-sm-12" align="center">
          <div align="center">
            <br>
              <b>Total ventas del d&iacute;a: </b>
              @if(count($total_ventas)>0)
              $<?php echo number_format($total_ventas[0]->pago_total , 2 , "," , ".") . "\n";?>
              @endif
            <br>
          </div>
            <br>   
        </div>
        <div class="row" align="center">
        <div  class="col-sm-12" align="center">
           <canvas id="buyers"style="width:800px; height:400px; overflow-x: auto; overflow-y: auto;  white-space: nowrap;"></canvas>
        </div>
      </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6" align="center">
          <div align="center">
            <br>
              <b>M&eacute;todos de pago del d&iacute;a: </b>
            <br>
          </div>
            <br>   
        </div>
                <div class="col-sm-6" align="center">
          <div align="center">
            <br>
              <b>No. productos de Inventario <br/> en las &uacute;ltimas 3 semanas: </b>
            <br>
          </div>
            <br>   
        </div>

      </div>
    
    <div class="row">
        <div  class="col-sm-6" align="center">
           <div id="piechart" style="width: 400px; height: 400px;"></div>
        </div>
        <div  class="col-sm-6" align="center">
           <canvas id="bar2"style="width:300px; height:200px; overflow-x: auto; overflow-y: auto;  white-space: nowrap;"></canvas>
        </div>
      </div>
</div>
          </div>
        </div>
    </div>
  
 <script>
  //ARREGLAR PARA SUMAR POR DIAS LAS VENTAS Y DEJAR EL TOTAL
  var buyerData = {
    labels : [@foreach($ventas as $ps)
              "{{$ps->fecha}}",
              @endforeach],
    datasets : [
      {
        fillColor : "#AFCBFF",
        strokeColor : "#85E3FF",
        pointColor : "#6EB5FF",
        pointStrokeColor : "#6EB5FF",
        data : [@foreach($ventas as $ps)
              "{{$ps->pago_total}}",
              @endforeach]
        
      }
    ]
  }
  var barData2 = {
    labels : [@foreach($stock_semanal as $ps)
              "{{$ps->fecha_registro}}",
              @endforeach],
    datasets : [
      {
        fillColor : "#AFCBFF",
        strokeColor : "#85E3FF",
        pointColor : "#6EB5FF",
        pointStrokeColor : "#6EB5FF",
        data : [@foreach($stock_semanal as $ps)
              "{{$ps->cantidad_rep}}",
              @endforeach]
      }
    ]
  }

  var buyers = document.getElementById('buyers').getContext('2d');
  new Chart(buyers).Line(buyerData, {
    animation: true,
    animationSteps: 100,
    animationEasing: "easeOutQuart",
    scaleFontSize: 16,
    responsive: true,
    showTooltip: true,
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
    
    scaleShowGridLines : false,
    bezierCurve : false,
    pointDotRadius : 5,

  });

  var bar2 = document.getElementById('bar2').getContext('2d');
  new Chart(bar2).Bar(barData2, {
    animation: true,
    animationSteps: 100,
    animationEasing: "easeOutQuart",
    scaleFontSize: 16,
    responsive: true,
    showTooltip: true,
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
    
    scaleShowGridLines : false,
    bezierCurve : false,
    pointDotRadius : 5,

  });
</script>

</body>
@stop