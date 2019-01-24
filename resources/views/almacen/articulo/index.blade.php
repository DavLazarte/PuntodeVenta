@extends ('layouts.admin')
@section ('contenido')
<div class="row">
@if (session('status_edit'))
    <div class="alert alert-success fade in">
    	<button class="close" data-dismiss="alert"><span>&times;</span></button>
    	{{ session('status_edit') }}
    </div>
@endif
    @if (session('status_delete'))
        <div class="alert alert-danger fade in">
        	<button class="close" data-dismiss="alert"><span>&times;</span></button>
        	{{ session('status_delete') }}
        </div>
    @endif
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Prendas <a href="articulo/create"><button class="btn btn-success" title="Agregar prenda"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a> <a href="{{url('reportearticulos')}}" target="_blank"><button class="btn btn-info" title="Generar Reporte"><i class="fa fa-book" aria-hidden="true"></i></button></a></h3>
		@include('almacen.articulo.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Código</th>
					<th>Descripción</th>
					<th>Categoría</th>
					<th>Precio</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
					<td>{{ $art->codigo}}</td>
					<td>{{ $art->descripcion}}</td>
					<td>{{ $art->categoria}}</td>
					<td>{{ $art->stock}}</td>
					<td>{{ $art->estado}}</td>
					{{-- Columna de imagenes --}}
					{{-- <td>
						<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{ $art->nombre}}" height="100px" width="100px" class="img-thumbnail">
					</td> --}}
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info" title="EDITAR"><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></button></a>
                         <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger" title="ELIMINAR"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");
</script>
@endpush
@endsection