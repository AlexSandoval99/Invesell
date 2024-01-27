

<?php $__env->startSection('title', 'Proveedores'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Proveedores</h1>
    <p>Administracion de proveedores</p>
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

<div class="card">
    <div class="card-body">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre de fantasia</td>
                    <td>RUC</td>
                    <td>Telefono</td>
                    <td>comuna</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                        <td><?php echo e($u->id); ?></td>
                        <td><?php echo e($u->nombre_fantasia); ?></td>
                        <td><?php echo e($u->rut); ?></td>
                        <td><?php echo e($u->telefono); ?></td>
                        <td><?php echo e($u->comuna['comuna']); ?></td>
                        
                        <td><div class="btn-group">
                            <a type="button" class="btn btn-success" href="<?php echo e(route('proveedores.editar', $u->id)); ?>">Datos</a>
                            
                          </div></td>
                    </tr>
                   
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="<?php echo e(route('proveedores.create')); ?>">Crear proveedor</a>
            
            </div>
        </div>
</div>
           
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> $(document).ready(function() {
        $('#example').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    }
        );
    } ); </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/proveedores/index.blade.php ENDPATH**/ ?>