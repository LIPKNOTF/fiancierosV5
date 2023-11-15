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

        //tabla
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(70, 7,'','LRT',0);
        $fpdf->Cell(61, 7, utf8_decode('CIFRAS AL CORTE MENSUAL ACTUAL'),1,0,'C');
        $fpdf->Cell(61, 7, utf8_decode('CIFRAS AL CORTE MENSUAL ANTERIOR'),1,1,'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(70, 7,utf8_decode('SALDO INICIAL DEL PERÍODO'),'LR',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',1);

        $fpdf->Cell(70, 8,'','LR',0);
        $fpdf->Cell(61, 8,'','LR',0);
        $fpdf->Cell(61, 8,'','LR',1);

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(70, 7,utf8_decode('MÁS: '),'LR',0);
        $fpdf->Cell(61, 7,'','LR',0);
        $fpdf->Cell(61, 7,'','LR',1);

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('INGRESOS '),'R',0);
        $fpdf->Cell(61, 7,'','LR',0);
        $fpdf->Cell(61, 7,'','LR',1);

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('INGRESOS PROPIOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);
        
        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('DEUDORES DIVERSOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);


        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('ACREEDORES DIVERSOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('REINTEGROS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',1);

        $fpdf->Cell(70, 8,'','LR',0);
        $fpdf->Cell(61, 8,'','LR',0);
        $fpdf->Cell(61, 8,'','LR',1);

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(70, 7,utf8_decode('TOTAL DE DISPONIBILIDAD EN EL PERÍODO'),'LR',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',1);

        $fpdf->setfont('arial','',8);
        $fpdf->Cell(70, 7,utf8_decode('MENOS: '),'LR',0);
        $fpdf->Cell(61, 7,'','LR',0);
        $fpdf->Cell(61, 7,'','LR',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('APLICACIÓN DE FONDOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('DEUDORES DIVERSOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('GASTOS DE OPERACIÓN'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('ACREEDORES DIVERSOS'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(15, 7,'','L',0);
        $fpdf->Cell(55, 7,utf8_decode('PROVEEDORES'),'R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','LB',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(70, 8,'','LR',0,'C');
        $fpdf->Cell(61, 8,'','LR',0);
        $fpdf->Cell(61, 8,'','LR',1);

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(70, 7,utf8_decode('TOTAL DE EGRESOS EN EL PERÍODO'),'LR',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',1);

        $fpdf->Cell(70, 8,'','LR',0,'C');
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','R',1);

        $fpdf->Cell(70, 7,utf8_decode('SALDO FINAL DEL PERÍODO'),'LR',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',0);
        $fpdf->Cell(27, 7,'','L',0);
        $fpdf->Cell(10, 7,'',0,0);
        $fpdf->Cell(24, 7,'','RB',1);

        $fpdf->Cell(70, 8,'','LRB',0,'C');
        $fpdf->Cell(61, 8,'','LRB',0);
        $fpdf->Cell(61, 8,'','LRB',1);

        $fpdf->Cell(192, 7,'',0,1);

        //firmas
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(72, 7,utf8_decode('ELABORÓ'),'LRT',0,'C');
        $fpdf->Cell(48, 7,'',0,0);
        $fpdf->Cell(72, 7,utf8_decode('Vo.Bo.'),'LRT',1,'C');

        $fpdf->Cell(72, 25, '', 'LRB', 0, 'T');
        $fpdf->Cell(48, 25, '', 0, 0, 'T');
        $fpdf->Cell(72, 25, '', 'LRB', 1, 'T');

        $fpdf->Cell(72, 5, utf8_decode('M.E. JORGE CARLOS AZCORRA OSORIO'), 1, 0, 'C');
        $fpdf->Cell(48, 5, '', 0, 0, 'C');
        $fpdf->Cell(72, 5, utf8_decode('M.E. ANGÉLICA MARÍA CASTILLO LÓPEZ'), 1, 1, 'C');

        $fpdf->Cell(72, 5, utf8_decode('JEFE DE RECURSOS FINANCIEROS, MATERIALES'), 'LR', 0, 'C');
        $fpdf->Cell(48, 5, utf8_decode('SELLO DEL PLANTEL'), 0, 0, 'C');
        $fpdf->Cell(72, 5, utf8_decode('DIRECTORA DEL PLANTEL'), 'LR', 1, 'C');

        $fpdf->Cell(72, 5, utf8_decode(' Y SERVICIOS'), 'LRB', 0, 'C');
        $fpdf->Cell(48, 5, '', 0, 0, 'C');
        $fpdf->Cell(72, 5, utf8_decode(''), 'LRB', 1, 'C');

        $fpdf->Output();
        exit;
    }
}
