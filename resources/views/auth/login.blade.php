@extends('layouts.app')

@section('content')
<style type="text/css">
    .botonimagen{
  background-image:url(images/entrar.png);
  width: 220px;
  height:30px;
}
</style>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" >
                        {{ csrf_field() }}
                        <div  align="center">
                            <div class="col-md-12" align="center">
                                <div class="col-md-12">
                               
                            @if($errors->has('email')==false && $errors->has('password')==false)
                            <br></br>
                            <label style="color:  #2980b9 ">Ingresa tus datos por favor</label>
                            @endif

                            </div>
              
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" align="center">
                                
                            <div class="col-md-12">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>El campo correo es obligatorio</strong>
                                    </span>
                                @endif
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Usuario" style="width: 230px; height: 30px;">

                             
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" align="center">
                           
                            <div class="col-md-12" align="center">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" style="width: 230px; height: 30px">

                                
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-12">
                   
                                <input type="image" class="" src="{{asset('images/entrar.png')}}" height="25" width="240">

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                            </div>
                        </div>


                        
                    </form>

@endsection
