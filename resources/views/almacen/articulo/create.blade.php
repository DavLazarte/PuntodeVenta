@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Cargar Prenda</h3>
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
    @if (session('status'))
        <div class="alert alert-success fade in">
            <button class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ session('status') }}
        </div>
    @endif
	{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
<div class="row">
    	{{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre"  value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div> --}}
    	<div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Categoría</label>
    			<select name="idcategoria" required class="form-control selectpicker" title="Elegir Categoria">
    				@foreach ($categorias as $cat)
                       <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
    				@endforeach
    			</select>
    		</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
        		<input type="text" name="descripcion" value="{{old('descripcion')}}" required class="form-control" placeholder="Descripción de la prenda">
        	</div>
			<div class="form-group">
				<label for="precio">Precio</label>
            	<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Precio de la prenda">
            </div>
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" id="codigobar" required value="00000000" class="form-control" >
				<br>
				<button class="btn btn-success" type="button" onclick="generarBarcode()">Generar</button>
				<button class="btn btn-info" onclick="imprimir()"type="button">imprimir</button>
				<div id="print">
					<svg id="barcode"></svg>
				</div>
			</div>
		</div>
    	{{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control">
            </div>
    	</div> --}}

    	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
</div>
            
{!!Form::close()!!}
@push ('scripts')
<script src="{{asset('js/JsBarcode.all.min.js')}}"></script>
<script src="{{asset('js/jquery.PrintArea.js')}}"></script>
<script>
function generarBarcode()
{   
    codigo=$("#codigobar").val();
    JsBarcode("#barcode", codigo, {
    format: "EAN13",
    font: "OCRB",
    fontSize: 18,
    textMargin: 0
    });
}
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");


//Código para imprimir el svg
function imprimir()
{
    $("#print").printArea();
}

</script>
@endpush

@endsection