<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultas;
use Codedge\Fpdf\Fpdf\Fpdf;

class ControlDeIngresosController extends Controller
{ 
    private function Conversion($numero){
        $formatear = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        return ucfirst($formatear->format($numero));
    }


    public function Ingresos($id){

        $consultas = Consultas::with(['alumno','claves_p'])->find($id);
        if (!$consultas){
            abort(404);
        }
 
        $cantidadEnLetras = $this->Conversion($consultas->cantidad);
        $alumno = $consultas->alumno;
        $clave = $consultas->claves_p;
        $fecha_actual = date("d-m-Y");

        $fpdf = new FPDF('L');
        $fpdf->AddPage();

        //seccion 1(priemra fila horizontal)
        $fpdf->Image('img/secretaria.png', 10, 7, -90);
        $fpdf->Image('img/texto_ingresos.png', -20, 50, -180);
        $fpdf->setfont('arial','',12);
        $fpdf->Cell(60, 6, '', 0, 0);
        $fpdf->Cell(145, 6, utf8_decode('SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR'), 0, 0, 'C');
        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(30, 6, 'UR', 1, 0,'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'RECIBO No.', 1, 1,'C');

        //seccion 2
        $fpdf->setfont('arial','',10);
        $fpdf->Cell(60, 6, '', 0, 0);
        $fpdf->Cell(145, 6, utf8_decode('Dirección General de Educación Tecnológica Agropeciaria y Ciencias del Mar'), 0, 0, 'C');
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(30, 6, '610', 1, 0,'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'DGETAYCM 7949987', 1, 1,'C');

        //seccion 3
        $fpdf->setfont('arial','B',14);
        $fpdf->Cell(277, 6, utf8_decode('RECIBO OFICIAL DE COBRO'), 0, 1,'C');


        //seccion 4
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(50, 6, '', 0, 0);
        $fpdf->Cell(155, 6, utf8_decode('R.F.C. SEP 210905778'), 0, 0, 'C');
        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(30, 6, 'FECHA', 1, 0,'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, 'ENTIDAD FEDERATIVA', 1, 1,'C');

        //seccion 5
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(205, 6, utf8_decode('AVENIDA REPÚBLICA DE ARGENTINA, NUMERO EXTERIOR 28, NUMERO INTERIOR:OFICINA 1044'), 0, 0);
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(30, 6, $fecha_actual, 1, 0,'C');
        $fpdf->Cell(7, 6, '', 0, 0);
        $fpdf->Cell(35, 6, '31', 1, 1,'C');

        //seccion 6
        $fpdf->Cell(277, 6, utf8_decode('COLONIA, CENTRO, C.P. 06010, DELEGACIÓN:CUAUHTÉMOC, ENTIDAD FEDERATIVA:CUIDAD DE MÉXICO'), 0, 1);

        //seccion 7
        $fpdf->setfont('arial','B',10);
        $fpdf->Cell(277, 6, utf8_decode('RECIBÍ DE'), 0, 1,'C');

        //seccion 8
        $fpdf->setfont('arial','',8);
        $fpdf->Cell(63, 6, utf8_decode($alumno->apellido_p), 'LTB', 0,'C');
        $fpdf->Cell(63, 6, utf8_decode($alumno->apellido_m), 'TB', 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode($alumno->nombres), 'RTB', 0,'C');
        $fpdf->Cell(18, 6, '', 0, 0);
        $fpdf->Cell(70, 6, utf8_decode('R.F.C. y/o MATRICULA'), 1, 1,'C');

        $fpdf->setfont('arial','B',8);
        $fpdf->Cell(63, 6, utf8_decode('APELLIDO PATERNO '), 1, 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode('APELLIDO MATERNO'), 1, 0, 'C');
        $fpdf->Cell(63, 6, utf8_decode('NOMBRE (S)'), 1, 0,'C');
        $fpdf->Cell(18, 6, '', 0, 0);
        $fpdf->Cell(70, 6, $alumno->matricula, 1, 1,'C');

        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);

        //seccion 9
        $fpdf->Cell(198, 3, '', 'LRT', 0);
        $fpdf->Cell(16, 3, '', 0, 0);
        $fpdf->Cell(20, 3, '', 'LT', 0);
        $fpdf->Cell(23, 3, '', 'T', 0);
        $fpdf->Cell(20, 3, '', 'RT', 1);

        $fpdf->Cell(198, 10, 'CONOCIDO', 'LRB', 0,'C');
        $fpdf->Cell(16, 10, '', 0, 0);
        $fpdf->Cell(20, 10, utf8_decode($alumno->grado), 'LRB', 0,'C');
        $fpdf->Cell(23, 10, utf8_decode($alumno->grupo), 'LRB', 0,'C');
        $fpdf->Cell(20, 10, utf8_decode($alumno->turno), 'LRB', 1,'C');

        $fpdf->Cell(198, 5, '', 1, 0);
        $fpdf->Cell(16, 5, '', 0, 0);
        $fpdf->Cell(20, 5, utf8_decode('GRADO'), 1, 0);
        $fpdf->Cell(23, 5, utf8_decode('GRUPO'), 1, 0);
        $fpdf->Cell(20, 5, utf8_decode('TURNO'), 1, 1);

        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);

        //seccion 10
        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(25, 8, utf8_decode('LA CANTIDA ES $'), 'LTB', 0);
        $fpdf->Cell(40, 8, $consultas->cantidad, 'RTB', 0);
        $fpdf->Cell(212, 8, $cantidadEnLetras.' Pesos', 1, 1,'C');

        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);

        //SECCION 11
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, utf8_decode('CANTIDAD'), 0, 0,'C');
        $fpdf->Cell(30, 6, utf8_decode('CLAVE'), 0, 0,'C');
        $fpdf->Cell(105, 6, utf8_decode('CONCEPTO'), 0, 0,'C');
        $fpdf->Cell(38, 6, utf8_decode('CUOTA'), 0, 0,'C');
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, utf8_decode('IMPORTE'), 0, 1,'C');
        
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(20, 6,'', 0, 0);
        $fpdf->Cell(30, 6, $consultas->cantidad, 1, 0,'C');
        $fpdf->Cell(30, 6, $clave->clave, 1, 0,'C');
        $fpdf->Cell(105, 6, $clave->concepto, 1, 0,'C');
        $fpdf->Cell(38, 6, $consultas->cuota, 'LRB', 0,'C');
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, $consultas->importe, 'LRB', 1,'C');
        
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 1, 0);
        $fpdf->Cell(30, 6, '', 1, 0);
        $fpdf->Cell(105, 6, '', 1, 0);
        $fpdf->Cell(38, 6, '', 1, 0);
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, '', 1, 1);

        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 'LTB', 0);
        $fpdf->Cell(30, 6, '', 'TB', 0);
        $fpdf->Cell(105, 6, '', 'RTB', 0);
        $fpdf->Cell(38, 6, '', 1, 0);
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, '', 1, 1);

        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 0, 0);
        $fpdf->Cell(30, 6, '', 1, 0);
        $fpdf->Cell(105, 6, '', 0, 0);
        $fpdf->Cell(38, 6, utf8_decode('TOTAL'), 0, 0,'C');
        $fpdf->Cell(4, 6, '', 0, 0);
        $fpdf->Cell(50, 6, $consultas->importe, 0, 1,'C');

        //espacio vacio
        $fpdf->Cell(277, 6, '', 0, 1);

        //seccion 12
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(80, 6, utf8_decode('NOMBRE Y FIRMA DEL CAJERO'), 'LRT', 0,'C');
        $fpdf->Cell(80, 6, utf8_decode('SELLO Y DATOS IMPRESOS DE LA ESCUELA'), 'LRT', 0,'C');
        $fpdf->Cell(5, 6,'', 0, 0);
        $fpdf->Cell(92, 6, '', 1, 1);

        $fpdf->Cell(20, 13, '', 0, 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(5, 13,'', 0, 0);
        $fpdf->Cell(92, 13, '', 1, 1);

        $fpdf->Cell(20, 13, '', 0, 0);
        $fpdf->Cell(80, 13, '', 'LRT', 0);
        $fpdf->Cell(80, 13, '', 'LR', 0);
        $fpdf->Cell(5, 13,'', 0, 0);
        $fpdf->Cell(92, 13, '', 1, 1);

        $fpdf->Cell(20, 6, '', 0, 0);
        $fpdf->Cell(80, 6, 'M.E. JORGE CARLOS AZCORRA OSORIO', 'LRB', 0,'C');
        $fpdf->Cell(80, 6, '', 'LRB', 0);
        $fpdf->Cell(5, 6,'', 0, 0);
        $fpdf->Cell(92, 6, '', 1, 1);
        $fpdf->Image('img/SAT.png', 195, 144, -185);
        

        //encabezado
        $fpdf->setfont('arial','',6);
        $fpdf->Cell(277, 6, utf8_decode('NOTA: CARECE DE VALIDEZ COMO COMPROBANTE DE PAGO SI NO TIENE SELLO DE LA ESCUELA Y FIRMA DEL CAJERO EXENTO DE I.V.A. CONFORME AL ART. 15 FRACC. IV DE LA LEY DE IMPUESTO AL VALOR AGREGADO'), 0, 1,'C');

        $fpdf->Output();
        exit;


    }
}
