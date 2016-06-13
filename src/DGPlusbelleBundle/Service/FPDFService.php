<?php

namespace DGPlusbelleBundle\Service;

//include_once ('../Resources/jpgraph/src/jpgraph.php');
//include_once '../Resources/jpgraph/src/jpgraph_bar.php';
//include_once '../Resources/jpgraph/src/jpgraph_bar.php';

use DGPlusbelleBundle\Report\ReportePDF;


class FPDFService {
    
    private $pdf;
 
    public function __construct(ReportePDF $pdf)
    {
        $this->pdf = $pdf;
    }
    
    public function generarPdfPorRango($titulo, $encabezado, $anchoCol, $consulta, $sangria, $fechaInicio, $fechaFin)
    {
        
        $this->pdf->FPDF('P','mm','Letter');
	$this->pdf->SetTopMargin(20);
	$this->pdf->SetLeftMargin(20);
        
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Times','B',16);
        $this->pdf->Cell(180,32,$titulo, 0, 0, 'C');
        
        $this->pdf->SetFont('Times','B',13);
        $this->pdf->Ln(8);
        
        if ( $fechaInicio != null && $fechaFin != null){
            $fechaini = explode('-', $fechaInicio);
            $fechf = explode('-', $fechaFin);

            $this->pdf->Cell(180,32, 'Del periodo de '.$fechaini[2].'/'.$fechaini[1].'/'.$fechaini[0].' al '.$fechf[2].'/'.$fechf[1].'/'.$fechf[0], 0, 0, 'C');
        } else {
            $this->pdf->Cell(180,32, 'Del periodo de 01/01/2015 al 31/12/2015', 0, 0, 'C');
        }
        $this->pdf->Ln(30);
        $this->pdf->SetFont('Times','B',11);
        
        $this->pdf->Cell($sangria);
        $this->pdf->SetWidths($anchoCol);
        
	$this->pdf->Row($encabezado);
        $this->pdf->SetFont('Times','',11);
        
        foreach ($consulta as $fila) {
            $data = array();
            $cont = 0;
            $this->pdf->Cell($sangria);
            
           foreach ($fila as $valor) {
               $data[$cont] = $valor;
               $cont++;
            }
            
            $this->pdf->Row($data);
        }
        
        $this->pdf->Output();
        return $this->pdf;
    }
    
