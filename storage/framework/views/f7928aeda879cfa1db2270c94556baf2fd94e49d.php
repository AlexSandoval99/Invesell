

<?php $__env->startSection('title', 'Ver recepcion'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2>Ver recepcion</h2>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Recepcion <?php echo e($recepcion->id); ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <ul>
                    <li><strong>Proveedor: </strong><?php echo e($recepcion->Proveedor->nombre_fantasia); ?>

                        (<?php echo e($recepcion->Proveedor->rut); ?>)</li>
                    <li><strong>Fecha recepcion:</strong> <?php echo e(date('d-m-Y', strtotime($recepcion->fecha_recepcion))); ?></li>
                    <li><strong> <?php echo e($recepcion->documentos->tipo_documento); ?>:</strong> <?php echo e($recepcion->documento); ?></li>
                    <li><strong>Monto total:</strong>
                        $<?php echo e(number_format($recepcion->total_neto + $recepcion->total_iva, 0, ',', '.')); ?></li>
                    <li><strong>Unidades:</strong> <?php echo e(number_format($recepcion->unidades, 0, ',', '.')); ?></li>
                    <li><strong>Observaciones: </strong><?php echo e($recepcion->observaciones); ?></li>
                    <li><strong>Usuario: </strong> <?php echo e($recepcion->user->name); ?></li>
                </ul>
            </div>

            <!-- Fin contenido -->
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            Recepcion
        </div>
        <!-- /.card-footer-->
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Detalle recepcion <?php echo e($recepcion->id); ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Codigo</td>
                        <td>Descripcion</td>
                        <td>Unidades</td>
                        <td>Unitario</td>
                        <td>I.V.A.</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $detalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($d->Producto->cod_interno); ?></th>
                            <td><?php echo e($d->Producto->descripcion); ?></td>
                            <td><?php echo e(number_format($d->cantidad, 0, ',', '.')); ?></td>
                            <td>$<?php echo e(number_format($d->precio_unitario, 0, ',', '.')); ?></td>
                            <td>$<?php echo e(number_format($d->impuesto_unitario, 0, ',', '.')); ?></td>
                            <td>$<?php echo e(number_format(($d->precio_unitario + $d->impuesto_unitario) * $d->cantidad, 0, ',', '.')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <br />
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
                        visible: true,
                        searchable: true,
                    }, ],
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',

                        {
                            extend: 'print',
                            text: 'Imprimir',
                            autoPrint: true,

                            customize: function(win) {
                                $(win.document.body).css('font-size', '16pt');
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');

                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            filename: 'Recepcion.pdf',

                            title: 'Recepcion <?php echo e($recepcion->id); ?>',
                            pageSize: 'LETTER',


                        }





                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/recepciones/view.blade.php ENDPATH**/ ?>