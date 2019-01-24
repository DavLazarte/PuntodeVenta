@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<h3>Salidas<a href="salida/create"> <button class="btn btn-success" title="Nueva Salida"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></h3>
		@include('salida.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Destino</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
               @foreach ($salidas as $sal)
				<tr>
					<td>{{ Carbon\Carbon::parse($sal->created_at)->format('d-m-Y') }}</td>
					<td>{{ $sal->monto}}</td>
					<td>{{ $sal->destino}}</td>
					<td>{{ $sal->descripcion}}</td>
					<td>
						<a href="{{URL::action('SalidaController@edit',$sal->id)}}"><button class="btn btn-primary" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
						<a href="" data-target="#modal-delete-{{$sal->id}}" data-toggle="modal"><button class="btn btn-danger" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                        <a target="_blank" href="{{URL::action('SalidaController@reportec',$sal->id)}}"><button class="btn btn-warning" title="Reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button></a>
					</td>
				</tr>
				@include('salida.modal')
				@endforeach
			</table>
		</div>
		{{-- {{$salidas->render()}} --}}
	</div>
</div>
@push ('scripts')
<script>
$('#liotrpras').addClass("treeview active");
$('#liIngresos').addClass("active");
</script>
@endpush
@endsection