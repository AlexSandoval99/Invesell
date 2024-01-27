

<?php $__env->startSection('title', 'Editar proveedor'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Editar proveedor</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">
    <div class="col-md-6">
      <form role="form" action="<?php echo e(route('proveedores.update', $proveedor)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
        <div class="form-group">
          <label>RUT</label>
          <input disabled name="rut" required type="text" class="form-control" value="<?php echo e($proveedor->rut); ?>">
        </div>
        <div class="form-group">
          <label>Nombre de fantasia</label>
          <input name="nombre_fantasia" required type="text" class="form-control" value="<?php echo e($proveedor->nombre_fantasia); ?>">
        </div>
        <div class="form-group">
          <label>Razon social</label>
          <input name="razon_social" required type="text" class="form-control" value="<?php echo e($proveedor->razon_social); ?>">
        </div>
        <div class="form-group">
          <label>Giro</label>
          <input name="giro" required type="text" class="form-control" value="<?php echo e($proveedor->giro); ?>">
        </div>
        <div class="form-group">
          <label>Direccion</label>
          <input name="direccion" required type="text" class="form-control" value="<?php echo e($proveedor->direccion); ?>">
        </div>

        <div class="form-goup">
          <label>Region</label>
          <select id="region" name="region" class="form-control">
            <option>Selecciona una region </option>
            <?php $__currentLoopData = $regiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($r->id == $proveedor->region['id']): ?>
            <option selected=true value="<?php echo e($r->id); ?>"><?php echo e($r->region); ?></option>
            <?php else: ?>
            <option value="<?php echo e($r->id); ?>"><?php echo e($r->region); ?></option>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="form-goup">
            <label>Comuna</label>
          <select id="comuna" name="comuna" class="form-control">
            <option>Selecciona una region </option>
            <?php $__currentLoopData = $comunas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($c->id == $proveedor->comuna['id']): ?>
            <option selected=true value="<?php echo e($c->id); ?>"><?php echo e($c->comuna); ?></option>
            <?php else: ?>
            <option value="<?php echo e($c->id); ?>"><?php echo e($c->comuna); ?></option>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="form-group">
          <label>E-mail</label>
          <input name="email" required type="text" class="form-control" value="<?php echo e($proveedor->mail); ?>">
        </div>
        <div class="form-group">
          <label>Telefono</label>
          <input name="telefono" required type="number" class="form-control" value="<?php echo e($proveedor->telefono); ?>">
        </div>

        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar
          proveedor</button>
        <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Modificar proveedor</h4>
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
  Editar proveedor
</div>
<!-- /.card-footer-->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
  const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
  document.getElementById('region').addEventListener('change', (e) => {
    fetch('../GetComunasPorRegion', {
      method: 'POST',
      body: JSON.stringify({ region: e.target.value }),
      headers: {
        'Content-Type': 'application/json',
        "X-CSRF-Token": csrfToken
      }
    }).then(response => {
      return response.json()
    }).then(data => {
      var opciones = "<option value=''>Elegir</option>";
      for (let i in data.lista) {
        opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].comuna + '</option>';
      }
      document.getElementById("comuna").innerHTML = opciones;
    }).catch(error => console.error(error));
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/proveedores/editar.blade.php ENDPATH**/ ?>