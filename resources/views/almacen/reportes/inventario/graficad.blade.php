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
              <h2 class="pb-2 display-5">REPORTE DE INVENTARIO POR D&Iacute;A</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">

                            <div  class="col-sm-12" align="center">
                               <canvas id="buyers"style="width:400px; height:200px; overflow-x: auto; overflow-y: auto;  white-space: nowrap;"></canvas>

                            </div>
                          </div>
                           <div class="row" align="center">
                            <div class="col-sm-12" align="center">
                              <div align="center">
               
                             <br>
                           <b> Inventario del:</b><br>
                            {{$fecha_d}}<br>
                            <b>Total comprado: </b>
                            @if(count($total_stock)>0)
                            $<?php echo number_format($total_stock[0]->pago_total , 2 , "," , ".") . "\n";?>
                            @endif
                            <br>

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
              <th>No. PRODUCTOS</th>
              <th>PAGO TOTAL</th>
            </thead>
            @foreach($stock as $ps)
            <tr>
              <td>{{ $ps->id_stock}}</td>
              <td>{{ $ps->fecha_registro}}</td>
              <td>{{ $ps->cantidad_rep}}</td>
              <td>$<?php echo number_format($ps->total, 2 , "," , ".") . "\n"?></td>
            </tr>   
            @endforeach
          </table>
        </div>
        {{$stock->render()}}
        </div>
      </div>
    </div>
  </div>
</div>

 <script>
  //ARREGLAR PARA SUMAR POR DIAS LAS VENTAS Y DEJAR EL TOTAL
  var buyerData = {
    labels : [@foreach($stock as $ps)
              "{{$ps->fecha_registro}}",
              @endforeach],
    datasets : [
      {
        fillColor : "#AFCBFF",
        strokeColor : "#85E3FF",
        pointColor : "#6EB5FF",
        pointStrokeColor : "#6EB5FF",
        data : [@foreach($stock as $ps)
              "{{$ps->total}}",
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