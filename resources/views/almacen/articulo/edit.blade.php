@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Prenda: {{ $articulo->codigo}}</h3>
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
        
        {!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
        {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Categoría</label>
                <select name="idcategoria" class="form-control">
                    @foreach ($categorias as $cat)
                        @if ($cat->idcategoria==$articulo->idcategoria)
                       <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                       @else
                       <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                       @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="descripcion">Talle</label>
                <input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
            </div>
            <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" required value="{{$articulo->precio}}" class="form-control">
                </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" required value="{{$articulo->estado}}" class="form-control">
            </div>
        {{-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
                @if (($articulo->imagen)!="")
                <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
                @endif
            </div>
        </div> --}}
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" name="codigo" id="codigobar" required value="{{$articulo->codigo}}" class="form-control">
            {{-- 
            <br>
                <button class="btn btn-success" type="button" onclick="generarBarcode()">Generar</button>
                <button class="btn btn-info" onclick="imprimir()"type="button">imprimir</button>
                <div id="print">
                    <svg id="barcode"></svg>
                </div>    --}}
            </div>
        </div>

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
generarBarcode();
</script>
@endpush
@endsection