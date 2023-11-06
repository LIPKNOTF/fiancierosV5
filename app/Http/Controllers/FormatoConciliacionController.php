<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FormatoConciliacionController extends Controller
{
    public function Conciliacion(){
        $fpdf = new FPDF();
        $fpdf->AddPage();

        $fpdf->Output();
        exit;


    }
}
