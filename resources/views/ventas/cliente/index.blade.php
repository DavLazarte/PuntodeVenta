@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="cliente/create"><button class="btn btn-success" title="Nuevo Cliente"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a> <a href="{{url('reporteclientes')}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text" aria-hidden="true" title="reporte total"></i></button></a></h3>
		@include('ventas.cliente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo Doc.</th>
					<th>Número Doc.</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
               @foreach ($personas as $per)
				<tr>
					<td>{{ $per->idpersona}}</td>
					<td>{{ $per->nombre}}</td>
					<td>{{ $per->tipo_documento}}</td>
					<td>{{ $per->num_documento}}</td>
					<td>{{ $per->telefono}}</td>
					<td>{{ $per->email}}</td>
					<td>
						<a href="{{URL::action('ClienteController@edit',$per->idpersona)}}"><button class="btn btn-info" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                        <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                        <a target="_blank" href="{{URL::action('ClienteController@report',$per->idpersona)}}"><button class="btn btn" title="reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button></a>					
					</td>
				</tr>
				@include('ventas.cliente.modal')
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liClientes').addClass("active");
</script>
@endpush
@endsection