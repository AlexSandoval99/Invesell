

<?php $__env->startSection('title', 'Medios de pago'); ?>

<?php $__env->startSection('content_header'); ?>
<h1>Configuracion</h1>
<p>Administracion de medios de pago</p>
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
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $medio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($m->id); ?></td>
                    <td><?php echo e($m->medio_de_pago); ?></td>

                    <td>
                        <div class="btn-group">
                            <a type="button" class="btn btn-success"
                                href="<?php echo e(route('configuracion.mediosdepago.editar', $m->id)); ?>">Datos</a>

                        </div>
                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="<?php echo e(route('configuracion.mediosdepago.create')); ?>">Crear medio
                de pago</a>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script> $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        }
        );
    }); </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
   <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo app('pragmarx.version')->format('compact'); ?>       
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/administracion/mediosdepago/index.blade.php ENDPATH**/ ?>