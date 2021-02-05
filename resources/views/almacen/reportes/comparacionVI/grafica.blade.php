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

            graficaCS[0]=parseInt(<?php echo $NoPagoD[0]->numero?>,10);
           graficaCS[1]=parseInt(<?php echo $NoPagoE[0]->numero?>,10);
          graficaCS[2]=parseInt(<?php echo $NoPagoP[0]->numero?>,10);

           data.addRows([["Pago efectivo",graficaCS[0]]]);
           data.addRows([["Pago datafono",graficaCS[1]]]);
           data.addRows([["Pago pasarela",graficaCS[2]]]);
          

        var options = {
          title: 'Gráfica de ventas \n'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);

          var graficaCS2 = [];


          var data2 = new google.visualization.DataTable();

           data2.addColumn('string', 'Producto');
           data2.addColumn('number', 'Cantidad');

            graficaCS2[0]=parseInt(<?php echo $Transformado[0]->numero?>,10);
           graficaCS2[1]=parseInt(<?php echo $NoTransformado[0]->numero?>,10);

           data2.addRows([["Transformado",graficaCS2[0]]]);
           data2.addRows([["No transformado",graficaCS2[1]]]);
          
           
        var options2 = {
          title: 'Gráfica de inventario \n'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
      }
    </script>
   </head>
 
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTES DE COMPARACI&Oacute;N</h2>
            </div><br>
            <div class="row" align="center">
                <div class="col-sm-12" align="center">
               
                     <div align="center" class="row">
                               <div class="col-sm-6">
                               	<div align="center">
                               		
                               	
                                <?php 
                             $total_ventas=$NoPagoD[0]->numero+$NoPagoE[0]->numero+$NoPagoP[0]->numero;
                             ?> 
                             <br>
                           <b> Ventas generadas entre:</b><br>
                            {{$r->fechaInicial}} y {{$r->fechaFinal}}<br>
                            <b>Total ventas:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                            </div>
                            <div id="piechart" style="width: 500px; height: 500px;"></div>
                                  
                                </div>

                                <div class="col-sm-6"> 
                                <div align="center">
                                	  <?php 
                             $total_ventas=$Transformado[0]->numero+$NoTransformado[0]->numero;
                             ?> 
                             <br>
                           <b> Compras generadas entre:</b><br>
                            {{$r->fechaInicial}} y {{$r->fechaFinal}}<br>
                            <b>Total comprado:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                                </div> 
                                  <div id="piechart2" style="width: 500px; height: 500px;"></div>
                                </div>

                       </div>
                <div align="center"><a href="{{URL::action('reportesComparacion@index',0)}}"><button class="btn btn-danger">Volver</button></a></div>  
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