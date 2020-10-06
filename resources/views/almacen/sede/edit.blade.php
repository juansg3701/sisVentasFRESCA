@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Sede: {{$sede->nombre_sede}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

	{!!Form::model($sede,['method'=>'PATCH','route'=>['almacen.sede.update',$sede->id_sede]])!!}
    {{Form::token()}}

	<div id=formulario>
		<!--Id: <input type="text" class="form-control" value="{{$sede->id_sede}}" name="id_sede">-->
		Nombre:<input type="text" class="form-control" value="{{$sede->nombre_sede}}" name="nombre_sede">
		Ciudad:<input type="text" class="form-control" value="{{$sede->ciudad}}" name="ciudad">
		Característica:<input type="text" class="form-control" value="{{$sede->descripcion}}" name="descripcion">
		Dirección:<input type="text" class="form-control" value="{{$sede->direccion}}" name="direccion">
		Teléfono:<input type="number" class="form-control" value="{{$sede->telefono}}" name="telefono">
			<br>
			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{url('almacen/sede')}}" class="btn btn-danger">Volver</a>
	</div>

	<div class="row" align="center">
		<div class="col-sm-12" align="center">
			<h2>EDITAR SEDE</h2>
			                        <div class="card" align="center">
                                    <div class="card-header">
                                        <strong>Formulario de registro</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="hf-email" name="hf-email" placeholder="Enter Email..." class="form-control">
                                                    <span class="help-block">Please enter your email</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="hf-password" name="hf-password" placeholder="Enter Password..." class="form-control">
                                                    <span class="help-block">Please enter your password</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </div>
		</div>
	</div>





                                <div class="card">
                                    <div class="card-header">
                                        <strong>Normal</strong> Form
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="">
                                            <div class="form-group">
                                                <label for="nf-email" class=" form-control-label">Email</label>
                                                <input type="email" id="nf-email" name="nf-email" placeholder="Enter Email.." class="form-control">
                                                <span class="help-block">Please enter your email</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="nf-password" class=" form-control-label">Password</label>
                                                <input type="password" id="nf-password" name="nf-password" placeholder="Enter Password.." class="form-control">
                                                <span class="help-block">Please enter your password</span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                

	
{!!Form::close()!!}		
</body>

@stop