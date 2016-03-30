{!! Form::open(['route'=>'roles.index','method'=>'GET']) !!}
	{!! Form::text('scope',null,['placeholder'=>'Buscar Nombre']) !!}
{!! Form::close() !!}

<a href="{{ route('roles.create') }}">CREAR</a>
			<h3>
				ROLES DEL SISTEMA
			</h3>
			<table>
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							NOMBRE
						</th>
						<th>
							ESTADO
						</th>
						<th>
							ACCIONES
						</th>
					</tr>
				</thead>
				<tbody>	
				@foreach($objRoles as $objRol)
					<tr>
						<td>{{ $objRol->id }}</td>
						<td>{{ $objRol->nombre }}</td>
						<td>{{ $objRol->estado }}</td>
						<td>
<a href="{{ route('roles.edit',$objRol->id)}}">EDITAR</a>
<a href="{{ route('roles.destroy',$objRol->id)}}">Eliminar</a>

						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>

				{!! $objRoles->render() !!}	
