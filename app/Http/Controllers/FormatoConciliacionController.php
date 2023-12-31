<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FormatoConciliacionController extends Controller
{
    public function Conciliacion(){
        $fpdf = new FPDF();
        $fpdf->AddPage();

        $fpdf->Image('img/secretaria.png', 15, 10, -90);
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(50, 5, '', 0, 0);
        $fpdf->Cell(141, 5, utf8_decode('CENTRO DE BACHILLERATO TECNOLOGICO '), 0, 1, 'C');

        $fpdf->Cell(50, 8, '', 0, 0);
        $fpdf->Cell(141, 8, utf8_decode('AGROPECUARIO No. 284'), 0 , 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 10, '', 0, 1);

        $fpdf->Cell(191, 8, utf8_decode('CONCILIACION DE RECIBOS OFICIALES DE COBRO'), 0, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 10, '', 0, 1);

        $fpdf->Cell(58, 8, utf8_decode('MES'), 1, 0,'C');
        $fpdf->Cell(58, 8, utf8_decode('CLAVE CT:'), 1, 0,'C');
        $fpdf->Cell(75, 8, utf8_decode('UBICACIÓN:'), 1, 1, 'C');

        $fpdf->Cell(58, 8, utf8_decode(''), 1, 0,'C');
        $fpdf->Cell(58, 8, utf8_decode(''), 1, 0,'C');
        $fpdf->Cell(75, 8, utf8_decode(''), 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 10, '', 0, 1);

        $fpdf->Cell(191, 8, utf8_decode('FOLIO DEL MES'), 1, 1, 'C');

        $fpdf->Cell(91, 8, utf8_decode('INICIO NUM'), 1, 0, 'C');
        $fpdf->Cell(100, 8, utf8_decode('FINAL AL NUM'), 1, 1, 'C');

        $fpdf->Cell(91, 35, utf8_decode(''), 1, 0, 'C');
        $fpdf->Cell(100, 35, utf8_decode(''), 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 13, '', 0, 1);
        
        $fpdf->setfont('arial','',10);
        $fpdf->Cell(60, 8, utf8_decode(' R.O.C. UTILIZADOS:  '), 1, 0);
        $fpdf->Cell(30, 8, utf8_decode(''), 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 8, '', 0, 1);

        $fpdf->Cell(60, 8, utf8_decode(' R.O.C. UTILIZADOS:  '), 1, 0);
        $fpdf->Cell(30, 8, utf8_decode(''), 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 8, '', 0, 1);

        $fpdf->Cell(60, 8, utf8_decode(' R.O.C. UTILIZADOS:  '), 1, 0);
        $fpdf->Cell(30, 8, utf8_decode(''), 1, 1, 'C');

        //espacio vacio
        $fpdf->Cell(191, 15, '', 0, 1);

        //firmas
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(10, 30, '', 0, 0);
        $fpdf->Cell(80, 30, '', 'LRT', 0);
        $fpdf->Cell(11, 30, '', 0, 0);
        $fpdf->Cell(80, 30, '', 'LRT', 0);
        $fpdf->Cell(10, 30, '', 0, 1);

        $fpdf->Cell(10, 8, '', 0, 0);
        $fpdf->Cell(80, 8, '', 'LR', 0);
        $fpdf->Cell(11, 8, '', 0, 0);
        $fpdf->Cell(80, 8, utf8_decode('M.E. ANGÉLICA MARÍA CASTILLO LÓPEZ'), 'LR', 0,'C');
        $fpdf->Cell(10, 8, '', 0, 1);

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(10, 8, '', 0, 0);
        $fpdf->Cell(80, 8, utf8_decode('SELLO DEL PLANTEL'), 1, 0,'C');
        $fpdf->Cell(11, 8, '', 0, 0);
        $fpdf->Cell(80, 8, utf8_decode('DIRECTOR DEL PLANTEL'), 1, 0,'C');
        $fpdf->Cell(10, 8, '', 0, 1);

        $fpdf->Output();
        exit;


    }
}
