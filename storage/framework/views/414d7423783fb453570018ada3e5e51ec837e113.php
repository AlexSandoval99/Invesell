

<?php $__env->startSection('title', 'Crear articulo'); ?>

<?php $__env->startSection('content_header'); ?>
<?php if(session('error')): ?>
<div class="alert <?php echo e(session('tipo')); ?> alert-dismissible fade show" role="alert">
    <strong><?php echo e(session('error')); ?></strong> <?php echo e(session('mensaje')); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <br>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Crear articulo</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">
    <div class="col-md-6">
      <form role="form" action="<?php echo e(route('articulos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <div class="form-group row">
          <div class="col-6">
            <label>Codigo interno</label>
            <input name="cod_interno" required type="text" class="form-control">
          </div>
          <div class="col-6">
            <label>Codigo de barras</label>
            <input name="cod_barras" required type="text" class="form-control"">
          </div>
        </div>
        <div class="form-group">
          <label>Descripcion</label>
          <input name="descripcion" required type="text" class="form-control"">
        </div>
        <div class="form-group row">
          <div class="col-4">
            <label>Venta neto</label>
            <input name="venta_neto" id="venta_neto"  class="form-control" required type="number" oninput="ActualizaValorVentaTotal()">
          </div>
          <div class="col-4">
            <label>I.V.A.</label>
            <input name="venta_imp" id="venta_imp" required type="number" class="form-control">
          </div>
          <div class="col-4">
            <label>Total</label>
            <input name="venta_total" id="venta_total" required type="number" oninput="ActualizaValorVentaNeto()"
              class="form-control">
          </div>
        </div>
        
        <div class="form-goup row">
          <div class="col-6">
            <label>Activo</label>
            <select id="activo" name="activo" class="form-control">
              
              <option selected=true value="1">Activo</option>
              <option  value="0">Inactivo</option>
           </select>
          </div>
          <div class="col-6">
            <label>Stock critico</label>
            <input name="stock_critico" required type="number" class="form-control">
          </div>
        </div>

        <br>


        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Crear
          Articulo</button>
        <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Crear articulo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <p>Seguro que quiere guardar los cambios?&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>

    <br>
    <!-- Fin contenido -->
  </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
  Crear articulo
</div>
<!-- /.card-footer-->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script>
  function ActualizaValorVentaTotal() {
    let valor = document.getElementById("venta_neto").value;
    document.getElementById("venta_total").value = Math.round(valor * 1.1);
    document.getElementById("venta_imp").value = Math.round((valor * 1.1) - valor);

 }
 
  function ActualizaValorVentaNeto() {
    let valor = document.getElementById("venta_total").value;
    document.getElementById("venta_neto").value = Math.round(valor / 1.19);
    document.getElementById("venta_imp").value = Math.round(valor - (valor / 1.19));
   
  }
 
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
   <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo app('pragmarx.version')->format('compact'); ?>       
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/articulos/crear.blade.php ENDPATH**/ ?>