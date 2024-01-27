

<?php $__env->startSection('title', 'Agregar recepcion'); ?>

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
            <h3 class="card-title">Agregar recepcion</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form role="form" action="<?php echo e(route('recepciones.addarticulo')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row">

                            <div class="col-12 form-group">
                                <label>Articulo</label>
                                <select id="articulo" autofocus name="articulo" required class="form-control select2">
                                    <option value="">Buscar articulo</option>
                                    <?php
                                    
                                    foreach ($articulos as $t) {
                                        echo '<option value="' .
                                            $t['id'] .
                                            '">' .
                                            $t['cod_barras'] .
                                            ' - ' .
                                            $t['cod_interno'] .
                                            ' - ' .
                                            $t['descripcion'] .
                                            '</option>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Precio unitario</label>
                                <input name="costo_neto" id="costo_neto" min="1" class="form-control" required
                                    type="text" oninput="ActualizaValorCostoTotal()">
                            </div>
                            <div class="form-group col-6">
                                <label>I.V.A.</label>
                                <input name="costo_imp" id="costo_imp" readonly required type="number"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-goup row">
                            <div class="form-group col-6">
                                <label>Total unitario</label>
                                <input name="costo_total" id="costo_total" min="1" required type="text"
                                    oninput="ActualizaValorCostoNeto()" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Unidades</label>
                                <input name="unidades" required min="1" type="number" class="form-control">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary pull-left">Agregar articulo</button>
                        <div class="btn-group">
                    </form>

                    <a type="button" class="btn btn-success" href="<?php echo e(route('articulos.create')); ?>">Crear
                        articulo</a>
                </div>
                <?php if(session('recepcion')): ?>
                    <?php
                        $total_unidades = 0;
                        $total_costo_neto = 0;
                        $total_costo_imp = 0;
                        $total_costo_total = 0;
                        
                        foreach (session('recepcion') as $r) {
                            $total_unidades += $r->cantidad;
                            $total_costo_neto += $r->precio_unitario * $r->cantidad;
                            $total_costo_imp += $r->impuesto_unitario * $r->cantidad;
                            $total_costo_total += ($r->precio_unitario + $r->impuesto_unitario) * $r->cantidad;
                        }
                    ?>
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-warning pull-right" data-toggle="modal"
                            data-target="#modal-default">
                            Finalizar recepcion
                        </button>
                    </div>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Finalizar recepcion</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="<?php echo e(route('recepciones.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label>Tipo documento</label>
                                            <select id="tipo_documento" name="tipo_documento" class="form-control select2">
                                                <?php $__currentLoopData = $tipo_documento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($t->id); ?>"><?php echo e($t->tipo_documento); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Numero documento</label>
                                            <input id="numero_documento" name="numero_documento" required type="number"
                                                class="form-control input-sm">
                                        </div>

                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select id="proveedor" name="proveedor" required class="form-control select2">
                                                <option value="">Seleccionar</option>
                                                <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($p->id); ?>"><?php echo e($p->razon_social); ?>

                                                        (<?php echo e($p->rut); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <input id="observaciones" required name="observaciones" type="text"
                                                class="form-control input-sm" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Monto total</label>
                                            <input id="monto_total" name="monto_total" disabled type="text"
                                                class="form-control input-sm"
                                                value="<?php echo e(number_format($total_costo_total, 0, ',', '.')); ?>">
                                            <input id="monto_neto" name="monto_neto" type="hidden"
                                                class="form-control input-sm" value="<?php echo e($total_costo_neto); ?>">
                                            <input id="monto_imp" name="monto_imp" type="hidden"
                                                class="form-control input-sm" value=" <?php echo e($total_costo_imp); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Total articulos</label>
                                            <input id="total_articulos" name="total_articulos" readonly type="text"
                                                class="form-control input-sm"
                                                value="<?php echo e(number_format($total_unidades, 0, ',', '.')); ?>">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Agregar recepcion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>



            </div>
            <?php if(session('recepcion')): ?>
                <div class="col-md-6">



                    <ol>
                        <li><Strong>Total unidades: </Strong><?php echo e(number_format($total_unidades, 0, ',', '.')); ?></li>
                        <li><Strong>Total costo neto: </Strong><?php echo e(number_format($total_costo_neto, 0, ',', '.')); ?></li>
                        <li><Strong>Total costo impuesto: </Strong><?php echo e(number_format($total_costo_imp, 0, ',', '.')); ?>

                        </li>
                        <li><Strong>Total costo total: </Strong><?php echo e(number_format($total_costo_total, 0, ',', '.')); ?>

                        </li>
                    </ol>

                    <br>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <br>

    <!-- Fin contenido -->


    <!-- /.card-body -->
    <div class="card-footer">
        Crear articulo
    </div>
    <!-- /.card-footer-->
    </div>
    <?php if(session('recepcion')): ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detalle recepcion </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
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
                        <?php $__currentLoopData = session('recepcion'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo e($r->articulo->id); ?></th>
                                <td><?php echo e($r->articulo->descripcion); ?></td>
                                <td><?php echo e(number_format($r->cantidad, 0, ',', '.')); ?></td>
                                <td>$<?php echo e(number_format($r->precio_unitario, 0, ',', '.')); ?></td>
                                <td>$<?php echo e(number_format($r->impuesto_unitario, 0, ',', '.')); ?></td>
                                <td>$<?php echo e(number_format(($r->precio_unitario + $r->impuesto_unitario) * $r->cantidad, 0, ',', '.')); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br />
            </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script>
        function ActualizaValorCostoTotal() {
            let valor = document.getElementById("costo_neto").value;
            document.getElementById("costo_total").value = Math.round(valor * 1.1);
            document.getElementById("costo_imp").value = Math.round((valor * 1.1) - valor);

        }

        function ActualizaValorCostoNeto() {
            let valor = document.getElementById("costo_total").value;
            document.getElementById("costo_neto").value = Math.round(valor / 1.1);
            document.getElementById("costo_imp").value = Math.round(valor - (valor / 1.1));

        }
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sivig\resources\views/recepciones/create.blade.php ENDPATH**/ ?>