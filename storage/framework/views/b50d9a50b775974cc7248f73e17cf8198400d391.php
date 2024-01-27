
<?php $__env->startSection('title', 'Ajustes de Inventario'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1>Ajustes de inventario</h1>
    <p>Administracion de articulos</p>
    <?php if(session('error')): ?>
        <div class="alert <?php echo e(session('tipo')); ?> alert-dismissible fade show" role="alert">
            <strong><?php echo e(session('error')); ?></strong> <?php echo e(session('mensaje')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?> <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Salidas</td>
                            <td>Entradas</td>
                            <td>Tipo de movimiento</td>
                            <td>Observaciones</td>
                            <td>Monto</td>
                            <td>Usuario</td>
                            <td>Fecha</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $ajustesDeInventario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($u->id); ?></td>
                                <td><?php echo e($u->salidas); ?></td>
                                <td><?php echo e($u->entradas); ?></td>
                                <td><?php echo e($u->observaciones); ?></td>
                                <td><?php echo e($u->movimiento->tipo_movimiento); ?></td>
                                <td>
                                    
                                    <?php echo e(number_format($u->costo_neto + $u->costo_imp, 0, '', '.')); ?>

                                </td>
                                <td><?php echo e($u->user->name); ?></td>
                                <td><?php echo ($u->created_at)->format('d/m/Y H:i'); ?> </td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="<?php echo e(route('ajustesdeinventario.view', $u->id)); ?>">Datos</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo e(route('ajustesdeinventario.create')); ?>">Agregar
                        ajuste</a>
                </div>
            </div>
        </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
        <script>
            $(document).ready(function() {
                $("#example").DataTable({
                    order: [
                        [0, "desc"]
                    ],

                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/ajustesdeinventario/index.blade.php ENDPATH**/ ?>