@extends ('layouts.admin')
@section ('contenido')
<!DOCTYPE html>
      <script data-require="chart.js@*" data-semver="1.0.2" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <link rel="stylesheet" href="style.css" />
 
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
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                            <div  class="col-sm-12" align="center">
                               <canvas id="buyers"style="width:400px; height:200px; overflow-x: auto; overflow-y: auto;  white-space: nowrap;"></canvas>

                            </div>
                            <div  style="width:100px; height:100px; overflow-x: auto; overflow-y: hidden;  white-space: nowrap;">Aquí saldrá un scroll sólo dale interlineados simple
no ?
</div>


                            <div class="col-sm-4">
                              <div align="center">
                                <?php 
                             $total_ventas=$NoPagoD[0]->numero+$NoPagoE[0]->numero+$NoPagoP[0]->numero;
                             ?> 
                             <br>
                           <b> Ventas generadas entre:</b><br>
                            {{$r->fechaInicial}} y {{$r->fechaFinal}}<br>
                            <b>Total ventas:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                              </div>
                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/ventas')}}" class="btn btn-danger">Volver</a>
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
 <script>
  //ARREGLAR PARA SUMAR POR DIAS LAS VENTAS Y DEJAR EL TOTAL
  var buyerData = {
    labels : [@foreach($ventas as $ps)
              "{{$ps->fecha}}",
              @endforeach],
    datasets : [
      {
        fillColor : "blue",
        strokeColor : "red",
        pointColor : "green",
        pointStrokeColor : "yellow",
        data : [@foreach($ventas as $ps)
              "{{$ps->pago_total}}",
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
</script>
@stop