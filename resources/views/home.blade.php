@extends ('layouts.admin')
@section ('contenido')
<div class="container">
  <div class="row">
      <div class="col-md-9 col-md-offset-1">
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
          <h3>Link Rapidos</h3>
      </div>
      <div class="col-lg-3 col-xs-6">
          <div class="box box-solid box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Deposito</h3>
              </div>
              <div class="box-body">
              <a href="{{url('almacen/articulo')}}"><i class="fa fa-suitcase fa-5x" aria-hidden="true"></i></a>
              </div>
              <div class="box-footer">
                <a href="{{url('almacen/articulo/create')}}"> Cargar prendas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
          <div class="box box-solid box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Ventas</h3>
              </div>
              <div class="box-body">
              <a href="{{url('ventas/venta/create')}}"><i class="fa fa-cart-plus fa-5x" aria-hidden="true"></i></a>
              </div>
              <div class="box-footer">
              <a href="{{url('ventas/venta')}}"> Lista de Ventas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
          <div class="box box-solid box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Salidas</h3>
              </div>
              <div class="box-body">
                  <a href="{{url('salida/create')}}"><i class="fa fa-sign-out fa-5x" aria-hidden="true"></i></a>
              </div>
              <div class="box-footer">
                  <a href="{{url('salida')}}"> Lista de Salidas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
          <div class="box box-solid box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Cuentas Corrientes</h3>
              </div>
              <div class="box-body">
              <a href="{{url('ventas/cliente/create')}}"><i class="fa fa-users fa-5x" aria-hidden="true"></i></a>
              </div>
              <div class="box-footer">
                  <a href="{{url('ventas/cliente')}}">Lista de Clientes <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>
      <div class="col-lg-3 col-xs-6">
          <div class="box box-solid box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Caja</h3>
              </div>
              <div class="box-body">
              <a href="{{url('caja/resumen')}}"><i class="fa fa-money fa-5x" aria-hidden="true"></i></a>
              </div>
              <div class="box-footer">
                  <a href="{{url('caja/cierre')}}">Resumen de Caja <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>  
  </div>
</div>
</div>
@endsection