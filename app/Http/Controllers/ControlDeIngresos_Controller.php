<?php

namespace App\Http\Controllers;
use App\Models\Consultas;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ControlDeIngresos_Controller extends Controller
{
    private function Conversion($numero){
        $formatear = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        return ucfirst($formatear->format($numero));
    }


    public function Ingresos($id){

        $consultas = Consultas::with(['alumno', 'detalleConsulta'])->find($id);
        if (!$consultas){
            abort(404);
        }

        $importe = $consultas->cantidad * $consultas->total;
        $importe_formateado = number_format($importe, 2);

        $total = $consultas->total;
        $total_formateado = number_format($total, 2);
        $cantidadEnLetras = $this->Conversion($consultas->total);
        $TotalCompleto = $cantidadEnLetras . ' Pesos ' . substr($total_formateado, strpos($total_formateado, '.') + 1);

        $alumno = $consultas->alumno;
        // $clave = $consultas->claves_p;
        $fecha_actual = date("d-m-Y");

        $fpdf = new FPDF();
        $fpdf->AddPage();

        $fpdf->SetDrawColor(0, 0, 0);
        $x1 = 5; 
        $y1 = 5; 
        $x2 = $fpdf->GetPageWidth() - 5; 
        $y2 = $fpdf->GetPageHeight() - 175; 

        $fpdf->Rect($x1, $y1, $x2 - $x1, $y2 - $y1);

        //seccion 1(priemra fila horizontal)
        // $fpdf->Cell(192, 100, '', 1, 1);
        // $fpdf->SetXY(10, 10);
        $fpdf->Image('img/secretaria.png', 10, 7, -120);
        $fpdf->Image('img/texto_ingresos.png', -8, 35, -292);
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(60, 4, '', 0, 0);
        $fpdf->Cell(80, 4, utf8_decode('SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR'), 0, 0, 'C');
        $fpdf->setfont('arial','B',6);
        $fpdf->Cell(20, 4, 'UR', 1, 0,'C');
        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(30, 4, 'RECIBO No.', 1, 1,'C');

        //seccion 2
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(53, 4, '', 0, 0);
        $fpdf->Cell(87, 4, utf8_decode('Dirección General de Educación Tecnológica Agropeciaria y Ciencias del Mar'), 0, 0, 'C');
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(20, 4, '610', 1, 0,'C');
        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(30, 4, 'DGETAYCM 7949987', 1, 1,'C');

        //seccion 3
        $fpdf->setfont('arial','B',12);
        $fpdf->Cell(192, 4, utf8_decode('RECIBO OFICIAL DE COBRO'), 0, 1,'C');


        //seccion 4
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(53, 4, '', 0, 0);
        $fpdf->Cell(87, 4, utf8_decode('R.F.C. SEP 210905778'), 0, 0, 'C');
        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(20, 4, 'FECHA', 1, 0,'C');
        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(30, 4, 'ENTIDAD FEDERATIVA', 1, 1,'C');

        //seccion 5
        $fpdf->setfont('arial','',6);
        $fpdf->Cell(140, 4, utf8_decode('AVENIDA REPÚBLICA DE ARGENTINA, NUMERO EXTERIOR 28, NUMERO INTERIOR:OFICINA 1044'), 0, 0);
        $fpdf->setfont('arial','',6);
        $fpdf->Cell(20, 4, $fecha_actual, 1, 0,'C');
        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(30, 4, '31', 1, 1,'C');

        //seccion 6
        $fpdf->Cell(192, 4, utf8_decode('COLONIA, CENTRO, C.P. 06010, DELEGACIÓN:CUAUHTÉMOC, ENTIDAD FEDERATIVA:CUIDAD DE MÉXICO'), 0, 1);

        //seccion 7
        $fpdf->setfont('arial','B',9);
        $fpdf->Cell(192, 4, utf8_decode('RECIBÍ DE'), 0, 1,'C');

        //seccion 8
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(41, 4, utf8_decode($alumno->apellido_p), 'LTB', 0,'C');
        $fpdf->Cell(41, 4, utf8_decode($alumno->apellido_m), 'TB', 0, 'C');
        $fpdf->Cell(41, 4, utf8_decode($alumno->nombres), 'RTB', 0,'C');
        $fpdf->Cell(10, 4, '', 0, 0);
        $fpdf->Cell(59, 4, utf8_decode('R.F.C. y/o MATRICULA'), 1, 1,'C');

        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(41, 4, utf8_decode('APELLIDO PATERNO '), 1, 0, 'C');
        $fpdf->Cell(41, 4, utf8_decode('APELLIDO MATERNO'), 1, 0, 'C');
        $fpdf->Cell(41, 4, utf8_decode('NOMBRE (S)'), 1, 0,'C');
        $fpdf->Cell(10, 4, '', 0, 0);
        $fpdf->Cell(59, 4, $alumno->matricula, 1, 1,'C');

        //espacio vacio
        $fpdf->Cell(192, 3, '', 0, 1);

        //seccion 9
        $fpdf->Cell(130, 3, '', 'LRT', 0);
        $fpdf->Cell(8, 3, '', 0, 0);
        $fpdf->Cell(18, 3, '', 'LT', 0);
        $fpdf->Cell(18, 3, '', 'T', 0);
        $fpdf->Cell(18, 3, '', 'RT', 1);

        $fpdf->Cell(130, 3, 'CONOCIDO', 'LRB', 0,'C');
        $fpdf->Cell(8, 3, '', 0, 0);
        $fpdf->Cell(18, 3, utf8_decode($alumno->grado), 'LRB', 0,'C');
        $fpdf->Cell(18, 3, utf8_decode($alumno->grupo), 'LRB', 0,'C');
        $fpdf->Cell(18, 3, utf8_decode($alumno->turno), 'LRB', 1,'C');

        $fpdf->Cell(130, 4, '', 1, 0);
        $fpdf->Cell(8, 4, '', 0, 0);
        $fpdf->Cell(18, 4, utf8_decode('GRADO'), 1, 0);
        $fpdf->Cell(18, 4, utf8_decode('GRUPO'), 1, 0);
        $fpdf->Cell(18, 4, utf8_decode('TURNO'), 1, 1);

        //espacio vacio
        $fpdf->Cell(277, 3, '', 0, 1);

        //seccion 10
        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(25, 5, utf8_decode('LA CANTIDA DE $'), 'LTB', 0);
        $fpdf->Cell(20, 5, $consultas->total, 'RTB', 0);
        $fpdf->Cell(147, 5, $TotalCompleto.'/100', 1, 1,'C');

        //espacio vacio
        $fpdf->Cell(192, 2, '', 0, 1);

        //SECCION 11
        $detalleConsulta = $consultas->detalleConsulta;

        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(20, 4, utf8_decode('CANTIDAD'), 0, 0,'C');
        $fpdf->Cell(20, 4, utf8_decode('CLAVE'), 0, 0,'C');
        $fpdf->Cell(85, 4, utf8_decode('CONCEPTO'), 0, 0,'C');
        $fpdf->Cell(25, 4, utf8_decode('CUOTA'), 0, 0,'C');
        $fpdf->Cell(3, 4, '', 0, 0);
        $fpdf->Cell(38, 4, utf8_decode('IMPORTE'), 0, 1,'C');
        
        foreach ($detalleConsulta as $row) {
        $claveDetalle = $row->claves_p;
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(2, 4,'', 0, 0);
        $fpdf->Cell(20, 4, $consultas->cantidad, 1, 0,'C');
        $fpdf->Cell(20, 4, $claveDetalle->clave, 1, 0,'C');
        $fpdf->Cell(85, 4, $claveDetalle->concepto, 1, 0,'C');
        $fpdf->Cell(25, 4, $claveDetalle->precio, 'LRB', 0,'C');
        $fpdf->Cell(3, 4, '', 0, 0);
        $fpdf->Cell(38, 4, $row->total, 'LRB', 1,'C');
    }

        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(20, 4, '', 'LTB', 0);
        $fpdf->Cell(20, 4, '', 'TB', 0);
        $fpdf->Cell(85, 4, '', 'RTB', 0);
        $fpdf->Cell(25, 4, '', 1, 0);
        $fpdf->Cell(3, 4, '', 0, 0);
        $fpdf->Cell(38, 4, '', 1, 1);

        $fpdf->setfont('arial','B',7);
        $fpdf->Cell(2, 4, '', 0, 0);
        $fpdf->Cell(20, 4, '', 0, 0);
        $fpdf->Cell(20, 4, '', 1, 0);
        $fpdf->Cell(85, 4, '', 0, 0);
        $fpdf->Cell(25, 4, utf8_decode('TOTAL'), 0, 0,'C');
        $fpdf->Cell(3, 4, '', 0, 0);
        $fpdf->Cell(38, 4, $consultas->total, 0, 1,'C');

        //espacio vacio
        $fpdf->Cell(192, 3, '', 0, 1);

        //seccion 12
        $fpdf->setfont('arial','',7);
        $fpdf->Cell(10, 4, '', 0, 0);
        $fpdf->Cell(60, 4, utf8_decode('NOMBRE Y FIRMA DEL CAJERO'), 'LRT', 0,'C');
        $fpdf->Cell(60, 4, utf8_decode('SELLO Y DATOS IMPRESOS DE LA ESCUELA'), 'LRT', 0,'C');
        $fpdf->Cell(5, 4,'', 0, 0);
        $fpdf->Cell(56, 4, '', 1, 1);

        $fpdf->Cell(10, 7, '', 0, 0);
        $fpdf->Cell(60, 7, '', 'LR', 0);
        $fpdf->Cell(60, 7, '', 'LR', 0);
        $fpdf->Cell(5, 7,'', 0, 0);
        $fpdf->Cell(56,7, '', 1, 1);

        $fpdf->Cell(10, 7, '', 0, 0);
        $fpdf->Cell(60, 7, '', 'LRT', 0);
        $fpdf->Cell(60, 7, '', 'LR', 0);
        $fpdf->Cell(5, 7,'', 0, 0);
        $fpdf->Cell(56, 7, '', 1, 1);

        $fpdf->Cell(10, 6, '', 0, 0);
        $fpdf->Cell(60, 6, 'M.E. JORGE CARLOS AZCORRA OSORIO', 'LRB', 0,'C');
        $fpdf->Cell(60, 6, '', 'LRB', 0);
        $fpdf->Cell(5, 6,'', 0, 0);
        $fpdf->Cell(56, 6, '', 1, 1);
        $fpdf->Image('img/SAT.png', 145, 92, -299);
        

        //encabezado
        $fpdf->setfont('arial','',4);
        $fpdf->Cell(192, 6, utf8_decode('NOTA: CARECE DE VALIDEZ COMO COMPROBANTE DE PAGO SI NO TIENE SELLO DE LA ESCUELA Y FIRMA DEL CAJERO EXENTO DE I.V.A. CONFORME AL ART. 15 FRACC. IV DE LA LEY DE IMPUESTO AL VALOR AGREGADO'), 0, 1,'C');

        $fpdf->Output();
        exit;

    }
}
