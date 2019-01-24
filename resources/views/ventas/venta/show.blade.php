@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Cliente</label>
                <p>{{$venta->nombre}}</p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label>Tipo de venta</label>
                <p>{{$venta->tipo_comprobante}}</p>
            </div>
        </div>
        {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <p>{{$venta->serie_comprobante}}</p>
            </div>
        </div> --}}
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Venta N°</label>
                <p>{{$venta->idventa}}</p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="Tarjeta">Tarjeta</label>
                <p>{{$venta->num_comprobante}}</p>
            </div>
        </div>
        {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
                <label for="impuesto">Impuesto</label>
                <p>{{$venta->impuesto}} %</p>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">            

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            
                            <th>Prenda</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">$/. {{$venta->total_venta}}</p></th>
                            </tr>
                            <tr>
                                <th colspan="4"><p align="right">TOTAL IMPUESTO (21%):</p></th>
                                <th><p align="right">$/. {{$venta->total_venta*$venta->impuesto/100}}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">$/. {{$venta->total_venta+($venta->total_venta*$venta->impuesto/100)}}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">MONTO ABONADO:</p></th>
                                <th><p align="right">$/. {{$venta->sena}}</p></th>
                            </tr>  
                        </tfoot>
                        <tbody>
                            @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->articulo}}</td>
                                <td>$/. {{$det->precio_venta}}</td>
                                <td>$/. {{$det->descuento}}</td>
                                <td align="right">$/. {{$det->precio_venta-$det->descuento}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>   
    <a target="_blank" href="{{URL::action('VentaController@reportec',$venta->idventa)}}"><button class="btn btn" title="reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button></a>         
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush
@endsection