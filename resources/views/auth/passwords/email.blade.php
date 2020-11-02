@extends('layouts.app')

<!-- Main Content -->
@section('content')

               
                <div class="panel-body">
                     <div class="col-md-12">
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @else
                        <label style="color:  #2980b9 ">Ingresa tus datos para resetear contraseña por favor</label>
                        <br></br>
                        @endif

                        
                     </div>
                    

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           

                            <div class="col-md-12">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ingrese correo">

                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="{{url('')}}"><button type="button" class="btn btn-danger">
                                     Volver
                                </button></a>
                                <button type="submit" class="btn btn-primary">
                                     Enviar link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

@endsection
