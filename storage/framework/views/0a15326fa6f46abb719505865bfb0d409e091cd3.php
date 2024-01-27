
<?php $__env->startSection('title', 'Recepciones'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1>Recepciones</h1>
    <p>Administracion de recepciones</p>
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
                            <td>Proveedor</td>
                            <td>Documento</td>
                            <td>Observaciones</td>
                            <td>Unidades</td>
                            <td>Monto</td>
                            <td>Usuario</td>
                            <td>Fecha</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recepciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($u->id); ?></td>
                                <td>
                                    <?php echo e($u->Proveedor->nombre_fantasia); ?> (<?php echo e($u->Proveedor->rut); ?>)
                                </td>
                                <td>
                                    <?php echo e($u->documentos->tipo_documento); ?>: <?php echo e($u->documento); ?>

                                </td>
                                <td><?php echo e($u->observaciones); ?></td>
                                <td><?php echo e($u->unidades); ?></td>
                                <td>
                                    $
                                    <?php echo e(number_format($u->total_neto + $u->total_iva, 0, '', '.')); ?>

                                </td>
                                <td><?php echo e($u->user->name); ?></td>
                                <td><?php echo e($u->fecha_recepcion); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="<?php echo e(route('recepciones.view', $u->id)); ?>">Datos</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="<?php echo e(route('recepciones.create')); ?>">Agregar recepcion</a>
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
                    columnDefs: [{
                        targets: [2],
                        visible: false,
                        searchable: true,
                    }, ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/recepciones/index.blade.php ENDPATH**/ ?>