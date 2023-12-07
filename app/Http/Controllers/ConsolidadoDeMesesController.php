<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;
use Carbon\Carbon;
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
        $fpdf->Cell(10, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 16, '', 'LR', 1, 'C');

        //2
        $fpdf->Cell(10, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 16, '', 'LR', 1, 'C');

        //3
        $fpdf->Cell(10, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 16, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 16, '', 'LR', 1, 'C');

        $fpdf->SetXY(72, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');
        
        //parte media 1
        $fpdf->SetXY(75, 74);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //2
        $fpdf->SetXY(75, 94);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //3
        $fpdf->SetXY(75, 114);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //4
        $fpdf->SetXY(75, 134);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //5
        $fpdf->SetXY(75, 154);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //6
        $fpdf->SetXY(75, 174);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        //7
        $fpdf->SetXY(75 , 194);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 0, 'C');

        
        $fpdf->SetXY(137, 74);
        $fpdf->Cell(3, 150, '', 1, 0, 'C');

        //PARTE SUPERIOR DERECHA 1
        $fpdf->SetXY(140, 74);
        $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 19, '', 'LR', 1, 'C');

        //2
        $fpdf->SetXY(140, 93);
        $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 19, '', 'LR', 1, 'C');

        //3
        $fpdf->SetXY(140, 112);
        $fpdf->Cell(10, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 19, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 19, '', 'LR', 1, 'C');

        //TOTAL ULTIMA FILA
        $fpdf->SetXY(140, 131); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$', 1, 1, 'C');

        //TOTAL PRIMERA FILA
        $fpdf->SetY(122); // Cambia la posición horizontal según tu diseño
        $fpdf->Cell(35, 10, 'Total', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, '$', 1, 1, 'C');

        //SEGUNDA CELDA DE LA ULTIMA FILA
        $fpdf->SetXY(140, 141);
        $fpdf->Cell(62, 3, '', 1, 1, 'C'); 

        $fpdf->SetXY(140, 144);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        //SEGUDNA FILA DE INFERIOR DERECHA 1
        $fpdf->SetX(140);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 1, 'C');

        //2
        $fpdf->SetX(140);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 1, 'C');

        //3
        $fpdf->SetX(140);
        $fpdf->Cell(10, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 20, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 20, '', 'LR', 1, 'C');

        //SEGUNDA CELDA DE LA PRIMERA FILA
        $fpdf->SetY(132);
        $fpdf->Cell(10, 10, 'GPO', 1, 0, 'C'); 
        $fpdf->Cell(25, 10, 'SUBGRUPO', 1, 0, 'C'); 
        $fpdf->Cell(27, 10, 'IMPORTE', 1, 1, 'C');
        
        //1
        $fpdf->SetY(142);
        $fpdf->Cell(10, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 18, '', 'LR', 1, 'C');

        //2
        $fpdf->Cell(10, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 18, '', 'LR', 1, 'C');

        //3
        $fpdf->Cell(10, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 18, '', 'LR', 1, 'C');

        //4
        $fpdf->Cell(10, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(25, 18, '', 'LR', 0, 'C');
        $fpdf->Cell(27, 18, '', 'LR', 1, 'C');

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
