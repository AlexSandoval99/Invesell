

<?php $__env->startSection('title', 'Ver venta'); ?>

<?php $__env->startSection('content_header'); ?>
    <h2>Ver venta </h2>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Datos </h3>
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
                    <li><strong>Cliente: </strong><?php echo e($venta->Cliente->nombre); ?>

                        (<?php echo e($venta->CLiente->rut); ?>)</li>
                    <li><strong>Fecha venta:</strong> <?php echo e(date('d-m-Y', strtotime($venta->created_at))); ?></li>
                    <li><strong> <?php echo e($venta->TipoDocumento->tipo_documento); ?>:</strong> <?php echo e($venta->documento); ?></li>
                    <li><strong>Monto total:</strong>
                        Gs <?php echo e(number_format($venta->monto_neto + $venta->monto_imp, 0, ',', '.')); ?></li>
                    <li><strong>Costo total:</strong>
                        Gs <?php echo e(number_format($venta->costo_neto + $venta->costo_imp, 0, ',', '.')); ?></li>
                    <li><strong>Ganancia total:</strong>
                        Gs <?php echo e(number_format($venta->monto_neto + $venta->monto_imp - ($venta->costo_neto + $venta->costo_imp), 0, ',', '.')); ?>

                    </li>
                    <li><strong>Unidades:</strong> <?php echo e(number_format($venta->unidades, 0, ',', '.')); ?></li>
                    <li><strong>Usuario: </strong> <?php echo e($venta->user->name); ?></li>
                </ul>
            </div>

            <!-- Fin contenido -->
        </div>

        <!-- /.card-body -->
        
        <!-- /.card-footer-->
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle venta</h3>
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
                    <?php $__currentLoopData = $detalleVentas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($d->Producto->cod_interno); ?></th>
                            <td><?php echo e($d->Producto->descripcion); ?></td>
                            <td><?php echo e(number_format($d->cantidad, 0, ',', '.')); ?></td>
                            <td>Gs <?php echo e(number_format($d->precio_neto, 0, ',', '.')); ?></td>
                            <td>Gs <?php echo e(number_format($d->precio_imp, 0, ',', '.')); ?></td>
                            <td>Gs <?php echo e(number_format(($d->precio_neto + $d->precio_imp) * $d->cantidad, 0, ',', '.')); ?>

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
                            filename: 'Venta.pdf',

                            title: 'Venta <?php echo e($venta->id); ?>',
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/ventas/view.blade.php ENDPATH**/ ?>