<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link  rel="icon"   href="img/Logo1.jpeg" type="image/jpeg" />

    <title>Cosecha Fresca</title>

    <!-- Fonts -->
     <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/estilos.css')}}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .izquierda{
  background-color: white;
  height: 350px;
  width: 300px;
  

    }
    .centro{
     background-image: url(images/barra.png);
      height: 350px;
  width: 4px;
       
           
    }
    .derecha{
        background-image: url(images/derecha.png);
         height: 350px;
  width: 300px;

    }
 .grid-1 {
  display: grid;
  width: 100%;
  max-width: 1060px;
  margin: 0 auto;
  margin-top: 20px;
  grid-template-columns: repeat(6, 2fr);
  grid-template-rows: repeat(6, 85px);
  grid-gap: 20px;
}

.grid-2 {
  display: grid;
  width: 100%;
  max-width: 650px;
  margin: 0 auto;
  grid-template-columns: repeat(2, 2fr);
  grid-template-rows: repeat(2, 180px);
  grid-gap: 20px;
}

/* items */

.grid-1 div {
  color: white;

  }

/* specific item styles */

.item-1 {
  background: white;
  grid-column: 2 / span 4;
  grid-row: 2 / span 4;
}


.item-botones {
  background: white;
  grid-column: 1 / span 1;
  grid-row: 2 / span 1;
}
.item-imagenD {
  background: white;
  grid-column: 2 / span 1;
  grid-row: 1 / span 2;
}
.item-imagenI {
  background: white;
  grid-column: 1 / span 1;
  grid-row: 1 / span 1;
}
.botonimagen{
  background-image:url(images/entrar.png);
}



    </style>
</head>
<body id="app-layout" background="{{asset('images/bck.png')}}">
          


<section class="grid-1">

  <div class="item-1" align="right">

    <section class="grid-2">
        <div class="item-imagenI"><img src="images/controler.png" width="290" height="160" style="margin-top: 30px"></div>

        <div class="item-botones">
            @yield('content')

          </div>

          <div class="item-imagenD" align="right" ><img src="images/derecha.png" width="350" height="400" style="margin-left: 20px"></div>
    </section>
   
       

  </div>

</section>




    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
