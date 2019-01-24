@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Generar Reportes de estado de cuenta</h3>
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
{!! Form::open(array('url'=>'estado','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="cliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
                    @foreach ($personas as $persona)
                        <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="credito">Credito</label> 
                <input type="text" class="form-control" name="venta" value="0">
            </div>
        </div>
            {{-- <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                <label for="fecha">Fecha</label> 
                <input type="date" class="form-control" name="fecha" value="{{$fecha}}">
                </div>
            </div> --}}
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary form-control">Buscar</button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Nº de pago</th>
                    <th>Cliente</th>
                    <th>Nº de Credito</th>
                    <th>Fecha pago</th>
                    <th>Cuota</th>
                    <th>Saldo</th>
                </thead>
                @foreach ($pagos as $pag)
                <tr>
                    <td>{{ $pag->id}}</td>
                    <td>{{ $pag->nombre}}</td>
                    <td>{{ $pag->idventa}}</td>
                    <td>{{ Carbon\Carbon::parse($pag->created_at)->format('d-m-Y')}}</td>
                    <td>{{ $pag->cuota}}</td>
                    <td>{{ $pag->saldo}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
{{Form::close()}}
<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    <div class="form-group">
      <a href="{{url('reportecuentas',[$cliente,$venta])}}" target="_blank"><button title="Reporte" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i></button></a>
    </div>
</div> 
@endsection