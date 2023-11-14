<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concentrado;
use Codedge\Fpdf\Fpdf\Fpdf;

class ControlDeFacturasController extends Controller
{
    
    public function Facturas($id){

        $concentrado = Concentrado::with('partida')->find($id);

        if (!$concentrado){
            abort(404);
        }

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

        $fpdf->Cell(45, 5, $concentrado->total, 'B', 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio en blanco entre lineas
        $fpdf->Cell(45, 5, '', 'B', 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio 
        $fpdf->Cell(45, 5, $concentrado->fecha, 'B', 1, 'C');

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

        $fpdf->Cell(10, 140, '', 1, 0, 'C');
        $fpdf->Cell(25, 140, '', 1, 0, 'C');
        $fpdf->Cell(27, 140, '', 1, 0, 'C');
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        $fpdf->Cell(10, 140, '', 1, 0, 'C');
        $fpdf->Cell(25, 140, '', 1, 0, 'C');
        $fpdf->Cell(27, 140, '', 1, 0, 'C');
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
        $fpdf->Cell(27, 10, '$', 1, 0, 'C');
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
