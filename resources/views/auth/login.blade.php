@extends('layouts.app2')

@section('content')
<style type="text/css">
    .botonimagen{
  background-image:url(images/entrar.png);
  width: 220px;
  height:30px;
}
</style>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group" align="center">
                            <div class="col-md-6" align="center">

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" align="center">

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Usuario" style="width: 230px; height: 40px">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" align="center">
                           
                            <div class="col-md-10" align="center">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" style="width: 230px; height: 40px">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-12">
                   
                                <button type="submit" class="botonimagen">
                                     <img src="images/entrar.png" height="30" width="220">
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                            </div>
                        </div>


                        
                    </form>

@endsection
