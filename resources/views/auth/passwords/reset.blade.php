@extends('layouts.app')

@section('content')

                

                <div class="panel-body">
                    <div class="col-md-12">
                         @if($errors->has('email')==false && $errors->has('password')==false && $errors->has('password_confirmation')==false)


                        <label style="color:  #2980b9 ">Resetear contraseña</label>
                        
                        @endif
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Correo" style="height: 25px">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>Verifica datos</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" style="height: 25px">

                                @if ($errors->has('password') && $errors->has('email')==false)
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                     
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" style="height: 25px">

                                @if ($errors->has('password_confirmation') && $errors->has('email')==false)
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <a href="{{url('')}}"><button type="button" class="btn btn-danger" style="height: 30px">
                                     Volver
                                </button></a>
                                <button type="submit" class="btn btn-primary" style="height: 30px">
                                     Resetear contraseña 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
  
@endsection
