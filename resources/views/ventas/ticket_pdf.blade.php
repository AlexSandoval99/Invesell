<?php
// Incluir la clase Dompdf
// require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
include(resource_path('views/ventas/string-helper.php'));
include(resource_path('views/ventas/config.php'));
use Luecano\NumeroALetras\NumeroALetras;
// Crear una instancia de Dompdf
$dompdf = new Dompdf();
$ch = new StringHelper();
$html = '';
$ancho_hoja = 80; // Ancho de la hoja en mm
$cantidad_caracteres = floor($ancho_hoja / 0.5); // Cantidad de caracteres "=" necesarios

$linea_separadora = str_repeat("=", $cantidad_caracteres); // Generar la línea separadora
$linea_separadora2 = str_repeat("-", $cantidad_caracteres); // Generar la línea separadora
// Generar el contenido HTML del ticket
$contenido_ticket = '
<html>
<head>
  <style>
    /* Estilos CSS para el ticket */
    @page {
      size: 80mm 200mm; /* Tamaño del ticket */
      margin: 15px; /* Eliminar márgenes */
      font-size: 9px;
    }
  </style>
</head>
<body>
  <!-- Contenido del ticket generado dinámicamente -->
';
$contenido_ticket .= '<div style="text-align: center;">TECNO REPUESTOS</div>';
$contenido_ticket .= '<div style="text-align: center;">8000432</div>';
$contenido_ticket .= '<div style="text-align: center;">Av. Lopez Godoy 850</div>';
$contenido_ticket .= '<div style="text-align: center;">SAN LORENZO</div>';
$contenido_ticket .= '<div style="text-align: center;">Paraguay</div>';
$contenido_ticket .= '<div style="text-align: center;">EXPEDIDO EL: '.$ventas->created_at->format('d/m/Y').'</div>';
$contenido_ticket .= '<div style="text-align: center;">PUNTO DE VENTA</div><br>';
$contenido_ticket .= 'Nota de Venta: '.$ventas->id.'<br><br>';
$contenido_ticket .= '<div style="text-align: center;">------------------------------------------------------------------------------------------------------------------</div><br>';
$contenido_ticket .= '<div style="display: inline-block; width: 100%;">
    <div style="display: inline-block; text-align: left; width: 30%;">Descripción</div>
    <div style="display: inline-block; text-align: center; width: 20%;">Cant.</div>
    <div style="display: inline-block; text-align: center; width: 20%;">Pr.Un.</div>
    <div style="display: inline-block; text-align: right; width: 20%;">Importe</div>
</div>';
$contenido_ticket .= '<div style="text-align: center;">' . $linea_separadora2 . '</div><br>';

// Iterar sobre los productos de la venta
if(isset($ventas)){
    foreach ($ventas->detalle as $key => $value) {
        $contenido_ticket .= '<div style="display: inline-block; width: 100%;">
            <div style="text-align: left; display: inline-block; width: 30%;">'.($value->cantidad > 0 ? substr($value->producto->descripcion,0,18) : ('-'.substr($value->producto->descripcion, 0, 18))).'</div>'.
            '<div style="text-align: right; display: inline-block; width: 20%;">'.strval(number_format(abs($value->cantidad),2, '.', '')).'</div>'.
            '<div style="text-align: right; display: inline-block; width: 20%;">'.strval(number_format(abs($value->venta_neto),2, '.', '')).'</div>'.
            '<div style="text-align: right; display: inline-block; width: 20%;">'.strval(number_format(abs($value->venta_neto),2, '.', '')).'</div>'.
        '</div><br>';
    }
}
$contenido_ticket .= "<br>";
// Separador


$contenido_ticket .= '<div style="text-align: center;">' . $linea_separadora . '</div><br>';
$contenido_ticket .= '<div style="text-align: right;">Subtotal  '.($ventas->monto_neto).'</div><br>';
$contenido_ticket .= '<div style="text-align: right;">Descuento    '.strval(number_format(0,2, '.', '')).'</div><br>';
$contenido_ticket .= '<div style="text-align: center;">' . $linea_separadora . '</div><br>';
$contenido_ticket .= '<div style="text-align: right;">Total a pagar  '.($ventas->monto_neto).'</div><br>';
// Total en Letra
$formatter = new NumeroALetras();
$letras = $formatter->toMoney($ventas->monto_neto, 0, 'GUARANIES', '');
$contenido_ticket .= '<div style="text-align: left;">Total a pagar en letras: ' . $letras . '</div><br>';
//$contenido_ticket .= "                  Impuestos: ".$ch->derechaFix("0.00",10)."<br>";
//$contenido_ticket .= "                 Ud. ahorro: ".$ch->derechaFix("0.00",10)."<br>"."<br>";
if($ventas->medio_pago_id==1){

    $contenido_ticket .= "Pago Efectivo:".$ch->derechaFix($ventas->monto_neto,24)."<br>";
}
// if($datos_ticket['pago_tarjeta']!=0){

//     $contenido_ticket .= "Pago Tarjeta Credito:".$ch->derechaFix(($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true') ? ('-'.strval(number_format($datos_ticket['pago_tarjeta'],2, '.', ''))) : strval(number_format($datos_ticket['pago_tarjeta'],2, '.', '')),18)."<br>";
// }
// Division
$contenido_ticket .= '<div style="text-align: center;">' . $linea_separadora . '</div><br>';
// Pago y     // Total de los productos
//$contenido_ticket .= "Total Pago:".$ch->derechaFix((isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true' || ($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true') ? ('-'.strval(number_format($datos_ticket['total_pago'],2, '.', ''))) : strval(number_format($datos_ticket['total_pago'],2, '.', ''))),28)."<br>";
// if(isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true' || ($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true')){
// 	$contenido_ticket .= "Total Pago:".$ch->derechaFix(('-'.strval(number_format($datos_ticket['total_con_descuento'],2, '.', ''))),28)."<br>";
// }else{
    $contenido_ticket .= "Total Pago:".$ch->derechaFix($ventas->monto_neto,28)."<br>";
    //strval(number_format($datos_ticket['total_pago'],2, '.', ''))
// }

$contenido_ticket .= "Cambio:".$ch->derechaFix('0',32)."<br>";
$contenido_ticket .= "Total de Articulos: ".$ch->derechaFix(strval(number_format($ventas->unidades,2, '.', '')),18)."<br>";
$contenido_ticket .= "Cajero: ".$ch->izquierda($ventas->user->name)."<br>"."<br>";
// Pie de Tickect
$contenido_ticket .=
    '<div style="text-align: center;">**************************************</div>'
    .'<div style="text-align: center;">* GRACIAS POR SU PREFERENCIA *</div><br>'
    .'<div style="text-align: center;">* FUE UN PLACER ATENDERLE *</div><br>'
    .'<div style="text-align: center;">**************************************</div>';
$html .= $contenido_ticket.'</body></html>';

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Opcional: Establecer el tamaño y la orientación del papel
$dompdf->setPaper('100mm', '150mm');

// Renderizar el contenido HTML a PDF
$dompdf->render();

// Guardar el PDF en un archivo o enviarlo al navegador para su descarga
$dompdf->stream('ticket.pdf');
