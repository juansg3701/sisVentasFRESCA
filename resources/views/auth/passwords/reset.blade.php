@extends('layouts.app')

@section('content')

                <div class="col-md-12">
                         @if($errors->has('email')==false && $errors->has('password')==false && $errors->has('password_confirmation')==false)


                        <label style="color:  #5e2129 ">Resetear contraseña</label>
                        
                        @endif
                    </div>

                    <form class="user" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           

                     
                            <div class="form-group">
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <label style="color:  #5e2129 ">Verifica datos</label>
                                    </span>
                                @endif
                            <input type="email" class="form-control form-control-user" id="email"
                                   placeholder="Ingrese correo"
                                   onkeypress="return neverSpaceOther(event)" 
                                   name="email" 
                                   value="{{ $email or old('email') }}">
                          
                               
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                            <div class="form-group">
                                @if ($errors->has('password') && $errors->has('email')==false)
                                    <span class="help-block">
                                        <label style="color:  #5e2129 ">{{ $errors->first('password') }}</label>
                                    </span>
                                @endif
                            <input type="password" class="form-control form-control-user" id="password"
                                   placeholder="Contraseña" 
                                   onkeypress="return neverSpaceOther(event)"
                                   name="password">

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            
                            <div class="form-group">
                                @if ($errors->has('password_confirmation') && $errors->has('email')==false)
                                    <span class="help-block">
                                        <label style="color:  #5e2129 ">{{ $errors->first('password_confirmation') }}</label>
                                    </span>
                                @endif
                            <input type="password" class="form-control form-control-user" 
                                    id="password-confirm"
                                   placeholder="Confirmar contraseña" 
                                   onkeypress="return neverSpaceOther(event)"
                                   name="password_confirmation">
                        

                                
                            </div>
                        </div>
                        <hr>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 ">
                              
                                     <button type="submit" class="btn btn-outline-primary btn-user btn-block"
                                         onclick="dataReading()"> Resetear</button>
                                </div>
                                <div class="col-md-6 ">
                                    <a href="{{url('')}}">
                                        <button type="button" class="btn btn-outline-danger btn-user btn-block">
                                            Volver
                                        </button>
                                    </a>
                                </div> 
                            </div>
                        </div>
                    </form>
  
@endsection
