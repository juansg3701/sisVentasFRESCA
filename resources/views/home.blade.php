@extends('layouts.app')

@section('content')

               

                <div class="panel-body">
                    <label style="color:  #2980b9 ">¡¡Ya ingresaste!!</label>
                    <br></br>
                
                    <form class="user">
                    	<a href="{{url('')}}">
                            <button type="button" class="btn btn-outline-primary btn-user btn-block">
                                Ir al inicio del sistema
                            </button>
                        </a>
                    </form>
                    
                </div>

@endsection
