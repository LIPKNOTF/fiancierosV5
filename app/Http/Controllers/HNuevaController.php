<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class HNuevaController extends Controller
{
    public function hojares(){
        //    return 'hola rporte';
        $fpdf = new FPDF();
        $fpdf->AddPage();
        
        //titulos
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(180, 3, utf8_decode('DIRECCIÓN GENERAL DE EDUCACIÓN TECNOLÓGICA AGROPECUARIA Y CIENCIAS DEL MAR'), 0, 1, 'C');
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(180, 10, utf8_decode('Centro de Bachillerato Tecnológico Agropecuario N° 284, Tunkás, Yucatán.'), 0, 1, 'C');
        $fpdf->Ln();
            
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(180, 5, utf8_decode('RECURSOS FINANCIEROS'), 0, 1, 'C');
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(180, 5, utf8_decode('CONCILIACIÓN CORRESPONDIENTE AL MES DE AGOSTO DEL 2023'), 0, 1, 'C');
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(180, 5, utf8_decode('INGRESOS PROPIOS DEL PLANTEL EN CAJA'), 0, 1, 'C');
        $fpdf->Ln();

        //tabla
        $fpdf->Cell(23, 10, utf8_decode('N° de poliza'), 1, 0, 'C');
        $fpdf->Cell(167, 10, utf8_decode('Conciliacion'), 1, 1, 'C');

            //fila 1 
            $fpdf->Cell(23, 8, '', 1, 0, 'C');
            $fpdf->Cell(65, 8, 'Concepto', 1, 0, 'C');
            $fpdf->Cell(52, 8, 'Saldo en caja', 1, 0, 'C');
            $fpdf->Cell(50, 8, 'Estado del pago', 1, 1, 'C');

            $fpdf->setfont('arial','',10);
            //fila 2
            $fpdf->Cell(23, 5, '', 1, 0, 'C');
            $fpdf->Cell(65, 5, 'Saldo anterior', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(50, 5, '', 1, 1, 'C'); 

            //fila 3
            $fpdf->Cell(23, 5, '', 1, 0, 'C');
            $fpdf->Cell(65, 5, 'Ingresos depositados', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C'); 

            //fila 4
            $fpdf->Cell(23, 5, '', 1, 0, 'C');
            $fpdf->Cell(65, 5, 'Total disponible', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C'); 

            //fila 5
            $fpdf->Cell(23, 5, '', 1, 0, 'C');
            $fpdf->Cell(65, 5, 'Total gastado', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(50, 5, '', 1, 1, 'C'); 

            //fila 5
            $fpdf->Cell(23, 5, '', 1, 0, 'C');
            $fpdf->Cell(65, 5, 'Saldo al final de mes', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');
           

        //tabla 2
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(190, 8, 'Detalle de movimientos', 1, 1, 'C');

            $fpdf->setfont('arial','',10);
            $fpdf->Cell(23, 5, '1', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '2', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '3', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '4', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '5', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '6', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '7', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '8', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '9', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '10', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '11', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '12', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '13', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '14', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '15', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '16', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '17', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '18', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '19', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '20', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '21', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '22', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '23', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '24', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '25', 1, 0, 'C');
            $fpdf->Cell(65, 5, '', 1, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 1, 0, 'C');
            $fpdf->Cell(26, 5, '', 1, 0, 'C');
            $fpdf->Cell(50, 5, '', 1, 1, 'C');

            $fpdf->Cell(23, 5, '', 0, 0, 'C');
            $fpdf->Cell(65, 5, 'Subtotal', 0, 0, 'C'); 
            $fpdf->Cell(26, 5, '$', 0, 0, 'C');
            $fpdf->Cell(26, 5, '$', 0, 0, 'C');
            $fpdf->Cell(50, 5, '', 0, 1, 'C');
            $fpdf->Ln();

        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(190, 3, '', 0, 0, 'C');
        $fpdf->Ln();
        $fpdf->Cell(95, 5, utf8_decode('Elaboró'), 0, 0, 'C');
        $fpdf->Cell(95, 5, utf8_decode('Autorizó y Vo Bo'), 0, 1, 'C');
        
        $fpdf->Cell(95, 5, utf8_decode('Jefe de Recursos financieros, materiales y servicios'), 0, 0, 'C');
        $fpdf->Cell(95, 5, utf8_decode('Directora'), 0, 1, 'C');

        $fpdf->Cell(95, 18, utf8_decode(''), 0, 0, 'C');
        $fpdf->Cell(95, 18, utf8_decode(''), 0, 1, 'C');

        $fpdf->Cell(95, 5, utf8_decode('M.E. JORGE CARLOS AZCORRA OSORIO'), 0, 0, 'C');
        $fpdf->Cell(95, 5, utf8_decode('M.E. ANGÉLICA MARÍA CASTILLO LÓPEZ'), 0, 1, 'C');


        $fpdf->Output();
        exit;
        
    }
}
