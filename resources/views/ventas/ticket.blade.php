<?php
 /**
 * Author: Ivan Eusebio
 * Date:   21/10/2015
 *
 */
 include(resource_path('views/ventas/string-helper.php'));
 include(resource_path('views/ventas/config.php'));
 set_time_limit(500000);

 // Se se especificaron los datos desde el punto de Venta
 if(isset($_POST)){

    $ch = new StringHelper();

    $message = 'Se imprimio el Ticket';

 	$message_error = 'Ocurrio un error al imprimir el Ticket';

    $code_ok = 200;

 	$code_error = 500;

    $datos_ticket = $_POST;

    //Armar cabecera del Ticket
    $contenido_ticket =
	$ch->centrar("")."\r\n".
	$ch->centrar("")."\r\n".
	$ch->centrar("")."\r\n".
    $ch->centrar("TECNO REPUESTOS")."\r\n".
    $ch->centrar("8000432")."\r\n".
    $ch->centrar("Av. Lopez Godoy 850")."\r\n".
    $ch->centrar("SAN LORENZO")."\r\n".
    $ch->centrar('Paraguay')."\r\n".
    $ch->centrar("EXPEDIDO EL: ".$ventas->created_at->format('d/m/Y'))."\r\n".
    // $ch->centrar("EN: ".$datos_ticket['sucursal_calle']." ".$datos_ticket['sucursal_numero']." ".$datos_ticket['sucursal_colonia'])."\r\n"."\r\n".
    $ch->centrar("PUNTO DE VENTA")."\r\n"."\r\n".
    "Nota de Venta: ".$ventas->id."\r\n"."\r\n";
    // $isdev = substr($datos_ticket['ov_codigo'], 0, 2);
    // if((isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true') || ( $isdev === 'DV')){
    //     $contenido_ticket .= $ch->centrar("************* Devolución *************\r\n");
    // }elseif($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true'){
    //     $contenido_ticket .= $ch->centrar("************* Cancelación *************\r\n");
    // }
	//(isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true' ? "*************  Devolucion *************\r\n" :"").
    $contenido_ticket .= "--------------------------------------"."\r\n".
    "Descripcion        Cant. Pr.Un. Importe"."\r\n".
    "--------------------------------------"."\r\n";

    // Iterar sobre los productos de la venta

    if(isset($ventas)){
        foreach ($ventas->detalle as $key => $value) {
            $contenido_ticket .=
                $ch->izquierdaFix(($value->cantidad > 0 ? substr($value->producto->descripcion,0,18) : ('-'.substr($value->producto->descripcion, 0, 18))), 18)
                 .$ch->derechaFix(strval(number_format(abs($value->cantidad),2, '.', '')), 6)
                .$ch->derechaFix(strval(number_format(abs($value->venta_neto),2, '.', '')), 7)
                .$ch->derechaFix(strval(number_format(abs($value->venta_neto),2, '.', '')), 8)."\r\n";
            /*if(isset($value['ov_devolucion'])){
                if(($value['ov_devolucion'] == "1" || $value['ov_devolucion'] == '1' || $value['ov_devolucion'] == 1)){
                    $contenido_ticket .= $ch->izquierdaFix('-'.substr($value['art_nombre'],0,17),18)
                    .$ch->derechaFix(strval(number_format($value['cantidad'],2, '.', '')), 6)
                    .$ch->derechaFix(strval(number_format($value['precio'],2, '.', '')), 7)
                    .$ch->derechaFix(strval(number_format($value['total'],2, '.', '')), 8)."\r\n";
                }
            }*/
        }
    }


    $contenido_ticket .= "\r\n";
    // Separador
    $contenido_ticket .= $ch->derecha("======")."\r\n";
    $contenido_ticket .= $ch->derecha("Subtotal  ".($ventas->monto_neto))."\r\n";
	// if($datos_ticket['promocion'] != "") {
	// 	$contenido_ticket .= "**************************************"."\r\n";
	// 	$contenido_ticket .= $ch->derecha($datos_ticket['promocion'])."\r\n\r\n";
	// 	// Datos de articulos que se agregregan a la promocion
	// 	if(array_key_exists('articulosPromocion', $datos_ticket) && count($datos_ticket['articulosPromocion']) > 0) {
	// 		foreach ($datos_ticket['articulosPromocion'] as $key => $value) {
	// 			$contenido_ticket .=
	// 			$ch->izquierdaFix(substr($value['art_nombre'],0,18),18)
	// 			.$ch->derechaFix(strval(number_format($value['cantidad'],2, '.', '')), 6)
	// 			.$ch->derechaFix(strval(number_format($value['precio'],2, '.', '')), 7)
	// 			.$ch->derechaFix(strval(number_format($value['total'],2, '.', '')), 8)."\r\n";
	// 		}
	// 	}
	// 	$contenido_ticket .= "**************************************"."\r\n";
	// }

    $contenido_ticket .= $ch->derecha("Descuento    ".strval(number_format(0,2, '.', '')))."\r\n";
    $contenido_ticket .= $ch->derecha("===================")."\r\n";
    $contenido_ticket .= $ch->derecha("Total a pagar  ".($ventas->monto_neto))."\r\n";
    // Total en Letra
    $contenido_ticket .= $ch->izquierda("Cien guaranies")."\r\n";

    //$contenido_ticket .= "                  Impuestos: ".$ch->derechaFix("0.00",10)."\r\n";
    //$contenido_ticket .= "                 Ud. ahorro: ".$ch->derechaFix("0.00",10)."\r\n"."\r\n";

    if($ventas->medio_pago_id==1){

        $contenido_ticket .= "Pago Efectivo:".$ch->derechaFix($ventas->monto_neto,24)."\r\n";
    }
    // if($datos_ticket['pago_tarjeta']!=0){

    //     $contenido_ticket .= "Pago Tarjeta Credito:".$ch->derechaFix(($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true') ? ('-'.strval(number_format($datos_ticket['pago_tarjeta'],2, '.', ''))) : strval(number_format($datos_ticket['pago_tarjeta'],2, '.', '')),18)."\r\n";
    // }
    // Division
    $contenido_ticket .= $ch->derecha("======")."\r\n";
    // Pago y     // Total de los productos
	//$contenido_ticket .= "Total Pago:".$ch->derechaFix((isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true' || ($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true') ? ('-'.strval(number_format($datos_ticket['total_pago'],2, '.', ''))) : strval(number_format($datos_ticket['total_pago'],2, '.', ''))),28)."\r\n";
	// if(isset($datos_ticket['ov_devolucion']) && $datos_ticket['ov_devolucion'] == 'true' || ($datos_ticket['ov_ticketstatus'] == 1 || $datos_ticket['ov_ticketstatus'] == 'true')){
	// 	$contenido_ticket .= "Total Pago:".$ch->derechaFix(('-'.strval(number_format($datos_ticket['total_con_descuento'],2, '.', ''))),28)."\r\n";
	// }else{
		$contenido_ticket .= "Total Pago:".$ch->derechaFix($ventas->monto_neto,28)."\r\n";
		//strval(number_format($datos_ticket['total_pago'],2, '.', ''))
	// }

    $contenido_ticket .= "Cambio:".$ch->derechaFix('0',32)."\r\n";
    $contenido_ticket .= "Total de Articulos: ".$ch->derechaFix(strval(number_format($ventas->unidades,2, '.', '')),18)."\r\n";
    $contenido_ticket .= "Cajero: ".$ch->izquierda($ventas->user->name)."\r\n"."\r\n";
    // Pie de Tickect
    $contenido_ticket .= "**************************************"."\r\n"."*".$ch->centrarFix("GRACIAS POR SU PREFERENCIA",37)."*"."\r\n"
    ."*".$ch->centrarFix("FUE UN PLACER ATENDERLE",37)."*"."\r\n"."**************************************";
dd($contenido_ticket);

	header('Content-type: application/json');

	/* Abrir la conexion a la impresora */
	if(extension_loaded ("printer")){
		if(printerExist()){
			$impresora = printer_open(constant('IMPRESORA'));
			// Mandar el texto a imprimir al print JOB
			if(printer_write($impresora, $contenido_ticket)){
				echo json_encode([
                    'message' => $message,
                    'data' => $contenido_ticket,
                    'status' => $code_ok
                ]);
			}
			else{
				echo json_encode([
                    'message' => $message_error,
                    'data' => [],
                    'status'=> $code_error
                ]);
			}
			// Cerrar Conexion
			printer_close($impresora);
		}
		else {
			header('HTTP/1.1 500 Internal Server Error');
			echo json_encode([
                'message' => 'No se pudo acceder a la impresora',
                'data' => $contenido_ticket,
                'status' => $code_error
            ]);
		}
	}
	else {
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode([
            'message' =>'El servidor de impresión no esta configurado.',
            'data' => $contenido_ticket,
            'status' => $code_error
        ]);
	}

 }

 /**
 * Validar si existe una impresora configurada y es la que esta descrita en el archivo de config.php
 */

 function printerExist(){

	$impresoras = printer_list(PRINTER_ENUM_LOCAL);

	if(count($impresoras) == 0 || $impresoras == ""){
		 return false;
	}
	else {

		$existe = 0;

		$impresorasData = serialize($impresoras);

		$impresoras = unserialize($impresorasData);

		foreach ($impresoras as $impresora) {
			if ($impresora["NAME"] == constant('IMPRESORA')) {
				$existe++;
			}
		}
		return $existe > 0;
	}
 }

?>
