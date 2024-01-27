
<?php $__env->startSection('title', 'Ver Ventas'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1>Ventas</h1>
    <p>Administracion de ventas</p>
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
                            <td>Cliente</td>
                            <td>Documento</td>
                            <td>Monto</td>
                            <td>Medio de pago</td>
                            <td>Fecha</td>
                            <td>Usuario</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($v->id); ?></td>
                                <td><?php echo e($v->Cliente->nombre); ?> (<?php echo e($v->Cliente->rut); ?>)</td>
                                <td><?php echo e($v->TipoDocumento->tipo_documento); ?>: <?php echo e($v->documento); ?></td>
                                <td><?php echo e(number_format($v->monto_neto + $v->monto_imp, 0, '', '.')); ?></td>
                                <td><?php echo e($v->MedioDePago->medio_de_pago); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($v->created_at))); ?></td>
                                <td><?php echo e($v->user->name); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="<?php echo e(route('ventas.show', $v->id)); ?>">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo e(route('ventas.create')); ?>">Agregar venta</a>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/ventas/index.blade.php ENDPATH**/ ?>