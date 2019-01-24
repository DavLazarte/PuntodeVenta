@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Cerrar Caja: </h3>
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
    {!!Form::model($cajas,['method'=>'POST','route'=>['caja.update',$cajas->id]])!!}
    {!! method_field('PUT') !!}
    {{Form::token()}}
     <div class="row">
            <?php 
            foreach ($totales as $total)
            {
            ?>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="montoinicial">Monto inicial</label>
                        <input type="text" name="monto_inicial" value="{{$cajas->monto_inicial}}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="cuentas">Cuentas</label>
                        <input type="text" name="cuentas"  value="<?php echo $total->totalsena ;?>" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="cuotas">Cuotas</label>
                        <input type="text" name="cuotas"  value="<?php echo $total->totalcuota;?>"" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="tarjetas">Tarjetas</label>
                        <input type="text" name="tarjetas"  value="<?php echo $total->totaltarjeta;?>" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="ventaefectivo">Venta Efectivo</label>
                        <input type="text" name="venta_efectivo"  value="<?php echo $total->totalventa;?>" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="salida">Salidas</label>
                        <input type="text" name="salidas"  value="<?php echo $total->totalsalida;?>" class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="montofinal">Monto en caja</label>
                        <input type="text" name="monto_final"  value="<?php echo $total->totalventa + $total->totalsena + $total->totalcuota - $total->totalsalida + $cajas->monto_inicial;?>" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="estado"  value="Cerrada" class="form-control">
            <?php }?>
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
<script>
$('#liAlmacen').addClass("treeview active");
$('#liArticulos').addClass("active");
</script>
@endpush
@endsection