@extends('layouts.app')

@section('content')
                    <form method="post" class="user" onsubmit="return validateForm()" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                    
                                    <label style="color:  #5e2129 ">Verifica tus datos</label>
                                    </span>
                                @endif
                        </div>
                     
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email"
                                   placeholder="Ingrese correo"
                                   onkeypress="return neverSpaceOther(event)" 
                                   name="email" 
                                   value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password"
                                   placeholder="Contraseña" 
                                   onkeypress="return neverSpaceOther(event)"
                                   name="password">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-outline-primary btn-user btn-block"
                           onclick="dataReading()"> Login</button>
                           <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                            
                        </a>
                    </form>


@endsection
