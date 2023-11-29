<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ConsolidadoDeMesesController extends Controller
{
    public function Consolidado(){
        $fpdf = new FPDF();
        $fpdf->AddPage();
        
        //titulos
        $fpdf->setfont('arial','B',12);
        $fpdf->Cell(180, 5, utf8_decode('INFORME CONSOLIDADO DE INGRESOS'), 0, 1, 'C');

        // Ruta de la imagen y posición en la página
        $imagePath = 'img/secretaria.png'; // Reemplaza con la ruta de tu imagen
        $imageX = 10; // Posición horizontal de la imagen
        $imageY = $fpdf->GetY(); // Obtiene la posición vertical actual
        $imageWidth = 55; // Ancho de la imagen
        $imageHeight = 8; // Alto de la imagen
        $fpdf->Image($imagePath, $imageX, $imageY, $imageWidth);
        $fpdf->Ln($imageHeight + 10); // Ajusta la posición vertical según tus necesidades

        //texto despues de la imagen
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(125, 3, utf8_decode('UNIDAD RESPONSABLE EDUCATIVA : C.B.T.A No.284'), 0, 1, 'l');
        $fpdf->Cell(125, 4, utf8_decode('NIVEL EDUCATIVO: MEDIO SUPERIOR'), 0, 1, 'l');
        $fpdf->Ln();

        $fpdf->Cell(45, 5, '$', 'B', 0, 'C');
        $fpdf->Cell(40, 5, '', 0, 0, 'C');//espacio en blanco entre lineas
        $fpdf->Cell(45, 5, '', 'B', 0, 'C');
        $fpdf->Cell(15, 5, '', 0, 0, 'C');//espacio 
        $fpdf->Cell(45, 5, '', 'B', 1, 'C');

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

        //SUPERIOR IZQUIERDO 1
        $fpdf->Cell(10, 16, '', 1, 0, 'C');
        $fpdf->Cell(25, 16, '', 1, 0, 'C');
        $fpdf->Cell(27, 16, '', 1, 1, 'C');

        //2
        $fpdf->Cell(10, 16, '', 1, 0, 'C');
        $fpdf->Cell(25, 16, '', 1, 0, 'C');
        $fpdf->Cell(27, 16, '', 1, 1, 'C');

        //3
        $fpdf->Cell(10, 16, '', 1, 0, 'C');
        $fpdf->Cell(25, 16, '', 1, 0, 'C');
        $fpdf->Cell(27, 16, '', 1, 1, 'C');

        $fpdf->SetXY(72, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        
        $fpdf->SetXY(75, 74);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75, 94);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75, 114);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75, 134);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75, 154);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75, 174);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(75 , 194);
        $fpdf->Cell(10, 20, '', 1, 0, 'C');
        $fpdf->Cell(25, 20, '', 1, 0, 'C');
        $fpdf->Cell(27, 20, '', 1, 0, 'C');

        $fpdf->SetXY(137, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        $fpdf->Cell(10, 58, '', 1, 0, 'C');
        $fpdf->Cell(25, 58, '', 1, 0, 'C');
        $fpdf->Cell(27, 58, '', 1, 1, 'C');

        //TOTAL ULTIMA FILA
        $fpdf->SetX(140); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$', 1, 1, 'C');

        //TOTAL PRIMERA FILA
        $fpdf->SetY(122); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$', 1, 1, 'C');

        //SEGUNDA CELDA DE LA ULTIMA FILA
        $fpdf->SetY(142);
        $fpdf->SetX(140);
        $fpdf->Cell(62, 3, '', 1, 1, 'C'); 

        $fpdf->SetY(145);
        $fpdf->SetX(140);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        $fpdf->SetX(140);
        $fpdf->Cell(10, 59, '', 1, 0, 'C');
        $fpdf->Cell(25, 59, '', 1, 0, 'C');
        $fpdf->Cell(27, 59, '', 1, 1, 'C');

        //SEGUNDA CELDA DE LA PRIMERA FILA
        $fpdf->SetY(132);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        $fpdf->SetY(142);
        $fpdf->Cell(10, 72, '', 1, 0, 'C');
        $fpdf->Cell(25, 72, '', 1, 0, 'C');
        $fpdf->Cell(27, 72, '', 1, 1, 'C');

        $fpdf->SetY(214);
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
