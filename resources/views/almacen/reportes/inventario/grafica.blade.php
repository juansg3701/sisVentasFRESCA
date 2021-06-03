@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
  
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($productos_stock as $pastels)
              @foreach ($productos as $p)
                @if($pastels->producto_id_producto==$p->id_producto)

                  ['({{$p->nombre}}, {{$pastels->nombre_proveedor}})',{{$pastels->cantidad}}],
                @endif
              @endforeach 
            @endforeach
      ]);

        
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
                                 <div id="piechart" style="width: 800px; height: 300px;"></div>

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
               <div align="center">
            
          
          {!! Form::open(array('url'=>'almacen/reportes/inventario/descargas','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
<div class="container">
  <div class="form-group">  
    <div class="form-row col-sm-12">
      
      <div class="form-row col-sm-12">
        <div class="form-group col-sm-4">
          <div>Productos:</div>
        </div>
        <div class="form-group col-sm-8">
          <input type="hidden" name="id" value="{{$id}}">
          <select name="searchText" class="form-control">
            <option value="">Todos los productos</option>


             @foreach($productos_buscar as $pb) 
             <?php $cont=0;?>
                @foreach($ventas as $v)
                  @if($pb->id_producto==$v->producto_id_producto && $cont==0)
                  <?php $cont++;?>
                <option>{{$pb->nombre}}</option>
                  @endif
                @endforeach
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group col-sm-12">
        <span class="input-group-btn">
          <button id="btnBuscar" type="submit"  class="btn btn-primary">Buscar</button>
        </span>
      </div>

    </div>
  </div>
</div>
{{Form::close()}}
</div>
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>No. FACTURA</th>
               <th>ID PRODUCTO</th>
              <th>PRODUCTO</th>
              <th>CANTIDAD</th>
              <th>PAGO TOTAL</th>
            </thead>
            @foreach($ventas as $ps)
              @foreach($productos as $pr)
                @if($pr->id_producto==$ps->producto_id_producto)
              <tr>
              <td>{{ $ps->id_stock}}</td>
              <td>{{ $ps->fecha_registro}}</td>
              <td>{{ $ps->noFactura}}</td>
              <td>{{$pr->id_producto}}</td>
              <td>{{ $pr->nombre}}</td>
              <td>{{ $ps->cantidad}}</td>
              <td>{{ $ps->total}}</td>
              
            </tr>
                @endif  
              @endforeach
            @endforeach
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop