<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FlujoDeEfectivoController extends Controller
{
    public function Flujo(){
        $fpdf = new FPDF();
        $fpdf->AddPage();

        $fpdf->Image('img/secretaria2.png', 10, 10, -200);
        $fpdf->Image('img/DGETAYCM.png', 155, 10, 45);
        $fpdf->Cell(180, 5, utf8_decode(''), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode(''), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode(''), 0, 1, 'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(180, 5, utf8_decode('DIRECCIÓN GENERAL DE EDUCACIÓN TECNOLÓGICA AGROPECUARIA Y CIENCIAS DEL MAR'), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode('CENTRO DE BACHILLERATO TECNOLÓGICO AGROPECUARIO No. 284'), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode('CCT: 31DTA0284Z'), 0, 1, 'C');
        $fpdf->Cell(180, 3, utf8_decode(''), 0, 1, 'C');

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(180, 5, utf8_decode('INFORMACIÓN DE INGRESOS PROPIOS'), 0, 1, 'C');
        $fpdf->Cell(180, 5, utf8_decode('FLUJO DE EFECTIVO AL 31 DE AGOSTO DE 2023'), 0, 1, 'C');

        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(180, 4,'Caja',0,1,'C');

        $fpdf->Cell(82, 5,'','LRT',0);
        $fpdf->Cell(55, 5,'',1,0);
        $fpdf->Cell(55, 5,'',1,1);

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(82, 5,utf8_decode('SALDO INICIAL DEL PERÍODO'),'LRB',0);
        $fpdf->Cell(55, 5,'',1,0);
        $fpdf->Cell(55, 5,'',1,1);

        $fpdf->Output();
        exit;
    }
}
