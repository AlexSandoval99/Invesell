@extends('adminlte::page')

@section('title', 'Ver venta')

@section('content_header')
    <h2>Ver venta </h2>
@stop


@section('content')
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
                    <li><strong>Cliente: </strong>{{ $venta->Cliente->nombre }}
                        ({{ $venta->CLiente->rut }})</li>
                    <li><strong>Fecha venta:</strong> {{ date('d-m-Y', strtotime($venta->created_at)) }}</li>
                    <li><strong> {{ $venta->TipoDocumento->tipo_documento }}:</strong> {{ $venta->documento }}</li>
                    <li><strong>Monto total:</strong>
                        Gs {{ number_format($venta->monto_neto + $venta->monto_imp, 0, ',', '.') }}</li>
                    <li><strong>Costo total:</strong>
                        Gs {{ number_format($venta->costo_neto + $venta->costo_imp, 0, ',', '.') }}</li>
                    <li><strong>Ganancia total:</strong>
                        Gs {{ number_format($venta->monto_neto + $venta->monto_imp - ($venta->costo_neto + $venta->costo_imp), 0, ',', '.') }}
                    </li>
                    <li><strong>Unidades:</strong> {{ number_format($venta->unidades, 0, ',', '.') }}</li>
                    <li><strong>Usuario: </strong> {{ $venta->user->name }}</li>
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
                    @foreach ($detalleVentas as $d)
                        <tr>
                            <th>{{ $d->Producto->cod_interno }}</th>
                            <td>{{ $d->Producto->descripcion }}</td>
                            <td>{{ number_format($d->cantidad, 0, ',', '.') }}</td>
                            <td>Gs {{ number_format($d->precio_neto, 0, ',', '.') }}</td>
                            <td>Gs {{ number_format($d->precio_imp, 0, ',', '.') }}</td>
                            <td>Gs {{ number_format(($d->precio_neto + $d->precio_imp) * $d->cantidad, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
        </div>
        <button type="button" class="btn btn-primary" id="imprimirTicket">Imprimir Ticket</button> <!-- Agrega este botón -->

    @stop

    @section('js')
        <script>
            $(document).ready(function() {
                // $("#example").DataTable({
                //     order: [
                //         [0, "desc"]
                //     ],
                //     columnDefs: [{
                //         targets: [2],
                //         visible: true,
                //         searchable: true,
                //     }, ],
                //     dom: 'Bfrtip',
                //     buttons: [
                //         'excelHtml5',
                //         'csvHtml5',

                //         {
                //             extend: 'print',
                //             text: 'Imprimir',
                //             autoPrint: true,

                //             customize: function(win) {
                //                 $(win.document.body).css('font-size', '16pt');
                //                 $(win.document.body).find('table')
                //                     .addClass('compact')
                //                     .css('font-size', 'inherit');

                //             }
                //         },
                //         {
                //             extend: 'pdfHtml5',
                //             text: 'PDF',
                //             filename: 'Venta.pdf',

                //             title: 'Venta {{ $venta->id }}',
                //             pageSize: 'LETTER',


                //         }





                //     ],
                //     language: {
                //         url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                //     },
                // });
                $("#imprimirTicket").click(function() {
                    // Obtener los datos que deseas enviar a ticket.php
                    var datos = @json($venta);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Enviar los datos a ticket.php utilizando una solicitud POST
                    $.ajax({
                        url: '{{ route('ticket.print') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: datos,
                        success: function(response) {
                            // Manejar la respuesta de ticket.php si es necesario
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores si es necesario
                        }
                    });
                });
            });
        </script>
    @stop
