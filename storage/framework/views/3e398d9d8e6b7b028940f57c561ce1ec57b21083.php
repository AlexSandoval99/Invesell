

<?php $__env->startSection('title', 'Articulos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Articulos</h1>
    <p>Administracion de articulos</p>
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
                        <td>Codigo interno</td>
                        <td>Codigo de barras</td>
                        <td>Descripcion</td>
                        <td>Stock</td>
                        <td>Precio Venta</td>
                        <td>Activo</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $articulos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($u->id); ?></td>
                            <td><?php echo e($u->cod_interno); ?></td>
                            <td><?php echo e($u->cod_barras); ?></td>
                            <td><?php echo e($u->descripcion); ?></td>
                            <td><?php echo e($u->stock); ?></td>
                            <td> <?php echo e(number_format($u->venta_neto + $u->venta_imp, 0, '', '.')); ?></td>
                            <?php if($u->activo): ?>
                                <td>Activo</td>
                            <?php else: ?>
                                <td>Inactivo</td>
                            <?php endif; ?>


                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle"
                                        data-toggle="dropdown">Acciones</button>

                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="<?php echo e(route('articulos.editar', $u->id)); ?>">Editar</a>
                                        <a class="dropdown-item"
                                            href="<?php echo e(route('articulos.historial', $u->id)); ?>">Historial</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <br>
            <div class="btn-group">
                <a type="button" class="btn btn-success" href="<?php echo e(route('articulos.create')); ?>">Crear articulo</a>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [{
                    "targets": [2],
                    "visible": false,
                    "searchable": true
                }],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="float-right d-none d-sm-block">
        <b>Version</b> <?php echo app('pragmarx.version')->format('compact'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/articulos/index.blade.php ENDPATH**/ ?>