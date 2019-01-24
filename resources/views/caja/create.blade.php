<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-create">
    {{Form::Open(array('action'=>array('ResumenCajaController@store'),'method'=>'POST'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Abrir Caja</h4>
            </div>
            <div class="modal-body">
            <?php 
            foreach ($totales as $total)
            {
            ?>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="monto">Monto inicial</label>
                    <input type="text" name="monto_inicial" value="{{$caja->monto_final}}" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="cuentas"  value="<?php echo $total->totalsena ;?>" class="form-control">
                <input type="hidden" name="cuotas"  value="<?php echo $total->totalcuota;?>" class="form-control">
                <input type="hidden" name="tarjetas"  value="<?php echo $total->totaltarjeta;?>" class="form-control">
                <input type="hidden" name="venta_efectivo"  value="<?php echo $total->totalventa;?>" class="form-control">
                <input type="hidden" name="salidas"  value="<?php echo $total->totalsalida;?>" class="form-control">
                <input type="hidden" name="monto_final"  value="<?php echo $total->totalventa + $total->totalsena + $total->totalcuota - $total->totalsalida;?>" class="form-control">
                <input type="hidden" name="estado"  value="Abierta" class="form-control">
            </div>
        <?php }?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}

</div>