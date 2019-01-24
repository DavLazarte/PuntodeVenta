@extends ('layouts.admin')
@section ('contenido')
   
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nueva Venta</h3>
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
{!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                @foreach ($personas as $persona)
                    <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label>Tipo de Venta</label>
            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control">
                       <option value="Contado" selected>Contado</option>
                       <option value="Tarjeta">Tarjeta</option>
                       <option value="Cuenta">Cuenta Corriente</option>
                       <option value="MP">Mercado Pago</option>
                       <option value="Mcred">MCred</option>
            </select>
        </div>
    </div>
        {{-- <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <input type="text" name="serie_comprobante" value="001" class="form-control" placeholder="Serie comprobante...">
            </div>
        </div> --}}
    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
        <div class="form-group">
            <label for="impuesto">Impuesto</label>
            <input type="checkbox" value="1" name="impuesto" id="impuesto" class="checkbox">% de Impuesto
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label> </label>
            <select name="num_comprobante" id="num_comprobante" class="form-control">
                   <option value=" ">---Seleccione Su Tarjeta---</option>
                   <option value="Naranja">Naranja</option>
                   <option value="Visa">Visa</option>
                   <option value="Credichash">Credichash</option>
                   <option value="Mastercard">Mastercard</option>
                   <option value="otra">Otra</option>
            </select>
        </div>
    </div>
        <!--<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                    <label for="num_comprobante">Número Comprobante</label>
                    <input type="text"  name="num_comprobante"  value="" required  class="form-control">
                    
            </div>
        </div>-->
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Artículo</label>
                    <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                        @foreach($articulos as $articulo)
                        <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}">{{$articulo->articulo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control" 
                        placeholder="cantidad">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" disabled name="pstock" id="pstock" class="form-control" 
                        placeholder="Stock">
                    </div>
                </div> --}}
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="precio_venta">Precio</label>
                    <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control">
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="descuento">Descuento</label>
                    <input type="number" name="pdescuento" id="pdescuento" class="form-control" value="0">
                </div>
            </div> 
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <label for="agregar"></label>
                   <button type="button" id="bt_add" class="btn btn-primary form-control">Agregar</button>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color:#A9D0F5">
                        <th>Opciones</th>
                        <th>prenda</th>
                        <th>Precio Venta</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                    </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL:</p></th>
                                <th><p align="right"><span id="total">$/. 0.00</span> <input type="hidden" name="total_venta" id="total_venta"></p></th>
                            </tr>
                            <tr>
                                <th colspan="5"><p align="right">TOTAL IMPUESTO (21%):</p></th>
                                <th><p align="right"><span id="total_impuesto">$/. 0.00</span></p></th>
                            </tr>
                            <tr>
                                <th  colspan="5"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right"><span align="right" id="total_pagar">$/. 0.00</span></p></th>
                            </tr>  
                            <tr>
                                <th  colspan="5"><p align="right">MONTO ABONADO:</p></th>
                                <th><input type="number" name="sena" id="sena" class="form-control" placeholder="seña" value="0"></th>
                            </tr>  
                            <input type="hidden" name="saldo" id="saldo">
                            {{-- <input type="hidden" name="estado" value="No disponibleKC"> --}}
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
    <div class="form-group">
            <input name"_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" id="save"type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
    </div>
</div>

{!!Form::close()!!}		

@push ('scripts')
<script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });
   $(document).ready(function(){
    $('#save').click(function(){
      deuda();
    });
  });
  var cont=0;
  total=0;
  subtotal=[];
  saldo=0;
  $("#guardar").hide();
  $("#num_comprobante").hide();
  $("#pidarticulo").change(mostrarValores);
  $("#tipo_comprobante").change(marcarImpuesto);

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
        $("#pprecio_venta").val(datosArticulo[1]);
    // $("#pstock").val(datosArticulo[1]);    
  }
  function marcarImpuesto()
  {
    tipo_comprobante=$("#tipo_comprobante option:selected").text();
    if (tipo_comprobante=='Tarjeta')
    {
        $("#impuesto").prop("checked", true);
        $("#num_comprobante").show(); 
    }
    else
    {
        $("#impuesto").prop("checked", false);
        $("#num_comprobante").hide();
    }
  }

  function agregar()
  {

    datosArticulo = document.getElementById('pidarticulo').value.split('_');

    idarticulo   = datosArticulo[0];
    articulo     = $("#pidarticulo option:selected").text();
    descuento    = $("#pdescuento").val();
    precio_venta = $("#pprecio_venta").val();
    // cantidad=$("#pcantidad").val();
    // stock=$("#pstock").val();

    if (idarticulo!="")
    {
        subtotal[cont]=(precio_venta-descuento);
        total=total+subtotal[cont];

        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="precio_venta[]" value="'+parseFloat(precio_venta).toFixed(2)+'"></td><td><input type="number" name="descuento[]" value="'+parseFloat(descuento).toFixed(2)+'"></td><td align="right">S/. '+parseFloat(subtotal[cont]).toFixed(2)+'</td></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);
    }
    else
    {
        alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
    }
    
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pdescuento").val("0");
    $("#pprecio_venta").val("");
  }
  function totales()
  {
        $("#total").html("$/. " + total.toFixed(2));
        $("#total_venta").val(total.toFixed(2));
        
        //Calcumos el impuesto
        if ($("#impuesto").is(":checked"))
        {
            por_impuesto=21;
        }
        else
        {
            por_impuesto=0;   
        }
        total_impuesto=total*por_impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html("$/. " + total_impuesto.toFixed(2));
        $("#total_pagar").html("$/. " + total_pagar.toFixed(2));        
  }
  function deuda(){
        monto=$("#sena").val();
        deuda=total-monto;
        $("#saldo").val(deuda.toFixed(2));
  }

  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }

   function eliminar(index){
    total=total-subtotal[index]; 
    totales();  
    $("#fila" + index).remove();
    evaluar();

  }

$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection