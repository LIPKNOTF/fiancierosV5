<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clave;
use Codedge\Fpdf\Fpdf\Fpdf;

class PolizaDeIngresosController extends Controller
{
    public function Poliza($id){

        $clave = Clave::find($id);

        $fecha_actual = date("Y-m-d");

        $fpdf = new FPDF();
        $fpdf->AddPage();

        $fpdf->setfont('arial','B',12);
        $fpdf->Cell(180, 5, utf8_decode('POLIZA DE INGRESOS'), 0, 1, 'C');

        $imagePath = 'img/secretaria.png'; 
        $imageX = 10; 
        $imageY = $fpdf->GetY(); 
        $imageWidth = 60; 
        $imageHeight = 13; 
        $fpdf->Image($imagePath, $imageX, $imageY, $imageWidth);
        $fpdf->Ln($imageHeight + 10); 

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(86, 10, '', 0, 0, 'C');
        $fpdf->Cell(38, 10, 'PERIODO DE INFORME', 1, 0, 'C');
        $fpdf->Cell(38, 10, utf8_decode('FECHA DE ELABORACIÓN'), 1, 0, 'C');
        $fpdf->Cell(30, 10, 'POLIZA', 1, 1, 'C');

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(86, 7, '', 0, 0, 'C');
        $fpdf->Cell(38, 7, utf8_decode(''), 1, 0, 'C');
        $fpdf->Cell(38, 7, utf8_decode($fecha_actual), 1, 0, 'C');
        $fpdf->Cell(30, 7, utf8_decode(''), 1, 1, 'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(162, 8,  utf8_decode('DENOMINACIÓN'), 1, 0, 'C');
        $fpdf->Cell(30, 8, 'CARGO', 1, 1, 'C');
        
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(162, 25,  utf8_decode(''), 1, 0, 'C');
        $fpdf->Cell(30, 25,  utf8_decode(''), 1, 1, 'C');

        $fpdf->Cell(192, 8, '', 0, 1, 'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(25, 8,  utf8_decode('CLAVE'), 1, 0, 'C');
        $fpdf->Cell(137, 8,  utf8_decode('DENOMINACIÓN'), 1, 0, 'C');
        $fpdf->Cell(30, 8, 'ABONO', 1, 1, 'C');
        
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(25, 65,  utf8_decode($clave->clave), 1, 0, 'C');
        $fpdf->Cell(137, 65,  utf8_decode($clave->concepto), 1, 0, 'C');
        $fpdf->Cell(30, 65,  utf8_decode('$'.$clave->precio), 1, 1, 'C');

        $fpdf->Cell(25, 6,  utf8_decode(''), 0, 0, 'C');
        $fpdf->Cell(107, 6,  utf8_decode(''), 0, 0, 'C');
        $fpdf->Cell(30, 6,  utf8_decode('TOTAL'), 0, 0, 'C');
        $fpdf->Cell(30, 6,  utf8_decode('$'.$clave->precio), 1, 1, 'C');

        $fpdf->Cell(192, 8, '', 0, 1, 'C');

        $fpdf->Cell(192, 35, utf8_decode('OBSERVACIONES'), 1, 1, 'C');

        $fpdf->Cell(192, 8, '', 0, 1, 'C');

        $fpdf->Cell(52, 7,  utf8_decode('ELABORÓ'), 1, 0, 'C');
        $fpdf->Cell(70, 7,  utf8_decode('AUTORIZÓ'), 1, 0, 'C');
        $fpdf->Cell(70, 7,  utf8_decode('REGISTRO EN LIBRO'), 1, 1, 'C');
        $fpdf->Cell(52, 35,  utf8_decode(''), 'LRT', 0, 'C');
        $fpdf->Cell(70, 35,  utf8_decode(''), 'LRT', 0, 'C');
        $fpdf->Cell(70, 35,  utf8_decode(''), 'LRT', 1, 'C');

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(52, 5,  utf8_decode('JCAO'), 'LRB', 0, 'C');
        $fpdf->Cell(70, 5,  utf8_decode('AMCL'),'LRB', 0, 'C');
        $fpdf->Cell(70, 5,  utf8_decode('JCAO'), 'LRB', 1, 'C');

        $fpdf->Output();
        exit;

    }
}
