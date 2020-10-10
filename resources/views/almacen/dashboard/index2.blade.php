
@extends ('layouts.admin')
@section ('contenido')
  
  
<head>
  <title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
   
</head>


@stop

@section('tabla')

  <body>
  <div class="container">
      <?php
      setlocale(LC_TIME, "spanish");
      $mes= strftime("%B");
      $dia= strftime("%e");

      $fecha_actual = date("Y-m");
       $fechaN1=date("Y-m",strtotime($fecha_actual."- 1 month"));
       $fechaN2=date("Y-m",strtotime($fecha_actual."- 2 month"));
       $fechaN3=date("Y-m",strtotime($fecha_actual."- 3 month")); 

     
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    ?>
<div class="col-sm-6">
<h4>Ingresos: últimos 3 meses</h4>
<canvas id="myChart"></canvas> 
</div>
<br>
<div class="col-sm-6">
<h4>Ingresos - egresos: <?php echo $mes;?></h4>
<canvas id="myChart2"></canvas>
</div>
<br>
<div class="col-sm-6" align="center">
  <h4>Ingresos - egresos: <?php echo $dia;?> de <?php echo $mes;?></h4>
<canvas id="myChart1"></canvas>
</div>
<br>
<div class="col-sm-6">
<h4>Cartera: últimos 3 meses</h4>
<canvas id="myChart3"></canvas> 
</div>

<script src="chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["<?php echo $fechaN3;?>",
                  "<?php echo $fechaN2;?>",
                  "<?php echo $fechaN1;?>"],
        datasets: [{
          label:["Ingresos"],
            backgroundColor: '#64bca5',
            borderColor: 'gray',
            data: []
        }]},
    options: {responsive: true,
        scales: {
       xAxes: [{
                   gridLines: {
                       color: "rgba(0, 0, 0, 0)",
                   }
               }],
       yAxes: [{
                    ticks: {
                                beginAtZero: true
                            },
                   gridLines: {
                       color: "rgba(0, 0, 0, 0)",
                   }   
               }]
       }
    }
});

var ctx = document.getElementById('myChart3').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["<?php echo $fechaN3;?>",
                  "<?php echo $fechaN2;?>",
                  "<?php echo $fechaN1;?>"],
        datasets: [{
          label:'Pago',
            backgroundColor: '#42a5f5',
            borderColor: 'gray',
            data: []
        },
          {
          label:'Sin pagar',
            backgroundColor: '#ffab91',
            borderColor: 'gray',
            data: []
        }
        ]},
    options: {responsive: true,
        scales: {
       xAxes: [{
                   gridLines: {
                       color: "rgba(0, 0, 0, 0)",
                   }
               }],
       yAxes: [{
                    ticks: {
                                beginAtZero: true
                            },
                   gridLines: {
                       color: "rgba(0, 0, 0, 0)",
                   }   
               }]
       }
    }
   
});
var ctx1 = document.getElementById('myChart1').getContext('2d');
var chart = new Chart(ctx1, {
    type: 'doughnut',
    data:   
    {
                datasets: [{
                     data: [],
                    backgroundColor: ['#DB7093', '#ADD8E6', '#B28DFF','#5F9EA0']
                }],
                labels: [
                    'Ingresos en efectivo',
                    'Egresos en efectivo',
                    'Ingresos electrónicos',
                    'Egresos electrónicos'
                ]},
    options: {}
});
var ctx2 = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx2, {
    type: 'doughnut',
    data:   
    {
                datasets: [{
                     data: [],
                    backgroundColor: ['#42a5f5', '#fcb63e', '#64bca5','#a7a3bb']
                   
                }],
                labels: [
                    'Ingresos en efectivo',
                    'Egresos en efectivo',
                    'Ingresos electrónicos',
                    'Egresos electrónicos'
                ]},
    options: {}
});
</script>
</div>
</body>
@stop