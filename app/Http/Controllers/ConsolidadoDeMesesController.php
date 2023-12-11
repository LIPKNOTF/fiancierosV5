<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;

class ConsolidadoDeMesesController extends Controller
{
    public function Consolidado($anio, $mes){

        $ingresos = Ingresos::with(['claves_p'])
        ->where('mes', '=', $mes)
        ->where('anio', '=', $anio)
        ->get();
        
        if(!$ingresos){
            abort(404);
        }

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

        $ultimoDiaMes = Carbon::createFromDate($anio, $mes)->endOfMonth();
        // Utiliza $ultimoDiaMes para obtener la fecha formateada
        $fechaUltimoMes = $ultimoDiaMes->format('d-m-Y');


        $totalGneral = 0;
        foreach($ingresos as $ingreso){
            $totalGneral += $ingreso->total;
        }

        $fpdf = new FPDF();
        $fpdf->AddPage();
        
        //titulos
        $fpdf->setfont('arial','B',12);
        $fpdf->Cell(180, 5, utf8_decode('INFORME CONSOLIDADO DE INGRESOS'), 0, 1, 'C');

        // Ruta de la imagen y posición en la página
        $imagePath = 'img/secretaria.png'; 
        $imageX = 10; 
        $imageY = $fpdf->GetY(); 
        $imageWidth = 55; 
        $imageHeight = 8; 
        $fpdf->Image($imagePath, $imageX, $imageY, $imageWidth);
        $fpdf->Ln($imageHeight + 10); // Ajusta la posición vertical según tus necesidades

        //texto despues de la imagen
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(125, 3, utf8_decode('UNIDAD RESPONSABLE EDUCATIVA : C.B.T.A No.284'), 0, 1, 'l');
        $fpdf->Cell(125, 4, utf8_decode('NIVEL EDUCATIVO: MEDIO SUPERIOR'), 0, 1, 'l');
        $fpdf->Ln();

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(45, 5, '$'.number_format($totalGneral, 2, '.', ','), 'B', 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio en blanco entre lineas
        $fpdf->Cell(45, 5, $nombreMes, 'B', 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio 
        $fpdf->Cell(45, 5, $fechaUltimoMes, 'B', 1, 'C');

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(45, 5, 'TOTAL DE INGRESOS', 0, 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio
        $fpdf->Cell(45, 5, 'MES QUE SE INFORMA', 0, 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio
        $fpdf->Cell(45, 5, 'FECHA DE ELABORACION', 0, 1, 'C');
        $fpdf->Ln();

        $fpdf->Cell(192, 5, 'DESGLOSE DE EGRESOS', 1, 1, 'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C');
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C');
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 0, 'C');
        $fpdf->Cell(3,  10, '', 1, 0, 'C');
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C');
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C');
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 0, 'C');
        $fpdf->Cell(3, 10, '', 1, 0, 'C');
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C');
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C');
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');

        //SUPERIOR IZQUIERDO 1 A000
        $fpdf->setfont('arial','',8);
        $totalIngresosA = 0; // Inicializa la variable de total
        $ingresosAgrupadosA=[];

        // Inicializar ingresos agrupados
        for ($i = 0; $i < 6; $i++) {
            $ingresosAgrupadosA[$i] = 0;
        }

        for ($i = 0; $i < 6; $i++) {

            // Contenido para la primera columna
            switch ($i) {
                case 0:
                case 5:
                    $contenidoColumna1 = ''; // Vacía en la primera y última fila
                    break;
                case 1:
                    $contenidoColumna1 = 'A'; // En la segunda fila
                    break;
                case 2:
                case 3:
                case 4:
                    $contenidoColumna1 = '0'; // En la tercera, cuarta y quinta fila
                    break;
            }

             // Verifica si hay ingresos disponibles para la fila actual y si la clave inicia con "A"
             $clave = 'A' . str_pad($i, 3, '0', STR_PAD_LEFT); // Construye la clave
             $ingresosFiltrados = $ingresos->filter(function ($ingreso) use ($clave) {
                 return strtoupper(substr($ingreso->claves_p->clave, 0, 4)) === $clave;
             })->toArray();

            // Verifica si hay un ingreso disponible para la fila actual y si la clave inicia con "A"
            if (!empty($ingresosFiltrados)) {
                // Calcula la suma de los ingresos con la misma clave
                $sumaIngresos = array_sum(array_column($ingresosFiltrados, 'total'));

                $fpdf->Cell(10, 8, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 8, $clave, 'LR', 0, 'C');
                $fpdf->Cell(27, 8, '$'.number_format($sumaIngresos, 2, '.', ','), 'LR', 1, 'C');

                // Acumula el total solo de A000
                $totalIngresosA += $sumaIngresos;
                $ingresosAgrupadosA[$i] = $sumaIngresos;
            } else {
                // Si no hay un ingreso disponible o la clave no inicia con "A", imprime celdas vacías
                $fpdf->Cell(10, 8, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 8, '', 'LR', 0, 'C');
                $fpdf->Cell(27, 8, '', 'LR', 1, 'C');
            }
        }
        
        //FINAL SUPERIOR IZQUIERDO 1

        $fpdf->SetXY(72, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        
        //parte media 1 (C000)
        $totalIngresosC = 0;
        $coordenadas = [
            [75, 74],
            [75, 84],
            [75, 94],
            [75, 104],
            [75, 114],
            [75, 124],
            [75, 134],
            [75, 144],
            [75, 154],
            [75, 164],
            [75, 174],
            [75, 184],
            [75, 194],
            [75, 204],
        ];
        
        for ($i = 0; $i < 14; $i++) {
            // Obtén las coordenadas para la fila actual
            list($x, $y) = $coordenadas[$i];
        
            // Contenido para la primera columna
            switch ($i) {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 9:
                case 10:
                case 11:
                case 12:
                case 13:
                    $contenidoColumna1 = ''; // Vacía en ciertas filas
                    break;
                case 5:
                    $contenidoColumna1 = 'C'; // En la séptima fila
                    break;
                case 6:
                case 7:
                case 8:
                    $contenidoColumna1 = '0'; // En otras filas
                    break;
            }
        
            // Verifica si hay un ingreso disponible para la fila actual
            if (isset($ingresos[$i])&& strtoupper(substr($ingresos[$i]->claves_p->clave, 0, 1)) === 'C') {
                $ingreso = $ingresos[$i];
        
                // Imprime las celdas para cada fila con los datos del ingreso
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 10, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 10, $ingreso->claves_p->clave ?? '', 'LR', 0, 'C');
                $fpdf->Cell(27, 10, '$' . number_format($ingreso->total, 2, '.', ','), 'LR', 1, 'C');

                // Acumula el total solo de C000
                $totalIngresosC += floatval($ingreso->total);
            } else {
                // Si no hay un ingreso disponible, imprime celdas vacías
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 10, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 10, '', 'LR', 0, 'C');
                $fpdf->Cell(27, 10, '', 'LR', 1, 'C');
            }
        }
        //fin parte media 1

        
        $fpdf->SetXY(137, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');

        //PARTE SUPERIOR DERECHA 1
        $totalIngresosD = 0;
        $coordenadas = [
            [140, 74],
            [140, 81.2],
            [140, 88.2],
            [140, 95.4],
            [140, 102.6],
            [140, 109.8],
            [140, 117],
            [140, 124.2]
        ];
        
        for ($i = 0; $i < count($coordenadas); $i++) {
            // Obtén las coordenadas para la fila actual
            list($x, $y) = $coordenadas[$i];
        
            // Contenido para la primera columna
            switch ($i) {
                case 0:
                case 1:
                case 6:
                case 7:
                    $contenidoColumna1 = ''; // Vacía en ciertas filas
                    break;
                case 2:
                    $contenidoColumna1 = 'D'; // En la séptima fila
                    break;
                case 3:
                case 4:
                case 5:
                    $contenidoColumna1 = '0'; // En otras filas
                    break;
            }
        
            // Verifica si hay un ingreso disponible para la fila actual
            if (isset($ingresos[$i]) && strtoupper(substr($ingresos[$i]->claves_p->clave, 0, 1)) === 'D') {
                $ingreso = $ingresos[$i];
        
                // Imprime las celdas para cada fila con los datos del ingreso
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 7, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 7, $ingreso->claves_p->clave ?? '', 'LR', 0, 'C');
                $fpdf->Cell(27, 7, '$' . number_format($ingreso->total, 2, '.', ','), 'LR', 1, 'C');

                // Acumula el total solo de D000
                $totalIngresosD += floatval($ingreso->total);
            } else {
                // Si no hay un ingreso disponible, imprime celdas vacías
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 7, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 7, '', 'LR', 0, 'C');
                $fpdf->Cell(27, 7, '', 'LR', 1, 'C');
            }
        }
        //final de parte superior derecha


        //TOTAL ULTIMA FILA
        $fpdf->setfont('arial','B',8);
        $fpdf->SetXY(140, 131); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$'.number_format($totalIngresosD, 2, '.', ','), 1, 1, 'C');

        //TOTAL PRIMERA FILA
        $fpdf->SetY(122); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$'.number_format($totalIngresosA, 2, '.', ','), 1, 1, 'C');

        //SEGUNDA CELDA DE LA ULTIMA FILA
        $fpdf->SetXY(140, 141);
        $fpdf->Cell(62, 3, '', 1, 1, 'C'); 

        $fpdf->SetXY(140, 144);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        //SEGUDNA FILA DE INFERIOR DERECHA 1
        $fpdf->setfont('arial','',8);
        $totalIngresosOtros = 0;
        $coordenadas = [
            [140, 154],
            [140, 164],
            [140, 174],
            [140, 184],
            [140, 194],
            [140, 204],
        ];

        // Usar un contador separado para recorrer los ingresos
        $ingresosIndex = 0;

        for ($i = 0; $i < count($coordenadas); $i++) {
            // Obtén las coordenadas para la fila actual
            list($x, $y) = $coordenadas[$i];

            // Contenido para la primera columna
            switch ($i) {
                case 0:
                case 3:
                    $contenidoColumna1 = 'O'; // Vacía en ciertas filas
                    break;
                case 1:
                    $contenidoColumna1 = 'T'; // Vacía en ciertas filas
                    break;
                case 2:
                    $contenidoColumna1 = 'R'; // En la séptima fila
                    break;
                case 4:
                    $contenidoColumna1 = 'S'; // En otras filas
                    break;
                case 5:
                    $contenidoColumna1 = ''; // En otras filas
                    break;
            }

            // Verifica si hay un ingreso disponible para la fila actual
            if ($ingresosIndex < count($ingresos) && strtoupper(substr($ingresos[$ingresosIndex]->claves_p->clave, 0, 1)) >= 'E' && strtoupper(substr($ingresos[$ingresosIndex]->claves_p->clave, 0, 1)) <= 'Z') {
                $ingreso = $ingresos[$ingresosIndex];

                // Imprime las celdas para cada fila con los datos del ingreso
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 10, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 10, $ingreso->claves_p->clave ?? '', 'LR', 0, 'C');
                $fpdf->Cell(27, 10, '$' . number_format($ingreso->total, 2, '.', ','), 'LR', 1, 'C');

                // Acumula el total solo de OTROS
                $totalIngresosOtros += floatval($ingreso->total);

                // Incrementa el índice de ingresos
                $ingresosIndex++;
            } else {
                // Si no hay un ingreso disponible, imprime celdas vacías
                $fpdf->SetXY($x, $y);
                $fpdf->Cell(10, 10, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 10, '', 'LR', 0, 'C');
                $fpdf->Cell(27, 10, '', 'LR', 1, 'C');
            }
        }
        //FINAL DE SEGUNDA FILA DE INFERIOR DERECHA 1
        
