@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{asset('assets/js/jQuery.js')}}"></script>

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
          title: 'Gráfica de inventarios No.1\nFecha registro: <?php echo $fechaR1?>\nId: <?php echo $id1?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);





          var graficaCS2 = [];


          var data2 = new google.visualization.DataTable();

           data2.addColumn('string', 'Producto');
           data2.addColumn('number', 'Cantidad');


            graficaCS2[0]=parseInt(<?php if($Transformado2[0]->numero==""){
                echo 0;}else{
                echo $Transformado2[0]->numero;
                    }?>,10);
           graficaCS2[1]=parseInt(<?php if($NoTransformado2[0]->numero==""){
                echo 0;}else{
                echo $NoTransformado2[0]->numero;
                    }?>,10);

           data2.addRows([["Transformado",graficaCS2[0]]]);
           data2.addRows([["No transformado",graficaCS2[1]]]);
          
           
        var options2 = {
          title: 'Gráfica de inventarios No.2\nFecha registro: <?php echo $fechaR2?>\nId: <?php echo $id2?>'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
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
              <h2 class="pb-2 display-5">ELEGIR REPORTES</h2>
            </div><br>
            <div class="row" align="center">  
              <div class="col-sm-3" align="center"></div>
                <div class="col-sm-6" align="center">
                  <div class="card" align="center">
               
                     <div align="center">
                         
                     {!! Form::open(array('url'=>'almacen/reportes/compararGI1','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

            <div class="form-row">
                  <div class="form-group col-sm-4">
                    <div>Reporte 1:</div>
                  </div>
                  <div class="form-group col-sm-8">
                    <select name="id1" class="form-control">
                        @foreach($reportes as $r)
                        <option value="{{$r->id_rInventario}}">No: {{$r->id_rInventario}}, Fecha: {{$r->fechaActual}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>

            <div class="form-row">
                  <div class="form-group col-sm-4">
                    <div>Reporte 2:</div>
                  </div>
                  <div class="form-group col-sm-8">
                    <select name="id2" class="form-control">
                          @foreach($reportes as $r)
                          <option value="{{$r->id_rInventario}}">No: {{$r->id_rInventario}}, Fecha: {{$r->fechaActual}}</option>
                          @endforeach
                      </select>
                  </div>
            </div>

          <span class=""><button type="submit" class="btn btn-info">Comparar</button></span>
                
          {!!Form::close()!!} 

                             <div align="center"><a href="{{URL::action('reportesInventario@index',0)}}"><button class="btn btn-danger">Volver</button></a></div>
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
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTES DE INVENTARIOS</h2>
            </div><br>
            <div class="row" align="center">
                <div class="col-sm-12" align="center">
                  
               
                     <div align="center" class="row">
                               <div class="col-sm-6">  
                                   <div id="piechart" style="width: 550px; height: 500px;"></div>
                                </div>

                                <div class="col-sm-6">  
                                  <div id="piechart2" style="width: 550px; height: 500px;"></div>
                                </div>

                       </div>
                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <script type="text/javascript">
  //Esconder el menu para tener toda la pantalla
  $(document).ready(function(){
    
    document.getElementById("menuToggle").click();
   

});
</script>
@stop