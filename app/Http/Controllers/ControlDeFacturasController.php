<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egresos;
use Codedge\Fpdf\Fpdf\Fpdf;

class ControlDeFacturasController extends Controller
{
     
   

    public function Facturas($id){

        
        $egresos = Egresos::with(['partida.capitulo'])->find($id);
        
        if(!$egresos){
            abort(404);
        }

        $partida = $egresos->partida;
        $capitulo = $egresos->partida->capitulo;
        
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
        $numeroMes = $egresos->mes;
        $nombreMes = isset($nombresMeses[$numeroMes]) ? $nombresMeses[$numeroMes] : 'desconocido';
    

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

        $fpdf->Cell(45, 5, $egresos->total, 'B', 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio en blanco entre lineas
        $fpdf->Cell(45, 5, $nombreMes, 'B', 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio 
        $fpdf->Cell(45, 5, $egresos->created_at, 'B', 1, 'C');

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
        $fpdf->Cell(10, 14, $capitulo->codigo, 'LRT', 0, 'C');
        $fpdf->Cell(25, 14, $partida->codigo, 'LRT', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LRT', 1, 'C');

        //2FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C'); 

        //3FIAL1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C'); 

        //4FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //5FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //6FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //7FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //8FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //9FILA1
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //10FILA1
        $fpdf->Cell(10, 14, '', 'LRB', 0, 'C'); 
        $fpdf->Cell(25, 14, '', 'LRB', 0, 'C'); 
        $fpdf->Cell(27, 14, '', 'LRB', 1, 'C');
        
        $fpdf->SetXY(72, 74);
        $fpdf->Cell(3, 150, '', 1, 1, 'C');

        //1FILA2
        $fpdf->SetXY(75, 74);
        $fpdf->Cell(10, 14, '', 'LRT', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LRT', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LRT', 1, 'C');

        //2FILA2
        $fpdf->SetXY(75, 88);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //3FILA2
        $fpdf->SetXY(75, 102);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //4FILA2
        $fpdf->SetXY(75, 116);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //5FILA2
        $fpdf->SetXY(75, 130);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //6FILA2
        $fpdf->SetXY(75, 144);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //7FILA2
        $fpdf->SetXY(75, 158);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //8FILA2
        $fpdf->SetXY(75, 172);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //9FILA2
        $fpdf->SetXY(75, 186);
        $fpdf->Cell(10, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LR', 1, 'C');

        //10FILA2
        $fpdf->SetXY(75, 200);
        $fpdf->Cell(10, 14, '', 'LRB', 0, 'C');
        $fpdf->Cell(25, 14, '', 'LRB', 0, 'C');
        $fpdf->Cell(27, 14, '', 'LRB', 1, 'C');

        $fpdf->SetXY(137, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        $fpdf->Cell(10, 58, '', 1, 0, 'C');
        $fpdf->Cell(25, 58, '', 1, 0, 'C');
        $fpdf->Cell(27, 58, '', 1, 1, 'C');
 

        $fpdf->SetX(140); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$', 1, 1, 'C');

        $fpdf->SetX(140); 
        $fpdf->Cell(62, 4, '', 1, 1, 'C'); 
        

        $fpdf->SetX(140);
        $fpdf->Cell(10, 10, 'CAP', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'Subgrupo', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'Importe', 1, 1, 'C');
        
        $fpdf->SetX(140);
        $fpdf->Cell(10, 58, '', 1, 0, 'C');
        $fpdf->Cell(25, 58, '', 1, 0, 'C');
        $fpdf->Cell(27, 58, '', 1, 1, 'C');

        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
        $fpdf->Cell(27, 10, ('$'.$egresos->total), 1, 0, 'C');
        $fpdf->Cell(3, 0, '', 1, 0, 'C');
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C');
        $fpdf->Cell(27, 10, '$', 1, 0, 'C');
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
