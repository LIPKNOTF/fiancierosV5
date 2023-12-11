<?php

namespace App\Http\Controllers;

use App\Models\Egresos;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControlDeFacturas_Controller extends Controller
{
    public function Facturas($anio,$mes){
        $egresos = Egresos::with(['partida.capitulo'])
        ->where('mes', '=', $mes)
        ->where('anio', '=', $anio)
        ->get();

        if(!$egresos){
            abort(404);
        }
        // $partida = $egresos->partida;
        // $capitulo = $egresos->partida->capitulo;
        
        //array para el mes que informa
        $nombresMeses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];
        $nombreMes = $nombresMeses[$mes];

        //suma total de los egresos
        $totalGeneral = 0;
        foreach ($egresos as $egreso) {
            $totalGeneral += $egreso->total;
        }

        $ultimoDiaMes = Carbon::createFromDate($anio, $mes)->endOfMonth();

        // Utiliza $ultimoDiaMes para obtener la fecha formateada
        $fechaUltimoMes = $ultimoDiaMes->format('d-m-Y');

        $fpdf = new FPDF();
        $fpdf->AddPage();
        //titulos
        $fpdf->setfont('arial','B',12);
        $fpdf->Cell(180, 5, utf8_decode('INFORME CONSOLIDADO DE EGRESOS'), 0, 1, 'C');
        $fpdf->Ln();

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(180, 3, utf8_decode('UNIDAD RESPONSABLE EDUCATIVA: DIRECCIÓN GENERAL DE EDUCACIÓN TECNOLÓGICA AGROPECUARIA'), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode('Y CIENCIAS DEL MAR EN EL ESTADO DE: YUCATAN'), 0, 1, 'C');
        $fpdf->Ln();

        $fpdf->Cell(125, 3, utf8_decode('C.B.T.A No.284'), 0, 1, 'l');
        $fpdf->Cell(125, 4, utf8_decode('NIVEL EDUCATIVO: MEDIO SUPERIOR'), 0, 1, 'l');
        $fpdf->Ln();

        $fpdf->Cell(45, 5, '$' . number_format($totalGeneral, 2, '.', ','), 'B', 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio en blanco entre lineas
        $fpdf->Cell(45, 5, $nombreMes, 'B', 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio 
        $fpdf->Cell(45, 5, $fechaUltimoMes, 'B', 1, 'C');

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(45, 5, 'TOTAL DE EGRESOS', 0, 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio
        $fpdf->Cell(45, 5, 'MES QUE SE INFORMA', 0, 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio
        $fpdf->Cell(45, 5, 'FECHA DE ELABORACION', 0, 1, 'C');
        $fpdf->Ln();

        $fpdf->Cell(192, 5, 'DESGLOSE DE EGRESOS', 1, 1, 'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(10, 10, 'CAP', 1, 0, 'C');
        $fpdf->Cell(25, 10, 'Partida de gasto', 1, 0, 'C');
        $fpdf->Cell(27, 10, 'Importe por partida', 1, 0, 'C');
        $fpdf->Cell(3,  10, '', 1, 0, 'C');
        $fpdf->Cell(10,  10, 'CAP', 1, 0, 'C');
        $fpdf->Cell(25,  10, 'Partida de gasto', 1, 0, 'C');
        $fpdf->Cell(27,  10, 'Importe por partida', 1, 0, 'C');
        $fpdf->Cell(3,  10, '', 1, 0, 'C');
        $fpdf->Cell(10,  10, 'CAP', 1, 0, 'C');
        $fpdf->Cell(25,  10, 'Partida de gasto', 1, 0, 'C');
        $fpdf->Cell(27,  10, 'Importe por partida', 1, 1, 'C');

        //1FILA1
        $fpdf->setfont('arial','',8);
        $totales = []; //paso 1: se crea un arrray

        foreach ($egresos as $egreso) {
            // Verificar si el código de capítulo comienza con "2"
            $codigoCapitulo = $egreso->partida->capitulo->codigo ?? '';
             
            if (strpos($codigoCapitulo, '2') === 0) {
                // Paso 2: Acumular los totales en el array
                $codigoPartida = $egreso->partida->codigo;
         
                if (!isset($totales[$codigoCapitulo][$codigoPartida])) {
                    $totales[$codigoCapitulo][$codigoPartida] = 0;
                }
         
                $totales[$codigoCapitulo][$codigoPartida] += $egreso->total;
            }
        }
         
        $total2000 = 0;
        // Paso 3: Imprimir la tabla final utilizando FPDF
        foreach ($totales as $codigoCapitulo => $partidas) {
            foreach ($partidas as $codigoPartida => $total) {
                $total2000 += $total;
                // Imprimir las celdas en FPDF
                $fpdf->Cell(10, 14, $codigoCapitulo, 'LR', 0, 'C');
                $fpdf->Cell(25, 14, $codigoPartida, 'LR', 0, 'C');
                $fpdf->Cell(27, 14, '$' . number_format($total, 2, '.', ','), 'LR', 1, 'C');
            }
        }
         
        // Puedes agregar celdas adicionales para completar las 10 filas si es necesario
        for ($i = count($totales); $i < 10; $i++) {
            $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
            $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
            $fpdf->Cell(27, 14, '', 'LR', 1, 'C');
        }
        //FIN DE 1FILA1
         
        $fpdf->SetXY(72, 74);
        $fpdf->Cell(3, 150, '', 1, 1, 'C');

        //1FILA2
        $totalesFila2 = []; // Paso 1: se crea un array

        // Paso 2: Acumular los totales en el array
        foreach ($egresos as $egreso) {
            // Verificar si el código de capítulo comienza con "3"
            $codigoCapitulo = $egreso->partida->capitulo->codigo ?? '';
         
            if (strpos($codigoCapitulo, '3') === 0) {
                $codigoPartida = $egreso->partida->codigo;
         
                if (!isset($totalesFila2[$codigoCapitulo][$codigoPartida])) {
                    $totalesFila2[$codigoCapitulo][$codigoPartida] = 0;
                }
         
                $totalesFila2[$codigoCapitulo][$codigoPartida] += $egreso->total;
            }
        }
         
        // Paso 3: Imprimir la tabla final utilizando FPDF
        $yPosition = 74; // Posición inicial en Y para la primera fila
        $total3000 = 0;
        foreach ($totalesFila2 as $codigoCapitulo => $partidas) {
            foreach ($partidas as $codigoPartida => $total) {
                $total3000 += $total;
                // Imprimir las celdas en FPDF
                $fpdf->SetXY(75, $yPosition);
                $fpdf->Cell(10, 14, $codigoCapitulo, 'LR', 0, 'C');
                $fpdf->Cell(25, 14, $codigoPartida, 'LR', 0, 'C');
                $fpdf->Cell(27, 14, '$' . number_format($total, 2, '.', ','), 'LR', 1, 'C');
         
                $yPosition += 14; // Incrementar la posición en Y para la siguiente fila
            }
        }
         
        // Puedes agregar celdas adicionales para completar las 10 filas si es necesario
        for ($i = count($totalesFila2); $i < 10; $i++) {
            $fpdf->SetXY(75, $yPosition);
            $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
            $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
            $fpdf->Cell(27, 14, '', 'LR', 1, 'C');
         
            $yPosition += 14; // Incrementar la posición en Y para la siguiente fila
        }
        //FIN 1FILA2


        //ultima columna/parte superior
        $totalFila3S = [];
        foreach ($egresos as $egreso) {
            // Verificar si el código de capítulo comienza con "3"
            $codigoCapitulo = $egreso->partida->capitulo->codigo ?? '';
         
            if (strpos($codigoCapitulo, '5') === 0) {
                $codigoPartida = $egreso->partida->codigo;
         
                if (!isset($totalFila3S[$codigoCapitulo][$codigoPartida])) {
                    $totalFila3S[$codigoCapitulo][$codigoPartida] = 0;
                }
         
                $totalFila3S[$codigoCapitulo][$codigoPartida] += $egreso->total;
            }
        }

        $yPosition = 74; // Posición inicial en Y para la primera fila
        $total5000 = 0;
        foreach ($totalFila3S as $codigoCapitulo => $partidas) {
            foreach ($partidas as $codigoPartida => $total) {
                $total5000 += $total;
                // Imprimir las celdas en FPDF
                $fpdf->SetXY(140, $yPosition);
                $fpdf->Cell(10, 19, $codigoCapitulo, 'LR', 0, 'C');
                $fpdf->Cell(25, 19, $codigoPartida, 'LR', 0, 'C');
                $fpdf->Cell(27, 19, '$' . number_format($total, 2, '.', ','), 'LR', 1, 'C');
         
                $yPosition += 19; // Incrementar la posición en Y para la siguiente fila
            }
        }

        for ($i = count($totalFila3S); $i < 3; $i++) {
            $fpdf->SetXY(140, $yPosition);
            $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
            $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
            $fpdf->Cell(27, 19, '', 'LR', 1, 'C');
         
            $yPosition += 19; // Incrementar la posición en Y para la siguiente fila
        }

        //fin de ultima columna/parte superior
  
         $fpdf->setfont('arial','B',8);
         $fpdf->SetX(140); // Cambia la posición horizontal según tu diseño
         $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
         $fpdf->Cell(27, 10, '$'.number_format($total5000, 2, '.', ','), 1, 1, 'C');
         $fpdf->SetX(140); 
         $fpdf->Cell(62, 6, '', 1, 1, 'C'); 
         
         $fpdf->SetX(140);
         $fpdf->Cell(10, 10, 'CAP', 1, 0, 'C'); 
         $fpdf->Cell(25, 10, 'Subgrupo', 1, 0, 'C'); 
         $fpdf->Cell(27, 10, 'Importe', 1, 1, 'C');
         
         //ultima columna/parte inferior
         $fpdf->SetX(140);
         $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(27, 19, '', 'LR', 1, 'C');

         $fpdf->SetX(140);
         $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(27, 19, '', 'LR', 1, 'C');

         $fpdf->SetX(140);
         $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
         $fpdf->Cell(27, 19, '', 'LR', 1, 'C');
         //fin de ultima columna/parte inferior

         $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
         $fpdf->Cell(27, 10, '$'.number_format($total2000, 2, '.', ','), 1, 0, 'C');
         $fpdf->Cell(3, 0, '', 1, 0, 'C');
         $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
         $fpdf->Cell(27, 10, '$'.number_format($total3000, 2, '.', ','), 1, 0, 'C');
         $fpdf->Cell(3, 0, '', 1, 0, 'C');
         $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
         $fpdf->Cell(27, 10, '$', 1, 1, 'C');
         $fpdf->Ln();
         
         $fpdf->Cell(126, 30, '', 'LRT', 1, 'T');
         $fpdf->Cell(126, 5, utf8_decode('M.E. ANGÉLICA MARÍA CASTILLO LÓPEZ'), 'LR', 1, 'C');
         $fpdf->Cell(126, 5, utf8_decode('NOMBRE Y FIRMA DEL TITULAR DE LA UNIDAD RESPONSABLE EDUCATIVA'), 1, 1, 'C');
         $fpdf->Output();
         exit;
     }
}
