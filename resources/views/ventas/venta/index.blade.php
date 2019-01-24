@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success" title="Nueva venta"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a> <a href="{{URL::action('VentaController@reporte',$searchText)}}" target="_blank"><button class="btn btn-info"><i class="fa fa-file-text" aria-hidden="true" title="reportes"></i></button></a></h3>
        @include('ventas.venta.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>T.Venta</th>
                    <th>Total</th>
                    <th>Pago Inicial</th>
                    <th>Ultima Cuota</th>
                    <th>Saldo</th>
                    {{-- <th>Estado</th> --}}
                    <th>Opciones</th>
                </thead>
               @foreach ($ventas as $ven)
                <tr>
                    <td >{{ Carbon\Carbon::parse($ven->fecha_hora)->format('d-m-Y')}}</td>
                    <td>{{ $ven->nombre}}</td>
                    <td>{{ $ven->tipo_comprobante}}</td>
                    <td>{{ $ven->total_venta}}</td>
                    <td>{{ $ven->sena}}</td>
                    <td>{{ $ven->cuota}}</td>
                @if( $ven->estado === 'cancelado')
                    <td class="alert-success">{{ $ven->saldo}}</td>
                @else
                    <td class="alert-danger">{{ $ven->saldo}}</td>
                @endif
                    <td>
                        <a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn" title="Detalles"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        <a href="{{URL::action('VentaController@edit',$ven->idventa)}}"><button class="btn btn" title="cargar cuota"><i class="fa fa-credit-card" aria-hidden="true"></i></button></a>
                        <a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idventa)}}"><button class="btn btn" title="reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{$ventas->render()}}
    </div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush

@endsection