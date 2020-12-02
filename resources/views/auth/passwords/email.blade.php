@extends('layouts.app')

<!-- Main Content -->
@section('content')

                     <div class="col-md-12">
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @else
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <label style="color:  #5e2129 ">Verifica tus datos</label>
                                    </span>
                                @else
                                <label style="color:  #5e2129 ">Ingresa tus datos para resetear la contraseña por favor</label>
                                @endif
                        <br>
                        @endif

                        
                     </div>
                    

                    <form role="form" method="POST" action="{{ url('/password/email') }}" class="user">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              

                            <div class="form-group">
                                
                            <input type="email" class="form-control form-control-user" id="email"
                                   placeholder="Ingrese correo"
                                   onkeypress="return neverSpaceOther(event)" 
                                   name="email" 
                                   value="{{ old('email') }}">
                            </div>
                        </div>
                        <hr>

                         <div class="container">
                            <div class="row">
                                <div class="col-md-6 ">
                              
                                     <button type="submit" class="btn btn-outline-primary btn-user btn-block"
                                         onclick="dataReading()"> Enviar link</button>
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
