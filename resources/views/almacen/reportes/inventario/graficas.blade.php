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
              <h2 class="pb-2 display-5">REPORTE DE INVENTARIO POR SEMANA</h2>
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
                           <b> Inventario entre:</b><br>
                            <b>Inicio:</b> {{$fecha_inicial}} <br>
                            <b>Fin:</b> {{$fecha_final}}<br>
        
       
                            <b>Total compras: </b>
                            $<?php echo number_format($total_stock, 2 , "," , ".") . "\n";?>
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

            <?php
                $valores=$fecha_inicial.'.'.$fecha_final.'.'.$fecha_year.'.'.'2';
            ?>

            <div align="center">
              <a href="{{URL::action('reportesInventario@downloadExcelReport',$valores)}}"><button class="btn btn-outline-success btn-sm">Descargar Excel</button></a>
              <a href="{{URL::action('reportesInventario@downloadPDFReport',$valores)}}"><button class="btn btn-outline-danger btn-sm">Descargar PDF</button></a>
            </div>
      
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>FECHA</th>
              <th>No. PRODUCTOS</th>
              <th>PAGO TOTAL</th>
              <th>OPCIONES</th>
            </thead>
            @foreach($stock as $ps)
            <tr>
              <td>Semana del: {{ $ps->fecha_registro}} - {{$ps->year}}</td>
              <td>{{ $ps->cantidad_rep}}</td>
              <td>$<?php echo number_format($ps->total, 2 , "," , ".") . "\n";?></td>
             
            <td> 
                <?php
                $valores2=$ps->fecha_registro.'.'.$ps->year.'.'.$fecha_final.'.'.'s';
                ?>
                
                <a href="{{url('almacen/inventario/editproductos/'.$valores2)}}">
                <button class="btn btn-outline-primary btn-sm">Detalle</button>
                </a></td>
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
        fillColor : "#BDECB6",
        strokeColor : "#77DD77",
        pointColor : "#77DD77",
        pointStrokeColor : "#77DD77",
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