@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Cajas</h3>
        @include('caja.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Inicial</th>
                    <th>Cuentas</th>
                    <th>Cuotas</th>
                    <th>Tarjetas</th>
                    <th>Venta en Efectivo</th>
                    <th>Salidas</th>
                    <th>Cierre</th>
                    <th>Opciones</th>
                </thead>
               @foreach ($cajas as $caj)
                <tr>
                    <td>{{ Carbon\Carbon::parse($caj->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $caj->monto_inicial}}</td>
                    <td>{{ $caj->cuentas}}</td>
                    <td>{{ $caj->cuotas}}</td>
                    <td>{{ $caj->tarjetas}}</td>
                    <td>{{ $caj->venta_efectivo}}</td>
                    <td>{{ $caj->salidas}}</td>
                    <td>{{ $caj->monto_final}}</td>
                    <td>
                        @if($caj->estado == 'Abierta')
                          <a href="{{route('caja.edit',$caj->id)}}"><button class="btn btn-primary">Cerrar</button></a>
                          {{-- <a href="" data-target="#modal-delete-{{$caj->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a> --}}
                        @else
                        <a target="_blank" href="{{URL::action('ResumenCajaController@reportec',$caj->id)}}"><button class="btn btn" title="reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button></a>
                          {{-- <span>Caja Cerrada</span> --}}
                        @endif
                        </td>
                </tr>
                {{-- @include('caja.modal') --}}
                @endforeach
            </table>
        </div>
        {{-- {{$cajidas->render()}} --}}
    </div>
</div>
@push ('scripts')
<script>
$('#liotrpras').addClass("treeview active");
$('#liIngresos').addClass("active");
</script>
@endpush
@endsection