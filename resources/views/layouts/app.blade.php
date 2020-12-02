<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link  rel="icon"  href="{{asset('images/Logo1.jpeg')}}" type="image/jpeg" />

    <title>Cosecha Fresca</title>

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

   
</head>


<body background="{{asset('images/bakcground_image.jpg')}}">
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <a href="https://controler.com.co/" target="_blank">
                                        <img src="{{asset('images/controler.jpg')}}" style="width: 19rem; padding-bottom: 2%">
                                    </a>
                                    <h5 style="padding-bottom: 1%">Cosecha fresca</h5>
                                </div>
                                <div align="center">
            
                                  @yield('content')
                                </div>
                               
                            </div>

                        </div>

                        <div class="col-lg-6 d-none d-lg-block">
                            <a href="https://controler.com.co/" target="_blank">
                                <img src="{{asset('images/controlerPanel.png')}}" style="width: 31rem; padding-bottom: 0%">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--Close row-->

</div>



<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>
</html>
