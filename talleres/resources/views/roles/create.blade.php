
@if(count($errors)>0)
	@foreach($errors->all() as $error)
		<p>{{ $error }} </p><br/>
	@endforeach
@endif

{!! Form::open(['route'=>'roles.store','method'=>'POST']) !!}

	{!! Form::label('nombre','Nombre: ') !!}
	{!! Form::text('nombre',null,["required"=>"required"])!!}

	{!! Form::label('estado','Estado:') !!}
	{!! Form::select('estado',['activo'=>'Activo','inactivo'=>'inactivo']) !!}


{!! Form::label('permisos','Permisos:') !!}
	{!! Form::select('permisos[]',$permisos,null,['multiple'=>'true']) !!}


	{!! Form::submit('Grabar') !!}
{!! Form::close() !!}