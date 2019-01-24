@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Cargar Cuota</h3>
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
        {!!Form::model($venta,['method'=>'PATCH','route'=>['ventas.venta.update',$venta->idventa]])!!}
        {{Form::token()}}
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">  
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="proveedor">Cliente</label>
                        <p>{{$venta->nombre}}</p><input type="hidden" name="idcliente" value="{{$venta->idpersona}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="venta">N° de Venta</label>
                            <input type="text" class="form-control" name="idventa" value="{{$venta->idventa}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-7 col-md-7 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Total</label>
                            <input type="text" class="form-control" id="total_venta" name="total_venta" value="{{$venta->total_venta}}" disabled>
                        </div>   
                        <div class="form-group has-feedback">
                            <label>Pagos</label>
                            <input  class="form-control" id="sena" name="sena" value="{{$venta->sena}}" readonly="readonly" >
                        </div> 
                        <div class="form-group has-feedback">
                            <label>Saldo</label>
                            <input type="text" class="form-control" id="saldo" name="saldo" value="{{$venta->saldo}}" readonly="readonly">
                        </div> 
                        <div class="form-group has-feedback">
                            <label>Cuota</label>
                            <input type="text" class="form-control" id="cuota" name="cuota" value="">
                        </div>
                </div>
            </div>
        </div>
    </div>
                        <input type="hidden" name="estado" id="estado">
                     
                
            
            
                
                <button type="button"  id="calcular" class="btn btn-default" >Actualizar saldo</button>
                <button type="submit" id="save" class="btn btn-primary">Guardar</button>
   

{{Form::Close()}}
@push ('scripts')
<script>
$(document).ready(function(){
    $('#calcular').click(function(){
      suma();
    });
});

var resultado=0;
var suma = function(){
            var numero1 = parseInt(document.getElementById("sena").value);
            var numero2 = parseInt(document.getElementById("cuota").value);

            var resultado = numero1 + numero2;
            $("#sena").val(resultado.toFixed(2));
            
            //$("#nuevasena").val(0);

            var numero3 = parseInt(document.getElementById("total_venta").value);
            var numero4 = parseInt(document.getElementById("sena").value);

            var resultado2 = numero3 - numero4;

            $("#saldo").val(resultado2.toFixed(2));
            if (resultado2 === 0.00) 
            {
                $("#estado").val("cancelado");
            }
            else
            {
                $("#estado").val("debe");
            }
        }


$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>


@endpush
@endsection