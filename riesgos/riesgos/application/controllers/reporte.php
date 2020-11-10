<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model('calificacion_model');
    $this->load->model('proceso_model');
    $this->load->model('nivel_exposicion_proceso_model');
  }


  public function index($año){
    $this->load->view('layout/header');
    $data['titulo'] = "Generación de reportes";
    $this->load->view('layout/menu', $data);
    $data['procesos'] = $this->proceso_model->getAllProcesosConNivelDeExposicion($año);
    $data['años'] = $this->nivel_exposicion_proceso_model->getAñosConCalificaciones();
    //$data['procesos'] = $this->proceso_model->getAllProceso();
    $data['año'] = $año;
    $this->load->view('reporte/index', $data);
    $this->load->view('layout/footer');
  }


  public function detalle_proceso($id_proceso, $año){


      $this->load->view('layout/header');
      $proceso = $this->proceso_model->getProceso($id_proceso);

      //Preguntar si tiene RIESGO
      $data['tiene_impacto'] = $this->proceso_model->haveCalificacion($id_proceso, 1, $año);
      if ($data['tiene_impacto'] > 0) {
        $id_calificacion = $this->calificacion_model->getIdCalificacion($id_proceso, 1, $año);
        $data['detalle_impacto']  = $this->calificacion_model->getDetalleCalificacion($id_calificacion);
        $data['total_impacto']  = $this->calificacion_model->getCalificacionTotal($id_calificacion);
        $data['calificacion_impacto']  = $this->calificacion_model->getCalificacion($id_calificacion);
        $data['rango_impacto']  = $this->calificacion_model->calcularImpactoRango($data['total_impacto'][0]['total']);
      }

      //Probabilidad
      $data['tiene_probabilidad'] = $this->proceso_model->haveCalificacion($id_proceso, 2, $año);
      if ($data['tiene_probabilidad'] > 0) {
        $id_calificacion = $this->calificacion_model->getIdCalificacion($id_proceso, 2, $año);
        $data['detalle_probabilidad']  = $this->calificacion_model->getDetalleCalificacion($id_calificacion);
        $data['total_probabilidad']  = $this->calificacion_model->getCalificacionTotal($id_calificacion);
        $data['rango_probabilidad']  = $this->calificacion_model->calcularProbabilidadRango($data['total_probabilidad'][0]['total']);
      }

    $this->load->library('pdf');
    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->AliasNbPages();

    $this->pdf->SetTitle("Detalle de Bien");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->SetFillColor(92,107,192);
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'B', 9);
    //$this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
    $this->pdf->Cell(180,7,utf8_decode('Datos de Analisis de Riesgos - Año: ' . $año ),0,0,'C','1');
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);

    $this->pdf->Cell(45,7,utf8_decode("Proceso:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($proceso['nombre']),'B',0,'L',0);
    $this->pdf->Cell(45,7,utf8_decode("Responsable:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($proceso['responsable']),'B',0,'L',0);
    $this->pdf->Ln(7);
    $this->pdf->Cell(45,7,utf8_decode("Objetivo:"),'B',0,'R',0);
    $this->pdf->Cell(135,7,utf8_decode($proceso['objetivo']),'B',0,'L',0);
    $this->pdf->Ln(7);
    $this->pdf->Ln(7);

    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Cell(180,7,utf8_decode("Análisis de Impacto"),'0',0,'C',1);
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);
    $this->pdf->Cell(135,7,utf8_decode("Descripcion"),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Valor"),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Pond."),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Subtotal"),'B',0,'L',0);
    $this->pdf->Ln(7);

    foreach ($data['detalle_impacto'] as $detalle){
      $this->pdf->Cell(135,7,utf8_decode($detalle['descripcion']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['valor']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['ponderacion']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['subtotal']),'B',0,'L',0);
      //Se agrega un salto de linea
      $this->pdf->Ln(7);
    }


    $this->pdf->Cell(45,7,utf8_decode("Total:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($data['total_impacto'][0]['total'] ),'B',0,'L',0);
    $this->pdf->Cell(45,7,utf8_decode("Rango en ME:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($data['rango_impacto']),'B',0,'L',0);
    $this->pdf->Ln(7);


    $this->pdf->Ln(7);

    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Cell(180,7,utf8_decode("Análisis de Probabilidad"),'0',0,'C',1);
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);
    $this->pdf->Cell(135,7,utf8_decode("Descripcion"),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Valor"),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Pond."),'B',0,'L',0);
    $this->pdf->Cell(15,7,utf8_decode("Subtotal"),'B',0,'L',0);
    $this->pdf->Ln(7);

    foreach ($data['detalle_probabilidad'] as $detalle){
      $this->pdf->Cell(135,7,utf8_decode($detalle['descripcion']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['valor']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['ponderacion']),'B',0,'L',0);
      $this->pdf->Cell(15,7,utf8_decode($detalle['subtotal']),'B',0,'L',0);
      $this->pdf->Ln(7);
    }

    $this->pdf->Cell(45,7,utf8_decode("Total:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($data['total_probabilidad'][0]['total'] ),'B',0,'L',0);
    $this->pdf->Cell(45,7,utf8_decode("Rango en ME:"),'B',0,'R',0);
    $this->pdf->Cell(45,7,utf8_decode($data['rango_probabilidad']),'B',0,'L',0);
    $this->pdf->Ln(7);$this->pdf->Ln(7);

    $equis = "";

    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Cell(180,7,utf8_decode("Matriz de Exposición"),'0',0,'C',1);
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);

    $this->pdf->Cell(36,7,utf8_decode(""),'B',0,'C',0);
    $this->pdf->Cell(144,7,utf8_decode("Impacto"),'B',0,'C',0);
    $this->pdf->Ln(7);
    $this->pdf->Cell(36,7,utf8_decode("Probabilidad "),'B',0,'C',0);
    $this->pdf->Cell(36,7,utf8_decode("1"),'B',0,'C',0);
    $this->pdf->Cell(36,7,utf8_decode("2"),'B',0,'C',0);
    $this->pdf->Cell(36,7,utf8_decode("3"),'B',0,'C',0);
    $this->pdf->Cell(36,7,utf8_decode("4"),'B',0,'C',0);
    $this->pdf->Ln(7);



    $this->pdf->Cell(36,7,utf8_decode("4"),'B',0,'C',0);
    $this->pdf->SetFillColor(241,196,15);
    if ( $data['rango_impacto'] == 1 &&  $data['rango_probabilidad'] == 4){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode($equis),'B',0,'C',1); $equis = "";
    $this->pdf->SetFillColor(230,126,34);
    if ( $data['rango_impacto'] == 2 &&  $data['rango_probabilidad'] == 4){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode($equis),'B',0,'C',1); $equis = "";
    $this->pdf->SetFillColor(231,76,60);
    if ( $data['rango_impacto'] == 3 &&  $data['rango_probabilidad'] == 4){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode($equis),'B',0,'C',1); $equis = "";
    $this->pdf->SetFillColor(231,76,60);
    if ( $data['rango_impacto'] == 4 &&  $data['rango_probabilidad'] == 4){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode($equis),'B',0,'C',1); $equis = "";
    $this->pdf->Ln(7);


    $this->pdf->Cell(36,7,utf8_decode("3"),'B',0,'C',0);
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 1 &&  $data['rango_probabilidad'] == 3){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(241,196,15);
    if ( $data['rango_impacto'] == 2 &&  $data['rango_probabilidad'] == 3){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(230,126,34);
    if ( $data['rango_impacto'] == 3 &&  $data['rango_probabilidad'] == 3){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(231,76,60);
    if ( $data['rango_impacto'] == 4 &&  $data['rango_probabilidad'] == 3){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->Ln(7);

    $this->pdf->Cell(36,7,utf8_decode("2"),'B',0,'C',0);
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 1 &&  $data['rango_probabilidad'] == 2){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 2 &&  $data['rango_probabilidad'] == 2){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(241,196,15);
    if ( $data['rango_impacto'] == 3 &&  $data['rango_probabilidad'] == 2){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(230,126,34);
    if ( $data['rango_impacto'] == 4 &&  $data['rango_probabilidad'] == 2){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->Ln(7);



    $this->pdf->Cell(36,7,utf8_decode("1"),'B',0,'C',0);
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 1 &&  $data['rango_probabilidad'] == 1){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 2 &&  $data['rango_probabilidad'] == 1){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(39,174,96);
    if ( $data['rango_impacto'] == 3 &&  $data['rango_probabilidad'] == 1){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->SetFillColor(241,196,15);
    if ( $data['rango_impacto'] == 4 &&  $data['rango_probabilidad'] == 1){$equis = "Este proceso"; }
    $this->pdf->Cell(36,7,utf8_decode("$equis"),'B',0,'C',1);$equis = "";
    $this->pdf->Ln(7);$this->pdf->Ln(5);


    $this->pdf->Cell(36,5,utf8_decode("Referencias:"),'0',0,'L',0);$this->pdf->Ln(7);
    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo poco significativo"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(241,196,15);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo medio"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(230,126,34);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo considerable"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(231,76,60);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo significativo"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->Output("Detalle de proceso.pdf", 'I');
  }


  public function matriz_exposicion($año){

    $procesos = $this->proceso_model->getAllProcesosConNivelDeExposicion($año);

    $this->load->library('pdf');
    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->AliasNbPages();

    $this->pdf->SetTitle(utf8_decode("Matriz de Exposición"));
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->SetFillColor(92,107,192);
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'B', 9);
    //$this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
    $this->pdf->Cell(180,7,utf8_decode('Datos de Analisis de Riesgos - Año: ' . $año . ' - Matriz de Exposición' ),0,0,'C','1');
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);

    $equis = "";

    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Ln(7);
    $this->pdf->SetTextColor(1,1,1);

    $respuesta = $this->proceso_model->getMaximoNumeroDeProcesosEnCelda($año);

    $maximo = $respuesta[0]['maximo'];
    $alto = 7 * $maximo;
    $divisor = 1;

    $this->pdf->Cell(16,7,utf8_decode(""),'B',0,'C',0);
    $this->pdf->Cell(164,7,utf8_decode("Impacto"),'1',0,'C',0);
    $this->pdf->Ln(7);
    $this->pdf->Cell(16,7,utf8_decode("Prob."),'1',0,'C',0);
    $this->pdf->Cell(41,7,utf8_decode("1"),'1',0,'C',0);
    $this->pdf->Cell(41,7,utf8_decode("2"),'1',0,'C',0);
    $this->pdf->Cell(41,7,utf8_decode("3"),'1',0,'C',0);
    $this->pdf->Cell(41,7,utf8_decode("4"),'1',0,'C',0);
    $this->pdf->Ln(7);


    //Primera Fila//////////////////////////////////////////////////////////////
    $this->pdf->Cell(16,$alto,utf8_decode("4"),'1',0,'C',0);

    $this->pdf->SetFillColor(241,196,15);
    $respuesta = $this->calcular_contenido($procesos, 1, 4);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetY(53);
    $this->pdf->SetX(72);
    $this->pdf->SetFillColor(230,126,34);
    $respuesta = $this->calcular_contenido($procesos, 2, 4);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(231,76,60);
    $this->pdf->SetY(53);
    $this->pdf->SetX(72+41);
    $respuesta = $this->calcular_contenido($procesos, 3, 4);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetY(53);
    $this->pdf->SetX(72+82);
    $this->pdf->SetFillColor(231,76,60);
    $respuesta = $this->calcular_contenido($procesos, 4, 4);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    ////////////////////////////////////////////////////////////////////////////

    $this->pdf->Cell(16,$alto,utf8_decode("3"),'1',0,'C',0);

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto);
    $this->pdf->SetX(72-41);
    $respuesta = $this->calcular_contenido($procesos, 1, 3);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(241,196,15);
    $this->pdf->SetY(53+$alto);
    $this->pdf->SetX(72);
    $respuesta = $this->calcular_contenido($procesos, 2, 3);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(230,126,34);
    $this->pdf->SetY(53+$alto);
    $this->pdf->SetX(72+41);
    $respuesta = $this->calcular_contenido($procesos, 3, 3);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(231,76,60);
    $this->pdf->SetY(53+$alto);
    $this->pdf->SetX(72+41+41);
    $respuesta = $this->calcular_contenido($procesos,4, 3);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    ///////////////////////////////////////////////////////////////////////////
    $this->pdf->Cell(16,$alto,utf8_decode("2"),'1',0,'C',0);

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto+$alto);
    $this->pdf->SetX(72-41);
    $respuesta = $this->calcular_contenido($procesos, 1, 2);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto+$alto);
    $this->pdf->SetX(72);
    $respuesta = $this->calcular_contenido($procesos, 2, 2);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(241,196,15);
    $this->pdf->SetY(53+$alto+$alto);
    $this->pdf->SetX(72+41);
    $respuesta = $this->calcular_contenido($procesos, 3, 2);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(230,126,34);
    $this->pdf->SetY(53+$alto+$alto);
    $this->pdf->SetX(72+41+41);
    $respuesta = $this->calcular_contenido($procesos, 4, 2);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    ////////////////////////////////////////////////////////////////////////////
    $this->pdf->Cell(16,$alto,utf8_decode("1"),'1',0,'C',0);

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto+$alto+$alto);
    $this->pdf->SetX(72-41);
    $respuesta = $this->calcular_contenido($procesos, 1, 1);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto+$alto+$alto);
    $this->pdf->SetX(72);
    $respuesta = $this->calcular_contenido($procesos, 2, 1);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->SetY(53+$alto+$alto+$alto);
    $this->pdf->SetX(72+41);
    $respuesta = $this->calcular_contenido($procesos, 3, 1);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    $this->pdf->SetFillColor(241,196,15);
    $this->pdf->SetY(53+$alto+$alto+$alto);
    $this->pdf->SetX(72+41+41);
    $respuesta = $this->calcular_contenido($procesos, 4, 1);
    $this->pdf->MultiCell(41, $alto/$respuesta['contador'], utf8_decode($respuesta['procesos']), '1', 'C', true); $equis = "";

    ////////////////////////////////////////////////////////////////////////////
    $this->pdf->Ln(7);
    $this->pdf->Cell(36,5,utf8_decode("Referencias:"),'0',0,'L',0);$this->pdf->Ln(7);
    $this->pdf->SetFillColor(39,174,96);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo poco significativo"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(241,196,15);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo medio"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(230,126,34);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo considerable"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->SetFillColor(231,76,60);
    $this->pdf->Cell(10,5,utf8_decode(" "),'0',0,'C',1);
    $this->pdf->Cell(50,5,utf8_decode(" Riesgo significativo"),'0',0,'L',0);$this->pdf->Ln(5);

    $this->pdf->Output("Detalle.pdf", 'I');
  }


  /*
    Función que calcula cual será la altura maxima de la celda
    Acorta los nombres de los procesos para que entren en las multiceldas
  */
  private function calcular_contenido($procesos, $impacto, $probabilidad){
    $equis = "";
    $bandera = 0;
    $contador = 0;
    foreach ($procesos as $p){
      if ($p['rango_impacto']==$impacto && $p['rango_probabilidad']==$probabilidad)
      {
        $equis .= substr($p['nombre'], 0, 23) . "\n";

        $contador = $contador + 1;
        $bandera = 1;
      }
    }
    if ($bandera == 0) {
      $contador = 1;
    }
    $respuesta = array(
      'procesos' => $equis,
      'contador' => $contador
    );
    return $respuesta;
  }


  public function listado_procesos($año){

    $this->load->library('pdf');

    $procesos = $this->proceso_model->getAllProcesosConNivelDeExposicion($año);

    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->AliasNbPages();
    $this->pdf->SetTitle("Listado de Procesos");
    $this->pdf->SetLeftMargin(5);
    $this->pdf->SetRightMargin(5);

    $this->pdf->SetTextColor(1,1,1);
    $this->pdf->SetFillColor(92,107,192);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180,7,utf8_decode('Datos de Analisis de Riesgos - Año: ' . $año . ' - Listado de procesos' ),0,0,'C','0');
    $this->pdf->Ln(7);


    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->SetFillColor(92,107,192);
    $this->pdf->SetTextColor(255,255,255);

    $this->pdf->Ln(7);
    $this->pdf->Cell(90,7,utf8_decode('Nombre'),'B',0,'L',1);
    $this->pdf->Cell(60,7,utf8_decode('Responsable'),'B',0,'L',1);
    $this->pdf->Cell(45,7,utf8_decode('Nivel de Exposicion'),'B',0,'L',1);
    $this->pdf->Ln(7);

    $this->pdf->SetTextColor(1,1,1);

    foreach ($procesos as $p){
      $this->pdf->Cell(90,7,utf8_decode($p['nombre']),'B',0,'L',0);
      $this->pdf->Cell(60,7,utf8_decode($p['responsable']),'B',0,'L',0);
      $this->pdf->Cell(45,7,utf8_decode($p['nivel_exposicion']),'B',0,'L',0);
      $this->pdf->Ln(7);
    }

    $this->pdf->Output("Listado_de_procesos.pdf", 'I');
  }



}