    public function generarPlantilla($urlLogo, $consulta, $medico){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        
        $logo = $urlLogo.'sonodigest.jpg';
        
        $this->pdf->FPDF('P','mm','Letter');
	$this->pdf->SetTopMargin(0);
	$this->pdf->SetLeftMargin(20);
        $this->pdf->SetAutoPageBreak(true, 6);
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        
        $this->pdf->Image($logo, 150, 5, 50, 20);
        $this->pdf->Line(20, 25.5, 200, 25.5);
        $this->pdf->Line(20, 26, 200, 26);
        
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Ln(26);
        
        $this->pdf->Cell(32,27,'Informacion general del paciente');
        $this->pdf->Line(20, 43, 200, 43);
        
        $this->pdf->Ln(15);
        $this->mostrarCelda($this->pdf, 32, 'Fecha: ', $consulta[0]->getConsulta()->getFechaConsulta()->format("d/m/Y"));
        $this->pdf->Ln(7);
        $this->mostrarCelda($this->pdf, 32, 'Nombre: ', $consulta[0]->getConsulta()->getPaciente()->getPersona()->getNombres().' '.$consulta[0]->getConsulta()->getPaciente()->getPersona()->getApellidos());
        
        if($consulta[0]->getConsulta()->getPaciente()->getFechaNacimiento()!=null){
           $fecha = $consulta[0]->getConsulta()->getPaciente()->getFechaNacimiento()->format("Y-m-d");    
           list($Y,$m,$d) = explode("-",$fecha);
        
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        }
        else{
        $edad="N/A";
        }
        
        
        
        $this->mostrarCelda($this->pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $this->pdf->Ln(7);
        $this->mostrarCelda($this->pdf, 32, 'Expediente No.: ', $consulta[0]->getConsulta()->getPaciente()->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $consulta[0]->getConsulta()->getPaciente()->getSexo();

        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
        $this->mostrarCelda($this->pdf, 13, 'Sexo: ', $sexo);
        
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Cell(32,27,'Resultado de consulta');
        $this->pdf->Line(20, 81, 200, 81);
        $this->pdf->Ln(18);
        $this->pdf->SetDrawColor(255,255,255);
        $this->pdf->SetWidths(array(55,126));
        $this->pdf->SetFont('Arial','',10);
        
        foreach ($consulta as $value) {
            $this->pdf->Row(array($value->getDetallePlantilla()->getNombre().': ',
                                  $value->getValorDetalle() 
                    ));
            
                    $this->pdf->Ln(4);
//            $pdf->SetX(25);
//            $pdf->SetFont('Arial','B',10);
//            $pdf->MultiCell(40, 5, $value->getDetallePlantilla()->getNombre().': ', 0, 'L', false);
//            $pdf->SetX(66.6);
//            $pdf->SetFont('Arial','',10);
//            $pdf->MultiCell(135, 5, $value->getValorDetalle(), 0, 'J', false);
           // $pdf->Ln(10);
            
        }
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $this->pdf->SetY(241);
        $this->pdf->SetX(20);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(85, 27, 'Colonia Escalon, Calle Cuscatlan, No. 448, San Salvador.');
        $this->pdf->Ln(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(85, 27, 'Entre la 83 Av. y 85 Av. Sur. Tel.: 25192857');
        
        $this->pdf->SetFont('Arial','',11);
        $this->pdf->SetY(235);
        $this->pdf->SetX(156);
        $this->pdf->Cell(88, 27, $medico['nombre']);
        
        $this->pdf->Ln(5);
        $this->pdf->SetX(160);
        $this->pdf->Cell(85, 27, $medico['cargo']);
        
        $this->pdf->Ln(5);
        $this->pdf->SetX(178);
        $this->pdf->Cell(85, 27, $medico['codigo']);
        
        $this->pdf->Output();
        
       // return $pdf;
    }
    
    public function mostrarCelda($pdf, $ancho, $encabezado, $data){
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell($ancho, 27, $encabezado);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(85, 27, $data);
    }
    
    
    
    public function generarTotalesPdfPorRango($titulo, $encabezado, $anchoCol, $consulta, $sangria, $fechaInicio, $fechaFin)
    {
        
        $this->pdf->FPDF('P','mm','Letter');
        $this->pdf->SetTopMargin(20);
        $this->pdf->SetLeftMargin(20);
        
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Times','B',16);
        $this->pdf->Cell(180,32,$titulo, 0, 0, 'C');
        
        $this->pdf->SetFont('Times','B',13);
        $this->pdf->Ln(8);
        
        if ( $fechaInicio != null && $fechaFin != null){
            $fechaini = explode('-', $fechaInicio);
            $fechf = explode('-', $fechaFin);

            $this->pdf->Cell(180,32, 'Del periodo de '.$fechaini[2].'/'.$fechaini[1].'/'.$fechaini[0].' al '.$fechf[2].'/'.$fechf[1].'/'.$fechf[0], 0, 0, 'C');
        } else {
            $this->pdf->Cell(180,32, 'Del periodo de 01/01/2015 al 31/12/2015', 0, 0, 'C');
        }
        $this->pdf->Ln(30);
        $this->pdf->SetFont('Times','B',11);
        
        $this->pdf->Cell($sangria);
        $this->pdf->SetWidths($anchoCol);
        
        //$this->pdf->Row($encabezado);
        $this->pdf->Cell(50,5,$encabezado['0'], 'LTRB', 0, 'L');
            
        $this->pdf->Cell(30,5,$encabezado['1'], 'LTRB', 0, 'R');
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Times','',11);
        $total=0;
        foreach ($consulta as $fila) {
            $data = array();
            $cont = 0;
            $this->pdf->Cell($sangria);
            
           foreach ($fila as $valor) {
               $data[$cont] = $valor;
               $cont++;
            }
            //var_dump($data['0']);
            //var_dump($this->pdf->Row($data));
            //$this->pdf->Row($data);
            $this->pdf->Cell(50,5,$data['0'], 'LTRB', 0, 'L');
            
            $this->pdf->Cell(30,5,$data['1'], 'LTRB', 0, 'R');
            $total = $total + $data['1'];
            $this->pdf->Ln(5);
        }
        $this->pdf->SetFont('Times','B',11);
        $this->pdf->Cell($sangria);
        $this->pdf->Cell(50,5,"Total", 'LTRB', 0, 'L');
            
        $this->pdf->Cell(30,5,  number_format($total,2,'.',''), 'LTRB', 0, 'R');
        
        $this->pdf->Output();
        return $this->pdf;
    }
    
    
    
    
    
    
    
    
    
    //Receta de los tratamientos hechos
    public function generarPlantilla2($urlLogo, $consulta, $medico,$otros){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        
        $logo = $urlLogo.'laplusbelle.jpg';
        $logo2 = $urlLogo.'sonodigest.jpg';
        
        $pdf->FPDF('P','mm','Letter');
        $pdf->SetTopMargin(0);
        $pdf->SetLeftMargin(20);
        $pdf->SetAutoPageBreak(true, 6);
        $pdf->AddPage();
        $pdf->SetFillColor(255);
        
        $pdf->SetFont('Arial','B',16);
//        $pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        $pdf->Cell(70);
//        $pdf->Cell(120,32,utf8_decode($consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre()));
        $pdf->Cell(120,32,utf8_decode('Receta médica'));      
        $pdf->Image($logo, 20, 5, 50, 20);
        $pdf->Image($logo2, 150, 5, 50, 20);
        $pdf->Line(20, 25.5, 200, 25.5);
        $pdf->Line(20, 26, 200, 26);
        
        
        $pdf->SetFont('Arial','',11);
        $pdf->SetY(20);
        $pdf->SetX(20);
        $pdf->Cell(88, 27, $medico['nombre']);
        
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->Cell(85, 27, $medico['cargo']);
        
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->Cell(85, 27, $medico['codigo']);
        
        
        
        $i=20;
        foreach($otros as $key => $otro){
            $pdf->SetY($i);
            $pdf->SetX(140);
            $pdf->Cell(20, 25, utf8_decode($otros[$key]));
            $i=$i+4;
        }
        $pdf->SetFont('Arial','B',13);
        $pdf->Ln(15);
        $pdf->Cell(20,20,utf8_decode('Información general del paciente'));
        
        
        
        

        
        $pdf->Ln(5);        
        
        //var_dump($consulta[0]->getSesionVentaTratamientoReceta()->getFechaSesion());
        
        //$this->mostrarCelda($pdf, 32, 'Fecha: ', $consulta[0]->getConsulta()->getFechaConsulta()->format("d/m/Y"));
        $this->mostrarCelda($pdf, 32, 'Fecha: ', $consulta[0]->getSesionVentaTratamientoReceta()->getFechaSesion()->format("d/m/Y"));
        $this->mostrarCelda($pdf, 32, 'Proxima cita: ','_______________');
        
        $pdf->Ln(7);
        $this->mostrarCelda($pdf, 32, 'Nombre: ', utf8_decode($consulta[0]->getSesionVentaTratamientoReceta()->getPersonaTratamiento()->getPaciente()->getNombres().' '.$consulta[0]->getSesionVentaTratamientoReceta()->getPersonaTratamiento()->getPaciente()->getApellidos()));
        
//        $fecha = $consulta[0]->getSesionVentaTratamientoReceta()->getFechaSesion()->format("Y-m-d");        
 	$fecha = $consulta[0]->getSesionVentaTratamientoReceta()->getPersonaTratamiento()->getPaciente()->getPaciente()[0]->getFechaNacimiento()->format("Y-m-d");  
        
        list($Y,$m,$d) = explode("-",$fecha);
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        
        $this->mostrarCelda($pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $pdf->Ln(7);
        //$this->mostrarCelda($pdf, 32, 'Expediente No.: ', $consulta[0]->getConsulta()->getPaciente()->getExpediente()[0]->getNumero());
        $this->mostrarCelda($pdf, 32, 'Expediente No.: ', $consulta[0]->getSesionVentaTratamientoReceta()->getPersonaTratamiento()->getPaciente()->getPaciente()[0]->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $consulta[0]->getSesionVentaTratamientoReceta()->getPersonaTratamiento()->getPaciente()->getPaciente()[0]->getSexo();
        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
        $this->mostrarCelda($pdf, 13, 'Sexo: ', $sexo);
        
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',13);
//        $pdf->Cell(32,27,'Resultado de consulta');
        $pdf->Cell(40, 27, $consulta[0]->getDetallePlantilla()->getNombre().': ', 0, 'L', false);
        $pdf->Line(20, 97, 200, 97);
        $pdf->Ln(18);
        foreach ($consulta as $value) {
            $pdf->SetX(25);
            $pdf->SetFont('Arial','B',10);
//            $pdf->MultiCell(40, 5, $value->getDetallePlantilla()->getNombre().': ', 0, 'L', false);
            $pdf->SetX(30);
            $pdf->SetFont('Arial','',10);
            $pdf->MultiCell(170, 5, $value->getValorDetalle(), 0, 'J', false);
            $this->pdf->Ln(10);
            
        }
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $pdf->SetY(241);
        $pdf->SetX(20);
         
        $pdf->Line(20, 244, 200, 244);
        $pdf->Line(20, 245, 200, 245);
        $pdf->SetY(241);
        $pdf->SetX(20);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(85, 20, 'Tel.: 2519-2857 , 7861-0599');
        $pdf->Ln(2);
        $pdf->Cell(55, 27, utf8_decode('Colonia Escalón, Calle Cuscatlan, No. 448, San Salvador.'));
        $pdf->Ln(5);
        $pdf->SetX(20);
        
        $pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
    
    
    
    
    public function generarConsultaReceta($urlLogo, $consulta, $medico, $otros){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        
        $logo = $urlLogo.'logo01.jpg';
        $logo2 = $urlLogo.'logo01.jpg';
        html_entity_decode("&aacute;");
        $pdf->FPDF('P','mm','Letter');
        $pdf->SetTopMargin(0);
        $pdf->SetLeftMargin(20);
        $pdf->SetAutoPageBreak(true, 6);
        $pdf->AddPage();
        $pdf->SetFillColor(255);
        
        $pdf->SetFont('Arial','B',24);
//        $pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        $pdf->Cell(120);
        //$pdf->Cell(120,32,utf8_decode($consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre()));
        $pdf->Cell(120,40,utf8_decode('Receta médica'));
        $pdf->SetFont('Arial','B',16);
        $pdf->Image($logo, 20, 10, 90);
//        $pdf->Image($logo2, 150, 5, 60);
        $pdf->Line(20, 25.5, 200, 25.5);
        $pdf->Line(20, 26, 200, 26);
        
        $pdf->Ln(10);
        
        
//        
//        $pdf->SetFont('Arial','',11);
//        $pdf->SetY(20);
//        $pdf->SetX(20);
//        $pdf->Cell(88, 27, utf8_decode($medico['nombre']));
//        
//        $pdf->Ln(5);
//        $pdf->SetX(20);
//        $pdf->Cell(85, 27, utf8_decode($medico['cargo']));
//        
//        $pdf->Ln(5);
//        $pdf->SetX(20);
//        $pdf->Cell(85, 27, utf8_decode($medico['codigo']));
        
        //var_dump($otros);
        $i=20;
        foreach($otros as $key => $otro){
            $pdf->SetY($i);
            $pdf->SetX(140);
            $pdf->Cell(20, 25, utf8_decode($otros[$key]));
            $i=$i+4;
        }
        
        
        
        
        
        
        
        $pdf->SetFont('Arial','B',13);
        $pdf->Ln(15);
        
        $pdf->Cell(20,20,utf8_decode('Información general del paciente'));
        //$pdf->Line(20, 47, 200, 47);
        
        $pdf->Ln(5);
        $this->mostrarCelda($pdf, 32, 'Fecha: ', $consulta[0]->getConsultaReceta()->getFechaConsulta()->format("d-m-Y"));
        $this->mostrarCelda($pdf, 32, 'Proxima cita: ','_______________');
        $pdf->Ln(7);
        $this->mostrarCelda($pdf, 32, 'Nombre: ', utf8_decode($consulta[0]->getConsultaReceta()->getPaciente()->getPersona()->getNombres().' '.$consulta[0]->getConsultaReceta()->getPaciente()->getPersona()->getApellidos()));
        
        if($consulta[0]->getConsultaReceta()->getPaciente()->getFechaNacimiento()!=null){
           $fecha = $consulta[0]->getConsultaReceta()->getPaciente()->getFechaNacimiento()->format("Y-m-d");        
           list($Y,$m,$d) = explode("-",$fecha);
        
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        }
        else{
          $edad="N/A";
        }
        
//        $this->mostrarCelda($pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $pdf->Ln(7);
//        $this->mostrarCelda($pdf, 32, 'Expediente No.: ', $consulta[0]->getConsultaReceta()->getPaciente()->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $consulta[0]->getConsultaReceta()->getPaciente()->getSexo();
        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
//        $this->mostrarCelda($pdf, 13, 'Sexo: ', $sexo);
        
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',13);
//        $pdf->Cell(32,27,'FX:');
//        $pdf->Cell(40, 27, $consulta[0]->getDetallePlantilla()->getNombre().': ', 0, 'L', false);
        $pdf->Line(20, 57, 200, 57);
        $pdf->Ln(5);
        foreach ($consulta as $value) {
            $pdf->SetX(15);
            $pdf->SetFont('Arial','B',10);
            
            $pdf->SetX(25);
            $pdf->SetFont('Arial','',10);
            $pdf->MultiCell(170, 5, $value->getValorDetalle(), 0, 'J', false);
            $this->pdf->Ln(10);
            
        }
        //$tam = count($consulta);
        
        
        //$espacio = 
        //$pdf->Ln(55);
        $pdf->Line(20, 244, 200, 244);
        $pdf->Line(20, 245, 200, 245);
        $pdf->SetY(241);
        $pdf->SetX(20);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(85, 20, 'Tel.: (503) 2264-3451 , (503) 2264-9961, Fax: (503) 2264-3451');
        $pdf->Ln(2);
        $pdf->Cell(55, 27, utf8_decode('Pasaje Verde #540 entre 7a. y 9a. calle poniente sobre 95 Av Norte'));
        $pdf->Ln(5);
        $pdf->SetX(20);
        
        
        
        
        $pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
    
    
    
    
    public function generarPaqueteReceta($urlLogo, $consulta, $medico,$paciente,$otros){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        
        $logo = $urlLogo.'laplusbelle.jpg';
        $logo2 = $urlLogo.'sonodigest.jpg';
        html_entity_decode("&aacute;");
        $pdf->FPDF('P','mm','Letter');
//        echo "sdcdsc";
	$pdf->SetTopMargin(0);
	$pdf->SetLeftMargin(20);
        $pdf->SetAutoPageBreak(true, 6);
        $pdf->AddPage();
        $pdf->SetFillColor(255);
        
        $pdf->SetFont('Arial','B',16);
//        $pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        $pdf->Cell(70);
//        var_dump($consulta[0]);
//        $pdf->Cell(120,32,utf8_decode($consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre()));
	$pdf->Cell(120,32,utf8_decode('Receta médica'));
        
        $pdf->Image($logo, 20, 5, 50, 20);
        $pdf->Image($logo2, 150, 5, 50, 20);
        $pdf->Line(20, 25.5, 200, 25.5);
        $pdf->Line(20, 26, 200, 26);
        
        
        
        $pdf->SetFont('Arial','',11);
        $pdf->SetY(20);
        $pdf->SetX(20);
        $pdf->Cell(88, 27, $medico['nombre']);
        
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->Cell(85, 27, $medico['cargo']);
        
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->Cell(85, 27, $medico['codigo']);
        
        
        $i=20;
        foreach($otros as $key => $otro){
            $pdf->SetY($i);
            $pdf->SetX(140);
            $pdf->Cell(20, 25, utf8_decode($otros[$key]));
            $i=$i+4;
        }
        
        $pdf->SetFont('Arial','B',13);
        $pdf->Ln(15);
        
        $pdf->Cell(20,20,utf8_decode('Información general del paciente'));
        //$pdf->Line(20, 48, 200, 48);
        
        $pdf->Ln(5);
        $this->mostrarCelda($pdf, 32, 'Fecha: ', $consulta[0]->getSesiontratamientoReceta()->getFechaSesion()->format("d/m/Y"));
	$this->mostrarCelda($pdf, 32, 'Proxima cita: ','_______________');
        $pdf->Ln(7);
        $this->mostrarCelda($pdf, 32, 'Nombre: ', utf8_decode($paciente[0]->getPersona()->getNombres().' '.$paciente[0]->getPersona()->getApellidos()));
        
        $fecha = $paciente[0]->getFechaNacimiento()->format("Y-m-d");        
        list($Y,$m,$d) = explode("-",$fecha);
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        
        $this->mostrarCelda($pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $pdf->Ln(7);
        $this->mostrarCelda($pdf, 32, 'Expediente No.: ', $paciente[0]->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $paciente[0]->getSexo();
        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
        $this->mostrarCelda($pdf, 13, 'Sexo: ', $sexo);
        
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',13);
//        $pdf->Cell(32,27,'FX:');
        $pdf->Cell(40, 27, $consulta[0]->getDetallePlantilla()->getNombre().': ', 0, 'L', false);
        $pdf->Line(20, 97, 200, 97);
        $pdf->Ln(18);
        foreach ($consulta as $value) {
            $pdf->SetX(25);
            $pdf->SetFont('Arial','B',10);
            
            $pdf->SetX(30);
            $pdf->SetFont('Arial','',10);
            $pdf->MultiCell(170, 5, $value->getValorDetalle(), 0, 'J', false);
            $this->pdf->Ln(10);
            
        }
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $pdf->Line(20, 244, 200, 244);
        $pdf->Line(20, 245, 200, 245);
        $pdf->SetY(241);
        $pdf->SetX(20);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(85, 20, 'Tel.: 2519-2857 , 7861-0599');
        $pdf->Ln(2);
        $pdf->Cell(55, 27, utf8_decode('Colonia Escalon, Calle Cuscatlan, No. 448, San Salvador.'));
        $pdf->Ln(5);
        $pdf->SetX(20);
        
        
        
        
        $pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
    public function generarPdfReferidoPorRango($titulo, $encabezado, $anchoCol, $consulta, $fechaInicio, $fechaFin)
    {
        
        $this->pdf->FPDF('P','mm','Letter');
	$this->pdf->SetTopMargin(30);
	$this->pdf->SetLeftMargin(20);
        
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Times','B',16);
        $this->pdf->Cell(180,32,$titulo, 0, 0, 'C');
        
        $this->pdf->SetFont('Times','B',13);
        $this->pdf->Ln(8);
        
        if ( $fechaInicio != null && $fechaFin != null){
            $fechaini = explode('-', $fechaInicio);
            $fechf = explode('-', $fechaFin);

            $this->pdf->Cell(180,32, 'Del periodo de '.$fechaini[2].'/'.$fechaini[1].'/'.$fechaini[0].' al '.$fechf[2].'/'.$fechf[1].'/'.$fechf[0], 0, 0, 'C');
        } else {
            $this->pdf->Cell(180,32, 'Del periodo de 01/01/2015 al 31/12/2015', 0, 0, 'C');
        }
        $this->pdf->Ln(30);
        $this->pdf->SetFont('Times','B',11);
        
        //$this->pdf->Cell($sangria);
        $this->pdf->SetWidths($anchoCol);
        
	$this->pdf->Row($encabezado);
        $this->pdf->SetFont('Times','',11);
        
        foreach ($consulta as $fila) {
            $data = array();
            $cont = 0;
            //$this->pdf->Cell($sangria);
            
           foreach ($fila as $valor) {
               $data[$cont] = $valor;
               $cont++;
            }
            
            $this->pdf->Row($data);
        }
        
        $this->pdf->Output();
        return $this->pdf;
    }
    
    
    
    
    
    
    
    public function generarrecetaTempPdf($titulo, $paciente, $plantilla, $consulta, $fecha, $urlLogo, $valores, $medico, $otros){
    //public function generarConsultaReceta($urlLogo, $consulta, $medico, $otros){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        //var_dump($urlLogo);
//        $logo = $urlLogo.'logo-01.png';
//        $logo2 = $urlLogo.'logo-01.png';
        $logo = $urlLogo.'logo01.jpg';
        $logo2 = $urlLogo.'logo01.jpg';
        html_entity_decode("&aacute;");
        $pdf->FPDF('P','mm','Letter');
        $pdf->SetTopMargin(0);
        $pdf->SetLeftMargin(20);
        $pdf->SetAutoPageBreak(true, 6);
        $pdf->AddPage();
        $pdf->SetFillColor(255);
        
        $pdf->SetFont('Arial','B',24);
//        $pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        $pdf->Cell(120);
        //$pdf->Cell(120,32,utf8_decode($consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre()));
        $pdf->Cell(120,40,utf8_decode('Receta médica'));
        $pdf->SetFont('Arial','B',16);
        $pdf->Image($logo, 20, 10, 90);
//        $pdf->Image($logo2, 150, 5, 60);
        $pdf->Line(20, 25.5, 200, 25.5);
        $pdf->Line(20, 26, 200, 26);
        
        $pdf->Ln(10);
        
//        $pdf->SetFont('Arial','',11);
//        $pdf->SetY(20);
//        $pdf->SetX(20);
//        $pdf->Cell(88, 27, utf8_decode($medico['nombre']));
//        
//        $pdf->Ln(5);
//        $pdf->SetX(20);
//        $pdf->Cell(85, 27, utf8_decode($medico['cargo']));
//        
//        $pdf->Ln(5);
//        $pdf->SetX(20);
//        $pdf->Cell(85, 27, utf8_decode($medico['codigo']));
//        
        //var_dump($otros);
        $i=20;
        foreach($otros as $key => $otro){
            $pdf->SetY($i);
            $pdf->SetX(140);
            $pdf->Cell(20, 25, utf8_decode($otros[$key]));
            $i=$i+4;
        }
        
        
        
        
        
        
        
        $pdf->SetFont('Arial','B',13);
        $pdf->Ln(15);
        
        $pdf->Cell(20,20,utf8_decode('Información general del paciente'));
        //$pdf->Line(20, 47, 200, 47);
        
        $pdf->Ln(5);
        $this->mostrarCelda($pdf, 32, 'Fecha: ', $fecha);
        $this->mostrarCelda($pdf, 32, 'Proxima cita: ','_______________');
        $pdf->Ln(7);
        //var_dump($paciente->getPersona()->getNombres());
        $this->mostrarCelda($pdf, 32, 'Nombre: ', utf8_decode($paciente->getPersona()->getNombres().' '.$paciente->getPersona()->getApellidos()));
        
//        if($paciente->getFechaNacimiento()!=null){
//		$fecha = $paciente->getFechaNacimiento()->format("Y-m-d");    
//		list($Y,$m,$d) = explode("-",$fecha);
//	        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;   
//	        $this->mostrarCelda($pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);             
//        }
//        else{
//		$fecha = 'Fecha de nacimiento no registrada ';
//		$this->mostrarCelda($pdf, 13, 'Edad: ', $fecha);
//        }
        
        $pdf->Ln(7);
//        $this->mostrarCelda($pdf, 32, 'Expediente No.: ', $paciente->getExpediente()[0]->getNumero());
//  	if($paciente->getExpediente()[0]!=null){
//        	$this->mostrarCelda($pdf, 32, 'Expediente No.: ', $paciente->getExpediente()[0]->getNumero());
//        }
//        else{
//        	$this->mostrarCelda($pdf, 32, 'Expediente No.: ', ' ');
//        }      
//        $sexoPaciente = $paciente->getSexo();
//        $sexo = '';
//
//        if($sexoPaciente == 'M'){
//            $sexo = 'Masculino';
//        }
//        if($sexoPaciente == 'F'){
//            $sexo = 'Femenino';
//        }
//        
//        $this->mostrarCelda($pdf, 13, 'Sexo: ', $sexo);
        
//        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(32,27,'');
//        $pdf->Cell(40, 27, $plantilla[0]->getPlantilla()->getNombre().': ', 0, 'L', false);
        $pdf->Line(20, 57, 200, 57);
        $pdf->Ln(15);
//        foreach ($consulta as $value) {
//            $pdf->SetX(25);
//            $pdf->SetFont('Arial','B',10);
//            
//            $pdf->SetX(30);
//            $pdf->SetFont('Arial','',10);
//            $pdf->MultiCell(170, 5, $value->getValorDetalle(), 0, 'J', false);
//            $this->pdf->Ln(10);
//            
//        }
        
        foreach ($plantilla as $key =>$value) {
            $pdf->SetX(25);
            $pdf->SetFont('Arial','B',10);
            //$pdf->SetY($break);
            //$break=$break-5;
            //$pdf->SetY($break);
            $pdf->SetFillColor(0,0,255);
            //$pdf->MultiCell(40, 4, $value->getNombre(), 0, 'L', true);
            
            $pdf->SetFont('Arial','',10);
            //$break=$break-1;
            //$pdf->SetY($break);
            //$pdf->SetX(66.6);
            //$pdf->MultiCell(135, 5, $valores[$key], 1, 'J', false);
            $pdf->SetFillColor(0,255,0);
            $pdf->MultiCell(170, 5, $valores[$key], 0, 'J', false) ;            //$break=$break+5;
            //$pdf->SetY($break);
            $this->pdf->Ln(10);
            
            
            
            //$break=$break+10;
            //$pdf->SetY($break);
        }
        //$tam = count($consulta);
        
        
        //$espacio = 
        //$pdf->Ln(55);
        $pdf->Line(20, 244, 200, 244);
        $pdf->Line(20, 245, 200, 245);
        $pdf->SetY(241);
        $pdf->SetX(20);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(85, 20, 'Tel.: (503) 2264-3451 , (503) 2264-9961, Fax: (503) 2264-3451');
        $pdf->Ln(2);
        $pdf->Cell(55, 27, utf8_decode('Pasaje Verde #540 entre 7a. y 9a. calle poniente sobre 95 Av Norte'));
        $pdf->Ln(5);
        $pdf->SetX(20);
        
        
        
        
        $pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
    
    
    
    
    public function generarplantillaTempPdf($titulo, $paciente, $plantilla, $consulta, $fecha, $urlLogo, $valores) {
        
        
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        
        $logo = $urlLogo.'sonodigest.jpg';
        //var_dump($logo);
        $this->pdf->FPDF('P','mm','Letter');
	$this->pdf->SetTopMargin(0);
	$this->pdf->SetLeftMargin(20);
        $this->pdf->SetAutoPageBreak(true, 6);
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        //var_dump($plantilla[0]->getPlantilla());
        $this->pdf->SetFont('Arial','B',16);
        $pdf->Cell(120,32,$plantilla[0]->getPlantilla()->getNombre());
        
        $this->pdf->Image($logo, 150, 5, 50, 20);
        $this->pdf->Line(20, 25.5, 200, 25.5);
        $this->pdf->Line(20, 26, 200, 26);
        
        $this->pdf->SetFont('Arial','B',13);
        $break=0;
        $this->pdf->Ln(26);
        $break=$break+26;
        $this->pdf->Cell(32,27,'Informacion general del paciente');
        $this->pdf->Line(20, 43, 200, 43);
        
        $this->pdf->Ln(15);
        $break=$break+15;
        $this->mostrarCelda($this->pdf, 32, 'Fecha: ', $fecha);
        $this->pdf->Ln(7);
        $break=$break+7;
        $this->mostrarCelda($this->pdf, 32, 'Nombre: ', $paciente->getPersona()->getNombres().' '.$paciente->getPersona()->getApellidos());
//        var_dump($paciente->getFechaNacimiento());
        if($paciente->getFechaNacimiento()!=null){
		$fecha = $paciente->getFechaNacimiento()->format("Y-m-d");    
		list($Y,$m,$d) = explode("-",$fecha);
	        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;   
	        $this->mostrarCelda($this->pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);             
        }
        else{
		$fecha = 'La fecha no registrada';
		$this->mostrarCelda($this->pdf, 13, 'Edad: ', $fecha);
        }
        

        $this->pdf->Ln(7);
        $break=$break+7;
        
//        var_dump($paciente->getExpediente()[0]);
        if($paciente->getExpediente()[0]!=null){
        	$this->mostrarCelda($this->pdf, 32, 'Expediente No.: ', $paciente->getExpediente()[0]->getNumero());
        }
        else{
        	$this->mostrarCelda($this->pdf, 32, 'Expediente No.: ', ' ');
        }
        
        
        
        $sexoPaciente = $paciente->getSexo();
        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
        
        $this->mostrarCelda($this->pdf, 13, 'Sexo: ', $sexo);
        
        $this->pdf->Ln(10);
        $break=$break+10;
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Cell(32,27,'Resultado de consulta');
        $this->pdf->Line(20, 81, 200, 81);
        $this->pdf->Ln(18);
        $break=$break+18;
        
        $this->pdf->SetDrawColor(255,255,255);
        $this->pdf->SetWidths(array(55,126));
        $this->pdf->SetFont('Arial','',10);
        
        foreach ($plantilla as $key =>$value) {
            $this->pdf->Row(array($value->getNombre(),
                                  $valores[$key] 
                    ));
            
                    $this->pdf->Ln(4);
//            $pdf->SetX(25);
//            $pdf->SetFont('Arial','B',10);
//            $pdf->MultiCell(40, 5, $value->getNombre().': ', 0, 'L', false);
//            $pdf->SetX(66.6);
//            $pdf->SetFont('Arial','',10);
//            $pdf->MultiCell(135, 5, $value->getValorDetalle(), 0, 'J', false);
           // $pdf->Ln(10);
            
        }        
        
//        foreach ($plantilla as $key =>$value) {
            
            
//            $pdf->SetX(25);
//            $pdf->SetFont('Arial','B',10);
            //$pdf->SetY($break);
            //$break=$break-5;
            //$pdf->SetY($break);
//            $pdf->SetFillColor(0,0,255);
//            $pdf->MultiCell(40, 4, $value->getNombre(), 0, 'L', false);
            
//            $pdf->SetFont('Arial','',10);
            //$break=$break-1;
            //$pdf->SetY($break);
//            $pdf->SetX(66.6);
            //$pdf->MultiCell(135, 5, $valores[$key], 1, 'J', false);
//            $pdf->SetFillColor(0,255,0);
//            $pdf->MultiCell(105, 5, $valores[$key], 0, 'J', false);
            //$break=$break+5;
            //$pdf->SetY($break);
//            $this->pdf->Ln(10);
            
            
            
            //$break=$break+10;
            //$pdf->SetY($break);
//        }
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $this->pdf->SetY(241);
        $this->pdf->SetX(20);
        $this->pdf->SetFont('Arial','',9);
         $this->pdf->Cell(85, 27, 'Colonia Escalon, Calle Cuscatlan, No. 448, San Salvador.');
        $this->pdf->Ln(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(85, 27, 'Entre la 83 Av. y 85 Av. Sur. Tel.: 25192857');
        
        $this->pdf->SetFont('Arial','',11);
        $this->pdf->SetY(235);
        $this->pdf->SetX(156);
        $this->pdf->Cell(88, 27, $medico['nombre']);
        
        $this->pdf->Ln(5);
        $this->pdf->SetX(160);
        $this->pdf->Cell(85, 27, $medico['cargo']);
        
        $this->pdf->Ln(5);
        $this->pdf->SetX(178);
        $this->pdf->Cell(85, 27, $medico['codigo']);
        
       // $pdf->Output();
        
        
        
        
        
        $this->pdf->Output();
        return $this->pdf;
    }
    
    
    
    
    public function generarConsultaPDF($urlLogo, $consulta, $medico){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        $jump=0;
        $logo = $urlLogo.'logo01.jpg';
        
        $this->pdf->FPDF('P','mm','Letter');
        $this->pdf->SetTopMargin(0);
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetAutoPageBreak(true, 6);
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Arial','B',16);
        
        $this->pdf->SetX(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(120,42,"Detalle de consulta");
        //$this->pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        
        $this->pdf->Image($logo, 150, 5, 50, 20);
        $this->pdf->Line(20, 25.5, 200, 25.5);
        $this->pdf->Line(20, 26, 200, 26);
        
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Ln(26);
        $jump=$jump+26;
        
        $this->pdf->Cell(32,27,'Informacion general del paciente');
        $this->pdf->Line(20, 43, 200, 43);
        
        $this->pdf->Ln(15);
        $jump=$jump+15;
        $this->mostrarCelda($this->pdf, 32, 'Fecha: ', $consulta[0]->getFechaConsulta()->format("d/m/Y"));
        $this->pdf->Ln(7);
        $jump=$jump+7;
        $this->mostrarCelda($this->pdf, 32, 'Nombre: ', utf8_decode($consulta[0]->getPaciente()->getPersona()->getNombres().' '.$consulta[0]->getPaciente()->getPersona()->getApellidos()));
        
        if($consulta[0]->getPaciente()->getFechaNacimiento()!=null){
           $fecha = $consulta[0]->getPaciente()->getFechaNacimiento()->format("Y-m-d");    
           list($Y,$m,$d) = explode("-",$fecha);
        
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        }
        else{
            $edad="N/A";
        }
        
        
        
        
        $this->mostrarCelda($this->pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $this->pdf->Ln(7);
        $jump=$jump+7;
        $this->mostrarCelda($this->pdf, 32, 'Expediente No.: ', $consulta[0]->getPaciente()->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $consulta[0]->getPaciente()->getSexo();

        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
        $this->mostrarCelda($this->pdf, 13, 'Sexo: ', $sexo);
        
        $this->pdf->Ln(10);
        $jump=$jump+10;
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Cell(32,27,'Interrogatorio de consulta');
        $this->pdf->Line(20, 81, 200, 81);
        $this->pdf->Ln(18);
        $jump=$jump+18;
        $this->pdf->SetDrawColor(255,255,255);
        $this->pdf->SetWidths(array(55,126));
        
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->Row(array("Motivo consulta: ",utf8_decode($consulta[0]->getObservacion()))) ;
        $jump=$jump+5;
        $this->pdf->Ln(1);
        $this->pdf->Row(array("Sintomas: ",utf8_decode($consulta[0]->getSintomas()))) ;
        
        $this->pdf->Ln(5);
        
        $this->pdf->SetDrawColor(255,255,255);
        
        $this->pdf->SetFont('Arial','B',13);
        //$this->pdf->Cell(32,27,utf8_decode('Exploración física'));
        $this->pdf->SetWidths(array(180));
        $this->pdf->Row(array("Exploración física"));
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetWidths(array(185));
        
//        $this->pdf->Ln(-4);
        $this->pdf->Row(array("___________________________________________________________________________________________"));
        //$this->pdf->Line(20, $jump, 200, $jump);
        $this->pdf->Ln(2);
        
        $this->pdf->SetWidths(array(40,50,40,50));
        
        $this->pdf->SetFont('Arial','',10);
        
        
        
        $this->pdf->Row(array("Peso: ",$consulta[0]->getPeso()." Kg.","Talla: ",$consulta[0]->getTalla()." cm."));
        $this->pdf->Row(array("Presión arterial: ",$consulta[0]->getPresionArterialSistolica()."/".$consulta[0]->getPresionArterialDiastolica()." mmHg","Frecuencia cardíaca: ",$consulta[0]->getFrecCardiaca()." x minuto"));
        $this->pdf->Row(array("Frecuencia respiratoria: ",$consulta[0]->getFrecRespiratoria()." x minuto","Temperatura: ",$consulta[0]->getTemperatura()." °C"));
        
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->SetWidths(array(180));
        $this->pdf->Row(array("Vacunas aplicadas"));
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetWidths(array(185));
               
        $this->pdf->Row(array("___________________________________________________________________________________________"));
        //$this->pdf->Line(20, $jump, 200, $jump);
        $this->pdf->Ln(2);
        
        $this->pdf->SetWidths(array(40,50,40,50));  
        $this->pdf->SetFont('Arial','',10);
        //var_dump(count($consulta[0]->getPlacas()));
        //if(count($consulta[0]->getPlacas())!=0){
            foreach ($consulta[0]->getPlacas() as $value) {
                if($value->getProducto()!=null && count($value->getProducto()->getNombre())) {
                    $this->pdf->Row(array($value->getProducto()->getNombre(),""));
                }
                
            }
        //}
//        else{
//            $this->pdf->SetWidths(array(185));
//            $this->pdf->SetFont('Arial','',10);
//            $this->pdf->Row(array("No se aplicaron vacunas"));
//        }
            
        
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $this->pdf->SetY(241);
        $this->pdf->SetX(20);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(85, 27, 'Colonia Escalon, Calle Cuscatlan, No. 448, San Salvador.');
        $this->pdf->Ln(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(85, 27, 'Entre la 83 Av. y 85 Av. Sur. Tel.: 25192857');
        
        $this->pdf->SetFont('Arial','',11);
        $this->pdf->SetY(235);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['nombre']));
        
        $this->pdf->Ln(5);
        $this->pdf->SetY(240);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['cargo']));
        
        $this->pdf->Ln(5);
        $this->pdf->SetY(244);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['codigo']));
        
        $this->pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function generarIncapacidadPDF($urlLogo, $consulta, $medico){
        $pdf  = new \FPDF_FPDF();
        $pdi  = new \FPDF_FPDI();
        
        $jump=0;
        $logo = $urlLogo.'logo01.jpg';
        
        $this->pdf->FPDF('P','mm','Letter');
        $this->pdf->SetTopMargin(0);
        $this->pdf->SetLeftMargin(20);
        $this->pdf->SetAutoPageBreak(true, 6);
        $this->pdf->AddPage();
        $this->pdf->SetFillColor(255);
        
        $this->pdf->SetFont('Arial','B',16);
        
        $this->pdf->SetX(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(120,42,utf8_decode("Incapacidad médica"));
        //$this->pdf->Cell(120,32,$consulta[0]->getDetallePlantilla()->getPlantilla()->getNombre());
        
//          $this->pdf->Image($logo, 150, 5, 50, 20);
        $pdf->Image($logo, 20, 10, 90);
        $this->pdf->Line(20, 25.5, 200, 25.5);
        $this->pdf->Line(20, 26, 200, 26);
        
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Ln(26);
        $jump=$jump+26;
        
        $this->pdf->Cell(32,27,utf8_decode('Información general del paciente'));
        $this->pdf->Line(20, 43, 200, 43);
        
        $this->pdf->Ln(15);
        $jump=$jump+15;
        $this->mostrarCelda($this->pdf, 32, 'Fecha incial: ', $consulta[0]->getFechaInicial()->format("d/m/Y"));
        $this->mostrarCelda($this->pdf, 32, 'Fecha final: ', $consulta[0]->getFechaFinal()->format("d/m/Y"));
        $this->pdf->Ln(7);
        $jump=$jump+7;
        $this->mostrarCelda($this->pdf, 32, 'Nombre: ', utf8_decode($consulta[0]->getPaciente()->getPersona()->getNombres().' '.$consulta[0]->getPaciente()->getPersona()->getApellidos()));
        
        if($consulta[0]->getPaciente()->getFechaNacimiento()!=null){
           $fecha = $consulta[0]->getPaciente()->getFechaNacimiento()->format("Y-m-d");    
           list($Y,$m,$d) = explode("-",$fecha);
        
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;    
        }
        else{
            $edad="N/A";
        }
        
        
        
        
//        $this->mostrarCelda($this->pdf, 13, 'Edad: ', $edad /*.' '. htmlentities('Años', ENT_QUOTES,'UTF-8')*/);
        
        $this->pdf->Ln(7);
        $jump=$jump+7;
//        $this->mostrarCelda($this->pdf, 32, 'Expediente No.: ', $consulta[0]->getPaciente()->getExpediente()[0]->getNumero());
        
        $sexoPaciente = $consulta[0]->getPaciente()->getSexo();

        $sexo = '';
        if($sexoPaciente == 'M'){
            $sexo = 'Masculino';
        }
        if($sexoPaciente == 'F'){
            $sexo = 'Femenino';
        }
        
//        $this->mostrarCelda($this->pdf, 13, 'Sexo: ', $sexo);
        
        $this->pdf->Ln(10);
        $jump=$jump+10;
        $this->pdf->SetFont('Arial','B',13);
        $this->pdf->Cell(32,27,'Detalle de incapacidad');
        $this->pdf->Line(20, 81, 200, 81);
        $this->pdf->Ln(18);
        $jump=$jump+18;
        $this->pdf->SetDrawColor(255,255,255);
        $this->pdf->SetWidths(array(185));
        
        $this->pdf->SetFont('Arial','',10);
//        $this->pdf->Row(array("Motivo consulta: ",utf8_decode($consulta[0]->getObservacion()))) ;
        $jump=$jump+5;
        $this->pdf->Ln(1);
//        $this->pdf->Row(array("Sintomas: ",utf8_decode($consulta[0]->getSintomas()))) ;
        
        $this->pdf->Ln(5);
        
        $this->pdf->SetDrawColor(255,255,255);
        
        $this->pdf->SetFont('Arial','B',13);
        
        
        //$this->pdf->Line(20, $jump, 200, $jump);
        $this->pdf->Ln(2);
        
        
        
        $this->pdf->SetFont('Arial','',10);
        
        
        
        $this->pdf->SetWidths(array(190,50,40,50));  
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->Row(array(utf8_decode($consulta[0]->getNotas()))) ;
        //var_dump(count($consulta[0]->getPlacas()));
        //if(count($consulta[0]->getPlacas())!=0){

        //}
//        else{
//            $this->pdf->SetWidths(array(185));
//            $this->pdf->SetFont('Arial','',10);
//            $this->pdf->Row(array("No se aplicaron vacunas"));
//        }
            
        
        //$tam = count($consulta);
        
        //$espacio = 
        //$pdf->Ln(55);
        $fecha = "";
        
//        echo date('N');
        switch(intval(date('N'))){
            case 1:
                $fecha = "lunes ";
                break;
            case 2:
                $fecha = "martes ";
                break;
            case 3:
                $fecha = "miércoles ";
                break;
            case 4:
                $fecha = "jueves ";
                break;
            case 5:
                $fecha = "viernes ";
                break;
            case 6:
                $fecha = "sábado ";
                break;
            case 7:
                $fecha = " domingo ";
                break;
        }
        
        $fecha .= date('m');
        
        switch(intval(date('m'))){
            case 1:
                $fecha .= " Enero";
                break;
            case 2:
                $fecha .= " Febrero";
                break;
            case 3:
                $fecha .= " Marzo";
                break;
            case 4:
                $fecha .= " Abril";
                break;
            case 5:
                $fecha .= " Mayo";
                break;
            case 6:
                $fecha .= " Junio";
                break;
            case 7:
                $fecha .= " Julio";
                break;
            case 8:
                $fecha .= " Agosto";
                break;
            case 9:
                $fecha .= " Septiembre";
                break;
            case 10:
                $fecha .= " Octubre";
                break;
            case 11:
                $fecha .= " Noviembre";
                break;
            case 12:
                $fecha .= " Diciembre";
                break;
            
        }
        $fecha .= " de ".date("Y").".";
        date_default_timezone_set('America/El_Salvador');
        setlocale(LC_ALL,"esm");
        $this->pdf->Cell(85, 27, utf8_decode('Y para los usos que la interesada estime convenientes se extiende la presente el día '.$fecha ));
        $this->pdf->SetY(241);
        $this->pdf->SetX(20);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(85, 27, 'Colonia Escalon, Calle Cuscatlan, No. 448, San Salvador.');
        $this->pdf->Ln(5);
        $this->pdf->SetX(20);
        $this->pdf->Cell(85, 27, 'Entre la 83 Av. y 85 Av. Sur. Tel.: 25192857');
        
        $this->pdf->SetFont('Arial','',11);
        $this->pdf->SetY(235);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['nombre']));
        
        $this->pdf->Ln(5);
        $this->pdf->SetY(240);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['cargo']));
        
        $this->pdf->Ln(5);
        $this->pdf->SetY(244);
        $this->pdf->SetX(156);
        $this->pdf->Cell(85, 27, utf8_decode($medico['codigo']));
        
        $this->pdf->Output();
        
       // return $pdf;
    }
    
    
    
    
    
}