        //SEGUNDA CELDA DE LA PRIMERA FILA B000
        $fpdf->setfont('arial','B',8);
        $fpdf->SetY(132);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        $fpdf->setfont('arial','',8);
        $totalIngresosB = 0; 
        $ingresosAgrupadosB = [];
        
        // Inicializar ingresos agrupados
        for ($i = 0; $i < 8; $i++) {
            $ingresosAgrupadosB[$i] = 0;
        }

        for ($i = 0; $i < 8; $i++) {
            // Contenido para la primera columna
            switch ($i) {
                case 0:
                case 1:
                case 6:
                case 7:
                    $contenidoColumna1 = ''; // Vacía en la primera y última fila
                    break;
                case 2:
                    $contenidoColumna1 = 'B'; // En la segunda fila
                    break;
                case 3:
                case 4:
                case 5:
                    $contenidoColumna1 = '0'; // En la tercera, cuarta y quinta fila
                    break;
            }

            // Verifica si hay ingresos disponibles para la fila actual y si la clave inicia con "B"
            $clave = 'B' . str_pad($i, 3, '0', STR_PAD_LEFT); // Construye la clave
            $ingresosFiltrados = $ingresos->filter(function ($ingreso) use ($clave) {
                return strtoupper(substr($ingreso->claves_p->clave, 0, 4)) === $clave;
            })->toArray();

            if (!empty($ingresosFiltrados)) {
                // Calcula la suma de los ingresos con la misma clave
                $sumaIngresos = array_sum(array_column($ingresosFiltrados, 'total'));

                // Imprime las celdas para cada fila con los datos del ingreso agrupado
                $fpdf->Cell(10, 9, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 9, $clave, 'LR', 0, 'C');
                $fpdf->Cell(27, 9, '$' . number_format($sumaIngresos, 2, '.', ','), 'LR', 1, 'C');

                // Acumula el total de ingresos agrupados
                $totalIngresosB += $sumaIngresos;
                $ingresosAgrupadosB[$i] = $sumaIngresos;
            } else {
                // Si no hay ingresos disponibles, imprime celdas vacías
                $fpdf->Cell(10, 9, $contenidoColumna1, 'LR', 0, 'C');
                $fpdf->Cell(25, 9, '', 'LR', 0, 'C');
                $fpdf->Cell(27, 9, '', 'LR', 1, 'C');
            }
        }
        
        //FIN DE SEGUNDA CELDA DE LA PRIMERA FILA

        $fpdf->setfont('arial','B',8);
        $fpdf->SetY(214);
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
        $fpdf->Cell(27, 10, '$'.number_format($totalIngresosB, 2, '.', ','), 1, 0, 'C');
        $fpdf->Cell(3, 0, '', 1, 0, 'C');
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
        $fpdf->Cell(27, 10, '$'.number_format($totalIngresosC, 2, '.', ','), 1, 0, 'C');
        $fpdf->Cell(3, 0, '', 1, 0, 'C');
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
        $fpdf->Cell(27, 10, '$'.number_format($totalIngresosOtros, 2, '.', ',') ,1, 1, 'C');
        $fpdf->Ln();

        
        $fpdf->Cell(126, 30, '', 'LRT', 1, 'T');
        $fpdf->Cell(126, 5, utf8_decode('M.E. ANGÉLICA MARÍA CASTILLO LÓPEZ'), 'LR', 1, 'C');
        $fpdf->Cell(126, 5, utf8_decode('NOMBRE Y FIRMA DEL TITULAR DE LA UNIDAD RESPONSABLE EDUCATIVA'), 1, 1, 'C');


        $fpdf->Output();
        exit;
    }
}
